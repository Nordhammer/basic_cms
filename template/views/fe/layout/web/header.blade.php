<!DOCTYPE html>
<html lang="{NATIVE_LANGUAGE}">
    <head>
        <meta charset="utf-8">
        <meta name="theme-color" content="rgb(255,255,255)">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="keywords" content="{CONFIG.KEYWORDS}">
        <meta name="description" content="{CONFIG.DESCRIPTION}">
        <meta name="author" content="{CONFIG.AUTHOR}">
        <meta name="publisher" content="{CONFIG.PUBLISHER}">
        <meta name="copyright" content="{CONFIG.COPYRIGHT}">
        <meta name="robots" content="{CONFIG.ROBOTS}">
        <title>{CONFIG.DOMAIN} | {TITLE} - {CONFIG.WEBTITLE}</title>
        <link href="/css/screen.css" rel="stylesheet">
</head>
<body>
    {WARTUNGSMODUS}
    <nav id="navbar" class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="/start" title="{MENU.ZURUECK_ZU_START}">{MENU.START}</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Menu
        </button>
        <div id="navbarResponsive" class="collapse navbar-collapse">
          <ul class="navbar-nav ml-auto">
            {LOG}
            {WCP}
          </ul>
        </div>
      </div>
    </nav>