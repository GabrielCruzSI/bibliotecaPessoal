<?php

$id = $_GET['id'];

$conn = new PDO("mysql:host=localhost;dbname=biblioteca", 'root', '1234');

$stmt = $conn->prepare("select imagem from livros where id_livro = :ID");
$stmt->bindParam(":ID", $id);
$stmt->execute();

$res = $stmt->fetch();

unlink($res['imagem']);

$stmt = $conn->prepare("delete from livros where id_livro = :ID");
$stmt->bindParam(":ID", $id);
$stmt->execute();

header("Location: index.php");

?>