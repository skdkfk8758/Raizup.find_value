
<div id="print_result">
    <div>
        <form action=<?php echo $action ?> method="get">
            <label for="search_text">검색</label>
            <select name="search_type" id="">
                <option value="korean" <?php if ($search_type == 'korean') echo "selected"?>>한글</option>
                <option value="english" <?php if ($search_type == 'english') echo ("selected")?>>영어</option>
            </select>
            <input name="search_text" type="text" value="<?php echo $search_text?>" placeholder="변수명을 입력해 주세요"/>
            <input type="submit" name="search"/>
        </form>
    </div>
    <div><a href="<?php echo $link_to_insert?>">변수명 입력</a></div>
</div>

<div>
    <ul>
        <?php if($is_text == true) { ?>
            <?php foreach ($search_data as $result) { ?>
                <li>
                    <?php echo $result->korean_value?> =>
                    <?php echo $result->english_value?>
                </li>
            <?php } ?>
        <?php } else { ?>
            <li>검색어가 없습니다</li>
        <?php } ?>

    </ul>
</div>