<?php
$RESPONSE=[];
//INITIATING RESPONSEARRAY
function callAnAPI($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    // SETTING USER AGENT BECAUSE GITHUB API SECURITY
    curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
    $responseJson = curl_exec($ch);
    curl_close($ch);
    return $responseJson;
}
//////////////////////////////////////////////////////////////////GITHUB CALLING BELOW///////////////////////////////////////////////////////////////
$ACCESTOKEN_GIT=file_get_contents("./oauthcode_git.txt");
$GITHUB_REPOS=[];
$NUMBERGITHUBREPOS=0;
if(isset($_POST["codetocheck"]))
{
    $thecodetocheck=$_POST["codetocheck"];
    $theurltocheck=$_POST["urltocheck"];
    if($theurltocheck!="")
    {
        //URL FOR GITHUB FORKS
        $repourl= "https://api.github.com/repos/".$theurltocheck."/forks";
        //GET FINAL JSON RESPONSE OF FORKS
        $forks = json_decode(callAnAPI($repourl));
        //COUNTING FORKS AND ADDING THEM TO RESPONSEARRAY
        $RESPONSE[1]=count($forks);
    }
    else
    {
        $RESPONSE[1]="ZERO";
    }
    //URL TO CALL GITHUB API
    $url = 'https://api.github.com/search/code?q='.urlencode($thecodetocheck).'&access_token='.$ACCESTOKEN_GIT;
    //GET FINAL JSON RESPONSE OF GITHUB REPOS
    $responsegithuburls = json_decode(callAnAPI($url));
    //ADD ALL GITHUBREPOS URL'S TO ARRAY
    for($i=0;$i<count($responsegithuburls->items);$i++)
    {
        array_push($GITHUB_REPOS, $responsegithuburls->items[$i]->repository->full_name);
    }
    //COUNT NUMBER OF GITHUBREPOS
    $NUMBERGITHUBREPOS=count($GITHUB_REPOS);
    //ADDING GITHUB REPOS TO RESPONSEARRAY
    $RESPONSE[0]=$NUMBERGITHUBREPOS;

}
//////////////////////////////////////////////////////////////STACKEXCHANGE CALLING BELOW/////////////////////////////////////////////////////////////



















// ECHO FINAL RESPONSE
echo json_encode($RESPONSE);
?>