<?php
//INITIATING RESPONSEARRAY
$RESPONSE=[];
// COUNT FILES IN ARCHIVE
$directory = "archive/";
$filecount = 0;
$files = glob($directory . "*");
if ($files){
    $filesinarchive = count($files);
}
//CALL API FUNCTION
function callAnAPI($url,$iszipped)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    // SETTING USER AGENT BECAUSE GITHUB API SECURITY
    curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
    if($iszipped)
    {
        curl_setopt($ch, CURLOPT_ENCODING , "gzip");
    }
    $responseJson = curl_exec($ch);
    curl_close($ch);
    return $responseJson;
}
//////////////////////////////////////////////////////////////////GITHUB CALLING BELOW///////////////////////////////////////////////////////////////
$ACCESTOKEN_GIT=file_get_contents("./oauthcode_git.txt");
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
        $forks = json_decode(callAnAPI($repourl,false));

        $repopullsurl="https://api.github.com/repos/".$theurltocheck."/pulls?state=all";
        $pulls=json_decode(callAnAPI($repopullsurl,false));
        //COUNTING FORKS AND ADDING THEM TO RESPONSEARRAY
        $RESPONSE["forks"]=count($forks);
        $RESPONSE["pulls"]=count($pulls);
    }
    else
    {
        $RESPONSE["forks"]=0;
        $RESPONSE["pulls"]=0;
    }
    //URL TO CALL GITHUB API
    $urlgit = 'https://api.github.com/search/code?q='.urlencode($thecodetocheck).'&access_token='.$ACCESTOKEN_GIT;
    //GET FINAL JSON RESPONSE OF GITHUB REPOS
    $responsegit = json_decode(callAnAPI($urlgit,false));
    //COUNT NUMBER OF GITHUBREPOS
    $NUMBERGITHUBREPOS=$responsegit->total_count;
    //ADDING GITHUB REPOS TO RESPONSEARRAY
    $RESPONSE["repos"]=$NUMBERGITHUBREPOS;


//////////////////////////////////////////////////////////////STACKEXCHANGE CALLING BELOW/////////////////////////////////////////////////////////////
    $ACCESTOKEN_STACK=file_get_contents("./oauthcode_stack.txt");
    $STACK_QUESTIONS=[];
    $NUMBEROFQUESTIONS=0;
    $page=1;
    do
    {
        //URL TO CALL STACK API
        $urlstack = 'http://api.stackexchange.com/2.2/search/advanced?order=desc&sort=activity&q='.urlencode($thecodetocheck).'&pagesize=100&page='.$page.'&site=stackoverflow&key='.$ACCESTOKEN_STACK;
        //GET FINAL JSON RESPONSE OF STACK QUESTIONS
        $stackquestions = json_decode(callAnAPI($urlstack,true));
        //ADD ALL STACKQUESTIONS URL'S TO ARRAY
        for($i=0;$i<count($stackquestions->items);$i++)
        {
            array_push($STACK_QUESTIONS, $stackquestions->items[$i]->user_id);
        }
        $page++;
    }while($stackquestions->has_more=="true");

    //COUNT NUMBER OF STACKQUESTIONS
    $NUMBEROFQUESTIONS=count($STACK_QUESTIONS);
    //ADDING GITHUB REPOS TO RESPONSEARRAY
    $RESPONSE["questions"]=$NUMBEROFQUESTIONS;
    //////////////////////////////////////////////////////////////COMPARING WITH ARCHIVE  BELOW/////////////////////////////////////////////////////////////
    $SIMILARITYARRAY=[];
    $numberoffile=$filesinarchive+=1;
    $newarchivefile= fopen("archive/archived_".$numberoffile.".txt","w");
    fwrite($newarchivefile, $thecodetocheck);
    for($i=0;$i<$filesinarchive-1;$i++)
    {
        $filebase="archive/archived_".$i.".txt";
        $archivefilecontent=file_get_contents($filebase);
        similar_text($archivefilecontent,$thecodetocheck,$similarity);
        array_push($SIMILARITYARRAY,$similarity);
    }
    $RESPONSE["similarityarray"]=$SIMILARITYARRAY;
    //////////////////////////////////////////////////////////////CALCULATING CHEATVALUE BELOW/////////////////////////////////////////////////////////////
    $CHEATVALUE=0;
    if($RESPONSE["forks"]>5 && $RESPONSE["forks"]<20)
    {
        $CHEATVALUE+=15;
    }
    if($RESPONSE["forks"]>=20 && $RESPONSE["forks"]<50)
    {
        $CHEATVALUE+=20;
    }
    if($RESPONSE["forks"]>=20)
    {
        $CHEATVALUE+=25;
    }
    if($RESPONSE["repos"]>1)
    {
        $CHEATVALUE+=10;
    }
    if($RESPONSE["repos"]>=5 && $RESPONSE["repos"]<20)
    {
        $CHEATVALUE+=20;
    }
    if($RESPONSE["repos"]>=20)
    {
        $CHEATVALUE+=30;
    }
    if($RESPONSE["pulls"]>=1)
    {
        $CHEATVALUE+=20;
    }
    if($RESPONSE["pulls"]>=5)
    {
        $CHEATVALUE+=10;
    }
    $RESPONSE["cheatvalue"]=$CHEATVALUE;

}
// ECHO FINAL RESPONSE
echo json_encode($RESPONSE);