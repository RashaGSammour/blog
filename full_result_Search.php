<!DOCTYPE html>

<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>

      <link rel="stylesheet" href="css/full_Search_Result.css"/>
           <link rel="stylesheet" href="css/profile.css"/>

      <?php    include 'nav.php' ;
    
      $AdBut='<button class="Btn_Ad_or_del_frinds"  onclick= "AddFriend('.
               $_SESSION['id'].','.$_GET['id'].');">'
              .'<i class="fa fa-user-plus"></i> Add Friend '
            .'</button>';
     
  $AdButSent='<div class="ViewAction" >'.
                    '<button class="Btn_Ad_or_del_frinds" >'.
                      '<i class="fa fa-user-plus"></i>'.
                      ' Frinds Request Sent'.
                    '</button>'.
                    '<div class="Action">'.
                    '  <button  name=delete  onclick="DeleteFriend('.
                      $_SESSION['id'].','.$_GET['id'].
               ');" id="modButton"> Delete Request</button>'.
                    '</div>'.
                  '</div>';
 $FrindsBut= '<div class="ViewAction">'.
                    '<button class="Btn_Ad_or_del_frinds">'.
                      '<i class="fa fa-check"></i>'.
                       'Friends'.
                    '</button>'.
                    '<div class="Action">'.
                      '<button onclick="DeleteFriend('.
                      $_GET['id'].','.$_SESSION['id'].
                      ');" name=delete id="modButton">UnFriend</button>'.
                    '</div> </div>';
 $ResBut='<div class="ViewAction">'
                    .'<button class="Btn_Ad_or_del_frinds">'.
                      '<i class="fa fa-user-plus"></i>'.
                      ' Respond to Friend Request'.
                    '</button>'.
                    '<div class="Action">'.
                      '<button  onclick="ConfirmRequest('.
                     $_GET['id'].','.$_SESSION['id'].
                     ');" id="modButton">Confirm </button>'.
                      '<button onclick="DeleteFriend('.
                      $_GET['id'].','.$_SESSION['id'].
                      ');" name=delete id="modButton">Delete Request</button>'.
                    '</div></div>';                       
?>
      <script type="text/javascript">
    
          function changeStateButton(newState){
            document.getElementById('btFriendState').innerHTML=newState;
          }

          function AddFriend(userid,Friendid){
            
         var newstate = "<?php  echo addslashes( $AdButSent ); ?>";
            
            changeStateButton(newstate);
          var  xmlhttp;
         if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp=new XMLHttpRequest();
          } else { // code for IE6, IE5
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
          }
          var sql="INSERT INTO frinds(id_user,id_friend,status) VALUES ("+userid+","+Friendid+",0)";
          xmlhttp.open("GET","full_result_Search.php?sql="+sql,true);
              xmlhttp.send(); 

     
            
          }


          function ConfirmRequest(userid,Friendid){
                  var  xmlhttp;
         if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp=new XMLHttpRequest();
          } else { // code for IE6, IE5
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
          }
          var sql="UPDATE frinds SET status=1 where id_user ='"+userid+"'and id_friend = '"+Friendid+"'";
          xmlhttp.open("GET","full_result_Search.php?sql="+sql,true);
              xmlhttp.send();
 
            changeStateButton("<?php  echo addslashes( $FrindsBut ); ?>");
            
          }

          function DeleteFriend(userid,Friendid){
                     var  xmlhttp;
         if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp=new XMLHttpRequest();
          } else { // code for IE6, IE5
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
          }
          var sql="DELETE FROM frinds where (id_user ='"+userid+"'and id_friend = '"+Friendid+"') or (id_user ='"+Friendid+"'and id_friend = '"+userid+"')";
          xmlhttp.open("GET","full_result_Search.php?sql="+sql,true);
              xmlhttp.send();

            changeStateButton("<?php  echo addslashes( $AdBut); ?>");
            
          }

      </script>
    </head>
  <body>
    <?php 
  
                if(isset($_GET['sql'])){
            include 'db.php';
            $result = mysqli_query($conn,$_GET['sql']);
            mysqli_close($conn);
              
            }     
     
  if(!isset($_GET['id']) || empty($_GET['id'])) {
  //  header('Location: project.php');
  }
  else if(isset($_GET['id'])){
  
  include 'db.php';
  
  $id = $_GET['id'];  
  $sql = "select * from users where id = $id;";
  $result = mysqli_query($conn,$sql);
  
  if ($result == false) {
    echo "<p>Error: cannot execute query</p>";
  }
  else {
    $num_rows = mysqli_num_rows($result);

    if ($num_rows >= 1) {
      while($row = mysqli_fetch_array($result)) {
        $Fname=$row['firstname'];
        $Lname=$row['lastname'];
        $username=$row['userName'];
        $DOB=$row['date_of_birth'];
       $POB=$row['place_of_birth'];
       $info=$row['info'];
       $img=$row['image'];
      }

    }
  }
      }      
         /////// slect from frinds table   
    $sql = "select * from frinds where (id_user ='".$_GET['id'] ."'and id_friend = '".$_SESSION['id']."') or (id_user ='".$_SESSION['id'] ."'and id_friend = '".$_GET['id']."')";
          $result = mysqli_query($conn,$sql);
          if($result){
          $num_rows = mysqli_num_rows($result);
      if ( $num_rows>0) {
        while ($row = mysqli_fetch_array($result)){
          if($row['status']==1){
                  $btn=$FrindsBut;
                }
           else  if($row['status']==0){
                  if($row['id_user']==$_SESSION['id']){$btn=$AdButSent;}
                  else {$btn = $ResBut;}
              
        }
      }
  
  }
      else {$btn=$AdBut;}  }  



