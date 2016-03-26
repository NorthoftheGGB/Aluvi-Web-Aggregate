<?php
$nametitle = ucwords($context);
$transit_options = array('carpool', 'vanpool', 'bicycle', 'walking', 'public_transportation', 'commuter_bus');

switch ($context) {
    case "fico":
        $mainpage_blurb = "Enter the following details to find <br>commute options in your area!";    
        $offices = array("San Rafael", "San Jose");
        $transit_options = array('carpool', 'vanpool', 'bicycle', 'walking', 'public_transportation', 'commuter_bus');
        break;
    case "verifone":
        $mainpage_blurb = "Discover alternative transportation options based on your<br> commute preferences and help the HR and facilities team(s) <br> develop incentives around new modes of transportation";    
        $offices = array("San Jose");
        $logo_width = 321;
        break;
    case "cityofsanrafael":
    case "sanrafael":
        $mainpage_blurb = "Discover alternative transportation options based on your commute preferences and help the HR and facilities team(s) develop incentives around new modes of transportation";    
        $nametitle = "San Rafael";
        $context = "sanrafael";
        $offices = array("San Rafael City Hall");
        $logo_width = 144;
        break;
    case "biomarin":
        $nametitle = "BioMarin";
        $mainpage_blurb = "Discover alternative transportation options based on your commute preferences and help the HR and facilities team(s) develop incentives around new modes of transportation";    
        $offices = array("San Rafael", "Novato (Bel Marin Keys)", "Novato (Wood Hollow Drive)", "Brisbane");
        $logo_width = 506;
        break;
}


/*

case "":
        $mainpage_blurb = "";    
        $offices = array();
        $transit_options = array('carpool', 'vanpool', 'bicycle', 'walking', 'public_transportation', 'commuter_bus');
        break;

*/

?>