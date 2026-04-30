<?php

session_start();

if (isset($_SESSION['name'])) {
    header("Location: mybookings.php");
    exit();
}

require 'db.php'; 


$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    
    $input_user = trim($_POST['username'] ?? '');
    $input_pass = trim($_POST['password'] ?? '');

    
    if ($input_user === '' || $input_pass === '') {
        $error = "Username aur Password dono zaroori hain.";
    } else {

    
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username LIMIT 1");
        $stmt->execute([':username' => $input_user]);
        $user = $stmt->fetch(); 

        
        if ($user && $user['password'] === $input_pass) {

          
            $_SESSION['name']     = $user['name'];      
            $_SESSION['username'] = $user['username'];  
            $_SESSION['visits']   = 0;                

       
            session_regenerate_id(true);

            
            header("Location: mybookings.php");
            exit();

        } else {
            
            $error = "Incorrect username or password.";
        }
    }
}


$show_logout_banner = (isset($_GET['msg']) && $_GET['msg'] === 'bye');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Traveler Login - Destination Travel</title>
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@600;700&family=Jost:wght@400;500;600&display=swap" rel="stylesheet"/>

  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    body {
      font-family: 'Jost', sans-serif;
      background: #0d1f0f;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 24px 16px;
      position: relative;
      overflow: hidden;
    }

    body::before, body::after {
      content: '';
      position: absolute;
      border-radius: 50%;
      filter: blur(80px);
      opacity: 0.25;
      pointer-events: none;
    }
    body::before { width:500px; height:500px; background:#2e7d32; top:-120px; left:-100px; }
    body::after  { width:400px; height:400px; background:#1b5e20; bottom:-100px; right:-80px; }

    .login-card {
      background: #fff;
      max-width: 440px;
      width: 100%;
      border-radius: 20px;
      padding: 44px 40px;
      box-shadow: 0 24px 60px rgba(0,0,0,.45);
      position: relative;
      z-index: 1;
      animation: fadeUp 0.5s ease both;
    }

    @keyframes fadeUp {
      from { opacity:0; transform:translateY(24px); }
      to   { opacity:1; transform:translateY(0); }
    }

    .brand { text-align:center; margin-bottom:30px; }
    .brand .icon { font-size:2.4rem; display:block; margin-bottom:8px; }
    .brand h1 {
      font-family: 'Cormorant Garamond', serif;
      font-size: 2rem;
      color: #1b5e20;
    }
    .brand p { color:#4a7c59; font-size:0.88rem; margin-top:5px; }

    /* Banners */
    .banner {
      border-radius: 10px;
      padding: 12px 16px;
      font-size: 0.90rem;
      font-weight: 600;
      margin-bottom: 20px;
      display: flex;
      align-items: center;
      gap: 8px;
    }
    .banner-success { background:#e8f5e9; border:1.5px solid #81c784; color:#1b5e20; }
    .banner-error   { background:#fff5f5; border:1.5px solid #f44336; color:#c62828; }

    /* Form */
    .form-group { margin-bottom: 18px; }

    label {
      display: block;
      font-weight: 600;
      font-size: 0.85rem;
      color: #1a2e1a;
      margin-bottom: 7px;
    }

    input[type="text"],
    input[type="password"] {
      width: 100%;
      padding: 12px 14px;
      border: 1.5px solid #c8e6c9;
      border-radius: 9px;
      font-family: 'Jost', sans-serif;
      font-size: 0.95rem;
      color: #1a2e1a;
      background: #f9fdf9;
      outline: none;
      transition: border-color 0.2s, box-shadow 0.2s;
    }
    input:focus {
      border-color: #2e7d32;
      box-shadow: 0 0 0 3px rgba(46,125,50,.15);
      background: #fff;
    }

    .btn-login {
      width: 100%;
      background: #2e7d32;
      color: #fff;
      border: none;
      padding: 13px;
      border-radius: 9px;
      font-family: 'Jost', sans-serif;
      font-size: 1rem;
      font-weight: 600;
      cursor: pointer;
      margin-top: 6px;
      transition: background 0.2s, transform 0.1s;
    }
    .btn-login:hover  { background: #1b5e20; }
    .btn-login:active { transform: scale(0.98); }

    .hint-box {
      margin-top: 24px;
      background: #e8f5e9;
      border-radius: 10px;
      padding: 14px 16px;
      font-size: 0.82rem;
      color: #4a7c59;
    }
    .hint-box strong { color:#1b5e20; display:block; margin-bottom:6px; }
    .hint-box code {
      background:#fff;
      border:1px solid #a5d6a7;
      border-radius:5px;
      padding:2px 7px;
      font-size:0.81rem;
      color:#1b5e20;
    }
    .hint-row { margin-top:5px; }
  </style>
</head>
<body>

<div class="login-card">

  <div class="brand">
    <span class="icon">✈️</span>
    <h1>Destination Travel</h1>
    <p>Sign in to manage your bookings</p>
  </div>

  <!-- ✅ Logout success banner -->
  <?php if ($show_logout_banner): ?>
  <div class="banner banner-success">✅ Logged out successfully. See you again!</div>
  <?php endif; ?>

  <!-- ❌ Error banner -->
  <?php if ($error !== ''): ?>
  <div class="banner banner-error">⚠️ <?php echo htmlspecialchars($error); ?></div>
  <?php endif; ?>

  <!-- Login Form -->
  <form action="login.php" method="POST">

    <div class="form-group">
      <label for="username">Username</label>
      <input type="text" id="username" name="username"
             placeholder="Enter your username" required
             value="<?php echo htmlspecialchars($_POST['username'] ?? ''); ?>"/>
    </div>

    <div class="form-group">
      <label for="password">Password</label>
      <input type="password" id="password" name="password"
             placeholder="Enter your password" required/>
    </div>

    <button type="submit" class="btn-login">Login →</button>

  </form>

  

</div>

</body>
</html>