<?php 
	include 'dbConnect.php';

  $model = new DBConnection;

  if (isset($_POST['user_id'])){
  	echo 'User id is set' . $_POST['user_id']; 
  } else {
  	echo 'User id is not set'; 
  }

	$model->insertNewAd($_POST['company'], $_POST['ad_title'], 
		$_POST['ad_description'], $_POST['ad_text'], $_POST['deadline'], $_POST['cb_tag'], $_POST['user_id']);

	// header('Location: index.php'); 

