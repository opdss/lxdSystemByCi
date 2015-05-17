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
    <?php
        if(!empty($js)){
            foreach ($js as $k=>$v) {
                echo '<script type="text/javascript" src="'.base_url('source/js/'.$v).'"></script>'."\n";
            }
        }
    ?>

</head>
<body>