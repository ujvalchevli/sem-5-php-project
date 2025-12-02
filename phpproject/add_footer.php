
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .admin-footer {
            background-color: #2c3e50;
            color: #ecf0f1;
            padding: 15px 30px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            font-size: 14px;
            margin-left: 250px;

        }

        .footer-left {
            display: flex;
            align-items: center;
        }

        .copyright {
            margin-right: 15px;
        }

        .version {
            background-color: #34495e;
            padding: 2px 8px;
            border-radius: 4px;
            font-size: 12px;
        }

        .footer-right {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            margin-top: 10px;
            gap: 10px;
        }

        .footer-links a {
            color: #ecf0f1;
            margin-right: 15px;
            text-decoration: none;
        }

        .footer-links a:hover {
            text-decoration: underline;
        }

        .social-icons a {
            color: #ecf0f1;
            margin-left: 10px;
            text-decoration: none;
            font-size: 16px;
        }

        .social-icons a:hover {
            color: #3498db;
        }
    </style>
</head>

<body>
    <footer class="admin-footer">
        <div class="footer-left">
            <div class="copyright">
                &copy; 2023 Music Admin Dashboard. All rights reserved.
            </div>
            <span class="version">v2.1.0</span>
        </div>

        <div class="footer-right">
            <div class="footer-links">
                <a href="#">Help Center</a>
                <a href="#">Privacy Policy</a>
                <a href="#">Terms of Service</a>
            </div>

            <div class="social-icons">
                <a href="#"><i class="fab fa-facebook"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </footer>
</body>

</html>