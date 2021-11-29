<?php 
	// $_SESSION['isLogin'] = false;

	if(isset($_POST['signin'])){
		$admin_email = $_POST['admin-email'];
		$admin_password = $_POST['password'];

		
		function checkLoginCredential($check_query){
			global $conn;

			$check_credential_result = $conn->query($check_query);

			if ($row= $check_credential_result->fetch_assoc()) {
				
				// echo '<script>alert("Logged In")</script>';
				// $_SESSION['id'] = $row['admin_id'];
				$_SESSION['email'] = $_POST['admin-email']; 
				$_SESSION['isLogin'] = true; 
				$isLogin = true;
				// echo ('<script>
				// const loc = window.location.href;
				// </script>');
				// header('Location:'.$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']);
				// header('Location: '.$_SERVER['PHP_SELF']);
				// die;
				// echo ;
				// echo ('<script>alert("Logged In")</script>');
				// die('<pre>' . print_r($_SESSION, TRUE) . '</pre'); //this is to show all the session variable
				die("<script>alert('Successfully Logged In');
					location.replace('admin.php');
				</script>");
				// exit();
			}else{
				echo '<script>alert("Admin Log In Failed!")</script>';
			}
			
		}
		$check_credential_query = "SELECT `email`, `password` FROM `admin` WHERE `email` ='$admin_email' and `password` = '$admin_password'";
		checkLoginCredential($check_credential_query);
	}

?>


<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header f-article">
      <span class="close">&times;</span>
      <h2>Admin Login</h2>
    </div>
    <div class="modal-body">
		<form action="<?php htmlentities($_SERVER['PHP_SELF']);?>" method="POST">
			<input required class="appoinment-input admin-modal-input" type="text" name="admin-email" placeholder="Your Email">
			<input required class="appoinment-input admin-modal-input" type="text" name="password" placeholder="Password">
			<!-- <input required class="appoinment-input" type="tel" name="phone" placeholder="Your Phone*">
			<input required class="appoinment-input" type="text" name="license" placeholder="Driving License*">
			<input required class="appoinment-input" type="text" name="engine" placeholder="Engine Number*"> -->
			
			<!-- <br> -->
			<!-- <label class="appointment-label" for="appoinment-date">Appoinment Date : </label>
			<input required class="appoinment-input dateBox" type="date" name="appintment-date"> -->
			
			<input class="submitBtn" type="submit" name="signin" value="Sign In">
		</form>
		<div class="review-access-content">
			<p class="f-article review-text-title">To review the functionality, credential is provided below</>
			<p class="f-title">Access Email : test3@gmail.com</p>
			<p class="f-title">Password : qsda</p>
		</div>
    </div>
  </div>

</div>

<script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("admin_login");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>