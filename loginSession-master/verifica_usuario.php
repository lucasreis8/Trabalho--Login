<?php

session_start(); //cria variavel quando ela não existe


function login(){

    $login = $_POST['login'];
    $senha = $_POST['senha'];

    $usuarios = file_get_contents('usuarios.json');
    $usuarios = json_decode($usuarios, true);

    $usuario_existe = false;

    foreach ($usuarios as $usuario) { //percorre cada usuario

        if ($login == $usuario['usuario'] && $senha == $usuario['senha']) {
            //deu certo

            $usuario_existe = true;

            $_SESSION['usuario_nome'] = $_POST['nome']; //session - informações que poderão ser reutilizadas- dura enquanto o navegador estiver aberto
            $_SESSION['usuario_login'] = $login;
            $_SESSION['usuario_senha'] = $senha;
            $_SESSION['usuario_online'] = true;

            //redirecionar
            header('Location: index.php');


        }

    }
} function logout(){

    session_destroy();
    header("location: login.php");
}

//rotas

if($_GET['acao']=='login'){

    login();
}
if ($_GET['acao']=='sair'){

    logout();
}
