<?php
 
		include 'action.php';

		$_SESSION;
		include'config.php';
	
		include 'functions.php';

		$user_data = check_login($conn);
 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title></title>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
 <nav class="navbar navbar-expand-md bg-dark navbar-dark">
  <!-- Brand -->
  <a class="navbar-brand" href="#">Clinic Files</a>

  <!-- Toggler/collapsibe Button -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>

  <!-- Navbar links -->
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="#">Files</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Services</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Resources</a>
         <li class="nav-item">
       <a class="nav-link" href="logout.php">Logout</a>
      </li>
    </ul>
  </div>
  <form class="form-inline" action="/action_page.php">
    <input class="form-control mr-sm-2" type="text" placeholder="Search">
    <button class="btn btn-primary" type="submit">Search</button>
  </form>
</nav> 
	<div class="container-fluid">
		<div class="row justify-content-center">
			<div class="col-md-10">
				<h3 class="text-center text-dark" mt-2>Clinic Name</h3>
				<hr>
				<?php if(isset($_SESSION['response'])){ ?>
				<div class="alert alert-<?=$_SESSION['res_type'] ?> alert-dismissible" text-center>
				  <button type="button" class="close" data-dismiss="alert">&times;</button>
				  <b><?= $_SESSION['response']; ?></b>
				</div>
				<?php } unset($_SESSION['response']); ?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				<h3 class="text-center text-info">Add Patient details</h3>
				<form action="action.php" method="post" enctype="multipart/form-data">

					<input type="hidden" name="id" value="<?= $id; ?>">
					<div class="form-group">
						<input type= "text" name="name" value="<?= $name; ?>" class="form-control" placeholder="Enter name" required>
					</div>

					<div class="form-group">
						<input type= "text" name="surname"  value="<?= $surname; ?>" class="form-control" placeholder="Enter Surname" required>
					</div>
					<div class="form-group">
						<input type= "text" name="id" value="<?= $id; ?>" class="form-control" placeholder="Enter id number" required>
					</div>
					<div class="form-group">
						<input type= "text" name="description" value="<?= $description; ?>" class="form-control" placeholder="Patient's description" required>
					</div>
					<div class="form-group">
						<input type= "text" name="medication" value="<?= $medication; ?>" class="form-control" placeholder="Medication given" required>
					</div>
					<div class="form-group">
						<?php if($update==true){ ?>
						<input type="submit" name="update" class="btn btn-success btn-block"
						value="Update Record">
						<?php }else{ ?>
						<input type="submit" name="add" class="btn btn-primary btn-block"
						value="Add Patient"><?php } ?>

					</div>
				</form>
			</div>
			<div class="col-md-8">
				<?php 
						$query="SELECT * from patients_description";
						$stmt=$conn->prepare($query);
						$stmt->execute();
						$result=$stmt->get_result();
				 ?>
				<h3 class="text-center text-info">Records Present in the Database</h3>
				<table class="table table-striped">
				    <thead>
				      <tr>
				        <th>Name</th>
				        <th>Surname</th>
				        <th>ID Number</th>
				        <th>Patient's description</th>
				        <th>Prescribed medications</th>
				        <th>Action</th>
				      </tr>
				    </thead>
				    <tbody>
				    	<?php while($row=$result->fetch_assoc()){ ?>
				      <tr>
				        <td><?=$row['name']; ?></td>
				        <td><?=$row['surname']; ?></td>
				        <td><?=$row['id']; ?></td>
				        <td><?=$row['description']; ?></td>
				        <td><?=$row['medication']; ?></td>
				        <td>
				        	<a href="details.php?details=<?=$row['id'];?>" class="badge badge-primary p-1">Details</a> |
				        	<a href="action.php?delete=<?=$row['id'];?>" class="badge badge-danger p-1" onclick="return confirm('Do you want to delete this record?');">Delete</a> |
				        	<a href="index.php?edit=<?=$row['id'];?>" class="badge badge-success p-1">Update</a> |
				        </td>
				      </tr>
				    <?php } ?>
				    </tbody>
				  </table>
			</div>
		</div>
	</div>
</body>
</html>