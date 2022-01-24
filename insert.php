<?php 

    session_start();
    require_once 'config/db.php';

    if(isset($_POST['submit'])) {
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $position = $_POST['position'];
        $img = $_FILES['img'];

        $allow = array('jpg', 'jpeg', 'png');
        $extension = explode(".", $img['name']);  // แยกชื่อกับจุดออก
        $filActExt = strtolower(end($extension)); // แปลงนามสกุล file ให้เป็นตัวเล็ก
        $fileNew = rand() . "." . $fileActExt; // Random ชื่อ file 
        $filePath = "uploads/".$fileNew;

    }