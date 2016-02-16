<?php
$domsplat = explode('.', $_SERVER['HTTP_HOST']);
if ($domsplat[0] == 'saas'){
    include "demo.html";
}
else include "fico.html";