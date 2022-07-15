<?php /* virtual consultation form, includes file uploads and more detailed questions */ ?>
<form novalidate action="/form.php" method="POST" name="vc-consult" aria-label="Virtual Consultation Form" class="form">


  <div class="input-wrap checkbox is-half">
    <input id="Consent" name="Consent" aria-label="Consent" type="checkbox" required>

    </input>

    <label for="Consent">I have read the <a class="link" href="/privacy-policy/" target="_blank">privacy policy</a> and I consent to treatment.</label>
  </div>

  <div class="input-wrap text is-half">
    <label for="DigitalSignature">Initials for digital signature*</label>
    <input id="DigitalSignature" name="DigitalSignature" aria-label="Digital Signature" type="text" required>
  </div>

  <hr style="height: 2px; background: #efefef; width: 100%" />

  <div class="input-wrap text is-half">
    <label for="FirstName">First name*</label>
    <input id="FirstName" name="FirstName" aria-label="First Name" placeholder="Jane" type="text" required />
  </div>

  <div class="input-wrap text is-half">
    <label for="LastName">Last name*</label>
    <input id="LastName" name="LastName" aria-label="Last Name" placeholder="Doe" type="text" required />
  </div>

  <div class="input-wrap text is-half">
    <label for="Email">Email address*</label>
    <input id="Email" name="Email Address" aria-label="Email Address" placeholder="jane.doe@example.com" type="email" required />
  </div>

  <div class="input-wrap text is-half">
    <label for="Phone">Phone Number*</label>
    <input id="Phone" name="Phone" aria-label="Phone Number" pattern="^(\+\d{1,2}\s)?\(?\d{3}\)?[\s.-]?\d{3}[\s.-]?\d{4}$" placeholder="123-456-7890" type="tel" required />
  </div>

  <div class="input-wrap text is-half">
    <label for="Weight">Weight*</label>
    <input id="Weight" name="Weight" aria-label="Weight" placeholder="100lbs" type="text" required />
  </div>

  <div class="input-wrap text is-half">
    <label for="Height">Height*</label>
    <input id="Height" name="Height" aria-label="Height" placeholder="5'6" type="text" required />
  </div>

  <div class="input-wrap is-full">
    <label for="Schedule">Schedule Treatment By*</label>
    <span class="select">
      <select id="Schedule" name="ScheduleTreatmentBy" aria-label="Schedule Treatment By" required>
        <option value="" disabled="" selected="">Month</option>
        <option value="January">January</option>
        <option value="February">February</option>
        <option value="March">March</option>
        <option value="April">April</option>
        <option value="May">May</option>
        <option value="June">June</option>
        <option value="July">July</option>
        <option value="August">August</option>
        <option value="September">September</option>
        <option value="October">October</option>
        <option value="November">November</option>
        <option value="December">December</option>
      </select>
    </span>
  </div>

  <div class="input-wrap text is-full">
    <label for="Goals">My goals are</label>
    <textarea id="Goals" name="Goals" aria-label="Message" data-hj-whitelist placeholder="My goals are*" type="text" maxlength="280"></textarea>
  </div>

  <div class="input-wrap file is-half">
    <input id="DriversLicense" name="DriversLicense" aria-label="Drivers License" type="file" size="40" accept=".jpg,.jpeg,.png,.gif,.pdf,.doc" required>
    <label for="DriversLicense"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#444" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M3 15v4c0 1.1.9 2 2 2h14a2 2 0 0 0 2-2v-4M17 8l-5-5-5 5M12 4.2v10.3" /></svg> <span>Drivers License*</span></label>
  </div>

  <div class="input-wrap file is-half">
    <input id="Photo1" name="Photo1" aria-label="Photo 1" type="file" size="40" accept=".jpg,.jpeg,.png,.gif,.pdf,.doc" required>
    <label for="Photo1"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#444" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M3 15v4c0 1.1.9 2 2 2h14a2 2 0 0 0 2-2v-4M17 8l-5-5-5 5M12 4.2v10.3" /></svg> <span>Photo 1*</span></label>
  </div>

  <div class="input-wrap file is-half">
    <input id="Photo2" name="Photo2" aria-label="Photo 2" type="file" size="40" accept=".jpg,.jpeg,.png,.gif,.pdf,.doc">
    <label for="Photo2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#444" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M3 15v4c0 1.1.9 2 2 2h14a2 2 0 0 0 2-2v-4M17 8l-5-5-5 5M12 4.2v10.3" /></svg> <span>Photo 2</span></label>
  </div>

  <div class="input-wrap file is-half">
    <input id="Photo3" name="Photo3" aria-label="Photo 3" type="file" size="40" accept=".jpg,.jpeg,.png,.gif,.pdf,.doc">
    <label for="Photo3"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#444" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M3 15v4c0 1.1.9 2 2 2h14a2 2 0 0 0 2-2v-4M17 8l-5-5-5 5M12 4.2v10.3" /></svg> <span>Photo 3</span></label>
  </div>

  <p class="text-center">NOTE: If you are sending <strong>breast</strong> photos, please send a <strong>front view</strong> and two <strong>90 degree side</strong> views.</p>

  <div class="input-wrap text is-full" style="display: none;">
    <input name="ZipCode" aria-label="Zip Code" placeholder="Zip Code*" type="text" />
  </div>

  <div class="input-wrap is-full is-centered">
    <button type="submit" aria-label="Submit Form" class="button accent marbot0">Submit Virtual Consult<img src="/assets/img/_defaults/arrow-right-white.svg" title="Submit Form" alt="right arrow" /></button>
  </div>

  <?php
  if ($_SESSION["influx_source"] != "") {
    $influxsource = $_SESSION["influx_source"];
  } else {
    $influxsource = "Organic";
  }
  echo "<input type='hidden' name='LeadSource' value='$influxsource' />";
  ?>

</form>
