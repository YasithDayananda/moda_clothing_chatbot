<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moda Header</title>
    <link rel="stylesheet" href="../css/header.css">
    <!-- Include Phosphor Icons library for using the icons -->
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
</head>
<body>
    <header>
    <div class="navbar">
        <ul>
            <li><a href="../pages/home.php"><img src="../images/logo.png" class="logo" alt="Moda Logo"></a></li>
            <li><a href="../pages/home.php">HOME</a></li>
            <li><a href="../pages/men.php">MEN'S</a></li>
            <li><a href="../pages/women.php">WOMEN'S</a></li>
            <li><a href="../pages/shoes.php">SHOES</a></li>
            <li><a href="../pages/accessories.php">ACCESSORIES</a></li>
            <li class="icons-container">
                <!-- Grouped icons in one container -->
                <div class="icon">
                    <i class="ph ph-magnifying-glass" onclick="openSearch()"></i>
                </div>
                <div class="icon">
                    <a href="../pages/login.php"><i class="ph ph-user-circle"></i></a>
                </div>
                <div class="icon">
                    <a href="../pages/shopping_bag.php"><i class="ph ph-shopping-bag"></i></a>
                </div>
            </li>
        </ul>
    </div>
    <div id="myOverlay" class="overlay">
        <!-- Updated close button to use Phosphor Icons -->
        <i class="ph-bold ph-x closebtn" onclick="closeSearch()" title="Close Overlay"></i>
        <div class="overlay-content">
            <!-- <form action="action_page.php">
                <div class="search-container"> -->
                    <!-- The input and button for the search bar in the overlay -->
                    <!-- <input type="text" placeholder="What are you looking for?" name="search">
                    <button type="submit"><i class="ph ph-magnifying-glass"></i></button>
                </div>
            </form> -->
            <form id="searchForm" method="POST" action="search.php">
                <div class="search-container">
                    <input type="text" placeholder="What are you looking for?" name="search_query" id="searchQuery">
                    <button type="submit"><i class="ph ph-magnifying-glass"></i></button>
            </div>
</form>
        </div>
    </div>
    <script src="../js/togglesearch.js"></script>
</header>
</body>
</html>