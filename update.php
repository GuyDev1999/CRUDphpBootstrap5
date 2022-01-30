<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php
session_start();
require_once 'config/db.php'; 

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $position = $_POST['position'];
    $img = $_FILES['img'];

    $img2 = $_POST['img2'];
    $upload = $_FILES['img']['name'];

    if ($upload != '') {
        $allow = array('jpg', 'jpeg', 'png');
        $extension = explode(".", $img['name']);  // แยกชื่อกับจุดออก
        $fileActExt = strtolower(end($extension)); // แปลงนามสกุล file ให้เป็นตัวเล็ก
        $fileNew = rand() . "." . $fileActExt; // Random ชื่อ file 
        $filePath = "uploads/".$fileNew;

        if (in_array($fileActExt, $allow)) {
            if ($img['size'] > 0 && $img['error'] == 0) {
                move_uploaded_file($img['tmp_name'], $filePath);
            }
        }
    } else {
        $fileNew = $img2;
    }
    $sql = $conn->prepare("UPDATE users SET firstname = :firstname, 
                            lastname = :lastname, 
                            position = :position, 
                            img = :img 
                            WHERE id = :id");
    $sql->bindParam(":id", $id);
    $sql->bindParam(":firstname", $firstname);
    $sql->bindParam(":lastname", $lastname);
    $sql->bindParam(":position", $position);
    $sql->bindParam(":img", $fileNew);
    $sql->execute();

    if ($sql) {
        $_SESSION['success'] = "Data has been updated successfully";
        echo "<script>
                $(document).ready(function() {
                    Swal.fire({
                        title: 'success',
                        text: 'อัพเดทข้อมูลสำเร็จ',
                        icon: 'success',
                        timer: 3000,
                        showConfirmButton: false
                    });
                });
            </script>";
        header("Refresh:2; url=index.php");
        
    } else {
        $_SESSION['error'] = "Data updated failed";
        header("location: index.php");
    }
}

?>