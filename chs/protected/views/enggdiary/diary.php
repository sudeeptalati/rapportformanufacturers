<?php	
$this->layout = 'main';

$servicecall_id = $_GET['id'];
$engineer_id = $_GET['engineer_id'];
$servicecallmodel = Servicecall::model()->findbyPK(array('id' => $servicecall_id));
$current_customer_postcode = $servicecallmodel->customer->postcode;
$engineer_name = $servicecallmodel->engineer->fullname;
$servicecallmodel = Servicecall::model()->findbyPK(array('id' => $servicecall_id));
$model = Enggdiary::model();
//$no_next_days = 10;
$no_next_days = $model->getconsiderdaysforslotavailabity();
$allowedtraveldistancebetweenpostcodes = $model->gettraveldistanceallowedbetweenpostcodes();
$totalnoofcallsperday = $model->getTotalnoofcallsperday();

$workingdaysofweekstring = $model->getworkingdaysinweek();
$workingdaysofweekarray = str_split($workingdaysofweekstring);
//print_r($workingdaysofweekarray);

$today = date('d-m-Y');

//echo $data->servicecall->customer->postcode;
?>
<br>
<div>
	<div style='width:25%; float:left;'>
		<table>
			<tr>
				<td>
					<b>Customer PostCode:</b> 
				</td>
				<td>
				<?php echo $current_customer_postcode; ?>
				</td>
			</tr>
			<tr>
				<td>
					<b>Engineer:</b> 
				</td>
				<td>
					<?php echo $engineer_name; ?>
				</td>
			</tr>
		</table>
		
	</div>

	<div style='width:50%;float:right'>
		<b>Based on parameters</b>
		<br>
		<table>
			<tr>
				<td><b>Days Considered for Planning</b></td>
				<td><?php echo $no_next_days; ?> days</td>
			</tr>
			<tr>
				<td><b>Maximum Travel Distance Between Two postcodes</b></td>
				<td><?php echo $allowedtraveldistancebetweenpostcodes; ?> miles</td>
			</tr>
			<tr>
				<td><b>Maximum Number of Servicecalls per day</b></td>
				<td><?php echo $totalnoofcallsperday; ?> servicecalls</td>
			</tr>
		</table>
			
	</div>
</div>
<br>
<table>
    <tr>
        <?php
        $days_postcodes_array = array();
        $considered_dates = array();
        $selectday_row_dates = array();

        for ($i = 1; $i <= $no_next_days; $i++) {
            $forloopdate_time = time() + (86400 * $i);
            $forloopdate_string = date("d-M-Y l", $forloopdate_time);
            $forloop_day = date("d", $forloopdate_time);
            $forloop_month = date("m", $forloopdate_time);
            $forloop_year = date("Y", $forloopdate_time);
            $forloop_weekday = date("N", $forloopdate_time);

            array_push($selectday_row_dates, date("j-n-Y", $forloopdate_time));



            echo '<td style="vertical-align:top; border: 1px solid black;">';
            echo '<div style="height:50px; background:#EFEFEF"><b>' . $forloopdate_string . '</b></div>';
            //echo '<div style="height:10px; background:#9AFD95"></div>';

            if (in_array($forloop_weekday, $workingdaysofweekarray)) {
                //echo '<br>	<b>NOT HOLIDAY</b>';
                $forloop_start_date_time = mktime(0, 0, 0, $forloop_month, $forloop_day, $forloop_year); ////hours,minutes,seconds,month,day,year
                $forloop_end_date_time = mktime(23, 59, 59, $forloop_month, $forloop_day, $forloop_year); ////hours,minutes,seconds,month,day,year

                $data = Enggdiary::model()->getData($engineer_id, $forloop_start_date_time, $forloop_end_date_time);
                if (count($data) >= $totalnoofcallsperday) {
                    echo '<br><div style="height:260px; background: #EFEFEF; ">';

                    foreach ($data as $d) {
                        echo '<p style="margin: 0 0 2px 10px">' . $d->servicecall->customer->postcode . '</p>';
                    }
                    echo '<br><b>This day is fully booked</b>';

                    echo '</div>';

                    $no_next_days = $no_next_days + 1;
                } else {
                    $customer_postcodes = array();
                    echo '<br><div style="height:260px; background: #FFFFFF; ">';
                    foreach ($data as $d) {
                        $diary_customer_postcode = $d->servicecall->customer->postcode;
                        $diary_customer_postcode = strtoupper($diary_customer_postcode);
                        $diary_customer_postcode = trim($diary_customer_postcode);
                        echo '<p style="margin:	0 0 2px 10px">' . $d->servicecall->customer->postcode . '</p>';
                        array_push($customer_postcodes, $diary_customer_postcode);
                    }
                    echo '</div>';

                    array_push($days_postcodes_array, $customer_postcodes);
                    array_push($considered_dates, date("j-n-Y", $forloopdate_time));
                    //echo '<hr>'.date("j-n-Y", $forloopdate_time);
                    //$days_postcodes_array[$forloopdate_string]=$customer_postcodes;
                }//end of else if (count($data)>=$totalnoofcallsperday)
            }///end of if in_array
            else {

                echo '<br><div style="height:260px; background: #EFEFEF; "><b>HOLIDAY</b></div>';
                $no_next_days = $no_next_days + 1;
            }///end of else of in_array

            echo '</td>';
        }//end of days forloop_end_date_time
        ?>
    </tr>


    <tr>
        <?php
