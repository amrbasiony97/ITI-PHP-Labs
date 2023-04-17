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
	</style>
</head>

<?php session_start(); ?>

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
		<div class="container w-100 mt-3">
			<h1 class="text-center display-4"><?php echo "Welcome Back :)" ?></h1>
            <p><strong>Id: </strong><?php echo $_SESSION['id'] ?></p>
            <p><strong>Name: </strong><?php echo $_SESSION['name'] ?></p>
            <p><strong>Email: </strong><?php echo $_SESSION['email'] ?></p>
            <p><strong>Room No.: </strong><?php echo $_SESSION['room-no'] ?></p>
            <p><strong>Ext.: </strong><?php echo $_SESSION['ext'] ?></p>
            <p><strong>Profile Picture: </strong><img width="200px" src="<?php echo $_SESSION['image'] ?>" /></p>
		</div>
	</main>
	<footer><!-- place footer here --></footer>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous"></script>
</body>

</html>