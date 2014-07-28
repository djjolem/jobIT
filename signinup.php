<!DOCTYPE html>
<?php
	session_start();
  include 'dbConnect.php';
  $model = new DBConnection;



 	if (isset($_POST['signout']) && $_POST['signout'] == "signout") {
 		# sign out
 		var_dump($_POST);
 		unset($_SESSION['signedin']);

 		echo $_SERVER['HTTP_REFERER']; 

 		if ($_SERVER['HTTP_REFERER'] == 'settings.php'){
 			header("Location: " . index.phpi . ""); 
 		}
 		header("Location: " . $_SERVER['HTTP_REFERER'] . "");
 	}



  if (isset($_POST['signin']) && $_POST['signin'] == 'signin') {
  	# sign in 
  	$user = $_POST['userid']; 
  	$pass = $_POST['passwordinput']; 

  	$signin = $model->signinUser($user, $pass);
  	if ($signin){
  		$_SESSION['signedin'] = true;
  		$_SESSION['user_name'] = $user; 
  		$_SESSION['user_id'] = $model->getUserId($user); 
  	} else {
  		echo "Not signed in ";
  	}

		header("Location: " . $_SERVER['HTTP_REFERER'] . "");
  }



  if (isset($_POST['signup']) && $_POST['signup'] == 'signup') {
  	# new user

		if (defined("CRYPT_BLOWFISH") && CRYPT_BLOWFISH){
			$email = $_POST['email']; 
			$user = $_POST['userid'];
			$pass1 = $_POST['password'];
			$pass2 = $_POST['reenterpassword'];

			if ($pass1 <> $pass2){
				echo "ERROR: passwords doesn't match.";
				header("errornewuser.php"); 	
			}

			# check if user exist 
			$userExists = $model->checkDoesUserExist($email, $user);
			
			if ($userExists){
				echo "ERROR: user already exists."; 
				header("errornewuser.php");
				return; 
			}

			$model->insertNewUser($email, $user, $pass1);
			
			$_SESSION['signedin'] = true;
  		$_SESSION['user_name'] = $user; 

			header("Location: " . $_SERVER['HTTP_REFERER'] . "");
		}
	}

	echo "ERROR: canno't find action"; 
	header("errornewuser.php");

