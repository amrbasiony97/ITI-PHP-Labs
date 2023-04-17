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
			<h1 class="text-center display-4">Add User</h1>
			<form action="register_validate.php" method="POST" enctype="multipart/form-data">
				<div class="mb-3"><label for="name" class="form-label">Name</label><input type="text" class="form-control" id="name" name="name" <?php echo "value='{$_POST['name']}'" ?> required></div>
				<div class="mb-3"><label for="email" class="form-label">Email</label><input type="text" class="form-control" id="email" name="email" <?php echo "value='{$_POST['email']}'" ?> required></div>
				<div class="mb-3"><label for="password" class="form-label">Password</label><input type="password" class="form-control" id="password" name="password" <?php echo "value='{$_POST['password']}'" ?> required></div>
				<div class="mb-3"><label for="confirm-password" class="form-label">Confirm Password</label><input type="password" class="form-control" id="confirm-password" name="confirm-password" <?php echo "value='{$_POST['confirm-password']}'" ?> ></div>
				<div class="mb-3"><label for="room-no" class="form-label">Room No.</label><select class="form-select form-select" name="room-no" id="room-no">
						<option value="application1" <?php if ($_POST['room-no'] === 'application1') echo "selected" ?> >Application 1</option>
						<option value="application2" <?php if ($_POST['room-no'] === 'application2') echo "selected" ?> >Application 2</option>
						<option value="cloud" <?php if ($_POST['room-no'] === 'cloud') echo "selected" ?> >Cloud</option>
					</select></div>
				<div class="mb-3"><label for="ext" class="form-label">Ext.</label><input type="number" class="form-control" id="ext" name="ext" <?php echo "value='{$_POST['ext']}'" ?> ></div>
				<div class="mb-3"><label for="picture" class="form-label">Profile Picture</label><input type="file" class="form-control" name="picture" id="picture"></div>
				<div class="mb-3 d-flex p-2 justify-content-evenly"><button type="submit" class="btn btn-primary btn-lg">Save</button><button type="reset" class="btn btn-secondary btn-lg">Reset</button></div>
			</form>
		</div>
	</main>
	<footer><!-- place footer here --></footer>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous"></script>
</body>

</html>