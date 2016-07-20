<?php include('graph_menu.php'); ?>

<?php
$alljobstatus = JobStatus::model()->getAllPublishedListdata();
//print_r($alljobstatus);
$alljobstatus[0] = 'All Status';
$alljobstatus = array_reverse($alljobstatus, true);

$url = Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('application.modules.graph.assets'));
Yii::app()->clientScript->registerScriptFile($url . '\js\Chart.js');
//echo $url;

?>

<h1 style="width: 200px;color: #4C99C5;"class="fa fa-area-chart fa-2x"> Graphs</h1>


<table>
    <tr>
        <td>
            <div id="dates-select-div">

                <table>
                    <tr>
                        <td><h4><b>Start Date*</b></h4></td>
                        <td><h4><b>End Date*</b></h4></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>  <?php
                            $first_date_of_year = '1-1-' . date('Y', time());
                            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                'name' => 'custom_start_date',
                                'value' => $first_date_of_year,
                                // additional javascript options for the date picker plugin
                                'options' => array(
                                    'showAnim' => 'fold',
                                    'dateFormat' => 'd-m-yy',
                                ),
                                'htmlOptions' => array(
                                    'style' => 'height:20px;'
                                ),
                            ));

                            ?></td>
                        <td>  <?php
                            $today = date('j-n-Y', time());
                            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                'name' => 'custom_end_date',
                                'value' => $today,
                                // additional javascript options for the date picker plugin
                                'options' => array(
                                    'showAnim' => 'fold',
                                    'dateFormat' => 'd-m-yy',
                                ),
                                'htmlOptions' => array(
                                    'style' => 'height:20px;'
                                ),
                            ));
                            ?></td>
                        <td>
                            <button title="Generate Graph" class="fa fa-area-chart fa-2x" type="button" style="width: 200px;color: #4C99C5;border: none;background-color: white;" onclick="displaycustomrangegraph()">&nbsp;generate
                            </button>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <button style="width:200px;;" type="button" onclick="displaylastweek()">Last week</button>
                        </td>
                        <td>
                            <button style="width:200px;" type="button" onclick="displaylastmonth()">Last 30 Days
                            </button>
                        </td>
                        <td>
                            <button style="width:200px;" type="button" onclick="displaylastyear()">Last Year</button>
                        </td>
                    </tr>
                </table>
            </div><!-- end of date select <div> -->

            <div id="handy-buttons">
                <table>

                </table>
            </div><!-- end of div handy buutons -->

            <div id="graph_data_part" style="background-color:#FFFFFF; width:850px;float:left;">
                <table>
                    <tr>
                        <td colspan='3'><h3 id='chartLabel'></h3></td>
                    </tr>
                    <tr>
                        <td><h4><b>Filter By Job Status</b></h4></td>
                        <td><h3>Total Service Calls :</h3></td>
                        <td><h3 id='totalCount'></h3></td>

                    </tr>
                    <tr>
                        <td><?php
                            echo CHtml::dropDownList(
                                'job_status', '',
                                $alljobstatus,
                                array(
                                    'onchange' => 'displaycustomrangegraph();',
                                )
                            );
                            ?></td>

                        <td><h3 id='jobStatusFilterTotalCountLabel'></h3></td>
                        <td><h3 id='jobStatusFilterTotalCount'></h3></td>
                    </tr>
                </table>
            </div><!-- end of graph_data_part-->

            <div id="weekdays_div" style="background-color:#FFFFFF; width:850px;float:left;">

                <div id="weekdays">
                    <table>
                        <tr>
                            <td>
                                <input type="checkbox" checked='' onclick="displayGraph()" value="1"
                                       id='monday_checkbox'> Monday
                            </td>
                            <td>
                                <input type="checkbox" checked='' onclick="displayGraph()" value="2"
                                       id='tuesday_checkbox'> Tuesday
                            </td>
                            <td>
                                <input type="checkbox" checked='' onclick="displayGraph()" value="3"
                                       id='wednesday_checkbox'>
                                Wednesday
                            </td>
                            <td>
                                <input type="checkbox" checked='' onclick="displayGraph()" value="4"
                                       id='thursday_checkbox'>
                                Thursday
                            </td>
                            <td>
                                <input type="checkbox" checked='' onclick="displayGraph()" value="5"
                                       id='friday_checkbox'> Friday
                            </td>
                            <td>
                                <input type="checkbox" onclick="displayGraph()" value="6" id='saturday_checkbox'>
                                Saturday
                            </td>
                            <td>
                                <input type="checkbox" onclick="displayGraph()" value="0" id='sunday_checkbox'> Sunday
                            </td>
                        </tr>
                    </table>
                </div><!-- END OF DIV OF WEEKDAYS

            </div><!-- END OF WEEKDAYS DIV -->


                <div id="graph_canvas_div" style="background-color:#FFFFFF; width:850px;float:left;">
                    <canvas style="width:600px;height:500px;background-color: #FFFFFF;" id="canvas"></canvas>
                </div><!-- END OF graph_canvas_div-->


        </td>
        <td>
            <div id="right-sidebar3" style="background-color:#FFFFFF;width:200px;float:right;">
                <table border="1" style="width:200px;" id='job_statuses_servicecall_count_table'>
                    <!--<tr>
                        <th style='border:2px solid white;background-color:#C9E0ED;'>Job Statuses</th>
                        <th style='border:2px solid white;background-color:#C9E0ED;'>No of Service Calls</th>
                    </tr>
                    -->
                </table>
            </div>
        </td>
    </tr>
