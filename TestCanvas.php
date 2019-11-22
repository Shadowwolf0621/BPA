<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Untitled Document</title>
	
	
	
	<style>
	.Slider {
  		appearance: none;
  		width: 100%; 
  		height: 25px; 
  		background: #d3d3d3; 
  		outline: none; 
  		opacity: 0.7;
  		transition: opacity .2s;
	}	

	.Slider:hover {
  		opacity: 1;
	}
		</style>
</head>

	
<body style = 'background-color: #DFDFDF'>
	<p id='TestCoords'></p>
	<div style='display: flex; justify-content: center; align-content: center;'>
		
		<div>
  			<input type="range" min="1px" max="100px" value="5px" class="slider" id="Slider">
			<p id='SlideValue'></p>
			
			<input type="color" id='LineColor' onChange="ChangeColor();">
			
			<div style='display: flex; flex-flow: row;'>
				<button style='width: 25px; height: 25px;' onclick="SetDrawingMode('Brush')">Brush</button>
				<button style='width: 25px; height: 25px;' onclick="SetDrawingMode('Line')">Line</button>
				
				
			</div>
		</div>
		
		<canvas id='PlannerCanvas' width="500" height="500" style='border: 1px solid black' onClick='ClickOnCanvas();' onMouseMove="HoverOverCanvas();" onMouseDown="CurrentMouseButtonPress(event);"></canvas>
		<button onClick="ClearCanvas();">Clear Canvas</button>
	</div>
	
</body>
	
	<script>
		
		var click1Pos = [,];
		var click2Pos = [,];
		var canvas = document.getElementById('PlannerCanvas');
		var ctx = canvas.getContext('2d');
		var w = canvas.width;
		var h = canvas.height;
		var BrushSize;
		var DrawMode = 'Brush';
		var MouseButton;
		canvas.addEventListener('mousemove', GetMousePos);
				   
		
		function ClickOnCanvas(){
			
			if(DrawMode == 'Line'){
				if(click1Pos == ''){
					click1Pos[0] = MouseX;
					click1Pos[1] = MouseY;
				}
				else if (click2Pos == ''){
					click2Pos[0] = MouseX;
					click2Pos[1] = MouseY;
                
                	DrawLine(click1Pos[0], click1Pos[1], click2Pos[0], click2Pos[1]);
				}
				else {
					click1Pos = [,];
					click2Pos = [,];
					ClickOnCanvas();
				}		
			}
		}
		
		function CurrentMouseButtonPress(event){
			MouseButton = event.button;
		}
		
		function HoverOverCanvas(){
			if(DrawMode == 'Brush' && MouseButton == 0){
				DrawLine(0, 0, MouseX, MouseY);
			}
		}
		
		function GetMousePos(e){
			
			var rect = canvas.getBoundingClientRect();
	
			MouseX = e.clientX - rect.left;
			MouseY = e.clientY - rect.top;
			
			document.getElementById('TestCoords').innerHTML = MouseX + ', ' + MouseY; 
		}
        
        function DrawLine(Pos1X, Pos1Y, Pos2X, Pos2Y){
			ctx.beginPath();
            ctx.moveTo(Pos1X, Pos1Y);
            ctx.lineTo(Pos2X, Pos2Y);
            ctx.stroke();
			ctx.closePath();
        }
		
		function ClearCanvas(){
			ctx.beginPath();
			ctx. clearRect(0,0,w,h);
			
			//clear stored click values 
			click1Pos = [,];
			click2Pos = [,];
		}
		
		var slider = document.getElementById("Slider");
		var output = document.getElementById("SlideValue");
		output.innerHTML = slider.value;

		// Update the current slider value
		slider.oninput = function() {
  			output.innerHTML = this.value;
			BrushSize = this.value;
			ctx.lineWidth = BrushSize;
		}
		
		function ChangeColor(){
			var colorInput = document.getElementById('LineColor');
			ctx.strokeStyle = colorInput.value;
		}
		
		function SetDrawingMode(Mode){
			DrawMode = Mode;
		}
		
		
	</script>
	
</html>