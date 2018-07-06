var socket = io.connect('http://localhost:8000/',{'forceNew' : true});
socket.on('setPuntuacionCliente', function (data) {
    renderScore(data);
    console.log(data);
});
socket.on('setComentarios',function(data){
    console.log(data);
    renderComent(data);
})
function renderScore(data){
    if(data==null){
        data = 'Sin puntuacion :('
    }
    var html = `<h5>Promedio de los usuarios: <span class="label label-default">${data.toString()}</span> </h5>`;
    document.getElementById('promUser').innerHTML = html;
}
function renderComent(data) {
    if(data.length == 0){
        var html = `<div class="panel panel-danger">
                        <div class="panel-heading">Administrador</div>
                        <div class="panel-body">No hay comentarios</div>
                    </div>`
    }
    else{
        var html = data.map(function(data,index){
            return(`<div class="panel panel-success">
                    <div class="panel-heading">${data.autor}</div>
                    <div class="panel-body">${data.comentario}</div>
                    </div>`
                );
        }).join(" ");
    }
    document.getElementById('listaComentario').innerHTML = html;
}
function addScore(e){
    var payload = {
        score : document.getElementById('insertPunt').value,
        id : arrayObjetos[contObjetos].id
    };
    socket.emit('newScore',payload);
    socket.emit('findMovie',payload);
    return false;
}
function viewMovie(e){
    var payload = {
        id : arrayObjetos[contObjetos].id
    };
    socket.emit('findMovie',payload);
    return false;
}
function addComent(e){
    var payload = {
        id: arrayObjetos[contObjetos].id,
        autor: document.getElementById('username').value,
        comentario: document.getElementById('comentario').value
    };
    socket.emit('sendText',payload);
    return false;
}