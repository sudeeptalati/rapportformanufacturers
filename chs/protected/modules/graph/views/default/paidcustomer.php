<h1><font color="#0094EF"> Welcome to Graphs Component</font> </h1>
<h4><font color="#0094EF"> For Rapport Call Handling</font></h4>
<h6>Now you can see your number of service calls in graphical format</h6>
<?php

$e=Graph::model()->loadjson();
//echo $e['key'].'<br>';
//echo $e['exp_date_e'].'<br>';

$url = 	Yii::getPathOfAlias('application.modules.graph.components');	
$file= $url.'\graph.json';
//echo $file."<br>";

$url1=Yii::app()->baseUrl;
//echo $url1.'/index.php?r=graph/default/servercode_simple_for_json'
?>

 <table><tr><td>
<label style="color:red;">License Key Not Found or Invalid.</label>
Please get the License key from   <a target="_blank" href="http://www.rapportsoftware.co.uk">http://www.rapportsoftware.co.uk</a>
<br><br><form name="input" action="<?php echo Yii::app()->baseUrl.'/index.php?r=graph/default/servercode_simple_for_json'?>" method="post">
Enter Key:<br> <input type="text" name="key"><br>
<input type="submit" value="Submit">
</form>
</td>
<td>
<h4>Steps to get Your License Key</h4>
<br><b>Step 1:</b> Make Sure your rapport call handling system is <span style="color:blue;text"><b>connected to internet</b></span> 
<br><b>Step 2:</b> Go to <a target="_blank" href="http://www.rapportsoftware.co.uk">http://www.rapportsoftware.co.uk</a> & Login to your account
<br><b>Step 3:</b> From the My Downloads menu on the right hand side, click  on <a  target="_blank" href="http://www.rapportsoftware.co.uk/index.php/component/digistore/licenses?Itemid=0">My licenses/download</a>
<br><b>Step 4:</b> Under the heading My Downloads, there is column License Details
<br><b>Step 5:</b> Search for Graph Component and under graph component, you can find your 9 digit license key
<br>For any further help or queries, please contact <a href="mailto:admin@rapportsoftware.co.uk?Subject=Rapport Call Handling Graph Module Query" target="_top">admin@rapportsoftware.co.uk</a>


</td>
</tr>
</table>