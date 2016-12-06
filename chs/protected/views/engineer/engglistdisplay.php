<div id="sidemenu">             
    <?php include('setup_sidemenu.php'); ?>   
</div>


<h1>Manage Engineers</h1>

<div id="submenu">   
    <li><?php echo CHtml::link('Manage Engineers', array('admin')); ?></li>
    <li><?php echo CHtml::link('Add New Engineers', array('create')); ?></li>
    <li><?php echo CHtml::link('Engineers Display List', array('engglistdisplay')); ?></li>
</div>

<br>

<?php
$actionurl = Yii::app()->getBaseUrl() . '/index.php?r=engineer/engglistdisplay';
$displayformatid=$model->getdisplayformatid();
$options=$model->getdisplayformatoptions();

//echo '<hr> DISPLAY FOR MTA ID: ' . $displayformatid;
?>


<h4>Engineer List Display Format</h4>

<form action='<?php echo $actionurl; ?>'  name='engglistdisplay' id='engglistdisplay' method='post'>



    <?php
    echo CHtml::dropDownList('displayformat', $displayformatid, $options);
    ?> 
    <br>
    <input type="submit" value="Save" />
</form>