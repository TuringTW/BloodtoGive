<!DOCTYPE html>
<?php 
session_start();
require_once('mysql_info.php'); ?>

<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>BloodtoGive熱血樂捐專案</title>
    <link href="./style/css/bootstrap.css" require_onceel="stylesheet">
    <link href="./style/css/bootstrap.min.css" rel="stylesheet">
    <link href="./style/css/bootstrap-fileupload.css" rel="stylesheet">
    <link href="./style/css/jquery-ui.css" rel="stylesheet">
    <link href="./style/css/carousel.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="style/js/bootstrap.min.js"></script>

    <script type="text/javascript">
        (function(i,s,o,g,r,a,m){
            i['GoogleAnalyticsObject']=r;
            i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},
                i[r].l=1*new Date();
                a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];
                a.async=1;
                a.src=g;m.parentNode.insertBefore(a,m)
        })
        (window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-40600426-2', 'auto');
        ga('send', 'pageview');

    </script>
    </head>
    <style type="text/css">
    body {
        padding-top: 50px;
        padding-bottom: 20px;
    }
    </style>
    <body>

        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" >BloodtoGive熱血樂捐</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li <?=($sidebar==1)?'class="active"':''?>><a href="index.php">Home</a></li>
                        <li <?=($sidebar==2)?'class="active"':''?>><a href="About.php">About</a></li>
                        <li <?=($sidebar==3)?'class="active"':''?>><a href="findsite.php">即刻捐血</a></li>
                        <li <?=($sidebar==4)?'class="active"':''?>><a href="diary.php">捐血日誌</a></li>
                        <li <?=($sidebar==5)?'class="active"':''?>><a href="#tip" onclick="alert('建置中XD')">捐血常識</a></li>                        
                        <li <?=($sidebar==6)?'class="active"':''?>><a href="https://github.com/mick90207/BloodToGive">Github</a></li>
                        <li <?=($sidebar==7)?'class="active"':''?>><a href="https://ossonazure.bhuntr.com/index.php">雲端防災大賽</a></li>
                    </ul>
                </div><!--/.navbar-collapse -->
            </div>
        </nav>
