<?php
/* header('Content-Type: text/event-stream'); */
// recommended to prevent caching of event data.
header('Cache-Control: no-cache'); 

$rp = file_get_contents('php://input', true);
echo $rp;
 
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