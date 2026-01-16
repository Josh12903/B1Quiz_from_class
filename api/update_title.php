<?php

include_once "db.php";
// foreach($_POST['text'] as $id =>$text){}

if(!empty($_FILES['img']['tmp_name'])){
    move_uploaded_file($_FILES['img']['tmp_name'],"../pic/".$_FILES['img']['name']);
    $_POST['img']=$_FILES['img']['name'];
    
}

$Title->save($_POST);

to("../back03.php?do=title");