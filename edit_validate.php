<!doctype html>
<html lang="en">

<head>
    <title>Validate</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="#">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Products</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Users</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Manual Order</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Checks</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <main>
        <div class="container w-50 mt-3">
            <?php
            require_once 'Database.php';
            require_once 'return_msg.php';

            // Validate name
            if (!isset($_POST['name']) || empty($_POST['name'])) {
                error_msg('Name is required');
            }

            // Validate email
            $emailPattern = "/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix";
            if (
                !preg_match($emailPattern, $_POST['email']) ||          // Method 1
                !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)     // Method 2
            ) {
                error_msg('Invalid email');
            }

            // Validate password
            if ($_POST['password'] != $_POST['confirm-password']) {
                error_msg('Passwords do not match');
            } else {
                $passwordPattern = "/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/";
                if (!preg_match($passwordPattern, $_POST['password'])) {
                    error_msg('Password must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters');
                }
            }

            // Validate image
            $fileTmp = $_FILES['image']['tmp_name'];
            $fileType = $_FILES['image']['type'];
            $isImageEmpty = empty($_FILES['image']['full_path']);
            $isImage = explode("/", $fileType)[0] === 'image';

            if ($isImageEmpty) {
                $imgPath = $_POST['old-image'];
            }
            else if (!$isImage) {
                error_msg('Only images are allowed');
            }
            else {
                $extension = end(explode('.', basename($_FILES['image']['name'])));
            }

            if ($_FILES['image']['size'] > 1024 * 1024 * 2) {
                error_msg('Image size is too large');
            }

            $id = floor(microtime(true) * 1000);
            if (!$isImageEmpty) {
                $fileName = $id . '.' . $extension;
                $imgPath = "images/{$fileName}";
            }
            
            Database::connect([
                'db' => 'php',
                'host' => 'localhost',
                'port' => '3306',
                'user' => 'mans-os07',
                'password' => 'Abcd@1234'
            ]);

            $result = Database::update('users', $_GET['id'], [
                'name' => $_POST['name'],
                'email' => $_POST['email'],
                'password' => $_POST['password'],
                'room_no' => $_POST['room-no'],
                'ext' => $_POST['ext'],
                'image' => $imgPath
            ]);

            if ($result > 0) {
                if ($isImage) {
                    if ($_POST['old-image'] !== 'images/default.png') {
                        unlink($_POST['old-image']);
                    }
                    move_uploaded_file($fileTmp, $imgPath);
                }
                return_msg('User updated successfully', 'success');
            } else {
                return_msg('User data unchanged', 'info');
            }

            function error_msg($msg)
            {
                echo "
                <form action='edit.php?id={$_GET['id']}' method='post' id='myForm'>
                    <input type='hidden' name='error' value='{$msg}'>
                </form>
                <script>
                    document.getElementById('myForm').submit();
                </script>
                ";
                exit();
            }
            ?>
        </div>
    </main>
    <footer>
        <!-- place footer here -->
    </footer>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>
</body>

</html>