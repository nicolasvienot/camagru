<?php

require (__DIR__ . '/../model/socialwall.php');

$res->result = 0;
$res->message = "There was a problem, please try again";

$start_img = $_POST['start_img'];
$gallery = get_images($start_img);

if ($gallery !== 0)
{
    if ($gallery === null)
        $res->result = 2;
    else
        $res->result = 1;
    $res->message = "We got 8 more images";
    $res->gallery = $gallery;
}
$json = json_encode($res);
echo $json;

?>