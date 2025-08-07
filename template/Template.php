<!DOCTYPE html>
  <!-- ✅ Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  
<html>
    <head>     
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
        
    </head>
    
    <body>
        <div id="header"></div>              
        <div id="topbar"></div>        
        <div id="wrapper">   
            <?php include 'views/Layout/Header.php'; ?>
            <div id="content">    
                <!-- ------------------------------------ -->
                <!-- ------------------------------------ -->
                <!-- BEGIN: Nội dung chính của trang web  -->
                <div id="primary">                    
                    <?php require($VIEW); ?>
                </div>
                <!-- END: Nội dung chính của trang web  -->
                <!-- ------------------------------------ -->
                <!-- ------------------------------------ -->
            </div>            
            <?php include 'views/layout/Footer.php'; ?>
        </div>         
    </body>
</html>