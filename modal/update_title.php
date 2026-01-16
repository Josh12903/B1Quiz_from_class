<div class="cent">更新圖片</div>
<hr>
<form action="./api/update_title.php" method="post" enctype="multipart/form-data">
<!-- <input type="hidden" name="table" value="title">     -->
<table style="width:70%; margin:auto;">
        <tr>
            <td>標題區圖片</td>
            <td><input type="file" name="img" id=""></td>
        </tr>
        
        <tr>
            <td>
                <input type="hidden" name="id" value="<?=$_GET['id']?> ">
                <input type="submit" value="更新">
                <input type="reset" value="重置">
            </td>
        </tr>
    </table>
</form>