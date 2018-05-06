<?php

require_once "config.php";

class LivroPersistencia extends DAO
{
    public static function listagemLivros($elementos_por_pagina, $n_pagina = 1)
    {   
        if ($n_pagina > 0) {
            $n_pagina             = $elementos_por_pagina * ($n_pagina - 1);
        }
        $sql    = "SELECT * FROM livros ORDER BY nome LIMIT $n_pagina , $elementos_por_pagina";
        return parent::list($sql);
    }

    public static function cadastrarLivro(Livro $livro)
    {
        $sql    = "insert into livros values (null,:NOME, :AUTOR, :N_DE_PAGINAS, :IMAGEM)";

        $data = array();

        $data[':NOME']         =  $livro->getNome();
        $data[':AUTOR']        =  $livro->getAutor();
        $data[':N_DE_PAGINAS'] =  $livro->getN_De_Paginas();
        $data[":IMAGEM"]       =  $livro->getImagem();

        parent::insert($sql, $data);
        
    }

    public static function editarLivro($id, Livro $livro)
    {
        $data   = array();
        
        $data[':ID']           =  $id;
        $data[':NOME']         =  $livro->getNome();
        $data[':AUTOR']        =  $livro->getAutor();
        $data[':N_DE_PAGINAS'] =  $livro->getN_De_Paginas();
        
        if ($livro->getImagem()) {
            $data[":IMAGEM"]   =  $livro->getImagem();
            $sql               = "update livros set nome = :NOME, autor = :AUTOR, n_de_paginas = :N_DE_PAGINAS, imagem = :IMAGEM where id_livro = :ID";
        } else {
            $sql               = "update livros set nome = :NOME, autor = :AUTOR, n_de_paginas = :N_DE_PAGINAS where id_livro = :ID";
        } 
        
        parent::edit($sql, $data);
    }

    public static function deletaLivro($id)
    {   
        $sql    = "select imagem from livros where id_livro = :ID";
        $imagem = parent::searchForId($sql, $id);
        unlink($imagem['imagem']);
        parent::delete($id);
    }

    public static function buscarPorId($id){
        $sql    = "select * from livros where id_livro = :ID";
        return parent::searchForId($sql,$id);
    }
}