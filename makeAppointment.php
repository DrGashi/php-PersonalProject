<?php 
	  session_start();

    include_once('database/config.php');

    if (empty($_SESSION['username'])) {
          header("Location: login.php");
    }
   
    $sql = "SELECT * FROM users";
    $selectUsers = $conn->prepare($sql);
    $selectUsers->execute();
    $users_data = $selectUsers->fetchAll();
 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>Appointment</title>
 	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
 	 <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
  	<link rel="apple-touch-icon" href="/docs/5.1/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
	<link rel="icon" href="/docs/5.1/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
	<link rel="icon" href="/docs/5.1/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
	<link rel="manifest" href="/docs/5.1/assets/img/favicons/manifest.json">
	<link rel="mask-icon" href="/docs/5.1/assets/img/favicons/safari-pinned-tab.svg" color="#7952b3">
	<link rel="icon" href="/docs/5.1/assets/img/favicons/favicon.ico">
	<meta name="theme-color" content="#7952b3">
  <style>
    .form-floating{
      margin: 20px 0;
    }
    .nav-link i {
  margin-right: 8px;
  vertical-align: middle;
}
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
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#"><?php echo "Welcome to dashboard ".$_SESSION['username']; ?></a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
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
                        <li class="nav-item"><a class="nav-link active" href="workOnCar.php"><i data-feather="bar-chart-2"></i> Car Info</a></li>
                    <?php } else { ?>
                        <li class="nav-item"><a class="nav-link" href="appointments.php"><i data-feather="calendar"></i> Appointments</a></li>
                        <li class="nav-item"><a class="nav-link" href="makeAppointment.php"><i data-feather="plus-circle"></i> Make Appointment</a></li>
                    <?php } ?>
      </div>
    </nav>
    <main>
      <div class="album py-5 bg-light">
    <div class="container">
      <div class="container">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12 col-md-7 col-sm-6">
                    <form action="appnt.php" method="post">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="floatingInput" placeholder="Make" name="make" required>
                            <label for="floatingInput">Make</label>
                        </div>
                        <div class="form-floating">
                            <input type="text" class="form-control" id="floatingInput" placeholder="Model" name="model" required>
                            <label for="floatingInput">Model</label>
                        </div>
                        <div class="form-floating">
                            <input type="text" class="form-control" id="floatingInput" placeholder="Year" name="year" required>
                            <label for="floatingInput">Year</label>
                        </div>
                        <div class="form-floating">
                            <input type="file" class="form-control" id="floatingInput" placeholder="Image" name="image" required>
                        </div>
                        <div class="form-floating">
                            <input type="date" class="form-control" id="floatingInput" placeholder="Date" name="date" required>
                            <label for="floatingInput">Date</label>
                        </div>
                        <div class="form-floating">
                        <select name="time">
                            <option value="12:00">12:00</option>
                            <option value="15:00">15:00</option>
                            <option value="17:00">17:00</option>
                            <option value="19:00">19:00</option>
                        </select>
                        </div>
                        <button class="w-100 btn btn-lg btn-primary" type="submit" name="submit">Book</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
<script>
  feather.replace();
</script>
 </body>
 </html>