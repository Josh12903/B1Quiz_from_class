<div class="cent">新增動態文字廣告</div>
<hr>
<form action="./api/insert_ad.php" method="post" enctype="multipart/form-data">
<!-- <input type="hidden" name="table" value="title">     -->
<table style="width:70%; margin:auto;">
        <tr>
            <td>動態文字廣告</td>
            <td><input type="text" name="text" value=""></td>
        </tr>
        <tr>
            <td>
                <input type="submit" value="新增">
                <input type="reset" value="重置">
            </td>
        </tr>
    </table>
</form>