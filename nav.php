<!DOCTYPE html>
<html>
<head>
	<title>myCommunity</title>
	  <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">

      <link rel="stylesheet" type="text/css" href="css/navbar.css">


  <script type="text/javascript" src="css/fontawesome-all.min.js"></script>
	<script type="text/javascript">
		 function DeleteRequest(userid,idF){
		          var elem = document.getElementById('Re'+idF);
       				elem.parentNode.removeChild(elem);
                    var  xmlhttp;
         if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp=new XMLHttpRequest();
          } else { // code for IE6, IE5
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
          }
          var sql="DELETE FROM frinds where   id_user ='"+idF+"'and id_friend = '"+userid+"'";
          xmlhttp.open("GET","nav.php?sql="+sql,true);
              xmlhttp.send();
              
            
            
          }
        function ConfirmRequest(userid,idF){
		          var elem = document.getElementById('Re'+idF);
       				elem.parentNode.removeChild(elem);
                     var  xmlhttp;
         if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp=new XMLHttpRequest();
          } else { // code for IE6, IE5
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
          }
          var sql="UPDATE frinds SET status=1 where id_user ='"+idF+"'and id_friend = '"+userid+"'";
          xmlhttp.open("GET","nav.php?sql="+sql,true);
              xmlhttp.send();

            
            
          } 

         
	</script>
  <style type="text/css">
    .btnLogout:hover{background-color: #ddd !important;}
  </style>
</head>
<body>
	<nav>
		<div class="container"><a href="home_page.php">
		<img src="img/Logo.PNG" style="height: 60px;width: 150px;"></a>
		<div class="search">
			<form method="post" action="result_search.php"><input type="search" name="friend" placeholder="Find a friend">
					<input type="submit" name="Search" value="Search"></form>
		</div>

        <div class="dropdown">
          <button class="dropbtn">   <i class="fa fa-caret-down"></i>
			</button>
          <div class="dropdown-content">
        	<a href="frinds.php">My friends</a>
        	<a href="edit.php">Edit</a>
          <form method="post" action="project.php">
       	 	<button id="button" class="btnLogout" name='logout' type="submit" style="background-color: #f1f1f1;width: 100%;text-align: -webkit-auto;">Log Out</button>
    </form>
      	</div>
    </div>
    <div class="dropdown">
          <button class="dropbtn">   <i class="fas fa fa-users"></i>
			</button>
          <div class="AllRequest">
          <p>Friend Requests</p>
          <?php 
          if(!isset($_SESSION))
          session_start();
            include 'db.php';
              if(isset($_GET['sql'])){
                  $result = mysqli_query($conn,$_GET['sql']);}
            
            
    $sql="select users.id,users.image,users.firstname,users.lastname from frinds ,users where frinds.id_user=users.id and frinds.id_friend ='".$_SESSION['id']."' AND frinds.status = 0
"      ;

    
          $result = mysqli_query($conn,$sql);
          if($result){
          $num_rows = mysqli_num_rows($result);
      if ( $num_rows>0) {
        while ($row = mysqli_fetch_array($result)){
          requestFreind($row['image'],$row['firstname'].' '.$row['lastname'],$row['id']);
        
        }}
      else {echo '<div class="noRequest" >No Request Exists Now </div>';}  }
      
          function requestFreind($pathImg,$name,$id){
          	echo '  	<div class="frindRequest" id=Re'.$id.'>
				<div class="img">
					<img src="'.$pathImg.'">
				</div>
				<div class="detial">
					<div class=info >
							<a href="full_result_Search.php?id='.$id.'">'.$name.'</a>
							<div class="buttonRequest">
					<button class="Btn_Req" onclick="DeleteRequest('.
                      $_SESSION['id'].','.$id.
                      ');" >
						 Delete</button>
					
					<button class="Btn_Req" onclick="ConfirmRequest('.
                      $_SESSION['id'].','.$id.
                      ')" >
						Confirm</button>						
					</div>		
					</div>
				</div>
		</div>';

          }
          ?>
    
      		</div>
    </div>
		<ol style="padding-left:0px;">
			<li><a href="home_page.php">Home</a></li>
			<li><a href="profile.php">My Profile</a></li>
		</ol>

	</div>
	</nav>
  </body>
  </html>
