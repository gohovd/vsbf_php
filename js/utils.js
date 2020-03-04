function toggleShort(element) {
    // TODO: Complete
    // Either retrieve full text and show in footer
    // Redirect to page for full post
}

function shorten() {
    var elements = document.getElementsByClassName("short");

    for (var i = 0; i < elements.length; i++) {
        var e = elements[i];
        var chars = elements[i].innerText;
        if (chars.length > 100) {
            e.innerText = chars.slice(0,100);
            e.innerHTML += "... <i id='les-videre' onclick='toggleShort()' style='color: white;'>Les videre</i>";
        }
    }
}

tide_url = "https://api.sehavniva.no/";
api_script = "tideapi.php";
lat = 62.6136265;
lon = 7.1290284;

interval = 60;

datatype = "obs";
lang = "nn";
tzone = 1;
place = "Vikebukt";

tide_data = null;

getTideData();
// getPlaces();

function fillHighLow(data) {
    var hl = document.getElementById("hl_row");
    var cols = hl.children;
    var first_run = true;

    for (var i = 0; i < Object.values(data).length; i++) {
        // then we know that the first index of the data is a high point
        if (Object.values(data)[i].indexOf(Math.min.apply(Math, Object.values(data))) != i && first_run ||
        (!first_run && i%2 == 0)) {
            var classname = "fa fa-angle-double-up";
            var color = "green";
        } else {
            var classname = "fa fa-angle-double-down";
            var color = "red";
        }

        first_run = false;

        var time = getPrettyTimes([Object.keys(data)[i]])[0];
        var wlevel = Object.values(data)[i];

        cols[i].querySelector("i").className = classname;
        cols[i].querySelector("i").style.color = color;
        cols[i].getElementsByClassName("hl_time")[0].innerHTML = time;
        cols[i].getElementsByClassName("hl_cm")[0].innerHTML = wlevel + " cm";
    }

    for (var i = 0; i < cols.length; i++) {
        if (cols[i].children[0].className == "") {
            cols[i].parentElement.removeChild(cols[i]);
        }
    }
}

function getPlaces() {
    var settings = {
        "url": "https://api.sehavniva.no/tideapi.php?tide_request=stationlist&type=perm",
        "method": "GET",
        "timeout": 0
    };

    $.ajax(settings).done(function(response) {
        populatePlaceSelector(parsePlaceResponse(response));
    });
}

function parsePlaceResponse(places_html) {
    var stations = places_html.querySelector("stationinfo");
    var list = [];
    for (var i = 0; i < stations.childElementCount; i++) {
        list.push(stations.children[i].getAttribute("name"));
    }
    return list;
}

function populatePlaceSelector(places_list) {
    var selector = document.getElementById("place-select");

    for (var i = 0; i < places_list.length; i++) {
        var opt = document.createElement("option");
        opt.innerHTML = places_list[i];
        selector.appendChild(opt);
    }
}

function oneDayFromToZero() {
    var dt = new Date();
    var from_month = ((dt.getMonth() + 1).toString().length == 1) ? ("0" + (dt.getMonth() + 1)) : (dt.getMonth() + 1);
    var from_day = (dt.getDate().toString().length == 1) ? ("0" + dt.getDate()) : dt.getDate();
    var hours = minutes = "00";

    var to_day = (parseInt(from_day) + 1 > 9) ? (parseInt(from_day) + 1) : ("0" + (parseInt(from_day) + 1))

    var from_time = dt.getFullYear() + "-" + from_month + "-" + from_day + "T" + hours + "%3A" + minutes;
    var to_time = dt.getFullYear() + "-" + from_month + "-" + to_day + "T" + hours + "%3A" + minutes;

    return [from_time, to_time]
}

function getTideData() {
    var datatypes = ['pre', 'tab', 'obs'];
    tide_data = {};

    for (var i = 0; i < datatypes.length; i++) {
        tide_data[datatypes[i]] = getTide(lat, lon, oneDayFromToZero()[0], oneDayFromToZero()[1], datatypes[i], lang, tzone, place, interval);
    }

}

function lineChart(map) {
    var ctx = document.getElementById('myChart').getContext('2d');
    var title = 'Vannstand - Vikebukt - ';
    title += getPrettyDate();

    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: getPrettyTimes(Object.keys(map['pre'])),
            datasets: [{
                    label: 'Prognose',
                    data: Object.values(map['pre']),
                    borderColor: 'rgba(57, 82, 170, 1)',
                    backgroundColor: 'rgba(57, 82, 170, 0.2)',
                    borderWidth: 1,
                    pointRadius: 4,
                    pointStyle: 'dot',
                    hoverRadius: 4,
                    fill: true
                },
                {
                    label: 'Observert',
                    data: Object.values(map['obs']),
                    borderColor: 'rgba(0, 255, 0, 1)',
                    backgroundColor: 'rgba(0, 255, 0, 0.2)',
                    borderWidth: 1,
                    pointRadius: 4,
                    pointBackgroundColor: 'rgba(0, 255, 0, 0.3)',
                    fill: true
                }
            ]
        },
        options: {
            title: {
                display: true,
                text: title
            }
        }
    });
}

function getPrettyTimes(dates_list) {
    pretty_dates = [];
    for (var i = 0; i < dates_list.length; i++) {
        var hms_arr = dates_list[i].split("T")[1].split(":");
        var h = hms_arr[0];
        var m = hms_arr[1];
        pretty_dates.push(h + ":" + m);
    }
    return pretty_dates;
}

function getPrettyDate(date) {
    var options = {
        weekday: 'long',
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    };
    var today = new Date();

    return today.toLocaleDateString("nb-NO", options);
}

function getTide(latitude, longitude, fromtime, totime, type, language, timezone, place, interval) {
    var getreq = "https://api.sehavniva.no/tideapi.php?lat=" + latitude + "&lon=" + longitude;
    getreq += "&fromtime=" + fromtime + "&totime=" + totime;
    getreq += "&datatype=" + type + "&refcode=cd&place=" + place + "&file&lang=" + language;
    getreq += "&interval=" + interval + "&dst=0&tzone=" + timezone + "&tide_request=locationdata";

    var settings = {
        "url": getreq,
        "method": "GET",
        "timeout": 0
    };

    $.ajax(settings).done(function(response) {
        tide_data[type] = parseResponse(response);
    });
}

function parseResponse(response) {
    var data = response.querySelector("data");
    var wl_data = {};

    for (var i = 0; i < data.childElementCount; i++) {
        var row = data.children[i];
        var time = row.getAttribute("time");
        var value = row.getAttribute("value");
        wl_data[time] = value;
    }

    return wl_data;
}