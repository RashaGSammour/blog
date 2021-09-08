<!DOCTYPE html>

<html lang="en" dir="ltr">
    <meta charset="utf-8">
    <title></title>
     <link rel="stylesheet" href="css/profile.css"/>
      <haed>      
    <style type="text/css">
  .overlay::-webkit-file-upload-button {
  background: none;
  border: none;
  color: white;
 
}
 .overlay::-webkit-file-upload-button {
  visibility: hidden;
}
.overlay::before{
   content: 'Change Photo';
    font-weight: 700;
  font-size: 8pt;
  white-space: nowrap;
}
    </style>
    <script type="text/javascript">
      
    function Changeimage(){
    

        var newImage=document.getElementById('changeimageInput').value ; 
              

        if(newImage != ''){
                    
    document.getElementById("changeImage").click();


  
      }
    }
  
    </script>
    </head>
  <body>
    <?php include 'nav.php';
     include "AllMethodForPost.php";?>
      <div class="container">
        <div class="left_Section">
              <div class="myProfile">
                <?php
                if(isset($_POST['upload'])){
                  include('db.php');
                  $fileinfo=PATHINFO($_FILES["image"]["name"]);
                  $newFilename=$fileinfo['filename'] ."_". time() . "." . $fileinfo['extension'];
                  move_uploaded_file($_FILES["image"]["tmp_name"],"img/" . $newFilename);
                  $location="img/" . $newFilename;
                  mysqli_query($conn,"UPDATE users SET image = '". $location ."' WHERE id = '". $_SESSION['id'] ."'");
                    $_SESSION['image'] = $location;
                }
