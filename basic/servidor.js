var express = require('express');
var path = require('path');
var app = express();
var server = require('http').Server(app);
var io = require('socket.io')(server);
var MongoClient = require('mongodb').MongoClient,
    co = require('co'),
    assert = require('assert');
var promedio = 0.0;
app.use(express.static('public'));
app.get('/',function(req,res) {
    res.sendFile('index.html',{root: path.join(__dirname,'./public')});
});

function insertarPelicula(id,score) {
    co( function* (){
        var db = yield MongoClient.connect('mongodb://localhost:27017/moviesDB');
        var r = yield db.collection('coleccion_moviesChart/puntuacion').insertOne({id: id, puntuacion: score});
        assert.equal(1, r.insertedCount);
        db.close();
    }).catch(function (err){
        console.log(err.stack);
    });
}

function insertarComentario(id,autor,comentario) {
    co( function* (){
        var db = yield MongoClient.connect('mongodb://localhost:27017/moviesDB');
        var r = yield db.collection('coleccion_moviesChart/comentario').insertOne({id: id, autor: autor, comentario: comentario});
        assert.equal(1, r.insertedCount);
        db.close();
    }).catch(function (err){
        console.log(err.stack);
    });
}

function leerSerie(ident,socket) {
    co( function* () {
        var db = yield MongoClient.connect('mongodb://localhost:27017/moviesDB');
        var col = db.collection('coleccion_moviesChart/puntuacion');
        var doc = yield col.find({"id": ident}).toArray();
        calcularPromedio(doc);
        db.close()
        socket.emit('setPuntuacionCliente',promedio);
    })
}

function leerComentario(ident,socket) {
    co( function* () {
        var db = yield MongoClient.connect('mongodb://localhost:27017/moviesDB');
        var col = db.collection('coleccion_moviesChart/comentario');
        var doc = yield col.find({"id": ident}).toArray();
        db.close()
        socket.emit('setComentarios',doc);
    })
}

function calcularPromedio(data){
    promedio = 0.0;
    for(var j=0; j < data.length;j++){
        promedio = promedio + parseFloat(data[j].puntuacion);
    }
    promedio/=j;
}
io.on('connection',function(socket) {
    console.log("Hay intrusos");
    socket.on('newScore',function(data){
        insertarPelicula(data.id,data.score);
    });
    socket.on('findMovie',function(data){
        leerSerie(data.id,socket)
        leerComentario(data.id,socket);
    });
    socket.on('sendText',function(data){
        insertarComentario(data.id,data.autor,data.comentario);
        console.log(data);
    })
});

server.listen(8000,function(){
    console.log("Corriendo");
});