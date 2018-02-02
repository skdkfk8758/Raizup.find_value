<?php
/*
File : application/views/main/index.php
Description : 메인페이지 뷰
*/
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div id="print_result">
    <div>
        <form action=<?php echo $action ?> method="get">
            <label for="search_text">검색</label>
            <select name="search_type" id="">
                <option value="korean">한글</option>
                <option value="english">영어</option>
            </select>
            <input name="search_text" type="text" value="" placeholder="변수명을 입력해 주세요"/>
            <input type="submit" name="search"/>
        </form>
    </div>
    <div><a href="<?php echo $link_to_insert?>">변수명 입력</a></div>
</div>