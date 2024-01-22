window.setTimeout(time, 1000);

function time() {
    var currentTime = new Date();
    var options = { timeZone: "Asia/Makassar" };
    currentTime.toLocaleString("en-US", options);
    setTimeout(time, 1000);

    var hours = currentTime.getHours();

    var ampm = hours >= 12 ? "WITA" : "WITA";
    hours = hours % 12;
    hours = hours ? hours : 12;

    document.getElementById("time").innerHTML = currentTime.getDate().toString().padStart(2, '0') + ' ' + getMonth(currentTime.getMonth()) + ' ' + currentTime.getFullYear() + ' ' + hours.toString().padStart(2, '0') + ':' + currentTime.getMinutes().toString().padStart(2, '0') + ':' + currentTime.getSeconds().toString().padStart(2, '0') + ' ' + ampm;
}

function getDay(dayNumber) {
    var daysOfWeek = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
    return daysOfWeek[dayNumber];
}

function getMonth(monthNumber) {
    var monthsOfYear = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    return monthsOfYear[monthNumber];
}
