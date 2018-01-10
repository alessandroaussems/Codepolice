<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Arvo" rel="stylesheet">
    <title>Codepolice V0.1</title>
    <link rel="icon"
          type="image/png"
          href="favico.png">
    <style>
        body
        {
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
            padding: 20px;
            margin-top: 50px;
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
        .inside
        {
            width: 2%;
        }
    </style>
</head>
<body>
<noscript>
    <p id="errorscript">The CodePolice needs Javascript to be enabled to find cheaters!</p>
</noscript>
<h1>C<img class="inside" src="favico.png" alt="Logo Codepolice">deP<img class="inside" src="favico.png" alt="Logo Codepolice">lice</h1>
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
                    ShowResponseText("Your code hass occurences in "+RESPONSE["repos"]+" Github repositories.<br>","gitrepo");
                    if(RESPONSE["forks"]!=0)
                    {
                        ShowResponseText("Your code repository has "+RESPONSE["forks"]+" fork(s)","gitfork");
                    }
                    if(RESPONSE["forks"]!=0)
                    {
                        ShowResponseText("Your code repository has "+RESPONSE["pulls"]+" pull request(s)!","gitpull");
                    }
                    ShowResponseText("Your code has occurences in "+RESPONSE["questions"]+" Stack questions.<br>","stack");
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
</script>
</body>
</html>