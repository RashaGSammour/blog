<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/navbar.css">
          <link rel="stylesheet" type="text/css" href="css/style.css">



  <title></title>
  <style type="text/css">
  body{background-image: inherit;
      background-color: #f5f7f8 !important;}
    ol{   
    margin-top: -43px;
}
  </style>
</head>
<body>
  <nav>
    <div class="container">
    <a href="home_page.php">
      <img src="img/Logo.PNG">
    </a>
    <div class="search">
      <form method="POST" action="result_search.php">
          <input type="search" name="friend" placeholder="Find a friend">
          <input type="submit" name="Search" value="Search"></form>
    </div>
   
    <ol>
   
    
      <li><a href="project.php">Sign In</a></li>
      <li><a href="#" onclick="document.getElementById('register').style.display = ('block')"> Sign up</a></li>
      <li><a href="#" onclick="document.getElementById('AboutMe').style.display = ('block')"> About us</a></li>    </ol>

  </div>
  </nav>

  <?php  include 'register_and_aboutme.php'; ?>
</body>
</html>

	