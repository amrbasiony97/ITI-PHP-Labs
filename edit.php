<!doctype html>
<html lang="en">

<head>
	<title>Lab 4</title>
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
<?php
require_once 'connect_pdo.php';
require_once 'return_msg.php';

try {
	$db = connect_pdo('php', 'localhost', '3306', 'mans-os07', 'Abcd@1234');

	$query = "SELECT * FROM users WHERE id = :id;";
	$stmt = $db->prepare($query);
	$stmt->bindParam(":id", $_GET['id'], PDO::PARAM_INT);
	$stmt->execute();

	if ($record = $stmt->fetch(PDO::FETCH_ASSOC)) {
	} else {
		return_msg('User not found', 'danger');
	}
} catch (Exception $e) {
	error_msg($e->getMessage());
}
?>

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
			<h1 class="text-center display-4">Update User</h1>
			<form action="<?php echo "edit_validate.php?id={$_GET['id']}" ?>" method="POST" enctype="multipart/form-data">
				<div class="mb-3"><label for="name" class="form-label">Name</label><input type="text" class="form-control" id="name" name="name" <?php echo "value='{$record['name']}'" ?> required></div>
				<div class="mb-3"><label for="email" class="form-label">Email</label><input type="text" class="form-control" id="email" name="email" <?php echo "value='{$record['email']}'" ?> required></div>
				<div class="mb-3"><label for="password" class="form-label">Password</label><input type="password" class="form-control" id="password" name="password" <?php echo "value='{$record['password']}'" ?> required></div>
				<div class="mb-3"><label for="confirm-password" class="form-label">Confirm Password</label><input type="password" class="form-control" id="confirm-password" name="confirm-password" <?php echo "value='{$record['password']}'" ?>></div>
				<div class="mb-3"><label for="room-no" class="form-label">Room No.</label><select class="form-select form-select" name="room-no" id="room-no">
						<option value="application1" <?php if ($record['room_no'] === 'application1') echo "selected" ?>>Application 1</option>
						<option value="application2" <?php if ($record['room_no'] === 'application2') echo "selected" ?>>Application 2</option>
						<option value="cloud" <?php if ($record['room_no'] === 'cloud') echo "selected" ?>>Cloud</option>
					</select></div>
				<div class="mb-3"><label for="ext" class="form-label">Ext.</label><input type="number" class="form-control" id="ext" name="ext" <?php echo "value='{$record['ext']}'" ?>></div>
				<div class="mb-3"><label for="image" class="form-label">Profile Image</label><input type="file" class="form-control" name="image" id="image"></div>
				<input type="text" name="old-image" id="old-image" value="<?php echo $record['image'] ?>" hidden>
				<?php
				if (isset($_POST['error'])) {
					echo "
						<div class='alert alert-danger' role='alert'>
							<strong>Error: </strong>{$_POST['error']}
						</div>
						";
				}
				?>
				<div class="mb-3 d-flex p-2 justify-content-center">
					<button type="submit" class="btn btn-primary btn-lg">Update</button>
				</div>
			</form>
		</div>
	</main>
	<footer><!-- place footer here --></footer>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous"></script>
</body>

</html>