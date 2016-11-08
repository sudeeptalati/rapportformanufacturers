<?php


$this->menu=array(
	array('label'=>'Change Logo', 'url'=>array('changeLogo')),
//	array('label'=>'Email Settings', 'url'=>array('emailSetup')),
	array('label'=>'About & Help', 'url'=>array('about')),
	array('label'=>'Restore Database', 'url'=>array('restoreDatabase')),
	
);

?>

<h1>Change Configuration Details </h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>