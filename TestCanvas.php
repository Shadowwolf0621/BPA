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

	
<body style = 'background-color: #DFDFDF' id="Body">
	<p id='TestCoords'></p>
	<div style='display: flex; justify-content: center; align-content: center;'>
        
		<div>
  			<input type="range" min="1" max="100" value="5" class="slider" id="Slider">
			<p id='SlideValue'></p>
			
			<input type="color" id='LineColor' onChange="ChangeColor();">
			
			<div style='display: flex; flex-flow: row;'>
				<button style='width: 25px; height: 25px;' onclick="SetDrawingMode('Brush')">Brush</button>
				<button style='width: 25px; height: 25px;' onclick="SetDrawingMode('Line')">Line</button>
				
				
			</div>
		</div>
		
		<canvas id='PlannerCanvas' width="500" height="500" style='border: 1px solid black; background-color: white;' onClick='ClickOnCanvas();' onMouseMove="HoverOverCanvas();" onMouseDown="CurrentMouseButtonPress(event);" onMouseUp="MouseUp();"></canvas>
		<button onClick="ClearCanvas();">Clear Canvas</button>
	</div>
	
</body>
	
	<script>
		
		//var click1Pos = [];
		//var click2Pos = [];
        var ClicksX = [];
        var ClicksY = [];
		var canvas = document.getElementById('PlannerCanvas');
		var ctx = canvas.getContext('2d');
		var w = canvas.width;
		var h = canvas.height;
		var BrushSize;
		var DrawMode = 'Brush';
		var MouseButton = null;
        var MouseX;
        var MouseY;
        var OldMouseX;
        var OldMouseY;
        var LineColor = 'Black';
		canvas.addEventListener('mousemove', GetMousePos);
       
		
		function ClickOnCanvas(){
			
            ClicksX.push(MouseX);
            ClicksY.push(MouseY);
            
		}
		
		function CurrentMouseButtonPress(event){
			MouseButton = event.button;
		}
        
        function MouseUp(){
            MouseButton = null;
        }
		
		function HoverOverCanvas(){
			if(DrawMode == 'Brush' && MouseButton == 0){
				DrawLine(OldMouseX, OldMouseY, MouseX, MouseY);
			}
		}
		
		function GetMousePos(e){
			    
			var rect = canvas.getBoundingClientRect();
            OldMouseX = MouseX;
            OldMouseY = MouseY;
	
			MouseX = e.clientX - rect.left;
			MouseY = e.clientY - rect.top;
            
            //Clears old line and draws new one
            if(DrawMode == 'Line' && ClicksX[ClicksX.length-1] != MouseX){
                ctx.beginPath();
                ctx.moveTo(ClicksX[ClicksX.length-1], ClicksY[ClicksY.length-1]);
                ctx.lineTo(OldMouseX, OldMouseY);
                ctx.lineWidth =  parseInt(BrushSize) + 2; 
                ctx.strokeStyle = 'White';//body or canvases color
                ctx.stroke();
                DrawOldLines();
                DrawLine(ClicksX[ClicksX.length-1], ClicksY[ClicksY.length-1], MouseX, MouseY);
            }
    
			document.getElementById('TestCoords').innerHTML = MouseX + ', ' + MouseY; 
		}
        
        function DrawLine(Pos1X, Pos1Y, Pos2X, Pos2Y){
			ctx.beginPath();
            ctx.lineJoin = "round";
            ctx.lineCap = "round";
            ctx.strokeStyle = LineColor;
            ctx.lineWidth = BrushSize;
            ctx.moveTo(Pos1X, Pos1Y);
            ctx.lineTo(Pos2X, Pos2Y);
            ctx.stroke();
			//ctx.closePath();
        }
        
		function ClearCanvas(){
			ctx.beginPath();
			ctx.clearRect(0,0,w,h);
			
			//clear stored click values 
			ClicksX = [];
            ClicksY = [];
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
			LineColor = colorInput.value;
		}
		
		function SetDrawingMode(Mode){
			DrawMode = Mode;
		}
        
        function DrawOldLines(){
            for(var i = 0; i < ClicksX.length; i++){
                DrawLine(ClicksX[i], ClicksY[i], ClicksX[i+1], ClicksY[i+1]);
				
            }
        }
		
		
	</script>
	
</html>