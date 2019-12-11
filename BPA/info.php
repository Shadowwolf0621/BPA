<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<link href="mystyle.css" rel="stylesheet" type="text/css">
<title>Untitled Document</title>
</head>

<body style="margin:0px;">
	
	<div class="flex">
	<a href="#">
	<div class="links">Home</div>
	</a>
	<a href="#">
	<div class="links">Design</div>
	</a>
	<a href="#">
	<div class="links">Info</div>
	</a>



	<div style="margin-left:auto; padding-right:5px; margin-top:auto; margin-bottom: auto; visibility:hidden; ">
	<form>
	   <input type="text"  id="sb" name="search" maxlength="125" onKeyUp="searchfunction">
	</form>
	</div>

	<button  class="searchbutton" type="button" onclick="Searchbar();">Search</button>

	</div> 

	<script>
	function Searchbar()
	{
	document.getElementById("sb").style="visibility:visible	";
	}

</script>
	
	<div class="header">
	
		<h1>Information</h1>
		<p>Building a green home can be a stressful experience. <br> 
		Here, you can get answers to the questions you may have!
		</p>
	</div>
	
	<div style="row1">
		<div class="MissionStatement">
			<a href="#">
				<img src="grayBox.png" alt="green home" width="250" height="250">
			</a>
		
			<div class="desc">
				<p> We strive to achieve a cleaner envoirment, <br>
					by reducing use of electricity and fosill fuels.
				</p>
			</div>
			
		<div class="Benefits">
			<a href="#">
				<img src="grayBox.png" alt="green home" width="250" height="250">
			</a>
			<div class="desc">
				<p> We strive to achieve a cleaner envoirment, <br>
					by reducing use of electricity and fosill fuels.
				</p>
			</div>
		</div>
			
	</div>
	
	</div>	

		<div class="Solar"></div>

		<div class="Wind"></div>

		<div class="Conatact"></div>

		<div class="Work Cited"></div>
		
	</div>
	
	
	
	
</body>
</html>