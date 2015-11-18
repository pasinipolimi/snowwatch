<?php require_once 'php/header.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <?php include 'php/favicons.php'; ?>
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
            <div class="col-xs-4" style="font-family: Roboto;">
                <h2><?php echo $i18n->translate("MISSION");?></h2>
                <?php echo $i18n->translate("MISSION_DETAIL");?>
            </div>
            <div class="col-xs-4" style="font-family: Roboto;">
                <h2><?php echo $i18n->translate("GOALS");?></h2>
                <?php echo $i18n->translate("GOALS_DETAIL");?>
            </div>
            <div class="col-xs-4">
                <br>
                <br>
                <a class="btn btn-sw btn-lg col-xs-12" href="map.php"><?php echo $i18n->translate("START_EXPLORING");?></a>
                <br>
                <br>
                <br>
                <br>
                <a class="btn btn-sw btn-lg col-xs-12" href="upload.php"><?php echo $i18n->translate("UPLOAD_A_PHOTO");?></a>
            </div>
        </div>
    </div>

    <?php include 'php/footer.php'; ?>

</body>
</html>