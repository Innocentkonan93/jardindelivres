<?php 

if($_GET['id'])
{

    $db = new PDO("mysql:host=localhost;dbname=idl",'root','');


    $id = $_GET['id'];

    $sql = "DELETE FROM livre WHERE id='$id' ";


    $query = $db->prepare($sql);
    $resultat = $query->execute();

    if($resultat)
    {
        header("Location: edit.php");
    }



}



?>