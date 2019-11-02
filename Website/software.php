<?php
    $softwareID = $_GET["id"];
    include_once "SoftwareController.php";
    $software = new Software($softwareID);
    $changelogs = $software->getChangelogs();
    $latestVersion = $changelogs[0]['Version'];


    function changelogCard($version,$time,$detail){
        $tag = md5($version.$time);

        $detailStr= <<< EOD
        <ul class="list-group">
        EOD;

        foreach ($detail as &$log) {
            $detailStr += "<li class=\"list-group-item\">$log</li>";
        }

        $detailStr += "</ul>";

        $str = <<<EOD
        <div class="card">
        <div class="card-header" id="$tag">
            <h2 class="mb-0">
                <button class="btn btn-link" type="button" data-toggle="$tag"
                    data-target="#$tag" aria-expanded="false" aria-controls="$tag">
                    $version
                </button>
                $time
            </h2>
        </div>

        <div id="$tag" class="$tag show" aria-labelledby="headingOne"
            data-parent="#changelogs">
            <div class="card-body">
                $detailStr
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
                    <div class="col-md-8">

                        <div class="card flex-md-row mb-4 box-shadow h-md-250">
                            <img class="card-img-right flex-auto d-none d-md-block" src="img/icons/<?php echo $software->getIcon() ?>" style="width: 200px; height: 200px;">
                            <div class="card-body d-flex flex-column align-items-start">
                                <h3 class="mb-0"><?php echo $software->getName() ?></h3>
                                <div class="mb-1 text-muted"> <?php echo $latestVersion ?> </div>
                                <p class="card-text mb-auto"><?php echo $software->getDescription() ?></p>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-4">
                        
                        <div class="card  box-shadow">
                            <div class="card-header">
                                Subscribe
                            </div>
                            <div class="card-body">
                                <button type="button" class="btn btn-primary btn-block" data-toggle="modal"
                                    data-target="#Email">Email</button>
                                <button type="button" class="btn btn-success btn-block">Text</button>
                                <button type="button" class="btn btn-warning btn-block">RSS Feed</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row py-4">
                    <div class="col-md-12">
                        <div class="accordion" id="changelogs">
                            <?php
                            $length = count($changelogs);
                            for($i = 0; $i < $length;$i++){
                                echo(changelogCard($changelogs[$i]['Version'],$changelogs[$i]['Time'],$changelogs[$i]['Detail']));
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
            <p>Album example is © Bootstrap, but please download and customize it for yourself!</p>
            <p>New to Bootstrap? <a href="https://getbootstrap.com/">Visit the homepage</a> or read our <a
                    href="/docs/4.3/getting-started/introduction/">getting started guide</a>.</p>
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


<!-- Modal -->
<div class="modal fade" id="Email" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

</html>