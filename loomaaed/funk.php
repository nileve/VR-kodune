<?php

function connect_db() {
	global $connection;
	$host = "localhost";
	$user = "test";
	$pass = "t3st3r123";
	$db = "test";
	$connection = mysqli_connect($host, $user, $pass, $db) or die("ei saa ühendust mootoriga- ".mysqli_error());
	mysqli_query($connection, "SET CHARACTER SET UTF8") or die("Ei saanud baasi utf-8-sse - ".mysqli_error($connection));

}

function kuva_puurid() {
   global $connection;

   if(empty($_SESSION["user"])) {
      header("Location: ?page=login");
   } else {
      // siia on vaja funktsionaalsust
      $query = "SELECT DISTINCT(puur) FROM 10040908_loomaaed2 ORDER BY puur";
      $result = mysqli_query($connection, $query) or die("$query - ".mysqli_error($connection));
      // hangime tulemusest 1 rea
      $puurid = array();

      while ($row = mysqli_fetch_assoc($result)) {
         $puurid[$row["puur"]] = array();
         $query2 = "SELECT * FROM 10040908_loomaaed2 WHERE puur = ".$row["puur"];
         $result2 = mysqli_query($connection, $query2) or die("$query2 - ".mysqli_error($connection));
         while ($row2 = mysqli_fetch_assoc($result2)) {
            $puurid[$row["puur"]][] = $row2;
         }
      }

   }

   echo "<pre>";
   print_r($puurid);
   echo "</pre>";

	include_once('views/puurid.html');

}

function login() {
	// siia on vaja funktsionaalsust (13. nädalal)
   global $connection;

   if ($_SERVER['REQUEST_METHOD'] == 'GET') {
      include_once('views/login.html');
	}

	if (!empty($_SESSION["user"])) {
		header("Location: ?page=loomad");
	}

   if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $errors = array();
      if (empty($_POST["user"]) || empty($_POST["pass"])) {
         $errors[] = "Check logins";
         include_once('views/login.html');
      } else {
         $u = mysqli_real_escape_string($connection, $_POST["user"]);
         $p = mysqli_real_escape_string($connection, $_POST["pass"]);

         $sql = "SELECT * FROM 10040908_kylastajad WHERE username = '$u' AND passw = SHA1('$p')";

         $result = mysqli_query($connection, $sql);
         $row = mysqli_num_rows($result);

         if ($row >= 1) {
            $_SESSION["user"] = $_POST["user"];
            header("Location: ?page=loomad");
         } else {
            header("Location: ?page=login");
         }

      }
   }

   include_once('views/login.html');

}

function logout() {
	$_SESSION = array();
	session_destroy();
	header("Location: ?");

}

function lisa() {
	// siia on vaja funktsionaalsust (13. nädalal)
   global $connection;

   if (empty($_SESSION["user"])) {
      header("Location: ?page=login");
   } else {
      if ($_SERVER['REQUEST_METHOD'] == 'GET') {
         include_once('views/loomavorm.html');
      }
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
         $errors = array();
         if (empty($_POST["nimi"])) {
            $errors[] = "Sisesta nimi";
         }
         if (empty($_POST["vanus"])) {
            $errors[] = "Sisesta vanus";
         }
         if (upload("liik") == ""){
				$errors[] = "Lisa pilt";
         }
         if (empty($_POST["puur"])) {
            $errors[] = "Sisesta puuri number";
         }
      } else {
         $nimi = mysqli_real_escape_string($connection, $_POST["nimi"]);
         $vanus = mysqli_real_escape_string($connection, $_POST["vanus"]);
         $liik = mysqli_real_escape_string($connection, "pildid/".$_FILES["liik"]["name"]);
         $puur = mysqli_real_escape_string($connection, $_POST["puur"]);

         $sql = "INSERT INTO 10040908_loomaaed2(nimi, vanus, liik, puur) VALUES ('$nimi', $vanus, '$liik', '$puur')";
         $result = mysqli_query($connection, $sql);

         if (mysqli_insert_id($connection) > 0){
            header("Location: ?page=loomad");
         } else {
            header("Location: ?page=loomavorm");
         }
      }
   }

   include_once('views/loomavorm.html');

}

function upload($name) {
	$allowedExts = array("jpg", "jpeg", "gif", "png");
	$allowedTypes = array("image/gif", "image/jpeg", "image/png","image/pjpeg");
	$extension = end(explode(".", $_FILES[$name]["name"]));

	if (in_array($_FILES[$name]["type"], $allowedTypes)
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
