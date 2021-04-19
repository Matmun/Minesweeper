

<!DOCTYPE html>
<html lang="pl">
<head>
  <title>Saper</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>  

<style>
.board{
	text-align:center;
	width: 33% ;
	margin-left: auto ;
	margin-right: auto ;
	margin-right: auto ;

}
#guzikNo1{
	position:absolute;
	top:70px;
	left:50px;
	margin-left: auto ;
	margin-right: auto ;
	margin-right: auto ;
}

#import{
	position:absolute;
	top:70px;
	left:104px;
	margin-left: auto ;
	margin-right: auto ;
	margin-right: auto ;
}
#guzikNo2{
	position:absolute;
	top:70px;
	left:158px;
	margin-left: auto ;
	margin-right: auto ;
	margin-right: auto ;
}
#timer{
	font-family:'digital-clock-font';
	height:54px;
	width: 54px;
	text-align:center;
	padding:12px;
	position:absolute;
	top:134px;
	left:77px;
	color:darkred;
	border: 1px solid black;
	font-size:20px;
	
}


body{
	background-color: darkgray;
}


</style>
</head>


<body>
<div id="timer">
	<p id ="timerr">0</p>
</div>
<div class="board">
	<span id="main"></span>
</div>
<input id ="guzikNo1" type="image" src="9.png" alt="tryb kursora" onclick="cursorMode();" />
<input id ="import" type="image" src="export.png" alt="import" onclick="convertToJSON();" />
<input id ="guzikNo2" type="image" src="alive.png" alt="tryb kursora" onclick="reload();" />

<script>

var started=0;
var szerokosc = 54;
var mmode=0;
var gameon=1;
var ilosc_pol= 16*10;
var Miny = new Array(18);
var MinyOdsloniete = new Array(18);
for(var i=0;i<18;++i){
	Miny[i] = new Array(12);
	MinyOdsloniete[i] = new Array(12);
	for(var j=0;j<12;++j){
		Miny[i][j]=0;
		MinyOdsloniete[i][j]=0;
	}
}

function klik(){
	start();
	var x=Math.floor(this.id%12);
	var y=Math.floor(this.id/12);
	if(gameon==0) return;
	if (mmode==1){
		
		if(MinyOdsloniete[y][x]==0){
			this.style.backgroundImage = "url('flag.png')"
			MinyOdsloniete[y][x]=2;
		}
		else if(MinyOdsloniete[y][x]==2){
			this.style.backgroundImage="url('k.png')";
			MinyOdsloniete[y][x]=0;
		
		}else return;
	}else{

		if (MinyOdsloniete[y][x]==2) return;

		if(MinyOdsloniete[y][x]==0){
			this.style.backgroundImage = "url('"+Miny[y][x]+".png')"; 
			ilosc_pol--;
			MinyOdsloniete[y][x]=1;
		}
		
		
		if(Miny[y][x]==0){
			klik2(y-1,x+1);
			klik2(y-1,x);
			klik2(y-1,x-1);
			klik2(y,x-1);
			klik2(y,x+1);
			klik2(y+1,x+1);
			klik2(y+1,x);
			klik2(y+1,x-1);	
		}
		if(Miny[y][x]==9 && gameon==1) {
			var h1 = document.createElement("h1");
			h1.innerHTML=("przegrales");
			h1.style.color="red";
			document.getElementById("main").appendChild(h1);
			gameon=0;
			odslon();
			this.style.backgroundImage="url('mw.png')";
			document.getElementById("guzikNo2").src="ded.png";
		}
		
		
		
		if(ilosc_pol<=34 && gameon==1){
			var h1 = document.createElement("h1");
			h1.innerHTML=("wygrales");
			h1.style.color="green";
			document.getElementById("main").appendChild(h1);
			document.getElementById("guzikNo2").src="winner.png";
			gameon=0 ;
		}
	}
}


