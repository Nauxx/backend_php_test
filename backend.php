<?php
header('Content-Type: text/event-stream');
// recommended to prevent caching of event data.
header('Cache-Control: no-cache'); 

set_time_limit(500); // prevent "Fatal Error: Maximum execution time of 120 seconds exceeded"

$url = '';

if(isset($_GET["website"])){

    $url = htmlspecialchars($_GET["website"]);
};

$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $url);    // get the url contents

$data = curl_exec($ch); // execute curl request
curl_close($ch);

$parser = xml_parser_create();

xml_parse_into_struct($parser, $data, $vals, $index);
xml_parser_free($parser);

$filtered = array_filter($vals, function($val){
    return $val['tag'] === 'LOC';
});

$mapped = array_map(function($loc){
    return $loc['value'];
}, $filtered);

$reindexed = array_values($mapped);

function send_message($id, $url='', $current=1, $total=1) {
    $d = array('url'=> $url ,'current' => $current , 'total' => $total);
     
    echo "id: $id" . PHP_EOL;
    echo "data: " . json_encode($d) . PHP_EOL;
    echo PHP_EOL;
     
    ob_flush();
    flush();
}

foreach ($reindexed as $index=>$url) {
    /* send post request to "https://web.archive.org/save/$url" */

    send_message($index, $url, $index+1 , count($reindexed)); 

    usleep(300000);

};


send_message('CLOSE');


 
