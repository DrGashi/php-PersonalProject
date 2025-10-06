<?php 
session_start();
include_once('database/config.php');
if (empty($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$id = $_GET['id'] ?? null;
if (!$id) {
    // Redirect or show error if no id provided
    header("Location: appointments.php");
    exit;
}

// Fetch the car appointment info joined with stats
$sql = "SELECT a.id, a.make, a.model, a.year, cs.engine_type, cs.horsepower, cs.torque, cs.transmission, cs.drivetrain, cs.fuel_type, cs.weight
        FROM appointments a 
        LEFT JOIN cars cs ON a.id = cs.car_id 
        WHERE a.id = :id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id', $id);
$stmt->execute();
$car = $stmt->fetch();

if (!$car) {
    // Car not found, redirect or show error
    header("Location: appointments.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Car Stats</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
    /* Your existing styles here (copied from user edit page) */
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
    .form-floating {
        margin: 10px 0;
    }
    </style>
</head>
<body>
<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#"><?php echo "Welcome to dashboard " . htmlspecialchars($_SESSION['username']); ?></a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" 
          data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" 
          aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <input class="form-control form-control-dark w-50" type="text" placeholder="Search" aria-label="Search">
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
      <h2>Edit Car Stats for <?= htmlspecialchars($car['make']) ?> <?= htmlspecialchars($car['model']) ?> (<?= htmlspecialchars($car['year']) ?>)</h2>
      <form action="updateCarStats.php" method="post">
        <input type="hidden" name="appointment_id" value="<?= htmlspecialchars($car['id']) ?>">

        <div class="form-floating">
          <input type="text" class="form-control" id="engine_type" placeholder="Engine Type" name="engine_type" value="<?= htmlspecialchars($car['engine_type'] ?? '') ?>">
          <label for="engine_type">Engine Type</label>
        </div>

        <div class="form-floating">
          <input type="number" class="form-control" id="horsepower" placeholder="Horsepower" name="horsepower" value="<?= htmlspecialchars($car['horsepower'] ?? '') ?>">
          <label for="horsepower">Horsepower</label>
        </div>

        <div class="form-floating">
          <input type="number" class="form-control" id="torque" placeholder="Torque" name="torque" value="<?= htmlspecialchars($car['torque'] ?? '') ?>">
          <label for="torque">Torque</label>
        </div>

        <div class="form-floating">
          <input type="text" class="form-control" id="transmission" placeholder="Transmission" name="transmission" value="<?= htmlspecialchars($car['transmission'] ?? '') ?>">
          <label for="transmission">Transmission</label>
        </div>

        <div class="form-floating">
          <input type="text" class="form-control" id="drivetrain" placeholder="Drivetrain" name="drivetrain" value="<?= htmlspecialchars($car['drivetrain'] ?? '') ?>">
          <label for="drivetrain">Drivetrain</label>
        </div>

        <div class="form-floating">
          <input type="text" class="form-control" id="fuel_type" placeholder="Fuel Type" name="fuel_type" value="<?= htmlspecialchars($car['fuel_type'] ?? '') ?>">
          <label for="fuel_type">Fuel Type</label>
        </div>

        <div class="form-floating">
          <input type="number" class="form-control" id="weight" placeholder="Weight" name="weight" value="<?= htmlspecialchars($car['weight'] ?? '') ?>">
          <label for="mpg_city">Weight</label>
        </div>

        <div class="form-floating">
          <textarea class="form-control" id="description" placeholder="Description" name="description" value="<?= htmlspecialchars($car['description'] ?? '') ?>"></textarea>
          <label for="mpg_city">Description</label>
        </div>

        <br>
        <button class="w-100 btn btn-lg btn-primary" type="submit" name="submit">Update Stats</button>
      </form>
    </main>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
<script>
  feather.replace();
</script>
</body>
</html>
