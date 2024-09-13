<?php
session_start();
$isLoggedIn = isset($_SESSION['loggedin']) && $_SESSION['loggedin'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Rental Service</title>
    <style>
	
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            animation: fadeIn 1s ease-in;
        }
        header {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 1rem;
        }
        nav ul {
            padding: 0;
            list-style-type: none;
        }
        nav ul li {
            display: inline;
            margin-right: 10px;
        }
        nav ul li a {
            color: #fff;
            text-decoration: none;
            padding: 5px 10px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        nav ul li a:hover {
            background-color: #555;
        }
        nav ul li a.active {
            background-color: #4CAF50;
        }
        main {
            padding: 20px;
            max-width: 1200px;
            margin: 0 auto;
        }
        section {
            background-color: #fff;
            margin-bottom: 20px;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h2 {
            color: #333;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-top: 10px;
        }
        input {
            padding: 5px;
            margin-top: 5px;
        }
        button {
            margin-top: 10px;
            padding: 10px;
            background-color: #333;
            color: #fff;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #555;
        }
        #cars ul {
            display: flex;
            justify-content: space-between;
            padding: 0;
            list-style-type: none;
        }
        #cars li {
            flex-basis: 30%;
            text-align: center;
        }
        #cars img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
            transition: transform 0.3s ease-in-out;
        }
        #cars img:hover {
            transform: scale(1.1);
        }
        footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 1rem;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
        .hidden {
            display: none;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        @keyframes slideDown {
            from { 
                transform: translateY(-50px);
                opacity: 0;
            }
            to { 
                transform: translateY(0);
                opacity: 1;
            }
        }
        #login:not(.hidden), #signup:not(.hidden) {
            animation: slideDown 0.5s ease-out;
        }
        #animatedCar {
            position: fixed;
            bottom: 20px;
            left: -100px;
            transition: left 2s ease-in-out;
        }
		 @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideDown {
            from { 
                transform: translateY(-50px);
                opacity: 0;
            }
            to { 
                transform: translateY(0);
                opacity: 1;
            }
        }

        @keyframes fadeOut {
            from { opacity: 1; }
            to { opacity: 0; }
        }

        #login:not(.hidden), #signup:not(.hidden) {
            animation: slideDown 0.5s ease-out;
        }

        #login.fade-out, #signup.fade-out {
            animation: fadeOut 0.5s ease-out;
        }
		 /* Chatbot styles */
        #chatbot-button {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            font-size: 24px;
            cursor: pointer;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            z-index: 1000;
        }

        #chatbot-container {
            position: fixed;
            bottom: 90px;
            right: 20px;
            width: 300px;
            height: 400px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            display: none;
            flex-direction: column;
            z-index: 1000;
        }

        #chatbot-header {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            font-weight: bold;
        }

        #chatbot-messages {
            flex-grow: 1;
            overflow-y: auto;
            padding: 10px;
        }

        #chatbot-input {
            display: flex;
            padding: 10px;
        }

        #chatbot-input input {
            flex-grow: 1;
            margin-right: 10px;
        }

        #chatbot-input button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
        }
		        /* Chatbot styles */
        #chatbot-button {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            font-size: 24px;
            cursor: pointer;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            z-index: 1000;
            transition: transform 0.3s ease;
        }

        #chatbot-button:hover {
            transform: scale(1.1);
        }

        #chatbot-container {
            position: fixed;
            bottom: -410px; /* Start off-screen */
            right: 20px;
            width: 300px;
            height: 400px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            display: flex;
            flex-direction: column;
            z-index: 1000;
            transition: bottom 0.5s ease; /* Add transition for smooth animation */
            opacity: 0;
        }

        #chatbot-container.open {
            bottom: 90px; /* Final position when open */
            opacity: 1;
        }

        

        /* Animation keyframes */
        @keyframes slideUp {
            from {
                bottom: -410px;
                opacity: 0;
            }
            to {
                bottom: 90px;
                opacity: 1;
            }
        }

        @keyframes slideDown {
            from {
                bottom: 90px;
                opacity: 1;
            }
            to {
                bottom: -410px;
                opacity: 0;
            }
        }

        #chatbot-container.animateUp {
            animation: slideUp 0.5s ease forwards;
        }

        #chatbot-container.animateDown {
            animation: slideDown 0.5s ease forwards;
        }
		.profile-picture {
    width: 40px;
    height: 40px;
    border-radius: 50%;
}

    </style>
