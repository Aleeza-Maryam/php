<?php
// ─────────────────────────────────────
//  SESSION START — must be first line
// ─────────────────────────────────────
session_start();

// ── Session Guard: redirect if not logged in ──
if (!isset($_SESSION['name'])) {
    header("Location: login.php");
    exit();
}

// ── Visit Counter: increment on every page load ──
if (!isset($_SESSION['visits'])) {
    $_SESSION['visits'] = 0;
}
$_SESSION['visits']++;

// ── Grab session data ──
$traveler_name = $_SESSION['name'];
$visit_count   = $_SESSION['visits'];

// ── Static dummy bookings ──
$bookings = [
    [
        'ref'         => 'TR1714001111',
        'destination' => 'Lahore',
        'date'        => '10 May, 2025',
        'travelers'   => 2,
        'total'       => 'Rs. 10,000',
    ],
    [
        'ref'         => 'TR1714002222',
        'destination' => 'Swat',
        'date'        => '20 Jun, 2025',
        'travelers'   => 5,
        'total'       => 'Rs. 40,500',
    ],
    [
        'ref'         => 'TR1714003333',
        'destination' => 'Murree',
        'date'        => '15 Jul, 2025',
        'travelers'   => 3,
        'total'       => 'Rs. 21,000',
    ],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>My Bookings - Destination Travel</title>
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@600;700&family=Jost:wght@400;500;600&display=swap" rel="stylesheet"/>

  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    :root {
      --green-dark:  #1b5e20;
      --green-mid:   #2e7d32;
      --green-light: #a5d6a7;
      --green-pale:  #e8f5e9;
      --text:        #1a2e1a;
      --muted:       #4a7c59;
    }

    body {
      font-family: 'Jost', sans-serif;
      background: #f0f4f0;
      background-image:
        radial-gradient(ellipse at 15% 15%, rgba(34,139,34,.11) 0%, transparent 55%),
        radial-gradient(ellipse at 85% 85%, rgba(0,100,0,.09) 0%, transparent 55%);
      min-height: 100vh;
      color: var(--text);
      padding-bottom: 60px;
    }

    /* ── Top Navbar ── */
    .navbar {
      background: var(--green-dark);
      color: #fff;
      padding: 16px 40px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      box-shadow: 0 2px 12px rgba(0,0,0,.2);
    }
    .navbar .brand {
      font-family: 'Cormorant Garamond', serif;
      font-size: 1.5rem;
      letter-spacing: 0.5px;
    }
    .navbar .brand span { opacity: 0.75; font-size: 1rem; margin-left: 6px; }
    .navbar .nav-right {
      display: flex;
      align-items: center;
      gap: 16px;
      font-size: 0.88rem;
    }
    .navbar .user-chip {
      background: rgba(255,255,255,.15);
      border-radius: 20px;
      padding: 6px 14px;
      font-weight: 600;
    }
    .btn-logout {
      background: #fff;
      color: var(--green-dark);
      text-decoration: none;
      padding: 7px 16px;
      border-radius: 8px;
      font-weight: 600;
      font-size: 0.88rem;
      transition: background 0.2s;
    }
    .btn-logout:hover { background: #f1f1f1; }

    /* ── Page Content ── */
    .page-wrap {
      max-width: 780px;
      margin: 40px auto;
      padding: 0 20px;
    }

    /* ── Welcome Card ── */
    .welcome-card {
      background: #fff;
      border-radius: 16px;
      padding: 28px 32px;
      box-shadow: 0 6px 24px rgba(27,94,32,.12);
      margin-bottom: 28px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      flex-wrap: wrap;
      gap: 16px;
      animation: fadeUp 0.4s ease both;
    }

    @keyframes fadeUp {
      from { opacity: 0; transform: translateY(18px); }
      to   { opacity: 1; transform: translateY(0); }
    }

    .welcome-card .greet h2 {
      font-family: 'Cormorant Garamond', serif;
      font-size: 1.7rem;
      color: var(--green-dark);
    }
    .welcome-card .greet p { color: var(--muted); margin-top: 4px; font-size: 0.92rem; }

    .visit-badge {
      background: var(--green-pale);
      border: 1.5px solid var(--green-light);
      border-radius: 12px;
      padding: 10px 18px;
      text-align: center;
    }
    .visit-badge .count {
      font-size: 1.6rem;
      font-weight: 700;
      color: var(--green-dark);
      line-height: 1;
    }
    .visit-badge .label { font-size: 0.78rem; color: var(--muted); margin-top: 3px; }

    /* ── Section Title ── */
    .section-title {
      font-family: 'Cormorant Garamond', serif;
      font-size: 1.35rem;
      color: var(--green-dark);
      margin-bottom: 14px;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    /* ── Bookings Table ── */
    .table-wrap {
      background: #fff;
      border-radius: 16px;
      overflow: hidden;
      box-shadow: 0 6px 24px rgba(27,94,32,.12);
      animation: fadeUp 0.5s ease 0.1s both;
    }

    .bookings-table {
      width: 100%;
      border-collapse: collapse;
      font-size: 0.92rem;
    }

    .bookings-table thead tr {
      background: var(--green-mid);
    }
    .bookings-table th {
      color: #fff;
      padding: 13px 16px;
      text-align: left;
      font-weight: 600;
      border: 1px solid #256029;
      letter-spacing: 0.3px;
    }
    .bookings-table td {
      padding: 12px 16px;
      border: 1px solid #c8e6c9;
      color: var(--text);
    }
    .bookings-table tr:nth-child(even) td { background: #f1f8f1; }
    .bookings-table tr:hover td {
      background: var(--green-pale);
      transition: background 0.15s;
    }

    .ref-code {
      font-family: monospace;
      font-size: 0.82rem;
      background: var(--green-pale);
      color: var(--green-dark);
      padding: 3px 7px;
      border-radius: 5px;
      font-weight: 600;
    }

    .total-cell { font-weight: 700; color: var(--green-dark); }

    /* ── Session Info Strip ── */
    .session-strip {
      background: var(--green-dark);
      color: #fff;
      border-radius: 12px;
      padding: 14px 20px;
      margin-top: 24px;
      font-size: 0.88rem;
      display: flex;
      align-items: center;
      gap: 10px;
      animation: fadeUp 0.5s ease 0.2s both;
    }
  </style>
</head>
<body>

  <!-- ── Navbar ── -->
  <nav class="navbar">
    <div class="brand">✈️ Destination Travel <span>Dashboard</span></div>
    <div class="nav-right">
      <div class="user-chip">👤 <?php echo htmlspecialchars($traveler_name); ?></div>
      <a href="logout.php" class="btn-logout">Logout →</a>
    </div>
  </nav>

  <div class="page-wrap">

    <!-- ── Welcome Card ── -->
    <div class="welcome-card">
      <div class="greet">
        <h2>Welcome back, <?php echo htmlspecialchars($traveler_name); ?>! 🌟</h2>
        <p>Here are your upcoming trip bookings managed in this session.</p>
      </div>
      <div class="visit-badge">
        <div class="count"><?php echo $visit_count; ?></div>
        <div class="label">
          Visited <?php echo $visit_count; ?> time<?php echo ($visit_count !== 1) ? 's' : ''; ?> this session
        </div>
      </div>
    </div>

    <!-- ── Bookings Table ── -->
    <div class="section-title">🧳 My Bookings</div>
    <div class="table-wrap">
      <table class="bookings-table">
        <thead>
          <tr>
            <th>Ref No.</th>
            <th>Destination</th>
            <th>Date</th>
            <th>Travelers</th>
            <th>Total</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($bookings as $b): ?>
          <tr>
            <td><span class="ref-code"><?php echo $b['ref']; ?></span></td>
            <td><?php echo $b['destination']; ?></td>
            <td><?php echo $b['date']; ?></td>
            <td><?php echo $b['travelers']; ?></td>
            <td class="total-cell"><?php echo $b['total']; ?></td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>

    <!-- ── Session Debug Strip ── -->
    <div class="session-strip">
      🔐 Session active &nbsp;|&nbsp;
      User: <strong><?php echo htmlspecialchars($traveler_name); ?></strong> &nbsp;|&nbsp;
      Page visits this session: <strong><?php echo $visit_count; ?></strong> &nbsp;|&nbsp;
      Session ID: <code style="font-size:0.78rem; opacity:0.75"><?php echo session_id(); ?></code>
    </div>

  </div>

</body>
</html>