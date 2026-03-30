<?php
// Check if already authenticated via JWT cookie
if (isset($_COOKIE['token'])) {
    header('Location: dashboard.php');
    exit;
}

$error = '';
if (isset($_GET['error'])) {
    $error = htmlspecialchars($_GET['error']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - NU Clark FMS</title>
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
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .container {
            width: 100%;
            max-width: 650px;
        }

        .card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(0, 0, 0, 0.06);
            overflow: hidden;
        }

        .card-body {
            padding: 2rem;
        }

        .text-center {
            text-align: center;
        }

        .mb-4 {
            margin-bottom: 1.5rem;
        }

        .mb-3 {
            margin-bottom: 1rem;
        }

        h3 {
            color: #003366;
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0.25rem;
        }

        .text-muted {
            color: #6c757d;
            font-size: 0.95rem;
        }

        .alert {
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 1rem;
            font-size: 0.9rem;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #842029;
            border: 1px solid #f5c2c7;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-label {
            display: block;
            font-weight: 600;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 0.5rem;
            color: #495057;
        }

        .form-control {
            width: 100%;
            padding: 12px 16px;
            font-size: 1rem;
            border: 1px solid rgba(0, 0, 0, 0.15);
            border-radius: 8px;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
            font-family: inherit;
        }

        .form-control:focus {
            outline: none;
            border-color: #003366;
            box-shadow: 0 0 0 3px rgba(0, 51, 102, 0.15);
        }

        .row {
            display: flex;
            gap: 1rem;
            margin-left: -0.5rem;
            margin-right: -0.5rem;
        }

        .col {
            flex: 1;
            padding-left: 0.5rem;
            padding-right: 0.5rem;
        }

        .btn {
            display: inline-block;
            padding: 12px 24px;
            font-size: 1rem;
            font-weight: 500;
            text-align: center;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s ease;
            font-family: inherit;
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

        .w-100 {
            width: 100%;
        }

        hr {
            border: none;
            border-top: 1px solid rgba(0, 0, 0, 0.1);
            margin: 1.5rem 0;
        }

        .mb-0 {
            margin-bottom: 0;
        }

        .form-check {
            display: flex;
            align-items: flex-start;
            gap: 0.5rem;
            margin-top: 1rem;
            margin-bottom: 1rem;
        }

        .form-check-input {
            width: 16px;
            height: 16px;
            margin-top: 2px;
            cursor: pointer;
        }

        .form-check-label {
            font-size: 0.9rem;
            color: #495057;
            cursor: pointer;
        }

        .text-decoration-none {
            text-decoration: none;
            color: #003366;
        }

        .text-decoration-none:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="text-center mb-4">
                    <h3>NU Clark FMS</h3>
                    <p class="text-muted">Create your account</p>
                </div>

                <?php if ($error): ?>
                <div class="alert alert-danger">
                    <?php echo $error; ?>
                </div>
                <?php endif; ?>

                <form method="POST" action="backend/register_handler.php">
                    <div class="form-group">
                        <label class="form-label" for="full_name">Full Name</label>
                        <input type="text" id="full_name" name="full_name" class="form-control" placeholder="Enter your full name" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="email">Email Address</label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email" required>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label" for="password">Password</label>
                                <input type="password" id="password" name="password" class="form-control" placeholder="Create password" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label" for="confirm_password">Confirm Password</label>
                                <input type="password" id="confirm_password" name="confirm_password" class="form-control" placeholder="Confirm password" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-check">
                        <input type="checkbox" id="terms" name="terms" class="form-check-input" required>
                        <label for="terms" class="form-check-label">I agree to the Terms of Service and Privacy Policy</label>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Create Account</button>
                </form>

                <hr>

                <p class="text-center mb-0 text-muted">
                    Already have an account? <a href="login.php" class="text-decoration-none">Sign in</a>
                </p>
            </div>
        </div>
    </div>
</body>
</html>
