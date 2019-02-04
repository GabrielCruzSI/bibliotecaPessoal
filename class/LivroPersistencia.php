<?php

class LivroPersistencia extends DAO
{
    /**
     * @param $elementos_por_pagina
     * @param int $n_pagina
     * @return mixed
     */
    public function listagemLivros($elementos_por_pagina, $n_pagina = 1)
    {   
        if ($n_pagina > 0) {
            $n_pagina             = $elementos_por_pagina * ($n_pagina - 1);
        }
        $sql    = "SELECT * FROM livros ORDER BY nome LIMIT $n_pagina , $elementos_por_pagina";
        return $this->list($sql);
    }

    /**
     * @param Livro $livro
     */
    public function cadastrarLivro(Livro $livro)
    {
        $sql    = "insert into livros (nome, autor, imagem, n_de_paginas) values (? , ? , ?, ?)";

        $data = [
            $livro->getNome(),
            $livro->getAutor(),
            $livro->getImagem(),
            $livro->getN_De_Paginas(),
        ];

        $this->insert($sql, $data);
    }

    /**
     * @param $id
     * @param Livro $livro
     */
    public function editarLivro($id, Livro $livro)
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
        
        $this->edit($sql, $data);
    }

    /**
     * @param $id
     */
    public function deletaLivro($id)
    {   
        $sql    = "select imagem from livros where id_livro = :ID";
        $imagem = $this->searchForId($sql, $id);
        unlink($imagem['imagem']);
        $this->delete($id);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function buscarPorId($id){
        $sql    = "select * from livros where id_livro = ?";
        return $this->searchForId($sql,$id);
    }
}