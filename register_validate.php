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
            // ini_set('display_errors', 1);
            // ini_set('display_startup_errors', 1);
            // error_reporting(E_ALL);


            $success = true;

            // Validate email
            $emailPattern = "/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix";
            if (
                !preg_match($emailPattern, $_POST['email']) ||           // Method 1
                !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) // Method 2
                ) {
                $success = false;
                echo "
                <div class='alert alert-danger' role='alert'>
                    Invalid email
                </div>";
            }

            // Validate password
            if ($_POST['password'] != $_POST['confirm-password']) {
                $success = false;
                echo "
                <div class='alert alert-danger' role='alert'>
                    Passwords do not match
                </div>";
            }
            else {
                $passwordPattern = "/^(?=.*[a-z])(?=.*[0-9])(?=.*_)[a-z0-9_]{8}$/";
                if (!preg_match($passwordPattern, $_POST['password'])) {
                    $success = false;
                    echo "
                    <div class='alert alert-danger' role='alert'>
                        Password must be exactly 8 characters long,
                        and contains at least one small letter, one digit and one underscore
                    </div>";
                }
            }

            // Validate image
            $fileTmp = $_FILES['picture']['tmp_name'];

            $fileType = $_FILES['picture']['type'];
            $isImage = explode("/", $fileType)[0] === 'image';

            $extension = end(explode('.', basename($_FILES['picture']['name'])));

            if (!$isImage) {
                $success = false;
                echo "
                <div class='alert alert-danger' role='alert'>
                    Only images are allowed
                </div>";
            }
            if ($_FILES['picture']['size'] > 1024 * 1024 * 2) {
                $success = false;
                echo "
                <div class='alert alert-danger' role='alert'>
                    Image size cannot be larger than 2MB
                </div>";
            }
            if ($success) {
                $id = floor(microtime(true) * 1000);
                $fileName = $id . '.' . $extension;
                $imgPath = "images/{$fileName}";
                move_uploaded_file($fileTmp, $imgPath);
                try {
                    $filehandler = fopen("users.txt", "a");
                    $record = $id . "`" . $_POST['name'] . "`" . $_POST['email'] . "`" .
                        $_POST['password'] . "`" . $_POST['room-no'] . "`" .
                        $_POST['ext'] . "`" . $imgPath . "\n";
                    fwrite($filehandler, "{$record}");
                    fclose($filehandler);
                } catch (Exception $e) {
                    var_dump($e);
                }
                echo "
                <div class='alert alert-success' role='alert'>
                    Registration successful :)
                </div>";
            }
            else {
                echo "
                <form action='register.php' method='post' enctype='multipart/form-data'>
                    <input type='hidden' name='name' value='{$_POST['name']}'>
                    <input type='hidden' name='email' value='{$_POST['email']}'>
                    <input type='hidden' name='password' value='{$_POST['password']}'>
                    <input type='hidden' name='confirm-password' value='{$_POST['confirm-password']}'>
                    <input type='hidden' name='room-no' value='{$_POST['room-no']}'>
                    <input type='hidden' name='ext' value='{$_POST['ext']}'>
                    <div class='mb-3 d-flex p-2 justify-content-center'><button type='submit' class='btn btn-primary btn-lg'>Fix</button></div>
                </form>";
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