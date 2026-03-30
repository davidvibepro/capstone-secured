<?php
require_once 'config/db.php';
$token = $_COOKIE['token'] ?? '';
if (!$token) {
    header('Location: login.php');
    exit;
}
$payload = verify_jwt($token);
if (!$payload) {
    header('Location: login.php');
    exit;
}
$email = $payload['email'];
if (isset($_GET['logout'])) {
    setcookie('token', '', time() - 3600, '/');
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - NU Clark FMS</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: #f8f9fa;
            min-height: 100vh;
        }

        .navbar {
            background: linear-gradient(180deg, #004080 0%, #003366 100%);
            background-color: #003366;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 4px rgba(0, 51, 102, 0.2);
        }

        .navbar-brand {
            color: white;
            font-size: 1.25rem;
            font-weight: 600;
            text-decoration: none;
        }

        .navbar-text {
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.9rem;
        }

        .btn-logout {
            background: transparent;
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.4);
            padding: 8px 16px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 0.9rem;
            transition: all 0.2s ease;
        }

        .btn-logout:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: rgba(255, 255, 255, 0.6);
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }

        .page-header {
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
            padding-bottom: 1rem;
            margin-bottom: 1.5rem;
        }

        .page-header h4 {
            color: #003366;
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0.25rem;
        }

        .text-muted {
            color: #6c757d;
        }

        .card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(0, 0, 0, 0.06);
            overflow: hidden;
            margin-bottom: 1.5rem;
        }

        .card-header {
            background: white;
            padding: 1.25rem;
            border-bottom: 1px solid rgba(0, 0, 0, 0.06);
        }

        .card-header h5 {
            margin: 0;
            color: #003366;
            font-size: 1.1rem;
            font-weight: 600;
        }

        .card-body {
            padding: 1.5rem;
        }

        .welcome-message {
            font-size: 1.1rem;
            color: #495057;
            line-height: 1.6;
        }

        .welcome-message strong {
            color: #003366;
        }

        .row {
            display: flex;
            gap: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .col {
            flex: 1;
        }

        .col-8 {
            flex: 2;
        }

        .col-4 {
            flex: 1;
        }

        .stat-card {
            display: flex;
            align-items: center;
            padding: 1.5rem;
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(0, 0, 0, 0.06);
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-right: 1rem;
        }

        .stat-icon.blue {
            background: rgba(0, 51, 102, 0.1);
            color: #003366;
        }

        .stat-icon.green {
            background: rgba(25, 135, 84, 0.1);
            color: #198754;
        }

        .stat-icon.red {
            background: rgba(220, 53, 69, 0.1);
            color: #dc3545;
        }

        .stat-icon.yellow {
            background: rgba(255, 193, 7, 0.1);
            color: #ffc107;
        }

        .stat-content h3 {
            font-size: 1.75rem;
            font-weight: 700;
            color: #212529;
            margin-bottom: 0.25rem;
        }

        .stat-content p {
            color: #6c757d;
            font-size: 0.9rem;
            margin: 0;
        }

        .quick-actions {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
        }

        .quick-action-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
            border: 1px solid rgba(0, 51, 102, 0.2);
            border-radius: 8px;
            text-decoration: none;
            color: #003366;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .quick-action-btn:hover {
            background: rgba(0, 51, 102, 0.05);
            border-color: #003366;
        }

        @media (max-width: 768px) {
            .row {
                flex-direction: column;
            }
            
            .quick-actions {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <a href="dashboard.php" class="navbar-brand">NU Clark FMS</a>
        <div style="display: flex; align-items: center; gap: 1rem;">
            <span class="navbar-text">Welcome, <?php echo htmlspecialchars($email); ?></span>
            <a href="?logout=1" class="btn-logout">Logout</a>
        </div>
    </nav>

    <div class="container">
        <div class="page-header">
            <h4>Dashboard</h4>
            <p class="text-muted">Welcome back! Here's what's happening today.</p>
        </div>

        <div class="row">
            <div class="col">
                <div class="stat-card">
                    <div class="stat-icon blue">
                        <span>&#128197;</span>
                    </div>
                    <div class="stat-content">
                        <h3>0</h3>
                        <p>Reservations</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="stat-card">
                    <div class="stat-icon red">
                        <span>&#128295;</span>
                    </div>
                    <div class="stat-content">
                        <h3>0</h3>
                        <p>Maintenance</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="stat-card">
                    <div class="stat-icon green">
                        <span>&#127969;</span>
                    </div>
                    <div class="stat-content">
                        <h3>0</h3>
                        <p>Facilities</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-8">
                <div class="card">
                    <div class="card-header">
                        <h5>Upcoming Reservations</h5>
                    </div>
                    <div class="card-body">
                        <p class="text-muted">No upcoming reservations.</p>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card">
                    <div class="card-header">
                        <h5>Quick Actions</h5>
                    </div>
                    <div class="card-body">
                        <div class="quick-actions">
                            <a href="#" class="quick-action-btn">New Reservation</a>
                            <a href="#" class="quick-action-btn">View Facilities</a>
                            <a href="#" class="quick-action-btn">Report Issue</a>
                            <a href="#" class="quick-action-btn">Check Resources</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
