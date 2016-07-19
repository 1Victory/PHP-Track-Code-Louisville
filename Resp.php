<?php

  if (isset($_POST['submit'])) {

	//$blog_id = $_POST['blog_id'];
	$blog_id = $_POST['blog_id'];
    $response = $_POST['response'];
	if(isset($_POST['user_id'])){
	$useID = $_POST['user_id'];}
  }
  
  

	try{
	$db = new PDO("mysql:host=localhost;dbname=posBlog;","root","");
		$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		$db->exec("SET NAMES 'utf8'");
	}catch (Exception $e){
		echo "The query did not execute.";
		exit;
	}

   
	$data1 = $db->query("SELECT * FROM pos_response
	JOIN pos_member");
	//$dataA = $db->query("SELECT * FROM positive");
      //$data = $db->query("SELECT * FROM blog");
	  //$Ques = $results->fetchAll(PDO::FETCH_ASSOC);
	   
	
	//header redirect after database insert -- in the redirect repass variable username with ?username=$username--with post
	  if ($data1) {
        $Res = $db->query("INSERT INTO pos_response (blog_id, response, user_id) VALUES ('$blog_id','$response','$useID')");   
		$Res1 = $db->query("SELECT username from pos_member WHERE pos_member.id = '$useID' "); 
			foreach($Res1 as $Re){
			$user_username = $Re['username'];
			}
		
		header("location:blogB9.php?username=". $user_username);
		echo "This all worked";
		}


//$Resps = $Res->fetchAll(PDO::FETCH_ASSOC);


