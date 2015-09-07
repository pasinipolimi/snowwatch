
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    

    <title>SnowWatch Portal</title>

    
    <?php include 'php/dependencies/commonsCss.php'; ?>
    <link href="libs/kartik-v-bootstrap-fileinput-9f4e4ef/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    
  </head>

  <body>

    <?php include 'php/navbar.php'; ?>
    
    
    <div class="container swcontainer">

      
      <h1>Upload Your Photo</h1>
      <div class="col-xs-6 col-xs-offset-3">
        <form action="" method="POST" enctype="multipart/form-data" id="form1" >
          <input id="input-21" type="file" accept="image/*" style="width:60%" name="uploadFile" >
          <script>
            
          </script>
        </form>
      </div>
      

    </div><!-- /.container -->

    <?php include 'php/dependencies/commonsJS.php'; ?>
    
    <script src="libs/kartik-v-bootstrap-fileinput-9f4e4ef/js/fileinput.min.js" type="text/javascript"></script>
    <script src="js/upload.js"></script>
    
  </body>
</html>
