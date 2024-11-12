<?php
// Start the session (optional, depending on your application needs)
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Master - Test Your Knowledge!</title>
    <link href="styles/main.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <header>
        <!-- Navbar Section -->
        <nav class="navbar">
            <div class="logo">
                <h1>Quiz Master</h1>
            </div>
            <div class="navbar-toggle" id="navbar-toggle">
                <i class="fas fa-bars"></i>
            </div>
            <ul class="navbar-menu" id="navbar-menu">
                <li><a href="#home" class="active">Home</a></li>
                <li><a href="#features">Features</a></li>
                <li><a href="#start">Start Quiz</a></li>
                <li><a href="#about">About Us</a></li>
                <li><a href="#footer">Contact</a></li>
            </ul>
        </nav>

        <!-- Welcome Message Section -->
        <div class="welcome-message" id="home">
            <h1>Welcome to Quiz Master!</h1>
            <p class="description">Challenge yourself and see how much you really know!</p>
            <a href="quiz.php"><button class="btn">Start the Quiz</button></a>
        </div>
    </header>

    <div class="container">
        <!-- Features Section -->
        <section class="features" id="features">
            <h2>What We Offer</h2>
            <div class="feature-cards">
                <div class="feature-card">
                    <i class="fas fa-question-circle"></i>
                    <h3>Exciting Quizzes</h3>
                    <p>Dive into a variety of quizzes tailored for every interest!</p>
                </div>
                <div class="feature-card">
                    <i class="fas fa-trophy"></i>
                    <h3>Instant Results</h3>
                    <p>Find out how you did right after completing the quiz!</p>
                </div>
                <div class="feature-card">
                    <i class="fas fa-chart-line"></i>
                    <h3>Track Your Progress</h3>
                    <p>Keep track of your achievements and improvement over time.</p>
                </div>
                <div class="feature-card">
                    <i class="fas fa-user-friends"></i>
                    <h3>Community Engagement</h3>
                    <p>Join our community to challenge friends and share your scores!</p>
                </div>
                <div class="feature-card">
                    <i class="fas fa-mobile-alt"></i>
                    <h3>Mobile Friendly</h3>
                    <p>Enjoy quizzes anytime, anywhere on your mobile devices.</p>
                </div>
                <div class="feature-card">
                    <i class="fas fa-shield-alt"></i>
                    <h3>Data Security</h3>
                    <p>Your data and privacy are our top priorities.</p>
                </div>
            </div>
        </section>

        <!-- About Section -->
        <section class="about" id="about">
            <h2>About Us</h2>
            <p>Quiz Master is your go-to platform for challenging and fun quizzes. We aim to make learning exciting, engaging, and accessible to everyone. Join us and discover a world of knowledge!</p>
        </section>

        <!-- Call to Action Section -->
        <div class="cta" id="start">
            <a href="quiz.php"><button class="btn">Start the Quiz</button></a>
        </div>

        <!-- Footer Section -->
        <footer id="footer">
            <p>&copy; 2024 Quiz Master. All rights reserved.</p>
            <div class="social-icons">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
            </div>
        </footer>
    </div>

    <script>
        // Smooth Scroll
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });

        // Navbar animation on scroll
        const navbar = document.querySelector('.navbar');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 0) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Toggle Navbar on Mobile
        const navbarToggle = document.getElementById('navbar-toggle');
        const navbarMenu = document.getElementById('navbar-menu');

        navbarToggle.addEventListener('click', () => {
            navbarMenu.classList.toggle('active');
        });
    </script>
</body>
</html>
