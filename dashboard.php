<!doctype html>
<html lang="en">

<head>
  <title>Lab 5</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  <style>
    body {
      font-family: 'Roboto', sans-serif;
    }

    .personal-image {
      height: 80px;
      width: 80px;
      object-fit: cover;
      border-radius: 10px;
    }

    td {
      vertical-align: text-top;
    }

    button.close {
      background-color: white;
      border: 0;
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

    <div class="container w-100 mt-3">
      <h1 class="text-center display-4 m-4">Dashboard</h1>
      <table class="table table-hover">
        <thead>
          <tr>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Password</th>
            <th>Room No.</th>
            <th>Ext.</th>
            <th>Image</th>
            <th>Edit</th>
            <th>Delete</th>
          </tr>
        </thead>
        <tbody>
          <?php
          require_once 'Database.php';

          $db = Database::connect([
            'db' => 'php',
            'host' => 'localhost',
            'port' => '3306',
            'user' => 'mans-os07',
            'password' => 'Abcd@1234'
          ]);

          foreach (Database::select('users') as $row) {
            echo "<tr>";
            echo "<td>{$row['id']}</td>";
            echo "<td>{$row['name']}</td>";
            echo "<td>{$row['email']}</td>";
            echo "<td>{$row['password']}</td>";
            echo "<td>{$row['room_no']}</td>";
            echo "<td>{$row['ext']}</td>";
            echo "<td><img src='{$row['image']}' class='personal-image' /></td>";
            echo "<td><a name='edit' id='edit' class='btn btn-primary' href='edit.php?id={$row['id']}' role='button'>Edit</a></td>";
            echo "
            <td>
              <button type='button' href='delete.php?id={$row['id']}&image={$row['image']}' class='btn btn-danger delete-btn' data-toggle='modal' data-target='#deleteModal'>
                Delete
              </button>

              <div class='modal fade' id='deleteModal' tabindex='-1' role='dialog' aria-labelledby='deleteModalLabel' aria-hidden='true'>
                <div class='modal-dialog' role='document'>
                  <div class='modal-content'>
                    <div class='modal-header'>
                      <h5 class='modal-title' id='deleteModalLabel'>Delete Confirmation</h5>
                      <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                      </button>
                    </div>
                    <div class='modal-body'>
                      Are you sure you want to delete this user?
                    </div>
                    <div class='modal-footer'>
                      <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancel</button>
                      <a class='btn btn-danger' role='button'>Delete</a>
                    </div>
                  </div>
                </div>
              </div>
            </td>
            ";
            echo "<tr>";
          }
          ?>
        </tbody>
      </table>
      <?php
        if (isset($_POST['msg'])) {
          echo "
          <div class='alert alert-{$_POST['status']}' role='alert'>
            {$_POST['msg']}
          </div>
          ";
        }
      ?>
      <div class="mb-3 d-flex p-2 justify-content-center">
      <a class='btn btn-success' href='add.php'>Add new user</a>
      </div>
    </div>
  </main>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script>
    $('.delete-btn').click(function() {
      $('.modal-footer a').attr('href', $(this).attr('href'));
    })
  </script>
</body>
  
</html>

