<?php 

session_start();

include("includes/config.php");
// echo json_encode($isLogin);

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
	<?php include("includes/hero-header.php");?>
	<?php include("includes/booking-form.php");?>
	<?php include("includes/mechanic-list.php");?>
	<!-- Less preferred filed -->
	<?php include("login_admin.php")?>


	<script>
		let burgerBtnHolder = document.querySelector(".hamburgerMenu");
		let burgerContentToggler = document.querySelector(".navMenuContainer");

		burgerBtnHolder.addEventListener('click',()=>{	
			if(document.querySelector("#nav-toggler") != null){
				burgerContentToggler.classList.toggle("toggleNavMenu");
			}
		});

	</script>
	

</body>
</html>