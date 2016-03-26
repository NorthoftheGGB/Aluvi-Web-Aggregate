<?php
$domsplat = explode('.', $_SERVER['HTTP_HOST']);
$context = $domsplat[0];
if ($context == 'saas'){
    $context = $_GET['context'];
    if (!$context)
        include "demo.html";
    else
        include "index_content.php";
}
else if ($context == 'fico'){
    include "fico.html";
}
else include "index_content.php";