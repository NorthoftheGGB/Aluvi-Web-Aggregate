<?php
$nametitle_long = $nametitle = ucwords($context);
$transit_options = array('bicycle', 'walking', 'public_transportation', 'carpool', 'vanpool', 'commuter_shuttle',);
$company_email = "$context.com";
switch ($context) {
    case "demo":
    case "saas":
        $context = "demo";
        $nametitle_long = $nametitle = 'Aluvi';
        $mainpage_blurb = "Enter the following details to find <br>commute options in your area!";    
        $offices = array("Santa Rosa", "San Francisco");
        break;
    case "fico":
        $mainpage_blurb = "Discover alternative transportation options based on your commute preferences<br> and assist the team with developing incentives around new transportation modes.";    
        $offices = array("San Rafael", "San Jose");
        $office_coordinates = array("38.0192988,-122.5357758", "37.3685081,-121.9208503");
        break;
    case "verifone":
        $mainpage_blurb = "Discover alternative transportation options based on your commute preferences<br> and assist the team with developing incentives around new transportation modes.";    
        $offices = array("San Jose");
        $logo_width = 321;
        $office_coordinates = array("37.3898649,-121.9356721");
        break;
    case "cityofsanrafael":
    case "sanrafael":
        $mainpage_blurb = "Discover alternative transportation options based on your<br> commute preferences and assist the Ministry of Alternative Commute<br> with developing incentives around new transportation modes.";    
        $nametitle = "San Rafael";
        $nametitle_long = "City of San Rafael";
        $context = "sanrafael";
        $offices = array(
                         "City Hall / Library / Fire Station 51",
                         "Public Works",
                         "San Rafael Community Center",
                         "Terra Linda Community Center / Fire Station 56",
                         "Boro Community Center",
                          "Station 52",
                          "Station 53",
                          "Station 54",
                          "Station 55",
                          "Station 57"
                         );
        $logo_width = 144;
        $company_email = "cityofsanrafael.org";
        $office_coordinates = array("37.974804,-122.5340055", "37.9487859,-122.4909356", "37.969461,-122.5312938", "37.9680326,-122.500214", "37.9706259,-122.5184397", "38.0110237,-122.5422239", "37.9602178,-122.5053148", "37.9833007,-122.4745403", "37.9982179,-122.5312285");
        break;
    case "biomarin":
        $nametitle = "BioMarin";
        $mainpage_blurb = "Discover alternative transportation options based on your commute preferences<br> and assist the team with developing incentives around new transportation modes.";    
        $offices = array("San Rafael", "Novato (Bel Marin Keys)", "Novato (Wood Hollow Drive)", "Brisbane");
        $logo_width = 506;
        $company_email = 'bmrn.com';
        $office_coordinates = array("37.9701771,-122.5278526", "38.1251487,-122.5715787", "38.0720811,-122.5380328", "37.6741399,-122.3878994");
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