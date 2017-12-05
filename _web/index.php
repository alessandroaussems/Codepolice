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
    </style>
</head>
<body>
<h1>Codepolice</h1>
<textarea name="code" id="code" rows="15" placeholder="Enter code here!"></textarea>
<button id="go" onclick="CheckTheCode()">Check the code!</button>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    function CheckTheCode()
    {
        var code= document.getElementById("code").value;
        $.ajax({
            type: "POST",
            url: './checkcode.php',
            data: {codetocheck: code},
            success: function(response) {
                var githubrepos=JSON.parse(response);
                console.log(githubrepos);
            }
        })
    }
</script>
</body>
</html>