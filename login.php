<!doctype html>
<html lang="en">

<head>
	<title>Lab 3</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
	<style>
		body {
			font-family: 'Roboto', sans-serif;
		}

		main {
			margin-top: 100px;
		}
	</style>
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
	<main class="w-75 mx-auto">
		<div class="container w-50 mt-3">
			<h1 class="text-center display-4">Cafeteria</h1>
			<form action="login_validate.php" method="POST" enctype="multipart/form-data">
				<div class="mb-3"><label for="email" class="form-label">Email</label><input type="text" class="form-control" id="email" name="email" <?php echo "value='{$_POST['email']}'" ?> required></div>
				<div class="mb-3"><label for="password" class="form-label">Password</label><input type="password" class="form-control" id="password" name="password" <?php echo "value='{$_POST['password']}'" ?> required></div>
				<div class="mb-3 d-flex p-2 justify-content-evenly"><button type="submit" class="btn btn-primary w-100">Login</button></div>
				<?php 
					if ($_GET['status'] == 'success') {
						echo "
                <div class='alert alert-success' role='alert'>
                    Login success :)
                </div>";
					}
					if ($_GET['status'] == 'fail') {
						echo "
                <div class='alert alert-danger' role='alert'>
                    Login failed :(
                </div>";
					}
				?>
			</form>
		</div>
	</main>
	<footer><!-- place footer here --></footer>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous"></script>
</body>

</html>