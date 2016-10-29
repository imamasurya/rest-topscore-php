<?php

// Koneksi ke database
require_once './conn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nama = isset($_POST['nama']) ? mysqli_real_escape_string($conn, $_POST['nama']) : '';
    $harga = isset($_POST['harga']) ? (int)$_POST['harga'] : 0;
    $deskripsi = isset($_POST['deskripsi']) ? mysqli_real_escape_string($conn, $_POST['deskripsi']) : '';
    $gambar = isset($_FILES['image']['name']) ?  $_FILES['image']['name'] : '';

    $img_dir = '/image/';
    $img_path = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['REQUEST_URI']) . $img_dir;
    $fileinfo = pathinfo($_FILES['image']['name']);
    $ext = $fileinfo['extension'];
    $path_gambar = getcwd() .  $img_dir . urlencode($nama) . '.' . $ext;
    $url_gambar = $img_path . urlencode($nama) . '.' . $ext;

    try {
            move_uploaded_file($_FILES['image']['tmp_name'], $path_gambar);
            $sql = "insert into sepatu (nama, harga, deskripsi, url_gambar) 
                    values ('$nama', $harga, '$deskripsi', '$url_gambar');";
            $query = mysqli_query($conn, $sql);

            if ($query) {
                $json = array('status' => 'success', 'msg' => 'Data berhasil ditambah!');
            } else {
                $json = array('status' => 'error', 'msg' => 'Error! Gagal menambah data.');
            }

    } catch (Exception $e) {
        $json = array('status' => 'error', 'msg' => 'Gagal upload gambar atau ' . $e->getMessage());
    }
    
} else {
    $json = array('status' => 'error', 'msg' => 'Permintaan tidak diterima.');
}

header('Content-type: application/json');
echo json_encode($json, JSON_PRETTY_PRINT);

// tutup koneksi database
mysqli_close($conn);

?>



