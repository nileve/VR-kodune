<?php
$txt="Sinu tekst";
if (isset($_POST['text']) && $_POST['text']!="") {
    $txt=htmlspecialchars($_POST['text']);
}
$bgC="red";
if (isset($_POST['bgColor']) && $_POST['bgColor']!="") {
        $bgC=htmlspecialchars($_POST['bgColor']);
}
$txtC="blue";
if (isset($_POST['textColor']) && $_POST['textColor']!="") {
    $txtC=htmlspecialchars($_POST['textColor']);
}
$borderC="yellow";
if (isset($_POST['borderColor']) && $_POST['borderColor']!='') {
        $borderC=htmlspecialchars($_POST['borderColor']);
}
$borderS="dotted";
if (isset($_POST['borderStyle']) && $_POST['borderStyle']!='') {
        $borderS=htmlspecialchars($_POST['borderStyle']);
}
$borderW="5";
if (isset($_POST['borderWidth']) && $_POST['borderWidth']!='') {
        $borderW=htmlspecialchars($_POST['borderWidth]);
}
$borderR="5";
if (isset($_POST['borderRadius']) && $_POST['borderRadius']!='') {
        $borderR=htmlspecialchars($_POST['borderRadius']);
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
	<title>8. kodune</title>
	<style>
	body {
		background: <?php echo $bgC; ?>;
	}
	.text {
		color: <?php echo $txtC; ?>;
		border-color: <?php echo $borderC;?>;
        border-style: <?php echo $borderS;?>;
        border-width: <?php echo $borderW;?>px;
        border-radius: <?php echo $borderR;?>px;
	}
	</style>
</head>

<body>
<textarea class="text" rows="10" cols="100">
<?php
echo $txt; 
?>
</textarea>
<br>
<form method="post" action="" id ="input">
<textarea name="text" form="input" rows="10" cols="100" placeholder="asd"></textarea>
<p><input type="color" name="bgColor" value="<?php echo $bgC;?>">Taustavärvus</p>
<p><input type="color" name="textColor" value="<?php echo $txtC;?>">Teksti värvus</p>
<p><input type="color" name="borderColor" value="<?php echo $borderC;?>">Piirjoone värvus</p>
<p>Piirjoone stiil 
<select name="borderStyle">
	<option value="dotted">Dotted</option>
	<option value="dashed">Dashed</option>
    <option value="solid">Solid</option>   
</select>
</p>
<p><input type="number" name="borderWidth" min="0" max="20" value="<?php echo $borderW;?>">Piirjoone laius 0-20px</p>
<p><input type="number" name="borderRadius" min="0" max="100" value="<?php echo $borderR;?>">Piirjoone nurga raadius 0-100px</p>
<button type="submit">esita</button></p>
</form>
</body>

</html>