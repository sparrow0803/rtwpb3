<?php
session_start();

if (!isset($_SESSION['admin'])){
  header('location:login.php');
}


try{
    $pdo = new PDO('mysql:host=localhost;dbname=rtwpb3', "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
    echo 'Connection Failed' .$e->getMessage();
    }

$stmt = $pdo->query("SELECT COUNT(*) AS total FROM news");
$total_news = $stmt->fetch();

$stmt = $pdo->query("SELECT COUNT(*) AS total FROM events");
$total_events = $stmt->fetch();

$stmt = $pdo->query("SELECT COUNT(*) AS total FROM staff");
$total_staff = $stmt->fetch();
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

<!-- ADMIN DASHBOARD -->
<h1>
  Admin Dashboard
</h1>

<!-- CARDS-->
<div class="row row-cols-1 row-cols-md-3 g-4">
<!-- News Card -->
<div class="col">
  <div class="card rounded p-3" style="box-shadow: 0 0 10px #0e223e;">
    <div class="d-flex justify-content-between align-items-center">
      <div>
        <h6>Total News</h6>
        <h2><?php echo $total_news['total']; ?></h2>
      </div>
      <div>
        <i class="bi bi-newspaper fs-1" style="color: #0e223e;"></i>
      </div>
    </div>
  </div>
</div>

<!-- Events Card -->
<div class="col">
  <div class="card rounded p-3" style="box-shadow: 0 0 10px #0e223e;">
    <div class="d-flex justify-content-between align-items-center">
      <div>
        <h6>Total Events</h6>
        <h2><?php echo $total_events['total']; ?></h2>
      </div>
      <div>
        <i class="bi bi-calendar-event fs-1" style="color: #0e223e;"></i>
      </div>
    </div>
  </div>
</div>

<!-- Staff Card -->
<div class="col">
  <div class="card rounded p-3" style="box-shadow: 0 0 10px #0e223e;">
    <div class="d-flex justify-content-between align-items-center">
      <div>
        <h6>Total Staff</h6>
        <h2><?php echo $total_staff['total']; ?></h2>
      </div>
      <div>
        <i class="bi bi-people-fill fs-1" style="color: #0e223e;"></i>
      </div>
      </div>
    </div>
  </div>
</div><br>

<!-- TABLE AND CHART -->
<div class="row row-cols-1 row-cols-md-2 g-4">
<!-- Table Column -->
<div class="col">
  <div class="card rounded p-3 h-100" style="box-shadow: 0 0 10px #0e223e;">
  <div class="table-responsive">
    <table id="myTable" class="table table-striped table-hover mb-0">
      <thead>
        <tr>
          <th scope="col" class="text-center" style="background-color: #0e223e; color: white;">ID</th>
          <th scope="col" class="text-center" style="background-color: #0e223e; color: white;">Account Name</th>
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
          </tr> 
        <?php }} ?>
      </tbody>
    </table>
  </div>
  </div>
</div>

<!-- Chart Column -->
<div class="col">
  <div class="card rounded p-3 h-100" style="box-shadow: 0 0 10px #0e223e;">
    <canvas id="myChart"></canvas>
  </div>
</div>
</div>

</div>
</div>

<!-- SCRIPT -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="script.js"></script>

<script>
  const ctx = document.getElementById('myChart');

  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['Last 2 Days Ago', 'Yesterday', 'Today'],
      datasets: [{
        label: 'Website Visits',
        data: [3, 4, 10],
        borderWidth: 1,
        barPercentage: 0.5,
        backgroundColor: '#0e223e'
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>

<!-- REFRESH -->
<script>
  if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
  }
</script>

</body>
</html>