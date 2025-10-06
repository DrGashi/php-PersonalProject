<?php
session_start();
include_once('database/config.php');

if ($_SESSION['is_admin'] != 'true') {
    header("Location: login.php");
    exit;
}

$sql = "SELECT 
            a.id, a.make, a.model, a.year, cs.engine_type, cs.horsepower, cs.torque, cs.transmission,
            cs.drivetrain, cs.fuel_type, cs.weight
        FROM appointments a
        LEFT JOIN cars cs ON a.id = cs.car_id
        WHERE a.working_on = 'true'";

$stmt = $conn->prepare($sql);
$stmt->execute();
$appointmentsWithStats = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Car Stats Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
      body {
        background-color: #f8f9fa;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      }
      .navbar-brand {
        font-weight: bold;
      }
      .nav-link {
        color: #333;
        transition: all 0.3s;
      }
      .nav-link:hover {
        background-color: #e9ecef;
        border-radius: 4px;
        color: #000;
      }
      h2 {
        margin-top: 2rem;
        margin-bottom: 1rem;
        font-weight: 600;
        color: #343a40;
      }
      .sidebar {
        background-color: #f1f3f5;
        border-right: 1px solid #dee2e6;
      }
      .table-responsive {
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        background-color: white;
        border-radius: 8px;
        padding: 1rem;
        margin-bottom: 2rem;
      }
      .table th {
        background-color: #343a40;
        color: white;
        text-align: center;
      }
      .table td, .table th {
        vertical-align: middle;
        text-align: center;
      }
      .table tbody tr:hover {
        background-color: #f1f1f1;
      }
      a.action-link {
        text-decoration: none;
        font-weight: 500;
        margin: 0 5px;
      }
      a.action-link:hover {
        text-decoration: underline;
      }
      .nav-link i {
        margin-right: 8px;
        vertical-align: middle;
      }
    </style>
</head>
<body>
<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#"><?php echo "Welcome to dashboard " . $_SESSION['username']; ?></a>
  <div class="navbar-nav">
    <div class="nav-item text-nowrap">
      <a class="nav-link px-3" href="logout.php">Sign out</a>
    </div>
  </div>
</header>

<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky pt-3">
        <ul class="nav flex-column">
          <?php if ($_SESSION['is_admin'] == 'true') { ?>
                <li class="nav-item"><a class="nav-link active" href="dashboard.php"><span data-feather="home"></span> Dashboard</a></li>
                <li class="nav-item"><a class="nav-link" href="appointments.php"><i data-feather="calendar"></i> Appointments</a></li>
                <li class="nav-item"><a class="nav-link" href="workOnCar.php"><i data-feather="bar-chart-2"></i> Car Info</a></li>
                <li class="nav-item"><a class="nav-link" href="finishedCars.php"><i data-feather="check-square"></i> Finished Cars</a></li>
            <?php } else { ?>
                <li class="nav-item"><a class="nav-link" href="appointments.php"><i data-feather="calendar"></i> Appointments</a></li>
                <li class="nav-item"><a class="nav-link" href="makeAppointment.php"><i data-feather="plus-circle"></i> Make Appointment</a></li>
            <?php } ?>
        </ul>
      </div>
    </nav>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <h2>Car Stats</h2>
      <div class="table-responsive table">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>Make</th>
              <th>Model</th>
              <th>Year</th>
              <th>Engine</th>
              <th>HP</th>
              <th>Torque</th>
              <th>Transmission</th>
              <th>Drivetrain</th>
              <th>Fuel</th>
              <th>Weight</th>
              <th>Description</th>
              <th>Action</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($appointmentsWithStats as $car) { ?>
            <tr>
                <td><?= htmlspecialchars($car['make']) ?></td>
                <td><?= htmlspecialchars($car['model']) ?></td>
                <td><?= htmlspecialchars($car['year']) ?></td>
                <td><?= !empty($car['engine_type']) ? htmlspecialchars($car['engine_type']) : '<span class="text-muted">Add stats</span>' ?></td>
                <td><?= !empty($car['horsepower']) ? htmlspecialchars($car['horsepower']) : '<span class="text-muted">Add stats</span>' ?></td>
                <td><?= !empty($car['torque']) ? htmlspecialchars($car['torque']) : '<span class="text-muted">Add stats</span>' ?></td>
                <td><?= !empty($car['transmission']) ? htmlspecialchars($car['transmission']) : '<span class="text-muted">Add stats</span>' ?></td>
                <td><?= !empty($car['drivetrain']) ? htmlspecialchars($car['drivetrain']) : '<span class="text-muted">Add stats</span>' ?></td>
                <td><?= !empty($car['fuel_type']) ? htmlspecialchars($car['fuel_type']) : '<span class="text-muted">Add stats</span>' ?></td>
                <td><?= !empty($car['weight']) ? htmlspecialchars($car['weight']) : '<span class="text-muted">Add stats</span>' ?></td>
                <td style="max-width: 100px;"><?= !empty($car['description']) ? htmlspecialchars($car['description']) : '<span class="text-muted">Add stats</span>' ?></td>
                <td><a href="editCarStats.php?id=<?= $car['id'] ?>" class="btn btn-sm btn-primary">Edit</a></td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </main>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
<script>
  feather.replace();
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
