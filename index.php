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

	<title>Fix My Wheel</title>
</head>
<body>
	<?php include("includes/nav.php");?>
	<?php include("includes/hero-header.php");?>
	<?php include("includes/booking-form.php");?>


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