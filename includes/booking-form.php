<?php 

	$mechanicsData;

	$fetch_mechanic = "SELECT `mechanic_id`, `mechanic_name`, `car_booked` FROM `mechanics`";

	$mechanicsData=$conn->query($fetch_mechanic) or die('<script>alert("Mechanics Data Fetching failed!");</script>');

	

if(isset($_POST['book'])){


	$form_mechanicID_slot_string = $_POST['mechanic'];
	$form_mechanicID_slot_array = explode(" ",$form_mechanicID_slot_string);

	$name = $_POST['username'];
	$address = $_POST['address'];
	$phone = $_POST['phone'];
	$license = $_POST['license'];
	$engine = $_POST['engine'];
	$mechanic_id = $form_mechanicID_slot_array[0];
	$appintment_date = $_POST['appintment-date'];
	$current_slot = $form_mechanicID_slot_array[1];
	
	
	function insertQuery($sqlQuery){
		global $conn;
		
		$result=$conn->query($sqlQuery);
		if ($result) {
			echo '<script>alert("Appointment Successfull")</script>';
		}else{
			echo '<script>alert("Appointment Failed")</script>';
		}
		
	}
	function updateMechanicCarCount($updateQuery){
		global $conn;
		
		$updateCount=$conn->query($updateQuery);
		if ($updateCount) {
			echo '<script>alert("mechanic car count updated")</script>';
			// echo '<script>location.replace("postedJob.php")</script>';
			// header("location:appliedJob.php"); 
			// die('');
			// exit();
		}else{
			echo '<script>alert("mechanic car count update failed")</script>';
		}
	}


	if($current_slot < 4){
		$check_duplicate_appointment = "SELECT `engine_no`, `appointment_date`, COUNT(`appointment_date`) FROM `appointments` WHERE `engine_no` = $engine AND `appointment_date` > DATE_SUB('$appintment_date', INTERVAL 1 DAY) AND `appointment_date` < DATE_ADD('$appintment_date', INTERVAL 1 DAY) GROUP BY `engine_no` , `appointment_date` HAVING COUNT(`appointment_date`) >= 1";

		$test= $conn->query($check_duplicate_appointment) or die('<script>alert("Something Wrong! Appointment failed!");</script>');
		
		$shouldAppoint = true;
		
		// print_r($test); 
		foreach($test as $row){
			if($row['COUNT(`appointment_date`)'] >= 1){
				
				$shouldAppoint = false;
				echo json_encode($shouldAppoint);
			}
		}

		if($shouldAppoint){ 
			$newCount = $current_slot+1;
			$appoinement_query = "INSERT INTO `appointments`(`name`, `address`, `phone`, `license_no`, `engine_no`, `mechanic_id`, `appointment_date`) VALUES ('$name','$address','$phone','$license','$engine', '$mechanic_id', '$appintment_date')"; 
			$update_car_count_query = "UPDATE `mechanics` SET `car_booked` = $newCount WHERE `mechanics`.`mechanic_id` = $mechanic_id";
			insertQuery($appoinement_query);
			updateMechanicCarCount($update_car_count_query);
		}
		else{
			echo '<script>alert("Appointment already scheduled")</script>';
		}

	}
	else{
		echo '<script>alert("Pleae select another mechanic. Currently selected mechanic is not available for service!")</script>';
	}
	

}

?>



<section id="section-bookingForm" class="sectionWrapper f-article">
	<div class="sectionHeader">
		<h1>BOOK A MECHANIC <sup class="material-icons">
handyman
</sup></h1>
	</div>
	<div class="formContainer">
		<form action="<?php htmlentities($_SERVER['PHP_SELF']);?>" method="POST">
			<input required class="appoinment-input" type="text" name="username" placeholder="Your Name*">
			<input required class="appoinment-input" type="text" name="address" placeholder="Your Address*">
			<input required class="appoinment-input" type="tel" name="phone" placeholder="Your Phone*">
			<input required class="appoinment-input" type="text" name="license" placeholder="Driving License*">
			<input required class="appoinment-input" type="text" name="engine" placeholder="Engine Number*">
			<select class="appoinment-input" name="mechanic" placeholder="Select a mechanic">
				<?php foreach ($mechanicsData as $row) {  ?>
					
					<option value="<?php echo ($row['mechanic_id']." ". $row['car_booked']);?>">
						<span><?php echo $row['mechanic_name'];?></span>
						<span>*ID-<?php echo $row['mechanic_id'];?></span>
						<?php  if($row['car_booked'] < 4){ ?>
							<span class="mechanic-status available"> 
							<?php 
								echo "(available)"; 
							}else { ?>
								<span class="mechanic-status booked">
								<?php 
									echo "(booked)"; 
								} ?>
						</span>
					</option>
					
				<?php } ?>	

			</select>
			<br>
			<label class="appointment-label" for="appoinment-date">Appoinment Date : </label>
			<input required class="appoinment-input dateBox" type="date" name="appintment-date">
			
			<input class="submitBtn" type="submit" name="book" placeholder="Submit">
		</form>
	</div>
</section>