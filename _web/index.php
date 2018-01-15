<!doctype html>
<html lang="en">
<head>
    <link href="https://fonts.googleapis.com/css?family=Arvo" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <meta name="keywords" content="CodePolice,Cheater,Plagiarism,Checker,Code,SearchCode,Copy-Paste"/>
    <meta name="description" content="CodePolice is a website that finds plagiarism in someone's project. Find copy-paste code and unmask the cheaters you always wanted to find!"/>
    <meta name="subject" content="CodePolice: Plagiarism checker">
    <meta name="language" content="EN">
    <meta name="robots" content="index" />
    <meta name="topic" content="CodePolice: Plagiarism checker">
    <meta name="summary" content="CodePolice: Plagiarism checker">
    <meta name="author" content="Alessandro Aussems">
    <meta name="publisher" content="Alessandro Aussems">
    <meta name="url" content="https://codepolice.be">
    <meta name="identifier-URL" content="https://codepolice.be">
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Cache-Control" content="no-cache">

    <meta name="og:title" content="CodePolice: Plagiarism checker"/>
    <meta name="og:site_name" content="CodePolice: Plagiarism checker" />
    <meta property="og:type" content="website" />
    <meta name="og:url" content="http://codepolice.be"/>
    <meta name="og:image" content="http://codepolice.be/assets/logo.png"/>
    <meta name="og:site_name" content="CodePolice"/>
    <meta name="og:description" content="CodePolice is a website that finds plagiarism in someone's project. Find copy-paste code and unmask the cheaters you always wanted to find!"/>


    <meta property="twitter:card" content="summary" />
    <meta property="twitter:title" content="CodePolice: Plagiarism checker" />
    <meta property="twitter:description" content="CodePolice is a website that finds plagiarism in someone's project. Find copy-paste code and unmask the cheaters you always wanted to find!" />
    <meta property="twitter:image" content="http://codepolice.be/assets/logo.png" />
    <meta property="twitter:url" content="http://codepolice.be" />

    <title>CodePolice: Plagiarism checker | V0.1</title>

    <link rel="icon" type="image/png" href="assets/favico.png">
    <link rel="canonical" href="http://codepolice.be" />
    <style>
        body
        {
            overflow-x: hidden;
            font-family: 'Arvo', serif;
            background:rgba(0,0,255,0.75)
        }
        h1
        {
            font-weight: bold;
            width: 100%;
            text-align: center;
        }
        h3, small
        {
            width: 100%;
            text-align: center;
        }
        small
        {
            display: block;
        }
        #error, #errorscript
        {
            width: 50%;
            margin: 0 auto;
            text-align: center;
            background-color: #FE0000;
            color: #FFFFFF;
            padding: 5px;
            margin-bottom: 10px;
        }
        textarea, input
        {
            font-family: 'Arvo', serif;
            width: 50%;
            margin: 0 auto;
            display: block;
            overflow: hidden;
            background-color: transparent;
            border: 3px solid black;
            color: black;
        }
        input
        {
            margin-top: 25px;
            margin-bottom: 50px;
        }
        *::placeholder {
            color: black;
        }
        *:focus {
            outline: none;
        }
        #go, #restart
        {
            font-family: 'Arvo', serif;
            width: 10%;
            display: block;
            margin: 0 auto;
            border: 5px solid #FE0000;
            padding: 5px;
            background-color: #FE0000;
        }
        #restart
        {
            text-decoration: none;
            color:black;
            text-align: center;
        }
        .loader {
            display: inline-block;
            width: 100px;
            height: 100px;
            position: relative;
            border: 4px solid #FE0000;
            top: 50%;
            animation: loader 2s infinite ease;
        }

        .loader-inner {
            vertical-align: top;
            display: inline-block;
            width: 100%;
            background-color: #FE0000;
            animation: loader-inner 2s infinite ease-in;
        }

        @keyframes loader {
            0% {
                transform: rotate(0deg);
            }

            25% {
                transform: rotate(180deg);
            }

            50% {
                transform: rotate(180deg);
            }

            75% {
                transform: rotate(360deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        @keyframes loader-inner {
            0% {
                height: 0%;
            }

            25% {
                height: 0%;
            }

            50% {
                height: 100%;
            }

            75% {
                height: 100%;
            }

            100% {
                height: 0%;
            }
        }
        #loader
        {
            margin-top: 150px;
            height: 100%;
            text-align: center;
        }
        .nodisplay
        {
            display: none !important;
        }
        .alert {
            margin-left: auto;
            margin-right: auto;
            padding: 10px;
            margin-top: 25px;
            width: 50%;
            display: block;
            color: white;
            margin-bottom: 15px;
        }
        .git
        {
            background-color: #24292E;
        }
        .stack
        {
            background-color: #F48024;
        }
        .archive
        {
            background-color: #8A32FF;
        }
        .identical
        {
            background-color: #FF1E8C;
        }
        .inside
        {
            width: 2%;
        }
        .circle:hover
        {
            box-shadow: inset 0 0 0 10px #FFFF00;
        }
        .circle
        {
            right: 2%;
            position: absolute;
            border: 0px solid #FE0000;
            background-color: #FE0000;
            border-radius: 100%;
            width: 225px;
            height: 225px;
            transform: rotate(45deg);
            animation: blink 1s infinite;
        }
        @keyframes blink {
            0%
            {
                box-shadow: inset 0 0 0 10px #FE0000;
            }
            50%
            {
                box-shadow: inset 0 0 0 10px #FFFF00;
            }
            100%
            {
                box-shadow: inset 0 0 0 10px #FE0000;
            }
        }
        .circle > p
        {
            margin-top: 0px;
            margin-bottom: 0px;
        }
        #textcheat
        {
            margin-top: 62.5px;
            text-align: center;
            position: relative;
        }
        .circle > #cheatvalue
        {
            font-size: 4em;
            text-align: center;
            position: relative;
        }
    </style>
</head>
<body>
<noscript>
    <p id="errorscript">The CodePolice needs Javascript to be enabled to find cheaters!</p>
</noscript>
<div class="circle nodisplay">
    <p id="textcheat">Cheatvalue:</p>
    <p id="cheatvalue">100%</p>
</div>
<a href="https://github.com/alessandroaussems/Codepolice" title="Fork on Github" target="_blank"><img style="position: absolute; top: 0; left: 0; border: 0;" src="https://camo.githubusercontent.com/567c3a48d796e2fc06ea80409cc9dd82bf714434/68747470733a2f2f73332e616d617a6f6e6177732e636f6d2f6769746875622f726962626f6e732f666f726b6d655f6c6566745f6461726b626c75655f3132313632312e706e67" alt="Fork me on GitHub" data-canonical-src="https://s3.amazonaws.com/github/ribbons/forkme_left_darkblue_121621.png"></a>
<h1>C<img class="inside" src="assets/favico.png" alt="o">deP<img class="inside" src="assets/favico.png" alt="o">lice</h1>
<div id="loadertext" class="nodisplay">
    <h3>We are crawling The Internet to find out if there is a cheater among us!</h3>
    <small>Note: Due to the immense size of The Internet this might take a while...</small>
</div>
<div id="loader" class="nodisplay">
    <span class="loader"><span class="loader-inner"></span></span>
</div>
<p id="error" class="nodisplay">Error</p>
<textarea name="code" id="code" rows="15" placeholder="Enter code here!"></textarea>
<input type="text" id="repo"  placeholder="Enter Githubrepo URL here! So we can search a bit more thorough">
<button id="go" onclick="CheckTheCode()">Check the code!</button>
<div class="alert nodisplay git">
    <p id="responsetextgitrepo"></p>
</div>
<div class="alert nodisplay git">
    <p id="responsetextgitfork"></p>
</div>
<div class="alert nodisplay git">
    <p id="responsetextgitpull"></p>
</div>
<div class="alert nodisplay stack">
    <p id="responsetextstack"></p>
</div>
<div class="alert nodisplay archive">
    <p id="responsetextarchive"></p>
</div>
<div class="alert nodisplay identical">
    <p id="responsetextidentical"></p>
</div>
<a href="javascript:window.location.reload(true)" class="nodisplay" id="restart">Search Again</a>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    var textfield=document.getElementById("code");
    var inputfield=document.getElementById("repo");
    var button=document.getElementById("go");
    var loader=document.getElementById("loader");
    var loadertext=document.getElementById("loadertext");
    function CheckTheCode()
    {
        var code= textfield.value;
        var repoURL= inputfield.value;
        if(code=="")
        {
            Error("The code field cannot be empty!");
        }
        else if(code.length>128)
        {
            Error("Due to API limitations the code cannot be longer than 128chars");
        }
        else
        {
            ErrorFixed();
            HideInputField();
            $.ajax({
                type: "POST",
                url: './checkcode.php',
                data: {codetocheck: code, urltocheck: repoURL.replace("https://github.com/", "")},
                success: function(response) {
                    var RESPONSE=JSON.parse(response);
                    console.log(RESPONSE);
                    if(RESPONSE["repos"]!=0)
                    {
                        ShowResponseText("Your code hass occurences in "+RESPONSE["repos"]+" Github repositorie(s).<br>","gitrepo");
                    }
                    if(RESPONSE["forks"]!=0)
                    {
                        ShowResponseText("Your code repository has "+RESPONSE["forks"]+" fork(s).","gitfork");
                    }
                    if(RESPONSE["forks"]!=0)
                    {
                        ShowResponseText("Your code repository has "+RESPONSE["pulls"]+" closed pull request(s).","gitpull");
                    }
                    if(RESPONSE["questions"]!=0)
                    {
                        ShowResponseText("Your code has occurences in "+RESPONSE["questions"]+" Stack question(s).<br>","stack");
                    }
                    ShowResponseText("Your code has occurences in "+RESPONSE["avgsimilarity"]+"% of our archive.<br>","archive");
                    if(RESPONSE["identicalfiles"]!=0)
                    {
                        ShowResponseText("Your code looks almost identical with "+RESPONSE["identicalfiles"]+" file(s) of our archive.","identical")
                    }
                    showCheatvalue(RESPONSE["cheatvalue"]);
                    MakePageReadyForReload();
                }
            })
        }
    }
    function ShowResponseText(texttodisplay,sort)
    {
        loader.classList.add("nodisplay"); //remove loaderanimation from the page
        loadertext.classList.add("nodisplay");
        if(sort=="gitrepo")
        {
            var responsetext=document.getElementById("responsetextgitrepo");
            responsetext.innerHTML=texttodisplay;
            document.getElementsByClassName("alert")[0].classList.remove("nodisplay"); //
        }
        if(sort=="gitfork")
        {
            var responsetext=document.getElementById("responsetextgitfork");
            responsetext.innerHTML=texttodisplay;
            document.getElementsByClassName("alert")[1].classList.remove("nodisplay"); //
        }
        if(sort=="gitpull")
        {
            var responsetext=document.getElementById("responsetextgitpull");
            responsetext.innerHTML=texttodisplay;
            document.getElementsByClassName("alert")[2].classList.remove("nodisplay"); //
        }
        if(sort=="stack")
        {
            var responsetext=document.getElementById("responsetextstack");
            responsetext.innerHTML=texttodisplay;
            document.getElementsByClassName("alert")[3].classList.remove("nodisplay"); //
        }
        if(sort=="archive")
        {
            var responsetext=document.getElementById("responsetextarchive");
            responsetext.innerHTML=texttodisplay;
            document.getElementsByClassName("alert")[4].classList.remove("nodisplay"); //
        }
        if(sort=="identical")
        {
            var responsetext=document.getElementById("responsetextidentical");
            responsetext.innerHTML=texttodisplay;
            document.getElementsByClassName("alert")[5].classList.remove("nodisplay"); //
        }
    }
    function HideInputField()
    {
        textfield.classList.add("nodisplay");
        inputfield.classList.add("nodisplay");
        button.classList.add("nodisplay");
        loader.classList.remove("nodisplay");
        loadertext.classList.remove("nodisplay");

    }
    function MakePageReadyForReload()
    {
        document.getElementById("restart").classList.remove("nodisplay");
    }
    function Error(errortext)
    {
        var error=document.getElementById("error");
        error.innerHTML=errortext;
        error.classList.remove("nodisplay");
    }
    function ErrorFixed()
    {
        var error=document.getElementById("error");
        if(!error.classList.contains("nodisplay"))
        {
            error.innerHTML="Error";
            error.classList.add("nodisplay");
        }
    }
    function showCheatvalue(cheatvalue)
    {
        document.getElementsByClassName("circle")[0].classList.remove("nodisplay");
        document.getElementById("cheatvalue").innerHTML=cheatvalue+"%";
    }
</script>
</body>
</html>