<?php
$softwareID = $_GET["id"];
include_once "SoftwareController.php";
include_once "Comments.php";
$software = new Software($softwareID);
$changelogs = $software->getChangelogs();
$latestVersion = $changelogs[0]['Version'];
$comments = new Comments($softwareID);

function stars($num)
{
    $starElement = <<< EOD
<span class="float-right"><i class="text-warning fa fa-star"></i></span>
EOD;
    $result = "";
    for($i = 0;$i<$num;$i++){
        $result = $result . $starElement . "\n";
    }
    return $result;
}

function comment($name,$starNum,$content){
    $starStr = stars($starNum);
    $result = <<< EOD
<li class="media">
    <div class="media-body">
        <strong class="text-success">$name</strong>
        $starStr
        <p>$content</p>
    </div>
</li>
EOD;
    return $result;
}

function changelogCard($version, $time, $detail)
{
    $tag = md5($version . $time);
    $headingID = uniqid();
    $detail = json_decode($detail);

    $detailStr = <<< EOD
        <ul class="list-group">
        EOD;

    for ($i = 0; $i < count($detail); $i++) {
        $detailStr = $detailStr . "<li class=\"list-group-item\">" . htmlspecialchars($detail[$i]) . "</li>";
    }

    $detailStr = $detailStr . "</ul>";

    $str = <<<EOD
        <div class="card">
        <div class="card-header" id="$headingID">
            <h2 class="mb-0">
                <button class="btn btn-link" type="button" data-toggle="collapse"
                    data-target="#$tag" aria-expanded="true" aria-controls="$tag">
                    $version ($time)
                </button>
                
            </h2>
        </div>

        <div id="$tag" class="collapse show" aria-labelledby="$headingID"
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
    <title>ChangeLogger - <?php echo $software->getName(); ?></title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="css/album.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

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

    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-8">

                    <div class="card flex-md-row mb-4 box-shadow h-md-250">
                        <img class="card-img-right flex-auto d-none d-md-block px-md-3"
                             alt="<?php echo $software->getIcon() ?>"
                             src="/img/icons/<?php echo $software->getIcon() ?>"
                             style="height: 225px; width: 50%; display: block;" data-holder-rendered="true">
                        <div class="card-body d-flex flex-column align-items-start">
                            <h3 class="mb-0"><?php echo $software->getName() ?></h3>
                            <div class="mb-1 text-muted"> <?php echo $latestVersion ?> </div>
                            <p class="card-text mb-auto"><?php echo $software->getDescription() ?></p>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button class="btn btn-outline-info btn-block" data-toggle="modal"
                                    data-target="#CommentsModel">User Comments
                            </button>
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
                                    data-target="#EmailModel">Email
                            </button>
                            <button type="button" class="btn btn-success btn-block" data-toggle="modal"
                                    data-target="#PhoneModel">Text
                            </button>
                            <button type="button" class="btn btn-warning btn-block"
                                    onclick="window.open('/feed.php?softwareID=<?php echo $softwareID; ?>')">RSS Feed
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row py-4">
                <div class="col-md-12">
                    <div class="accordion" id="changelogs">
                        <?php
                        $length = count($changelogs);
                        for ($i = 0; $i < $length; $i++) {
                            echo changelogCard($changelogs[$i]['Version'], $changelogs[$i]['Time'], $changelogs[$i]['Detail']);
                        }
                        ?>
                    </div>
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


<!-- Email Modal -->
<div class="modal fade" id="EmailModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Email Subscription</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Email Address</label>
                    <input name="email" type="email" class="form-control" id="InputEmail" aria-describedby="emailHelp"
                           placeholder="Enter email">
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                        else.</small>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="submitEmail()" class="btn btn-primary" data-dismiss="modal">Confirm
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Phone Modal -->
<div class="modal fade" id="PhoneModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">SMS Subscription</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="exampleInputPhone">Phone Number</label>
                    <input name="phone" type="phone" class="form-control" id="InputPhone"
                           placeholder="Enter phone number">
                    <small id="PhoneHelp" class="form-text text-muted">We'll never share your phone number with anyone
                        else.</small>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="submitPhone()" class="btn btn-primary" data-dismiss="modal">Confirm
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Comments Modal -->
<div class="modal fade" id="CommentsModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">User Comments</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">


                <div class="row bootstrap snippets">
                    <div class="col-md-12 col-md-offset-2 col-sm-12">
                        <div class="comment-wrapper">
                            <div class="panel panel-info">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="exampleFormControlSelect1">Comments</label>
                                            <textarea id="content" class="form-control" placeholder="Write a comment..." rows="3"></textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect1">Your name</label>
                                                <input id="user" type="text" class="form-control" placeholder="Your name">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect1">Ratings</label>
                                                <select class="form-control" id="rating">
                                                    <option>5</option>
                                                    <option>4</option>
                                                    <option>3</option>
                                                    <option>2</option>
                                                    <option>1</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <button type="button" onclick="submitComment()" class="btn btn-outline-info pull-right btn-block">Post</button>
                                    <div class="clearfix"></div>
                                    <hr>
                                    <ul class="media-list">
                                        <?php
                                        $allComments = $comments->getComments();
                                        if ($allComments == null)
                                        {
                                            echo "No comments here.";
                                        }
                                        else{
                                            foreach ( $allComments as $commentResult)
                                            {
                                                echo comment($commentResult['User'],$commentResult['Rating'],$commentResult['Comment']);
                                            }
                                        }

                                        ?>

                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>


            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-primary">Close
                </button>
            </div>
        </div>
    </div>
</div>

</html>

<script>

    function submitEmail() {
        var email = document.getElementById('InputEmail').value;


        var url = "/subscribe.php?type=email&softwareID=<?php echo $softwareID;?> &address=" + email;
        console.log(url);
        var httpRequest = new XMLHttpRequest();
        httpRequest.open('GET', url, true);
        httpRequest.send();

        alert("You have subscribed successfully.");

    }

    function submitPhone() {
        var softwareID = <?php echo $softwareID;?>;
        var phone = document.getElementById('InputPhone').value;

        var url = "/subscribe.php?type=phone&softwareID=<?php echo $softwareID;?> &address=" + phone;
        console.log(url);

        var httpRequest = new XMLHttpRequest();
        httpRequest.open('GET', url, true);
        httpRequest.send();
        alert("You have subscribed successfully.");

    }
    
    function submitComment() {
        var content = document.getElementById('content').value;
        var user = document.getElementById('user').value;
        var rating = document.getElementById('rating').value;

        if(content === "" || user === "")
        {
            alert("You must input your comment content and name to submit.");
            return;
        }

        content = encodeURIComponent(content);
        user = encodeURIComponent(user);

        content = content.replace("'","''");
        user =user.replace("'","''");
        let args = "id=<?php echo $softwareID;?>" + "&user=" + user + "&content=" + content + "&rating=" + rating;
        let url = "/comment.php";
        var httpRequest = new XMLHttpRequest();
        httpRequest.open('POST', url, true);
        httpRequest.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        httpRequest.send(args);


        alert("Succeed. Refresh the page to see changes.")
    }
</script>

<style>
    .comment-wrapper .panel-body {
        max-height: 650px;
        overflow: auto;
    }

    .comment-wrapper .media-list .media img {
        width: 64px;
        height: 64px;
        border: 2px solid #e5e7e8;
    }

    .comment-wrapper .media-list .media {
        border-bottom: 1px dashed #efefef;
        margin-bottom: 25px;
    }
</style>