//print_r($selectday_row_dates);

        for ($i = 0; $i < count($selectday_row_dates); $i++) {

            echo '<td id=' . $selectday_row_dates[$i] . ' style="vertical-align:top; border: 1px solid black;">';

            //echo $selectday_row_dates[$i];
            echo '</td>';
        }
        ?>
    </tr>


</table>
        <?php
        ?>
<br>
        <?php
        $baseUrl = Yii::app()->request->baseUrl;
        $url = $baseUrl . "/index.php?r=enggdiary/bookingAppointment&id=" . $servicecall_id . "&engineer_id=" . $engineer_id;
//echo $url;
        ?>
<a href="<?php echo $url ?>">Or Click here to book the appointment on calendar manually</a>

<script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>

<script>


    var map;
    var geocoder;
    var bounds = new google.maps.LatLngBounds();
    var markersArray = [];
    var x = 0;
    var considerdays =<?php echo $no_next_days; ?>;

    var considered_dates =<?php echo json_encode($considered_dates); ?>;
    var considered_postcodes =<?php echo json_encode($days_postcodes_array); ?>;
    var current_customer_postcode = '<?php echo $current_customer_postcode; ?>';
    var allowedtraveldistancebetweenpostcodes =<?php echo $allowedtraveldistancebetweenpostcodes; ?>;

    console.log(considered_dates);
    console.log(considered_postcodes);

    var recievd_postcodes = [];
    var recievd_distances = [];
    var recievd_time = [];
    var autotimer;
    var engg_id =<?php echo $engineer_id; ?>;
    var service_id =<?php echo $servicecall_id; ?>;
    var firstnearestdate = '';


    var availabledatesinddmmyyyy = [];


    var destinationIcon = 'https://chart.googleapis.com/chart?chst=d_map_pin_letter&chld=D|FF0000|000000';
    var originIcon = 'https://chart.googleapis.com/chart?chst=d_map_pin_letter&chld=O|FFFF00|000000';


    $(document).ready(function () {
        callme();
    });



    function initialize() {
        var opts = {
            center: new google.maps.LatLng(55.6414923, -4.5296094),
            zoom: 10
        };
        map = new google.maps.Map(document.getElementById('map-canvas'), opts);
        geocoder = new google.maps.Geocoder();
    }

    function calculateDistances() {


        if ((x < considered_postcodes.length))////so that it runs for all the postcodes
        {
            current_date = considered_dates[x];
            current_postcodes = considered_postcodes[x];
            d_array = [];
            d_array = current_postcodes;
            if (d_array.length != 0)
            {
                var service = new google.maps.DistanceMatrixService();
                service.getDistanceMatrix(
                        {
                            /*
                             origins: ['KA32SN', 'KA12NP'],
                             destinations: ['PA12BE'],
                             */
                            origins: [current_customer_postcode],
                            destinations: d_array,
                            travelMode: google.maps.TravelMode.DRIVING,
                            unitSystem: google.maps.UnitSystem.IMPERIAL,
                            avoidHighways: false,
                            avoidTolls: false
                        }, callback);
            }
            else
            {
                console.log('There are no calls Booked on Day  ' + current_date);
                availabledatesinddmmyyyy.push(current_date);

            }
            x++;
        }
        else
        {
            //x=0;
            filterdatabydistancebetweentwopostcodes();
            //alert('The system can only consider for '+considerdays+' days and plan. Please choose a date manually or leave call in logged state to book later.');
            showavailabledatesinddmmyyyy();
            clearInterval(autotimer);
        }
    }///end of function calculateDistance


    function showavailabledatesinddmmyyyy()
    {
        //console.log('------recievd_distances-----------'+recievd_distances);
        //console.log('------recievd_postcodes-----------'+recievd_postcodes);
        console.log('availablle days are availabledatesinddmmyyyy  ' + availabledatesinddmmyyyy);
		
		console.log('availablle days are availabledatesinddmmyyyy  ' + availabledatesinddmmyyyy.length);
		if(availabledatesinddmmyyyy.length==0)////means if system could not find any available dates we ask user to manually create diary entry
		{
				
				//document.getElementById('systemmessage')='<b>System cannot find any suitable dates, Please book the call manually</b>'
				document.getElementById('outputDiv').innerHTML += '<br><b>System cannot find any suitable dates, Please book the call manually by the above link.</b>';
				document.getElementById('loading').style.display = 'none';
				//document.getElementById('systemmessage').style.display = 'block';

		}
        
		
		
		
		if (recievd_postcodes.length != 0)
        {
            //we will call this 3 times to get the 3 options
			for (var p=0;p<recievd_postcodes.length;p++)
			{
				if(p>2)
				break;////otherwise it will show more than 3 available days
				findthenextdaywithnearestpostcode();
				
            }
        }
        else
        {
            console.log('Recieve postcodes lenth 0. No Near Postcodes found');
        }


        availabledatesinddmmyyyy = sortavailabledatesinorder(availabledatesinddmmyyyy);
        console.log('=============AFTER SORTING ========================');
        console.log(availabledatesinddmmyyyy);

        /*
		createpreferecncebutton('0', availabledatesinddmmyyyy[0]);
        createpreferecncebutton('1', availabledatesinddmmyyyy[1]);
        createpreferecncebutton('2', availabledatesinddmmyyyy[2]);
		*/
		
		for (var p=0;p<availabledatesinddmmyyyy.length;p++)
		{
			
			if(p>2)
				break;////otherwise it will show more than 3 available days
			createpreferecncebutton(p, availabledatesinddmmyyyy[p]);
		}
		
		
		
        setonclickforpreferreddatesbtn();
    }//end of my fnc

    function sortavailabledatesinorder(da)
    {
        console.log('SORTING DATES : ' + da);
        var dateobjarray = [];
        var sorteddatestringarray = [];

        for (var n = 0; n < da.length; n++)
        {
            //console.log(da[n]);
            res = da[n].split("-");
            c_day = res[0];
            c_month = res[1] - 1;///since javascript month start from 0
            c_year = res[2];
            date_obj = new Date(c_year, c_month, c_day, 0, 0, 0, 0);
            dateobjarray.push(date_obj);
        }

        dateobjarray = dateobjarray.sort(sortByDateAsc);
        //console.log(dateobjarray);

        for (var n = 0; n < dateobjarray.length; n++)
        {
            //console.log(dateobjarray[n]);
            var d = dateobjarray[n];
            d_date = d.getDate();
            d_month = d.getMonth() + 1;
            d_year = d.getFullYear();
            d_string = d_date + "-" + d_month + "-" + d_year;
            sorteddatestringarray.push(d_string);
        }//end of for

        console.log(sorteddatestringarray);
        return sorteddatestringarray;

    }///end of sortavailabledatesinorder



    function sortByDateAsc(a, b) {
        return a < b ? -1 : a > b ? 1 : 0;
    }//end of function  sortByDateAsc()



    function filterdatabydistancebetweentwopostcodes()
    {
        /*
         recievd_distances
         recievd_postcodes
         allowedtraveldistancebetweenpostcodes
         */

        console.log('----------------------FILTERING DISTANCE NOW---------------------------------');
        console.log('Recieved Distances from customer postcodes  ' + recievd_distances);


        temp_googlerecievedpc_array = recievd_postcodes;
        temp_googlerecieveddistance_array = recievd_distances;
        recievd_postcodes = [];
        recievd_distances = [];
        for (var m = 0; m < temp_googlerecieveddistance_array.length; m++)
        {
            console.log('Recieved Distances ' + temp_googlerecieveddistance_array[m] + 'from customer postcodes  ' + temp_googlerecieveddistance_array[m]);

            if (temp_googlerecieveddistance_array[m] > allowedtraveldistancebetweenpostcodes)
            {
                ///find the postcode in recievd_postcodes array and delete it
                pc_to_be_deleted = temp_googlerecievedpc_array[m];
                var pc_to_be_deleted_index = recievd_postcodes.indexOf(pc_to_be_deleted);

                /*
                 recievd_postcodes.splice(pc_to_be_deleted_index, 1);
                 recievd_distances.splice(pc_to_be_deleted_index, 1);
                 */
                /*			
                 for (var m=0;m<recievd_distances.length;m++)
                 {
                 console.log('Recieved Distances '+recievd_distances[m]+'from customer postcodes  '+recievd_postcodes[m]);
                     
                     
                 if (recievd_distances[m]>allowedtraveldistancebetweenpostcodes)
                 {
                     
                 recievd_postcodes.splice(m, 1);
                 recievd_distances.splice(m, 1);
                 */
            }
            else
            {
                recievd_postcodes.push(temp_googlerecievedpc_array[m]);
                recievd_distances.push(temp_googlerecieveddistance_array[m]);
                document.getElementById('outputDiv').innerHTML += '<br>The nearest postcode to ' + current_customer_postcode + ' is ' + temp_googlerecievedpc_array[m] + ' is ' + temp_googlerecieveddistance_array[m] + ' miles';
            }
        }//end of for`

        console.log('filtered Recieved Distances' + recievd_distances);
        console.log('filtered Recieved POSTCODES' + recievd_postcodes);

    }//filterdatabydistancebetweentwopostcodes()

    function findthenextdaywithnearestpostcode()
    {
        console.log('********************findthenextdaywithnearestpostcode***********************************');
        console.log('FILTERED RECIEVED DISTANCES' + recievd_distances);
        console.log('FILTERED RECIEVED DISTANCES' + recievd_postcodes);
        if (recievd_postcodes.length > 0)
        {
            p = indexOfSmallest(recievd_distances);
            day_count = finddayofnearestpostcode(recievd_postcodes[p]);
            
			//nearestdate=adddaystodate(day_count+1); ///since day starts with 0
            //getting index of neartestday
            nearestdate = considered_dates[day_count]; ///since day starts with 0
            console.log('I AM IN RECEIEVD POSTCODELENGTH >0 Day Count'+day_count, engg_id, service_id, nearestdate);
            if (arraycontains(availabledatesinddmmyyyy, nearestdate) == true)
            {
                recievd_postcodes.splice(p, 1);
                recievd_distances.splice(p, 1);
                findthenextdaywithnearestpostcode();
            } else
            {
                console.log('NEXT NEAREST DATE IS' + nearestdate);
                availabledatesinddmmyyyy.push(nearestdate);

            }
        }
    }///end of findthenextdaywithnearestpostcode


    function setonclickforpreferreddatesbtn()
    {
		
		/*
        document.getElementById('outputDiv').innerHTML += '<br> The first  Available Day for Booking is DAY <b>' + availabledatesinddmmyyyy[0] + '</b>	';
        document.getElementById('outputDiv').innerHTML += '<br> The Second Available Day for Booking is DAY <b>' + availabledatesinddmmyyyy[1] + '</b>	';
        document.getElementById('outputDiv').innerHTML += '<br> The Third  Available Day for Booking is DAY <b>' + availabledatesinddmmyyyy[2] + '</b>	';
        document.getElementById('0preferecncebutton').onclick = selectthefirstavailableday;
        document.getElementById('1preferecncebutton').onclick = selectthesecondavailableday;
        document.getElementById('2preferecncebutton').onclick = selectthethirdavailableday;
		*/
		
		for (var p=0;p<availabledatesinddmmyyyy.length;p++)
		{
			if(p>2)
				break;////otherwise it will show more than 3 available days
			//document.getElementById('outputDiv').innerHTML += '<br> The NEXT Available Day for Booking is DAY <b>' + availabledatesinddmmyyyy[0] + '</b>	';
			var elementid=p+'preferecncebutton';
			
			switch (p)
			{
				case 0:
						document.getElementById(elementid).onclick = selectthefirstavailableday;
						document.getElementById('outputDiv').innerHTML += '<br> The first  Available Day for Booking is DAY <b>' + availabledatesinddmmyyyy[0] + '</b>	';
						break;
				case 1:
						document.getElementById(elementid).onclick = selectthesecondavailableday;
						document.getElementById('outputDiv').innerHTML += '<br> The Second Available Day for Booking is DAY <b>' + availabledatesinddmmyyyy[1] + '</b>	';
						break;
				case 2:
						document.getElementById(elementid).onclick = selectthethirdavailableday;
						document.getElementById('outputDiv').innerHTML += '<br> The Third  Available Day for Booking is DAY <b>' + availabledatesinddmmyyyy[2] + '</b>	';
						break;
						
				
			}//end of switch
			
			
		}//for 
	}


    function createpreferecncebutton(pref, dateid)
    {
        var preferencebutton = document.createElement("input");
        preferencebutton.id = pref + 'preferecncebutton';
        preferencebutton.name = pref + 'preferecncebutton';
        preferencebutton.type = "button";
        preferencebutton.value = "Available";
        preferencebutton.style = "margin:5px";
        //document.getElementById(dateid).style.background='#99FFCC';
        document.getElementById(dateid).style.background = '#66FF66';
        document.getElementById(dateid).appendChild(preferencebutton);
        document.getElementById('loading').style.display = 'none';

    }//end of createfirstpreferecncebutton

    function selectthefirstavailableday()
    {
        console.log('selectthefirstavailableday SELECTEWD');
        createNewDiaryEntry(availabledatesinddmmyyyy[0]);
    }///end of selectthefirstavailableday



    function selectthesecondavailableday()
    {
        console.log('selectthesecondavailableday SELECTEWD');
        createNewDiaryEntry(availabledatesinddmmyyyy[1]);

    }///end of selectthesecondavailableday



    function selectthethirdavailableday()
    {
        console.log('THIRD preferecncebutton SELECTEWD');
        createNewDiaryEntry(availabledatesinddmmyyyy[2]);

    }///endf of selectthethirdavailableday