</table>


<script>


    var graphData = [];
    var graphLabel = [];
    var jobstatusFiltergraphData = [];
    var jobstatusFiltergraphLabel = [];
    var total_calls = 0;
    var jobstatus_filter_total_calls = 0;

    var start_date = "";
    var end_date = "";
    var selected_js = '0';

    var monthNames = ["January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December"];
    var chartLabel = "";
    Chart.defaults.global.scaleBeginAtZero = true;
    var randomScalingFactor = function () {
        return Math.round(Math.random() * 100)
    };
    var ctx = document.getElementById("canvas").getContext("2d");

    var lineChartData = {
        labels: ["January", "February", "March", "April", "May", "June", "July"],
        labels: graphLabel,
        animation: false,
        datasets: [
            {
                label: "My Second dataset",
                fillColor: "rgba(151,187,205,0.2)",
                strokeColor: "rgba(151,187,205,1)",
                pointColor: "rgba(151,187,205,1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(151,187,205,1)",
                data: [randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor()]
//					data :graphData
            },
            {
                label: "My First dataset",
                //fillColor: "rgba(220,220,220,0.2)",
                fillColor: "rgba(45,108,134,0.2)",
                strokeColor: "rgba(220,220,220,1)",
                pointColor: "rgba(220,220,220,1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(220,220,220,1)",
                data: [65, 59, 80, 81, 56, 55, 40]
            },

        ]

    }
    var myLineChart = new Chart(ctx).Line(lineChartData, {
        responsive: true
    });


    displaylastweek();

    function displayGraph() {
        ////first find the weekdays checked
        showweekdays = setweekdays();

        ///Second thing is to get the data from Ajax
        $.ajax({
            url: 'index.php?r=graph/default/GetCustomDaysData',
            type: 'get',
            // data: {'start_date': '24-Jul-2014', 'end_date': '30-Jul-2014', 'weekdays':showweekdays},
            data: {
                'start_date': start_date,
                'end_date': end_date,
                'weekdays': showweekdays,
                'job_status_id': selected_js
            },
            success: function (data, status) {
                ///step 3 Now Draw the Graph
                prepareGraphData(data);
                drawGraph();
            },
            error: function (xhr, desc, err) {
                console.log(xhr);
                console.log("Details: " + desc + "\nError:" + err);
            }
        }); // end ajax call

    }/////function displayGraph


    function prepareGraphData(data) {
        ///emptying the previous data
        graphData = [];
        graphLabel = [];
        jobstatusFiltergraphData = [];
        jobstatusFiltergraphLabel = [];
        total_calls = 0;
        jobstatus_filter_total_calls = 0;

        rawGraphData = [];
        json_data = jQuery.parseJSON(data);

        ///First we will extract total calls of filtered and normal data
        total_calls = json_data['total_calls'];
        rawGraphData = getJsonKeyValueArray(json_data['full_data']);
        graphData = rawGraphData['valuearray'];
        graphLabel = rawGraphData['keyarray'];

        console.log('TOTAL CALLS' + total_calls);
        console.log('TOTAL CALLS' + jobstatus_filter_total_calls);


        if (selected_js != 0)///if any job status selected
        {
            jobstatus_filter_total_calls = json_data['jobstatus_filter_total_calls'];
            rawjobstatusFiltergraphData = getJsonKeyValueArray(json_data['jobstatus_filter_data']);
            jobstatusFiltergraphData = rawjobstatusFiltergraphData['valuearray'];
            jobstatusFiltergraphLabel = rawjobstatusFiltergraphData['keyarray'];
        }
        else {
            ///we will keep both the data as same and will overlap both graphs on each other
            jobstatus_filter_total_calls = total_calls;
            jobstatusFiltergraphData = graphData;
            jobstatusFiltergraphLabel = graphLabel;
        }


    }///end of funct prepareGraphData()


    function drawGraph() {

        getJobStatusesCountOfServiceCalls();
        document.getElementById("totalCount").innerHTML = total_calls;
        var e = document.getElementById("job_status");
        document.getElementById("jobStatusFilterTotalCountLabel").innerHTML = e.options[e.selectedIndex].text + " Service Calls:";

        document.getElementById("jobStatusFilterTotalCount").innerHTML = jobstatus_filter_total_calls;

        //console.log(graphData.toString());

        lineChartData = {
            labels: graphLabel,

            datasets: [
                {
                    label: "Full Graph Data : Service Calls by Date",
                    fillColor: "rgba(220,220,220,0.2)",
                    strokeColor: "rgba(151,187,205,1)",
                    pointColor: "rgba(151,187,205,1)",
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(151,187,205,1)",
                    pointHitDetectionRadius: 2,
//					data : [randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor()]
                    data: graphData
                },
                {
                    label: "Filtered Graph Data By Job Status",
                    //fillColor: "rgba(151,187,205,0.2)",
                    fillColor: "rgba(45,108,134,0.2)",
                    strokeColor: "rgba(220,220,220,1)",
                    pointColor: "rgba(220,220,220,1)",
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(220,220,220,1)",
                    data: jobstatusFiltergraphData
                },

            ]

        }

        destroymychart();
        myLineChart = new Chart(ctx).Line(lineChartData, {
            responsive: true
        });
        //window.myLine.destroy();
        document.getElementById("chartLabel").innerHTML = chartLabel;


    }///end of drawGraph


    function displaylastweek() {
        var today = new Date();

        var last7thday = new Date();

        last7thday.setDate(today.getDate() - 6);

        start_date = last7thday.getDate() + '-' + (last7thday.getMonth() + 1) + '-' + last7thday.getFullYear();
        end_date = today.getDate() + '-' + (today.getMonth() + 1) + '-' + today.getFullYear();

        //start_date='01-May-2014';
        //end_date='30-Jul-2014';
        document.getElementById("custom_start_date").value = start_date;
        document.getElementById("custom_end_date").value = end_date;
        chartLabel = 'Current Week - Last 7 Days';
        show_weekdays();
        displayGraph();

    }//end of displaylastweek


    function displaylastmonth() {
        var today = new Date();

        var last30thday = new Date();

        last30thday.setDate(today.getDate() - 30);
        start_date = last30thday.getDate() + '-' + (last30thday.getMonth() + 1) + '-' + last30thday.getFullYear();
        //console.log('last30thday		:'+label30);
        end_date = today.getDate() + '-' + (today.getMonth() + 1) + '-' + today.getFullYear();
        //console.log('todays date		:'+label1);
        document.getElementById("custom_start_date").value = start_date;
        document.getElementById("custom_end_date").value = end_date;
        chartLabel = 'Last 30 Days';
        show_weekdays();
        displayGraph();

    }//end of dispalylastmonth


    function displaylastyear() {
        var today = new Date();
        var last365thday = new Date();

        last365thday.setDate(today.getDate() - 364);
        start_date = last365thday.getDate() + '-' + (last365thday.getMonth() + 1) + '-' + last365thday.getFullYear();
        end_date = today.getDate() + '-' + (today.getMonth() + 1) + '-' + today.getFullYear();

        chartLabel = last365thday.getDate() + '-' + monthNames[last365thday.getMonth()] + '-' + last365thday.getFullYear();
        chartLabel = chartLabel + ' To ' + today.getDate() + '-' + monthNames[today.getMonth()] + '-' + today.getFullYear();
        document.getElementById("custom_start_date").value = start_date;
        document.getElementById("custom_end_date").value = end_date;
        hide_weekdays();

        displayGraph();

    }//end of dispalylastyear


    function destroymychart() {
        if (typeof(myLineChart) === 'object') {
            myLineChart.destroy();
            myLineChart.clear();
        }//end of if

    }//end of destroymychart()


    function setweekdays() {
        var checked_weekdays = "";

        if (document.getElementById("monday_checkbox").checked == true) {
            checked_weekdays = checked_weekdays + document.getElementById("monday_checkbox").value;
        }

        if (document.getElementById("tuesday_checkbox").checked == true) {
            checked_weekdays = checked_weekdays + document.getElementById("tuesday_checkbox").value;
        }

        if (document.getElementById("wednesday_checkbox").checked == true) {
            checked_weekdays = checked_weekdays + document.getElementById("wednesday_checkbox").value;
        }

        if (document.getElementById("thursday_checkbox").checked == true) {
            checked_weekdays = checked_weekdays + document.getElementById("thursday_checkbox").value;
        }

        if (document.getElementById("friday_checkbox").checked == true) {
            checked_weekdays = checked_weekdays + document.getElementById("friday_checkbox").value;
        }

        if (document.getElementById("saturday_checkbox").checked == true) {
            checked_weekdays = checked_weekdays + document.getElementById("saturday_checkbox").value;
        }

        if (document.getElementById("sunday_checkbox").checked == true) {
            checked_weekdays = checked_weekdays + document.getElementById("sunday_checkbox").value;
        }


        //console.log('CHECKED WEEKDAYS 	*'+checked_weekdays);
        return checked_weekdays;
    }////end of function setWeekdays


    //creating hide_weekdays
    function hide_weekdays() {
        document.getElementById('weekdays').style.display = "none";
    }//end of hide_weekdays


    //creating show_weekdays
    function show_weekdays() {
        document.getElementById('weekdays').style.display = "block";
    }//end of show_weekdays


    //creating function displaycustomrangegraph
    function displaycustomrangegraph() {
        custom_start_date = document.getElementById("custom_start_date").value;
        custom_end_date = document.getElementById("custom_end_date").value;

        start_date = custom_start_date;
        end_date = custom_end_date;
        //console.log ("7777777"+custom_start_date);
        //console.log ("44444444"+start_date);
        selected_js = document.getElementById("job_status").value;

        console.log("SELECTED JS " + selected_js);


        daysdifference();
        displayGraph();

    }// end of displaycustomrangegraph


    // creating function daysdifference
    function daysdifference() {

        date1 = start_date;
        date2 = end_date;

        sdArr = date1.split("-");  // ex input "2010-01-18"
        d1 = (sdArr[0] + "-" + sdArr[1] + "-" + sdArr[2]);
        //console.log(d1);

        edArr = date2.split("-");  // ex input "2010-01-18"
        d2 = (edArr[0] + "-" + edArr[1] + "-" + edArr[2]);
        //console.log(d2);

        var a = new Date(sdArr[2], sdArr[1], sdArr[0]);
        var b = new Date(edArr[2], edArr[1], edArr[0]);
        var timeDiff = b.getTime() - a.getTime();
        var diffDays = Math.ceil((timeDiff / 86400000));
        //console.log("$&^&*(*(("+diffDays);
        chartLabel = a.getDate() + '-' + monthNames[a.getMonth() - 1] + '-' + a.getFullYear();
        chartLabel = chartLabel + ' To ' + b.getDate() + '-' + monthNames[b.getMonth() - 1] + '-' + b.getFullYear();

        if (diffDays < 0) {
            alert("End date is earlier to start date..!!! Please change end date");
            exit;
        }
        if (diffDays < 60) {
            show_weekdays();
        }
        else {
            hide_weekdays();
        }


    }// end of daysdifference


    function getJsonKeyValueArray(jsonData) {

        keyarray = [];
        valuearray = [];
        key_value_seperate_array = [];
        for (var key in jsonData) {
            if (jsonData.hasOwnProperty(key)) {

                console.log(key + " -> " + jsonData[key]);
                valuearray.push(jsonData[key]);
                keyarray.push(key);

            }//end of if
        }///end of for

        key_value_seperate_array['keyarray'] = keyarray;
        key_value_seperate_array['valuearray'] = valuearray;

        return key_value_seperate_array;
    }///end of getJsonKeyValueArray(jsonData)


    function getJobStatusesCountOfServiceCalls() {

        jobstatuses_count = [];

        $.ajax({
            url: 'index.php?r=graph/default/GetServicecallsCountByStatusesInDateRange',
            type: 'get',
            // data: {'start_date': '24-Jul-2014', 'end_date': '30-Jul-2014', 'weekdays':showweekdays},
            data: {'start_date': start_date, 'end_date': end_date, 'weekdays': showweekdays},
            success: function (data, status) {
                ///step 3 Now Draw the Graph

                displayJobStatusesCount(data);

            },
            error: function (xhr, desc, err) {
                console.log(xhr);
                console.log("Details: " + desc + "\nError:" + err);
            }
        }); // end ajax call


    }///end of getJobStatusesCountOfServiceCalls

    function displayJobStatusesCount(data) {

        console.log('***********' + data);
        json_data = jQuery.parseJSON(data);

        jobstatus_value_array = [];
        jobstatus_key_array = [];

        jobstatus_rawdata = getJsonKeyValueArray(json_data['jobstatuses_count']);
        jobstatus_value_array = jobstatus_rawdata['valuearray'];
        jobstatus_key_array = jobstatus_rawdata['keyarray'];

        console.log('VALUE ARRAY  : ' + jobstatus_value_array);
        console.log('keyarray ARRAY  : ' + jobstatus_key_array);

        //document.getElementById("job_statuses_servicecall_count").innerHTML =jobstatus_key_array;


        $('#job_statuses_servicecall_count_table tr').slice(1).remove();

        var arrayLength = jobstatus_value_array.length;
        //var theTable = document.createElement('table');
        var theTable = document.getElementById('job_statuses_servicecall_count_table');


// Note, don't forget the var keyword!
        for (var i = 0, tr, td; i < arrayLength; i++) {
            tr = document.createElement('tr');

            td = document.createElement('td');
            //td.style.backgroundColor = '#C9E0ED';
            td.style.border = '2px solid white';
            var mysstatus=jobstatus_key_array[i];

            var mydiv=document.createElement('div');
            mydiv.innerHTML=mysstatus;
            //td.appendChild(document.createTextNode(jobstatus_key_array[i]));

            var a=document.createElement('a');
            a.appendChild(mydiv);
            a.title = "Open";
            a.href = "index.php?r=servicecall/admin";


            td.appendChild(a);



            tr.appendChild(td);

            td = document.createElement('td');
            //td.style.backgroundColor = '#C9E0ED';
            td.style.border = '2px solid white';
            td.appendChild(document.createTextNode(jobstatus_value_array[i]));
            tr.appendChild(td);

            theTable.appendChild(tr);

        }///end of for

//document.getElementById('job_statuses_servicecall_count').appendChild(theTable);


    }////end of displayJobStatusesCount

</script>

 