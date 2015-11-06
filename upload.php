<?php 
  require_once 'php/header.php'; 
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SnowWatch Portal</title>
    
    <?php 
    include 'php/dependencies/commonsCss.php';
    include 'php/dependencies/commonsJS.php';
    require_once("php/client_translator.php");
    ?>
    
    <link href="libs/kartik-v-bootstrap-fileinput-9f4e4ef/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
    <script src="libs/kartik-v-bootstrap-fileinput-9f4e4ef/js/fileinput.min.js" type="text/javascript"></script>
    <script src="js/upload.js"></script>
    

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    
  </head>

  <body>

    <?php include 'php/navbar_header.php'; ?>
    <?php include 'php/navbar_menu_dark.php'; ?>
    
    <img class="sw-upload-jumbotron" src="dist/img/background-upload.png">
    
    <div class="container sw-upload-content">
       <div class="col-sm-offset-4">
          <h1><?php echo $i18n->translate("UPLOAD_YOUR_PHOTO");?></h1>
       </div>

    <?php if ($login->isUserLoggedIn() == true) { ?>
  
      <form action="" method="POST" enctype="multipart/form-data" id="form1" >
        <input type="hidden" id="swp_user_id" value="<?php echo $_SESSION['swp_user_id']; ?>" />
        <div class="col-sm-4 col-sm-offset-4">
          <input id="input-21" type="file" accept="image/*" name="uploadFile" >
        </div>
      </form>

    <?php } else{ ?>
    
      <div class='row-centered alert alert-danger col-sm-4 col-sm-offset-4'><span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span> Log in or Sign up to enable this function.</div>
      <form id="form1" >
        <div class="col-sm-4 col-sm-offset-4">
          <input disabled id="input-21" type="file" disabled>
        </div>   
      </form>

    <?php } ?>

        <div class="row col-xs-6 col-xs-offset-6">
            <h2>Picture Requirements</h2>
            <ul>
                <li>25 MB maximum</li>
                <li>jpeg or png</li>
                <li>no faces</li>
            </ul>
        </div>
      
    </div>

    <br>
    <br>
    <br>
    <br>
    <br>

    <?php include 'php/footer.php'; ?>

  </body>
</html>
