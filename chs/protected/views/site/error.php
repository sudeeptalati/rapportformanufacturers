<?php

/*
$this->pageTitle=Yii::app()->name . ' - Error';
$this->breadcrumbs=array(
	'Error',
);
*/

?>
<div>
<h1>Access Denied Minion ! </h1>
<img src="images/access_denied_minion.png" />


<h4>Error <?php echo $code; ?></h4>

<div class="error">
<?php echo CHtml::encode($message); ?>
</div>
</div>