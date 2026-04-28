<?php
// ─────────────────────────────────────────────
//  STEP 1: Receive POST Data
// ─────────────────────────────────────────────
$traveler_name  = $_POST['traveler_name']  ?? '';
$email          = $_POST['email']          ?? '';
$destination    = $_POST['destination']    ?? '';
$departure_date = $_POST['departure_date'] ?? '';
$num_travelers  = $_POST['num_travelers']  ?? '';
$trip_type      = $_POST['trip_type']      ?? '';

// ─────────────────────────────────────────────
//  STEP 2: Validation
// ─────────────────────────────────────────────
$errors = [];

if (trim($traveler_name) === '')  $errors[] = "Traveler Name is required.";
if (trim($email) === '')          $errors[] = "Email Address is required.";
elseif (!filter_var(trim($email), FILTER_VALIDATE_EMAIL))
                                  $errors[] = "Email Address is not valid.";
if (trim($destination) === '')    $errors[] = "Destination is required.";
if (trim($departure_date) === '') $errors[] = "Departure Date is required.";
if (trim($num_travelers) === '' || (int)$num_travelers < 1)
                                  $errors[] = "Number of Travelers must be at least 1.";
if (trim($trip_type) === '')      $errors[] = "Trip Type is required.";

// ─────────────────────────────────────────────
//  STEP 3: Sanitize + Calculate (only if valid)
// ─────────────────────────────────────────────
if (empty($errors)) {
    $traveler_name  = ucwords(trim(htmlspecialchars($traveler_name)));
    $email          = strtolower(trim(htmlspecialchars($email)));
    $destination    = strtoupper(trim(htmlspecialchars($destination)));
    $departure_date = trim(htmlspecialchars($departure_date));
    $num_travelers  = (int)$num_travelers;
    $trip_type      = trim(htmlspecialchars($trip_type));

    // Format date nicely
    $dateObj        = DateTime::createFromFormat('Y-m-d', $departure_date);
    $formatted_date = $dateObj ? $dateObj->format('d F, Y') : $departure_date;

    // ─────────────────────────────────────────
    //  STEP 4: Price Calculation
    // ─────────────────────────────────────────
    $base_prices = [
        'LAHORE'    => 5000,
        'KARACHI'   => 8000,
        'ISLAMABAD' => 6000,
        'MURREE'    => 7000,
        'SWAT'      => 9000,
    ];

    $base_price    = $base_prices[$destination] ?? 0;
    $subtotal      = $base_price * $num_travelers;
    $discount_rate = ($num_travelers >= 5) ? 0.10 : 0;
    $discount_amt  = $subtotal * $discount_rate;
    $final_total   = $subtotal - $discount_amt;

    // Booking reference & timestamp
    $booking_ref = 'TR' . time();
    $booked_on   = date('d M Y, h:i A');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Booking Confirmation – Pakistan Travel</title>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet"/>

  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    body {
      font-family: 'DM Sans', sans-serif;
      background: #f0f4f0;
      background-image:
        radial-gradient(ellipse at 20% 20%, rgba(34,139,34,.12) 0%, transparent 60%),
        radial-gradient(ellipse at 80% 80%, rgba(0,100,0,.10) 0%, transparent 60%);
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      padding: 40px 16px 60px;
      color: #1a2e1a;
    }

    .page-header { text-align: center; margin-bottom: 28px; }
    .page-header h1 {
      font-family: 'Playfair Display', serif;
      font-size: 2rem;
      color: #1b5e20;
    }
    .page-header p { color: #4a7c59; margin-top: 6px; }

    /* ── Card ── */
    .card {
      background: #fff;
      max-width: 560px;
      width: 100%;
      border-radius: 16px;
      padding: 38px 40px;
      box-shadow: 0 8px 32px rgba(27,94,32,.13), 0 2px 8px rgba(0,0,0,.06);
      margin-bottom: 24px;
    }
    .card-title {
      font-family: 'Playfair Display', serif;
      font-size: 1.4rem;
      color: #1b5e20;
      margin-bottom: 20px;
      padding-bottom: 12px;
      border-bottom: 2px solid #e8f5e9;
    }

    /* ── Error Box ── */
    .error-box {
      background: #fff5f5;
      border: 1.5px solid #f44336;
      border-radius: 10px;
      padding: 20px 24px;
      margin-bottom: 20px;
    }
    .error-box h3 {
      color: #c62828;
      font-size: 1rem;
      margin-bottom: 12px;
    }
    .error-box ul { list-style: none; padding: 0; }
    .error-box ul li {
      color: #c62828;
      font-size: 0.91rem;
      padding: 5px 0 5px 22px;
      position: relative;
    }
    .error-box ul li::before {
      content: "✖";
      position: absolute;
      left: 0;
      font-size: 0.75rem;
      top: 6px;
    }
    .go-back {
      display: inline-block;
      margin-top: 16px;
      background: #c62828;
      color: #fff;
      text-decoration: none;
      padding: 10px 22px;
      border-radius: 8px;
      font-weight: 600;
      font-size: 0.93rem;
      transition: background 0.2s;
    }
    .go-back:hover { background: #b71c1c; }

    /* ── Summary Table ── */
    .summary-table {
      width: 100%;
      border-collapse: collapse;
      font-size: 0.93rem;
    }
    .summary-table th {
      background: #2e7d32;
      color: #fff;
      padding: 11px 14px;
      text-align: left;
      font-weight: 600;
      border: 1px solid #256029;
    }
    .summary-table td {
      padding: 10px 14px;
      border: 1px solid #c8e6c9;
    }
    .summary-table tr:nth-child(even) td { background: #f1f8f1; }
    .summary-table .label-col { font-weight: 600; color: #2e4d2e; width: 45%; }

    /* ── Price Table ── */
    .price-table {
      width: 100%;
      border-collapse: collapse;
      font-size: 0.93rem;
    }
    .price-table td { padding: 10px 14px; border: 1px solid #c8e6c9; }
    .price-table tr:nth-child(even) td { background: #f1f8f1; }
    .price-table .label-col { font-weight: 600; color: #2e4d2e; width: 55%; }
    .price-table .discount-row td { color: #e65100; font-weight: 600; }
    .price-table .total-row td {
      background: #1b5e20 !important;
      color: #fff;
      font-weight: 700;
      font-size: 1rem;
    }

    /* ── Reference Banner ── */
    .ref-banner {
      background: linear-gradient(135deg, #1b5e20 0%, #2e7d32 100%);
      color: #fff;
      border-radius: 12px;
      padding: 20px 24px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
      gap: 10px;
      margin-top: 20px;
    }
    .ref-label { font-size: 0.80rem; opacity: 0.8; margin-bottom: 3px; }
    .ref-value { font-size: 1.05rem; font-weight: 700; letter-spacing: 1px; }

    .success-icon { font-size: 2.8rem; text-align: center; margin-bottom: 10px; }

    .back-link {
      display: inline-block;
      margin-top: 4px;
      color: #2e7d32;
      text-decoration: none;
      font-weight: 600;
      font-size: 0.93rem;
      border: 1.5px solid #a5d6a7;
      padding: 10px 22px;
      border-radius: 8px;
      transition: background 0.2s;
    }
    .back-link:hover { background: #e8f5e9; }
  </style>
</head>
<body>

  <div class="page-header">
    <h1>✈️ Pakistan Travel</h1>
    <p>Booking Processing Result</p>
  </div>

<?php if (!empty($errors)): ?>

  <!-- ══ VALIDATION ERRORS ══ -->
  <div class="card">
    <div class="error-box">
      <h3>⚠️ Please fix the following errors:</h3>
      <ul>
        <?php foreach ($errors as $err): ?>
          <li><?php echo htmlspecialchars($err); ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
    <a href="trip.php" class="go-back">← Go Back to Booking Form</a>
  </div>

<?php else: ?>

  <!-- ══ BOOKING SUMMARY ══ -->
  <div class="card">
    <div class="success-icon">✅</div>
    <div class="card-title">🧳 Trip Booking Summary</div>

    <table class="summary-table">
      <thead>
        <tr><th colspan="2">Traveler Details</th></tr>
      </thead>
      <tbody>
        <tr>
          <td class="label-col">Traveler Name</td>
          <td><?php echo $traveler_name; ?></td>
        </tr>
        <tr>
          <td class="label-col">Email Address</td>
          <td><?php echo $email; ?></td>
        </tr>
        <tr>
          <td class="label-col">Destination</td>
          <td><?php echo $destination; ?></td>
        </tr>
        <tr>
          <td class="label-col">Departure Date</td>
          <td><?php echo $formatted_date; ?></td>
        </tr>
        <tr>
          <td class="label-col">Number of Travelers</td>
          <td><?php echo $num_travelers; ?></td>
        </tr>
        <tr>
          <td class="label-col">Trip Type</td>
          <td><?php echo $trip_type; ?></td>
        </tr>
      </tbody>
    </table>
  </div>

  <!-- ══ PRICE BREAKDOWN ══ -->
  <div class="card">
    <div class="card-title">💰 Price Breakdown</div>

    <table class="price-table">
      <tbody>
        <tr>
          <td class="label-col">Base Price Per Person</td>
          <td>Rs. <?php echo number_format($base_price); ?></td>
        </tr>
        <tr>
          <td class="label-col">Number of Travelers</td>
          <td><?php echo $num_travelers; ?> person(s)</td>
        </tr>
        <tr>
          <td class="label-col">Subtotal</td>
          <td>Rs. <?php echo number_format($subtotal); ?></td>
        </tr>

        <?php if ($discount_rate > 0): ?>
        <tr class="discount-row">
          <td class="label-col">Group Discount (10% — 5+ travelers)</td>
          <td>− Rs. <?php echo number_format($discount_amt); ?></td>
        </tr>
        <?php else: ?>
        <tr>
          <td class="label-col">Discount</td>
          <td>None (book 5+ travelers for 10% off!)</td>
        </tr>
        <?php endif; ?>

        <tr class="total-row">
          <td class="label-col">✅ Final Total</td>
          <td>Rs. <?php echo number_format($final_total); ?></td>
        </tr>
      </tbody>
    </table>

    <!-- Booking Reference Banner -->
    <div class="ref-banner">
      <div>
        <div class="ref-label">Booking Reference</div>
        <div class="ref-value"><?php echo $booking_ref; ?></div>
      </div>
      <div style="text-align:right;">
        <div class="ref-label">Booked On</div>
        <div class="ref-value"><?php echo $booked_on; ?></div>
      </div>
    </div>
  </div>

  <a href="trip.php" class="back-link">← Book Another Trip</a>

<?php endif; ?>

</body>
</html>