# Codepolice
Opdracht Web Research Periode 2 Proof Of Concept.
### 21/11/2017
- Goedkeuring idee
- Opzetten developmentarea
- Meerdere bronnen bekijken: (die code vergelijken)
	* http://strikeplagiarism.com/en/
	* https://github.com/jplag/jplag
	* https://www.quora.com/Are-there-any-tools-to-check-how-similar-two-source-codes-are
	* https://www.jetbrains.com/help/phpstorm/code-sniffer.html
- Search Code on Github
    * https://help.github.com/articles/searching-code/
- Github API
    * https://developer.github.com/v3/
- Finding Resemblance in code trough github:
![](_screenshots/git_code_resemblance.PNG)
![](_screenshots/git_codefinding_2.PNG)
### 28/11/2017
- Code terugvinden op het internet
    * https://searchcode.com/
- Github API aanspreken om zo code terug te vinden in verschillende repo's?
- Probleem:
![](_screenshots/git_api_searchproblem.PNG)
- Documentatie hierover:
    * https://libraries.io/github/ainthek/git-search
    * https://help.github.com/articles/about-searching-on-github/
    * https://news.ycombinator.com/item?id=12439499
    * https://github.com/octokit/octokit.rb/issues/380
    * https://developer.github.com/changes/2013-10-18-new-code-search-requirements/
    * https://stackoverflow.com/questions/28402926/using-github-search-api-without-specifying-the-repository-or-organization
- Andere interessante bronnen:
    * https://code.google.com/
    * https://github.com/google/codesearch
    * https://about.sourcegraph.com/
    * http://opensearch.krugle.org/
    * https://developer.atlassian.com/bitbucket/api/2/reference/resource/snippets
- Google Search Code had een handige geweest MAAR! Is opgeheven :pensive:
    * https://nl.wikipedia.org/wiki/Google_Code_Search
- Toevoegen eerste versie idee in klad
![](_idee/idee_note_v1.jpg)
### 5/12/2017
- Uitproberen GithubAPI
- Aanmaken Accestokens voor API (Anders kan er niet gezocht worden)
- Problemen met UserAgent Header in APi
- Probleem met UserAgent opgelost 
    * https://davidwalsh.name/set-user-agent-php-curl-spoof
- Checkcode.php laat nu alle repositories zien waar de zoekterm in terug komt .
- Per ongeluk OAuth Meegecommit
![](_screenshots/git_oauthincommit.PNG)
- Basic CSS Added
- Ajaxcall returned nu een lijst van repo's waar de code in wordt gevonden
- OAuthCode in aparte textfile gestoken en deze in de .gitignore gestoken zodat deze niet mee wordt gecommit.
### 6/12/2017
- Loadinganimation toegevoegd wanneer er word gezocht.
- Sleep in checkcodescript zodat het lijkt dat de applicatie zeer hard werkt :tongue:
