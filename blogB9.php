<?php
//Can do this and would need no session stuff whatsover.
//$username =  $_GET['username'];
/*
session_start();
$username =  $_SESSION['username'];
*/
$username ="";
$useID="";
if(isset($_GET['username'])){
$username = $_GET['username'];
}
	try{
	$db = new PDO("mysql:host=localhost;dbname=posblog;","root","");
		$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		$db->exec("SET NAMES 'utf8'");
	}catch (Exception $e){
		echo "The query did not execute. At all";
		exit;
	}
  if (isset($_POST['submit'])) {

	//$blog_id = $_POST['blog_id'];
	$blog_id = $_POST['blog_id'];
    $response = $_POST['response'];
	if(isset($_POST['user_id'])){
	$useID = $_POST['user_id'];}

    //if (!empty($blog_comments) OR !empty($reply)) {
	if (!empty($response) ) {
   
	$data1 = $db->query("SELECT * FROM pos_response
	JOIN pos_member");
	//$dataA = $db->query("SELECT * FROM positive");
      //$data = $db->query("SELECT * FROM blog");
	  //$Ques = $results->fetchAll(PDO::FETCH_ASSOC);
	   
	//header redirect after database insert -- in the redirect repass variable username with ?username=$username--with post
	  if ($data1) {
        $db->query("INSERT INTO pos_response (blog_id, response, user_id) VALUES ('$blog_id','$response','$useID')");   
		
		}
	  }
  }
  

	try{
	$db = new PDO("mysql:host=localhost;dbname=posblog;","root","");
	//var_dump($db);
		$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		$db->exec("SET NAMES 'utf8'");
		


		//$results = $db->query("SELECT id, blog_comments, reply FROM blog ORDER BY id ASC");
		$results = $db->query("SELECT id, blog_comments, reply FROM pos_blog ORDER BY RAND() LIMIT 3");
		$results1 = $db->query("SELECT id, blog_id, user_id, response FROM pos_response ORDER BY id ASC");
		$results2 = $db->query("SELECT id, username  FROM  pos_member ORDER BY id ASC");
		if(isset($username)){
		$results3 = $db->query("SELECT *   FROM  pos_member WHERE username = '$username'");}
		//echo "Our query ran succefully.";
	}catch (Exception $e){
		echo "The query did not execute.";
		exit;
	}

	
	
	$products = $results->fetchAll(PDO::FETCH_ASSOC);
	$response = $results1->fetchAll(PDO::FETCH_ASSOC);
	$responder = $results2->fetchAll(PDO::FETCH_ASSOC);
	$responder1 = $results3->fetchAll(PDO::FETCH_ASSOC);
	
	
	$prod = $results->fetchColumn(1);


	
//$random = array_rand($products,4);

$results->fetchColumn(1);


?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Justified Nav Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/justified-nav.css" rel="stylesheet">
	 <link href="css/new.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container">

      <!-- The justified navigation menu is meant for single line per list item.
           Multiple lines will require custom code not provided by Bootstrap. -->
      <div class="masthead">
        <h3 class="text-muted">Project name</h3>
        <nav>
          <ul class="nav nav-justified">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="#">Projects</a></li>
            <li><a href="#">Services</a></li>
            <li><a href="#">Downloads</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Contact</a></li>
          </ul>
        </nav>
      </div>

      <!-- Jumbotron -->
      <div class="jumbotron">
        <h1>Blogging stuff!</h1>
		<h2><?php echo "Welcome to the site  " . $username; ?> </h2>
		<p class="lead">This blog will allow you to make posts and respond to posts already listed..</p>
        <p><a class="btn btn-lg btn-success" href="#" role="button">Get started today</a></p>
		<a href="signIn.php">Create and Account</a>
		<a href="login.php">Login</a>
      </div>

      <!-- Example row of columns -->
      <div class="row">
        <div class="col-lg-8">
          <h2>Get Ready!</h2>
          <p class="text-danger">Make sure you first login in or sign up before trying to post or respond to information.</p>
          <p>DGood luck and thank you for contributing. </p>
          <p><a class="btn btn-primary" href="#" role="button">View details &raquo;</a></p>
		    
	

	  
      <textarea rows="4" cols="50" name="reply"></textarea><br />
	   <label for="reply">Reply</label><br>
	   
<?php
foreach($responder1 as $a) {
//we can create a sesssion variable and put it in a hidden field. Create if not exists	
foreach($products as $i) {
echo '<form method="post" action="Resp.php " class="blg"><fieldset><legend>Blog</legend>';
	echo '<input type="hidden" name="blog_id" value="'.$i["id"].'" />';
	echo '<input type="hidden" name="user_id" value="'.$a["id"].'" />';

	echo '<h4 class="h4">'.$i["blog_comments"] . $i["id"].'</h4>'."<br />";
	     echo '<textarea rows="4" cols="50" name="response"></textarea>
		<br> <input type="submit" value="Enter Data" name="submit" class="btn btn-primary" /></form><br />
	  <label for="Comments"></label><br></fieldset> ';
}
}
 ?>

<?php
foreach($responder1 as $a) {
//we can create a sesssion variable and put it in a hidden field. Create if not exists	
foreach($products as $i) {
echo '<form method="post" action="Resp.php " class="blg"><fieldset><legend>Blog</legend>';
	echo '<input type="hidden" name="blog_id" value="'.$i["id"].'" />';
	echo '<input type="hidden" name="user_id" value="'.$a["id"].'" />';

	echo '<h4 class="h4">'.$i["blog_comments"] . $i["id"].'</h4>'."<br />";
	     echo '<textarea rows="4" cols="50" name="response"></textarea>
		<br> <input type="submit" value="Enter Data" name="submit" class="btn btn-primary" /></form><br />
	  <label for="Comments"></label><br></fieldset> ';
 
	   
echo '<div class="resp">';
//var_dump($_SERVER['PHP_SELF']);

	foreach($response as $r) {
		
		if($r["blog_id"] ===  $i["id"] ){
			
			foreach($responder as $re) {
				if($re["id"] === $r["user_id"] ){
				
				echo '<h3>'.$re["username"] . $r["blog_id"]."  Says ".'</h3>'.  $r["response"] . $i["id"]."HEllO Match Behind".'<br>';
				echo '<br>'.'<br>'.'<br>';
				}
			}
		}
	}

echo  '</div>';

 echo '<br>'.'<br>'.'<br>'; 	
	  
}
}

?>	


        </div>

        <div class="col-lg-4">
          <h2>Heading</h2>
          <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. 
		  Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa.
		  Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa.
		  Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa.
		  Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa.
		  Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa.
		  <img src="pics/VinceSm1.png"></p>
          <p><a class="btn btn-primary" href="#" role="button">View details &raquo;</a></p>
        </div>
		<div class="sml">
      </div>

      <!-- Site footer -->
      <footer class="footer">
        <p>&copy; 2015 Company, Inc.</p>
      </footer>

    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>


