<?php
if (session_id() == "") {
	session_start();
}
?>
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
}

.chart-container {
    margin-top: 20px;
    margin-bottom: 20px;
}

.hl {
    position: relative;
    left: 50%;
    transform: translateX(-50%);
    width: 90%;
    text-align: center;
    margin-top: 30px;
    margin-bottom: 30px;
}

#hl_icon {
    font-size: 1.8em;
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

    #tide {
        height: 130vh;
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

    #tide {
        height: 90vh;
    }
}
</style>

<div id="tide" class="container">

    <h2 id="title_date" style="margin-top: 30px;">I dag, </h2>

    <div id="hl_row" class="row hl">
        <div class="col-sm-3">
            <i id="hl_icon"></i>
            <span class="hl_time"></span>
            <span class="hl_cm"></span>
        </div>

        <div class="col-sm-3">
            <i id="hl_icon"></i>
            <span class="hl_time"></span>
            <span class="hl_cm"></span>
        </div>

        <div class="col-sm-3">
            <i id="hl_icon"></i>
            <span class="hl_time"></span>
            <span class="hl_cm"></span>
        </div>

        <div class="col-sm-3">
            <i id="hl_icon"></i>
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

    <div style="text-align: center;padding-bottom:50px;">Data hentet fra <a href="https://www.kartverket.no/">kartverket.no</a></div>


</div>

<script type="text/javascript">
   $(function() {
        checkTideData();

        function checkTideData() {
            setTimeout(function() {
                if (tide_data['pre'] != undefined &&
                    tide_data['obs'] != undefined &&
                    tide_data['tab'] != undefined) {
                    document.getElementById("title_date").innerHTML += getPrettyDate();
                    lineChart(tide_data);
                    fillHighLow(tide_data['tab']);
                } else {
                    checkTideData();
                }
            }, 20);
        }
    });
</script>

<?php
include('./foot.php');
?>

<style>
	footer {
		position: inherit;
	}
</style>