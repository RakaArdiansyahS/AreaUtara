<?php session_start(); // Start the session ?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AreaUtara | FAQ</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <style>
        /* Custom Styles for FAQ */
        .faq-header {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .accordion-button {
            font-weight: bold;
            font-size: 1.2rem;
        }
        .accordion-button::after {
            font-family: 'FontAwesome';
            content: "\f067"; /* fa-plus icon */
            float: right;
        }
        .accordion-button:not(.collapsed)::after {
            content: "\f068"; /* fa-minus icon */
        }
        .accordion-button.collapsed {
            color: #007bff;
            text-decoration: underline;
        }
        .accordion-body {
            font-size: 1rem;
            line-height: 1.5;
        }
    </style>
</head>
<body>
    <?php require "navbar.php"; ?>

    <!-- Banner -->
    <div class="container-fluid banner-faq d-flex align-items-center">
        <div class="container text-center text-white">
            <h1>Frequently Asked Questions</h1>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container py-5" style="min-height: 80vh; display: flex; flex-direction: column; justify-content: center;">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="faq-header text-center">FAQ / Pertanyaan yang sering diajukan</div>
                <div class="accordion" id="faqAccordion">
                    <!-- FAQ Item 1 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Bagaimana Cara Melakukan Pembelian?
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.
                            </div>
                        </div>
                    </div>
                    <!-- FAQ Item 2 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Apakah Toko Online Ini Aman?
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.
                            </div>
                        </div>
                    </div>
                    <!-- Tambahkan item FAQ lainnya sesuai kebutuhan -->
                </div>
            </div>
        </div>
    </div>

    <?php require "footer.php"; ?>
</body>
</html>
