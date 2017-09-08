
function abrir_detalhe(x,y) {
    "use strict";
    var myWindow = window.open("detalhe.php?id="+x+"&sexo="+y, "", "width=500, height=500");
}

$(function() {

	'use strict';

	var codigo, valor, i, html;

	$('form[name=form_busca_colecao]').submit(function() {

		codigo	=	$('select[name=cmb_opcoes]').val();
		valor	=	$('input[name=txt_busca]').val();

	 	$.getJSON('../scripts/colecao.php', {cod: codigo, valor: valor}, function(r) {

	 		

	 		if (r[0].id == '0') {

	 			window.alert(r[0].msg);

	 		} else {



				html	=	'<table style=\'width: 70%;\' class=\'tabela\'>';
				html	+=	'<thead>';
				html	+=	'<tr>';
				html	+=	'<th>QTD</th>';
				html	+=	'<th>Tombo</th>';
				html	+=	'<th>Família</th>';
				html	+=	'<th>Espécie</th>';
				html	+=	'<th>Detalhes</th>';
				html	+=	'</tr>';
				html	+=	'</thead>';
				html	+=	'<tbody>';

				for ( i=0; i< r.length; i++ ) {

					html	+= "<tr>";
					html	+= "<td><center>" + (i+1) + "</center></td>";
					html	+= "<td>" + r[i].tombo + "</td>";
					html	+= "<td>" + r[i].familia + "</td>";
					html	+= "<td>" + r[i].especie + "</td>";
          html  += "<td><i class=\"fa fa-folder-open\" aria-hidden=\"true\"></i></td>"
					/*html	+= "<td><center><img src=\"../images/folder_open.png\" onclick=\"abrir_detalhe(" +r[i].id+ ",'" + r[i].sexo + "')\" class='pointer' /></center></td>"; */
					html	+= "</tr>";

				}

				html	+=	'</tbody>';
				html	+=	'</table>';

				$(".tabela").remove();
				$( ".resultado" ).append( html );
			}
	 	});

	return false;

	});
});
