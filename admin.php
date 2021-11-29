<?php 

	session_start();
	include("includes/config.php");

	if(!isset($_SESSION['email']) or $_SESSION['isLogin'] != true){
		die('<script>alert("Please log in as an Admin first");
				location.replace("index.php");
		</script>');
	}
	else{
		$allAppointments;
		$allMechanics;
	
		$fetchAppointments = "SELECT appointments.id, appointments.name, appointments.phone, appointments.license_no, appointments.engine_no, appointments.appointment_date, appointments.mechanic_id, mechanics.mechanic_name, mechanics.car_booked FROM appointments INNER JOIN mechanics ON mechanics.mechanic_id=appointments.mechanic_id
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
			}else{
				echo '<script>alert("Appointment date update Failed")</script>';
			}
		}
		if(isset($_POST['changeMechanic'])){

			$form_mechanicID_slot_string = $_POST['newMechanic'];
			$form_mechanicID_slot_array = explode(" ",$form_mechanicID_slot_string);

			$newID = $form_mechanicID_slot_array[0];
			$newID_current_booking_count = $form_mechanicID_slot_array[1];
			$newID_new_car_count = $newID_current_booking_count+1;
			$rowID = $_POST['rowID-to-update'];
			$previous_mechanicID = $_POST['previous-mechanic-id'];
			$previous_mechanic_booking_count = $_POST['previous-mechanic-booking-count'];
			$prevMechanic_updated_car_count = $previous_mechanic_booking_count-1;

			// SQL Query
			$updateMechanicQuery = "UPDATE `appointments` SET `mechanic_id` = '$newID' WHERE `appointments`.`id` = $rowID";
			$updateBookingCountQuery = "UPDATE `mechanics` SET `car_booked` = '$newID_new_car_count' WHERE `mechanics`.`mechanic_id` = $newID ";
			$removePreviousBookingQuery = "UPDATE `mechanics` SET `car_booked` = '$prevMechanic_updated_car_count' WHERE `mechanics`.`mechanic_id` = $previous_mechanicID";
			
			// Query Execution
			$updateID=$conn->query($updateMechanicQuery);
			$updateAddedBookingCount=$conn->query($updateBookingCountQuery);
			$updateRemovedBookingCount=$conn->query($removePreviousBookingQuery);

			if ($updateRemovedBookingCount) {
	
				fetchUpdatedAppointments();
				fetchUpdatedMechanics();
				// header("Refresh:0");

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
									<input hidden type="number" name="previous-mechanic-id" value="<?php echo $row['mechanic_id'] ?>">
									<input hidden type="number" name="previous-mechanic-booking-count" value="<?php echo $row['car_booked'] ?>">
									<input type="hidden" name="rowID-to-update" value="<?php echo $row['id'] ?>">
									<!--  -->
									
									<select class="update-field" name="newMechanic" id="">
										<?php foreach($allMechanics as $mechanic){ 
											if($mechanic['car_booked'] < 4){ ?>
												<option value='<?php echo $mechanic['mechanic_id']." ".$mechanic['car_booked'] ?>'><?php echo $mechanic['mechanic_name'] ?></option>
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