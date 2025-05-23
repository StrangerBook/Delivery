<?php
	define("HOST","localhost");
	define("USUARIO","root");
	define("SENHA","");
	define("NOMEBD","pizzaria");

	$conexao = new mysqli(HOST,USUARIO,SENHA,NOMEBD);
	
	if($conexao->error)
	{
		//A função die, significa que vamos matar o processo, encerrar o processo
    	die("<pre>"."Não foi possível conectar-se ao MySQL. Favor contactar o Administrador !!!!". $conexao->error);
	}
?>