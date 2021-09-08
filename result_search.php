

<!DOCTYPE html>
<html>
<head>

		<title></title>
				      <link rel="stylesheet" href="css/full_Search_Result.css"/>

	<style type="text/css">
		body{ background-color: #f5f7f8 !important ;}
.container{

			margin-top: 0 auto imp;
	}
	.img{

			float: left;
			width: 70px;
			height: 100%;
			text-align: center;
			}
	.detial{
				float: right;
				width: 93%;
				height: 100%;
			}
	.img img{

			    margin: 12px auto auto 9px;
			    height: 50px;
			    width: 60px;
				border-radius: 50%;
			}
	.info{
				margin: 20px 1px 0 ;
				float: left;
			}
	.detial .info a{
				color:rgb(255,140,0);
				}
	.detial .info a:hover{
				text-decoration: underline;
				}
	.detial .info a:active{
				color:blue;
				}						
	.frindSearch{
				background-color: white;
				border-radius: 10px;
				width: 95%;
				height: 70PX;
				margin: 0px 10px 15px 25px;
				box-shadow: 0 3px 7px 0 rgba(0,0,0,0.16), 0 3px 12px 0 rgba(0,0,0,0.12);

				}
		.Btn_Ad_or_del_frinds{
			float: right;
			margin: 13px 40px;
			background-color: rgb(255,140,0);
			padding: 10px 18px;
			width: auto;
			border-radius: 100px;

		}
		.uName{
				margin: 5px 20px;
    			color: #555;
    			font-size: 13px;
			}
		.Action{       top: 57px;
}

	</style>

		    <?php if(!isset($_SESSION))session_start();
		    if(isset( $_SESSION['login']) && $_SESSION['login']!=='NO'){

		     include 'nav.php' ; }
		     else {include 'nav2.php' ;}
		     ?>

	 <script type="text/javascript">
    
          function changeStateButton3(divId,newState){
            document.getElementById(divId).innerHTML= newState.replace(/'|\\'/g, "\\'");
          }

          function AddFriend3(userid,Friendid){
            
            
           var  xmlhttp;
         if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp=new XMLHttpRequest();
          } else { // code for IE6, IE5
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
          }
          var sql="INSERT INTO frinds(id_user,id_friend,status) VALUES ("+userid+","+Friendid+",0)";
          xmlhttp.open("GET","result_search.php?sql="+sql,true);
              xmlhttp.send(); 

     
 	var FAdButSent='<div class="ViewAction" >'+
                    '<button class="Btn_Ad_or_del_frinds" >'+
                      '<i class="fa fa-user-plus"></i>'+
                      ' Frinds Request Sent'+
                    '</button>'+
                    '<div class="Action">'+
                    '  <button  name=delete  onclick="DeleteFriend3('+
                      userid+','+Friendid+
               ');" id="modButton"> Delete Request</button>'+
                    '</div>'+
                  '</div>';
            changeStateButton3("btnF"+Friendid,FAdButSent);
            
            
          }



          function DeleteFriend3(userid,Friendid){
                     var  xmlhttp;
         if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp=new XMLHttpRequest();
          } else { // code for IE6, IE5
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
          }
          var sql="DELETE FROM frinds where (id_user ='"+userid+"'and id_friend = '"+Friendid+"') or (id_user ='"+Friendid+"'and id_friend = '"+userid+"')";
          xmlhttp.open("GET","result_search.php?sql="+sql,true);
              xmlhttp.send();

       
 	var FrindsBut= '<button class="Btn_Ad_or_del_frinds"  onclick= "AddFriend3('+
               userid+','+Friendid+');">'
              +'<i class="fa fa-user-plus"></i> Add Friend '
            +'</button>'; 
            changeStateButton3("btnF"+Friendid ,FrindsBut);
                 
         }
          function ConfirmRequest3(userid,idF){
		       
                     var  xmlhttp;
         if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp=new XMLHttpRequest();
          } else { // code for IE6, IE5
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
          }
          var sql="UPDATE frinds SET status=1 where id_user ='"+idF+"'and id_friend = '"+userid+"'";
          xmlhttp.open("GET","result_search.php?sql="+sql,true);
              xmlhttp.send();

 	var FrindsBut= '<div class="ViewAction">'+
                    '<button class="Btn_Ad_or_del_frinds">'+
                      '<i class="fa fa-check"></i>'+
                       'Friends'+
                    '</button>'+
                    '<div class="Action">'+
                      '<button onclick="DeleteFriend3('+userid+','+
                      idF+
                      ');" name=delete id="modButton">UnFriend</button>'+
                    '</div> </div>';
                        changeStateButton3("btnF"+idF ,FrindsBut);

            
          }  
      </script>
</head>
<body>


	    <div class="container" >
	  <?php  

