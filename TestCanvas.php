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

	.flex{
		display: flex;
		background-color: #333;
	}
	.links{
		font-family: 'Montserrat', sans-serif;
		color:white;
		text-align: center;
		padding: 1vw;
	}
	a{
		text-decoration: none;
	}
	a:hover{
		background-color:#111;
	}

	.searchbutton{
  		background-color: #333;
  		border: none;
  		color: white;
  		padding: 1vw;
  		text-decoration: none;
  		font-size: 16px;
  		cursor: pointer;
  		margin-top:auto;
  		margin-bottom: auto;
 
	}

	.searchbutton:hover{
		background-color: #111;
	}
	</style>
</head>

	
<body style = 'background-color: #e3e1e1; margin: unset;' id="Body">

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
	   <input type="text" id="search" maxlength="125" onKeyUp="search_function();" autocomplete="off">
	</form>
	</div>

	<button  class="searchbutton" type="button" onclick="Searchbar();">Search</button>
	</div>

	<script>
	function Searchbar(){
	document.getElementById("search").style="visibility:visible ";
	}
	</script>

	<p id='TestCoords'></p>
	<div style='display: flex; justify-content: center; align-content: center;'>
        
		<div style='display:flex'>
  		
			<div style='display: flex; flex-flow: column;'>
                <input type="range" min="1" max="100" value="5" class="slider" id="Slider">
			    <p id='SlideValue'></p>
			
			    <input type="color" id='LineColor' onChange="ChangeColor();">
				<button style='width: 50px; height: 50px;' onclick="SetDrawingMode('Line')">Line</button>
                <button style='width: 50px; height: 50px;' onclick="SetDrawingMode('Rect')">Rect</button>
				<button style='width: 50px; height: 50px;' onclick="Undo();">Undo</button>
				<button style='width: 50px; height: 50px;' onclick="Redo();">Redo</button>
			
			</div>
		</div>
		
		<canvas id='PlannerCanvas' width="500" height="500" style='border: 1px solid black; background-color: white;' onClick='ClickOnCanvas();' onMouseDown="var MouseClick=1;" onMouseUp="MouseClick=0;" onMouseOut="RemoveCursorLine();"></canvas>
		<button onClick="ClearCanvas();">Clear Canvas</button>
	</div>
	
