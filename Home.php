<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Untitled Document</title>
<link rel="stylesheet" href="HomeStyle.css?<?php echo time('h:i:s:m:d:Y')?>">
<link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body style="margin:0px;">
   <div class="navbar">
	   
	 <a href="#home">Home</a>
	 
  
  <div class="dropdown">
    <button class="dropbtn">Design 
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="#">Create Your Own Home</a>
      <a href="#">Choose From Presets</a>
      <a href="#">Link 3</a>
    </div>
  </div>
  <div class="dropdown">
    <button class="dropbtn">Info 
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="#">Challenges</a>
      <a href="#">Contracts</a>
	  <a href="#">Sites</a>
    </div>
  </div> 
	   <div class="search-container">
    <form action="/action_page.php">
      <input class="search-bar" type="text" placeholder="Search.." name="search">
      <button type="submit"><i class="fa fa-search"></i></button>
    </form>
  </div>
</div>
	
	
	

	
	
	
	
	
</body>
</html>