<?php
session_start();
if (empty($_SESSION['login']) || $_SESSION['login'] != true || $_SESSION['login'] == null) {
    //nao tem niguem logado voltar para pagina de login
    header("Location: /crud_php/view/Login.php?erroUrl=1");
    exit();
}
?>