<?php

require (__DIR__ . '/../model/socialwall.php');

$start_img = 0; 
$gallery = get_images($start_img, 0);

require(__DIR__ . '/../view/welcome.php');

?>