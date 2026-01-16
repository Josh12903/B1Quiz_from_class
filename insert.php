<?php 
include_once "db.php";

// 優先從 POST 拿 table，拿不到才從 GET 拿，都沒有就給空字串
$table = $_POST['table'] ?? ($_GET['table'] ?? '');
$table = preg_replace('/[[:^print:]]/', '', trim($table));

// 判定物件是否存在
$className = ucfirst($table);
if ($table !== '' && isset($$className)) {
    $DB = $$className;
} else {
    die("錯誤：找不到資料表物件。傳入的 table 名稱為: [" . $table . "]");
}

// 注意：處理完畢後，要把 $_POST['table'] 刪除，不然 save() 會因為多出這個欄位而報錯
unset($_POST['table']);
// 5. 判斷顯示邏輯
switch($table){
    case "title":
        $_POST['sh'] = ($DB->count(['sh' => 1]) == 0) ? 1 : 0;    
    break;
    default:
        if($table != 'admin'){
            $_POST['sh'] = 1;
        }
}

// 6. 儲存
$DB->save($_POST);

to("./back.php?do=$table");
?>