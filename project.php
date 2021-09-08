<?php 	session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<title>myCommunity</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">

</head>
<body>
	<?php
	if(isset($_POST['logout'])){
		unset($_SESSION['id']);
		setcookie("id","",time() - 3600);
		session_unset();
		header("Location: project.php");
			}
				?>

		<?php
			$loginError="";

	if(isset($_POST['signin'])){

		if (!isset($_SESSION['id']) && isset($_COOKIE['id'])) {
			$_SESSION['id'] = $_COOKIE['id'];
			echo "string";
		}
		$id = $_SESSION['id'];

		
	include 'db.php';

	$email = $_POST['email'];
	$password = md5($_POST['password']);
	$sql = "select * from users where email = '$email' and password = '$password'";
	$result = mysqli_query($conn,$sql);
	
	if ($result) {
	
	
	$num_rows = mysqli_num_rows($result);

	if ($num_rows >= 1) {
			$row = mysqli_fetch_array($result);
		
		$_SESSION['login'] = "OK";
		$_SESSION['id'] =$row['id'];
		$_SESSION['fname'] =$row['firstname'];
		$_SESSION['lname'] =$row['lastname'];
		$_SESSION['userName']=$row['userName'];
		$_SESSION['email'] = $row['email'];
		$_SESSION['DOB'] =$row['date_of_birth'];
		$_SESSION['POB'] =$row['place_of_birth'];
		$_SESSION['info'] =$row['info'];
		$_SESSION['national'] =$row['nationality'];
		$_SESSION['image'] =$row['image'];
		$_SESSION['pass']=$row['password'];

		$s = "select * from info where id_user = '" . $_SESSION['id'] . "' ";
    	$re = mysqli_query($conn,$s);
    	$num_ro = mysqli_num_rows($re);
    	if ($num_ro >= 1)
    	{

    		

    		    	$roww = mysqli_fetch_array($re);
    		    if(!is_null( $roww['school_name']))
    		    	$_SESSION['school_name'] = $roww['school_name'];

				   if(!is_null( $roww['university_name']))
					$_SESSION['university_name'] = $roww['university_name'];
					
					if(!is_null($roww['specialization_name']))
					$_SESSION['specialization_name'] = $roww['specialization_name'];

					if(!is_null( $roww['phone_no']))
					$_SESSION['phone_no'] = $roww['phone_no'];

					if(!is_null( $roww['work']))
					$_SESSION['work'] = $roww['work'];

					if(!is_null($roww['gender']))
					$_SESSION['gender'] = $roww['gender'];
					$_SESSION['tag'] = "ok";

			
    			
					
					

    	} else {
    		$_SESSION['tag'] = "false";
    		
    	}		mysqli_close($conn);

		header('Location: home_page.php');

	}else{
		$loginError="Email or Password Not Correct";
	}
	
	
	mysqli_close($conn);
	
	}}

	if(isset($_SESSION['login']) && $_SESSION['login']=='OK'){
				header('Location: home_page.php');}

?>					
			
	<nav>
		<div class="container">
		<img src="img/Logo.PNG">
		<ol>
			<li><a href="#" onclick="document.getElementById('register').style.display = ('block')"> Sign up</a></li>
			<li><a href="#" onclick="document.getElementById('AboutMe').style.display = ('block')"> About us</a></li>
		</ol>
	</div>
	</nav>
	<div class="container">
	<div class="Card  signIn">
		<h2>Sign In</h2>
		<form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
		<input type="email" name="email" placeholder="Email">
		<input type="password" name="password" placeholder="Password">
			<p style="color: chocolate;margin-top: 4px;text-align: left;padding-left: 68px;font-size: 12px;"><?php echo $loginError?></p>
		<p>Don't have account ?<a href="#" onclick="document.getElementById('register').style.display = ('block')">register now</a></p>
		<input type="submit" name="signin" value="Sign In">
		</form>
	</div>

	</div>
<div id="DD">
	<div class="disc">
		<p>
			!
		</p>
	<img src="img/Logo.PNG">

			<pre>
 A social networking website<br>  that allows you to <br>  communicate with anyone<br>  in the <span>World</span>.
			</pre>

	</div>
</div>
	<?php include 'register_and_aboutme.php'; ?>
</body>
</html>
