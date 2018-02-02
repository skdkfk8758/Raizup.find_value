<?php
class Data_model extends CI_Model {

	private $k_value;
	private $e_value;

    function __construct(){
		parent::__construct();
		$this->load->database();
	}

	function insert_process($k_value, $e_value) {
		if($this->search_same_value('english', $k_value, $e_value)) {
			$this->insert_total_value($k_value, $e_value);
		} else {
			$this->insert_value($k_value, $e_value);
		}
		if($this->search_same_value('korean', $k_value, $e_value)) {
			$this->insert_total_value($k_value, $e_value);
		} else {
			$this->insert_value($k_value, $e_value);
		}
	}

	function search_same_value($type, $k_value, $e_value) {
		$is_same_data = false;
		if($type == 'english') {
			$this->db->where('english_value', $e_value);
			($this->db->count_all_results("english_value_table") > 0) ? $is_same_data = true : $is_same_data = false;
		} else if($type == 'korean') {
			$this->db->where('korean_value', $k_value);
			($this->db->count_all_results("korean_value_table") > 0) ? $is_same_data = true : $is_same_data = false;
		} else {
			$this->db->where('korean_value', $k_value);
			$this->db->where('english_value', $e_value);
			($this->db->count_all_results("key_value_table") > 0) ? $is_same_data = true : $is_same_data = false;
		}
		return $is_same_data;
	}

	function get_count_key($type) {
		if($type == 'english') {
			$count = $this->db->count_all_results('english_value_table');
		} else if($type == 'korean'){
			$count = $this->db->count_all_results('korean_value_table');
		} else {
			$count = $this->db->count_all_results('key_value_table');
		}

		return $count;
	}

	function get_value(){
		$sql = "SELECT * FROM korean_value_table";

		// 쿼리 실행
		$result = $this->db->query($sql);

		// 결과값 리턴
		$data = $result->result_array();

		// 저장된 데이터 리턴
		return $data;
	}

	function insert_value($k_value, $e_value) {

		$korean_id = $this->get_count_key("korean") + 1;
		$english_id = $this->get_count_key("english") + 1;

		$korean_data = array (
			'id' => $korean_id,
			'korean_value' => $k_value,
		);

		$english_data = array (
			'id' => $korean_id,
			'english_value' => $e_value,
		);

		$this->db->insert("korean_value_table", $korean_data);
		$this->db->insert("english_value_table", $english_data);
	}

	function insert_total_value($k_value, $e_value) {
		$total_id = $this->get_count_key("total") + 1;

		$total_data = array (
			'id' => $total_id,
			'korean_value' => $k_value,
			'english_value' => $e_value,
		);
		if($this->search_same_value("total", $k_value, $e_value)) {
			$this->db->where('id', $total_id);
			$this->db->update("key_value_table", $total_data);
		} else {
			$this->db->insert("key_value_table", $total_data);
		}
	}

	function search_process($text, $type) {
		$search_where = $type."_value";

		$this->db->like($search_where, $text);

		return $this->db->get("key_value_table")->result();
	}
}
?>