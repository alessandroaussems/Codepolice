<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Arvo" rel="stylesheet">
    <title>Codepolice V0.1</title>
    <style>
        body
        {
            font-family: 'Arvo', serif;
            background: #0000FF;
        }
        h1
        {
            font-weight: bold;
            width: 100%;
            text-align: center;
        }
        textarea
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
        *::placeholder {
            color: black;
        }
        *:focus {
            outline: none;
        }
        #go
        {
            font-family: 'Arvo', serif;
            width: 10%;
            display: block;
            margin: 0 auto;
            border: 5px solid #FE0000;
            padding: 5px;
            background-color: #FE0000;
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
            background-color: #24292E;
            color: white;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
<h1>Codepolice</h1>
<div id="loader" class="nodisplay">
    <span class="loader"><span class="loader-inner"></span></span>
</div>
<textarea name="code" id="code" rows="15" placeholder="Enter code here!"></textarea>
<button id="go" onclick="CheckTheCode()">Check the code!</button>
<div class="alert nodisplay">
    <p id="responsetext"></p>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    var textfield=document.getElementById("code");
    var button=document.getElementById("go");
    var loader=document.getElementById("loader");
    function CheckTheCode()
    {
        HideInputField();
        var code= document.getElementById("code").value;
        $.ajax({
            type: "POST",
            url: './checkcode.php',
            data: {codetocheck: code},
            success: function(response) {
                var githubrepos=JSON.parse(response);
                ShowResponseText("Your code hass occurences in "+githubrepos+" Github repositories.")
            }
        })
    }
    function ShowResponseText($texttodisplay)
    {
        loader.classList.add("nodisplay"); //remove loaderanimation from the page
        var responsetext=document.getElementById("responsetext");
        responsetext.innerHTML=$texttodisplay;
        document.getElementsByClassName("alert")[0].classList.remove("nodisplay"); //
    }
    function HideInputField()
    {
        textfield.classList.add("nodisplay");
        button.classList.add("nodisplay");
        loader.classList.remove("nodisplay");
    }
    function ShowInputField()
    {
        textfield.classList.remove("nodisplay");
        button.classList.remove("nodisplay");
    }
</script>
</body>
</html>