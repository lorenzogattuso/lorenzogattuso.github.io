<?php
session_start();

$correct_username = 'admin';
$correct_password = 'admin';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username === $correct_username && $password === $correct_password) {
        $_SESSION['loggedin'] = true;
        header('Location: upload.html');
        exit();
    } else {
        $login_error = 'Invalid username or password';
    }
}

if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: resources.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resources</title>
    <link rel="stylesheet" href="styles/style.css">
    <link rel="icon" type="image/x-icon" href="icon/files.svg">
    <style>
        body {
            margin: 0;
            font-family: 'Arial', sans-serif;
            background: url('background.jpg') no-repeat center center fixed;
            background-size: cover;
            color: #333;
            transition: background-color 0.3s, color 0.3s;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(14px);
            z-index: -1;
        }

        body.dark-mode::before {
            background: rgba(0, 0, 0, 0.8);
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        header {
            background-color: transparent;
            padding: 10px 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .menu-icon {
            display: none;
        }

        .nav-links a {
            margin: 0 10px;
            text-decoration: none;
            color: #333;
            transition: color 0.3s;
        }

        .nav-links .active {
            font-weight: bold;
            color: #d0a0a0;
        }

        .contact-switch {
            display: flex;
            align-items: center;
        }

        .contact-switch span {
            margin-right: 10px;
            font-size: 14px;
        }

        .switch {
            position: relative;
            display: inline-block;
            width: 34px;
            height: 20px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: .4s;
            border-radius: 34px;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 12px;
            width: 12px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
        }

        input:checked + .slider {
            background-color: #2196F3;
        }

        input:checked + .slider:before {
            transform: translateX(14px);
        }

        .Home {
            margin-top: 20px;
        }

        .Home h1 {
            font-size: 2.5em;
            margin-bottom: 10px;
        }

        .categories {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 20px;
        }

        .categories button {
            background-color: #e0e0e0;
            border: none;
            padding: 10px 20px;
            border-radius: 20px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s;
        }

        .categories button.active {
            background-color: #d0a0a0;
        }

        .resources-section {
            display: flex;
            gap: 20px;
        }

        .resources {
            flex: 3;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .resource-item {
            display: flex;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #ccc;
        }

        .resource-item img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 8px;
            margin-right: 20px;
        }

        .resource-item .description {
            flex: 1;
        }

        .resource-item .download-btn {
            padding: 10px 20px;
            border: none;
            background-color: #007bff;
            color: #fff;
            border-radius: 4px;
            cursor: pointer;
        }

        .sidebar {
            flex: 1;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            position: sticky;
            top: 20px;
            height: fit-content;
        }

        .sidebar h2 {
            margin-top: 0;
        }

        .sidebar input[type="text"],
        .sidebar input[type="password"],
        .sidebar input[type="submit"] {
            width: calc(100% - 40px);
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }

        /* Dark mode styles */
        body.dark-mode {
            background-color: #121212;
            color: #eee;
        }

        body.dark-mode .nav-links a,
        body.dark-mode .nav-links .active {
            color: #eee;
        }

        body.dark-mode .categories button {
            background-color: #444;
            color: #eee;
        }

        body.dark-mode .categories button.active {
            background-color: #d0a0a0;
            color: #121212;
        }

        body.dark-mode .resources,
        body.dark-mode .sidebar {
            background-color: #333;
            color: #eee;
            box-shadow: none;
        }

        body.dark-mode .sidebar input[type="text"],
        body.dark-mode .sidebar input[type="password"],
        body.dark-mode .sidebar input[type="submit"] {
            border: 1px solid #666;
            background-color: #555;
            color: #fff;
        }

        body.dark-mode .resource-item {
            border-bottom: 1px solid #666;
        }

        /* Responsive styles */
        @media (max-width: 1200px) {
            .resources-section {
                flex-direction: column;
            }

            .sidebar {
                position: static;
                margin-top: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <nav>
            <div class="logo">
                    <img src="Logo privacy news.png" alt="Logo">
                </div>
                <div class="menu-icon">&#9776;</div>
                <div class="nav-links">
                    <a href="index.html">Home</a>
                    <a href="resources.php" class="active">Resources</a>
                    <a href="ContactUS.html">Contact us</a>
                </div>
                <div class="contact-switch">
                    <label class="switch">
                        <input type="checkbox" id="themeToggle">
                        <span class="slider round"></span>
                    </label>
                </div>
            </nav>
        </header>
        <div class="resources-section">
            <div class="resources">
                <h1>Available Resources</h1>
                <ul class="file-list">
                    <?php
                    $directory = 'uploads/';
                    $files = scandir($directory);

                    foreach($files as $file) {
                        if ($file !== '.' && $file !== '..') {
                            echo '<li class="resource-item">';
                            echo '<div class="description">';
                            echo '<h3>' . $file . '</h3>';
                            echo '</div>';
                            echo '<a href="' . $directory . $file . '" download class="download-btn">Download</a>';
                            echo '</li>';
                        }
                    }
                    ?>
                </ul>
            </div>
            <div class="sidebar">
                <h2>Admin Login</h2>
                <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
                    <p>Welcome, admin!</p>
                    <p><a href="?logout">Logout</a></p>
                <?php else: ?>
                    <?php if (isset($login_error)): ?>
                        <p style="color: red;"><?php echo $login_error; ?></p>
                    <?php endif; ?>
                    <form action="resources.php" method="post">
                        <input type="text" name="username" placeholder="Username" required>
                        <input type="password" name="password" placeholder="Password" required>
                        <input type="submit" value="Login">
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <script>
        const toggle = document.getElementById('themeToggle');
        toggle.addEventListener('change', () => {
            document.body.classList.toggle('dark-mode');
        });
        document.addEventListener("DOMContentLoaded", function() {
            const path = window.location.pathname;
            const currentPage = path.split("/").pop().split(".")[0];
            const buttons = document.querySelectorAll(".categories button");
            
            buttons.forEach(button => {
                button.addEventListener("click", () => {
                    buttons.forEach(btn => btn.classList.remove("active"));
                    button.classList.add("active");
                });
            });

            const setActiveButton = () => {
                buttons.forEach(btn => btn.classList.remove("active"));
                const currentButton = document.getElementById(currentPage);
                if (currentButton) {
                    currentButton.classList.add("active");
                }
            };

            setActiveButton();
        });
    </script>
    <script src="darkmode.js"></script>
</body>
</html>
