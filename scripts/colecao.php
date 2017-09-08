<?php
  header('content-type: text/json');
  include "../configuracao/infodbcon.php";
  include "../configuracao/database.php";
  $id_conn = open_database();
  $retorno = array();
  $sql_1= "select tb_cmufla.cmufla_id, tb_cmufla.cmufla_numero, tb_familia.familia_nome, 
  tb_especie.especie_nome_genero, tb_especie.especie_nome_epiteto, tb_cmufla.cmufla_sexo
  from tb_cmufla
  inner join tb_especie ON (tb_cmufla.especie_id = tb_especie.especie_id)
  inner join tb_generoquaisespecies ON (tb_especie.especie_id = tb_generoquaisespecies.especie_id)
  inner join tb_genero ON (tb_generoquaisespecies.genero_id = tb_genero.genero_id)
  inner join tb_familiaquaisgeneros ON (tb_genero.genero_id = tb_familiaquaisgeneros.genero_id)
  inner join tb_familia ON (tb_familiaquaisgeneros.familia_id = tb_familia.familia_id)";

  if( $_GET["cod"] == "1") {
    $busca_taxon = execute_query($sql_1." where upper(tb_familia.familia_nome) like'%".strtoupper($_GET["valor"])."%'and familia_ativo='1'",$id_conn);
  }
  else if ($_GET["cod"] == "2" ) {
    $busca_taxon = execute_query($sql_1." where upper(tb_genero.genero_nome) like'%".strtoupper($_GET["valor"])."%' and genero_ativo='1'",$id_conn);
  }
  else {
    $busca_taxon = execute_query($sql_1. " where concat_ws(' ', especie_nome_genero, especie_nome_epiteto) like '%".$_GET["valor"]."%' and especie_ativo='1'",$id_conn);
  }
	$cont = num_rows($busca_taxon);	
	close_database($id_conn);

	if ($cont > 0) {
	
		while ($linhas = fetch_array($busca_taxon)) {

			$retorno[] = array(
				'id' => $linhas[0],
				'tombo' => utf8_encode($linhas[1]),
			 	'familia' => utf8_encode($linhas[2]),
			 	'especie' => $linhas[3].' '.$linhas[4],
			 	'sexo' => $linhas[5],
			 );

		}		

	} else {

		$retorno[] = array('id' => '0', 'msg' => 'Não foi encontrado nenhum registro.');

	}
	echo json_encode($retorno);

	exit(0);
?>
