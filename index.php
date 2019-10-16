<?php
$url = "https://www.exchange-rates.org/converter/USD/INR/1/Y";
$html = file_get_contents($url);
$currency = new DOMDocument();
if (!empty($html)) {
    $currency->loadHTML($html);
    libxml_clear_errors(); 
    $currency_xpath = new DOMXPath($currency);

    $conversion = $currency_xpath->query('//span[@id="ctl00_M_lblConversion"]');
    $inverse = $currency_xpath->query('//span[@id="ctl00_M_lblInverseConvertion"]');

    foreach($conversion as $node)
    {
        echo $node->nodeValue;
    }

    foreach($inverse as $node)
    {
        echo $node->nodeValue;
    }
}


?>