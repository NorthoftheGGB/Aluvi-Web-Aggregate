<?php
$domsplat = explode('.', $_SERVER['HTTP_HOST']);
if ($domsplat[0] == 'millvalley'){
    include "millvalley.html";
}
else include "saas.html";