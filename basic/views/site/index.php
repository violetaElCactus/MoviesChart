<?php

/* @var $this yii\web\View */
use yii\helpers\Html;

$this->title = 'MoviesChart';
?>
<head>
    <meta charset="utf-8">
    <title>MoviesChart</title>
    <link rel="stylesheet" href="/public/css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="/socket.io/socket.io.js"></script>

</head>
<body>
    <!--Barra de navegación de la página-->
    <!--Primer contenedor, donde estarán las películas mejor rankeadas-->
    <div class="container text-center">
        <h3>MOVIESCHART</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut massa mauris, scelerisque ut ornare in, finibus nec tortor. Integer in imperdiet odio. Interdum et malesuada fames ac ante ipsum primis in faucibus. Praesent in magna viverra, accumsan nulla euismod, tincidunt libero. Fusce lobortis, lacus et euismod malesuada, augue arcu semper nisl, eu dictum felis augue non felis. Praesent suscipit, libero molestie sollicitudin dapibus, justo ex faucibus nulla, in ornare lacus. </p>
        <div id="topPeliculas" class="row">
            <div class="col-sm-4">
                <div class="card cartel" style="width: 400px">
                    <img class="card-img-top img-cartel" src="../public/img/G2.jpg" alt="Card image">
                    <div class="card-body">
                        <h4 class="card-title">Genshiken 2</h4>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card cartel" style="width: 400px">
                    <img class="card-img-top img-cartel" src="../public/img/JG.png" alt="Card image">
                    <div class="card-body">
                        <h4 class="card-title">Joker Game</h4>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card cartel" style="width: 400px">
                    <img class="card-img-top img-cartel" src="../public/img/MB.jpg" alt="Card image">
                    <div class="card-body">
                        <h4 class="card-title">Magelobox</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Sección donde están el resto de estrenos-->
    <div class="bg-1">
        <div id="contenedorSeries" class="container text-center">
        </div>
    </div>
    <!--Ventana con los detalles de la película-->
    <div class="modal fade" id="infoPelicula" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!--Cabecera de ventana emergente-->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 id="tituloPelicula"></h4>
                </div>
                <!--Cuerpo de ventana emergente-->
                <div class="modal-body">
                    <div class="row detalles-contenido">
                        <div class="col-sm-4">
                            <img id="imagenModal" src="public/img/MB.jpg" alt="MG">
                        </div>
                        <div class="col-sm-4">
                            <h2>Sinopsis</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean tincidunt diam tortor, nec sollicitudin nunc imperdiet at. Maecenas at libero quis dolor aliquet tempor sit amet a enim. Mauris a faucibus velit, quis ornare arcu. Nam posuere, sapien scelerisque dapibus interdum, nisi ligula ultrices urna, eget laoreet felis elit aliquam. </p>
                        </div>
                        <div class="col-sm-4">
                            <h2>Información</h2>
                            <ul class="list-group">
                                <li class="list-group-item" id="promUser"></li>
                                <li class="list-group-item">
                                <form onsubmit="return addScore(this)">
                                    <select class="form-control" id="insertPunt" style="margin-bottom: 8px">
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                    </select>
                                    <button type="submit" class="btn btn-success btn-block">Envía puntuación</button>
                                </form>
                                <li class="list-group-item"> <button id="verTrailer" type="button" class="btn btn-secundary btn-block">Ver trailer</button></li>
                                <li class="list-group-item"> <button id="verComentarios" type="button" class="btn btn-info btn-block">Agregar comentario</button></li>
                            </ul>
                        </div>
                    </div>
                    <!--Contenedor del trailer-->
                    <div id="contenedorTrailer" class="well text-center">
                            <iframe id="trailer" width="560" height="315" src="https://www.youtube.com/embed/-j8sX95vkfc?rel=0&amp;showinfo=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                    </div>
                    <!--Contenedor de comentarios-->
                    <div id="contenedorComentarios" class="well">
                        <form onsubmit="return addComent(this)">
                            <label for="usr">Nombre:</label>
                            <input class="form-control" type="text" id="username">
                            <label for="usr">Comentario:</label>
                            <textarea textarea class="form-control" id="comentario" rows="3" style="margin-bottom: 7px"></textarea>
                            <button type="submit" class="btn btn-success btn-block">Envía comentario</button>
                        </form>
                        <div id="listaComentario" style="margin-top: 20px">
                        </div>
                    </div>
            </div>
        </div>
        <!--Cierre de ventana emergente-->
    </div>
</body>
<?php
$miJavascript = <<< JS
 
	var script = document.createElement('script');
	var contObjetos = 0;
	var arrayObjetos;
	script.src = 'https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js';
	script.type = 'text/javascript';
	document.getElementsByTagName('head')[0].appendChild(script);
	$(document).ready(function () {
		//Aquí viene lo chido
		console.log(";D")
		$.ajax(
			{   url:'../public/js/series.json',
				mimeType: "application/json",
				success: function(objetos) {
					console.log(objetos);
					arrayObjetos = objetos;
					/** Agrega los elementos en la página**/
					for(contObjetos=0;contObjetos <objetos.length;contObjetos++){
						if(contObjetos===0 || contObjetos%3===0)
						{   $("#contenedorSeries").append('<div class="row text-center">');
						}
						$("#contenedorSeries").append('<div class="col-sm-4"><div class="thumbnail"><img class="img-cartel" src="../public/img/'+objetos[contObjetos].imagen+'"><p><strong>'+objetos[contObjetos].nombre+'</strong></p><p>Estreno DD/MM/AA</p><form onsubmit="return viewMovie(this)"><button type=submit id="verMas" class="btn" data-toggle="modal" data-target="#infoPelicula" value="' + objetos[contObjetos].id +'" >Ver más</button></form></div></div>');
						if(contObjetos===0 || contObjetos%3===0)
						{
							$("#contenedorSeries").append('</div>');
						}
					}
				}
			}
		)
		$("#contenedorTrailer").hide();
		$("#verTrailer").click(function() {
			$("#contenedorTrailer").fadeToggle(200);
		});
		$("#contenedorComentarios").hide();
		$("#verComentarios").click(function() {
			$("#username").val('');
			$("#comentario").val('');
			$("#contenedorComentarios").fadeToggle(200);
		});

	})
	$(document).on("click","#verMas",function() {
		var key = $(this).attr('value');
		for(contObjetos=0;contObjetos < arrayObjetos.length;contObjetos++){
			if(arrayObjetos[contObjetos].id == key){
				var indice = contObjetos;
				contObjetos = arrayObjetos.length;
			}
		}
		contObjetos = indice;
		console.log(arrayObjetos[indice]);
		$("#tituloPelicula").html('<p>'+arrayObjetos[indice].nombre+'</p>');
		$("#imagenModal").attr("src","img/"+arrayObjetos[indice].imagen);
		$("#trailer").attr("src",arrayObjetos[indice].trailer+"?rel=0&amp;showinfo=0");
	});

        
JS;
$this->registerJs($miJavascript, $this::POS_READY);
?>
<?php
$miJavascript2 = <<< JS
	var socket = io.connect('http://localhost:8000/',{'forceNew' : true});
	socket.on('setPuntuacionCliente', function (data) {
		renderScore(data);
		console.log(data);
	});
	function viewMovie(e){
		var payload = {
			id : arrayObjetos[contObjetos].id
		};
		socket.emit('findMovie',payload);
		return false;
	}
JS;
$this->registerJs($miJavascript2, $this::POS_READY);
?>