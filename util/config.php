<?php

//Mostrar erros do PHP
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Configurar essas variáveis de acordo com o seu ambiente
define("DB_HOST", "localhost"); //se estiver usando o docker, o host é o nome do serviço do banco de dados
define("DB_NAME", "Restaurante"); //tem q configurar aqui
define("DB_USER", "root");
define("DB_PASSWORD", "0909Iza"); //a senha tava errada... 

//Configuração do ambiente
define("AMB_DEV", true);
//define("AMB_DEV", false);

define("SESSAO_USUARIO_ID", "USUARIOID");
define("SESSAO_USUARIO_NOME", "USUARIONOME");

define("URL_BASE", "/RestauranteAJAX");

//Configuração para arquivos
define("DIR_ARQUIVOS", __DIR__ . "/../arquivos");
define("URL_ARQUIVOS", URL_BASE . "/arquivos");