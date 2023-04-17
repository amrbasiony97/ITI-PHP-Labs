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
            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            error_reporting(E_ALL);

            $success = true;
            $record = [];

            echo "{$_POST['email']} <br />";
            echo "{$_POST['password']} <br />";

            // Validate email
            $emailPattern = "/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix";
            if (
                !preg_match($emailPattern, $_POST['email']) ||       // Method 1
                !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)  // Method 2
            ) {
                $success = false;
            }

            // Validate password
            $passwordPattern = "/^(?=.*[a-z])(?=.*[0-9])(?=.*_)[a-z0-9_]{8}$/";
            if (!preg_match($passwordPattern, $_POST['password'])) {
                $success = false;
            }

            // Search for user data
            if ($success) {
                try {
                    $found = false;
                    $filehandler = fopen("users.txt", "r");
                    while (!feof($filehandler)) {
                        $value = fgets($filehandler);
                        $record = explode("`", $value);
                        $email = $record[2];
                        $password = $record[3];
                        if ($email == $_POST['email'] && $password == $_POST['password']) {
                            
                            $found = true;
                            break;
                        }
                    }
                    if (!$found) {
                        $success = false;
                    }
                    fclose($filehandler);
                } catch (Exception $e) {
                    var_dump($e);
                }
            }
            if ($success) {
                session_start();
                $_SESSION['id'] = $record[0];
                $_SESSION['name'] = $record[1];
                $_SESSION['email'] = $record[2];
                $_SESSION['room-no'] = $record[4];
                $_SESSION['ext'] = $record[5];
                $_SESSION['image'] = $record[6];
                header("Location: home.php");
            } else {
                header("Location: login.php?status=fail");
            }
                exit();
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