<?php
/*
$obj = stdClass();
$a = array("a"=>123, "b"=>234, "c"=>456);
foreach ($a as $key => $value) {
    $obj->$value = $a[$key];
}
$result = array();
$result['data'] = $obj;
echo json_encode(array('sepatu' => $result));
echo "test";
*/
// var_dump($_SERVER['SCRIPT_FILENAME']);
// echo getcwd();
// echo "\n";
// echo $_SERVER['HTTP_HOST'];
// echo "\n";

// echo dirname($_SERVER['REQUEST_URI']);
// echo "\n";
// $upload_path = 'http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['REQUEST_URI']).'/image/';
// echo $upload_path;
// print_r($_FILES($upload_path.'tes.jpg'));

$nama = 'Converst CT Black';
 $img_dir = '/image/';
    $img_path = 'http://'. $_SERVER['HTTP_HOST'] . dirname($_SERVER['REQUEST_URI']).$img_dir;
    $fileinfo = pathinfo($_FILES['image']['nama']);
    $ext = $fileinfo['extension'];
    $path_gambar = getcwd() .  $img_dir . urlencode($nama) . $ext;
    $url_gambar = $img_path . urlencode($nama) . $ext;
echo "-----";
echo $path_gambar;
echo $url_gambar;
?>
