<?php
/* header('Content-Type: text/event-stream'); */
// recommended to prevent caching of event data.
//header('Cache-Control: no-cache'); 



$url="https://koch-essen.de/page-sitemap.xml";
$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $url);    // get the url contents

$data = curl_exec($ch); // execute curl request
curl_close($ch);

$p = xml_parser_create();

xml_parse_into_struct($p, $data, $vals, $index);
xml_parser_free($p);

//$xml = simplexml_load_string($data);
print_r($vals[0]['URLSET']);
echo PHP_EOL;
//print_r($index);


 
/* function send_message($id, $message, $progress) {
    $d = array('message' => $message , 'progress' => $progress);
     
    echo "id: $id" . PHP_EOL;
    echo "data: " . json_encode($d) . PHP_EOL;
    echo PHP_EOL;
     
    ob_flush();
    flush();
} */
 
 
//LONG RUNNING TASK
/* for($i = 1; $i <= 10; $i++) {
    send_message($i, 'on iteration ' . $i . ' of 10' , $i*10); 
    print_r($i);
    sleep(1);
}
 
send_message('CLOSE', 'Process complete', 10); */