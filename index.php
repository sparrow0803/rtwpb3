<?php
session_start();

try{
    $pdo = new PDO('mysql:host=localhost;dbname=rtwpb3', "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
    echo 'Connection Failed' .$e->getMessage();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RTWPB3</title>
    <link rel="icon" href="images/logo.png" type="image/x-icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">

    <style>

        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap');

        * {
            font-family: 'Poppins', sans-serif;
        }

        html {
          scroll-behavior: smooth;
        }

        .availability-form {
          margin-top: -50px;
          z-index: 2;
          position: relative;
        }

        .custom-bg {
          background-color: #2ec1ac;
          border: 1px solid #2ec1ac;
        }

        .custom-bg:hover {
          background-color: #279e8c;
          border-color: #279e8c;
        }

        .staff-swiper {
          width: 240px;
          height: 320px;
        }

        .staff-swi {
          position: relative;
          height: 300px; /* Adjust as needed */
          color: #fff;
          text-align: center;
          overflow: hidden;
          border-radius: 10px;
        }

        .staff-swi img {
          position: absolute;
          top: 0;
          left: 0;
          width: 100%;
          height: 100%;
          object-fit: cover;
          z-index: 1;
        }

        .staff-swi::before {
          content: "";
          position: absolute;
          top: 0;
          left: 0;
          width: 100%;
          height: 100%;
          background: rgba(0, 0, 0, 0.5); /* Dark overlay */
          z-index: 2;
        }

        .staff-swi h5,
        .staff-swi h6 {
          position: relative;
          z-index: 3;
          margin: 0;
          padding: 5px 10px;
        }

        .staff-swi h5 {
          margin-top: 200px; /* Push name lower over the image */
          font-size: 1.2rem;
          font-weight: bold;
        }

        .staff-swi h6 {
          font-size: 1rem;
          font-weight: normal;
        }
        
        .events-slider {
          width: 100%;
          padding: 20px 0;
        }

        .eve {
          width: auto; /* for coverflow, or set to 100% for single view */
          max-width: 100%;
          height: auto;
        }

        .eve .card-body {
          flex: 1;
          display: flex;
          flex-direction: column;
        }

        @media screen and (max-width: 575px) {
          .availability-form {
            margin-top: 25px;
            padding: 0 35px;
          }
        }

    </style>
</head>
<body class="bg-light">

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-light bg-white px-lg-3 py-lg-2 shadow-sm sticky-top" data-aos="fade-down" data-aos-delay="10">
  <div class="container-fluid">
    <a class="navbar-brand me-5 fw-bold fs-3 h-font d-flex align-items-center gap-2" href="index.php">
    <img src="images/logo.png" class="img-fluid" style="height: 40px;"> RTWPB3
    </a>
    <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link me-2" aria-current="page" href="#home">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-2" href="#news">News</a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-2" href="#events">Events</a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-2" href="#staff">Staff</a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-2" href="#contactus">Contact Us</a>
        </li>
      </ul>
      <div class="d-flex" role="search">
        <a class="btn shadow-none" href="https://www.facebook.com/rtwpbcl" target="_blank" rel="noopener noreferrer">
          <i class="bi bi-facebook"></i>
        </a>
        <a class="btn shadow-none" href="https://www.instagram.com/rtwpbcl" target="_blank" rel="noopener noreferrer">
          <i class="bi bi-instagram"></i>
        </a>
        <a class="btn shadow-none me-2" href="https://nwpc.dole.gov.ph/region-iii/" target="_blank" rel="noopener noreferrer">
          <i class="bi bi-link-45deg"></i>
        </a>
      </div>
    </div>
  </div>
</nav>

<!-- CAROUSEL -->
<div class="container" id="home" data-aos="zoom-in" data-aos-delay="20">
  <div class="swiper swiper-container">
    <div class="swiper-wrapper">
      <div class="swiper-slide" style="height: 350px; overflow: hidden;">
        <img src="images/1.png" style="object-fit: cover; height: 100%; width: 100%; " class="w-100 d-block"/>
      </div>
      <div class="swiper-slide" style="height: 350px; overflow: hidden;">
        <img src="images/2.png" style="object-fit: cover; height: 100%; width: 100%;" class="w-100 d-block"/>
      </div>
      <div class="swiper-slide" style="height: 350px; overflow: hidden;">
        <img src="images/3.jpg" style="object-fit: cover; height: 100%; width: 100%;" class="w-100 d-block"/>
      </div>
      <div class="swiper-slide" style="height: 350px; overflow: hidden;">
        <img src="images/4.jpg" style="object-fit: cover; height: 100%; width: 100%;" class="w-100 d-block"/>
      </div>
      <div class="swiper-slide" style="height: 350px; overflow: hidden;">
        <img src="images/5.jpg" style="object-fit: cover; height: 100%; width: 100%;" class="w-100 d-block"/>
      </div>
      <div class="swiper-slide" style="height: 350px; overflow: hidden;">
        <img src="images/6.jpg" style="object-fit: cover; height: 100%; width: 100%;" class="w-100 d-block"/>
      </div>
    </div>
  </div>
</div>

<!-- ABOUT RTWPB3 -->
<div class="container about-us" data-aos="fade-up" data-aos-delay="10">
  <h2 class="mt-5 pt-4 mb-4 text-center fw-bold">ABOUT RTWPB3</h2>
  <div class="card rounded shadow overflow-hidden">
    <div class="row g-0">
      
      <!-- IMAGE ON LEFT -->
      <div class="col-lg-4 col-md-5 p-0">
        <img src="images/about.jpg" class="img-fluid h-100 w-100" style="object-fit: cover;" alt="About RTWPB3">
      </div>

      <!-- TEXT ON RIGHT, FULL HEIGHT -->
      <div class="col-lg-8 col-md-7 d-flex align-items-center p-4 bg-white">
        <div>
          <p>
            We are the Regional Tripartite Wages and Productivity Board 3 team who mainly works on setting the minimum wage by conducting public hearings and consultations with labor and employer representatives to determine appropriate minimum wage rates.
          </p>
          <p>
            Along with that, we provide productivity promotion, tripartite representation, and wage order implementation and monitoring.
          </p>
        </div>
      </div>

    </div>
  </div>
</div>

<!-- NEWS -->
<div class="container" id="news" data-aos="fade-up" data-aos-delay="100">
  <h2 class="mt-5 pt-4 mb-4 text-center fw-bold">CURRENT NEWS</h2>
  <div class="row">
    <!-- Repeatable News Card Template with AOS -->
    <?php
      $stmt = $pdo->prepare("SELECT * from news ORDER BY date DESC LIMIT 3");
      $stmt->execute();
      if($stmt->rowCount() > 0){
        $result = $stmt->fetchAll();
        foreach($result as $row){
    ?>
    <div class="col-lg-4 col-md-6 my-3" data-aos="fade-up" data-aos-delay="100">
      <div class="card border-0 shadow h-100" style="max-width: 350px; margin: auto;">
        <img src="news/<?php echo $row['picture']; ?>" class="card-img-top" style="height: 200px; object-fit: cover;" alt="News 1">
        <div class="card-body d-flex flex-column">
          <h5 class="card-title"><?php echo $row['title']; ?></h5>
          <h6 class="mb-3"><?php echo $row['date']; ?></h6>
          <p class="flex-grow-1">
            <?php echo $row['description']; ?>
          </p>
          <a href="<?php echo $row['link']; ?>" target="_blank" rel="noopener noreferrer" class="btn btn-sm text-white mt-auto shadow-none custom-bg">More Details</a>
        </div>
      </div>
    </div>
    <?php } } 
      else {
    ?>
      <h5 class="text-center" style="color: red;" data-aos="fade-up" data-aos-delay="100">NO NEWS AVAILABLE</h5>
    <?php } ?>

    <!-- More News Button -->
    <!-- <div class="col-lg-12 text-center mt-5" data-aos="fade-up" data-aos-delay="100">
      <a href="#" class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none">More News ></a>
    </div> -->
  </div>
</div>

<!-- EVENTS -->
<div class="container" id="events" data-aos="fade-up" data-aos-delay="100">
<h2 class="mt-5 pt-4 mb-4 text-center fw-bold">LATEST & UPCOMING EVENTS</h2>
<div class="card rounded shadow overflow-hidden">
  <div class="swiper events-slider">
    <div class="swiper-wrapper">
      <?php
      $stmt = $pdo->prepare("SELECT * from events ORDER BY date DESC LIMIT 5");
      $stmt->execute();
      if($stmt->rowCount() > 0){
        $result = $stmt->fetchAll();
        foreach($result as $row){
      ?>

      <div class="swiper-slide eve">
        <div class="card border-0 shadow h-100 d-flex flex-column" style="max-width: 350px; margin: auto;">
        <img src="events/<?php echo $row['picture']; ?>" class="card-img-top" style="height: 200px; object-fit: cover;" alt="News 1">
        <div class="card-body d-flex flex-column">
          <h5 class="card-title"><?php echo $row['title']; ?></h5>
          <h6 class="mb-3"><?php echo $row['date']; ?></h6>
          <h6 class="mb-3"><?php echo $row['address']; ?></h6>
          <p class="flex-grow-1 mb-3">
            <?php echo $row['description']; ?>
          </p>
          <a href="<?php echo $row['link']; ?>" target="_blank" rel="noopener noreferrer" class="btn btn-sm text-white mt-auto shadow-none custom-bg">More Details</a>
        </div>
      </div>
      </div>
      <?php } } ?>

    </div>
    <div class="swiper-pagination"></div>
    </div>
    </div>

    <?php if($stmt->rowCount() == 0){ ?>
      
    <h5 class="text-center" style="color: red;" data-aos="fade-up" data-aos-delay="100">NO EVENTS AVAILABLE</h5>

    <?php } ?>

      <!-- More Events Button -->
    <!-- <div class="col-lg-12 text-center mt-5" data-aos="fade-up" data-aos-delay="100">
      <a href="#" class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none">More Events ></a>
    </div> -->
</div>

<!-- STAFF -->
<div class="container" id="staff" data-aos="fade-up" data-aos-delay="100">
<h2 class="mt-5 pt-4 mb-4 text-center fw-bold">OUR TEAM</h2>
<div class="card rounded shadow overflow-hidden"><br>
  <div class="row g-0 flex-column flex-md-row">
    <div class="col-md-7 d-flex align-items-center p-4 bg-white">
    <div class="w-100">
      <p class="mb-0 fs-6 text-center text-md-start">
        The RTWPB3 team consists of 12 employees chuchuchuchccuchchccucchuchcuchuchcuhcuchuchuhcuhcuhccuc.
      </p>
      </div>
    </div>
  <div class="col-md-5 p-0">
  <div class="swiper staff-swiper">
    <div class="swiper-wrapper">

    <?php
      $stmt = $pdo->prepare("SELECT * from staff order by id asc");
      $stmt->execute();
      if($stmt->rowCount() > 0){
        $result = $stmt->fetchAll();
        foreach($result as $row){
     ?>

      <div class="swiper-slide staff-swi">
        <img src="staff/<?php echo $row['picture']; ?>">
        <h5><?php echo $row['staff']; ?></h5>
        <h6><?php echo $row['position']; ?></h6>
      </div>


    <?php } } 
    else { ?>

      <div class="swiper-slide staff-swi">
        <h5>No Staff</h5>
      </div>

    <?php } ?>

    </div>
  </div>
  </div>
  </div>
</div>
</div>

<!-- FOOTER -->
<div class="container-fluid bg-white mt-5" id="contactus" data-aos="fade-up" data-aos-delay="10">
  <div class="row">
    <div class="col-lg-4 p-4">
      <h3>DOLE RTWPB3</h3>
      <h6>Regional Tripartite Wages and Productivity Board III</h6>
      <p>
        LDOHEDJCOHEODJDIDOWOJDOIQJDIJ
        AIDSASHASJAKSJAKSJAKS
        dDaaDADSASASASASAsasasasa
      </p>
    </div>
    <div class="col-lg-4 p-4">
      <h5 class="mb-3">Contact Us</h5>
      <h6>Telephone #: 890-989-212</h6>
      <h6>Cellphone #: 09671234567</h6>
    </div>
    <div class="col-lg-4 p-4">
      <h5 class="mb-3">Follow us</h5>
      <a href="https://www.facebook.com/rtwpbcl" target="_blank" rel="noopener noreferrer" class="d-inline-block text-dark text-decoration-none mb-2">
        <i class="bi bi-facebook"></i> Facebook
      </a><br>
      <a href="https://www.instagram.com/rtwpbcl" target="_blank" rel="noopener noreferrer" class="d-inline-block text-dark text-decoration-none mb-2">
        <i class="bi bi-instagram"></i> Instagram
      </a><br>
      <a href="https://nwpc.dole.gov.ph/region-iii/" target="_blank" rel="noopener noreferrer" class="d-inline-block text-dark text-decoration-none mb-2">
        <i class="bi bi-link-45deg"></i> NWPC Site
      </a><br>
    </div>
  </div>
</div>

<h6 class="text-center bg-dark text-white p-3 m-0" data-aos="fade-up" data-aos-delay="10">DESIGNED AND DEVELOPED BY
<a class="text-decoration-none" href="https://github.com/sparrow0803" target="_blank" rel="noopener noreferrer">KIAN RUZELL NAPAO <i class="bi bi-github"></i></a>
</h6>
    
<!-- SCRIPT -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    var swiper = new Swiper(".swiper-container", {
      spaceBetween: 30,
      effect: "fade",
      loop: true,
      autoplay: {
        delay: 3500,
        disableOnInteraction: false,
      }
    });

    var swiper = new Swiper(".events-slider", {
      loop: true,
      grabCursor: true,
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },

      // Mobile default (0 - 767px)
      slidesPerView: 1,
      centeredSlides: false,
      effect: "slide",

      breakpoints: {
        768: {
          slidesPerView: "auto",
          centeredSlides: true,
          effect: "coverflow",
          coverflowEffect: {
            rotate: 50,
            stretch: 0,
            depth: 100,
            modifier: 1,
            slideShadows: true,
          }
        }
      }
    });

    var swiper = new Swiper(".staff-swiper", {
      effect: "cards",
      grabCursor: true,
      loop: true
    });

    AOS.init({
    once: true,      // Only animate once
    duration: 800,   // Animation duration in ms
    easing: 'ease-in-out'
  });
</script>

<!-- SWEETALERT -->
<?php
  if(isset($_SESSION['success'])) { ?>
  <script>
    Swal.fire({
    title: "<?php echo $_SESSION['success']; ?>",
    icon: "success",
    confirmButtonText: 'OK',
    confirmButtonColor: "#043047",
    });
  </script>
<?php unset($_SESSION['success']); } ?>

<?php
  if(isset($_SESSION['error'])) { ?>
  <script>
    Swal.fire({
    title: "<?php echo $_SESSION['error']; ?>",
    icon: "error",
    confirmButtonText: 'OK',
    confirmButtonColor: "#043047",
    });
  </script>
<?php unset($_SESSION['error']); } ?>

<!-- REFRESH -->
<script>
  if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
  }
</script>

</body>
</html>