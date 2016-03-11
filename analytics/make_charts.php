<?php
function addChart($element, $type, $title, $data, $options='', $data_header = "['','']"){
foreach ($data as $k => $v){
	$data_fmt[] = "['$k', $v]";
}
$data_fmt = implode(",", $data_fmt);
if ($options)
	$options = ", $options";
echo
"
        data = google.visualization.arrayToDataTable([
          $data_header,
	  $data_fmt
        ]);
        options = {
	  backgroundColor: '#c6eeec',
          title: '$title'$options
        };
        chart = new google.visualization.$type(document.getElementById('$element'));
        chart.draw(data, options);
";
}

   