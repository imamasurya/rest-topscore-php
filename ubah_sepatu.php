<?php 

$conn = mysqli_connect('localhost', 'root', 'password', 'ci');
if (!$conn) {
    echo 'Error! Gagal menghubungkan ke database: '.mysqli_connect_error();
}

if ($_SERVER['REQUEST_METHOD'] == 'PUT') {

    $id = isset($_SERVER['HTTP_ID']) ? mysqli_real_escape_string($conn, $_SERVER['HTTP_ID']) : '';
    $nama = isset($_SERVER['HTTP_NAMA']) ? mysqli_real_escape_string($conn, $_SERVER['HTTP_NAMA']) : '';
    $harga = isset($_SERVER['HTTP_HARGA']) ? mysqli_real_escape_string($conn, $_SERVER['HTTP_HARGA']) : '';
    $deskripsi = isset($_POST['deskripsi']) ? mysqli_real_escape_string($conn, $_SERVER['HTTP_DESKRIPSI']) : '';

    if (!empty($id)) {
        $sql = "update sepatu set nama = '$nama' OR harga = '$harga' OR deskripsi = '$deskripsi' where id = '$id'";
        $query = mysqli_query($conn, $sql);

        if ($query) {
            $result = array('status' => 'success', 'msg' => 'Data berhasil diubah');
        } else {
            $result = array('status' => 'error', 'msg' => 'Gagal mengubah data');
        }
    } else {
        $result = array('status' => 'error', 'msg' => 'ID tidak didefinisikan');
    }
}

    header('Content-type: application/json');
    echo json_encode($result);

    // menutup koneksi database
    mysqli_close($conn);
?>



