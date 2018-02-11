<?php


$uri = $_SERVER['REQUEST_URI'];
//echo $uri; // Outputs: URI
$str = split("/", $uri);
//echo $str[2];

if($str[2] == "index.php"){
    $index_active = 'class="active"';
}else if($str[2] == "user.php"){
    $user_active = 'class="active"';
}else{
    $index_active = '';
    $user_active = '';
}



?>

<!DOCTYPE html>
<html>
	<head>
        <meta charset="UTF-8"/>
        <meta http-equiv="refresh" content="1800">
        <link rel="icon" href="./images/icon_barcode_web.png" />
        <title>CSP INVENTORY</title>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <script
            src="https://code.jquery.com/jquery-3.2.1.js"
            integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
            crossorigin="anonymous">

        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery.dataTables.min.js"></script>
        <script src="js/dataTables.bootstrap.min.js"></script>		
        <link rel="stylesheet" href="css/dataTables.bootstrap.min.css" />
    </head>
	<body>
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header"> 
                    <a class="navbar-brand" href="index.php">CSP INVENTORY</a>
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li <?= $index_active ?> >
                          <a href="index.php">ค้นหาสินค้า และจัดการ<span class="sr-only">(current)</span></a>
                      </li>
                      <li <?= $user_active ?> ><a href="user.php">ผู้ใช้งาน</a></li>
                      
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                      <li><a href="#">Link</a></li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION["user_name"]; ?> <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="profile.php">โปรไฟล์</a></li>
                          <li role="separator" class="divider"></li>
                          <li><a href="logout.php">ออกจากระบบ</a></li>
                        </ul>
                      </li>
                    </ul>
                  </div>
            </div>
        </nav>

        <div class="container">
                    
                    
                
        