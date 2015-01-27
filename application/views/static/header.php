<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menteer</title>
    <link rel="stylesheet" href="/assets/css/bootstrap.css?<?=V?>">
    <link rel="stylesheet" href="/assets/css/all.css?<?=V?>">
</head>
<body>
<div id="wrapper">
    <header id="header">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <nav class="navbar navbar-default" role="navigation">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand" href="/"><img src="/assets/images/logo.png" height="24" width="201" alt="menteer"></a>
                        </div>
                        <div class="collapse navbar-collapse <?=$this->uri->segment(1) == 'auth' ? 'hide' : '';?>" id="navbar-collapse">
                            <ul class="nav navbar-nav navbar-right list-inline <?=$this->uri->segment(1) == 'auth' ? 'hide' : '';?>">

                                <li><a href="/#about" class="menusel">ABOUT</a></li>
                                <li><a href="/#story" class="menusel">STORY</a></li>
                                <li class="hide"><a href="/#menteers">MENTEERS</a></li>
                                <li><a href="/#login" class="menusel">LOG IN</a></li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>