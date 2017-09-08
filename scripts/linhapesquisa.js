$(document).ready(function() {

  'use strict';

  var html, i, j, nome;
    
  $.getJSON('../scripts/linhapesquisa.php', {opcao: 'linha'}, function(r) {

        for ( i = 0; i < r.length; i++ ) {
        
            nome = r[i].nome;
            
            (function (nome) {
                
                $.getJSON('../scripts/linhapesquisa.php', 
                          {opcao: 'projeto', pesquisa: r[i].id}, 
                          function(retorno) {
                
                    html='';
                    
                    if ( retorno[0].id == '0' ) {
                    
                        html += '<blockquote class=\'ml-3\'>Não há projeto para essa linha de pesquisa</p></blockquote>';
                    
                    } else {
                        
                        for ( j = 0; j < retorno.length; j++ ) {
                          html+='<h6><i class=\'fa fa-file-text text-info\' aria-hidden=\'true\'></i>&nbsp;'+retorno[j].nome+'</h6>';
                          html+='<blockquote class=\'justify ml-3\'>'+retorno[j].info+'</blockquote>';
                        }
                    
                    }

                    $("#dados").append('<section>');
                    $("#dados").append('<h5><i class=\'fa fa-plus-square text-warning\' aria-hidden=\'true\'></i>&nbsp;'+nome+'</h5><br>');
                    $("#dados").append(html);
                    $("#dados").append('</section>');
                    
                    //$("#dados").append('<section><h3>'+nome+'</h3><ul class="list arrow">'+html+'</ul></section>');
                });
            
            }(nome));
        }
        
        
    });
    
    
});
