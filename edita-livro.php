<?php 

$conn = new PDO("mysql:host=localhost;dbname=biblioteca", 'root', '1234');

if(empty($_FILES['imagem']['name'])){
    
    $stmt = $conn->prepare("update livros set nome = :NOME, autor = :AUTOR, n_de_paginas = :N_DE_PAGINAS where id_livro = :ID");

    $nome         = $_POST['nome'];
    $autor        = $_POST['autor'];
    $n_de_paginas = $_POST['n_de_paginas'];
    $id           = $_POST['id_livro'];
    $imagem       = $_FILES['imagem'];

    $stmt->execute(array(
        ":NOME"        => $nome,
        ":AUTOR"       => $autor,
        ":N_DE_PAGINAS"=> $n_de_paginas,
        ":ID"          => $id
    ));

    header("Location: index.php");
}else{
    $id           = $_POST['id_livro'];
    $stmt = $conn->prepare("select imagem from livros where id_livro = :ID");
    $stmt->bindParam(":ID", $id);
    $stmt->execute();

    $res = $stmt->fetch();
    unlink($res['imagem']);
    
    $stmt = $conn->prepare("update livros set nome = :NOME, autor = :AUTOR, n_de_paginas = :N_DE_PAGINAS, imagem = :IMAGEM where id_livro = :ID");

    $nome         = $_POST['nome'];
    $autor        = $_POST['autor'];
    $n_de_paginas = $_POST['n_de_paginas'];
    $imagem       = $_FILES['imagem'];

    

    $stmt->bindParam(":NOME"        , $nome        );
    $stmt->bindParam(":AUTOR"       , $autor       );
    $stmt->bindParam(":N_DE_PAGINAS", $n_de_paginas);
    $stmt->bindParam(":ID", $id);

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
}
