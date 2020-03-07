<?php
if (session_id() == "") {
	session_start();
}
?>
<?php $title = 'KONTAKT'; ?>
<?php $currentPage = 'KONTAKT'; ?>

<?php include('./head.php'); ?>
<?php include('./nav-bar.php'); ?>

<style>
    .sh {
        color: lightgray;
    }

    .si {
        text-align: center;
    }

    #srow {
        margin-bottom: 25px;
    }

    #srow i {
        width: 60px;
        padding: 10px;
        text-align: center !important;
        border: 1px solid transparent !important;
        margin-left: 5px;
        -webkit-box-shadow: 0px 1px 3px 0px rgba(0, 0, 0, 0.5);
        -moz-box-shadow: 0px 1px 3px 0px rgba(0, 0, 0, 0.5);
        box-shadow: 0px 1px 3px 0px rgba(0, 0, 0, 0.5);
        transition: all .5s ease-in-out !important;
        background-color: rgb(111, 169, 222);
        color: white;
    }

    #bgel {
        position: absolute;
        z-index: -10;
        height: 100vh;
        width: 100vw;
        left: 0;
        top: 0;
        background-color: rgb(30, 62, 100);
    }

    .badge {
        /* float: right !important; */
        color: black;
    }
</style>

<body>
    <div id="bgel"></div>

    <div class="container" style="margin-top: 25px;">
        <!-- <h1><i class="fa fa-wrench"></i></h1> -->

        <div id="srow" class="row">
            <div class="col-sm-1">
                <h2><i class="si fa fa-users"></i></h2>
            </div>
            <div class="sh col-sm-10">
                BRUKERE<br>
                <div class="badge badge-light">Legg til, fjern, eller endre brukere</div>
                <hr>
            </div>
        </div>

        <div id="srow" class="row">
            <div class="col-sm-1">
                <h2><i class="si fa fa-reply-all"></i></h2>
            </div>
            <div class="sh col-sm-10">
                MAIL SERVER<br>
                <div class="badge badge-light">Send e-post til alle eller enkelte abonnenter</div>
                <hr>
            </div>
        </div>

    </div>
</body>

<script type="text/javascript">

$(document).ready(function() {
    var flag = false;

    function toggleNavbar(on) {
        var n = document.getElementsByTagName("nav")[0];
        if (on && !flag) {

            n.style.height = "100%";
            // for(var i = 0; i < n.children.length; i++) {
            //             n.children[i].style.visibility = "visible";
            //         }
            
            setTimeout(function() {
                flag = true;
            }, 2000);

        } else {
            if (flag) {
                // function hideNavbar() {
                    n.style.height = 0;
                    // for(var i = 0; i < n.children.length; i++) {
                    //     n.children[i].style.display = "hidden";
                    // }
                    flag = false;
                // };
                // timeout = setTimeout(hideNavbar, 500);
            }
        }
    }
    toggleNavbar();

    document.addEventListener("mousemove", function(e) {
        var mousecoords = getMousePos(e);
        if (mousecoords.y < 85) {
            console.log(mousecoords.y)
            toggleNavbar(true);
        } else {
            toggleNavbar(false);
        }
    });

    function getMousePos(e) {
        return {x:e.clientX,y:e.clientY};
    }
});


</script>

<?php
//include('./foot.php');
?>

<!--
<style>
	.contacts {
		height: 100vh;
	}
	footer {
		position: inherit;
	}
</style>
-->