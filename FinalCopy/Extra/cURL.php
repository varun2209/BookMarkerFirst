<?php
// URLs we want to retrieve
$urls = array(
    'http://www.google.com', 
    'http://www.bing.com', 
    'http://www.yahoo.com',
    'http://www.twitter.com',
    'http://www.facebook.com'
);
 
// initialize the multihandler
$mh = curl_multi_init();
 
$channels = array();
foreach ($urls as $key => $url) {
    // initiate individual channel
    $channels[$key] = curl_init();
    curl_setopt_array($channels[$key], array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true
    ));
 
    // add channel to multihandler
    curl_multi_add_handle($mh, $channels[$key]);
}
 
// execute - if there is an active connection then keep looping
$active = null;
do {
    $status = curl_multi_exec($mh, $active);
}
while ($active && $status == CURLM_OK);
 
// echo the content, remove the handlers, then close them
foreach ($channels as $chan) {
    echo curl_multi_getcontent($chan);
    curl_multi_remove_handle($mh, $chan);
    curl_close($chan);
}
 
// close the multihandler
curl_multi_close($mh);
?>