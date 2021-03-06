<?php

require_once "config.php";

$id = $_GET['id'];

$dao = new LivroPersistencia();

$res = $dao->buscarPorId($id);

?>
<html lang="pt-br">
    <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  
      <!-- Font Awsome CSS -->
      <link href="https://use.fontawesome.com/releases/v5.0.8/css/all.css" rel="stylesheet"> 
      
       <!-- Style CSS -->
       <link href="css/style.css" rel="stylesheet">
      
      <title>Minha Biblioteca</title>
    </head>
    <body>
      
      <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav">
            <a class="nav-item nav-link active" href="index.php">Home <span class="sr-only">(current)</span></a>
          </div>
        </div>
      </nav>
      
      <main role="" class="container">
        <form action="edita-livro.php" method="post" enctype="multipart/form-data" class="form">
          <div class="col-md-6 col-xs-6 float-md-left">
                  <input type="hidden" name='id_livro' value="<?php echo $res['id_livro']; ?>">
                  
                  <div class="form-group">
                      <label class="label" for="">Nome</label>
                      <input class="form-control" type="text" name="nome" value="<?php echo $res['nome']; ?>">
                  </div>
          
                  <div class="form-group">
                      <label class="label" for="">Autor</label>
                      <input class="form-control" type="text" name="autor" value="<?php echo $res['autor']; ?>">
                  </div>
          
                  <div class="form-group">
                      <label class="label" for="">Nº de Páginas</label>
                      <input class="form-control" type="number" min="1" name="n_de_paginas" value="<?php echo $res['n_de_paginas']; ?>">
                  </div>
  
                  <div class="form-group">
                      <label class="label" for="">Imagem</label>
                      <input class="form-control" type="file" name="imagem" selected value="<?php echo $res['imagem']; ?>">
                  </div>
                  <div class="form-group">
                      <button class="btn btn-block btn-success" type="submit"><i class="fas fa-save"></i><span class="ml-1">Salvar</span> </button>
                  </div>
          </div> 
          
          <div class="col-md-6 float-md-left">
              <img class="img-fluid" src="<?php echo $res['imagem']; ?>" alt="">
          </div>
  
        </form>
      </main>   
  
  
      <!-- Optional JavaScript -->
      <!-- jQuery first, then Popper.js, then Bootstrap JS -->
      <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
    </body>
  </html>