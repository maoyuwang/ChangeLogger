<?php

include_once "Searcher.php";
function card($softwareID, $name, $icon, $description)
{
    $str = <<<EOD
                    
                        <div class="card flex-md-row mb-4 box-shadow h-md-250">
                            <a href="software.php?id=$softwareID"><img class="card-img-right flex-auto d-none d-md-block" src="/img/icons/$icon"
                                 data-holder-rendered="true" style="width: 200px; height: 200px;"></a>
                            <div class="card-body d-flex flex-column align-items-start">
                                <a href="software.php?id=$softwareID"><h3 class="mb-0">$name</h3></a>
                                <p class="card-text mb-auto">$description</p>
                            </div>
                        </div>
                    
EOD;
    return $str;
}

?>


<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <title>Album example · Bootstrap</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="css/album.css" rel="stylesheet">
</head>

<body>
<header>
    <div class="collapse bg-dark" id="navbarHeader">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-md-7 py-4">
                    <h4 class="text-white">About</h4>
                    <p class="text-muted">ChangeLogger is a webiste for tracking software changelogs. Allows users
                        to subscribe changes for their favourite software.</p>
                </div>
                <div class="col-sm-4 offset-md-1 py-4">
                    <h4 class="text-white">Contact</h4>
                    <ul class="list-unstyled">
                        <li><a href="https://github.com/maoyuwang/ChangeLogger" class="text-white">Github</a></li>
                        <!-- <li><a href="#" class="text-white">Like on Facebook</a></li>
                        <li><a href="#" class="text-white">Email me</a></li> -->
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="navbar navbar-dark bg-dark shadow-sm">
        <div class="container d-flex justify-content-between">
            <a href="#" class="navbar-brand d-flex align-items-center">
                <strong>ChangeLogger</strong>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHeader"
                    aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </div>
</header>

<main role="main">

    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row">

                <div class="col-md-12">

                    <?php
                        $keyword = $_GET['keyword'];
                        $searcher = new Searcher();
                        $results = $searcher->search($keyword);


                        if (count($results) == 0){
                            echo "No results founded.";
                        }

                        for ($i=0;$i<count($results);$i++)
                        {
                            echo card($results[$i]['ID'],$results[$i]['Name'],$results[$i]['Icon'],$results[$i]['Description']);
                        }
                    ?>

                </div>
            </div>

        </div>
    </div>


</main>

<footer class="text-muted">
    <div class="container">
        <p class="float-right">
            <a href="#">Back to top</a>
        </p>
        <p>ChangeLogger is the website for traking popular software changelogs.</p>
        <p>Want to contribute? <a href="https://github.com/maoyuwang/changelogger">Visit the GitHub</a></p>
    </div>
</footer>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="js/vendor/jquery-slim.min.js"><\/script>')</script>
<script src="js/bootstrap.bundle.min.js"
        integrity="sha384-xrRywqdh3PHs8keKZN+8zzc5TX0GRTLCcmivcbNJWm2rs5C8PRhcEn3czEjhAO9o"
        crossorigin="anonymous"></script>

</body>

</html>