function klik2(y,x){
	if(gameon==0) return;
	if(x==0|| x==11 || y==0 || y==17) return;
	
	
	if(MinyOdsloniete[y][x]==0){
		document.getElementById(y*12 + x).style.backgroundImage = "url('"+Miny[y][x]+".png')";  
		ilosc_pol--;
		MinyOdsloniete[y][x]=1;
		
		if(Miny[y][x]==0){
			klik2(y-1,x+1);
			klik2(y-1,x);
			klik2(y-1,x-1);
			klik2(y,x-1);
			klik2(y,x+1);
			klik2(y+1,x+1);
			klik2(y+1,x);
			klik2(y+1,x-1);	
		}
		
	}
	
	
	
	if(ilosc_pol<=34 && gameon==1){
		var h1 = document.createElement("h1");
		h1.innerHTML=("wygrales");
		h1.style.color="green";
		document.getElementById("main").appendChild(h1);
		document.getElementById("guzikNo2").src="winner.png";
		gameon=0 ;
	}
}





function odslon(){
	var y=1;
	var x=1
	for(y=1;y<=16;y++){
		if(y==0 || y==17)continue;
		for(x=1;x<=10;x++){
			if(x==0|| x==11 ) continue;
			document.getElementById(y*12 + x).style.backgroundImage = "url('"+Miny[y][x]+".png')";
		}
	}
}

function cursorMode(){
	if(mmode==0) {
		mmode=1
		document.getElementById("guzikNo1").src="flag.png"
	}
	else {
	mmode=0;
	document.getElementById("guzikNo1").src="9.png"
	}
}

function start() {
	if(started==0){
		started=1;
		setInterval(function(){if(gameon) document.getElementById("timerr").innerHTML=parseInt(document.getElementById("timerr").innerHTML)+1; }, 1000);
	}
}

function reload(){
	location = self.location;
}


for(var i=0;i<18;i++){
	for(var j=0;j<12;j++){
		var div = document.createElement("div");
		div.float="left";
		div.style.position="absolute";

		div.style.top =  szerokosc*i+10+"px";
		div.style.left = szerokosc*j+ window.innerWidth/2-6*szerokosc +"px";

		div.style.width = szerokosc+"px";
		div.style.height = szerokosc+"px";
		div.style.backgroundImage = "url('k.png')"; 
		div.id = i*12+j;
		div.onclick= klik;
		
		div.style.color = "white";
		div.align = "center";
		document.getElementById("main").appendChild(div);
		if(i==0|| i==17 || j==0 || j==11) div.style.visibility="hidden";
	}
}



<?php 



	if(empty($_GET["save"])){
	
	
		echo '
		mine_placement(34);
		counting_mines();
		
		
		function mine_placement(left){
		while (left>0){
			var Y=Math.floor(Math.random() * 16 + 1);
			var X=Math.floor(Math.random() * 10 + 1);
			if(Miny[Y][X]==0){
				Miny[Y][X]=9;
				left--;
				
		}
	}
}
function counting_mines(){
	for(var i=1;i<17;++i){
		for(var j=1;j<11;++j){
			if(Miny[i][j]!=9){
				if(Miny[i-1][j-1]==9) 	Miny[i][j]++;
				if(Miny[i-1][j]==9) 	Miny[i][j]++;
				if(Miny[i-1][j+1]==9) 	Miny[i][j]++;
				if(Miny[i][j-1]==9)		Miny[i][j]++;
				if(Miny[i][j+1]==9)		Miny[i][j]++;
				if(Miny[i+1][j-1]==9) 	Miny[i][j]++;
				if(Miny[i+1][j]==9) 	Miny[i][j]++;
				if(Miny[i+1][j+1]==9)	Miny[i][j]++;
			}
		}
	}
	
}

' ;
	}
	else {
		echo 'Miny = JSON.parse('.$_GET["Miny"].' )
		MinyOdsloniete = JSON.parse('.$_GET["Zas"].')' ;
		
	}
?>


	for(var y=1;y<=16;y++){
		for(var x=1;x<=10;x++){
			if(MinyOdsloniete[y][x]==1)
				document.getElementById(y*12 + x).style.backgroundImage = "url('"+Miny[y][x]+".png')";
			else if(MinyOdsloniete[y][x]==2)
				document.getElementById(y*12 + x).style.backgroundImage = "url('flag.png')";
		}
	}


function convertToJSON(){
	var a=JSON.stringify(Miny);
	var b=JSON.stringify(MinyOdsloniete);
	alert('Link: http://localhost/saper/saper.php?save=1&Miny="'+a+'"&Zas="'+b+'"');
}


//34miny
</script>
</body>
</html>