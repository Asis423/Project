<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bike Showroom Booking System</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
  <div class="heading-section">
  <!-- Header starts ------------------------------------------------------------------------------- -->
    <header>
      <div class="logo"><img src="img/logo.png" alt="logo"></div>
      <nav class="navbar">
        <a href="#">Home</a>
        <a href="#">Gallery</a>
        <a href="#">Services</a>
        <a href="#">Contact Us</a>
        <button class="btn-login"><a href="login.php">Login</a></button>
      </nav>
    </header>
    <div class="home-info" id="home-info">
      <div class="home-text">
        <h1>LET'S HAVE<br>A RIDE</h1>
        <p>Providing the Quality and Luxurious Lifestyle.</p>
        <!-- Home button -->
        <a href="" class="btn">Book Now</a>
      </div>
    </div>
  </div>
    <!-- Header Ends ------------------------------------------------------------------------------- -->        
    
    <!-- Gallery Starts ------------------------------------------------------------------------------- -->
    <section class="gallery" id="gallery">
      <section class="clip_path">
        <h1>Gallery</h1>
      </section>
    <section class="container">
      <div class="bikes">
          <div class="image">
              <a href="">
                  <img src="img/bike1.jpg" alt="Bike">
              </a>
              <h2>Royal Enfield Classic 350</h2>
              <p>#Premium Black #Luxury</p>
              <p>Rs. 5,50,000/-</p>
              <button class="btn-booking">Book Now</button>
          </div>
      </div>
  
      <div class="bikes">
          <div class="image">
              <a href="">
                  <img src="img/bike1.jpg" alt="Bike">
              </a>
              <h2>Royal Enfield Classic 350</h2>
              <p>#Premium Black #Luxury</p>
              <p>Rs. 5,50,000/-</p>
              <button class="btn-booking">Book Now</button>
          </div>
      </div>
  
      <div class="bikes">
          <div class="image">
              <a href="">
                  <img src="img/bike1.jpg" alt="Bike">
              </a>
              <h2>Royal Enfield Classic 350</h2>
              <p>#Premium Black #Luxury</p>
              <p>Rs. 5,50,000/-</p>
              <button class="btn-booking">Book Now</button>
          </div>
      </div>
  </section>

      <!-- Contact section starts here ---------------------------------------------------------------------------------------------->

  <section class="contact" id="contact">
    <section class="clip_path">
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
            <p>Alka hospital, Lalitpur 44600</p>
          </li>
        </ul>
        <ul>
          <li>
            <span class="material-symbols-outlined"> Phone_In_Talk </span>
            <p>+977-01-5912727, 4538566</p>
          </li>
        </ul>
        <ul>
          <li>
            <span class="material-symbols-outlined"> mail </span>
            <p>info@achsnepal.edu.np</p>
          </li>
        </ul>
      </div>
    </div> <!-- contact_section ends -->
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
          </ul>
        </div> <!-- footer-col -->
        <div class="footer-col">
          <h4> Contact Us </h4>
          <ul>
            <li class="register_style">
              <p>Are you an alumni? Do you want to</p>
              <a href="#"> register ?</a>
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