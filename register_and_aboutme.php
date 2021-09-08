<div id="register">
	<div class="Card signUp">
		<h2 class="Title">Sign Up <span onclick="document.getElementById('register').style.display = ('none')">&times; </span></h2>

		<form action="<?php echo $_SERVER['PHP_SELF']?>" method="post" >
			<input type="text" required style="width: 39%;" name="fname" placeholder="First Name"/>
			<input type="text"  required style="	width: 39%;" name="lname" placeholder="Last Name"/>

			<input type="email" required name="email" placeholder="Email"/>
			<input type="password" required name="password1" placeholder="Password"/>
			<input type="password" required name="password2" placeholder="Confirm Password"/>

			<input type="text" name="national" required placeholder="National">

			<label><span>Date of birth :</span> <input name="dateOfBirth" type="date" max="2020-12-31" required> </label>

			<label > <span>Place of birth : </span>
            	<?php include 'placeOfBirth.php'; ?>
            </label>
                 <label><span>Information: </span> <textarea name="Information" rows="5" required></textarea></label>
                            	<input type= "submit" name="signUp" value="Create Acount" class="btGetStart">

		</form>
		</div>
</div>

<div id="RIDone">
<div class="RID" style="">Register is Done </div> </div>

<div id="PaNotMat">
<div class="PassNot" style=""> password Does Not match. Try again</div> </div>

<div id="EmailIsExist">
<div class="PassNot" > Email Is Exists . Please Try again</div> </div>

<script type="text/javascript">
         

   function hideRIDone(id) {
    setTimeout(function (){document.getElementById(id).style="display:none"},3000);

   }
    function hideRIDone2(id) {
    setTimeout(function (){document.getElementById(id).style="display:none";document.getElementById('register').style="display:block";},3000);

   }
 </script>


 
<div id="AboutMe">
	<div class="About_Me Card">
            <h2 class="Title">About Us<span onclick="document.getElementById('AboutMe').style.display = ('none')">&times; </span></h2>
        <div class="all_us">
            <div class="me">
                <div class="img">
                    <img src="img/yehiaElassouli.jpg" />
                </div>
                <div class="description">
                    <p>Yehia Abed El-hafez El-Assouli<br>
                         Alazhar University<br>
                          20150806
                    </p>
                </div>
            </div>
               <div class="me">
                <div class="img">
                    <img src="img/mahmoud3.jpg" />
                </div>
                <div class="description">
                    <p>Mahmoud Ali Al-krunz<br>
                         Alazhar University<br>
                          20150918
                    </p>
                </div>
            </div>
               <div class="me">
                <div class="img">
                    <img src="img/mohanad.jpg" />
                </div>
                <div class="description">
                    <p>Mohanad Abd Almonem Shbair <br>
                         Alazhar University<br>
                          20153342
                    </p>
                </div>
            </div>
               <div class="me">
                <div class="img">
                    <img src="img/Amai.jpg" />
                </div>
                <div class="description">
                    <p>Amain Saeed Alakhras<br>
                         Alazhar University<br>
                          20154709
                    </p>
                </div>
            </div>
        </div>

    </div>

</div>

<?php       include 'db.php';


    if(isset($_POST['signUp']) ){
  
  $email = trim($_POST['email']);
  $password1 = trim($_POST['password1']);
  $password2 = trim($_POST['password2']);
  $fname = trim($_POST['fname']);
  $lname = trim($_POST['lname']);
  $date_of_birth = trim($_POST['dateOfBirth']);
    $place_of_birth = trim($_POST['PlaceOfBirth']);
    $nation = trim($_POST['national']);

  $info = trim($_POST['Information']);
  $img="img/users.jpg";
    $sqlE="select * from users where email ='".$email."' ";
  $resultEmail = mysqli_query($conn,$sqlE);
  if($resultEmail){
      $num_rows2 = mysqli_num_rows($resultEmail);
  if ($num_rows2 >= 1) {
      echo "<script>
       document.getElementById('EmailIsExist').style='display:block';
    hideRIDone2('EmailIsExist');
</script>";
    exit;
  
    }} 
  if ($password1 != $password2) {
   
      echo "<script>
       document.getElementById('PaNotMat').style='display:block';
    hideRIDone2('PaNotMat');
</script>";
    exit;
  }
  $pass = md5($password1);
  $userName=$fname.'.'.$lname;
  $sql = "INSERT INTO users (firstname,lastname, info, date_of_birth, email, password, place_of_birth, nationality,userName,image) VALUES ('$fname','$lname', '$info', '$date_of_birth', '$email', '$pass',  '$place_of_birth', '$nation','$userName','$img');";

  $result = mysqli_query($conn,$sql);
  if($result){

       echo "<script>
       document.getElementById('RIDone').style='display:block';
    hideRIDone('RIDone') ;</script>";
    
  }

  mysqli_close($conn);
    
    }
 ?>