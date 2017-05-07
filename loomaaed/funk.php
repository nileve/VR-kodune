<?php


function connect_db(){
	global $connection;
	$host="localhost";
	$user="test";
	$pass="t3st3r123";
	$db="test";
	$connection = mysqli_connect($host, $user, $pass, $db) or die("ei saa ühendust mootoriga- ".mysqli_error());
	mysqli_query($connection, "SET CHARACTER SET UTF8") or die("Ei saanud baasi utf-8-sse - ".mysqli_error($connection));
}

function logi(){
	// siia on vaja funktsionaalsust (13. nädalal)

	include_once('views/login.html');
}

function logout(){
	$_SESSION=array();
	session_destroy();
	header("Location: ?");
}

function kuva_puurid(){
   global $connection;
	// siia on vaja funktsionaalsust
   $query = "SELECT DISTINCT(puur) FROM 10040908_loomaaed2 ORDER BY puur";
   $result = mysqli_query($connection, $query) or die("$query - ".mysqli_error($connection));
   // hangime tulemusest 1 rea
   $puurid = array();
   while ($row = mysqli_fetch_assoc($result)){
      $puurid[$row["puur"]] = array();
      $query2 = "SELECT * FROM 10040908_loomaaed2 WHERE puur = ".$row["puur"];
      $result2 = mysqli_query($connection, $query2) or die("$query2 - ".mysqli_error($connection));
      while ($row2 = mysqli_fetch_assoc($result2)) {
         $puurid[$row["puur"]][] = $row2;
      }
   }

   print_r($puurid);

	include_once('views/puurid.html');

}

function lisa(){
	// siia on vaja funktsionaalsust (13. nädalal)

	include_once('views/loomavorm.html');

}

function upload($name){
	$allowedExts = array("jpg", "jpeg", "gif", "png");
	$allowedTypes = array("image/gif", "image/jpeg", "image/png","image/pjpeg");
	$extension = end(explode(".", $_FILES[$name]["name"]));

	if ( in_array($_FILES[$name]["type"], $allowedTypes)
		&& ($_FILES[$name]["size"] < 100000)
		&& in_array($extension, $allowedExts)) {
    // fail õiget tüüpi ja suurusega
		if ($_FILES[$name]["error"] > 0) {
			$_SESSION['notices'][]= "Return Code: " . $_FILES[$name]["error"];
			return "";
		} else {
      // vigu ei ole
			if (file_exists("pildid/" . $_FILES[$name]["name"])) {
        // fail olemas ära uuesti lae, tagasta failinimi
				$_SESSION['notices'][]= $_FILES[$name]["name"] . " juba eksisteerib. ";
				return "pildid/" .$_FILES[$name]["name"];
			} else {
        // kõik ok, aseta pilt
				move_uploaded_file($_FILES[$name]["tmp_name"], "pildid/" . $_FILES[$name]["name"]);
				return "pildid/" .$_FILES[$name]["name"];
			}
		}
	} else {
		return "";
	}
}

?>
