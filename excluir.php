<?php
// Exclusão com risco de SQL Injection e sem confirmação
include("conexao.php");

$id = $_GET["id"];
$sql = "DELETE FROM usuarios WHERE id = $id";
mysqli_query($conn, $sql);

header("Location: index.php");
?>