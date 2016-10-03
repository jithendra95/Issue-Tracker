<?php
require 'connection.php';
$sql="SELECT COUNT(*) FROM conso_plan WHERE PERCENTAGE_DONE='100'";
$sql2="SELECT COUNT(*) FROM conso_plan WHERE PERCENTAGE_DONE <>'100'";
$sql3="SELECT COUNT(*) FROM conso_plan ";
$sql4="SELECT COUNT(*) FROM temp_upload WHERE PERCENTAGE_DONE <> '100' ";
$sql5="SELECT COUNT(*) FROM temp_upload WHERE PERCENTAGE_DONE = '100' ";
$date="SELECT CURDATE() FROM DUAL";
$sql_exception="SELECT A.REF_NO, A.STATUS, A.PROJECT, A.TRACKER, A.SUBJECT, A.ASSIGNED_TO, A.START_DATE, A.DUE_DATE, A.PERCENTAGE_DONE
                FROM conso_plan B,temp_upload A 
                WHERE A.REF_NO=B.REF_NO
                AND   A.STATUS=B.STATUS 
				AND   A.PERCENTAGE_DONE <> '100'";

$sql_exception2="SELECT A.REF_NO, A.STATUS, A.PROJECT, A.TRACKER, A.SUBJECT, A.ASSIGNED_TO, A.START_DATE, A.DUE_DATE, A.PERCENTAGE_DONE
                FROM conso_plan B,temp_upload A 
                WHERE A.REF_NO=B.REF_NO
                AND   A.STATUS=B.STATUS 
				AND   A.PERCENTAGE_DONE = '100'";


$result=mysql_query($sql);
$result2=mysql_query($sql2);
$result3=mysql_query($sql3);
$result4=mysql_query($sql4);
$result5=mysql_query($sql5);
$result_date=mysql_query($date);
$result_exe=mysql_query($sql_exception);
$result_exe2=mysql_query($sql_exception2);


$row=mysql_fetch_array($result);
$row2=mysql_fetch_array($result2);
$row3=mysql_fetch_array($result3);
$row4=mysql_fetch_array($result4);
$row5=mysql_fetch_array($result5);
$row_date=mysql_fetch_array($result_date);
//$row_exe=mysql_fetch_array($result_exe);

$no_exep=0;

$excep_data="<table border='1'>";
$excep_data.="<tr>";
$excep_data.="<th>Redmine No</th>";
$excep_data.="<th>Status</th>";
$excep_data.="<th>Project</th>";
$excep_data.="<th>Tracker</th>";
$excep_data.="<th>Priority</th>";
$excep_data.="<th>Subject</th>";
$excep_data.="<th>Assigned to</th>";
$excep_data.="</tr>";
while($row_exe=mysql_fetch_array($result_exe)){

$excep_data.="<tr style='background-color:#78AB46; color:red;'><td>".$row_exe['REF_NO']."</td>";
$excep_data.="<td>".$row_exe['STATUS']."</td>";
$excep_data.="<td>".$row_exe['PROJECT']."</td>";
$excep_data.="<td>".$row_exe['TRACKER']."</td>";
$excep_data.="<td>Normal</td>";
$excep_data.="<td width='300px'>".$row_exe['SUBJECT']."</td>";
$excep_data.="<td>".$row_exe['ASSIGNED_TO']."</td></tr>";

$no_exep++;
}
$excep_data.="</table>";


/**For 100% Exceptions*/
$no_exep2=0;

$excep_data2="<table border='1'>";
$excep_data2.="<tr>";
$excep_data2.="<th>Redmine No</th>";
$excep_data2.="<th>Status</th>";
$excep_data2.="<th>Project</th>";
$excep_data2.="<th>Tracker</th>";
$excep_data2.="<th>Priority</th>";
$excep_data2.="<th>Subject</th>";
$excep_data2.="<th>Assigned to</th>";
$excep_data2.="</tr>";
while($row_exe2=mysql_fetch_array($result_exe2)){

$excep_data2.="<tr style='background-color:#78AB46; color:red;'><td>".$row_exe2['REF_NO']."</td>";
$excep_data2.="<td>".$row_exe2['STATUS']."</td>";
$excep_data2.="<td>".$row_exe2['PROJECT']."</td>";
$excep_data2.="<td>".$row_exe2['TRACKER']."</td>";
$excep_data2.="<td>Normal</td>";
$excep_data2.="<td width='300px'>".$row_exe2['SUBJECT']."</td>";
$excep_data2.="<td>".$row_exe2['ASSIGNED_TO']."</td></tr>";

$no_exep2++;
}
$excep_data2.="</table>";



