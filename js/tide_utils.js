
var TIDE_DATA = null;
var myChart = null;

// 2020-02-25 00:00
var now = new Date();
now.setHours("0");
now.setMinutes("0");
var _now = formatDate(now);

// 2020-02-26
var tomorrow = new Date();
tomorrow.setDate(now.getDate() + 1);
tomorrow.setHours("23");
tomorrow.setMinutes("59");
var _tomorrow = formatDate(tomorrow);

var params = new Map().set("tide_url", "https://api.sehavniva.no/")
                      .set("api_script", "tideapi.php")
                      .set("lat", 62.6136265)
                      .set("lon", 7.1290284)
                      .set("interval", 60)
                      .set("datatype", "obs")
                      .set("lang", "nn")
                      .set("tzone", 1)
                      .set("place", "Vikebukt")
                      .set("fromtime", _now)
                      .set("totime", _tomorrow);

getTideData();
// getPlaces(); // Fetch, parse, populate <select> with all measuring stations


// POPULATE TIDE DATA MAP
function getTideData(callback) {
    var datatypes = ['pre', 'tab', 'obs']; // fetch HTML for each API supported datatype

    if (TIDE_DATA == null) {
        TIDE_DATA = new Map();
    }

    for (var i = 0; i < datatypes.length; i++) {
        getTide(callback,
            params.get("lat"),
            params.get("lon"),
            params.get("fromtime"),
            params.get("totime"),
            datatypes[i],
            params.get("lang"),
            params.get("tzone"),
            params.get("place"),
            params.get("interval")
        );
    }

}
// GET HTML
function getTide(callback, latitude, longitude, fromtime, totime, type, language, timezone, place, interval) {
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
        TIDE_DATA.set(type, parseResponse(response));
        if (callback) {
            callback(true);
            // TODO: Add spinner?
            console.log("populating");
        }
    });
}
// PARSE HTML into MAP (key/value datetime/waterlevel in cm)
function parseResponse(response) {
    var data = response.querySelector("data");
    var waterlevel_data = {};

    if (!data) { return null; }
    for (var i = 0; i < data.childElementCount; i++) {
        var row = data.children[i];
        var time = row.getAttribute("time");
        var value = row.getAttribute("value");
        waterlevel_data[time] = value;
    }

    return waterlevel_data;
}

function changeDate(id) {
    myChart.destroy();

    if (id == "next_date_btn") {
        now.setDate(now.getDate() + 1)
        now.setHours("0");
        now.setMinutes("0");
        _now = formatDate(now);

        // 2020-02-26
        tomorrow.setDate(now.getDate() + 1);
        tomorrow.setHours("23");
        tomorrow.setMinutes("59");
        _tomorrow = formatDate(tomorrow);

        params.set("fromtime", _now);
        params.set("totime", _tomorrow);
    } else if (id == "previous_date_btn") {
        now.setDate(now.getDate() - 1)
        now.setHours("0");
        now.setMinutes("0");
        _now = formatDate(now);

        // 2020-02-26
        tomorrow.setDate(now.getDate() + 1);
        tomorrow.setHours("23");
        tomorrow.setMinutes("59");
        _tomorrow = formatDate(tomorrow);

        params.set("fromtime", _now);
        params.set("totime", _tomorrow);
    }
    getTideData(populateDiagrams);
}

function populateDiagrams(all) {
    var title = document.getElementById("title_date");
    if (all) {
        title.innerHTML = "Frå " + getPrettyDate(now) + ", ";
        title.innerHTML += "<span style='color: black;'>til " + getPrettyDate(tomorrow) + "</span>";
        lineChart(TIDE_DATA);
        fillHighLow(TIDE_DATA.get("tab"));
    } else {
        title.innerHTML = "I dag og i morgon, for Ålesund";
        fillHighLow(TIDE_DATA.get("tab"));
    }

}


function formatDate(date) {
    var mo = ((date.getMonth() + 1).toString().length == 1) ? ("0" + (date.getMonth() + 1)) : (date.getMonth() + 1);
    var d = (date.getDate().toString().length == 1) ? ("0" + date.getDate()) : date.getDate();
    var min = (date.getMinutes().toString().length == 1) ? ("0" + date.getMinutes()) : date.getMinutes();
    var hr = (date.getHours().toString().length == 1) ? ("0" + date.getHours()) : date.getHours();
    var datetime = date.getFullYear() + "-" + mo + "-" + d + "T" + hr + "%3A" + min;
    return datetime;
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

// FILL 1 x 4 TABLE WITH HIGH TIDE AND LOW TIDE
function fillHighLow(data) {
    var hl = document.getElementById("hl_row");
    var cols = hl.children;

    for (var i = 0; i < cols.length; i++) {
        if (parseInt(Object.values(data)[i]) > parseInt(Object.values(data)[i+1])) {
            var classname = "fa fa-angle-double-up";
            var color = "lightgreen";
        } else {
            var classname = "fa fa-angle-double-down";
            var color = "red";
        }

        var time = getPrettyTimes([Object.keys(data)[i]])[0];
        var wlevel = Object.values(data)[i];

        cols[i].querySelector("i").className = classname;
        cols[i].querySelector("i").style.color = color;
        cols[i].getElementsByClassName("hl_time")[0].innerHTML = time;
        cols[i].getElementsByClassName("hl_cm")[0].innerHTML = wlevel + " cm";
    }

    // for (var i = 0; i < cols.length; i++) {
    //     if (cols[i].children[0].className == "") {
    //         cols[i].parentElement.removeChild(cols[i]);
    //     }
    // }
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

function lineChart(map) {
    var ctx = document.getElementById('myChart').getContext('2d');
    var title = 'Vannstand - Vikebukt - ';
    title += getPrettyDate(now);
    title += " til " + getPrettyDate(tomorrow);

    myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: getPrettyTimes(Object.keys(map.get('pre')))
        },
        options: {
            title: {
                display: true,
                text: title
            }
        }
    });

    if(map.get('pre') != null && Object.values(map.get('pre') != null)) {
        var prognose_data = {
            label: 'Prognose',
            data: Object.values(map.get('pre')),
            borderColor: 'rgba(57, 82, 170, 1)',
            backgroundColor: 'rgba(57, 82, 170, 0.2)',
            borderWidth: 1,
            pointRadius: 4,
            pointStyle: 'dot',
            hoverRadius: 4,
            fill: true
        };
        
        addData(myChart, prognose_data);

    }
    if (map.get('obs') != null && Object.values(map.get('obs') != null)) {
        var observert_data = {
            label: 'Observert',
            data: Object.values(map.get('obs')),
            borderColor: 'rgba(0, 255, 0, 1)',
            backgroundColor: 'rgba(0, 255, 0, 0.2)',
            borderWidth: 1,
            pointRadius: 4,
            pointBackgroundColor: 'rgba(0, 255, 0, 0.3)',
            fill: true
        };
        addData(myChart, observert_data);
    }
}

function addData(chart, data, labels) {
    chart.data.datasets.push(data);
    chart.update();
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

    return date.toLocaleDateString("nb-NO", options);
}