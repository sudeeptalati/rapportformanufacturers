<div id="sidemenu">             
<?php include('setup_sidemenu.php'); ?>   
</div>

 <h1>Retailers & Distributors</h1>
 

<div id="submenu">   
<li><?php echo CHtml::link('Manage Retailers  & Distributors',array('admin')); ?></li>
<li><?php echo CHtml::link('Add New ',array('create')); ?></li>
</div>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'retailers-and-distributors-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		'company',
		 
		 array(
            'name'=>'companytype',
            'value'=>'$data->companytype',
            'filter'=>array('DISTRIBUTOR'=>'DISTRIBUTOR', 'RETAILER'=>'RETAILER'),
                'htmlOptions'=>array('width'=>'150px'),
        ),
		'address',
		'town',
		'postcode',
		/*
		'telephone',
		'created',
		*/
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view}{update}',
		),
	),
)); ?>
