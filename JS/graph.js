function get_graph(arr_val){

 $(function () {
    // Set up the chart
    var chart = new Highcharts.Chart({
        chart: {
            renderTo: 'container',
            type: 'column',
            options3d: {
                enabled: true,
                alpha: 0,
                beta: 0,
                depth: 50,
                viewDistance: 25
            }
        },
        title: {
            text: 'Project Wise Analysis'
        },
        subtitle: {
            text: ' From ".$start_date." To ".$end_date. "'
        },xAxis: {
            type: 'category'
        },
		yAxis: {
            title: {
                text: 'Number of Issues'
            }},
        plotOptions: {
            column: {
                depth: 25
            }
        },
        series: [{
            name: 'Issues',
            colorByPoint: true,
            data: [
			

		
/*
count=0;*/
for(i=0;i<length;i++){
			if(i==0){
			//$graph+="{name:'".$row2['PROJECT']."',y:".$row2[1]."}";
			 {name:arr_val[i].name,y:arr_val[i].number_issues};
			}
			else{
			//$graph+=",{name:'".$row2['PROJECT']."',y:".$row2[1]."}";
			 ,{name:arr_val[i].name+,y:arr_val[i].number_issues};
			}
		    
			}
		
			{name:'TEsr',y:29.9}, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4
			
//$graph+="]
 ]
        }]
    });

    function showValues() {
        $('#alpha-value').html(chart.options.chart.options3d.alpha);
        $('#beta-value').html(chart.options.chart.options3d.beta);
        $('#depth-value').html(chart.options.chart.options3d.depth);
    }

    // Activate the sliders
    $('#sliders input').on('input change', function () {
        chart.options.chart.options3d[this.id] = this.value;
        showValues();
        chart.redraw(false);
    });

    showValues();
});



}