<!DOCTYPE HTML> 
<html>
<head>
<style>
.error {color: green;}
	#search{
		color: green;
		position: absolute;
		left: 30%;
		top:5%;
		text-align: center;
		background-color: #f3f3f3;
		font-family: sans-serif;
		width: 40%;
		height:30%;
		border-radius: 3%;
	}
	
	#results{
		position: absolute;
		top:40%;
		left:3%;
		width: 90%;
		padding:2%;
		background-color: #f3f3f3;
		font-family: sans-serif;
	}
	
	#button{
		background: #63d934;
		background-image: linear-gradient(to bottom, #63d934, #2bb82b);
		border-radius: 28px;
		font-family: Arial;
		color: #ffffff;
		font-size: 20px;
		padding: 10px 20px 10px 20px;
		text-decoration: none;
	}

	#button:hover{
		background: #46fc3c;
		background-image: -webkit-linear-gradient(top, #46fc3c, #55d934);
		background-image: -moz-linear-gradient(top, #46fc3c, #55d934);
		background-image: -ms-linear-gradient(top, #46fc3c, #55d934);
		background-image: -o-linear-gradient(top, #46fc3c, #55d934);
		background-image: linear-gradient(to bottom, #46fc3c, #55d934);
		text-decoration: none;
	}
</style>
</head>
<body> 
<?php
$Error = $word = $result = "";
$str = file_get_contents('dictionary.json');
$json = json_decode($str, true);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (empty($_POST["word"])) {
		$Error = "You have not enetered any word!";
	} 
	else {
		$word = $_POST["word"];
			if (!preg_match("/^[a-zA-Z ]*$/",$word)) {
				$Error = "Only letters and white space allowed"; 
			}
			else{
				foreach($json as $key => $value){
					if(strpos($key,strtoupper($word))!=NULL){
						$result .= $key.": ".$value."<br><br>";
					}
				}	
					if(strcmp($result,"")==0){
						$Error = "No match found!";
					}
			}
	}
}   
?>
<div id = "search">
<h1>My Dictionary</h1>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
   <input type="text" name="word" size="35" value="<?php echo $word;?>">&nbsp;&nbsp;
   <input id = "button" type="submit" name="submit" value="Search"></br></br> 
   <span class="error"><?php echo $Error;?></span>
</form>
</div>
<div id="results">
<?php
echo $result;
?>
</div>
</body>
</html>