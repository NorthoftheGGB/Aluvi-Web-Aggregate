<?php
$domsplat = explode('.', $_SERVER['HTTP_HOST']);
if ($domsplat[0] == 'saas'){
    include "saas.html";
}
else include "fico.html";