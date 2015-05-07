<!DOCTYPE html>
<html class="login-bg">
<head>
	<title><?php echo $title;?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
        if(!empty($css)) {
            foreach ($css as $k=>$v) {
                echo '<link type="text/css"  href="'.base_url('source/css/'.$v).'" rel="stylesheet">'."\n";
            }
        }
    ?>
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <?php
        if(!empty($js)){
            foreach ($js as $k=>$v) {
                echo '<script type="text/javascript" src="'.base_url('source/js/'.$v).'"></script>'."\n";
            }
        }
    ?>
    <!-- open sans font -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>
<body>