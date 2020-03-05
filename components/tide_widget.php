<div class="row">
    <div class="heading">
        TIDEVANN
    </div>
</div>

<div id="tide" class="container">

    <h4 id="title_date"></h4>

    <div id="hl_row" class="row hl">
        <div class="col-md-3">
            <i id="hl_icon"></i>
            <span class="hl_time"></span>
            <span class="hl_cm"></span>
        </div>

        <div class="col-md-3">
            <i id="hl_icon"></i>
            <span class="hl_time"></span>
            <span class="hl_cm"></span>
        </div>

        <div class="col-md-3">
            <i id="hl_icon"></i>
            <span class="hl_time"></span>
            <span class="hl_cm"></span>
        </div>

        <div class="col-md-3">
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
                if (TIDE_DATA.get("pre") != undefined &&
                    TIDE_DATA.get("obs") != undefined &&
                    TIDE_DATA.get("tab") != undefined) {
                        populateDiagrams(false);
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
    color: white;
    position: relative;
    text-align: center;

    border: 1px solid lightgray;
    border-radius: 5px;

    padding-top: 10px;
    padding-bottom: 10px;

    transition: all 0.2s ease-in-out;

    background-color: rgb(30, 62, 100);
}


.hl:hover {
    border: 1px solid lightgray;
    background-color: rgba(30, 62, 100, 0.9);
    cursor: pointer;
}

#hl_icon {
    font-size: 1.8em;
}

#title_date {
    padding-bottom: 15px;
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