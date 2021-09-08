    <script type="text/javascript">
       function changeDisplay( id1, id2){
        "use strick ";
      document.getElementById(id2).style='display:none';
      document.getElementById(id1).style='display:block';

    }
       function copyTextToP( id1, id2){
                
           document.getElementById(id1).innerHTML=document.getElementById(id2).value.replace(/\n/g, "<br>").replace(/\s/g,"&nbsp;");

          return document.getElementById(id2).value.replace(/\n/g, "~");
                        }
    function copyTextToEdit( id1, id2){
              
            document.getElementById(id1).value=document.getElementById(id2).innerHTML.replace(/<br>/g,"\n").replace(/&nbsp;/g," ");

                        }  
    function EditPostClose( id1, id2){
        "use strick ";
        copyTextToEdit( "e"+id1, "p"+id2);
        changeDisplay(id2,id1);

    }

  
    function deletePost(id){
   
       var elem = document.getElementById(id);
        elem.parentNode.removeChild(elem);
        var  xmlhttp;
         if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else { // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  var sql="DELETE FROM post_tab WHERE  user_id ="+<?PHP  echo( $_SESSION['id']) ?>+" and id_post= "+id;
  xmlhttp.open("GET","profile.php?sql="+sql,true);
      xmlhttp.send();
  

     
        }



    function ModifyPost(id){
   
        var content=  copyTextToP( "pp"+id,"ee"+id);
     var  xmlhttp;
         if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else { // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  var sql="UPDATE post_tab SET post_content = '"+content+"' WHERE  user_id ="+<?PHP  echo( $_SESSION['id']) ?>+" and id_post= "+id;
  xmlhttp.open("GET","profile.php?sql="+sql,true);
      xmlhttp.send();
  
          
  
      changeDisplay( "p"+id,"e"+id);
     
        } 

  
        </script>
<?PHP
            if(isset($_GET['sql'])){
            include 'db.php';
            $result = mysqli_query($conn,str_replace("~", "\r\n", $_GET['sql']));
            mysqli_close($conn);
              
            }

          if(isset($_POST['post']) ){
              include 'db.php';
              $CONNTENT=trim($_POST['content']);
              $ID=$_SESSION['id'];
              $impostCol="";
              $imagePostPath="";
              if(isset($_FILES['image'])&& $_FILES["image"]["name"] != "" && !is_null($_FILES["image"]["name"])){
              $fileinfo=PATHINFO($_FILES["image"]["name"]);
                  $newFilename=$fileinfo['filename'] ."_". time() . "." . $fileinfo['extension'];
                  move_uploaded_file($_FILES["image"]["tmp_name"],"img/" . $newFilename);
                  $location="img/" . $newFilename;
                                $impostCol=", post_image";
                                $imagePostPath=",'".$location."'";
                  }
              $sql = "INSERT INTO post_tab (user_id,post_content ".$impostCol.") VALUES ('$ID','$CONNTENT'".$imagePostPath.")";
            $result = mysqli_query($conn,$sql);
            mysqli_close($conn);
           // echo " <script> location.replace('profile.php'); </script>";
        }


    function makeProfile($pathImg,$name,$content,$idPost){
        $id_p="p".$idPost;
        $id_pp="pp".$idPost;
        $idEdit="e".$idPost;
        $idEdite="ee".$idPost;
      echo ' <div class="post" id='.$idPost.'>
              <div class="header">
                  <div class="img"><img src="'.$pathImg.'" alt="Error"></div>
                  <div class="name"><a href="profile.php">'.$name.'</a></div>
                <div class="edit">
                  <div class="dropdown">
                    <button class="dropbtn">
                      <i class="fa fa-ellipsis-h"></i>
                    </button>
                    <div class="dropdown-content">';
                     echo " <button id=modButton onclick=changeDisplay('".$idEdit."','".$id_p."')>Modify</button>";
                     echo '
                     <button  name=delete id="modButton" onclick="deletePost('.$idPost.')" >Delete</button>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="body"  >
                <div class="content" id='.$id_p.'>
                  <p id='.$id_pp.'>'.nl2br(str_replace(" ", "&nbsp;", $content))
                 
                .'</p>
                </div>
              
                <div class="edit_post" id='.$idEdit.'>

                  <textarea id='.$idEdite.' name="edit">'.$content
                  .'</textarea>
                  
                  <input type="button" value="Save" name="save_Edit_Content"'.

                   "onclick=ModifyPost('".$idPost."')"

                   .'>
                   <input type="button" '.

                   "onclick=EditPostClose('".$idEdit."','".$id_p."')"

                   .' value="Cancel" name="Cancel">
                         
                </div>
              </div>

          </div>';



    }

      function makeProfileWithImage($pathImg,$name,$content,$idPost,$imagePost){
        $id_p="p".$idPost;
        $id_pp="pp".$idPost;
        $idEdit="e".$idPost;
        $idEdite="ee".$idPost;
      echo ' <div class="post" id='.$idPost.'>
              <div class="header">
                  <div class="img"><img src="'.$pathImg.'" alt="Error"></div>
                  <div class="name"><a href="profile.php">'.$name.'</a></div>
                <div class="edit">
                  <div class="dropdown">
                    <button class="dropbtn">
                      <i class="fa fa-ellipsis-h"></i>
                    </button>
                    <div class="dropdown-content">';
                     echo " <button id=modButton onclick=changeDisplay('".$idEdit."','".$id_p."')>Modify</button>";
                     echo '
                     <button  name=delete id="modButton" onclick="deletePost('.$idPost.')" >Delete</button>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="body"  >
                <div class="content" id='.$id_p.'>
                  <p id='.$id_pp.'>'.nl2br(str_replace(" ", "&nbsp;", $content))
                 
                .'</p>
                <div style=" padding-left: 273px;    margin-top: -47px;
    height: 169px;">
                <img src="'.$imagePost.'" style="width: 200px;
    height: 150px;"/>
                </div>
                </div>
              
                <div class="edit_post" id='.$idEdit.'>

                  <textarea id='.$idEdite.' name="edit">'.$content
                  .'</textarea>
                  
                  <input type="button" value="Save" name="save_Edit_Content"'.

                   "onclick=ModifyPost('".$idPost."')"

                   .'>
                   <input type="button" '.

                   "onclick=EditPostClose('".$idEdit."','".$id_p."')"

                   .' value="Cancel" name="Cancel">
                         
                </div>
              </div>

          </div>';



    }
             ?>