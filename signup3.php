<?php
  //require_once('connectvars.php');
  	try{
	$db = new PDO("mysql:host=localhost;dbname=posBlog;","root","");
		$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		$db->exec("SET NAMES 'utf8'");
	}catch (Exception $e){
		echo "The query did not execute.";
		exit;
	}

  // Start the session
  session_start();

  // Clear the error message
  $error_msg = "";

  // If the user isn't logged in, try to log them in
  if (!isset($_SESSION['user_id'])) {
    if (isset($_POST['submit'])) {
      // Connect to the database
	  
	  
      // Grab the user-entered log-in data
      $user_username = trim($_POST['username']);
      $user_email = trim($_POST['email']);
	  
	


      if (!empty($user_username) && !empty($user_email)) {
        // Look up the username and password in the database
		$data2 = $db->query("SELECT username, email FROM pos_member WHERE username = '$user_username' AND email = '$user_email' "); 

		$row1 = $data2->fetch(PDO::FETCH_ASSOC);

		$rowCount = $data2->rowCount();
		if($rowCount === 1){
		echo "There is already a member in our system with these credentials " . $row1['username'];

	
	   }else if($rowCount === 0){
		  echo "hello";
		   
		$data3 = $db->query("SELECT * FROM pos_member");
		
		//$row2 = $data2->fetch(PDO::FETCH_ASSOC);
	  if ($data3) {
        $db->query("INSERT INTO pos_member (username, email) VALUES ('$user_username','$user_email')");
		

		
		   
	   }
	   $row2 = $data3->fetch(PDO::FETCH_ASSOC);
	   
	   header("location:blogB9.php?username=". $user_username);

		echo "Welcome to the site   " . $user_username;

  if (isset($_SESSION['user_id'])) {
    // Delete the session vars by clearing the $_SESSION array
    $_SESSION = array();

    // Delete the session cookie by setting its expiration to an hour ago (3600)
    if (isset($_COOKIE[session_name()])) {
      setcookie(session_name(), '', time() - 3600);
    }

    // Destroy the session
    session_destroy();
  }

  // Delete the user ID and username cookies by setting their expirations to an hour ago (3600)
  setcookie('user_id', '', time() - 3600);
  setcookie('username', '', time() - 3600);


	   }else {
          // The username/password are incorrect so set an error message
          $error_msg = 'Sorry, you must enter a valid username and password to log in.';
        }
    }
  }
	

?>

  <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <fieldset>
      <legend>Log In</legend>
      <label for="username">Username:</label>
      <input type="text" name="username" value="<?php if (!empty($user_username)) echo $user_username; ?>" /><br />
      <label for="email">Email:</label>
      <input type="text" name="email" />
    </fieldset>
    <input type="submit" value="Log In" name="submit" />
  </form>

<?php
  }
  else {
    // Confirm the successful log-in
    echo('<p class="login">You are logged in as ' . $_SESSION['username'] . '.</p>');
  }

?>

