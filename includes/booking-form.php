<?php 
// include("includes/config.php");


	$mechanicsData;

	// global $conn;
	// $email =$_SESSION["email"];
	// $employer_id = $_SESSION["id"];
	// $roletype = $_SESSION["role"];
	$fetch_mechanic = "SELECT `id`, `name`, `car_booked` FROM `mechanics`";

	$mechanicsData=$conn->query($fetch_mechanic) or die('<script>alert("Mechanics Data Fetching failed!");</script>');

	

if(isset($_POST['create'])){


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
	// $user_id = '555';
	echo $mechanic_id;
	echo "test";
	echo $current_slot;
	
	
	function insertQuery($sqlQuery){
		global $conn;
		// global $roletype;
		// $conn->query($sqlQuery) or die('<script>alert("Something Wrong! Appointment failed!");</script>');
		$result=$conn->query($sqlQuery);
		if ($result) {
			echo '<script>alert("Appointment Successfull")</script>';
			// echo '<script>location.replace("postedJob.php")</script>';
			// sleep(2);
			// header("location:appliedJob.php"); 
			// die('');
			// exit();
		}else{
			echo '<script>alert("Appointment Failed")</script>';
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
			$appoinement_query = "INSERT INTO `appointments`(`name`, `address`, `phone`, `license_no`, `engine_no`, `mechanic_id`, `appointment_date`) VALUES ('$name','$address','$phone','$license','$engine', '$mechanic_id', '$appintment_date')"; 
			insertQuery($appoinement_query);
		}
		else{
			echo '<script>alert("Appointment already scheduled")</script>';
		}

		// echo "<script>alert(".$current_slot.")</script>";
		// $appoinement_query = "INSERT INTO `appointments`(`name`, `address`, `phone`, `license_no`, `engine_no`, `mechanic_id`, `appointment_date`) VALUES ('$name','$address','$phone','$license','$engine', '$mechanic_id', '$appintment_date')"; 
		// insertQuery($appoinement_query);
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
					
					<option value="<?php echo ($row['id']." ". $row['car_booked']);?>">
						<span><?php echo $row['name'];?></span>
						<span>*ID-<?php echo $row['id'];?></span>
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

				<!-- <option value="001"><span>Mechanic A</span><span>ID-xxx</span><span>status</span></option>
				<option value="002"><span>Mechanic B</span><span>ID-xxx</span><span>status</span></option>
				<option value="003"><span>Mechanic C</span><span>ID-xxx</span><span>status</span></option>
				<option value="004"><span>Mechanic D</span><span>ID-xxx</span><span>status</span></option>
				<option value="005"><span>Mechanic E</span><span>ID-xxx</span><span>status</span></option> -->
			</select>
			<?php /*
				foreach ($mechanicsData as $row) {  ?>
				<input type="hidden" name="" value="<?php echo $row['car_booked'] ?>">
			<?php } */?>
			<br>
			<label class="appointment-label" for="appoinment-date">Appoinment Date : </label>
			<input required class="appoinment-input dateBox" type="date" name="appintment-date">
			
			<input class="submitBtn" type="submit" name="create" placeholder="Submit">
		</form>
	</div>
</section>