<?php
include_once 'Homepage.php';
$homepage = new Homepage();

function card($softwareID,$icon, $softwareName, $description)
{
    $description = substr($description,0,128);
    $str = <<<EOD
<div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                            <a href="software.php?id=$softwareID"><img class="card-img-right flex-auto d-none d-md-block" src="img/icons/$icon" style="width: auto; height: auto;"></a>
                        <div class="card-body">
                            <h3>$softwareName</h3>
                            <p class="card-text">$description</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <a href="software.php?id=$softwareID"><button type="button" class="btn btn-sm btn-outline-secondary">View</button></a>
                                </div>
                            </div>
                        </div>
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
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>ChangeLogger</title>
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
                    <h4 class="text-white">About</h4>
                    <p class="text-muted">ChangeLogger is a website for tracking software changelogs. Allows users
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
            <a href="/" class="navbar-brand d-flex align-items-center">
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

    <section class="jumbotron text-center">
        <div class="container">
            <h1 class="jumbotron-heading">ChangeLogger</h1>
            <p class="lead text-muted">ChangeLogger is a website for tracking popular software changelogs. Allows users
                to subscribe changes for their favourite software.</p>
            <p>
                <a href="https://github.com/maoyuwang/changelogger" class="btn btn-primary my-2">GitHub</a>
                <button data-toggle="modal"
                   data-target="#SearchModel" class="btn btn-secondary my-2">Search</button>
            </p>
        </div>
    </section>

    <div class="album py-5 bg-light">
        <div class="container">

            <div class="row">
                <?php
                    $allSoftware = $homepage->getAllSupportedSoftware();
                    for ($i = 0; $i < count($allSoftware);$i++)
                    {
                        echo card($allSoftware[$i]['ID'],$allSoftware[$i]['Icon'],$allSoftware[$i]['Name'],$allSoftware[$i]['Description']);
                    }
                ?>

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

<!-- Email Modal -->
<div class="modal fade" id="SearchModel" tabindex="-1" role="dialog" aria-labelledby="SearchModelLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form target="_blank" action="/search.php">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="SearchModelLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="InputKeyword">Keyword</label>
                    <input name="keyword" class="form-control" id="InputKeyword" placeholder="Enter keyword to start search.">
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </div>>
        </form>
        </div>
    </div>
</div>