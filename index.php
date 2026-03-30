<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NU Clark FMS - Facilities Management System</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, #003366 0%, #001a33 100%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
        }

        .logo-container {
            margin-bottom: 2rem;
        }

        .logo-container img {
            width: 120px;
            height: 120px;
            object-fit: contain;
        }

        .logo-placeholder {
            width: 120px;
            height: 120px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            color: #FFD700;
        }

        h1 {
            font-size: 1.8rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .subtitle {
            font-size: 1rem;
            color: rgba(255, 255, 255, 0.6);
            margin-bottom: 2.5rem;
        }

        .button-group {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            width: 100%;
            max-width: 280px;
        }

        .btn {
            padding: 14px 28px;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 500;
            text-decoration: none;
            text-align: center;
            transition: all 0.2s ease;
            border: none;
            cursor: pointer;
        }

        .btn-primary {
            background: linear-gradient(180deg, #004080 0%, #003366 100%);
            background-color: #003366;
            color: white;
            box-shadow: 0 2px 4px rgba(0, 51, 102, 0.2);
        }

        .btn-primary:hover {
            background: linear-gradient(180deg, #0059b3 0%, #002244 100%);
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(0, 51, 102, 0.3);
        }

        .btn-outline {
            background: transparent;
            color: white;
            border: 2px solid rgba(255, 255, 255, 0.4);
        }

        .btn-outline:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: rgba(255, 255, 255, 0.6);
        }

        .footer {
            position: absolute;
            bottom: 2rem;
            font-size: 0.8rem;
            color: rgba(255, 255, 255, 0.4);
        }
    </style>
</head>
<body>
    <div class="logo-container">
        <div class="logo-placeholder">NU</div>
    </div>

    <h1>NU Clark</h1>
    <p class="subtitle">Facilities Management System</p>

    <div class="button-group">
        <a href="register.php" class="btn btn-primary">Get Started</a>
        <a href="login.php" class="btn btn-outline">Login</a>
    </div>

    <div class="footer">
        &copy; <?php echo date('Y'); ?> NU Clark FMS
    </div>
</body>
</html>
