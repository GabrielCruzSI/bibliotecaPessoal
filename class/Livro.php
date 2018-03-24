<?php 

class Livro 
{   

    private $nome;
    
    private $autor;
    
    private $n_de_paginas;
    
    private $imagem;

    public function __construct()
    {
        
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function getAutor()
    {
        return $this->autor;
    }

    public function setAutor($autor)
    {
        $this->autor = $autor;
    }

    public function getN_De_Paginas()
    {
        return $this->n_de_paginas;
    }

    public function setN_De_Paginas($n_de_paginas)
    {
        $this->n_de_paginas = $n_de_paginas;
    }

    public function getImagem()
    {
        return $this->imagem;
    }

    public function setImagem($imagem)
    {
        $this->imagem = $imagem;
    }

}