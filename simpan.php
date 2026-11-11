<?php

session_start();

if (!isset($_SESSION['login'])) {
    header("location: login.php");
    exit;
}


// Mengambil data dari form

$nama = $_POST['Nama'];
$kelas = $_POST['kelas'];
$tanggal = $_POST['tanggal'];
$status= $_POST['status'];
$keterangan= $_POST['keterangan'];


// membersihkan data

$nama = trim($NAMA);
$kelas = trim($kelas);
$keterangan= trim($keterangan);


// jika keterangan kosong

if ($keterangan == "") {
    $keterangan =="-";
}


// membuat format data

$data =
    $tanggal . "|" .
    $nama . "|" . 
    $kelas . "|" . 
    $status . "|" . 
    $keterangan .
    PHP_EOL;


    // menyimpan data 

    file_put_contents(
        "data/absensi.txt",
        $data,
        FILE_APPEND
    );


    // kembali ke data absensi

    header("Location: data_absensi.php?success1");

    exit;

    ?>