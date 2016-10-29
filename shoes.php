<?php
$con = mysqli_connect("localhost", "imamas", "password", "ci");
if (!$con) {
    echo "Gagal mengkoneksikan ke database";
}




if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $q = "select * from sepatu where id=$id";
    $query = mysqli_query($con, $q) or die(mysqli_error());
    $result = array();
    $row = mysqli_fetch_array($query);
    $result[] = $row;
    echo json_encode(array('sepatus' => $result));
} else {

$result = array();
$q = "select * from sepatu";
$query = mysqli_query($con, $q) or die(mysqli_error());
while($row = mysqli_fetch_array($query)) {
    $result[] = $row;
}

print_r($result);
echo "\n\n";
echo json_encode(array('sepatu' => $result));
}


//switch($_GET['act']) {
//case 'add':
if ($_POST['submit']) {
    if ($_GET['act']=='add') {
        $nama = $_POST['nama'];
        $harga = (int) $_POST['harga'];
        $deskripsi = $_POST['deskripsi'];

        $query = mysqli_query($con, "insert into sepatu(nama, harga, deskripsi) values($nama, $harga, $deskripsi)");
        if ($query){
            echo "berhasil menambah data";
        } else {
            echo "gagal input";
        }
    }
}
//    break;
//default:
//    echo "coba lagi";
//    break;
//}

?>
