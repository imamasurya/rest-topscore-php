<?php

// koneksi ke database
require_once './conn.php';

if (isset($_GET['id'])) {
    // 
    // menampilkan data tertentu saja
    //
    
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    // mengecek ketersediaan variabel $id
    if (!empty($id) && $id != '' && is_numeric($id)) {
        $sql = "select * from sepatu where id='$id'";
        $query = mysqli_query($conn, "select * from sepatu where id=$id");


        // mengecek ketersediaan data
        if (mysqli_num_rows($query) < 1) {
            $result = array('status' => 'error', 'msg' => 'Data tidak tersedia');
            header('Content-type: application/json');
            echo json_encode(array('sepatu' => $result));
            exit();
        } else {
            $record = mysqli_fetch_assoc($query);
            $result = array('status' => 'success', 'data' => $record);
            header('Content-type: application/json');
            echo json_encode(array('sepatu' => $result));
        }
    } else { 
        //echo "ID belum didefinisikan";

        $result = array('status' => 'error', 'msg' => 'ID tidak dikenal dan harus numerik');
        header('Content-type: application/json');
        echo json_encode(array('sepatu' => $result));
    }
} else {
    // 
    // menampilkan seluruh data 
    //

    $query = mysqli_query($conn, "select * from sepatu");
    $data = array();
    while($row = mysqli_fetch_assoc($query)) {
        $data[] = $row;
    }

    $result = array('status' => 'success', 'data' => $data);
    header('Content-type: application/json');
    echo json_encode(array('sepatu' => $result));
}

// tutup koneksi database
mysqli_close($conn);

?>
