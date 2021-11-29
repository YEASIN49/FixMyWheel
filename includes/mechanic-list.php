<?php

	$allMechanics;

	$fetch_mechanic = "SELECT `mechanic_id`, `mechanic_name`, `car_fixed`, `experience`, `car_booked` FROM `mechanics`";

	$allMechanics=$conn->query($fetch_mechanic) or die('<script>alert("Mechanic List Fetching failed!");</script>');

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
					<h4 class="mechanic-title"><?php echo $row['mechanic_name']; ?></h4>
					<p>ID : <?php echo $row['mechanic_id']; ?></p>
					<p>Car Fixed : <?php echo $row['car_fixed']; ?></p>
					<p>Experience : <?php echo $row['experience']; ?> year(s)</p>
					<p>Remaining Car Slot : <strong> <?php echo 4 - $row['car_booked']; ?></strong></p>
					<p >Status : 
						<!-- PHP BELOW -->
						<?php if($row['car_booked'] < 4){ ?>
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
		
	</div>
</section>