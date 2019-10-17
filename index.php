<?php
header('Content-Type: application/json');
$to =$_REQUEST['to'];
$from =$_REQUEST['from'];
$amt = isset($_REQUEST['amt']) ? $_REQUEST['amt'] : 1;

$res = chkCurrency($to, $from);

if($res){
    if(!empty($to) && !empty($from)){
    $url = "https://www.exchange-rates.org/converter/".$from."/".$to."/".$amt."/Y";

    /**
     * @api {get} currency?to=USD&from=INR&amt=10 Request Currency information
     * @apiName GetCurrency Info
     * @apiGroup Currency
     *
     * @apiParam {from} from Currency Code.
     * @apiParam {to} to Currency Code.
     *
     */

    $html = file_get_contents($url);
    $currency = new DOMDocument();
    if (!empty($html)) {
            $currency->loadHTML($html);
            libxml_clear_errors();
            $currency_xpath = new DOMXPath($currency);

            $conversion = $currency_xpath->query('//span[@id="ctl00_M_lblConversion"]');
            $inverse = $currency_xpath->query('//span[@id="ctl00_M_lblInverseConvertion"]');
            $FromAmount = $currency_xpath->query('//span[@id="ctl00_M_lblFromAmount"]');
            $ToAmount = $currency_xpath->query('//span[@id="ctl00_M_lblToAmount"]');
            $converted_data = [];
            $innverted_data = [];
            $total_amt = [];
            foreach($conversion as $node)
            {
                $conv = $node->nodeValue;
                $ex = explode("=", $conv);
                $converted_data["base"] = $from;
                $converted_data["currency"] = $to;
                $converted_data["numeric"] = (float)substr($ex[1], 0, (strpos($ex[1], "INR")-1));
            }

            foreach($inverse as $node)
            {
                $conv = $node->nodeValue;
                $ex = explode("=", $conv);
                $innverted_data["base"] = $to;
                $innverted_data["currency"] = $from;
                $innverted_data["numeric"] = (float)substr($ex[1], 0, (strpos($ex[1], "INR")-1));
            }

            foreach($FromAmount as $node)
            {
                $conv = $node->nodeValue;
                $total_amt[$from] = array("amt" => $conv);
            }

            foreach($ToAmount as $node)
            {
                $conv = $node->nodeValue;
                $total_amt[$to] = array("amt" => $conv);
            }

            $res_arr = array('date' => date("Y-m-d"), "unit_converted_data" => $converted_data, "unit_inverted_data" => $innverted_data, "total" => $total_amt);
            $response = json_encode($res_arr);
            echo $response;
        }
    }
    else{
        badRequest("parameter missing");
    }
}else{
    badRequest("currency code is incorrect");
}

function chkCurrency($to, $from){
    $res = false;
    $strJsonFileContents = file_get_contents("currency.json");
    $array = json_decode($strJsonFileContents, true);
    $toFound = array_search($to, array_column($array, 'currency_code')); 
    $fromFound = array_search($from, array_column($array, 'currency_code')); 

    if(!empty($fromFound) && !empty($toFound)){
        $res = true;
    }else{
        $res = false;
    }
    return $res;
}

function badRequest($mssg){
    header('HTTP/1.0 400 Bad Request'); 
    $response = json_encode(array("statusCode" => 400,"error" => $mssg));
    echo $response;
}


?>