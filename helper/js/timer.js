function checkTime(i) {
	if (i < 10) i = "0" + i;

	return i;
}

var days = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
var today, day, month, h, m, s;

function startTime() {
	today = new Date();
	day = days[today.getDay()];
	dayOfMonth = today.getDate();
	month = months[today.getMonth()];
	year = today.getFullYear();
	h = today.getHours();
	m = today.getMinutes();
	s = today.getSeconds();
	// add a zero in front of numbers<10
	m = checkTime(m);
	s = checkTime(s);
	// document.getElementById('time').innerHTML = day + ", " + h + ":" + m + ":" + s;
	document.getElementById("time").innerHTML = `${day} ${dayOfMonth} ${month}, ${h}:${m}:${s}`;
}
startTime();

setInterval(function () {
	startTime();
}, 500);