////***==============================================================================*///
    function callback(response, status) {

        console.log(response);
        if (status != google.maps.DistanceMatrixStatus.OK) {
            alert('Error was: ' + status);
        } else {
            var origins = response.originAddresses;
            var destinations = response.destinationAddresses;
            var outputDiv = document.getElementById('outputDiv');
            outputDiv.innerHTML = '';
            deleteOverlays();

            for (var i = 0; i < origins.length; i++) {
                var results = response.rows[i].elements;
                addMarker(origins[i], false);
                for (var j = 0; j < results.length; j++) {
                    addMarker(destinations[j], true);

                    /*
                     outputDiv.innerHTML += origins[i] + ' to ' + destinations[j]
                     + ': ' + results[j].distance.text + ' in '
                     + results[j].duration.text + '<br>';
                     */
                    recievd_postcodes.push(destinations[j]);
                    rd = results[j].distance.text;
                    rd = rd.replace('mi', '');
                    rd = rd.trim();
                    rd = parseFloat(rd);
                    recievd_distances.push(rd);
                    recievd_time.push(results[j].duration.text);


                    /*
                     outputDiv.innerHTML += 'PA12BE  to ' + destinations[j]
                     + ': ' + results[j].distance.text + ' in '
                     + results[j].duration.text + '<br>';
                     */
                }
            }
        }
    }

    function addMarker(location, isDestination) {
        var icon;
        if (isDestination) {
            icon = destinationIcon;
        } else {
            icon = originIcon;
        }
        geocoder.geocode({'address': location}, function (results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                bounds.extend(results[0].geometry.location);
                map.fitBounds(bounds);
                var marker = new google.maps.Marker({
                    map: map,
                    position: results[0].geometry.location,
                    icon: icon
                });
                markersArray.push(marker);
            } else {
                alert('Geocode was not successful for the following reason: '
                        + status);
            }
        });
    }

    function deleteOverlays() {
        for (var i = 0; i < markersArray.length; i++) {
            markersArray[i].setMap(null);
        }
        markersArray = [];
    }

    google.maps.event.addDomListener(window, 'load', initialize);


    function callme()
    {

        document.getElementById('inputs').style.display = 'none';
        document.getElementById('loading').style.display = 'block';


        autotimer = setInterval(function () {
            calculateDistances();
            /*
             var div = document.getElementById('inputs');
             if (div.style.display !== 'none') {
             div.style.display = 'none';
             }
             else {
             div.style.display = 'block';
             }
             */
        }, 1000);
    }

    function indexOfSmallest(a) {
        var lowest = 0;
        for (var i = 1; i < a.length; i++) {
            if (a[i] < a[lowest])
                lowest = i;
        }
        return lowest;
    }


    function finddayofnearestpostcode(postcode)
    {
        postcode = postcode.trim();
        data =<?php echo json_encode($days_postcodes_array); ?>;
        foundonday = 'BLANK';

        console.log(data);
        console.log(postcode);

        for (var key in data) {
            if (data.hasOwnProperty(key)) {
                //console.log(key + " -> " + data[key]);
                var day = key;

                for (t = 0; t < data[key].length; t++)
                {
                    current_pc = data[key][t];
                    //console.log(current_pc);
                    var n = postcode.indexOf(current_pc);
                    if (n != -1)
                    {
                        console.log('INDEX OF ' + postcode + ' in DAY ' + day + 'is ' + n);
                        //foundonday=parseInt(day)+1;//deactivated by SUDEEP TALATI
                        foundonday = parseInt(day);
                        return foundonday;
                    }


                }////for (t=0;t<data[key].length;t++)

            }///end of if (data.hasOwnProperty(key)) {

        }///end of for (var key in data) 

    }





    function createNewDiaryEntry(dateofappointment)
    {
        alert('createNewDiaryEntry Called');

        var urlToCreate = '<?php echo Yii::app()->getBaseUrl(); ?>' + '/index.php?r=api/createNewDiaryEntry&start_date=' + dateofappointment + '&engg_id=' + engg_id + '&service_id=' + service_id;
        //alert(urlToCreate);


        $.ajax
                ({
                    type: 'POST',
                    url: urlToCreate,
                    cache: false,
                    modal: true,
                    success: function (data)
                    {
                        alert('Appointment Created' + data);
                        location.href = '<?php echo Yii::app()->getBaseUrl(); ?>' + '/index.php?r=servicecall/view&id=' + service_id;
                    },
                    error: function ()
                    {
                        alert("ERROR");
                    },
                });//end of AJAX.

    }//end of createNewDiaryEntry().

