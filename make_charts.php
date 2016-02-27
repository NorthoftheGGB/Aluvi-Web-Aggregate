<?php
function addChart($element, $type, $title, $data, $data_header = "['','']"){
foreach ($data as $k => $v){
	$data_fmt[] = "['$k', $v]";
}
$data_fmt = implode(",", $data_fmt);
echo
"
        data = google.visualization.arrayToDataTable([
          $data_header,
	  $data_fmt
        ]);
        options = {
          title: '$title',
	  legend: { position: 'none' }
        };
        chart = new google.visualization.$type(document.getElementById('$element'));
        chart.draw(data, options);
";
}

   