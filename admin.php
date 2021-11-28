<?php 

	session_start();
	include("includes/config.php");

	$allAppointments;
	$allMechanics;

	// $fetchAppointments = "SELECT `id`, `name`, `address`, `phone`, `license_no`, `engine_no`, `mechanic_id`, `appointment_date` FROM `appointments`";
	$fetchAppointments = "SELECT appointments.id, appointments.name, appointments.phone, appointments.license_no, appointments.engine_no, appointments.appointment_date, appointments.mechanic_id, mechanics.mechanic_name FROM appointments INNER JOIN mechanics ON mechanics.mechanic_id=appointments.mechanic_id
	ORDER BY appointments.id";
	$fetchMechanics = "SELECT `mechanic_id`, mechanic_name, `car_booked` FROM `mechanics`";
	
	function fetchUpdatedAppointments(){
		global $conn;
		global $fetchAppointments;
		global $allAppointments;
		$allAppointments=$conn->query($fetchAppointments) or die('<script>alert("Appointment List Fetching failed!");</script>');
	}
	function fetchUpdatedMechanics(){
		global $conn;
		global $fetchMechanics;
		global $allMechanics;
		$allMechanics=$conn->query($fetchMechanics) or die('<script>alert("Mechanics List Fetching failed!");</script>');
		// echo '<script>alert("mechanics updated")</script>';
	}

	fetchUpdatedAppointments();
	fetchUpdatedMechanics();


	if(isset($_POST['changeAppointment'])){
		$newDate = $_POST['appointment-date'];
		$rowID = $_POST['rowID-to-update'];
		// echo '<script>alert("Yes");</script>';
		$updateQuery = "UPDATE `appointments` SET `appointment_date` = '$newDate' WHERE `appointments`.`id` = $rowID";
		$updateDate=$conn->query($updateQuery);
		if ($updateDate) {
			fetchUpdatedAppointments();

			echo '<script>alert("Appointment date successfull updated")</script>';
			
			// echo '<script>location.replace("postedJob.php")</script>';
			// sleep(2);
			// header("location:appliedJob.php"); 
			// die('');
			// exit();
		}else{
			echo '<script>alert("Appointment date update Failed")</script>';
		}
	}
	if(isset($_POST['changeMechanic'])){
		$newID = $_POST['newID'];
		$rowID = $_POST['rowID-to-update'];
		// echo '<script>alert("Yes");</script>';
		$updateMechanicQuery = "UPDATE `appointments` SET `mechanic_id` = '$newID' WHERE `appointments`.`id` = $rowID";
		$updateID=$conn->query($updateMechanicQuery);
		if ($updateID) {
			fetchUpdatedMechanics();
			header("Refresh:0");
			echo '<script>alert("Mechanic successfull updated")</script>';
			// echo '<script>location.replace("postedJob.php")</script>';
			// sleep(2);
			// header("location:appliedJob.php"); 
			// die('');
			// exit();
		}else{
			echo '<script>alert("Mechanic update Failed")</script>';
		}
	}

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- fonts -->
	
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins&family=Roboto+Condensed:ital,wght@0,400;0,700;1,700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="css/index.css">	

	<!-- Icon  -->
	<link href="https://fonts.googleapis.com/css2?family=Material+Icons"
      rel="stylesheet">

	<title>Fix The Wheel</title>
</head>
<body>
	<?php include("includes/nav.php");?>
	<section id="section-bookingForm" class="sectionWrapper f-article">
		<div class="sectionHeader">
			<h1>All Appointments <sup class="material-icons">handyman</sup></h1>
		</div>
		<div class="appointment-list-container">
			<table>
				<thead>
					<tr class="table-header">
						<th>ID</th>
						<th>Username</th>
						<th>Phone</th>
						<th>License No.</th>
						<th>Engine No.</th>
						<th>Appointment</th>
						<th>Mechanic</th>
					</tr>	
				</thead>
				<tbody>
					<?php 
					
					foreach($allAppointments as $row){ ?>
						<tr>
							<td class="table-id"><?php echo $row['id'] ?></td>
							<td><?php echo $row['name'] ?></td>
							<td><?php echo $row['phone'] ?></td>
							<td><?php echo $row['license_no'] ?></td>
							<td><?php echo $row['engine_no'] ?></td>
							<td class="update-cell"><?php echo $row['appointment_date'] ?>
								<button class="submitBtn updateBtn input-toggler" onClick='openEditField(event)'>Edit</button>
								<form class="edit-form display-hidden" action="" method="POST">
									<input type="hidden" name="rowID-to-update" value="<?php echo $row['id'] ?>">
									<input class="update-field" name="appointment-date" type="date">
									<input class="submitBtn updateBtn" type="submit" name="changeAppointment" value="save">
								</form>
							</td>
							<td class="update-cell"><?php echo $row['mechanic_name'] ?>
								<button class="submitBtn updateBtn input-toggler" onClick='openEditField(event)'>Edit</button>
								<form class="edit-form display-hidden" action="" method="POST">
									<input type="hidden" name="rowID-to-update" value="<?php echo $row['id'] ?>">
									<!--  -->
									
									<select class="update-field" name="newID" id="">
										<?php foreach($allMechanics as $mechanic){ 
											if($mechanic['car_booked'] < 4){ ?>
												<option value="<?php echo $mechanic['mechanic_id'] ?>"><?php echo $mechanic['mechanic_name'] ?></option>
											<?php }
										 } ?>	
									</select>

									<!--  -->
									<!-- <input class="update-field" type="date"> -->
									<input class="submitBtn updateBtn" type="submit" name="changeMechanic" value="save">
								</form>
							</td>
						</tr>
					<?php } ?>
					
				</tbody>
			</table>
		</div>
	</section>
	<!-- update functions -->
	<script>


		const openEditField = (event) => {
			let targetNeighbour = event.target;
			let targetForm = targetNeighbour.nextElementSibling;
			// console.log(targetNeighbour.nextElementSibling);
			targetForm.classList.replace("display-hidden","display-block");
			// console.log(targetForm.classList);
		}

	</script>
	<!-- navbar functions -->
	<script>
		let burgerBtnHolder = document.querySelector(".hamburgerMenu");
		let burgerContentToggler = document.querySelector(".navMenuContainer");
		// let burgerContentToggler = document.querySelector("#nav-toggler");

		burgerBtnHolder.addEventListener('click',()=>{
			// if(burgerContentToggler.style.transform === "translate"){
				// console.log(getComputedStyle(burgerContentToggler));
				if(document.querySelector("#nav-toggler") != null){
					burgerContentToggler.classList.toggle("toggleNavMenu");
				}
				// }else{
				// burgerContentToggler.style.display = "block";
			// }
		});

	</script>
</body>
</html>	