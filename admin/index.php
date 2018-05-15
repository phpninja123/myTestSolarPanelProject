<?php 

@session_start();
if( !isset( $_SESSION['user_id']) ) { 
    echo '<script>window.location="../login.html";</script>';die();
}

require_once('../includes/db_conn.php');
$user_email = $_SESSION['user_email'];
$user_id = $_SESSION['user_id'];

$query = "SELECT * FROM Quotation WHERE UserId = '$user_id' OR EmailID = '$user_email'";
$result = mysqli_query($link, $query);

?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sufee Admin - HTML5 Admin Template</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">

    <link rel="stylesheet" href="assets/css/normalize.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
    <!-- <link rel="stylesheet" href="assets/css/bootstrap-select.less"> -->
    <link rel="stylesheet" href="assets/scss/style.css">
    <link href="assets/css/lib/vector-map/jqvmap.min.css" rel="stylesheet">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->

</head>
<body>


        <!-- Left Panel -->

    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">

            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="./">User Admin</a>
                <a class="navbar-brand hidden" href="./">User Admin</a>                
            </div>

            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a href="#"> <i class="menu-icon fa fa-home"></i>Home </a>
                    </li> 
                    <li>
                        <a href="signout.php"> <i class="menu-icon fa fa-sign-out"></i>Logout </a>
                    </li>                    
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside><!-- /#left-panel -->

    <!-- Left Panel -->

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">   
        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1><?php echo $_SESSION['user_name']; ?>'s Dashboard</h1>
                    </div>
                </div>
            </div>            
        </div>

        <div class="content mt-3">

            <div class="col-sm-12">
                <div class="alert  alert-success alert-dismissible fade show" role="alert">
                   Welcome <?php echo $_SESSION['user_name']; ?>,You have successfully logged in 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>


            <div class="col-sm-12 col-lg-12">
                <table class="table">
                    <thead>
                        <tr>
                            <td>Location</td>
                            <td>Panels</td>
                            <td>Wind Mills</td>
                            <td>Power</td>
                            <td>Total Price</td>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                        if( $result ) {
                            while( $row = mysqli_fetch_assoc($result) ) {
                                $polygon = json_decode($row['Polygon']);
                                echo '<tr>
                                            <td class="poly" data-latlng=\''.json_encode($polygon[0]).'\'>XXXXXXXXXXXXXXX</td>
                                            <td>'.$row['NoOfPanels'].'</td>
                                            <td>'.$row['NoOfWindMills'].'</td>
                                            <td>'.$row['TotalPowerGenerated'].' kWh</td>
                                            <td>'.$row['Total'].'</td>
                                      </tr>';
                            }
                        }
                    ?>
                    </tbody>
                </table>  
            </div>
            <!--/.col-->
        </div> <!-- .content -->
    </div><!-- /#right-panel -->

    <!-- Right Panel -->
    <script src="assets/js/vendor/jquery-2.1.4.min.js"></script>
    <script src="assets/js/main.js"></script>    
    <script src="http://maps.google.com/maps/api/js?sensor=true&key=AIzaSyDRO7xg-rb-NeJDKBVVBziuMa2PRuHaNVU&libraries=geometry,visualization,places&region=es"></script>
    <script>
       window.onload = function(){
            jQuery(".poly").each(function(index, item){
                $this = jQuery(this);
                geocodeLatLng(jQuery(item).data('latlng'), $this)
            });            
        }

        function geocodeLatLng(latlng, $this) {
            latlng.lat = parseFloat(latlng.lat);
            latlng.lng = parseFloat(latlng.lng);
            var geocoder = new google.maps.Geocoder;
            geocoder.geocode({'location': latlng}, function(results, status) {
              if (status === 'OK') {
                if (results[0]) {
                    $this.html(results[0].formatted_address);
                } else {
                  window.alert('No results found');
                }
              } else {
                window.alert('Geocoder failed due to: ' + status);
              }
            });
        }
    </script>

</body>
</html>
