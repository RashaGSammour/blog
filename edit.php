<!DOCTYPE html>
<html>
<head>
	<title>Edit Profile</title>
	<link rel="stylesheet" type="text/css" href="css/editInfo.css">
	<style type="text/css">
		.reqSatrt{color: red;font-size: 22px; }
	</style>
</head>
<body>
   	<?php include 'nav.php';
   	include 'db.php';
   	?>
	<div class="container">
		<?php 

			if (isset($_POST['saveName'])) {
													
				
			    $firstName = trim($_POST['firstName']);
				$lastName = trim($_POST['lastName']);
			 	$username = trim($_POST['usertName']);

				$query = "UPDATE users SET firstname = '". $firstName ."', lastname = '". $lastName ."',
						 userName = '". $username ."' WHERE id = '". $_SESSION['id'] ."'";
				$result = mysqli_query($conn, $query);

				if ($result) {								
				  
				  $_SESSION['fname'] =  $firstName;	
				  $_SESSION['lname'] = $lastName;
				  $_SESSION['userName'] = $username;
												
				}else {
							
				die("Database query failed " . mysqli_error($connect));
				
				}



					}

		?>

		
		<DIV style="border-top: 2px solid #000; border-bottom: 1.5px solid #BBB; padding: 8px 8px;">
			<form method='POST'>
				<input type="submit" name="edit" value="Edit" class="right" >
			

				<label class="mid"><?php echo $_SESSION['fname'] . " " . $_SESSION['lname']; ?></label>
				<label class="left">Name</label>
			
		   	<div  <?php if (isset($_POST['edit'])){ echo 'visible';}
		    		 if (isset($_POST['cancelName'])) {echo 'hidden';}
		    		else{ echo 'hidden'; }?> >
				<br><br><label class = "firstAndLastL" style="white-space:pre">   First name : </label>  
				<input class = "firstAndLast" type="text" name="firstName" value="<?php echo $_SESSION['fname'] ?>" required >		<span class="reqSatrt">*</span>

				<br><br><label class = "firstAndLastL" style="white-space:pre">   Last name  : </label> 
				<input class = "firstAndLast" type="text" name="lastName"  value="<?php echo $_SESSION['lname'] ?>" required >		<span class="reqSatrt">*</span>

				<br><br><label class = "firstAndLastL" style="white-space:pre">   User name : </label>  
				<input class = "firstAndLast" type="text" name="usertName"  value="<?php echo $_SESSION['userName'] ?>" required >		<span class="reqSatrt">*</span>

	            <br><br><input type="submit" name="saveName" value = "Save" class = "save" >
				<input type="submit" name="cancelName" value = "Cancel" class = "save" >
			</div>
			</form>
		</DIV>

		<?php 

			if (isset($_POST['saveEmail'])) {
													
				
			    $email = trim($_POST['emailAddress']);
				
				$query = "UPDATE users SET email = '". $email ."' WHERE id = '". $_SESSION['id'] ."'";
				$result = mysqli_query($conn, $query);

				if ($result) {								
				  
				 $_SESSION['email'] = $email;

												
				}else {
							
				die("Database query failed " . mysqli_error($connect));
				
				}



					}

		?>

		
		<DIV style="border-bottom: 1.5px solid #BBB; padding: 8px 8px;">
			<form method='POST'>
				<input type="submit" name="emailEdit" value="Edit" class="right" >
				

				<label class="mid"><?php echo $_SESSION['email'] ?></label>
				<label class="left">Email</label>
				<div <?php if (isset($_POST['emailEdit'])){ echo 'visible';}
		    		 if (isset($_POST['cancelEmail'])) {echo 'hidden';}
		    		else{ echo 'hidden'; }?> >
		    		<br><br><label class = "firstAndLastL" style="white-space:pre">   Email : </label>  
				<input class = "firstAndLast" type="text" name="emailAddress" value="<?php echo $_SESSION['email'] ?>" required>		<span class="reqSatrt">*</span>

				 <br><br><input type="submit" name="saveEmail" value = "Save" class = "save" >
				<input type="submit" name="cancelEmail" value = "Cancel" class = "save" >
		    	</div>	
			</form>	
		</DIV>	

		<?php 

			if (isset($_POST['savePass'])) {
													
				
			    $oldpass = trim(md5($_POST['oldpass']));

			    if ($oldpass === $_SESSION['pass'] ) {
			    	# code...
			    	 $newPass = trim(md5($_POST['newpass']));
			    	 $confirmPass = trim(md5($_POST['conpass']));
			    	 if ($newPass === $confirmPass) {
			    	 	# code...

			    	 	$query = "UPDATE users SET password = '". $newPass ."' WHERE id = '". $_SESSION['id'] ."'";
						$result = mysqli_query($conn, $query);

						if ($result) {								
				  
						 $_SESSION['pass'] = $newPass;

												
						}else {
							
						die("Database query failed " . mysqli_error($connect));
					
						}

			            } else {
			    	 	 	
			    	 	 	echo "Not matches";
			    		 }

					    } else {

			    			echo "Not Correct the old password";
			    		}
				
				



					}

		?>



		<DIV style="border-bottom: 1.5px solid #BBB; padding: 8px 8px;">
			<form method='POST'>
				<input type="submit" name="editPass" value="Edit" class="right" >
			

				<label class="left">Password</label>
				<br>
			
		   	<div  <?php if (isset($_POST['editPass'])){ echo 'visible';}
		    		 if (isset($_POST['cancelPass'])) {echo 'hidden';}
		    		else{ echo 'hidden'; }?> >
				<br><br><label style="white-space:pre"required>   Old Password :        </label>  
				<input type="text" name="oldpass" >		<span class="reqSatrt">*</span>

				<br><br><label style="white-space:pre" required>  New Password  :       </label> 
				<input type="text" name="newpass" >		<span class="reqSatrt">*</span>

				<br><br><label style="white-space:pre" required>  Confirm Password  : </label> 
				<input type="text" name="conpass" >		<span class="reqSatrt">*</span>

	            <br><br><input type="submit" name="savePass" value = "Save" class = "save" >
				<input type="submit" name="cancelPass" value = "Cancel" class = "save" >
			</div>
			</form>
		</DIV>	

		<?php

    
						
			if (isset($_POST['saveInfo']) && $_SESSION['tag'] === "false") {
			
		  		
					$scName = trim($_POST['scName']);
		  			$unName = trim($_POST['unName']);
		  			$workAt = trim($_POST['workAt']);
		  			$phoneNo = trim($_POST['phoneNo']);
		  			$spName = trim($_POST['spName']);
		  			$gender = trim($_POST['gender']);
		  			$chLoc = trim($_POST['chLoc']);
					$chDate = trim($_POST['chDate']);
					$chInfo = trim($_POST['chInfo']);
					$colInfo="";
					$valInf="";
					if($scName != ""){
						$_SESSION['school_name'] = $scName;
						$colInfo.="school_name ,";
						$valInf=$valInf. "','".$scName;
					}
					
						if($unName != ""){
					$_SESSION['university_name'] = $unName;
					$colInfo.="university_name ,";
						$valInf=$valInf."','". $unName;
					}
						if($spName != ""){
					$_SESSION['specialization_name'] = $spName;
					$colInfo.="specialization_name ,";
						$valInf=$valInf."','". $spName;
					}
						if($phoneNo != ""){
					$_SESSION['phone_no'] = $phoneNo;
					$colInfo.="phone_no ,";
						$valInf=$valInf."','". $phoneNo;
					}
						if($workAt != ""){
					$_SESSION['work'] = $workAt;
					$colInfo.="work ,";
						$valInf=$valInf."','". $workAt;
					}
						if($gender != ""){
					$_SESSION['gender'] = $gender;
					$colInfo.="gender";
						$valInf=$valInf."','". $gender;
					}
					$_SESSION['DOB'] = $chDate;
					$_SESSION['POB'] = $chLoc;
					$_SESSION['info'] = $chInfo;
					 $colInfo = trim($colInfo,",");
					$query = "insert into info (id_user, $colInfo ) values ('". $_SESSION['id'] .$valInf."')";
					$result = mysqli_query($conn, $query);

					$quer = "UPDATE users SET info = '". $chInfo ."', place_of_birth = '". $chLoc ."',
						date_of_birth = '". $chDate ."' WHERE id = '". $_SESSION['id'] ."'";
						$resul = mysqli_query($conn, $quer);

						$_SESSION['tag'] = "ok";
						 echo '<meta http-equiv="refresh" content="0">';

					

     	} else if (isset($_POST['saveInfo']) && $_SESSION['tag'] === "ok")
     	{


                    $scName = trim($_POST['scName']);
		  			$unName = trim($_POST['unName']);
		  			$workAt = trim($_POST['workAt']);
		  			$phoneNo = trim($_POST['phoneNo']);
		  			$spName = trim($_POST['spName']);
		  			$gender = trim($_POST['gender']);

		  			$chLoc = trim($_POST['chLoc']);
					$chDate = trim($_POST['chDate']);
					$chInfo = trim($_POST['chInfo']);
					$SetValue="";
					if($scName != ""){
						$_SESSION['school_name'] = $scName;
						$SetValue=$SetValue."school_name ='".$scName."'";
						
					}else if(isset($_SESSION['school_name']) && $scName == ""){
						unset($_SESSION['school_name'] );		$SetValue=$SetValue."school_name =Null";

					}

					
						if($unName != ""){
					$_SESSION['university_name'] = $unName;
					$SetValue=$SetValue.", university_name ='".$unName."'";

					}else if(isset($_SESSION['university_name']) && $unName == ""){
						unset($_SESSION['university_name'] );		$SetValue=$SetValue."university_name =Null";

					}

						if($spName != ""){
					$_SESSION['specialization_name'] = $spName;
					$SetValue=$SetValue.", specialization_name ='".$spName."'";
				
					}else if(isset($_SESSION['specialization_name']) && $spName == ""){
						unset($_SESSION['specialization_name'] );		$SetValue=$SetValue."specialization_name =Null";

					}
						if($phoneNo != ""){
					$_SESSION['phone_no'] = $phoneNo;
					$SetValue=$SetValue.", phone_no ='".$phoneNo."'";

					}else if(isset($_SESSION['phone_no']) && $phoneNo == ""){
						unset($_SESSION['phone_no'] );		$SetValue=$SetValue."phone_no =Null";

					}
						if($workAt != ""){
					$_SESSION['work'] = $workAt;
					$SetValue=$SetValue.", work ='".$workAt."'";
					
					}else if(isset($_SESSION['work']) && $workAt == ""){
						unset($_SESSION['work'] );		$SetValue=$SetValue."work =Null";

					}
						if($gender != ""){
					$_SESSION['gender'] = $gender;
					$SetValue=$SetValue.", gender ='".$gender."'";
					}else if(isset($_SESSION['gender']) && $gender == ""){
						unset($_SESSION['gender'] );		$SetValue=$SetValue."gender =Null";

					}
					
					$_SESSION['DOB'] = $chDate;
					$_SESSION['POB'] = $chLoc;
					$_SESSION['info'] = $chInfo;

					$quer = "UPDATE users SET info = '". $chInfo ."', place_of_birth = '". $chLoc ."',
						date_of_birth = '". $chDate ."' WHERE id = '". $_SESSION['id'] ."'";
						$resul = mysqli_query($conn, $quer);
					$SetValue = trim($SetValue,",");	
					$query = "UPDATE info SET $SetValue WHERE id_user = '". $_SESSION['id'] ."'";
						$result = mysqli_query($conn, $query);
						 //header("Refresh:0");
						  echo '<meta http-equiv="refresh" content="0">';

     	}
	
     	
	
