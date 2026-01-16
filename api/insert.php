<?php 
/**
 * ========================================
 * 此檔案是「複製而生」的檔案
 * ========================================
 * 來源：基礎 API 處理模板 (api/insert.php)
 * 用途：通用新增處理 API
 * 功能：處理各種資料表的新增請求（含圖片上傳）
 * 引用：由各 modal/*.php 表單提交至此
 * 資料流：接收 POST/FILES 資料 -> 儲存 -> 重導向至 back.php
 * ========================================
 */
include_once "db.php";

// $table=$_GET['table'];
// $DB=${ucfirst($table)};

if(!empty($_FILES['img']['tmp_name'])){
    move_uploaded_file($_FILES['img']['tmp_name'],"../pic/".$_FILES['img']['name']);
    $_POST['img']=$_FILES['img']['name'];
}


$_POST['sh']=($Title->count(['sh'=>1])==0)?1:0;

$Title->save($_POST);

// switch($table){
//     case "title":
//         $_POST['sh']=($DB->count(['sh'=>1])==0)?1:0;    
//     break;
//     default:
//         if($table!='admin'){
//             $_POST['sh']=1;
//         }

//     }        

// $DB->save($_POST);

to("../back03.php?do=title");