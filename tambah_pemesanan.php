<?php

// Koneksi ke database
require_once './conn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $tgl_pemesanan = date('Y-m-d H:i:s');
    $nama = isset($_POST['nama']) ? mysqli_real_escape_string($conn, $_POST['nama']) : '';
    $email = isset($_POST['email']) ? mysqli_real_escape_string($conn, $_POST['email']) : '';
    $alamat = isset($_POST['alamat']) ? mysqli_real_escape_string($conn, $_POST['alamat']) : '';
    $telp = isset($_POST['telp']) ? mysqli_real_escape_string($conn, $_POST['telp']) : '';
    $sepatu_id = isset($_POST['sepatu_id']) ? (int)$_POST['sepatu_id'] : '';
    $qty = isset($_POST['qty']) ? (int)$_POST['qty'] : 0;


    $sql = "insert into sepatu (tgl_pemesanan, nama_cust, email_cust, alamat_cust, telp, sepatu_id, qty) 
            values ('$tgl_pemesanan', '$nama', '$email', '$alamat', '$telp', $sepatu_id, $qty);";
    $query = mysqli_query($conn, $sql);

    if ($query) {
        $json = array('status' => 'success', 'msg' => 'Data berhasil ditambah!');
    } else {
        $json = array('status' => 'error', 'msg' => 'Error! Gagal menambah data.');
    }
    
} else {
    $json = array('status' => 'error', 'msg' => 'Permintaan tidak diterima.');
}

header('Content-type: application/json');
echo json_encode($json, JSON_PRETTY_PRINT);

// tutup koneksi database
mysqli_close($conn);

?>



