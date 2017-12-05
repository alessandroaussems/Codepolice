<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Codepolice V0.1</title>
</head>
<body>
<h1>Codepolice</h1>
<textarea name="code" rows="15" cols="30" id="code">Enter text here...</textarea>
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
                console.log("Called");
                console.log(response);
            }
        })
    }
</script>
</body>
</html>