var express = require('express');
var app		= express();
var path	= require("path");
var mysql	= require("mysql");
var http	= require('http').Server(app);
var io		= require('socket.io')(http);
var router	= express.Router();

/* Creating POOL MySQL connection.*/

var pool    =    mysql.createPool({
      connectionLimit   :   100,
      host              :   'localhost',
      user              :   'root',
      password          :   'a5qE9iXUFkg0wKL',
      database          :   'socketDemo',
      debug             :   false
});


var db      = require("./db");
var routes  = require("../Routes/")(router,mysql,pool);

app.use('/',router);

http.listen(8080,function(){
    console.log("Listening on 8000");
});
var i=1;
io.on('connection',function(socket){
	console.log('We have user connectedee !-'+i);
	socket.on('comment added',function(data){
		db.addComment(data.user,data.comment,mysql,pool,function(error,result){
			if (error) {
				io.emit('error');
			} else {
                socket.broadcast.emit("notify everyone",{user : data.user,comment : data.comment});
                io.sockets.emit("notify everyone",{user : data.user,comment : data.comment});
			}
		});
	});
	i++;
});
