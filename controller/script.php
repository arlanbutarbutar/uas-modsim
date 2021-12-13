<?php if(!isset($_SESSION[''])){session_start();}
  // require_once("db_connect.php");
  // require_once("functions.php");

  // for your information!!
  // file db_connect.php dan functions.php berada di satu folder yang sama dengan script.php
  // file db_connect.php berfungsi untuk menghubungkan atau koneksi data dari web ke database
  // file functions.php berfungsi sebagai sebuah code system kamu untuk bisa melakukan CRUD dan manipulasi data
  // Jika kamu bingung silakan kirim pesan kepada kami di support@net-code.tech

  // Silakan menambahkan dibawah untuk melanjutkan project kamu
  // if(isset($_POST['hitung1'])){
  //   $_SESSION['start_year']=$_POST['tahun1'];
  //   $_SESSION['end_year']=$_POST['tahun2'];
  //   $_SESSION['komputer']=$_POST['komputer'];
  //   $_SESSION['table1']=1;
  // }
  if(isset($_POST['clear'])){
    $_SESSION = [];
    session_unset();
    session_destroy();
    header("Location: home"); exit;
  }