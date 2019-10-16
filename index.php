<?php
header('Content-Type: application/json');
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
        $conv = $node->nodeValue;
        $ex = explode("=", $conv);
        print_r($ex);
    }

    foreach($inverse as $node)
    {
        // echo $node->nodeValue;
    }

    $res_arr = array('base' => 'USD' ,'date' => date("Y-m-d"));
    echo json_encode($res_arr);
}


?>