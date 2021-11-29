<?php
$isLogin= false;
if(isset($_SESSION['isLogin']) && isset($_SESSION['email'])){
	$isLogin = true;
}
?>
<nav class="navWrapper">
	<div class="navContainer">
		<div class="siteNameContainer">
			<a href="./" class="siteName f-siteName">FixTheWheel</a>
		</div>
		

		<div class="hamburgerMenu">
			<span class="material-icons icons">menu</span>
		</div>
		
		<div id="nav-toggler" class="navMenuContainer f-title">
			<?php 
			if($isLogin){ ?>
				<a href="index.php">Home</a>
			<?php 
			}else{ ?>
				<a href="index.php">Home</a>
				<a href="#section-bookingForm">Appoinment</a>
			<?php
			}
			?>
			
			<div class="dropdown ">
			
				<?php 
				if($isLogin){ ?>
					<button class="dropdownBtn f-title"><span class="material-icons icons">admin_panel_settings</span>Admin<span class="material-icons">arrow_drop_down</span>
				</button>
				<?php 
				}else{ ?>
					<button class="dropdownBtn f-title"><span class="material-icons icons">login</span>Log In
				</button>
				<?php
				}
				?>

				
				<div class="dropdown-content">
					<div class="dropdown-items">
						<!-- <a href="#"><span class="material-icons icons">person</span>User Log In</a> -->
						
						<?php 
						
						if($isLogin){ ?>
							<a href="admin.php"><span class="material-icons icons">space_dashboard</span>Admin Panel</a>
							<a id="admin_logout" href="logout.php"><span class="material-icons icons">logout</span>Admin Log Out</a>
						<?php 
						}else{ ?>
							<a id="admin_login" href="#"><span class="material-icons icons">admin_panel_settings</span>Admin Log In</a>
						<?php
						}
						?>
					</div>
					<!-- <a href="#">Link 3</a> -->
				</div>
			</div> 
		</div>	
	</div>
</nav>