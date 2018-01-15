<?php
//INITIATING RESPONSEARRAY
$RESPONSE=[];
// COUNT FILES IN ARCHIVE
$directory = "archive/";
$filecount = 0;
$files = glob($directory . "*.txt");
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
$ACCESTOKEN_GIT="f2a74b99c9168fe1de0b3ea373ad203b04d98f17";
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

        $repopullsurl="https://api.github.com/repos/".$theurltocheck."/pulls?state=closed";
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
    $ACCESTOKEN_STACK="2NUtnG7HP*0WXQq*1xfMVw(("; //THIS KEY IS JUST FOR HIGHER REQUEST QUOTA IT IS NOT CONSIDERED SECRET
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
    $identicalfiles=[];
    $RESPONSE["filesinarchive"]=$filesinarchive;
    for($i=0;$i<$filesinarchive;$i++)
    {
        $path="archive/";
        $file="archived_".$i.".txt";
        $filebase=$path.$file;
        $archivefilecontent=file_get_contents($filebase);
        similar_text($archivefilecontent,$thecodetocheck,$similarity);
        if($similarity>=70)
        {
            array_push($identicalfiles,$file);
        }
        array_push($SIMILARITYARRAY,$similarity);
    }
    $RESPONSE["avgsimilarity"]=round(array_sum($SIMILARITYARRAY)/count($SIMILARITYARRAY), 2);
    $RESPONSE["similaritarray"]=$SIMILARITYARRAY;
    $RESPONSE["identicalfiles"]=count($identicalfiles);
    //ADDING INPUT TO ARCHIVE
    $numberoffile=$filesinarchive;
    $newarchivefile= fopen("archive/archived_".$numberoffile.".txt","w");
    fwrite($newarchivefile, $thecodetocheck);
    //////////////////////////////////////////////////////////////CALCULATING CHEATVALUE BELOW/////////////////////////////////////////////////////////////
    $CHEATVALUE=0;
    if($RESPONSE["forks"]>5 && $RESPONSE["forks"]<20)
    {
        $CHEATVALUE=$CHEATVALUE+15;
    }
    if($RESPONSE["forks"]>=20 && $RESPONSE["forks"]<50)
    {
        $CHEATVALUE=$CHEATVALUE+20;
    }
    if($RESPONSE["forks"]>=50)
    {
        $CHEATVALUE=$CHEATVALUE+30;
    }
    if($RESPONSE["repos"]>1 && $RESPONSE["repos"]<5)
    {
        $CHEATVALUE=$CHEATVALUE+10;
    }
    if($RESPONSE["repos"]>=5 && $RESPONSE["repos"]<20)
    {
        $CHEATVALUE=$CHEATVALUE+20;
    }
    if($RESPONSE["repos"]>=20)
    {
        $CHEATVALUE=$CHEATVALUE+40;
    }
    if($RESPONSE["pulls"]>=1 && $RESPONSE["pulls"]<5)
    {
        $CHEATVALUE=$CHEATVALUE+20;
    }
    if($RESPONSE["pulls"]>=5)
    {
        $CHEATVALUE=$CHEATVALUE+40;
    }
    if($RESPONSE["avgsimilarity"]>=60 && $RESPONSE["avgsimilarity"]<80)
    {
        $CHEATVALUE=$CHEATVALUE+17;
    }
    if($RESPONSE["avgsimilarity"]>=80)
    {
        $CHEATVALUE=$CHEATVALUE+25;
    }
    if($RESPONSE["identicalfiles"]>=1 && $RESPONSE["identicalfiles"] <5)
    {
        $CHEATVALUE=$CHEATVALUE+20;
    }
    if($CHEATVALUE["identicalfiles"]>=5)
    {
        $CHEATVALUE=$CHEATVALUE+50;
    }
    //CHEATVALUE IS % SO Can't be bigger than 100
    if($CHEATVALUE>100)
    {
        $CHEATVALUE=100;
    }
    $RESPONSE["cheatvalue"]=$CHEATVALUE;

}
// ECHO FINAL RESPONSE
echo json_encode($RESPONSE);