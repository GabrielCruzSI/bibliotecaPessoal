<?php 


require_once "config.php";

$dao = new LivroPersistencia();
$livro = new Livro();

$livro->setNome($_POST['nome']);
$livro->setAutor($_POST['autor']);
$livro->setN_de_paginas($_POST['n_de_paginas']);

$imagem       = $_FILES['imagem'];

$dir = 'uploads';

if(!is_dir($dir)){
    mkdir($dir);
}

$path_imagem = $dir . DIRECTORY_SEPARATOR . $imagem['name'];

$livro->setImagem($path_imagem);


if(move_uploaded_file($imagem['tmp_name'], $path_imagem)){
    $dao->cadastrarLivro($livro);
    header("Location: index.php");
}else{
    throw new Exception("Erro ao enviar dormulário!");
}