</head>
<body>
    <header>
        <h1>Welcome to Our Car Rental Service</h1>
        <nav>
            <ul>
                <li><a href="#home" class="active">Home</a></li>
                <li><a href="our-cars.html">Our Cars</a></li>
                <li><a href="About Us.html">About Us</a></li>
                <li><a href="#contact">Contact</a></li>
                 <?php if (!$loggedIn): ?>
            <!-- Show Login and Sign Up buttons if not logged in -->
            <li><a href="#" id="loginBtn">Login</a></li>
            <li><a href="#" id="signupBtn">Sign Up</a></li>
        <?php else: ?>
            <!-- Show profile picture and name if logged in -->
            <li>
                <img src="<?php echo $profilePicture; ?>" alt="Profile Picture" style="width: 40px; height: 40px; border-radius: 50%;">
                <span><?php echo $_SESSION['user_name']; ?></span>
            </li>
        <?php endif; ?>
		</ul>
        </nav>
    </header>
 <button id="chatbot-button">💬</button>
    <div id="chatbot-container">
        <div id="chatbot-header">Chat with us</div>
        <div id="chatbot-messages"></div>
        <div id="chatbot-input">
            <input type="text" id="chatbot-message-input" placeholder="Type your message...">
            <button id="chatbot-send-button">Send</button>
        </div>
    </div>
    <main>
        <section id="home">
            <h2>Find Your Perfect Rental Car</h2>
            <p>Browse our selection of quality vehicles for your next trip.</p>
        </section>

        <section id="signup" class="hidden">
    <h2>Sign Up</h2>
    <form id="signupForm" action="http://localhost/car_rental/signup.php" method="POST" enctype="multipart/form-data">
        <label for="signup-name">Full Name:</label>
        <input type="text" id="signup-name" name="name" required>

        <label for="signup-email">Email:</label>
        <input type="email" id="signup-email" name="email" required>

        <label for="signup-password">Password:</label>
        <input type="password" id="signup-password" name="password" required>

        <label for="signup-confirm-password">Confirm Password:</label>
       <input type="password" id="signup-confirm-password" name="confirm_password" required>
		    <label for="signup-profile-picture">Profile Picture:</label>
    <input type="file" id="signup-profile-picture" name="profile_picture" accept="image/*">
        <button type="submit" name="save"value="submit">Sign Up</button>
    </form>
</section>


        <section id="login" class="hidden">
    <h2>Login</h2>
    <form id="loginForm" action="http://localhost/car_rental/login.php" method="POST">
    <label for="login-email">Email:</label>
    <input type="email" id="login-email" name="email" required>

    <label for="login-password">Password:</label>
    <input type="password" id="login-password" name="password" required>

    <button type="submit">Login</button>
</form>

