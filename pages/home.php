<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moda Home</title>
    <link rel="stylesheet" href="../css/home.css">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="container">
        <div class="video-container">
            <video autoplay loop muted playsinline class="background-video">
                <source src="../videos/video110.mp4" type="video/mp4">
            </video>
        </div> 

        <div class="section-title">
            <h1>Women's Collection</h1>
        </div>
        <div class="products-container">
            <?php include '../php/female_product_retriver.php'; ?>
            
        </div>
        <div class="section-title">
            <h1>Men's Collection</h1>
        </div>
        <div class="products-container">
            <?php include '../php/male_product_retriver.php'; ?>
        </div>
        <div class="section-title">
            <h1>Unisex Collection</h1>
        </div>
        <div class="products-container">
            <?php include '../php/unisex_product_retriver.php'; ?>
        </div>
        
    </div>

<!-- Link JS and CSS -->

<script src="../js/chatbot.js"></script>
<link rel="stylesheet" href="../css/chatbot.css">
    
    <!-- <script src="../js/footer.js"></script> -->
     <!-- Chatbot Icon -->
<div id="chatbot-icon" onclick="openChat()">
    <img src="../images/botModa.png" alt="MODA Chatbot">
</div>

<!-- Chatbot Popup -->
<div id="chatbot-popup">
    <div id="chatbot-header">
        Chat With MODA
        <span id="chatbot-close" onclick="closeChat()">✖</span>
    </div>
    <div id="chatbot-messages"></div>
    <div id="chatbot-footer">
    <input type="text" id="chatbot-input" placeholder="Type a message..." onkeydown="if(event.key==='Enter'){sendMessage()}">
    <button id="send-btn" onclick="sendMessage()">Send</button>
</div>
</div>
</body>
</html>