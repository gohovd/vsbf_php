<footer class="page-footer">
  <div class="container">

    <div class="row">

      <!-- <div class="col-sm-6">
        <i class="fa fa-anchor" aria-hidden="true"></i>&nbsp;&nbsp;Vike Småbåtforening
      </div>
      <div class="col-sm-6" id="extra">
        <a style="color: white;" href="https://github.com/gohovd/vsbf_php"><i class="fa fa-github" aria-hidden="true"></i></a><br>
      </div> -->

      <div class="col-md-4">
        <h5>OM OSS</h5>

        <table id="about-table">

          <tr>
            <th>
              <i class="fa fa-map-marker"></i>
            </th>
            <th>
              <b>Addresse:</b>
            </th>
          </tr>
          <tr>
            <td></td>
            <td>
              Møre og Romsdal,<br>6392 Vikebukt
            </td>
          </tr>

          <tr>
            <th>
              <i class="fa fa-envelope"></i>
            </th>
            <th>
              <b>Har du spørsmål?</b>
            </th>
          </tr>
          <tr>
            <td></td>
            <td>
              formann@vikesbf.no<br>
              <a href="<?php echo $baseUrl . '/kontakt.php' ?>">(All kontaktinfo)</a>
            </td>
          </tr>

          <tr>
            <th>
              <i class="fa fa-phone"></i>
            </th>
            <th>
              <b>Telefon:</b>
            </th>
          </tr>
          <tr>
            <td></td>
            <td>
              (+47) 924 34 571
            </td>
          </tr>

        </table>

      </div>

      <div class="col-lg-4">
        <h5>SISTE NYTT</h5>

        <div class="row" id="latest">
          <div class="col-sm-2 date">
            25<br>DES
          </div>
          <div class="col-sm-9 short">
            Juleaften ble flyttet til midten av Januar, så vi samlet sammen
            Torsdag den 13 Januar og feiret nyttår i gapahuken.
          </div>
        </div>

        <div class="row" id="latest">
          <div class="col-sm-2 date">
            8<br>AUG
          </div>
          <div class="col-sm-9 short">
            Jeg hadde mega bursdagsfeiring lizm!
          </div>
        </div>

      </div>

      <div class="col-md-4">

        <h5>ABONNER</h5>

        <form id="subscribe-form">

          <label class="sr-only" for="inlineFormInputGroup">Din e-post addresse</label>

          <div class="input-group mb-2">

            <input type="text" id="email-input" style="text-align: left;" class="form-control" id="inlineFormInputGroup" placeholder="Din e-post addresse" required>

            <div class="input-group-append">
              <div id="subscribe-btn" class="input-group-text" onclick="subscribe()"><i class="fa fa-check"></i></div>
            </div>

            <script type="text/javascript">
             shorten();


              function subscribe() {
                var email = document.getElementById("email-input").value;
                if (validate(email)) {
                  console.log("Vellykket..");
                } else {
                  alert("E-post addressen er ikke riktig.");
                }
              }

              function validate(email) {
                var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                return re.test(String(email).toLowerCase());
              }


            </script>

          </div>

        </form>

      </div>

    </div>

  </div>
</footer>