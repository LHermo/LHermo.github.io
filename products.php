<?php
session_start();
include 'conn.php';
include 'functions.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="style.css">

    <link rel="icon" href="assets/icon.ico">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;700;900&display=swap" rel="stylesheet">

    <title>Davao Fresh</title>
</head>

<body>
    <div class="main-content">
        <!-- NAVIGATION BAR -->
        <nav class="nav">
            <img class="logo" src="assets/LOGO - Davao Fresh.svg"></img>
            <ul style="display: inline-block;">
                <li><a href="home.php"> Home </a></li>
                <li class="active"><a href="products.php"> Products </a></li>
                <li><a href="about.php"> About Us</a></li>
            </ul>
            <?php if (isset($_SESSION['email'])) : ?>
                <select id="home-dropdown" style="height: 24px; border: none; font-size: 1rem; outline: none;">
                    <option value="" selected disabled hidden>
                        <?php
                        $email = $_SESSION['email'];
                        getDataBySession('acc_name', $conn, $email);
                        ?></option>
                    <option value="basket">My Basket</option>
                    <option value="history">Order History</option>
                    <option value="settings">Settings</option>
                    <option value="logout">Logout</option>
                </select>
                <?php echo "</ul>" ?>
            <?php else : ?>
                <ul>
                    <li><a href="login.php">Login</a></li>
                </ul>
            <?php endif; ?>
        </nav>

        <!-- MAIN CONTENT -->
        <div class="products-hero">
            <h1>Explore our products</h1>
            <p>Search through our catalog of fruits and vegetables <br>
                locally sourced from Davao farmers</p>
        </div>
        <!-- SEARCHBAR -->
        <div class="search-div">
            <form method="GET" action="product-search.php">
                <input class="search-bar" type="text" name="query" placeholder="Search products (e.g. Brussel Sprouts)">
            </form>
        </div>


        <div class="all-products">
            <!-- vegetables -->
            <div style="margin-bottom: 50px">
                <div class="categ">
                    <div class="cat-name">Vegetables</div>
                    <div class="desc"><?php countProducts($conn, 'VEGETABLES'); ?> PRODUCTS</div>
                </div>
                <?php getCatalog($conn, $category = "VEGETABLES"); ?>
            </div>

            <!-- fruits -->
            <div style="margin-bottom: 50px">
                <div class="categ">
                    <div class="cat-name">Fruits</div>
                    <div class="desc"><?php countProducts($conn, 'FRUITS'); ?> PRODUCTS</div>
                </div>
                <?php getCatalog($conn, $category = "FRUITS"); ?>
            </div>

            <!-- grains -->
            <div style="margin-bottom: 50px">
                <div class="categ">
                    <div class="cat-name">Grains</div>
                    <div class="desc"><?php countProducts($conn, 'GRAINS'); ?> PRODUCTS</div>
                </div>
                <?php getCatalog($conn, $category = "GRAINS"); ?>
            </div>

            <!-- herbs -->
            <div style="margin-bottom: 50px">
                <div class="categ">
                    <div class="cat-name">Herbs and Spices</div>
                    <div class="desc"><?php countProducts($conn, 'HERBS AND SPICES'); ?> PRODUCTS</div>
                </div>
                <?php getCatalog($conn, $category = "HERBS AND SPICES"); ?>
            </div>
        </div>
    </div>
    <div style="margin-top: 150px;"></div>

</body>

<script>
    // Sa Navbar animations ni
    window.addEventListener('scroll', function() {
        var navbar = document.querySelector('nav');
        if (window.pageYOffset > 0) {
            navbar.classList.add('nav-shadow');
        } else {
            navbar.classList.remove('nav-shadow');
        }
    });

    window.onscroll = function() {
        scrollFunction()
    };

    function scrollFunction() {
        if (document.body.scrollTop > 60 || document.documentElement.scrollTop > 60) {
            document.querySelector("nav").style.padding = "1% 10%";
            document.querySelector("nav").style.height = "50px";
            document.querySelector("nav").style.transition = "all 0.3s ease-in-out";
        } else {
            document.querySelector("nav").style.padding = "2% 10%";
            document.querySelector("nav").style.height = "60px";
            document.querySelector("nav").style.transition = "all 0.3s ease-in-out";
        }
    }

    // Sa quantity-selectors ni
    var minusBtn = document.querySelector(".minus-btn");
    var plusBtn = document.querySelector(".plus-btn");
    var quantityInput = document.querySelector(".quantity-input");

    minusBtn.addEventListener("click", function() {
        if (quantityInput.value > 0) {
            quantityInput.value--;
        }
    });

    plusBtn.addEventListener("click", function() {
        quantityInput.value++;
    });

    // sa home dropdown ni
    const selectElement = document.querySelector('#home-dropdown');
    selectElement.addEventListener('change', (event) => {
        const selectedValue = event.target.value;
        if (selectedValue === 'logout') {
            window.location.href = 'logout.php';
        } else if (selectedValue === 'basket') {
            window.location.href = 'basket.php';
        }
    });
</script>

</html>