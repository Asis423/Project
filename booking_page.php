<?php if ($loggedIn) { ?>
      <!-- Form for logged-in users -->
      <div class="booking-form">
        <h2>Booking Form</h2>
        <form method="POST" action="">
          <input type="hidden" name="bike_code" value="<?php echo $bikeCode; ?>">
          <label for="start_date">Start Date:</label>
          <input type="date" id="start_date" name="start_date" required>
          <label for="end_date">End Date:</label>
          <input type="date" id="end_date" name="end_date" required>
          <input type="submit" value="Book Now">
        </form>
      </div>
    <?php } else { ?>
      <!-- Link to sign up page for non-logged-in users -->
      <div class="signup-link">
        <a href="signup_page.php">Sign up to book this bike</a>
      </div>
    <?php } ?>