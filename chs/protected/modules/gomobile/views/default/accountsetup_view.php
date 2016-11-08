<?php include('gomobile_menu.php'); ?>  
<h4>Account ID<h4>
<pre>
<?php
echo $gomobile_account_id;
?>
</pre>
 
<form action="index.php?r=gomobile/default/setaccountid" method="post">
<input name="Edit" value="Edit" type="submit">
</form>