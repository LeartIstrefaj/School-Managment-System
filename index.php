<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMS-School Managment System</title>
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <header class="header">
        <div class="logo">
                <img id="img-logo" src="img/logo.png" alt="logo">
        </div>
        <nav class="navbar">
            <ul class="navbar-list">
                <li class="nav-item"><a class="first nav-link" href="./index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="about.php">About Us</a></li>
                <li class="nav-item"><a class="last nav-link" href="sign-in.php">Sign In</a></li>
            </ul>
        </nav>
    </header>
    

    <div class="slideshow-container">
        <div class="mySlides fade slider-img">

            <div class="slider-img-1">
                <h1 class="title-slider">Education is our passport to the future, for tomorrow belongs to the people who
                    prepare for it today
                    <a href="#contact" class="btn btn-contactUs">Contact Us!</a>
                </h1>
            </div>
        </div>

        <div class="mySlides fade slider-img">
            <div class="slider-img-2">
                <h1 class="title-slider">Education is our passport to the future, for tomorrow belongs to the people who
                    prepare for it today
                    <a href="#contact" class="btn btn-contactUs">Contact Us!</a>
                </h1>
            </div>


        </div>

        <div class="mySlides fade slider-img">
            <div class="slider-img-3">
                <h1 class="title-slider">Education is our passport to the future, for tomorrow belongs to the people who
                    prepare for it today
                    <a href="#contact" class="btn btn-contactUs">Contact Us!</a>
                </h1>

            </div>
        </div>

        <div class="mySlides fade slider-img">
            <div class="slider-img-5">
                <h1 class="title-slider">Education is our passport to the future, for tomorrow belongs to the people who
                    prepare for it today
                    <a href="#contact" class="btn btn-contactUs">Contact Us!</a>
                </h1>

            </div>
        </div>

        <div class="mySlides fade slider-img">
            <div class="slider-img-6">
                <h1 class="title-slider">Education is our passport to the future, for tomorrow belongs to the people who
                    prepare for it today
                    <a href="#contact" class="btn btn-contactUs">Contact Us!</a>
                </h1>

            </div>
        </div>
        <div class="mySlides fade slider-img">
            <div class="slider-img-7">
                <h1 class="title-slider">Education is our passport to the future, for tomorrow belongs to the people who
                    prepare for it today
                    <a href="#contact" class="btn btn-contactUs" id="slider-btn">Contact Us!</a>
                </h1>

            </div>
        </div>
        <a class="prev" onclick="plusSlides(-1)">❮</a>
        <a class="next" onclick="plusSlides(1)">❯</a>

    </div>
    </div>
    <br>

    <div style="text-align:center">
        <span class="dot" onclick="currentSlide(1)"></span>
        <span class="dot" onclick="currentSlide(2)"></span>
        <span class="dot" onclick="currentSlide(3)"></span>
        <span class="dot" onclick="currentSlide(4)"></span>
        <span class="dot" onclick="currentSlide(5)"></span>
        <span class="dot" onclick="currentSlide(6)"></span>
    </div>


    <div class="content">

        <div class="section-services m-1">
            <h1 class="subtitle">Services</h1>
            <hr class="under-line" />
            <div class="services">
                <div class="cards cards-1">
                    <h3 class="card-title">Enrollment</h3>
                    <p class="paragraph-cards">Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni, tempore
                        dicta
                        suscipit voluptatem quidem
                        praesentium quis laborum.</p>
                </div>

                <div class="cards cards-2">
                    <h3 class="card-title">Organization</h3>
                    <p class="paragraph-cards">Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni, tempore
                        dicta
                        suscipit voluptatem quidem
                        praesentium quis laborum.</p>
                </div>

                <div class="cards cards-3">
                    <h3 class="card-title">Finance</h3>
                    <p class="paragraph-cards">Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni, tempore
                        dicta
                        suscipit voluptatem quidem
                        praesentium quis laborum.</p>
                </div>
            </div>
        </div>
    </div>

    <h1 class="subtitle">Testimonials</h1>
    <hr class="under-line mb-2" />
    <div class="quotes">
        <div class="customer">
            <img class="customer-image" src="img/customers.jpg" alt="customers">
            <blockquote>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Eligendi ut placeat et minima quidem,
                laboriosam distinctio hic amet sapiente reiciendis libero dolores error neque alias necessitatibus
                tempore
                in voluptatem qui eum nostrum praesentium. Architecto iure sit fugiat esse expedita velit.
                <p id="customer-name">John Clear , PhD</p>
            </blockquote>
        </div>
    </div>

    <div class="content">
        
        <div class="contact-section" id="contact">
            
            <form class="form" method="POST" id="myform" onsubmit="return validate();">
                <h2 class="contact-title">Contact Us!</h2>
                <div id="error_message"></div>
                <input class="input-control" type="text" name="name" id="name" placeholder="Enter your Name">
                <input class="input-control" type="email" name="email" id="email" placeholder="Enter your Email Address">
                <textarea class="input-control" id="message" cols="30" rows="10" placeholder="Message"></textarea>
                <input class="btn" type="submit" onclick="sendMail()" value="Send" id="submit">
            </form>
        </div>
    </div>
    <footer class="footer">
        <div class="content-footer">
            <div class="footer-section-1">
                <img class="footer-logo" src="img/logo-footer.png" alt="footer-logo">
                <p class="description">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Earum a repellat magnam
                    cum
                    repellendus, vero quod tempora eum nisi numquam officiis iusto consequuntur consectetur commodi,
                    libero
                    quia
                    quis id? Ab?</p>
            </div>
            <div class="footer-section-2">
                <h3 class="subtitle-footer">Footer links</h3>
                <ul class="footer-links">
                    <li class="footer-item"><a class="footer-link" href="/">Home</a></li>
                    <li class="footer-item"><a class="footer-link" href="about.php">About Us</a></li>
                    <li class="footer-item"><a class="footer-link" href="sign-in.php">Sign In</a></li>
                </ul>
            </div>
            <div class="footer-section-2">
                <h3 class="subtitle-footer">Contact Us</h3>
                <ul class="footer-links footer-icons">
                    <li class="footer-item"><i class='bx bxs-phone'></i> +383 44 123 456</li>
                    <li class="footer-item"><i class='bx bxs-phone'></i> +383 49 123 456</li>
                    <li class="footer-item"><i class='bx bx-mail-send'></i> info@sms-uni.net</li>
                    <li class="footer-item"><i class='bx bxs-map'></i> Prishtine Rr.Nene Tereza</li>
                </ul>
            </div>
            <div class="footer-section-2">
                <h3 class="subtitle-footer">Social Media</h3>
                <a href="https://facebook.com" target="_blank"><i class='bx bxl-facebook-circle  socialM-icons'></i></a>
                <a href="https://instagram.com" target="_blank"><i
                        class='bx bxl-instagram social socialM-icons'></i></a>
                <a href="https://twitter.com/" target="_blank"><i class='bx bxl-twitter social socialM-icons'></i></a>
                <a href="https://tiktok.com/" target="_blank"><i class='bx bxl-tiktok social socialM-icons'></i></a>

                <p class="social-media-text">Terms and Condition</p>
                <p class="social-media-text privacy-page">Privacy and Policy</p>
            </div>
            <small>&copy; Designed and Developed <b>L . I</b></small>
        </div>

    </footer>


    <script src="js/slider.js"></script>
    <script src="js/validate.js"></script>
    <script src="js/mail.js"></script>
    <script type="text/javascript"
        src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js">
    </script>
    <script type="text/javascript">
    (function(){
        emailjs.init("k-SgSB8S9JZgxC-Qd");
    })();
    </script>
</body>

</html>