</body>
	
	<script>
        var ClicksX = [];
        var ClicksY = [];
		var RectClicksX = [];
		var RectClicksY = [];
		var OldClicksX = [];
		var OldClicksY = [];
		var RectPoint1 = [];
        var RectPoint2 = [];
        var RectPoint3 = [];
        var RectPoint4 = [];
		var canvas = document.getElementById('PlannerCanvas');
		var ctx = canvas.getContext('2d');
		var w = canvas.width;
		var h = canvas.height;
		var BrushSize;
		var DrawMode = 'Line';
        var MouseX;
        var MouseY;
        var OldMouseX;
        var OldMouseY;
        var LineColor = 'Black';
		canvas.addEventListener('mousemove', GetMousePos);
       
		
		function ClickOnCanvas(){
			for(var i = 0; i <= ClicksX.length; i++){
                if(((MouseX+(BrushSize/2) <= (ClicksX[i]+BrushSize/2) || MouseX-(BrushSize/2) <= (ClicksX[i]+BrushSize/2)) && (MouseX-(BrushSize/2) >= (ClicksX[i]-BrushSize/2) || MouseX+(BrushSize/2) >= (ClicksX[i]-BrushSize/2))) && ((MouseY+(BrushSize/2) <= (ClicksY[i]+BrushSize/2) || MouseY-(BrushSize/2) <= (ClicksY[i]+BrushSize/2)) && (MouseY-(BrushSize/2) >= (ClicksY[i]-BrushSize/2) || MouseY+(BrushSize/2) >= (ClicksY[i]-BrushSize/2))) && DrawMode == 'Line'){
                    ClicksX.push(ClicksX[i]);
                    ClicksY.push(ClicksY[i]);
                    break;
                }
                else if(i >= (ClicksX.length) && (DrawMode == 'Line')){
					
					ClicksX.push(MouseX);
                    ClicksY.push(MouseY);	
                    break;
                }
                else if (DrawMode == 'Rect'){
                    if((RectClicksX.length-1) % 2 != 0){
                        RectClicksX.push(MouseX);
                        RectClicksY.push(MouseY);
						RectPoint1 = [MouseX, MouseY];
						break;
                    }
                    else{
                        RectClicksX.push(RectPoint2[0]);
                        RectClicksY.push(RectPoint2[1]);
                        RectClicksX.push(RectPoint3[0]);
                        RectClicksY.push(RectPoint3[1]);
                        RectClicksX.push(RectPoint4[0]);
                        RectClicksY.push(RectPoint4[1]);
						break;
                	}
            	}
			}
		}
		


		function GetMousePos(e){
			    
			var rect = canvas.getBoundingClientRect();
            OldMouseX = MouseX;
            OldMouseY = MouseY;
	
			MouseX = e.clientX - rect.left;
			MouseY = e.clientY - rect.top;
            
            //Clears old line and draws new one
            if(DrawMode == 'Line' && (ClicksX.length-1) % 2 == 0){
                ctx.beginPath();
                ctx.moveTo(ClicksX[ClicksX.length-1], ClicksY[ClicksY.length-1]);
                ctx.lineTo(OldMouseX, OldMouseY);
                ctx.clearRect(0,0,w,h); 
                ctx.lineJoin = "round";
                ctx.lineCap = "round";
                ctx.strokeStyle = 'White';//body or canvases color
                ctx.stroke();
                DrawOldLines();
                DrawLine(ClicksX[ClicksX.length-1], ClicksY[ClicksY.length-1], MouseX, MouseY);
                ctx.closePath();
            }
            else if(DrawMode == 'Line'){
                ctx.beginPath();
                ctx.moveTo(OldMouseX, OldMouseY);
                ctx.lineTo(MouseX, MouseY);
                ctx.clearRect(0,0,w,h); 
                ctx.lineJoin = "round";
                ctx.lineCap = "round";
                ctx.strokeStyle = 'Black';//body or canvases color
                ctx.stroke();
                DrawOldLines();
                ctx.closePath();
            }
			else if (DrawMode == 'Rect' && (RectClicksX.length-1) % 2 == 0){
				ctx.beginPath();
                ctx.moveTo(RectClicksX[RectClicksX.length-1], RectClicksY[RectClicksY.length-1]);
				
				var XLine = RectClicksX[RectClicksX.length-1] + Dist(RectClicksX[RectClicksX.length-1], MouseX);
				var YLine = RectClicksY[RectClicksY.length-1] + Dist(RectClicksY[RectClicksY.length-1], MouseY);
				
                ctx.lineTo(XLine, RectClicksY[RectClicksY.length-1]);
				ctx.moveTo(RectClicksX[RectClicksX.length-1], RectClicksY[RectClicksY.length-1]);
				ctx.lineTo(RectClicksX[RectClicksX.length-1], YLine);
				
				
				ctx.lineTo(XLine, MouseY);
				ctx.lineTo(XLine, RectClicksY[RectClicksY.length-1]);
                
				RectPoint1 = [RectClicksX[RectClicksX.length-1], RectClicksY[RectClicksY.length-1]];
                RectPoint2 = [XLine, RectClicksY[RectClicksY.length-1]];
                RectPoint3 = [RectClicksX[RectClicksX.length-1], YLine];
                RectPoint4 = [XLine, MouseY];

				
                ctx.clearRect(0,0,w,h); 
                ctx.lineJoin = "round";
                ctx.lineCap = "round";
                ctx.strokeStyle = 'Black';//body or canvases color
                ctx.stroke();
                DrawOldLines();
                ctx.closePath();
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
			ctx.closePath();
        }
        
		function ClearCanvas(){
			ctx.beginPath();
			ctx.clearRect(0,0,w,h);
			
			//clear stored click values 
			ClicksX = [];
            ClicksY = [];
			RectClicksX = [];
			RectClicksY = [];
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
            for(var i = 0; i < ClicksX.length; i+=2){
                DrawLine(ClicksX[i], ClicksY[i], ClicksX[i+1], ClicksY[i+1]);
            }
			
			for(var i = 0; i < RectClicksX.length; i+=4){
                DrawLine(RectClicksX[i], RectClicksY[i], RectClicksX[i+1], RectClicksY[i+1]);
				DrawLine(RectClicksX[i], RectClicksY[i], RectClicksX[i+2], RectClicksY[i+2]);
				DrawLine(RectClicksX[i+2], RectClicksY[i+2], RectClicksX[i+3], RectClicksY[i+3]);
				DrawLine(RectClicksX[i+1], RectClicksY[i+1], RectClicksX[i+3], RectClicksY[i+3]);
            }
        }
       
		
		function Undo(){
			
			OldClicksX.push(ClicksX[ClicksX.length-1]);
			OldClicksY.push(ClicksY[ClicksY.length-1]);
			ClicksX.pop();
			ClicksY.pop();
			GetMousePos(Event);
		}
		
		function Redo(){
			ClicksX.push(OldClicksX[OldClicksX.length-1]);
			ClicksY.push(OldClicksY[OldClicksY.length-1]);
			OldClicksX.pop();
			OldClicksY.pop();
			DrawOldLines();
		}
		
		function RemoveCursorLine(){
			ctx.beginPath();
			ctx.clearRect(0,0,w,h);
			
			DrawOldLines();
		}
		
		function Dist(val1, val2){
			//var square = (val2 - val1) * (val2 - val1);
			//return Math.sqrt(square);
			return (val2 - val1);
		}
		




















































	






























	</script>
	
</html>