?>


		
		<DIV style="border-bottom: 1.5px solid #BBB; padding: 8px 8px;">
			<form method='POST'>
				<input type="submit" name="editInfo" value="Edit" class="right" >
			

				<label class="left">Information</label>
				<label class="mid"><?php echo $_SESSION['DOB'] . ', ' . $_SESSION['POB'] . ', ' . $_SESSION['national'] ?></label>
			
		   	<div  <?php if (isset($_POST['editInfo'])){ echo 'visible';}
		    		 if (isset($_POST['cancelInfo'])) {echo 'hidden';}
		    		else{ echo 'hidden'; }?> >
				<br><br><label style="white-space:pre" >   Location :                   </label>  
				<input type="text" name="chLoc" value="<?php echo $_SESSION['POB'] ?>" required><span class="reqSatrt">*</span>
				<br><br><label style="white-space:pre" >  Date of Birth  :             </label> 
				<input type="Date" name="chDate" value="<?php echo $_SESSION['DOB'] ?>" required><span class="reqSatrt">*</span>
				<br><br><label style="white-space:pre">   Gender :                     </label>  
				<input type="text" name="gender" value="<?php if($_SESSION['tag'] === 'ok' && isset($_SESSION['gender'])) echo $_SESSION['gender']; else echo '' ?>" >
				<br><br><label style="white-space:pre">   School name :            </label>  
				<input type="text" name="scName" value="<?php if($_SESSION['tag'] === 'ok'  && isset($_SESSION['school_name'])) echo $_SESSION['school_name']; else echo ''  ?>" >
				<br><br><label style="white-space:pre">   University name :        </label>  
				<input type="text" name="unName" value="<?php if($_SESSION['tag'] === 'ok' && isset($_SESSION['university_name'])) echo $_SESSION['university_name']; else echo '' ?>" >
				<br><br><label style="white-space:pre">   Specialization name :  </label>  
				<input type="text" name="spName" value="<?php if($_SESSION['tag'] === 'ok'  && isset($_SESSION['specialization_name'])) echo $_SESSION['specialization_name']; else echo '' ?>" >
				<br><br><label style="white-space:pre">   Work at :                      </label>   
				<input type="text" name="workAt" value="<?php if($_SESSION['tag'] === 'ok' && isset($_SESSION['work'])) echo $_SESSION['work']; else echo ''  ?>" >
				<br><br><label style="white-space:pre">   phone number :           </label>  
				<input type="text" name="phoneNo" value="<?php if($_SESSION['tag'] === 'ok'  && isset($_SESSION['phone_no'])) echo $_SESSION['phone_no']; else echo ''  ?>" >
				<br><br><label style="white-space:pre" >  Change your Info  :       </label> 
				<textarea type="textarea" name="chInfo" required style="height: 100px;"><?php echo $_SESSION['info'] ?></textarea><span class="reqSatrt">*</span>
	            <br><br><input type="submit" name="saveInfo" value = "Save" class = "save" >
				<input type="submit" name="cancelInfo" value = "Cancel" class = "save" >
			</div>
			</form>
		</DIV>



		<DIV style="border-bottom: 2px solid #000; padding: 8px 8px;">
			<form method='POST' action="<?php echo $_SERVER['PHP_SELF']?>">
				<input type="submit" name="delAccount" value="Delete Acount" class="right" >
						
				<label class="left">Delete Account</label>
				
				<div <?php if (isset($_POST['delAccount'])){ echo 'visible';}
		    		 if (isset($_POST['cancelAccount'])) {echo 'hidden';}
		    		else{ echo 'hidden'; }?> >
		    		<br><br><label class = "firstAndLastL" style="white-space:pre">   Password : </label>  
					<input class = "firstAndLast" type="text" name="passAccount" >		<span class="reqSatrt">*</span>

				    <br><br><input type="submit" name="delAccAA" value = "Delete" class = "save" >
					<input type="submit" name="cancelAccount" value = "Cancel" class = "save" >
		    	</div>	

				<br>
		   	

			</form>
		</DIV>
		

	</div>
		<?php 
				
		
				if (isset($_POST['delAccAA'])) {

		
			
			    $pass = trim(md5($_POST['passAccount']));

			    if ($pass === $_SESSION['pass'] ) {
			    	
			    	$query = "delete from users where ID = '". $_SESSION['id'] ."'";
					$result = mysqli_query($conn, $query);
					$quer = "delete from info where id_user = '". $_SESSION['id'] ."'";
					$resul = mysqli_query($conn, $quer);
					$querF = "DELETE FROM frinds WHERE id_user = '".$_SESSION['id']."' OR id_friend= '". $_SESSION['id'] ."'";
					$resulF = mysqli_query($conn, $querF);
					$querP = "DELETE FROM post_tab WHERE user_id = '". $_SESSION['id'] ."'";
					$resulP = mysqli_query($conn, $querP);
                    if(! $result ) {
 							             
					   die('Could not delete data: ' . mysqli_error());
					    
					     }  else {
					     	 session_unset();
			   				 session_destroy();
			  
			  				  echo '<meta http-equiv="refresh" content="0;URL=project.php">';
			
			    exit();

					     
			    		}
				
				



					}
				}

		
		?>

</body>
</html>