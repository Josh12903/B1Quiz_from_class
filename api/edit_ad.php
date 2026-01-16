<?php

include_once "db.php";
dd($_POST);

foreach($_POST['text'] as $id =>$text){
    if(!empty($_POST['del']) && in_array($id,$_POST['del'])){
        $Ad->del($id);
    }else{
        $row=$Ad->find($id);
        $row['text']=$text;
        $row['sh']=(isset($_POST['sh']) && $_POST['sh']==id)?1:0;
        $Ad->save($row);
    }
}

to("../back03.php?do=ad");