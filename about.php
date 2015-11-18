<?php require_once 'php/header.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <?php include 'php/favicons.php'; ?>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SnowWatch Portal</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:500,700" rel="stylesheet" type="text/css">
    <link href="dist/css/snowwatch.min.css" rel="stylesheet">
    <?php 
    include 'php/dependencies/commonsCss.php';
    require_once("php/client_translator.php");
    ?>
    
    <script>
        var lang="<?php echo $i18n->getAppliedLang();?>"
    </script>

    <?php 
    include 'php/dependencies/commonsJS.php';
    ?>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
    <?php include 'php/navbar_header.php'; ?>
    <?php include 'php/navbar_menu_dark.php'; ?>
    <script>$("#aboutpage").addClass("active");</script>

    <img class="sw-about-jumbotron" src="dist/img/background-home2.jpg" style="margin-top:-50px !important;     height: inherit !important">
    <div class="container">
        <div class="row">
            <div class="col-xs-6">
                <h2><?php echo $i18n->translate("MISSION2");?></h2>
                <?php echo $i18n->translate("MISSION_LNG");?>
            </div>
            <div class="col-xs-6">
                <h2><?php echo $i18n->translate("PROJECT");?></h2>
                <?php echo $i18n->translate("PROJECT_LNG");?>            
                <h2><?php echo $i18n->translate("CHEST");?></h2>
                <?php echo $i18n->translate("CHEST_LNG");?>
            </div>
        </div>
    </div>
    
    <?php include 'php/footer.php'; ?>
</body>

</html>


