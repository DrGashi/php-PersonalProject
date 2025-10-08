<?php 
   session_start();
   include_once('database/config.php');
   if (empty($_SESSION['username'])) {
          header("Location: login.php");
    }
   $user_id = $_SESSION['id'];

   if ($_SESSION['is_admin'] == 'true') {
    $sql = "SELECT appointments.id, appointments.make, appointments.model, appointments.year, appointments.date, appointments.time, appointments.is_approved
            FROM appointments
            INNER JOIN users ON users.id = appointments.user_id
            WHERE appointments.is_approved = 'false'";
    $approvdedAppnts = "SELECT appointments.id, appointments.make, appointments.model, appointments.year, appointments.date, appointments.time, appointments.is_approved
            FROM appointments
            INNER JOIN users ON users.id = appointments.user_id
            WHERE appointments.is_approved = 'true'";
    $selectAppointments = $conn->prepare($sql);
    $selectAppointments->execute();
    $getApprvdAppnts = $conn->prepare($approvdedAppnts);
    $getApprvdAppnts->execute();
    $appointments_data = $selectAppointments->fetchAll();
    $approvdAppntsData = $getApprvdAppnts->fetchAll();
} else {
    $sql = "SELECT appointments.id, appointments.make, appointments.model, appointments.year, appointments.date, appointments.time, appointments.is_approved 
        FROM appointments
        INNER JOIN users ON users.id = appointments.user_id
        WHERE appointments.user_id = :user_id";


    $selectAppointments = $conn->prepare($sql);
    $selectAppointments->bindParam(':user_id', $user_id);
    $selectAppointments->execute();
    $appointments_data = $selectAppointments->fetchAll();
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
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

  .approved {
    margin-top: 3rem;
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
                        <li class="nav-item"><a class="nav-link" href="logout.php"><i data-feather="log-out"></i> Log Out</a></li>
                    <?php } else { ?>
                        <li class="nav-item"><a class="nav-link" href="appointments.php"><i data-feather="calendar"></i> Appointments</a></li>
                        <li class="nav-item"><a class="nav-link" href="makeAppointment.php"><i data-feather="plus-circle"></i> Make Appointment</a></li>
                        <li class="nav-item"><a class="nav-link" href="logout.php"><i data-feather="log-out"></i> Log Out</a></li>
                    <?php } ?>
                </ul>
            </div>
        </nav>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <h2>Mechanic Appointments</h2>
            <div class="table-responsive table">
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th scope="col">Make</th>
                            <th scope="col">Model</th>
                            <th scope="col">Year</th>
                            <th scope="col">Date</th>
                            <th scope="col">Time</th>
                            <?php if ($_SESSION['is_admin'] == 'true') { ?>
                            <th></th>
                            <th></th>
                            <?php } else {?>
                                <th>Status</th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($appointments_data as $appointment_data) { ?>
                        <tr>
                            <td><?php echo $appointment_data['make']; ?></td>
                            <td><?php echo $appointment_data['model']; ?></td>
                            <td><?php echo $appointment_data['year']; ?></td>
                            <td><?php echo $appointment_data['date']; ?></td>
                            <td><?php echo $appointment_data['time']; ?></td>
                            <?php if ($_SESSION['is_admin'] == 'true') { ?>
                                <td><a href="approve.php?id=<?= $appointment_data['id']; ?>" class="text-success"><i data-feather="check-circle"></i></a></td>
                                <td><a href="decline.php?id=<?= $appointment_data['id']; ?>" class="text-danger"><i data-feather="x-circle"></i></a></td>
                            <?php }else{
                                    $statusCar = $appointment_data['is_approved'];
                                    if ($statusCar === 'false') {
                                        $status = "Waiting approval";
                                    } elseif ($statusCar === 'true') {
                                        $status = "Approved";
                                    } elseif ($statusCar === 'done') {
                                        $status = "Done";
                                    } elseif ($statusCar === 'pickedUp') {
                                        $status = "Picked up";
                                    } else {
                                        $status = "Unknown";
                                    }?>
                                    <td><?php if ($status != 'Done') {echo $status;} ?>
                                    <?php if($status == 'Done'){?><a href="pickedUp.php?id=<?= $car['id'] ?>" class="btn btn-sm btn-primary">Pick Up</a>
                                    <?php } ?>
                                    <?php }?>
                                    </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
            <?php if ($_SESSION['is_admin'] == 'true') { ?>
                <hr style="color: black; background-color: black; border: 1px solid black;">
                <hr class="my-4">
                <h2 class="approved">Approved Appointments</h2> 
                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th scope="col">Make</th>
                                <th scope="col">Model</th>
                                <th scope="col">Year</th>
                                <th scope="col">Date</th>
                                <th scope="col">Time</th>
                                <th></th>
                            </tr>
                        </thead><tbody>
                        <?php foreach ($approvdAppntsData as $approvdAppntData) { ?>
                            <tr>
                                <td><?php echo $approvdAppntData['make']; ?></td>
                                <td><?php echo $approvdAppntData['model']; ?></td>
                                <td><?php echo $approvdAppntData['year']; ?></td>
                                <td><?php echo $approvdAppntData['date']; ?></td>
                                <td><?php echo $approvdAppntData['time']; ?></td>
                                <td><a href="workOn.php?id=<?= $approvdAppntData['id']; ?>" class="action-link text-primary">🔧 Work on</a></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            <?php } ?>
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

