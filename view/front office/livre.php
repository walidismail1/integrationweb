<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Document</title>
    <link rel="stylesheet" href="css/stylehome.css">
    <link rel="stylesheet" type="text/css" href="css/stylesAboutUs.css">
</head>
<body>
<?php include_once 'header.php'; ?>
    <div class="slider">
        <div class="list">
            
        <div class="item">
                <img src="1.jpg" alt="">
            </div>
            <div class="item">
                <img src="2.jpg" alt="">
            </div>
            <div class="item">
                <img src="3.jpg" alt="">
            </div>
            <div class="item">
                <img src="4.jpg" alt="">
            </div>
            <div class="item">
                <img src="5.jpg" alt="">
            </div>
        </div>
        <div class="buttons">
            <button id="prev"><</button>
            <button id="next">></button>
        </div>
        <ul class="dots">
            <li class="active"></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
        </ul>
    </div>
    <div class="contact-form">
        <h1>About Us</h1>
        <div class="container">
            <div class="main">
                <div class="content">
                    <h2>Our Story</h2>
                    <p>Welcome to our vibrant online space where a world of literary wonders and artistic expressions awaits you. At our website, we take pride in offering a diverse collection that transcends traditional boundaries. Immerse yourself in the realm of literature as you explore our carefully curated selection of books, ranging from timeless classics to contemporary masterpieces. Unleash your creativity with our captivating artworks, each telling a unique story through brushstrokes and imagination.......</p>
                    <button class="read-more-btn">Read More</button>
                </div>
                <div class="form-img">
                    <img src="ipad.png" alt="Our Bookstore">
                </div>
            </div>
        </div>
    </div>
    <div class="contact-form">
        <h1>Contact Us</h1>
        <div class="container">
            <div class="main">
                <div class="content">
                    <h2>Contact Us</h2>
                    <form action="#" method="post">
                        <input type="text" name="name" placeholder="Enter Your Name">
                      
                        <input type="email" name="name" placeholder="Enter Your Email">
                        <textarea name="message" placeholder="Your Message"></textarea>                   
             <button type="submit" class="btn">Send <i class="fas fa-paper-plane"></i></button>
                    </form>
                </div>
                <div class="form-img">
                    <img src="ipad.png" alt="">
                </div>
            </div>
        </div>
    </div> 

    <script src="app.js"></script>
    <?php include_once 'footer.php'; ?>
</body>
</html>