$s = "select * from info where id_user = '" . $_GET['id'] . "' ";
      $re = mysqli_query($conn,$s);
      $num_ro = mysqli_num_rows($re);
      if($re){
              $num_ro = mysqli_num_rows($re);
      if ($num_ro >= 1)
      {     

           $roww = mysqli_fetch_array($re);
            if(!is_null( $roww['school_name']))
              $school_name = $roww['school_name'];

            if(!is_null( $roww['university_name']))
          $university_name = $roww['university_name'];
          
            if(!is_null($roww['specialization_name']))
          $specialization_name= $roww['specialization_name'];

          if(!is_null( $roww['phone_no']))
          $phone_no = $roww['phone_no'];

          if(!is_null( $roww['work']))
          $work = $roww['work'];

          if(!is_null($roww['gender']))
          $gender = $roww['gender'];
          $tag = "ok";

          
          
          
          

      } else {
        $tag = "false";
        
      }}
     mysqli_close($conn);

    ?>
    
<div class="container">
  <div class="left_Section">
    <div class="myProfile">

      <div class="img">
        <img src="<?php echo $img ?>"/>
      </div>
      <h2 class="btn" id="btFriendState">   
        <?php echo $btn; ?>         
                  
                
    </h2>

        <p>
          <i class="fas fa-user-circle"></i> 
            <?php echo $Fname ." ". $Lname;
                          echo "<span style='    padding-left: 21px;    font-size: 12px; color: #555;    display: block;'>".$username."<span>";
                    ?>

        </p>
        <p>
          <i class="fas fa-home"></i>
            <?php echo $POB;?>
        </p>
        <p>
          <i class="fas fa-birthday-cake"></i>
            <?php echo $DOB;?>
        </p>
    </div>
    <div class="information" >
        <h4 title="Information">Information</h4>
               <div class="infoContent">
                        <span><i class="fas fa-globe"></i>  Short Brief :</span>
                        <p><?php  echo  $info ?></p>
                    </div>
                    <?php 
                    if(isset($tag) && $tag === 'ok'){
                     if(isset($school_name)){ 
                        echo '<div class="infoContent">
                          <span> <i class="fas fa-school"></i> Studied at School :</span>
                           <p> '. $school_name.'</p>
                           </div> ';}
                          if(isset($university_name)){ 
                        echo '<div class="infoContent">
                          <span> <i class="fas fa-university"></i> Studied at university :</span>
                           <p> '.$university_name.'</p>
                           </div> ';}

                           if(isset( $work)){ 
                        echo '<div class="infoContent">
                          <span><i class="fas fa-briefcase"></i> Work At : </span> <p> '.   $work.'</p>
                           </div> ';} 

                             if(isset($specialization_name)){ 
                        echo '<div class="infoContent">
                           <span><i class="fas fa-graduation-cap"></i> Specialization name  :</span> <p> '.$specialization_name.'</p>
                           </div> ';} 
                   
                            if(isset($phone_no)){ 
                        echo '<div class="infoContent">
                           <span> <i class="fas fa-phone"></i> Phone number : </span> <p> '.$phone_no.'</p>
                           </div> ';} 
                            if(isset($gender)){ 
                        echo '<div class="infoContent">
                          <span><i class="fas fa-transgender"></i> Gender : </span><p> '.$gender.'</p>
                           </div> ';} 
                    }
                    
                     ?>

    </div>
   </div> 
    <div class="rightDiv">

      
      <div class="All_Post">
        <?php 
     
           include 'db.php';
           if(isset($_GET['id'])){
            include "db.php";
          $sql = "select * from post_tab where user_id ='".$_GET['id'] ."' order by date_of_creation desc";
          $result = mysqli_query($conn,$sql);
      if($result){
          $num_rows = mysqli_num_rows($result);
      if ( $num_rows>0) {
        while ($row = mysqli_fetch_array($result)){
                    if( is_null($row['post_image'])){

         makePost($img,$Fname.' '. $Lname,$row['post_content'],$_GET['id']);}
                 else{
                   makePostWithImage($img,$Fname.' '. $Lname,$row['post_content'],$_GET['id'],$row['post_image']);
                 }
        }}

        else{
           echo ' <div class="post" style="min-height:70px;">

                      <div class="content NoExistPost" style=" text-align: center;height: 70px;padding-top: 20px; font-size: 24px;  color: orange;" >
                        No Post Exist So Far
                      </div>
                    

                </div>';
        }}


        

        mysqli_close($conn);}
         
        ?>         
        </div>  

   <?php 

    function makePost($pathImg,$name,$content,$id){
         echo ' <div class="post">
                    <div class="header">
                        <div class="img"><img src="'.$pathImg.'" alt="Error"></div>
                        <div class="name"><a href="#">'.$name.'</a></div>
                    </div>
                    
                    <div class="body"  >
                      <div class="content" >
                        <p>'.$content.'</p>
                      </div>
                    
                    </div>

                </div>';

    }
        function makePostWithImage($pathImg,$name,$content,$id,$imagePost){
         echo ' <div class="post">
                    <div class="header">
                        <div class="img"><img src="'.$pathImg.'" alt="Error"></div>
                        <div class="name"><a href="#">'.$name.'</a></div>
                    </div>
                    
                    <div class="body"  >
                      <div class="content" >
                        <p>'.$content.'</p>
                         <div style=" padding-left: 273px;    margin-top: -47px;
                        height: 169px;">
                        <img src="'.$imagePost.'" style="width: 200px;
                         height: 150px;"/>
                        </div>
                      </div>
                    
                    </div>

                </div>';

    }
   
   ?>

  </body>
</html>
