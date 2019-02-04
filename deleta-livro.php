<?php

require_once "config.php";

$dao = new LivroPersistencia();

$id = $_GET['id'];

$dao->deletaLivro($id);

header("Location: /");

?>