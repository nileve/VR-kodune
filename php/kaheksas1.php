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