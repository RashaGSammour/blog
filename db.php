<?php 

		$ServerName="localhost";
		$user = "root";
		$password="12345678";
		$conn =mysqli_connect($ServerName,$user,$password); 
	
		if ($conn == false) {
			echo "Error: can't connect to database server";
			exit;
		}
	
		// create data base
		$sql= "CREATE DATABASE IF NOT EXISTS my_community";

		mysqli_query($conn,$sql);
		// end create data base	
		
		//------------------- careate table  for user 
		mysqli_select_db($conn,'my_community');
			$sql = "CREATE TABLE `users` (
 `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
 `firstname` varchar(50) NOT NULL,
 `lastname` varchar(50) NOT NULL,
 `userName` varchar(100) NOT NULL,
 `password` varchar(32) NOT NULL,
 `email` varchar(255) NOT NULL,
 `image` text NOT NULL,
 `nationality` varchar(50) NOT NULL,
 `info` text NOT NULL,
 `date_of_birth` date NOT NULL,
 `place_of_birth` varchar(50) NOT NULL,
 PRIMARY KEY (`id`),
 UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=latin1 ";	
		mysqli_query($conn, $sql);

		//  create tabel for post 

		
		$sql = "
CREATE TABLE `post_tab` (
 `user_id` int(6) unsigned NOT NULL,
 `id_post` int(10) unsigned NOT NULL AUTO_INCREMENT,
 `post_content` text NOT NULL,
 `post_image` text  DEFAULT null,
 `date_of_creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
 PRIMARY KEY (`id_post`,`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=98 DEFAULT CHARSET=utf8


";
		mysqli_query($conn, $sql);

		$sql = "
CREATE TABLE `frinds` (
 `id_user` int(6) NOT NULL,
 `id_friend` int(6) NOT NULL,
 `status` int(2) unsigned NOT NULL,
 PRIMARY KEY (`id_user`,`id_friend`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1


";
		mysqli_query($conn, $sql);
	$sql ="	CREATE TABLE `info` (
			 `id_user` int(11) NOT NULL,
			 `school_name` varchar(100) DEFAULT NULL,
			 `university_name` varchar(100) DEFAULT NULL,
			 `specialization_name` varchar(100) DEFAULT NULL,
			 `phone_no` int(11) DEFAULT NULL,
			 `work` varchar(100) DEFAULT NULL,
			 `gender` varchar(10) DEFAULT NULL,
			 PRIMARY KEY (`id_user`)
			) ENGINE=InnoDB DEFAULT CHARSET=latin1";

		mysqli_query($conn, $sql);
?>