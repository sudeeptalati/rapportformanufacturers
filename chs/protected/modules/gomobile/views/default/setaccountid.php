<?php include('gomobile_menu.php');
?>
<h4>Account ID <span style='color:red;'>*</span><h4>

<form action="index.php?r=gomobile/default/setaccountid" method="post" name="gomobile_account_id_form" id="gomobile_account_id_form" onsubmit="return validateForm()">

<input type="text" name="gomobile_account_id" id="gomobile_account_id" value="<?php echo $gomobile_account_id;?>">
<br>
<input name="save_gomobile_account_id" name="save_gomobile_account_id"  value="Save" type="submit">
</form>


<script>
function validateForm() {
    var x = document.forms["gomobile_account_id_form"]["gomobile_account_id"].value;
	x=x.trim();
    if (x == null || x == "") {
        alert("Account ID must be filled out");
        return false;
    }
}
</script>