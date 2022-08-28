<?php 
	session_start();
	include 'config.php';

	$update=false;

	    $id="";
		$name="";
		$surname="";
		$description="";
		$medication="";

	if(isset($_POST['add']))
	{
		$name =$_POST['name'];
		$surname=$_POST['surname'];
		$id = $_POST['id'];
		$description=$_POST['description'];
		$medication=$_POST['medication'];

		$query="INSERT INTO patients_description(name,surname,id,description,medication) VALUES (?,?,?,?,?)";
		$stmt=$conn->prepare($query);
		$stmt->bind_param("ssiss",$name,$surname,$id,$description,$medication);
		$stmt->execute();

		header('location:index.php');
		$_SESSION['response'] = "Successfully inserted into the database!";
		$_SESSION['res_type']="success";
	}
	if(isset($_GET['delete'])){
		$id=$_GET['delete'];

		$query="DELETE FROM patients_description WHERE id=?";
		$stmt=$conn->prepare($query);
		$stmt->bind_param("i",$id);
		$stmt->execute();

		header('location:index.php');
		$_SESSION['response'] = "Successfully Deleted!";
		$_SESSION['res_type']="danger";
	}
	if(isset($_GET['edit'])){
		$id=$_GET['edit'];

		$query="SELECT * FROM patients_description WHERE id=?";
		$stmt=$conn->prepare($query);
		$stmt->bind_param("i",$id);
		$stmt->execute();
		$result=$stmt->get_result();
		$row=$result->fetch_assoc();

		$id=$row['id'];
		$name=$row['name'];
		$surname=$row['surname'];
		$description=$row['description'];
		$medication=$row['medication'];

		$update=true;
	}
	if(isset($_POST['update'])){
		$id=$_POST['id'];
		$name=$_POST['name'];
		$surname=$_POST['surname'];
		$description=$_POST['description'];
		$medication=$_POST['medication'];

		$query="UPDATE patients_description SET name=?, surname=?, description=?, medication=? WHERE id=?";
		$stmt=$conn->prepare($query);
		$stmt->bind_param("ssssi", $name, $surname, $description, $medication, $id);
		$stmt->execute();

		$_SESSION['response']="updated Successfully";
		$_SESSION['res_type']="primary";
		header('location:index.php');
	}
	if (isset($_GET['details'])) {
		$id=$_GET['details'];
		$query="SELECT * FROM patients_description WHERE id=?";
		$stmt=$conn->prepare($query);
		$stmt->bind_param("i",$id);
		$stmt->execute();
		$result=$stmt->get_result();
		$row=$result->fetch_assoc();

		$vid=$row['id'];
		$vname=$row['name'];
		$vsurname=$row['surname'];
		$vdescription=$row['description'];
		$vmedication=$row['medication'];


	}
 ?>