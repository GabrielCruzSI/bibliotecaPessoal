<?php 

require_once "config.php";

$dao = new LivroPersistencia();
$livro = new Livro();

$id  = $_POST['id_livro'];

$img = $_FILES['imagem'];

if(empty($img['name'])){

    $livro->setNome($_POST['nome']);
    $livro->setAutor($_POST['autor']);
    $livro->setN_de_paginas($_POST['n_de_paginas']);

    $dao->editarLivro($id, $livro);

    header("Location: index.php");
}else{
    
    $sql    = "select imagem from livros where id_livro = ?";
    $imagem = $dao->searchForId($sql, $id);
    
    unlink($imagem['imagem']);
    
    $livro->setNome($_POST['nome']);
    $livro->setAutor($_POST['autor']);
    $livro->setN_De_Paginas($_POST['n_de_paginas']);

    $dir = 'uploads';

    if(!is_dir($dir)){
        mkdir($dir);
    }

    $path_imagem = $dir . DIRECTORY_SEPARATOR . $img['name'];

    $livro->setImagem($path_imagem);
    
    if(move_uploaded_file($img['tmp_name'], $path_imagem)){
        $dao->editarLivro($id, $livro);
        header("Location: index.php");
    }else{
        throw new Exception("Erro ao enviar dormulário!");
    }
}
