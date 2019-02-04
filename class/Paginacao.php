<?php

class Paginacao 
{
    private $total_de_elemetos;
    private $elementos_por_pagina;
    private $n_da_pagina;
    private $n_de_paginas;

    public function __construct($elementos_por_pagina = 6)
    {
        $dao = new LivroPersistencia();
        $sql = "SELECT COUNT(*) as 'total' FROM livros";
        $total_de_linhas = $dao->list($sql);
        $this->setTotal_De_Elementos($total_de_linhas[0]['total']);
        $this->setElementos_Por_Pagina($elementos_por_pagina);
        $this->setN_De_Paginas();
    }

    public function setElementos_Por_Pagina($elementos_por_pagina)
    {
        $this->elementos_por_pagina = $elementos_por_pagina;
    }
    
    public function getElementos_Por_Pagina()
    {
        return $this->elementos_por_pagina;
    }

    private function setTotal_De_Elementos($total_de_elementos)
    {
        $this->total_de_elementos = $total_de_elementos;
    }
    
    public function getTotal_De_Elementos()
    {
        return $this->total_de_elementos;
    }

    private function setN_De_Paginas()
    {
        $this->n_de_paginas = $this->getTotal_De_Elementos() / $this->getElementos_Por_Pagina();
    }
    
    public function getN_De_Paginas()
    {
        return $this->n_de_paginas;
    }

    public function setN_Da_Pagina($n_da_pagina)
    {   
        if (!$n_da_pagina) {
            $this->n_da_pagina = 1;
        } else {
            $this->n_da_pagina = $n_da_pagina;
        }
    }
    
    public function getN_Da_Pagina()
    {
        return $this->n_da_pagina;
    }
}