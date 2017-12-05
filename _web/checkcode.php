<?php
$ACCESTOKEN="2d23e0f98ecaf04a6bb8fd13e65b4ca5a3ca96ab";
//if(isset($_POST["codetocheck"]))
//{
    $thecodetocheck="Alessandro Aussems";//$_POST["codetocheck"];
    //URL TO CALL GITHUB API
    $url = 'https://api.github.com/search/code?q='.urlencode($thecodetocheck).'&access_token='.$ACCESTOKEN;
    //DO CURL TO CALL GITHUB API
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    // SETTING USER AGENT BECAUSE GITHUB API SECURITY
    curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
    $responseJson = curl_exec($ch);
    curl_close($ch);
    //GET FINAL JSON RESPONSE
    $response = json_decode($responseJson);
    for($i=0;$i<count($response->items);$i++)
    {
        var_dump($response->items[$i]->repository->full_name);
        echo "<br>";
    }
//}
?>