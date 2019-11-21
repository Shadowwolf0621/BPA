<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Untitled Document</title>
</head>

	
<body style = 'background-color: #DFDFDF'>
	
	<div style='display: flex; justify-content: center; align-content: center;'>
		<canvas id='PlannerCanvas' style='width:50vw; height:50vw; border: 1px solid black' onClick='ClickOnCanvas();' onMouseMove='GetMousePos(e);'></canvas>
	</div>
	
</body>
	
	<script>
		
		var clickPos;
		var canvas = document.getElementById('PlannerCanvas');
		var ctx = canvas.getContext('2d');
		var w = canvas.width;
		var h = canvas.height;
		var MouseX;
		var MouseY;	
		
		function ClickOnCanvas(){
			
			GetMousePos();
			
		}
		
		function GetMousePos(e){
			
			var rect = canvas.getBoundingClientRect();
	
			MouseX = e.clientX - rect.left;
			MouseY = e.clientY - rect.top;
			
			window.alert(MouseX);
		}
		
		
	</script>
	
</html>