<?php 

	session_start();
	include("includes/config.php");

	$allAppointments;

	$fetchAppointments = "SELECT `id`, `name`, `address`, `phone`, `license_no`, `engine_no`, `mechanic_id`, `appointment_date` FROM `appointments`";

	$allAppointments=$conn->query($fetchAppointments) or die('<script>alert("Appointment List Fetching failed!");</script>');

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
		<div class="appointment-container">
			<table>
				<thead>
					<tr class="table-header">
						<th>ID</th>
						<th>Username</th>
						<th>Phone</th>
						<th>License No.</th>
						<th>Engine No.</th>
						<th>Appointment</th>
						<th>Mechanic ID</th>
					</tr>	
				</thead>
				<tbody>
					<?php 
					
					foreach($allAppointments as $row){ ?>
						<tr>
							<td><?php echo $row['id'] ?></td>
							<td><?php echo $row['name'] ?></td>
							<td><?php echo $row['phone'] ?></td>
							<td><?php echo $row['license_no'] ?></td>
							<td><?php echo $row['engine_no'] ?></td>
							<td class="update-cell"><?php echo $row['appointment_date'] ?>
								<button class="submitBtn updateBtn input-toggler" onClick='openEditField(event)'>Edit</button>
								<form class="edit-form display-hidden" action="" method="POST">
									<input type="hidden" value="appointment_date">
									<input class="update-field" type="date">
									<input class="submitBtn updateBtn" type="submit" value="save">
								</form>
							</td>
							<td class="update-cell"><?php echo $row['mechanic_id'] ?>
								<button class="submitBtn updateBtn input-toggler" onClick='openEditField(event)'>Edit</button>
								<form class="edit-form display-hidden" action="" method="POST">
									<input type="hidden" value="appointment_date">
									<input class="update-field" type="date">
									<input class="submitBtn updateBtn" type="submit" value="save">
								</form>
							</td>
						</tr>
					<?php } ?>
					
				</tbody>
			</table>
		</div>
	</section>
	<script>


		const openEditField = (event) => {
			let targetNeighbour = event.target;
			let targetForm = targetNeighbour.nextElementSibling;
			// console.log(targetNeighbour.nextElementSibling);
			targetForm.classList.replace("display-hidden","display-block");
			// console.log(targetForm.classList);
		}

	</script>
</body>
</html>	