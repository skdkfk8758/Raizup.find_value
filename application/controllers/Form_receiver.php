<?php
class Form_receiver extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->database();
        $this->load->model('data_model');
    }

    public function search() {

        $send_to_index = array(
            "action" => site_url("form_receiver/search"),
            "link_to_insert" => site_url("form_receiver/insert"),
        );

        $is_text = false;

        if($this->input->get("search_text") == true) {
            $text = $this->input->get('search_text');
            ($text==" ") ? $is_text=true : $is_text = false;
            $search_type = $this->input->get("search_type");
            $search_reault = $this->data_model->search_process($text, $search_type);

            $send_to_search = array(
                "search_data" => $search_reault,
                "action" => site_url("form_receiver/search"),
                "link_to_insert" => site_url("form_receiver/insert"),
                "search_text" => $text,
                "search_type" => $search_type,
                "is_text" => $is_text
            );

            if($search_reault){
                $this->load->view("templates/header");
                $this->load->view("main/search", $send_to_search);
                $this->load->view("templates/footer");
            }
        } else {
            $this->load->view("templates/header");
            $this->load->view("main/index", $send_to_index);
            $this->load->view("templates/footer");
        }
    }

    public function insert() {
        $send_to_insert = array(
            "action" => site_url("form_receiver/insert_data"),
        );

        $this->load->view("templates/header");
        $this->load->view("main/insert", $send_to_insert);
        $this->load->view("templates/footer");
    }

    public function insert_data() {

        if ($this->input->post('insert') == true) {
            $korean = $this->input->post('korean_value');
            $english = $this->input->post('english_value');
            $this->data_model->insert_process($korean, $english);
        }

        $data['search_text'] = $this->input->post("korean_value");
        $data['search_type'] = "korean";
		$data['action'] = site_url("form_receiver/search");
        $data['link_to_insert'] = site_url("form_receiver/insert");
        $data['search_data'] = $this->data_model->search_process($data['search_text'], "korean");

        // $this->load->view("templates/header");
        // $this->load->view("main/search", $data);
        // $this->load->view("templates/footer");

        redirect("form_receiver/search?");
    }
}
?>