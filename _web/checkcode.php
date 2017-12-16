<?php
$ACCESTOKEN=file_get_contents("./oauthcode.txt");
$GITHUB_REPOS=[];
$NUMBERGITHUBREPOS=0;
if(isset($_POST["codetocheck"]))
{
    $thecodetocheck=$_POST["codetocheck"];
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
    //ADD ALL GITHUB URL'S TO ARRAY
    for($i=0;$i<count($response->items);$i++)
    {
        array_push($GITHUB_REPOS, $response->items[$i]->repository->full_name);
    }
    //COUNT NUMBER OF GITHUBREPOS
    $NUMBERGITHUBREPOS=count($GITHUB_REPOS);


    sleep(10); //ADDING THIS BECAUSE IT HAS TO LOOK LIKE THE APPLICATION IS VERY BUSY!
    echo json_encode($NUMBERGITHUBREPOS);
}
?>