<!DOCTYPE html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta charset="utf-8">
<title></title>
<meta name="description" content="">
<meta name="author" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="">
<!--[if lt IE 9]>
<script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->


<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">




</head>
<body>
	


<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <pre>
<?php

require 'WpPostGrabber.php';
















//$url = 'http://pwdcdev.com/myriadcore/blog/wp-json/wp/v2/posts';
//$url = 'https://phillipswdc.com/wp-json/wp/v2/posts';

$get_post = new WpPostGrabber();

$get_post->url = 'http://pwdcdev.com/myriadcore/blog/wp-json/wp/v2/posts';

$get_post->post_number = 1;

$v = $get_post->postObject();

var_dump( $v );

/*
$json_data = wp_api_curl( $url );




$json_data = $json_data[0];

echo $json_data->date;

echo '<br />';

//convert the date to requested format
$d=strtotime( $json_data->date );
echo date("d M Y ", $d) . "<br>";

echo '<br />';

echo $json_data->excerpt->rendered;

echo '<br />';
//get image
echo get_featured_image( $json_data );


*/







?>
            </pre>
        </div>
    </div>
</div>






<!-- SCRIPTS -->
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
<link rel="shortcut icon" href="">
</body>
</html>


