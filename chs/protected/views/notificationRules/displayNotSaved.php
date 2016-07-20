<?php

/**** DIALOGUE BOX TO DISPLAY ERROR CODE ***/
$this->beginWidget('zii.widgets.jui.CJuiDialog', 
		array(
			'id'=>'formdialog',
			// additional javascript options for the dialog plugin
			'options'=>array(
					'title'=>'Error',
					'autoOpen'=>true,
					'modal'=>'true',
					'show' => 'blind',
					'hide' => 'explode',
			),//end of options array.
));

echo "Not saved, Please select any status OR notification rule may be present for this status, select another status.";

$this->endWidget('zii.widgets.jui.CJuiDialog');

/**** END OF DIALOGUE BOX TO DISPLAY ERROR CODE ***/




?>

