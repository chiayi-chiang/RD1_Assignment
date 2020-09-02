<?php
$xmlString = '<employees>
                   <employee EmpType="SalesManager">
                     <lastName>Cashman</lastName>
                     <firstName>Briant</firstName>
                   </employee>
                 </employees>';
$doc = new DOMDocument();
$doc->preserveWhiteSpace=false;
$doc->loadXML($xmlString);
$root = $doc->documentElement;//fined 2
$root->setAttribute("id", "001");

$xpath = new DOMXPath($doc);
$entries = $xpath->query("/employees/employee[1]");// 不管一個或多個都以多個來看待
$entries[0]->setAttribute("id","001");

$entries = $xpath->query("/employees/employee[1]/lastName");// 不管一個或多個都以多個來看待
$entries[0]->nodeValue = "Cashman 2";

$entries = $xpath->query("/employees/employee[1]/@id");// 不管一個或多個都以多個來看待
$entries[0]->nodeValue = "002";

$entries = $xpath->query("/employees/employee[1]/firstName");
$entries[0]->parentNode->removeChild($entries[0]);

header("Content-type: text/xml", true);
echo $doc->saveXML();
?>
