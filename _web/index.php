<!doctype html>
<html lang="en">
<head>
    <link href="https://fonts.googleapis.com/css?family=Arvo" rel="stylesheet">
    <link href="assets/style.css" rel="stylesheet">
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
</head>
<body>
<noscript>
    <p id="errorscript">The CodePolice needs Javascript to be enabled to find cheaters!</p>
</noscript>
<div class="circle nodisplay">
    <p id="textcheat">Cheatvalue:</p>
    <p id="cheatvalue">100%</p>
</div>
<a href="https://github.com/alessandroaussems/Codepolice" title="Fork on Github" target="_blank"><img style="position: absolute; top: 0; left: 0; border: 0;" src="https://camo.githubusercontent.com/567c3a48d796e2fc06ea80409cc9dd82bf714434/68747470733a2f2f73332e616d617a6f6e6177732e636f6d2f6769746875622f726962626f6e732f666f726b6d655f6c6566745f6461726b626c75655f3132313632312e706e67" alt="Fork me on GitHub" title="Fork me on Github" data-canonical-src="https://s3.amazonaws.com/github/ribbons/forkme_left_darkblue_121621.png"></a>
<h1><a href="index.php" title="CodePolice">C<img class="inside" src="assets/favico.png" alt="o" title="o">deP<img class="inside" src="assets/favico.png" alt="o" title="o">lice</a></h1>
<small id="quote">Plagiarism checker</small>
<div id="loadertext" class="nodisplay">
    <h3>We are crawling The Internet to find out if there is a cheater among us!</h3>
    <small>Note: Due to the immense size of The Internet this might take a while...</small>
</div>
<div id="loader" class="nodisplay">
    <span class="loader"><span class="loader-inner"></span></span>
</div>
<p id="error" class="novisibile">Error</p>
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
<a href="javascript:window.location.reload(true)" class="nodisplay" id="restart" title="Search Again">Search Again</a>
<p id="footer">&copy; <?=date("Y");?> <a href="https://alessandroaussems.be/" target="_blank" title="Alessandro Aussems">Alessandro Aussems</a></p>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="assets/codechecker.js"></script>
</body>
</html>