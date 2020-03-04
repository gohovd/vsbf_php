<div class="row">
    <div class="heading">
        TIDEVANN
    </div>
</div>

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
                    fillHighLow(tide_data['tab']);
                } else {
                    checkTideData();
                }
            }, 20);
        }

        document.getElementById("tide").addEventListener("click", function() {
            window.location.href = "https://vikesbf.no/tide.php";
        });
    });
</script>

<style>

.hl {
    color: black;
    position: relative;
    left: 50%;
    transform: translateX(-50%);
    width: 90%;
    text-align: center;
    margin-top: 30px;
    margin-bottom: 30px;

    border: 1px solid transparent;
    border-radius: 5px;
    margin-bottom: 15px;

    -webkit-box-shadow: 0px 1px 5px 0px rgba(0, 0, 0, 0.2);
    -moz-box-shadow: 0px 1px 5px 0px rgba(0, 0, 0, 0.2);
    box-shadow: 0px 1px 5px 0px rgba(0, 0, 0, 0.2);

    transition: background-color 0.2s ease-in-out;
}

.hl:hover {
    background-color: whitesmoke;
    cursor: pointer;
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

    .hl {
        -webkit-box-shadow: 0px 1px 5px 0px rgba(0, 0, 0, 0);
        -moz-box-shadow: 0px 1px 5px 0px rgba(0, 0, 0, 0);
        box-shadow: 0px 1px 5px 0px rgba(0, 0, 0, 0);
    }    

}
</style>