?> 
                <div class="img">
                     <form method="POST" " name="fm" enctype="multipart/form-data">
                  <img src="<?php echo $_SESSION['image'] ?>"/>
                  <input type="file" name="image" class="overlay" id="changeimageInput" onchange="Changeimage();">
                  <button style="display: none;" id="changeImage" type="submit" name="upload">Upload</button>
                  </form>
                </div>
                <hr align="center" width="80%" />

                  <p>
                 <i class="fas fa-user-circle"></i> 
                    <?php echo $_SESSION['fname'] ." ". $_SESSION['lname'];
                          echo "<span style='    padding-left: 21px;    font-size: 12px; color: #555;    display: block;'>".$_SESSION['userName']."<span>";
                    ?>

                  </p>
                  <p>
                    <i class="fas fa-home"></i>
                   <?php echo $_SESSION['POB']?>
                  </p>
                  <p>
                    <i class="fas fa-birthday-cake"></i>
                   <?php echo $_SESSION['DOB']?>
                  </p>

            
              </div>
                  <div class="information" >
                    <h4 title="Information">Information</h4>
                    
                    <?php 
                    if(isset($_SESSION['info'])&& trim( $_SESSION['info']) != ""){ 
                        echo '
                    <div class="infoContent">
                        <span><i class="fas fa-globe"></i>  Short Brief :</span>
                        <p> '. $_SESSION['info'] .'</p>
                    </div> ';}
                    if(isset($_SESSION['tag']) && $_SESSION['tag'] === 'ok'){
                     if(isset($_SESSION['school_name'])&& trim($_SESSION['school_name']) != ""){ 
                        echo '<div class="infoContent">
                          <span> <i class="fas fa-school"></i> Studied at School :</span>
                           <p> '. $_SESSION['school_name'].'</p>
                           </div> ';}
                          if(isset($_SESSION['university_name'])&& trim($_SESSION['university_name']) != ""){ 
                        echo '<div class="infoContent">
                          <span> <i class="fas fa-university"></i> Studied at university :</span>
                           <p> '.$_SESSION['university_name'].'</p>
                           </div> ';}

                           if(isset( $_SESSION['work'])&& trim($_SESSION['work']) != ""){ 
                        echo '<div class="infoContent">
                          <span><i class="fas fa-briefcase"></i> Work At : </span> <p> '.   $_SESSION['work'].'</p>
                           </div> ';} 

                             if(isset($_SESSION['specialization_name']) && trim($_SESSION['specialization_name']) != ""){ 
                        echo '<div class="infoContent">
                           <span><i class="fas fa-graduation-cap"></i> Specialization name  :</span> <p> '.$_SESSION['specialization_name'].'</p>
                           </div> ';} 
                   
                            if(isset($_SESSION['phone_no']) && trim($_SESSION['phone_no']) != ""){ 
                        echo '<div class="infoContent">
                           <span> <i class="fas fa-phone"></i> Phone number : </span> <p> '.$_SESSION['phone_no'].'</p>
                           </div> ';} 
                            if(isset($_SESSION['gender']) && trim($_SESSION['gender']) != ""){ 
                        echo '<div class="infoContent">
                          <span><i class="fas fa-transgender"></i> Gender : </span><p> '.$_SESSION['gender'].'</p>
                           </div> ';} 
                    }
                    
                     ?>
                     
                    
                       
                    
                    
                                 
                    

              </div>
        </div> 
        <div class="rightDiv">

            <div class="post-container">
              <form action='<?php echo $_SERVER["PHP_SELF"]?>'  method=post enctype="multipart/form-data">

              <textarea name="content" placeholder="Write anything ..."></textarea>
              <div style="float: left;">
               <input type="file" name="image" class="overlay postImage" id="changeimageInput" >
              </div>
              <button type="submit" name="post">
          <i class="fas fa-pencil-alt"></i>

                &nbsp;Post
              </button>
              </form>
            </div>
            <div class="All_Post">
              <?php 

                          include 'db.php';
          $sql = "SELECT DISTINCT users.id,users.firstname,users.lastname,users.image,post_tab.post_content,post_tab.id_post,post_tab.post_image FROM users LEFT JOIN frinds ON users.id=frinds.id_user or users.id=frinds.id_friend INNER JOIN post_tab on post_tab.user_id=users.id WHERE 
    (users.id=frinds.id_user and frinds.id_friend='".$_SESSION['id']."' and frinds.status=1 and post_tab.user_id=users.id) or
(frinds.id_user='".$_SESSION['id']."' and frinds.id_friend=users.id and frinds.status=1 and post_tab.user_id=users.id)or users.id='".$_SESSION['id']."'  order by date_of_creation desc
";
          $result = mysqli_query($conn,$sql);
          if($result){
          $num_rows = mysqli_num_rows($result);

      if ( $num_rows>0) {
        while ($row = mysqli_fetch_array($result)){
          if($_SESSION['id']==$row['id']){

         if( is_null($row['post_image'])){
               makeProfile($_SESSION['image'],$_SESSION['fname'].' '. $_SESSION['lname'],$row['post_content'],$row['id_post']);}
          else {
              makeProfileWithImage($_SESSION['image'],$_SESSION['fname'].' '. $_SESSION['lname'],$row['post_content'],$row['id_post'],$row['post_image']);}

       }
         else {
          if( is_null($row['post_image'])){
          makePostForFrinds($row['image'],$row['firstname'].' '.$row['lastname'],$row['post_content'],$row['id']);}
          else{
                      makePostForFrindsWithImage($row['image'],$row['firstname'].' '.$row['lastname'],$row['post_content'],$row['id'],$row['post_image']);
          }
        }
        }}else{
           echo ' <div class="post" style="min-height:70px;">

                      <div class="content NoExistPost" style=" text-align: center;height: 70px;padding-top: 20px; font-size: 24px;  color: orange;" >
                        No Post Exist So Far
                      </div>
                    

                </div>';
        }

      }
        mysqli_close($conn);
              ?>
              
            </div>
          </div>
        </div>    

         <?php 

         function makePostForFrinds($pathImg,$name,$content,$idFrinds){
                    echo ' <div class="post">
                    <div class="header">
                        <div class="img"><img src="'.$pathImg.'" alt="Error"></div>
                        <div class="name"><a href="full_result_Search.php?id='.$idFrinds.'">'.$name.'</a></div>
                    </div>
                    
                    <div class="body"  >
                      <div class="content" >
                        <p>'.nl2br(str_replace(" ", "&nbsp;", $content)).'</p>
                      </div>
                    
                    </div>

                </div>';



          }
           

         function makePostForFrindsWithImage($pathImg,$name,$content,$idFrinds,$imagePost){
                    echo ' <div class="post">
                    <div class="header">
                        <div class="img"><img src="'.$pathImg.'" alt="Error"></div>
                        <div class="name"><a href="full_result_Search.php?id='.$idFrinds.'">'.$name.'</a></div>
                    </div>
                    
                    <div class="body"  >
                      <div class="content" >
                        <p>'.nl2br(str_replace(" ", "&nbsp;", $content)).'</p>
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