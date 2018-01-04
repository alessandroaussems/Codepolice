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
<h1>C<img class="inside" src="favico.png" alt="Logo Codepolice">deP<img class="inside" src="favico.png" alt="Logo Codepolice">lice</h1>
<div id="loader" class="nodisplay">
    <span class="loader"><span class="loader-inner"></span></span>
</div>
<textarea name="code" id="code" rows="15" placeholder="Enter code here!"></textarea>
<input type="text" id="repo"  placeholder="Enter Githubrepo URL here! If you want to count the forks it has.">
<button id="go" onclick="CheckTheCode()">Check the code!</button>
<div class="alert nodisplay git">
    <p id="responsetextgitrepo"></p>
</div>
<div class="alert nodisplay git">
    <p id="responsetextgitfork"></p>
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
    function CheckTheCode()
    {
        HideInputField();
        var code= textfield.value;
        var repoURL= inputfield.value;
        $.ajax({
            type: "POST",
            url: './checkcode.php',
            data: {codetocheck: code, urltocheck: repoURL.replace("https://github.com/", "")},
            success: function(response) {
                console.log(response);
                var RESPONSE=JSON.parse(response);
                ShowResponseText("Your code hass occurences in "+RESPONSE[0]+" Github repositories.<br>","gitrepo");
                if (RESPONSE[1]!="ZERO")
                {
                    ShowResponseText("Your code repository has "+RESPONSE[1]+" forks","gitfork");
                }
                ShowResponseText("Your code has occurences in "+RESPONSE[2]+" Stack questions.<br>","stack");
                MakePageReadyForReload();
            }
        })
    }
    function ShowResponseText(texttodisplay,sort)
    {
        loader.classList.add("nodisplay"); //remove loaderanimation from the page
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
        if(sort=="stack")
        {
            var responsetext=document.getElementById("responsetextstack");
            responsetext.innerHTML=texttodisplay;
            document.getElementsByClassName("alert")[2].classList.remove("nodisplay"); //
        }
    }
    function HideInputField()
    {
        textfield.classList.add("nodisplay");
        inputfield.classList.add("nodisplay");
        button.classList.add("nodisplay");
        loader.classList.remove("nodisplay");
    }
    function MakePageReadyForReload()
    {
        document.getElementById("restart").classList.remove("nodisplay");
    }
</script>
</body>
</html>