$equal_hundred=$row[0];
$not_hundred=$row2[0];
$all_issues=$row3[0];
$today_date=$row_date[0];
$expected_comp=$row4[0];
$expected_comp_100_per=$row5[0];
$excep_comp_per=(($expected_comp-$no_exep)/$expected_comp)*100;
$excep_comp_per2=(($expected_comp_100_per-$no_exep2)/$expected_comp_100_per)*100;














$data=" <script>
     $(function () {
           $('#container').highcharts({
	   chart: {
            type: 'column'
        },
        title: {
            text: 'Browser market shares. January, 2015 to May, 2015'
        },
        subtitle: {
            text: 'Click the columns to view versions. '
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            title: {
                text: 'Total percent market share'
            }

        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                borderWidth: 0,
                dataLabels: {
                    enabled: true,
                    format: '{point.y:.1f}%'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style=\"font-size:11px\">{series.name}</span><br>',
            pointFormat: '<span style=\"color:{point.color}\">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
        },

        series: [{
            name: 'Brands',
            colorByPoint: true,
            data: [{
                name: 'Microsoft Internet Explorer',
                y: 56.33,
                drilldown: 'Microsoft Internet Explorer'
            }, {
                name: 'Chrome',
                y: 24.03,
                drilldown: 'Chrome'
            }, {
                name: 'Firefox',
                y: 10.38,
                drilldown: 'Firefox'
            }, {
                name: 'Safari',
                y: 4.77,
                drilldown: 'Safari'
            }, {
                name: 'Opera',
                y: 0.91,
                drilldown: 'Opera'
            }, {
                name: 'Proprietary or Undetectable',
                y: 0.2,
                drilldown: null
            }]
        }],
        drilldown: {
            series: [{
                name: 'Microsoft Internet Explorer',
                id: 'Microsoft Internet Explorer',
                data: [
                    [
                        'v11.0',
                        24.13
                    ],
                    [
                        'v8.0',
                        17.2
                    ],
                    [
                        'v9.0',
                        8.11
                    ],
                    [
                        'v10.0',
                        5.33
                    ],
                    [
                        'v6.0',
                        1.06
                    ],
                    [
                        'v7.0',
                        0.5
                    ]
                ]
            }, {
                name: 'Chrome',
                id: 'Chrome',
                data: [
                    [
                        'v40.0',
                        5
                    ],
                    [
                        'v41.0',
                        4.32
                    ],
                    [
                        'v42.0',
                        3.68
                    ],
                    [
                        'v39.0',
                        2.96
                    ],
                    [
                        'v36.0',
                        2.53
                    ],
                    [
                        'v43.0',
                        1.45
                    ],
                    [
                        'v31.0',
                        1.24
                    ],
                    [
                        'v35.0',
                        0.85
                    ],
                    [
                        'v38.0',
                        0.6
                    ],
                    [
                        'v32.0',
                        0.55
                    ],
                    [
                        'v37.0',
                        0.38
                    ],
                    [
                        'v33.0',
                        0.19
                    ],
                    [
                        'v34.0',
                        0.14
                    ],
                    [
                        'v30.0',
                        0.14
                    ]
                ]
            }, {
                name: 'Firefox',
                id: 'Firefox',
                data: [
                    [
                        'v35',
                        2.76
                    ],
                    [
                        'v36',
                        2.32
                    ],
                    [
                        'v37',
                        2.31
                    ],
                    [
                        'v34',
                        1.27
                    ],
                    [
                        'v38',
                        1.02
                    ],
                    [
                        'v31',
                        0.33
                    ],
                    [
                        'v33',
                        0.22
                    ],
                    [
                        'v32',
                        0.15
                    ]
                ]
            }, {
                name: 'Safari',
                id: 'Safari',
                data: [
                    [
                        'v8.0',
                        2.56
                    ],
                    [
                        'v7.1',
                        0.77
                    ],
                    [
                        'v5.1',
                        0.42
                    ],
                    [
                        'v5.0',
                        0.3
                    ],
                    [
                        'v6.1',
                        0.29
                    ],
                    [
                        'v7.0',
                        0.26
                    ],
                    [
                        'v6.2',
                        0.17
                    ]
                ]
            }, {
                name: 'Opera',
                id: 'Opera',
                data: [
                    [
                        'v12.x',
                        0.34
                    ],
                    [
                        'v28',
                        0.24
                    ],
                    [
                        'v27',
                        0.17
                    ],
                    [
                        'v29',
                        0.16
                    ]
                ]
            }]
        }
    });
	});</script>";
	
	
	
	
?>