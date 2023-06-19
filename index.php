<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bike Showroom Booking System</title>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
  <div class="heading-section" id="home">
  <!-- Header starts ------------------------------------------------------------------------------- -->
    <header>
      <div class="logo"><img src="img/logo.png" alt="logo"></div>
      <nav class="navbar">
        <a href="#home">Home</a>
        <a href="#gallery">Gallery</a>
        <a href="#aboutus">About Us</a>
        <a href="#contact">Contact Us</a>
        <button class="btn-login"><a href="login_page.php">Login</a></button>
      </nav>
    </header>
    <div class="home-info" id="home-info">
      <div class="home-text">
        <h1>LET'S HAVE<br>A RIDE</h1>
        <p>Providing the Quality and Luxurious Lifestyle.</p>
        <!-- Home button -->
        <a href="signup_page.php" class="btn">Book Now</a>
      </div>
    </div>
  </div>
  <!-- Header Ends ------------------------------------------------------------------------------- -->        
    
  <!-- Gallery Starts ------------------------------------------------------------------------------- -->

  <!-- Gallery section Starts -->
  <section class="gallery" id="gallery">
    <section class="clip_path">
      <h1>Gallery</h1>
    </section>
    <section class="container-top">
      <?php
        // Make an AJAX request to fetch bike data from the database

        $curl = curl_init();
        $url = 'localhost/Project/gallery_fetch.php';
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        curl_close($curl);
        $bikeData = json_decode($response, true);
      
      // Check if bike data is available
      // var_dump($bikeData);
      if (!empty($bikeData)) {
        foreach ($bikeData as $bike) {
          $bikeImg = $bike['bike_image_url'];
          $bikeName = $bike['bike_name'];
          $bikePrice = $bike['bike_price'];
          $bikeCode = $bike['code'];
      ?>
          <div class="bikes">
            <div class="image">
              <a href="booking/<?php echo $bikeCode; ?>.php">
                <img src="img/<?php echo $bikeImg; ?>" alt="Bike">
              </a>
              <h2><?php echo $bikeName; ?></h2>
              <p><?php echo $bikePrice; ?></p>
              <a href="booking/<?php echo $bikeCode; ?>.php" class="enquiry-btn">Enquiry</a>
            </div>
          </div>
      <?php
        }
      } else {
        echo '<p> No bike data available</p>';
      }
      ?>
    </section>
  </section>
  <!-- Gallery section Ends -->

  <!-- Gallery section Ends Here ------------------------------------------------------------------------------- -->

  <!-- About Us Starts ------------------------------------------------------------------------------- -->
  
  <section class="aboutus" id="aboutus">
    <section class="clip_path_aboutus">
      <h1>About Us</h1>
    </section>
    <div class="container-about">
    <p>Welcome to Shelby Showroom, Nepal's First Automobile Search Venture, that helps you book royal 
      bikes online in the easiest way possible.</p>
      <section class="about_section">
        <div class="about-image">
          <img src="img/about-us.jpg" alt="bike">
        </div>
        <div class="about-content">
          <h2>Explore new horizons on two wheels</h2>
          <p>Welcome to Shelby Showroom, your premier destination for luxury bike bookings. Our showroom is 
            dedicated to providing you with an exceptional experience that combines the thrill of riding with 
            the elegance of luxury bikes.<br><br>
            At Shelby Showroom, we showcase a meticulously curated collection of top-tier bikes that embody 
            the perfect blend of style, performance, and craftsmanship. Each bike in our showroom is 
            handpicked to ensure that it meets our stringent standards of excellence.<br><br>
            When you choose Shelby Showroom for your bike booking, you can expect personalized attention and a 
            seamless process from start to finish. Our knowledgeable team is passionate about bikes and will 
            assist you in finding the perfect match for your riding preferences and aspirations.<br><br>
            We understand that owning a luxury bike is more than just a possession – it's a statement of 
            individuality and a gateway to unforgettable adventures. With our bike booking service, you have 
            the opportunity to embrace the road with confidence, knowing that you're riding a machine that 
            represents the pinnacle of engineering and design.<br><br>
            Indulge in the extraordinary and embark on a journey of elegance and excitement with Shelby 
            Showroom. Book your dream bike today and discover a world where luxury and performance converge, 
            setting the stage for unforgettable moments on the open road.
            
</p>
        </div>
      </section>
    </div>
  </section> 
  <!-- About Us Ends ------------------------------------------------------------------------------- -->
  
  <!-- Contact section starts here ---------------------------------------------------------------------------------------------->

  <section class="contact" id="contact">
    <section class="clip_path_contact">
      <h1>Contact Us</h1>
    </section>
    <div class="contact_section"> <!-- contact section begins -->
      <div class="row1">
        <form action="" method="post">
          <p> Send us a Message </p>
          <input type="text" class="verify" placeholder="Enter your Name (a-z)" pattern="[a-z]*" />
          <input type="email" placeholder="Enter your Email eg: abs@gmail.com" required />
          <textarea placeholder="Enter your message"></textarea>
          <button type="submit" class="send_btn">Send</button>
        </form>
      </div>
      <div class="contact-col">
        <h4>Get in touch with us</h4>
        <ul>
          <li>
            <span class="material-symbols-outlined"> location_on </span>
            <p>Chandragiri Hills, Kathmandu 44619</p>
          </li>
        </ul>
        <ul>
          <li>
            <span class="material-symbols-outlined"> Phone_In_Talk </span>
            <p>+977-9863727423, 9808375464</p>
          </li>
        </ul>
        <ul>
          <li>
            <span class="material-symbols-outlined"> mail </span>
            <p>info@shelby.edu.np</p>
          </li>
        </ul>
      </div>
    </div>
  </section>
  <!-- Contact section ends here ----------------------------------------------------------------------------------------------->

    <!-- footer section starts ---------------------------------------------------------------------------------------------------- -->
  <footer class="footer">
    <div class="footer_containerleft">
      <img src="img/logo.png" alt="Logo" class="img" />
    </div>
    <div class="footer_containerright">
      <div class="row">
        <div class="footer-col">
          <h4> Shelby Showroom</h4>
          <ul>
            <li>
              <a href="#aboutus"> About Us</a>
            </li>
            <li>
              <a href="#contact"> Contact Us</a>
            </li>
          </ul>
        </div> <!-- footer-col -->
        <div class="footer-col">
          <h4> Contact Us </h4>
          <ul>
            <li class="register_style">
              <p>Do you want to book a bike?</p>
              <a href="signup_page.php">  Register ?</a>
            </li>
          </ul>
        </div> <!-- footer-col -->
        <div class="footer-col">
          <h4> Follow US</h4>
          <div class="social-links">
            <a href="#"> <i class="fab fa-facebook-f"></i></a>
            <a href="#"> <i class="fab fa-instagram"></i></a>
            <a href="#"> <i class="fab fa-linkedin-in"></i></a>
            <a href="#"> <i class="fab fa-twitter"></i></a>
          </div>
        </div> <!-- footer-col ends -->
      </div> <!-- row -->
      <div class="copyright1">
        <p> 2023 Shelby. All rights reserved.</p>
        <p>Use of this site constitutes acceptance of our User Agreement and privacy policy.</p>
        <p>The Material on this site may not be reproduced, distributed, transmitted, cached or otherwise used, except
          with the prior written permission of Shelby.</p>
      </div>
    </div> <!-- footer_containerright -->

  </footer>
  <!-- footer section starts  ---------------------------------------------------------------------------------------->

</body>
</html>