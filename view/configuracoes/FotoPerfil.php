<?php
//verifica se existe imagem de perfil cadastrada no banco
//se nao existir ele carrega a default
if (file_exists($_SERVER['DOCUMENT_ROOT']."/crud_php/imagensBanco/{$_SESSION['login']}/perfil.jpg"))
{
    echo '<img src="/crud_php/imagensBanco/'.$_SESSION['login'].'/perfil.jpg"
             alt="fotoPerfil" class="imgPerfil">';
}
else
{
    echo '<img src="/crud_php/imagensBanco/default/perfil.jpg"
             alt="fotoPerfil" class="imgPerfil">';
}


