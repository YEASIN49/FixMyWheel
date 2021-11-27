<?php 
// include("includes/config.php");


	$mechanicsData;

	// global $conn;
	// $email =$_SESSION["email"];
	// $employer_id = $_SESSION["id"];
	// $roletype = $_SESSION["role"];
	$fetch_mechanic = "SELECT `id`, `name`, `status` FROM `mechanics`";

	$mechanicsData=$conn->query($fetch_mechanic) or die('<script>alert("Mechanics Data Fetching failed!");</script>');


if(isset($_POST['create'])){

	$name = $_POST['username'];
	$address = $_POST['address'];
	$phone = $_POST['phone'];
	$license = $_POST['license'];
	$engine = $_POST['engine'];
	$mechanic_id = $_POST['mechanic'];
	$appintment_date = $_POST['appintment-date'];
	$user_id = '555';
	// echo "<script>alert('$sql')</script>";

	
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
			echo '<script>alert("Appointment Successfull")</script>';
		}
		
	}



	$appoinement_query = "INSERT INTO `appointments`(`name`, `address`, `phone`, `license_no`, `engine_no`, `mechanic_id`, `appointment_date`, `user_id`) VALUES ('$name','$address','$phone','$license','$engine', '$mechanic_id', '$appintment_date', '$user_id')"; 
	// "INSERT INTO `appointments`(`name`, `address`, `phone`, `license_no`, `engine_no`, `mechanic_id`, `appintment_date`, `user_id`) VALUES ";
	insertQuery($appoinement_query);
	

}

?>



<section class="sectionWrapper f-article">
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
					<option value="<?php echo $row['id'];?>">
						<span><?php echo $row['name'];?></span>
						<span>*ID-<?php echo $row['id'];?></span>
						<?php  if($row['status']){ ?>
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
			<br>
			<label class="appointment-label" for="appoinment-date">Appoinment Date : </label>
			<input required class="appoinment-input dateBox" type="date" name="appintment-date">
			
			<input class="submitBtn" type="submit" name="create" placeholder="Submit">
		</form>
	</div>
</section>