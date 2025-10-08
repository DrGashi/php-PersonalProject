<?php 

	 session_start();

   include_once('database/config.php');
   if (empty($_SESSION['username'])) {
          header("Location: login.php");
    }

   $id = $_GET['id'];

   $sql = "SELECT * FROM users WHERE id=:id";
   $selectUser = $conn->prepare($sql);
   $selectUser->bindParam(':id', $id);
   $selectUser->execute();

   $user_data = $selectUser->fetch();
	

 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>Dashboard</title>
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
.form-floating{
  margin: 10px 0;
}
  </style>
 </head>
 <body>
 
 
 <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#"><?php echo "Welcome to dashboard ".$_SESSION['username']; ?></a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
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
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group me-2">
            <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
            <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
          </div>
          <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
            <span data-feather="calendar"></span>
            This week
          </button>
        </div>
      </div>

    

      <h2>Edit user's details</h2>
      <div class="table-responsive">
        
        <form action="updateUsers.php" method="post">
    
        <div class="form-floating">
          <input type="number" class="form-control" id="floatingInput" placeholder="Id" name="id" value="<?php echo  $user_data['id'] ?>">
          <label for="floatingInput">Id</label>
        </div>
        <div class="form-floating">
          <input type="text" class="form-control" id="floatingInput" placeholder="Name" name="name" value="<?php echo  $user_data['name'] ?>">
          <label for="floatingInput">Name</label>
        </div>
        <div class="form-floating">
          <input type="text" class="form-control" id="floatingInput" placeholder="Username" name="username" value="<?php echo  $user_data['username'] ?>">
          <label for="floatingInput">Username</label>
        </div>
        <div class="form-floating">
          <input type="email" class="form-control" id="floatingInput" placeholder="Email" name="email" value="<?php echo  $user_data['email'] ?>">
          <label for="floatingInput">Email</label>
        </div>
        <div class="form-floating">
          <input type="email" class="form-control" id="floatingInput" placeholder="Admin" name="is_admin" value="<?php echo  $user_data['is_admin'] ?>">
          <label for="floatingInput">Admin</label>
        </div>
        <br>
        <button class="w-100 btn btn-lg btn-primary" type="submit" name="submit">Change</button>
      </form>


      </div>
    </main>
  </div>
</div>

	<script src="/docs/5.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

      <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="dashboard.js"></script>
  </body>
</html>

<script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
<script>
  feather.replace();
</script>
 </body>
 </html>