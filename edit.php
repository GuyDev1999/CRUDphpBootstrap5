<?php 
session_start();
require_once 'config/db.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD PDO & Bootstrap 5</title>
    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <style>
        .container {
            max-width: 550px;
        }
    </style>
</head>
<body>


    <div class="container mt-5">
        <h1>Edit Data</h1>
        <hr>
        <form action="insert.php" method="post" enctype="multipart/form-data">
            <?php 
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $stmt = $conn->query("SELECT * FROM users WHERE id = $id");
                    $stmt->execute();
                    $data = $stmt->fetch();
                }
            ?>
            <div class="mb-3">
                <label for="firstname" class="col-form-label">First Name:</label>
                <input type="text" value="<?= $data['firstname']; ?>" required class="form-control" name="firstname">
            </div>
            <div class="mb-3">
                <label for="lastname" class="col-form-label">Last Name:</label>
                <input type="text" value="<?= $data['lastname']; ?>" required class="form-control" name="lastname">
            </div>
            <div class="mb-3">
                <label for="position" class="col-form-label">Position:</label>
                <input type="text" value="<?= $data['position']; ?>" required class="form-control" name="position">
            </div>
            <div class="mb-3">
                <label for="img" class="col-form-label">Image:</label>
                <input type="file" required class="form-control" id="imgInput" name="img">
                <img width="100%" src="uploads/<?=$data['img']; ?>" id="previewImg" alt="">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" name="submit" class="btn btn-success">Submit</button>
            </div>
        </form>
        <!-- Users Data -->
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script>
        let imgInput = document.getElementById('imgInput');
        let previewImg = document.getElementById('previewImg');

        imgInput.onchange = evt => {
            const [file] = imgInput.files;
            if (file) {
                previewImg.src = URL.createObjectURL(file);
            }
        }
    </script>
</body>
</html>