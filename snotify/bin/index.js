var express	=	require('express');
var app		=	express();
var path	=	require("path");
//var mysql	=	require("mysql");
var http	=	require('http').Server(app);
//var io = require('socket.io').listen(server);
var io		=	require('socket.io')(http);
var router	=	express.Router();

/* Creating POOL MySQL connection.*/

/*var pool    =    mysql.createPool({
      connectionLimit   :   200,
      host              :   'localhost:8080',
      user              :   'root',
      password          :   'a5qE9iXUFkg0wKL',
      database          :   'socketDemo',
      debug             :   false
});*/

router.get('/',function(req,res){
	res.sendFile(__dirname + '/index.html');
});

/*router.get('/getStatus',function(req,res){
	pool.getConnection(function(err,connection){
		if(err) {
			connection.release();
			return res.json({"error" : true,"message" : "Error in database."});
		} else {
			var sqlQuery = "SELECT * FROM ??";
			var inserts = ["UserPost"];
			sqlQuery = mysql.format(sqlQuery,inserts);
			connection.query(sqlQuery,function(err,rows){ console.log(rows);
				connection.release();
				if(err) {
					return res.json({"error" : true,"message" : "Error in database."});
				} else {
					res.json({"error" : false,"message" : rows}); 
				}
			});
		}
		connection.on('error', function(err) {
			return res.json({"error" : true,"message" : "Error in database."});
        });
	});
});*/

app.use('/',router);
var i=1;
io.on('connection',function(socket){
	console.log('We have user connected !-'+i);
	 socket.on('disconnect', function(){
    console.log('user disconnected');
  });
	socket.on('comment added',function(data){
		console.log(data.usertext);
		 //io.emit("notify everyone",{user : data.usertext});
		  socket.broadcast.emit('notifyeveryone',{user : data.usertext,id:data.sheetid});
	});
	i++;
});



http.listen(8080,function(){
    console.log("Listening on 6000");
});
