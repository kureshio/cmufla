<?php
	
	/* -->>>
	 Script que contém as funções que interagem com o Banco de Dados, tais como: conexão, seleção e fechamento.
	  <<<--*/
	function open_database(){
		
	  $conexao =mysqli_connect($_SESSION["server"],$_SESSION["user_db"], $_SESSION["password_db"]); 
		$_SESSION["dbh"] = mysqli_select_db($conexao, $_SESSION["database"]) or die (mysqli_error());
        //estabelece conexão com Banca de Dados e o seleciona, através do uso de variáveis superglobais...
        
    if ($conexao){
            $GLOBALS['idcon'] = $conexao;
            return $conexao;
        //verifica se a conexão foi estabelicida, recolhe seu id e a retorna...
		}
	}
	function execute_query($sql, $id_conn){
			
		if(!$id_conn) 
			$id_conn = open_database(); //verifica se a conexão é válida, caso não seja, a estabelece novamente...
	
    	$sql = str_replace("\"", '`', $sql);
    	$sql = str_replace("'", '"', $sql);
    	$query = mysqli_query($id_conn, $sql);
		return $query;
	}

    /*
    * Function retirada do site PHP.net
    */
    function insere_dados($tabela, $inserts,$id_conn) {
        $values = array_map('mysql_real_escape_string', array_values($inserts));
        $keys = array_keys($inserts);
        return mysql_query('INSERT INTO '.$tabela.' ('.implode(',', $keys).') VALUES (\''.implode('\',\'', $values).'\')',$id_conn);
    }

    function altera_dados($tabela, $campos,$quem,$id_conn) {
        return mysql_query("UPDATE ".$tabela." set ".implode(',', $campos)." where ".$quem,$id_conn);
    }

	function close_database($id_conn){
    	mysqli_close($id_conn);		
	}
	function fetch_array($result){
		return  mysqli_fetch_array($result);
	}
	function fetch_row($result){
		return  mysqli_fetch_row($result);
	}
	function num_rows($result){
		return mysqli_num_rows($result);
	}
	function data_seek($result, $row_number){
		return mysqli_data_seek($result, $row_number);
	}
	function data_id($id_conn){
		return mysqli_insert_id($id_conn);
	}
?>
