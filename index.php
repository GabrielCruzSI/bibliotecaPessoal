<?php 

require_once "config.php";

$dao       = new LivroPersistencia();
$paginacao = new Paginacao();

try {

    $numero_pagina = isset($_POST['pagina'])  ? $_POST['pagina'] : 1;
    $paginacao->setN_Da_Pagina($numero_pagina);

    $livros = $dao::listagemLivros($paginacao->getElementos_Por_Pagina(), $paginacao->getN_Da_Pagina());
} catch (Exception $e) {
    throw new Exception('Erro no carregamento da paginação!');
}
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
          <a class="nav-item nav-link active" href="/">Home <span class="sr-only">(current)</span></a>
        </div>
      </div>
    </nav>

    <main role="main" class="container">
      
      <div class="row">
          <h3 class="display-5">Minha Bilioteca</h3>
          <br>
          <!-- <p class="lead-3">Com a "Minha Biblioteca" você pode cadastrar, editar, excluir e listar seus livros pessoais.</p> -->
      </div>
      <div class="row">
        <div class="form-group">
          
        </div>
      </div>
      <div class="row">
        <table class="table" >
          <thead>
            <tr>
              <th>Livro</th>
              <th>Nome</th>
              <th>Autor</th>
              <th>N° de Páginas</th>
              <th><a href="novo-livro.html" class="btn btn-success"><i class="fas fa-plus"></i></a></th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($livros as $livro):?>
              <tr>
                <td><img width='30' src="<?php echo $livro['imagem'] ?>" alt=""></td>
                <td><?php echo $livro['nome'] ?></td>
                <td><?php echo $livro['autor'] ?></td>
                <td><?php echo $livro['n_de_paginas'] ?></td>
                <td>
                  <a href="edita-livros.php?id=<?php echo $livro['id_livro'] ?>" class='btn btn-info'>
                    <i class="fas fa-edit"></i>
                  </a>

                  <a href="deleta-livro.php?id=<?php echo $livro['id_livro'] ?>" class='btn btn-danger ml-1'>
                    <i class="fas fa-trash"></i>
                  </a>
                </td>
              </tr>
            <?php endforeach;?>
          </tbody>
        </table>
      </div>
      <footer class="fixed-bottom">
        <div class="row align-items-center justify-content-center">
          <?php for($i = 0; $i < $paginacao->getN_De_Paginas(); $i++): ?>
            <form action="/" method="POST">
              <input type="hidden" name="pagina" value="<?php echo $i + 1?>" />
              <button type="submit" class="btn <?php if(($i + 1) == $paginacao->getN_Da_Pagina()){ echo "btn-selected"; } else { echo "btn-primary";} ?> btn-xs ml-1">
                  <?php echo $i + 1; ?>
              </button>
            </form>            
          <?php endfor; ?>
        </div>
      </footer>
  </main>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="js/script.js"></script>    
</body>
</html>