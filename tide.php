<?php $title = 'TIDEVANN'; ?>
<?php $currentPage = 'TIDEVANN'; ?>

<?php include('./head.php'); ?>
<?php include('./nav-bar.php'); ?>

<style>
    .moon,
    .settings,
    .hl {
        margin-bottom: 15px;

        color: black;

        background-color: rgba(255, 255, 255, 0.1);

        border: 1px solid transparent;
        border-radius: 5px;

        /* -webkit-box-shadow: 0px 1px 5px 0px rgba(0, 0, 0, 0.2);
        -moz-box-shadow: 0px 1px 5px 0px rgba(0, 0, 0, 0.2);
        box-shadow: 0px 1px 5px 0px rgba(0, 0, 0, 0.2); */
    }

    .chart-container {
        margin-top: 20px;
        margin-bottom: 20px;
    }

    .moon {}

    .settings {}

    .hl {
        position: relative;
        left: 50%;
        transform: translateX(-50%);
        width: 90%;
        text-align: center;
        margin-top: 30px;
        margin-bottom: 30px;
    }

    .hl_time {
        font-size: 2em;
    }

    #tide-form input:hover {
        border-bottom: 1px solid lightgrey;
        cursor: pointer;
    }

    @media only screen and (min-width: 600px) {
        .hl div:nth-child(1) {
            border-right: 1px solid lightgray;
        }

        .hl div:nth-child(2) {
            border-right: 1px solid lightgray;
        }

        .hl div:nth-child(3) {
            border-right: 1px solid lightgray;
        }
    }
    @media only screen and (max-width: 600px) {
        .hl div:nth-child(1) {
            border-bottom: 1px solid lightgray;
        }

        .hl div:nth-child(2) {
            border-bottom: 1px solid lightgray;
        }

        .hl div:nth-child(3) {
            border-bottom: 1px solid lightgray;
        }
    }
</style>

<div class="container">

    <div class="heading">
        TIDEVANN
    </div>

    <h2 id="title_date">I dag, </h2>

    <div id="hl_row" class="row hl">
        <div class="col-sm-3">
            <i></i>
            <span class="hl_time"></span>
            <span class="hl_cm"></span>
        </div>

        <div class="col-sm-3">
            <i></i>
            <span class="hl_time"></span>
            <span class="hl_cm"></span>
        </div>

        <div class="col-sm-3">
            <i></i>
            <span class="hl_time"></span>
            <span class="hl_cm"></span>
        </div>

        <div class="col-sm-3">
            <i></i>
            <span class="hl_time"></span>
            <span class="hl_cm"></span>
        </div>
    </div>

    <div class="row">

        <!-- <div class="settings col-sm-3">

            <form id="tide-form">
                <div class="form-group">
                    <label for="datepicker" class="col-sm-2 col-form-label">Dato</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control-plaintext" id="datepicker" placeholder="03/04/2020">
                    </div>
                    <script>
                        $(function() {
                            $("#datepicker").datepicker();
                            $("#datepicker").change(function() {
                                console.log(this.value);
                            });

                        });
                    </script>
                </div>

                <div class="form-group">
                    <label for="place" class="col-sm-2 col-form-label">Havn</label>
                    <div class="col-sm-10">
                    <select class="form-control" id="place-select">
                        <option>Ålesund</option>
                    </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="formControlRange" class="col-sm-2 col-form-label">Intervall</label>
                    <div class="col-sm-10">
                    <input type="range" id="interval" class="form-control-range" id="formControlRange">

                    </div>
                </div>
            </form>

        </div> -->

        <div class="col-md-12">

            <div class="chart-container">
                <canvas id="myChart"></canvas>
            </div>

        </div>

    </div>

</div>

<script type="text/javascript">
    tide_url = "http://api.sehavniva.no/";
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
    document.getElementById("title_date").innerHTML += getPrettyDate();
    // getPlaces();

    $(function() {
        checkTideData();

        function checkTideData() {
            setTimeout(function() {
                if (tide_data['pre'] != undefined &&
                    tide_data['obs'] != undefined &&
                    tide_data['tab'] != undefined) {
                    lineChart(tide_data);
                    fillHighLow(tide_data['tab']);
                } else {
                    checkTideData();
                }
            }, 20);
        }
    });

    function fillHighLow(data) {
        console.log(data);
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
            "url": "http://api.sehavniva.no/tideapi.php?tide_request=stationlist&type=perm",
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
                        borderWidth: 1,
                        pointRadius: 4,
                        pointStyle: 'dot',
                        hoverRadius: 4,
                        fill: false
                    },
                    {
                        label: 'Observert',
                        data: Object.values(map['obs']),
                        borderColor: 'rgba(0, 255, 0, 1)',
                        borderWidth: 1,
                        pointRadius: 4,
                        pointBackgroundColor: 'rgba(0, 255, 0, 0.3)',
                        fill: false
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
        var getreq = "http://api.sehavniva.no/tideapi.php?lat=" + latitude + "&lon=" + longitude;
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
</script>