//function finddayofnearestdate(nearestday)
    function adddaystodate(no_of_days)
    {
        var today = new Date();
        var nearestdate = new Date(today);
        nearestdate.setDate(today.getDate() + no_of_days);

        var dd = nearestdate.getDate();
        var mm = nearestdate.getMonth() + 1; //January is 0!
        var yyyy = nearestdate.getFullYear();


        rtn_date = dd + '-' + mm + '-' + yyyy;
        return rtn_date;
    }

    function arraycontains(a, obj) {
        var i = a.length;
        while (i--) {
            if (a[i] === obj) {
                return true;
            }
        }
        return false;
    }
</script>
<style>


    #map-canvas {
        height: 25%;
        width: 25%;
    }
    #content-pane {
        float:right;
        width:100%;
        padding-left: 2%;
    }
    #outputDiv {
        font-size: 16px;
    }
</style>
<div id="content-pane">

    <div id='loading' style='display:none'><img src="images/loading.gif"  \>
        <br>
        <div id='systemmessage'>Please wait, the system is calculating the nearest suitable day</div></div>
                <div id="inputs">
                    <p><button type="button" onclick="callme();">Show me Available Days</button></p>
                </div>
                <div id="outputDiv"></div>
                </div>
                <div id="map-canvas"></div>


