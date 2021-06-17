<?php

//Conexão com o banco 
$sql["host"] = "localhost";
$sql["dbname"]  = "crudwithviacepapi";
$sql["user"] = "root";
$sql["pass"] = "";
$con = mysqli_connect($sql["host"], $sql["user"], $sql["pass"]);

mysqli_select_db($con, $sql["dbname"]);
//fim - conexão com o banco