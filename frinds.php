<!DOCTYPE html>
<html>
<head>

   <?php        
  include 'nav.php' ;?>
		<title></title>
			<meta charset="utf-8">
		      <link rel="stylesheet" href="css/full_Search_Result.css"/>

	<style type="text/css">	body{ background-color: #f5f7f8 !important ;}
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
		.Action{    bottom: -101px;
}		
	</style>
	 <script type="text/javascript">
    
          function changeStateButton2(divId,newState){
            document.getElementById(divId).innerHTML= newState.replace(/'|\\'/g, "\\'");
          }

          function AddFriend2(userid,Friendid){
            
            
           var  xmlhttp;
         if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp=new XMLHttpRequest();
          } else { // code for IE6, IE5
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
          }
          var sql="INSERT INTO frinds(id_user,id_friend,status) VALUES ("+userid+","+Friendid+",0)";
          xmlhttp.open("GET","frinds.php?sql="+sql,true);
              xmlhttp.send(); 

     
 	var FAdButSent='<div class="ViewAction" >'+
                    '<button class="Btn_Ad_or_del_frinds" >'+
                      '<i class="fa fa-user-plus"></i>'+
                      ' Frinds Request Sent'+
                    '</button>'+
                    '<div class="Action">'+
                    '  <button  name=delete  onclick="DeleteFriend2('+
                      userid+','+Friendid+
               ');" id="modButton"> Delete Request</button>'+
                    '</div>'+
                  '</div>';
            changeStateButton2("btnF"+Friendid,FAdButSent);
            
            
          }



          function DeleteFriend2(userid,Friendid){
                     var  xmlhttp;
         if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp=new XMLHttpRequest();
          } else { // code for IE6, IE5
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
          }
          var sql="DELETE FROM frinds where (id_user ='"+userid+"'and id_friend = '"+Friendid+"') or (id_user ='"+Friendid+"'and id_friend = '"+userid+"')";
          xmlhttp.open("GET","frinds.php?sql="+sql,true);
              xmlhttp.send();

       
 	var FrindsBut= '<button class="Btn_Ad_or_del_frinds"  onclick= "AddFriend2('+
               userid+','+Friendid+');">'
              +'<i class="fa fa-user-plus"></i> Add Friend '
            +'</button>'; 
            changeStateButton2("btnF"+Friendid ,FrindsBut);
                 
         }
      </script>
</head>
<body>
	 <div class="container" >';
	<?PHP 
	include 'db.php';
	 $sql="select users.id,users.userName,users.image,users.firstname,users.lastname from frinds ,users where((frinds.id_user=users.id and frinds.id_friend ='".$_SESSION['id']."') or 
	 			(frinds.id_user='".$_SESSION['id']."' and frinds.id_friend =users.id)

	) AND frinds.status = 1
"      ;

    
          $result = mysqli_query($conn,$sql);
          $num_rows = mysqli_num_rows($result);
      if ( $num_rows>0) {
        while ($row = mysqli_fetch_array($result)){
          FrindsResult($row['firstname'].' '.$row['lastname'],$row['userName'],$row['id'],$row['image']);
        
        }}
      else {echo '<div class="frindSearch" style="    padding: 12px;
    font-size: 25px;
    text-align: center;
    font-family: cursive;
    color: darkorange;" >you have no friends so far </div>';}  
              mysqli_close($conn);

           
	    function FrindsResult($name,$username,$iduser,$pathImage){


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
			<div class="ViewAction">'.
                    '<button class="Btn_Ad_or_del_frinds">'.
                      '<i class="fa fa-check"></i>'.
                       'Friends'.
                    '</button>'.
                    '<div class="Action">'.
                      '<button onclick="DeleteFriend2('.$_SESSION['id'].','.
                      $iduser.
                      ');" name=delete id="modButton">UnFriend</button>'.
                    '</div> </div>
				</div>					

			</div>
		</div>';
	    }
			  

	    ?>
	</div>	
		
</body>
</html>