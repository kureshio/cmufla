<?php
	 /* 
	  
	  Neste Script está armazenado os dados de acesso ao banco de dados da coleção zoológica.
	 
	 */
	 
	 $_SESSION['BASE'] = 'CMUFLA'; // Caso tenha mais de uma base(banco de dados) de acesso.
	 $_SESSION["server"] = "localhost"; // Nome, DNS ou IP da máquina onde está o MYSQL.
	 $_SESSION["database"] = "colecao"; // Nome da base de dados a ser conectada pelo sistema.
	 $_SESSION["user_db"] = "root"; // Nome do usuário PHP p/ movimentação no banco.
	 $_SESSION["password_db"] = "root";  //Senha do usuário informado anteriormente.
?>
