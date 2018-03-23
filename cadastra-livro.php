<?php 

$conn = new PDO("mysql:host=localhost;dbname=biblioteca", 'root', '1234');

$stmt = $conn->prepare("insert into livros values (null,:NOME, :AUTOR, :N_DE_PAGINAS, :IMAGEM)");

$nome         = $_POST['nome'];
$autor        = $_POST['autor'];
$n_de_paginas = $_POST['n_de_paginas'];
$imagem       = $_FILES['imagem'];

$stmt->bindParam(":NOME"        , $nome        );
$stmt->bindParam(":AUTOR"       , $autor       );
$stmt->bindParam(":N_DE_PAGINAS", $n_de_paginas);

$dir = 'uploads';

if(!is_dir($dir)){
    mkdir($dir);
}

$path_imagem = $dir . DIRECTORY_SEPARATOR . $imagem['name'];

$stmt->bindParam(":IMAGEM"      , $path_imagem );

if(move_uploaded_file($imagem['tmp_name'], $path_imagem)){
    $stmt->execute();
    header("Location: index.php");
}else{
    throw new Exception("Erro ao enviar dormulário!");
}