</section>


        <section id="cars">
            <h2>Our Cars</h2>
            <ul>
                <li>
                    <h3>Economy Car</h3>
                    <img src="Honda Civic.png" alt="Economy Car">
                    <p>Perfect for city driving and fuel efficiency.</p>
                </li>
                <li>
                    <h3>SUV</h3>
                    <img src="2024 Chevrolet Traverse.jpg" alt="SUV">
                    <p>Spacious and comfortable for family trips.</p>
                </li>
                <li>
                    <h3>Luxury Sedan</h3>
                    <img src="2024 Alfa Romeo Giulia.png" alt="Luxury Sedan">
                    <p>Travel in style with our premium options.</p>
                </li>
            </ul>
        </section>
    </main>

    <footer>
        <p>&copy; 2023 Car Rental Service. All rights reserved.</p>
    </footer>

    <div id="animatedCar">
        🚗
    </div>

 <script>
        // Show/hide login and signup forms
        const loginBtn = document.getElementById('loginBtn');
        const signupBtn = document.getElementById('signupBtn');
        const loginSection = document.getElementById('login');
        const signupSection = document.getElementById('signup');

        function toggleSection(sectionToToggle, sectionToHide) {
            if (sectionToToggle.classList.contains('hidden')) {
                // Show the section
                sectionToToggle.classList.remove('hidden');
                sectionToToggle.classList.remove('fade-out');
                sectionToHide.classList.add('hidden');
            } else {
                // Hide the section with fade-out animation
                sectionToToggle.classList.add('fade-out');
                sectionToToggle.addEventListener('animationend', function() {
                    sectionToToggle.classList.add('hidden');
                    sectionToToggle.classList.remove('fade-out');
                }, {once: true});
            }
        }

        loginBtn.addEventListener('click', (e) => {
            e.preventDefault();
            toggleSection(loginSection, signupSection);
        });

        signupBtn.addEventListener('click', (e) => {
            e.preventDefault();
            toggleSection(signupSection, loginSection);
        });

        // Form submission (for demonstration purposes)
        const loginForm = document.getElementById('login');
        const signupForm = document.getElementById('signup');

       

        // Animation for car driving across the screen
        window.addEventListener('load', () => {
            const car = document.getElementById('animatedCar');
            setTimeout(() => {
                car.style.left = '100%';
            }, 500);
        });

        // Highlight active page
        const currentPage = window.location.hash || '#home';
        document.querySelector(`nav a[href="${currentPage}"]`).classList.add('active');
		 // Chatbot functionality
        const chatbotButton = document.getElementById('chatbot-button');
        const chatbotContainer = document.getElementById('chatbot-container');
        const chatbotMessages = document.getElementById('chatbot-messages');
        const chatbotInput = document.getElementById('chatbot-message-input');
        const chatbotSendButton = document.getElementById('chatbot-send-button');

        let isChatbotOpen = false;

        chatbotButton.addEventListener('click', () => {
            if (!isChatbotOpen) {
                chatbotContainer.style.display = 'flex';
                chatbotContainer.classList.remove('animateDown');
                chatbotContainer.classList.add('animateUp');
                isChatbotOpen = true;
            } else {
                chatbotContainer.classList.remove('animateUp');
                chatbotContainer.classList.add('animateDown');
                chatbotContainer.addEventListener('animationend', () => {
                    if (!isChatbotOpen) {
                        chatbotContainer.style.display = 'none';
                    }
                }, {once: true});
                isChatbotOpen = false;
            }
        });
        function addMessage(message, isUser = false) {
            const messageElement = document.createElement('div');
            messageElement.textContent = message;
            messageElement.style.marginBottom = '10px';
            messageElement.style.padding = '5px 10px';
            messageElement.style.borderRadius = '5px';
            messageElement.style.maxWidth = '80%';
            messageElement.style.alignSelf = isUser ? 'flex-end' : 'flex-start';
            messageElement.style.backgroundColor = isUser ? '#e6f3ff' : '#f0f0f0';
            chatbotMessages.appendChild(messageElement);
            chatbotMessages.scrollTop = chatbotMessages.scrollHeight;
        }

        function handleUserMessage(message) {
            addMessage(message, true);
            // Simple bot response logic
            let botResponse = "I'm sorry, I don't have an answer for that. Is there anything else I can help you with?";
            if (message.toLowerCase().includes('hello') || message.toLowerCase().includes('hi')) {
                botResponse = "Hello! How can I assist you with our car rental service today?";
            } else if (message.toLowerCase().includes('car') && message.toLowerCase().includes('rent')) {
                botResponse = "Great! We have a variety of cars available for rent. You can check our 'Our Cars' page for more information or ask me about specific types of vehicles.";
            } else if (message.toLowerCase().includes('price') || message.toLowerCase().includes('cost')) {
                botResponse = "Our rental prices vary depending on the car model and rental duration. Can you tell me which car you're interested in and for how long?";
            }
            setTimeout(() => addMessage(botResponse), 500);
        }

        chatbotSendButton.addEventListener('click', () => {
            const message = chatbotInput.value.trim();
            if (message) {
                handleUserMessage(message);
                chatbotInput.value = '';
            }
        });

        chatbotInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') {
                const message = chatbotInput.value.trim();
                if (message) {
                    handleUserMessage(message);
                    chatbotInput.value = '';
                }
            }
        });

        // Initial bot message
        setTimeout(() => addMessage("Hello! How can I help you with our car rental service today?"), 1000);
		
    
    </script>
</body>
</html>

