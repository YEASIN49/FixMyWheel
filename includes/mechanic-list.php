<?php
// session_start();
	// include("includes/config.php");

	$allMechanics;

	// global $conn;
	// $email =$_SESSION["email"];
	// $employer_id = $_SESSION["id"];
	// $roletype = $_SESSION["role"];
	$fetch_mechanic = "SELECT `id`, `name`, `car_fixed`, `experience`, `status` FROM `mechanics`";

	$allMechanics=$conn->query($fetch_mechanic) or die('<script>alert("Mechanic List Fetching failed!");</script>');
	// echo ($allMechanics);
	// print_r($allMechanics);
	// while ($row= $allMechanics->fetch_assoc()) { // print object
    // 	echo $row['name'];
	// }
	// foreach ($allMechanics as $row) { // print object
	// 	echo $row['name'];
	// }

	

	// if (!empty($allMechanics)){
	// 	// echo ('("All job fetched")');
	
	// }else{
	// 	echo '("List Fetch Failed")';
	// }
?>




<section class="sectionWrapper f-article">
	<div class="section-divider"></div>
	<div class="sectionHeader">
		<h1>OUR MECHANICS <sup class="material-icons">handyman</sup></h1>
	</div>
	<div class="card-container">
		<?php 
		
		foreach ($allMechanics as $row) {  ?>
			
			<div class="mechanic-card">
			<div class="mechanic-card-content">
				<img src="./images/img-v-47.jpg" height="120px" width="120px" alt="">
				<p class="card-text-divider"></p>
				<div class="mechanic-info">
					<h4 class="mechanic-title"><?php echo $row['name']; ?></h4>
					<p>ID : <?php echo $row['id']; ?></p>
					<p>Car Fixed : <?php echo $row['car_fixed']; ?></p>
					<p>Experience : <?php echo $row['experience']; ?> year(s)</p>
					<p >Status : 
						<!-- PHP BELOW -->
						<?php if($row['status']){ ?>
						<span class="mechanic-status available"> 
							<?php 
								echo "available"; 
							 } else { ?>
							<span class="mechanic-status booked">
							<?php 
								echo "booked"; 
							} ?>
						</span>	
					</p>		
						
				</div>
			</div>
		</div>

	<?php }	?>
		
		<!-- <div class="mechanic-card">
			<div class="mechanic-card-content">
				<img src="./images/img-v-47.jpg" height="120px" width="120px" alt="">
				<p class="card-text-divider"></p>
				<div class="mechanic-info">
					<h4 class="mechanic-title">Name Here</h4>
					<p>ID Here</p>
					<p>Car Fixed : xxxx</p>
					<p>Experience : xxxx</p>
					<p >Status : <span class="mechanic-status booked"> booked</span></p>
				</div>
			</div>
		</div>
		<div class="mechanic-card">
			<div class="mechanic-card-content">
				<img src="./images/img-v-47.jpg" height="120px" width="120px" alt="">
				<p class="card-text-divider"></p>
				<div class="mechanic-info">
					<h4 class="mechanic-title">Name Here</h4>
					<p>ID Here</p>
					<p>Car Fixed : xxxx</p>
					<p>Experience : xxxx</p>
					<p >Status : <span class="mechanic-status available"> available</span></p>
				</div>
			</div>
		</div>
		<div class="mechanic-card">
			<div class="mechanic-card-content">
				<img src="./images/img-v-47.jpg" height="120px" width="120px" alt="">
				<p class="card-text-divider"></p>
				<div class="mechanic-info">
					<h4 class="mechanic-title">Name Here</h4>
					<p>ID Here</p>
					<p>Car Fixed : xxxx</p>
					<p>Experience : xxxx</p>
					<p >Status : <span class="mechanic-status available"> available</span></p>
				</div>
			</div>
		</div>
		<div class="mechanic-card">
			<div class="mechanic-card-content">
				<img src="./images/img-v-47.jpg" height="120px" width="120px" alt="">
				<p class="card-text-divider"></p>
				<div class="mechanic-info">
					<h4 class="mechanic-title">Name Here</h4>
					<p>ID Here</p>
					<p>Car Fixed : xxxx</p>
					<p>Experience : xxxx</p>
					<p >Status : <span class="mechanic-status booked"> booked</span></p>
				</div>
			</div>
		</div> -->
	</div>
</section>