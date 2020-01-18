<footer class="page-footer">
  <div class="container">

    <div class="row">
      <div class="col-sm-6">
        <i class="fa fa-anchor" aria-hidden="true"></i>&nbsp;&nbsp;Vike Småbåtforening
      </div>
      <div class="col-sm-6" id="extra">
        <a style="color: white;" href="https://github.com/gohovd/vsbf_php"><i class="fa fa-github" aria-hidden="true"></i></a><br>
      </div>
    </div>

  </div>
</footer>

<script>
  // if user is at bottom && user is scrolling downward
  //  footer height = 200
  //  after 5 seconds height = 50 againF

  $(document).ready(function() {
    var footer = document.getElementsByTagName("footer")[0];
    var extra = document.getElementById("extra");
    window.onscroll = function(ev) {
      if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight - 1) {
        // at bottom of screen
        extra.style.display = "block";

        setTimeout(function() {
          footer.style.opacity = "1";
          extra.style.opacity = "1";
        });
      } else {
        setTimeout(function() {
          extra.style.opacity = "0";
          footer.style.opacity = "0";
          extra.style.display = "none";
        });
      }
    };
  });
</script>