<?php 
   session_start();
   include_once('database/config.php');
   $user_id = $_SESSION['id'];

   if ($_SESSION['is_admin'] == 'true') {
    $sql = "SELECT appointments.id, appointments.make, appointments.model, appointments.date, appointments.time, appointments.is_approved
            FROM appointments
            INNER JOIN users ON users.id = appointments.user_id
            WHERE appointments.is_approved = 'false'";

    $selectAppointments = $conn->prepare($sql);
    $selectAppointments->execute();
    $appointments_data = $selectAppointments->fetchAll();
} else {
    $sql = "SELECT appointments.date, appointments.time, appointments.is_approved 
            FROM appointments
            INNER JOIN users ON users.id = appointments.user_id 
            WHERE appointments.is_approved = 'false'
            AND appointments.user_id = :user_id";

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
                        <li class="nav-item"><a class="nav-link active" href="dashboard.php">Dashboard</a></li>
                        <li class="nav-item"><a class="nav-link" href="list_movies.php">Movies</a></li>
                        <li class="nav-item"><a class="nav-link" href="appointments.php">Appointments</a></li>
                    <?php } else { ?>
                        <li class="nav-item"><a class="nav-link" href="home.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="appointments.php">Appointments</a></li>
                    <?php } ?>
                </ul>
            </div>
        </nav>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <h2>Mechanic Appointments</h2>
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th scope="col">Make</th>
                            <th scope="col">Model</th>
                            <th scope="col">Date</th>
                            <th scope="col">Time</th>
                            <?php if ($_SESSION['is_admin'] == 'true') { ?>
                                <th scope="col">Status</th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($appointments_data as $appointment_data) { ?>
                        <tr>
                            <td><?php echo $appointment_data['make']; ?></td>
                            <td><?php echo $appointment_data['model']; ?></td>
                            <td><?php echo $appointment_data['date']; ?></td>
                            <td><?php echo $appointment_data['time']; ?></td>
                            <?php if ($_SESSION['is_admin'] == 'true') { ?>
                                <td>N/A</td>
                                <td><a href="approve.php?id=<?= $appointment_data['id']; ?>">Approve</a></td>
                                <td><a href="decline.php?id=<?= $appointment_data['id']; ?>">Decline</a></td>
                            <?php } ?>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

