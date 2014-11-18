setInterval(function () {
    var d = new Date();
	//convet 00:00 to seconds for easier caculation
    var seconds = d.getMinutes() * 60 + d.getSeconds();
	//five minutes is 300 seconds!
    var fiveMin = 60 * 5;
	// let's say 01:30, then current seconds is 90, 90%300 = 90, then 300-90 = 210. That's the time left!
    var timeleft = fiveMin - seconds % fiveMin;
	//formart seconds into 00:00 
    var result ='Next Status Update: ' + parseInt(timeleft / 60) + ':' + timeleft % 60;
	
    document.getElementById('update_data').innerHTML = result;

}, 500) //calling it every 0.5 second to do a count down// JavaScript Document