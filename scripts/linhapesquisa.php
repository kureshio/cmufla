<?php
 // ini_set('display_errors', 1);
 // ini_set('display_startup_errors', 1);
 // error_reporting(E_ALL);

  header('Content-type: text/json');

  require "../configuracao/infodbcon.php";

  require "../configuracao/database.php";

  $id_conn = open_database();

 
    switch($_GET['opcao']) {
    
        case 'linha':
        
            $sql_linha= "SELECT";
            $sql_linha.= " linhapesquisa_id, linhapesquisa_nome";
            $sql_linha.= " FROM";
            $sql_linha.= " tb_linhapesquisa";
            $sql_linha.= " WHERE";
            $sql_linha.= " linhapesquisa_ativo = '1' ";
            $sql_linha.= 'ORDER BY linhapesquisa_nome'; 
          
            $retorno_dados_array = execute_query($sql_linha,$id_conn);

            while ( $rows = fetch_array($retorno_dados_array) ) {
            
                $retorno[] = array(
                    'id'    =>  $rows[0],
                    'nome'  =>  utf8_encode($rows[1]),
                );
            }
        
        break;     
        case 'projeto';
        
            $sql    =   'SELECT ';
            $sql    .=  'projeto_nome, projeto_info ';
            $sql    .=  'FROM ';
            $sql    .=  'tb_projeto ';
            $sql    .=  'INNER JOIN tb_linhapesquisaquaisprojetos ON ';
            $sql    .=  '(tb_linhapesquisaquaisprojetos.projeto_id = tb_projeto.projeto_id) ';
            $sql    .=  'WHERE ';
            $sql    .=  'tb_linhapesquisaquaisprojetos.linhapesquisa_id='.$_GET['pesquisa'].' ';
            $sql    .=  'AND ';
            $sql    .=  'tb_projeto.projeto_ativo = \'1\'';
                 
            $retorno_dados_array = execute_query($sql,$id_conn);

            if ( num_rows($retorno_dados_array) > 0) {    
            
                while ( $rows = fetch_array($retorno_dados_array) ) {

                    $retorno[] = array(
                        'id'    =>  '1',
                        'nome'  =>  $rows[0],
                        'info'  =>  $rows[1],
                    );
                }
            } else {
                
             $retorno[] = array('id' => '0');   
            }
        
        break;
          
    }

    close_database($id_conn);

    echo json_encode($retorno);

?>
