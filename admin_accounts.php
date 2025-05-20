<?php
session_start();

if (!isset($_SESSION['admin'])){
  header('location:index.php');
}

try{
    $pdo = new PDO('mysql:host=localhost;dbname=rtwpb3', "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
    echo 'Connection Failed' .$e->getMessage();
    }

if (isset($_POST['add'])){
  $username = $_POST["username"];
  $password = $_POST["password"];
  $cpassword = $_POST["cpassword"];
      
  $stmt = $pdo->prepare("SELECT * from admin where username='$username'");
  $stmt->execute();
    if($stmt->rowCount() > 0){
      $_SESSION['error'] = "Username Already Exists!";
    }
    else{
      if ($password === $cpassword){
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("insert into admin set username=?, password=?");
        $stmt->execute([$username, $hash]);
        $_SESSION['success'] = "User Added Successfully!";
      }
      else{
        $_SESSION['error'] = "Password Does Not Match!";
      }
    }
}

if (isset($_POST['pass'])){
  $id = $_POST['id'];
  $password = $_POST["password"];
  $cpassword = $_POST["cpassword"];

  if ($password === $cpassword){
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("UPDATE admin set password='$hash' where id='$id'");
    $stmt->execute();
    $_SESSION['success'] = "Password Updated Successfully!";
  }
  else{
    $_SESSION['error'] = "Password Does Not Match!";
  }
}

if(isset($_POST['delete'])){
    $id = $_POST['id2'];

    $stmt = $pdo->prepare("DELETE from admin where id='$id'");
    if($stmt->execute()){
      $_SESSION['success'] = "Admin Deleted Successfully!";
    }
    else{
      $_SESSION['error'] = "Delete Failed!";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="icon" href="images/logo.png" type="image/x-icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="style2.css">
      <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css">
</head>
<body>

<div class="wrapper">
<!-- SIDEBAR -->
<aside id="sidebar">
    <div class="d-flex">
        <button id="toggle-btn" type="button">
            <i class="bi bi-list"></i>
        </button>
        <div class="sidebar-logo">
            <a href="admin_panel.php">Admin</a>
        </div>
    </div>
        <ul class="sidebar-nav">
            <li class="sidebar-item">
                <a href="admin_panel.php" class="sidebar-link">
                    <i class="bi bi-bar-chart"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="admin_news.php" class="sidebar-link">
                    <i class="bi bi-newspaper"></i>
                    <span>News</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="admin_events.php" class="sidebar-link">
                    <i class="bi bi-calendar-event"></i>
                    <span>Events</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="admin_staff.php" class="sidebar-link">
                    <i class="bi bi-people-fill"></i>
                    <span>Staff</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="admin_accounts.php" class="sidebar-link">
                    <i class="bi bi-person-fill-gear"></i>
                    <span>Accounts</span>
                </a>
            </li>
        </ul>
        <div class="sidebar-footer">
            <a href="logout.php" class="sidebar-link">
                <i class="bi bi-box-arrow-left"></i>
                <span>Logout</span>
            </a>
        </div>
</aside>

<!-- ADD MODAL -->
<div class="modal fade" id="addmodal" tabindex="-1" aria-labelledby="addmodalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="addmodalLabel">Add Admin Account</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form action="admin_accounts.php" method="POST">
      <div class="modal-body">

      <div class="form-group mb-3">
        <label class="col-sm-2 col-form-label">Username</label>
        <input type="text" name="username" class="form-control" autocomplete="off" required></input>
      </div>

      <div class="form-group mb-3">
        <label class="col-sm-2 col-form-label">Password</label>
        <input type="password" name="password" class="form-control" required></input>
      </div>

      <div class="form-group mb-3">
        <label class="col-sm-2 col-form-label">Confirm Password</label>
        <input type="password" name="cpassword" class="form-control" required></input>
      </div>

        </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name="add" class="btn btn-success">Add</button>
      </div>
      
      </form>

    </div>
  </div>
</div>

<!-- PASS MODAL -->
<div class="modal fade" id="editmodal" tabindex="-1" aria-labelledby="editmodalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="editmodalLabel">Change Password</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form action="admin_accounts.php" method="POST">
      <div class="modal-body">

      <input type="hidden" id="id" name="id" class="form-control" required>

      <div class="form-group mb-3">
        <label class="col-sm-2 col-form-label">Username</label>
        <input type="text" id="username" name="username" class="form-control" readonly></input>
      </div>

      <div class="form-group mb-3">
        <label class="col-sm-2 col-form-label" style="color: red">Password</label>
        <input type="password" name="password" class="form-control" required></input>
      </div>

      <div class="form-group mb-3">
        <label class="col-sm-2 col-form-label" style="color: red">Confirm Password</label>
        <input type="password" name="cpassword" class="form-control" required></input>
      </div>

        </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name="pass" class="btn btn-success">Change Password</button>
      </div>
      
      </form>

    </div>
  </div>
</div>

<!-- DELETE MODAL -->
<div class="modal fade" id="deletemodal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="deletemodalLabel">Delete Admin?</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form action="admin_accounts.php" method="POST">
      <div class="modal-body">

      <input type="hidden" id="id2" name="id2" class="form-control" required>

        <div class="form-group mb-3">
        <label class="col-sm-2 col-form-label">Username</label>
          <input type="text" id="username2" class="form-control" readonly>
        </div>

        </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name="delete" class="btn btn-danger">Delete</button>
      </div>
      
      </form>

    </div>
  </div>
</div>

<!-- MAIN -->
<div class="main p-3">

<!-- NAVBAR -->
<div class="card rounded p-3" style="box-shadow: 0 0 10px #0e223e;">
  <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
    <!-- Left side: logo and RTWPB3 -->
    <div class="d-flex align-items-center gap-2 fw-bold mb-2 mb-md-0">
      <img src="images/logo.png" class="img-fluid" style="height: 40px;">
      <span class="text-nowrap">RTWPB3</span>
      <a href="index.php" target="_blank" rel="noopener noreferrer" class="text-decoration-none"><i class="bi bi-box-arrow-up-right"></i></a>
    </div>

    <!-- Right side: admin name -->
    <div class="fw-bold text-center text-md-end">
      <?php echo $_SESSION['admin']; ?>
    </div>
  </div>
</div><br>

<!-- TABLE -->
<div class="card rounded p-3 h-100" style="box-shadow: 0 0 10px #0e223e;">
  <div class="mb-3 text-end">
    <button type="button" class="btn btn-success btn-sm addbtn" id='add'>Create New Account +</button>
  </div>
  <div class="table-responsive">
    <table id="myTable" class="table table-striped table-hover mb-0">
      <thead>
        <tr>
          <th scope="col" class="text-center" style="background-color: #0e223e; color: white;">ID</th>
          <th scope="col" class="text-center" style="background-color: #0e223e; color: white;">Account Name</th>
          <th scope="col" class="text-center" style="background-color: #0e223e; color: white;">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $stmt = $pdo->prepare("SELECT * from admin");
        $stmt->execute();
        if($stmt->rowCount() > 0){
          $result = $stmt->fetchAll();
          foreach($result as $row){
        ?>
          <tr>
            <td class="text-center"><?= $row['id']; ?></td>
            <td class="text-center"><?= $row['username']; ?></td>
            <td class="text-center">
              <div class='btn-group' role='group' aria-label='Basic mixed styles example'>
                <button type='button' id='<?= $row['id']; ?>' class='btn btn-outline-secondary editbtn' value='<?= $row['id']; ?>'><i class="bi bi-pencil-square"></i></button>
                <button type='button' id='<?= $row['id']; ?>' class='btn btn-outline-danger deletebtn' value='<?= $row['id']; ?>'><i class="bi bi-trash3"></i></button>
              </div>
            </td>
          </tr> 
        <?php }} ?>
      </tbody>
    </table>
  </div>
</div>


</div>
</div>

<!-- SCRIPT -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- TABLE -->
<script>
  new DataTable('#myTable', {
    order: [[0, 'desc']],
    scrollCollapse: true,
    scrollY: '50vh',
    info: false,
    columnDefs: [{ width: '10%', targets: [0] }],
    lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
    "language": {
            "lengthMenu": "Show _MENU_ Entries",
        }
  });
</script>

<!-- MODAL -->
<script>
  $(document).ready(function () {
    $('.addbtn').on('click', function() {
      $('#addmodal').modal('show');
    });
  });
</script>

<script>
  $(document).ready(function () {
    $('#myTable').on('click', '.editbtn', function() {
      $('#editmodal').modal('show');
      var id = $(this).val();

        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function(){
        return $(this).text();
        }).get();

        console.log(data);

        $('#id').val(id);
        $('#username').val(data[1]);
    });
  });
</script>

<script>
  $(document).ready(function () {
    $('#myTable').on('click', '.deletebtn', function() {
      $('#deletemodal').modal('show');
      var id = $(this).val();

        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function(){
        return $(this).text();
        }).get();

        console.log(data);

        $('#id2').val(id);
        $('#username2').val(data[1]);
    });
  });
</script>

<!-- SWEETALERT -->
<?php
  if(isset($_SESSION['success'])) { ?>
  <script>
    Swal.fire({
    title: "<?php echo $_SESSION['success']; ?>",
    icon: "success",
    confirmButtonText: 'OK',
    confirmButtonColor: "#043047",
    });
  </script>
<?php unset($_SESSION['success']); } ?>

<?php
  if(isset($_SESSION['error'])) { ?>
  <script>
    Swal.fire({
    title: "<?php echo $_SESSION['error']; ?>",
    icon: "error",
    confirmButtonText: 'OK',
    confirmButtonColor: "#043047",
    });
  </script>
<?php unset($_SESSION['error']); } ?>

<!-- REFRESH -->
<script>
  if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
  }
</script>

</body>
</html>