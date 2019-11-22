<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Untitled Document</title>
</head>

	
<body style = 'background-color: #DFDFDF'>
	<p id='TestCoords'></p>
	<div style='display: flex; justify-content: center; align-content: center;'>
		<canvas id='PlannerCanvas' style='width:50vw; height:50vw; border: 1px solid black' onClick='ClickOnCanvas();'></canvas>
	</div>
	
</body>
	
	<script>
		
		var click1Pos = [,];
		var click2Pos = [,];
		var canvas = document.getElementById('PlannerCanvas');
		var ctx = canvas.getContext('2d');
		var w = canvas.width;
		var h = canvas.height;
		var MouseX;
		var MouseY;	
		canvas.addEventListener('mousemove', GetMousePos);
				   
		
		function ClickOnCanvas(){
			
			if(click1Pos == ''){
				click1Pos[0] = MouseX;
				click1Pos[1] = MouseY;
			}
			else if (click2Pos == ''){
				click2Pos[0] = MouseX;
				click2Pos[1] = MouseY;
                
                DrawLine(click1Pos, click2Pos);
			}
			else {
				click1Pos = [,];
				click2Pos = [,];
				ClickOnCanvas(click1Pos[0], click1Pos[1], click2Pos[0], click2Pos[1]);
			}
			
			
			window.alert(click1Pos);
			window.alert(click2Pos);
			
		}
		
		function GetMousePos(e){
			
			var rect = canvas.getBoundingClientRect();
	
			MouseX = e.clientX - rect.left;
			MouseY = e.clientY - rect.top;
			
			document.getElementById('TestCoords').innerHTML = MouseX + ', ' + MouseY; 
		}
        
        function DrawLine(Pos1X, Pos1Y, Pos2X, Pos2Y){
            window.alert(Pos1X, Pos1Y);
            ctx.moveTo(Pos1X, Pos1Y);
            ctx.lineTo(Pos2X, Pos2Y);
            ctx.stroke();
        }
		
		
	</script>
	
</html>