<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Trip Booking Form</title>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet"/>

  <style>
    /* ── Reset & Base ── */
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
      padding: 40px 16px 60px;
      color: #1a2e1a;
    }

    /* ── Page Header ── */
    .page-header {
      text-align: center;
      margin-bottom: 32px;
    }
    .page-header h1 {
      font-family: 'Playfair Display', serif;
      font-size: 2.4rem;
      color: #1b5e20;
      letter-spacing: -0.5px;
    }
    .page-header p {
      color: #4a7c59;
      margin-top: 6px;
      font-size: 1rem;
    }

    /* ── Form Card ── */
    .form-card {
      background: #ffffff;
      max-width: 540px;
      width: 100%;
      border-radius: 16px;
      padding: 38px 40px;
      box-shadow: 0 8px 32px rgba(27,94,32,.13), 0 2px 8px rgba(0,0,0,.06);
    }

    .form-card h2 {
      font-family: 'Playfair Display', serif;
      font-size: 1.5rem;
      color: #1b5e20;
      margin-bottom: 24px;
      padding-bottom: 12px;
      border-bottom: 2px solid #e8f5e9;
    }

    /* ── Form Groups ── */
    .form-group {
      margin-bottom: 20px;
    }

    label {
      display: block;
      font-weight: 600;
      font-size: 0.88rem;
      color: #2e4d2e;
      margin-bottom: 7px;
      letter-spacing: 0.3px;
    }

    input[type="text"],
    input[type="email"],
    input[type="date"],
    input[type="number"],
    select {
      width: 100%;
      padding: 11px 14px;
      border: 1.5px solid #c8e6c9;
      border-radius: 8px;
      font-family: 'DM Sans', sans-serif;
      font-size: 0.95rem;
      color: #1a2e1a;
      background: #f9fdf9;
      transition: border-color 0.2s, box-shadow 0.2s;
      outline: none;
    }

    input:focus,
    select:focus {
      border-color: #388e3c;
      box-shadow: 0 0 0 3px rgba(56,142,60,.15);
      background: #fff;
    }

    select {
      appearance: none;
      background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath d='M1 1l5 5 5-5' stroke='%23388e3c' stroke-width='2' fill='none' stroke-linecap='round'/%3E%3C/svg%3E");
      background-repeat: no-repeat;
      background-position: right 14px center;
      padding-right: 36px;
      cursor: pointer;
    }

    /* ── Radio Buttons ── */
    .radio-group {
      display: flex;
      gap: 20px;
      flex-wrap: wrap;
      margin-top: 4px;
    }

    .radio-option {
      display: flex;
      align-items: center;
      gap: 8px;
      cursor: pointer;
      font-size: 0.95rem;
      color: #1a2e1a;
    }

    .radio-option input[type="radio"] {
      accent-color: #388e3c;
      width: 17px;
      height: 17px;
      cursor: pointer;
    }

    /* ── Buttons ── */
    .btn-row {
      display: flex;
      gap: 12px;
      margin-top: 28px;
    }

    .btn-submit {
      flex: 1;
      background: #2e7d32;
      color: #ffffff;
      border: none;
      padding: 13px;
      border-radius: 8px;
      font-family: 'DM Sans', sans-serif;
      font-size: 1rem;
      font-weight: 600;
      cursor: pointer;
      letter-spacing: 0.4px;
      transition: background 0.2s, transform 0.1s;
      width: 100%;
    }

    .btn-submit:hover  { background: #1b5e20; }
    .btn-submit:active { transform: scale(0.98); }

    .btn-reset {
      flex: 0 0 auto;
      background: transparent;
      color: #388e3c;
      border: 1.5px solid #a5d6a7;
      padding: 13px 22px;
      border-radius: 8px;
      font-family: 'DM Sans', sans-serif;
      font-size: 1rem;
      font-weight: 600;
      cursor: pointer;
      transition: background 0.2s, color 0.2s;
    }

    .btn-reset:hover {
      background: #e8f5e9;
      color: #1b5e20;
    }

    /* ── Table Section ── */
    .table-section {
      max-width: 540px;
      width: 100%;
      margin-top: 40px;
    }

    .table-section h3 {
      font-family: 'Playfair Display', serif;
      font-size: 1.35rem;
      color: #1b5e20;
      margin-bottom: 14px;
      text-align: center;
    }

    .dest-table {
      width: 100%;
      border-collapse: collapse;
      background: #fff;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 4px 18px rgba(27,94,32,.11);
      font-size: 0.92rem;
    }

    .dest-table th {
      background: #2e7d32;
      color: #ffffff;
      padding: 12px 14px;
      text-align: left;
      font-weight: 600;
      letter-spacing: 0.3px;
      border: 1px solid #256029;
    }

    .dest-table td {
      padding: 11px 14px;
      border: 1px solid #c8e6c9;
      color: #1a2e1a;
    }

    .dest-table tr:nth-child(even) td {
      background: #f1f8f1;
    }

    .dest-table tr:hover td {
      background: #e8f5e9;
      transition: background 0.15s;
    }
  </style>
</head>
<body>

  <!-- Page Header -->
  <div class="page-header">
    <h1>✈️ Destination Travel</h1>
    <p>Book your next adventure across beautiful Pakistan</p>
  </div>

  <!-- Booking Form -->
  <div class="form-card">
    <h2>Trip Booking Form</h2>

    <form action="booking.php" method="POST">

      <!-- Traveler Name -->
      <div class="form-group">
        <label for="traveler_name">Traveler Name</label>
        <input type="text" id="traveler_name" name="traveler_name"
               placeholder="Enter your full name" required />
      </div>

      <!-- Email -->
      <div class="form-group">
        <label for="email">Email Address</label>
        <input type="email" id="email" name="email"
               placeholder="you@example.com" required />
      </div>

      <!-- Destination -->
      <div class="form-group">
        <label for="destination">Destination</label>
        <select id="destination" name="destination" required>
          <option value="" disabled selected>-- Select a destination --</option>
          <option value="Lahore">Lahore</option>
          <option value="Karachi">Karachi</option>
          <option value="Islamabad">Islamabad</option>
          <option value="Murree">Murree</option>
          <option value="Swat">Swat</option>
        </select>
      </div>

      <!-- Departure Date -->
      <div class="form-group">
        <label for="departure_date">Departure Date</label>
        <input type="date" id="departure_date" name="departure_date" required />
      </div>

      <!-- Number of Travelers -->
      <div class="form-group">
        <label for="num_travelers">Number of Travelers</label>
        <input type="number" id="num_travelers" name="num_travelers"
               min="1" max="20" placeholder="e.g. 2" required />
      </div>

      <!-- Trip Type -->
      <div class="form-group">
        <label>Trip Type</label>
        <div class="radio-group">
          <label class="radio-option">
            <input type="radio" name="trip_type" value="Family" required /> Family
          </label>
          <label class="radio-option">
            <input type="radio" name="trip_type" value="Friends" /> Friends
          </label>
          <label class="radio-option">
            <input type="radio" name="trip_type" value="Solo" /> Solo
          </label>
        </div>
      </div>

      <!-- Buttons -->
      <div class="btn-row">
        <button type="submit" class="btn-submit">Book Now</button>
        <button type="reset"  class="btn-reset">Reset</button>
      </div>

    </form>
  </div>

  <!-- Popular Destinations Table -->
  <div class="table-section">
    <h3>Popular Destinations</h3>
    <table class="dest-table">
      <thead>
        <tr>
          <th>Destination</th>
          <th>Best Time to Visit</th>
          <th>Price Per Person (Rs.)</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Lahore</td>
          <td>October – February</td>
          <td>Rs. 8,500</td>
        </tr>
        <tr>
          <td>Karachi</td>
          <td>November – March</td>
          <td>Rs. 11,000</td>
        </tr>
        <tr>
          <td>Islamabad</td>
          <td>March – May</td>
          <td>Rs. 9,200</td>
        </tr>
        <tr>
          <td>Murree</td>
          <td>June – August</td>
          <td>Rs. 14,500</td>
        </tr>
        <tr>
          <td>Swat</td>
          <td>April – September</td>
          <td>Rs. 17,000</td>
        </tr>
      </tbody>
    </table>
  </div>

</body>
</html>