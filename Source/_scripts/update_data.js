setInterval(function () {
	var d = new Date();
	var seconds = d.getMinutes() * 60 + d.getSeconds();
	var fiveMin = 60 * 5;
	var timeleft = fiveMin - seconds % fiveMin;
	var result = parseInt(timeleft / 60) + ':' + (timeleft % 60 < 10 ? '0' : '') + timeleft % 60;
	
	document.getElementById('update_data').innerHTML = result;
	
	if(result == '0:01'){
		location.reload(true);
	}
	
}, 1000)