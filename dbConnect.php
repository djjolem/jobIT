<?php 

require('config.php');

class DBConnection {
	private $con; 

	function __construct(){
		$this->con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		if (mysqli_connect_error($this->con)){
			error_log ("DBConnection.php: Failed to connect to MySQL: " . mysqli_connect_error());
		}
	}

	function __destruct(){
		mysqli_close($this->con);
	}


	function getAds(){
		$str_query = "
			SELECT ja.job_id ,ja.title, ja.ad_short, ja.ad_text, ja.deadline, c.name as cname, group_concat(t.name SEPARATOR ',') as tags, us.user_name as owner
			FROM job_ad ja
			JOIN company c on (c.company_id = ja.company_id)
			JOIN user us on (us.user_id = ja.user_id)
			LEFT JOIN tags ts on (ts.job_ad_id = ja.job_id)
			LEFT JOIN tag t on (t.tag_id = ts.tag_id)
			WHERE ja.active = 1
				AND ja.deadline > DATE(NOW())
			GROUP BY ja.job_id
			ORDER BY ja.deadline ASC
		;
		";
		$result = mysqli_query($this->con, $str_query);

		$ret = array(); 
		while($row = mysqli_fetch_assoc($result)){
			array_push($ret, $row); 
		}

		return $ret; 
	}

	function getCompanies(){
		# hard coded - for now later it will be automatically get from user profile
		return array('Company 1', 'Company 2', 'Company 3');
	}

	function getTags(){
		$str_query = "
			SELECT t.tag_id, t.name as tname
			FROM tag t
			; 
		";

		$result = mysqli_query($this->con, $str_query);

		$ret = array(); 
		while($row = mysqli_fetch_assoc($result)){
			array_push($ret, $row); 
		}

		return $ret; 
	}

	function insertNewAd($company, $ad_title, $ad_description, $ad_text, $deadline, $tags_id, $user_id){
		if (!isset($user_id)){
			$user_id = 1; 
		}

		$str_query = "
			INSERT INTO job_ad 
			(company_id, title, ad_short, ad_text, deadline, created) 
			VALUES
			(" . $company . ", '" 	. $ad_title . "', '" . $ad_description . "', '
				" . $ad_text . "', '" . $deadline . "', '" . date("Y-m-d") . "')
			;
		"; 

		$result = mysqli_query($this->con, $str_query);
		$job_id =  mysqli_insert_id($this->con);


		if (isset($tags_id)){
			for($i=0; $i<sizeof($tags_id); $i++){
				$str_query = "
					INSERT INTO tags 
					(job_ad_id, tag_id) 
					VALUES ('" . $job_id . "', '" . $tags_id[$i] . "')
					;
				";

				$result = mysqli_query($this->con, $str_query);
			}
		}
	}

	# ********************************************************************************************************************

	function checkDoesUserExist($email, $user){
		$str_query = "
			SELECT count(*) AS num
			FROM user u
			WHERE u.user_name = '" . $user . "' OR u.user_email = '" . $email . "'
			; 
		";

		$result  = mysqli_query($this->con, $str_query);
		$num = mysqli_fetch_assoc($result); 

		if ($num['num'] == '1'){
			return true; 
		}

		return false; 
	}


	function insertNewUser($email, $user_name, $pass){
		$password = password_hash($pass, PASSWORD_BCRYPT);

		$str_query = "
			INSERT INTO user
			(user_email, user_name, user_password)
			VALUES
			('" . $email . "', '" . $user_name . "', '" . $password . "')
			;
		"; 

		$result = mysqli_query($this->con, $str_query);
	}

	function signinUser($user, $pass){
		$str_query = "
			SELECT user_password as pass
			FROM user
			WHERE user_name = '" . $user . "' OR user_email = '" . $user . "'
			;
		";
		$result = mysqli_query($this->con, $str_query); 
		$password = $result->fetch_assoc()['pass'];

		return password_verify($pass, $password);
	}

	# ********************************************************************************************************************

	function getUserId($user){
		$str_query = "
			SELECT user_id AS user_id
			FROM user u
			WHERE u.user_name = '" . $user . "'
			; 
		"; 

		$result = mysqli_query($this->con, $str_query); 
		$num = mysqli_fetch_assoc($result); 

		if (isset($num['user_id'])){
			return $num['user_id']; 
		}

		return 0; 
	}

}

