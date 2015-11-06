<?php require_once 'php/header.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SnowWatch Portal</title>
    <?php include 'php/dependencies/commonsCss.php'; ?>
    <?php include 'php/dependencies/commonsJS.php'; ?>


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
    <?php include 'php/navbar_header.php'; ?>
    <?php include 'php/navbar_menu_transparent.php'; ?>


    <img class="sw-homepage-jumbotron" src="dist/img/background-home.jpg">
    <div class="container sw-homepage-content">
        <div class="row">
            <div class="col-xs-4">
                <h2>Mission</h2>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum elementum et erat facilisis consectetur. Aliquam erat volutpat. Maecenas sed mi felis. Ut ornare eros nunc, et sodales eros facilisis nec. Curabitur in fringilla neque, ut interdum neque. Nulla blandit at metus vel faucibus. Nulla ultricies felis non elit mattis, vitae tempus metus finibus. Etiam aliquam, elit ut ultrices ullamcorper, felis sem rhoncus nulla, at tincidunt augue eros sit amet ligula. Suspendisse vel ante porttitor leo gravida consequat. Nulla et eleifend tortor.
            </div>
            <div class="col-xs-4">
                <h2>Goals</h2>
                Phasellus justo turpis, efficitur ac tortor faucibus, euismod consectetur diam. Etiam pretium tortor nec urna scelerisque, vel efficitur justo venenatis. Nunc tincidunt auctor lacus, id tristique diam facilisis sed. Donec viverra tincidunt aliquet. Vestibulum mattis egestas rutrum. Nunc tincidunt convallis lorem, vitae dictum metus imperdiet non. Phasellus elit dolor, porta eu blandit et, dictum quis odio. 
            </div>
            <div class="col-xs-4">
                <br>
                <br>
                <a class="btn btn-sw btn-lg col-xs-12" href="map.php">START EXPLORING</a>
                <br>
                <br>
                <br>
                <br>
                <a class="btn btn-sw btn-lg col-xs-12" href="upload.php">UPLOAD A PHOTO</a>
            </div>
        </div>
    </div>

    <?php include 'php/footer.php'; ?>

</body>
</html>