if(isset($_SESSION['login']) && $_SESSION['login']=='OK'){
				  function AdBut($id_f){
				  	return '<button class="Btn_Ad_or_del_frinds"  onclick= "AddFriend3('.
			               $_SESSION['id'].','.$id_f.');">'
			              .'<i class="fa fa-user-plus"></i> Add Friend'
			            .'</button>';
				  } 

			     function AdButSent($id_f){
				  	return '<div class="ViewAction" >'.
			                    '<button class="Btn_Ad_or_del_frinds" >'.
			                      '<i class="fa fa-user-plus"></i>'.
			                      ' Frinds Request Sent'.
			                    '</button>'.
			                    '<div class="Action">'.
			                    '  <button  name=delete  onclick="DeleteFriend3('.
			                      $_SESSION['id'].','.$id_f.
			               ');" id="modButton"> Delete Request</button>'.
			                    '</div>'.
			                  '</div>';
				  } 
				  

				 function FrindsBut($id_f){
				  	return '<div class="ViewAction">'.
			                    '<button class="Btn_Ad_or_del_frinds">'.
			                      '<i class="fa fa-check"></i>'.
			                       'Friends'.
			                    '</button>'.
			                    '<div class="Action">'.
			                      '<button onclick="DeleteFriend3('.
			                      $id_f.','.$_SESSION['id'].
			                      ');" name=delete id="modButton">UnFriend</button>'.
			                    '</div> </div>';
				  }  
				  function ResBut($id_f){
				  	return '<div class="ViewAction">'
			                    .'<button class="Btn_Ad_or_del_frinds">'.
			                      '<i class="fa fa-user-plus"></i>'.
			                      ' Respond to Friend Request'.
			                    '</button>'.
			                    '<div class="Action">'.
			                      '<button  onclick="ConfirmRequest3('.$_SESSION['id'].','.
			                     $id_f.
			                     ');" id="modButton">Confirm </button>'.
			                      '<button onclick="DeleteFriend3('.$_SESSION['id'].','.
			                      $id_f.
			                      ');" name=delete id="modButton">Delete Request</button>'.
			                    '</div></div>';
				  }  
	}
  
	 if (isset($_POST['Search'])) {
	    	$fn=trim($_POST['friend']);
	    	include 'db.php';
	    	$sql = "select * from users where ucase(firstname) = ucase('$fn') or ucase(lastname)=ucase('$fn') or ucase(concat(firstname ,' ', lastname))=ucase('$fn') or ucase(userName)=ucase('$fn')";
			$result = mysqli_query($conn,$sql);
	
			if ($result == false) {
	
	}
	
	$num_rows = mysqli_num_rows($result);

	if ($num_rows >= 1) {
			while($row = mysqli_fetch_array($result)){
				if(isset($_SESSION['login']) && $_SESSION['login']=='OK'){


				if($_SESSION['id']==$row['id']){
			searchResult($row['firstname'].' '.$row['lastname'],$row['userName'],$row['image']);
		}
			else {

				    $sql2 = "select * from frinds where (id_user ='".$row['id'] ."'and id_friend = '".$_SESSION['id']."') or (id_user ='".$_SESSION['id'] ."'and id_friend = '".$row['id']."')";
          $result2 = mysqli_query($conn,$sql2);
          if($result2){
        	          $num_rows2 = mysqli_num_rows($result2);

      if ( $num_rows2>0) {
        while ($row2 = mysqli_fetch_array($result2)){
          if($row2['status']==1){
                  $btn=FrindsBut($row['id']);
                }
           else  if($row2['status']==0){
                  if($row2['id_user']==$_SESSION['id']){$btn=AdButSent($row['id']);}
                  else {$btn = ResBut($row['id']);}
              
        }}}
 		   else {$btn=AdBut($row['id']);}    
 				searchResult2($row['firstname'].' '.$row['lastname'],$row['userName'],$row['id'],$row['image'],$btn);
	  
  			}}

  				}// end if login
  		else {

  			SearchResultNotLogin($row['firstname'].' '.$row['lastname'],$row['userName'],$row['image']);
  		}		


			}	//end while
			 
			
	}else{echo '<div class="frindSearch" style="    padding: 12px;
    font-size: 25px;
    text-align: center;
    font-family: cursive;
    color: darkorange;">
						 Not Found 
			</div>
		';
	    }
	}
	    function searchResult($name,$username,$pathImage){

	    	echo '<div class="frindSearch">
			<div class="img">
				<img src="'.$pathImage.'">
			</div>
			<div class="detial">
				<div class=info >
						<a href="profile.php">'.$name.'</a>
						<p class=uName>'.$username.'</p>
				</div>
			</div>
		</div>';
	    }
		 
		  function SearchResult2($name,$username,$iduser,$pathImage,$btn){


	    	echo '<div class="frindSearch" id='.$iduser.'>
			<div class="img">
				<img src="'.$pathImage.'">
			</div>
			<div class="detial">
				<div class=info >
						<a href="full_result_Search.php?id='.$iduser.'">'.$name.'</a>
						<p class=uName>'.$username.'</p>
				</div>
				<div class="btn" id="btnF'.$iduser.'">
					'.$btn.'
				</div>					

			</div>
		</div>';
	    }  
	  
	    function SearchResultNotLogin($name,$username,$pathImage){
	    	echo '<div class="frindSearch" >
			<div class="img">
				<img src="'.$pathImage.'">
			</div>
			<div class="detial">
				<div class=info >
						<a href="project.php">'.$name.'</a>
						<p class=uName>'.$username.'</p>
				</div>
							

			</div>
		</div>';
	    }	  	

	    

	    ?>

	
				
		
	</div>	
		
</body>
</html>