<?php session_start(); // Start the session ?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AreaUtara | About Us</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php require "navbar.php"; ?>

    <!-- Banner -->
    <div class="container-fluid banner-about d-flex align-items-center">
        <div class="container text-center text-white">
            <h1>About Us</h1>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container py-5">
        <div class="row">
            <div class="col-md-6 mb-4">
                <h2>Our Story</h2>
                <p>
                    AreaUtara was founded with a vision to deliver quality and affordable products to our customers. Our journey started with a small team dedicated to providing exceptional service and value. Over the years, we have grown into a trusted name in the industry, offering a diverse range of products to meet the needs of our clients.
                </p>
                <p>
                    We believe in the power of innovation and customer satisfaction. Our team works tirelessly to ensure that we stay ahead of market trends and provide products that not only meet but exceed our customers' expectations.
                </p>
            </div>
            <div class="col-md-6 mb-4">
                <h2>Our Mission</h2>
                <p>
                    At AreaUtara, our mission is to enhance the quality of life for our customers by providing top-notch products and services. We are committed to sustainability, excellence, and continuous improvement. Our goal is to build lasting relationships with our clients and make a positive impact in the community.
                </p>
                <p>
                    Join us on our journey as we strive to be the leading provider in our industry, making a difference one product at a time.
                </p>
            </div>
        </div>
        
        <!-- Map Section -->
        <div class="row">
            <div class="col-12">
                <h2 class="text-center mb-4">Visit Us</h2>
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3961.0256547271683!2d107.62045881182789!3d-6.887530393082751!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e7aabdfff615%3A0xdac3637b8b49cf58!2sJl.%20Sadang%20Luhur%20No.42%2C%20Sekeloa%2C%20Kecamatan%20Coblong%2C%20Kota%20Bandung%2C%20Jawa%20Barat%2040134!5e0!3m2!1sen!2sid!4v1722649768021!5m2!1sen!2sid" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
        </div>
    </div>

    <!-- Team Section -->
    <div class="container py-5">
        <h2 class="text-center mb-4">Meet Our Team</h2>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card text-center">
                    <img src="image/team-member1.jpg" class="card-img-top" alt="Team Member 1">
                    <div class="card-body">
                        <h5 class="card-title">John Doe</h5>
                        <p class="card-text">Founder & CEO</p>
                        <p>John is the visionary behind AreaUtara, leading the company with passion and dedication.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card text-center">
                    <img src="image/team-member2.jpg" class="card-img-top" alt="Team Member 2">
                    <div class="card-body">
                        <h5 class="card-title">Jane Smith</h5>
                        <p class="card-text">Head of Marketing</p>
                        <p>Jane spearheads our marketing efforts, ensuring that our brand reaches the right audience effectively.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card text-center">
                    <img src="image/team-member3.jpg" class="card-img-top" alt="Team Member 3">
                    <div class="card-body">
                        <h5 class="card-title">Michael Brown</h5>
                        <p class="card-text">Chief Operating Officer</p>
                        <p>Michael oversees our operations, ensuring smooth and efficient processes across the company.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4">
        <div class="container text-center">
            <h5>Follow Us</h5>
            <div class="mt-3">
                <a href="https://www.instagram.com/areautara/" target="_blank" class="text-white mx-3">
                    <i class="fab fa-instagram fa-2x"></i>
                </a>
                <a href="https://www.facebook.com/areautaraultras/" target="_blank" class="text-white mx-3">
                    <i class="fab fa-facebook fa-2x"></i>
                </a>
                <a href="https://wa.me/+6285161242408" target="_blank" class="text-white mx-3">
                    <i class="fab fa-whatsapp fa-2x"></i>
                </a>
            </div>
            <p class="mt-3 mb-0">&copy; 2024 AreaUtara. All rights reserved.</p>
        </div>
    </footer>

    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="fontawesome/js/all.min.js"></script>
</body>
</html>
