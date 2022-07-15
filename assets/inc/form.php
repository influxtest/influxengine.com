<?php /* regular contact form */ ?>
<form novalidate action="/form.php" method="POST" class="form">


  <div class="input-wrap text is-one-third">
    <input name="FullName" aria-label="Full Name" placeholder="Full Name*" type="text" required />
  </div>
  <div class="input-wrap text is-one-third">
    <input pattern="^(\+\d{1,2}\s)?\(?\d{3}\)?[\s.-]?\d{3}[\s.-]?\d{4}$" name="Phone" aria-label="Phone Number" placeholder="Phone Number*" type="tel" required />
  </div>
  <div class="input-wrap text is-one-third">
    <input name="Email" aria-label="Email Address" placeholder="Email Address*" type="email" required />
  </div>

  <div class="input-wrap is-one-third">
    <span class="select">
      <select id="Schedule" name="ProcedureOfInterest" aria-label="Procedure of Interest" required>
        <option value="" disabled selected>Procedure of Interest*</option>
        
        <option value="Replace">Replace</option>
      </select>
    </span>
  </div>

  <div class="input-wrap is-one-third">
    <span class="select">
      <select id="DecisionStage" name="DecisionStage" aria-label="Decision Stage" >
        <option value="" disabled selected>Decision Stage</option>
        <option value="Just Started Researching">Just Started Researching</option>
        <option value="Evaluating Treatments">Evaluating Treatments</option>
        <option value="Interviewing Doctors">Interviewing Doctors</option>
        <option value="Ready to Book a Procedure">Ready to Book a Procedure</option>
      </select>
    </span>
  </div>

  <div class="input-wrap is-one-third">
    <span class="select">
      <select id="BestTime" name="BestTime" aria-label="Best Time To Reach You" >
        <option value="" disabled selected>Best time to reach you</option>
        <option value="Morning">Morning</option>
        <option value="Afternoon">Afternoon</option>
      </select>
    </span>
  </div>

  <div class="input-wrap text is-full">
    <textarea id="Message" name="Message" aria-label="Message" data-hj-whitelist placeholder="How can we assist your aesthetic needs?" type="text" maxlength="280"></textarea>
  </div>

  <div class="input-wrap text is-full" style="display: none;">
    <input name="ZipCode" aria-label="Zip Code" placeholder="Zip Code*" type="text" />
  </div>

  <div class="input-wrap">
    <button type="submit" aria-label="Submit Form" class="button mb0">Schedule Consultation <img src="/assets/img/_defaults/arrow-right-white.svg" title="Submit Form" alt="right arrow" /></button>
  </div>

  <div class="input-wrap">
    <span class="title-sm text-center highlight-color"><?php echo $phonelink; ?></span>
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
