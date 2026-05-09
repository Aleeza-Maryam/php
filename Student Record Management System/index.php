<?php include __DIR__ . '/db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Student Records</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            min-height: 100vh;
            padding: 2rem;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
        }

        /* header & nav */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        h2 {
            color: #f1f5f9;
            font-size: 1.8rem;
            font-weight: 600;
            letter-spacing: -0.02em;
            background: linear-gradient(135deg, #ffffff, #94a3b8);
            background-clip: text;
            -webkit-background-clip: text;
            color: transparent;
        }

        .nav-btn {
            background: rgba(51, 65, 85, 0.8);
            backdrop-filter: blur(10px);
            padding: 0.6rem 1.5rem;
            border-radius: 40px;
            color: #e2e8f0;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .nav-btn:hover {
            background: #3b82f6;
            color: white;
            transform: translateY(-2px);
        }

        /* form card */
        .form-card {
            background: rgba(30, 41, 59, 0.8);
            backdrop-filter: blur(12px);
            border-radius: 24px;
            padding: 1.8rem 2rem;
            margin-bottom: 2rem;
            border: 1px solid rgba(255, 255, 255, 0.08);
            box-shadow: 0 20px 35px -12px rgba(0, 0, 0, 0.3);
        }

        .form-card h3 {
            color: #f1f5f9;
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 1.2rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .form-group {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            align-items: flex-end;
        }

        .input-field {
            flex: 1;
            min-width: 180px;
        }

        .input-field label {
            display: block;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #94a3b8;
            margin-bottom: 0.5rem;
            font-weight: 600;
        }

        .input-field input {
            width: 100%;
            padding: 0.8rem 1rem;
            background: #0f172a;
            border: 1px solid #334155;
            border-radius: 14px;
            color: #f1f5f9;
            font-size: 0.95rem;
            transition: all 0.2s;
            outline: none;
        }

        .input-field input:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
        }

        .submit-btn {
            background: linear-gradient(105deg, #3b82f6, #6366f1);
            border: none;
            padding: 0.8rem 2rem;
            border-radius: 40px;
            color: white;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            font-size: 0.9rem;
            margin-bottom: 0.2rem;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px -8px #3b82f6;
        }

        /* stats row */
        .stats-row {
            display: flex;
            gap: 1.5rem;
            margin-bottom: 2rem;
            flex-wrap: wrap;
        }

        .stat-card {
            background: rgba(30, 41, 59, 0.6);
            backdrop-filter: blur(8px);
            border-radius: 20px;
            padding: 1rem 1.8rem;
            border: 1px solid rgba(255, 255, 255, 0.05);
            flex: 1;
            min-width: 150px;
            text-align: center;
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            color: #60a5fa;
        }

        .stat-label {
            font-size: 0.8rem;
            color: #94a3b8;
            margin-top: 0.3rem;
        }

        /* table styles */
        .table-wrapper {
            background: rgba(15, 23, 42, 0.7);
            backdrop-filter: blur(8px);
            border-radius: 24px;
            overflow-x: auto;
            border: 1px solid rgba(255, 255, 255, 0.05);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            text-align: left;
            padding: 1rem 1.2rem;
            background: rgba(51, 65, 85, 0.5);
            color: #cbd5e1;
            font-weight: 600;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
            border-bottom: 1px solid #334155;
        }

        td {
            padding: 1rem 1.2rem;
            color: #e2e8f0;
            border-bottom: 1px solid rgba(51, 65, 85, 0.5);
            font-size: 0.9rem;
        }

        tr:hover td {
            background: rgba(59, 130, 246, 0.05);
        }

        .action-links {
            display: flex;
            gap: 1rem;
        }

        .action-links a {
            color: #60a5fa;
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 500;
            transition: color 0.2s;
        }

        .action-links a:hover {
            color: #f97316;
        }

        .empty-row td {
            text-align: center;
            padding: 3rem;
            color: #64748b;
        }

    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <h2>Student Records Dashboard</h2>
        <a href="home.php" class="nav-btn">← Back to Home</a>
    </div>

    <!-- stats summary -->
    <?php
    $totalResult = mysqli_query($conn, "SELECT COUNT(*) as total FROM students");
    $totalRow = mysqli_fetch_assoc($totalResult);
    $totalStudents = $totalRow['total'];
    
    $deptResult = mysqli_query($conn, "SELECT COUNT(DISTINCT department) as depts FROM students");
    $deptRow = mysqli_fetch_assoc($deptResult);
    $totalDepts = $deptRow['depts'];
    ?>
    <div class="stats-row">
        <div class="stat-card">
            <div class="stat-number"><?php echo $totalStudents; ?></div>
            <div class="stat-label">Total Students</div>
        </div>
        <div class="stat-card">
            <div class="stat-number"><?php echo $totalDepts; ?></div>
            <div class="stat-label">Departments</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">Active</div>
            <div class="stat-label">System Status</div>
        </div>
    </div>

    <!-- add student form -->
    <div class="form-card">
        <h3>
            <span>+</span> Add New Student
        </h3>
        <form action="process.php" method="POST" class="form-group">
            <div class="input-field">
                <label>Full Name</label>
                <input type="text" name="name" placeholder="e.g., John Carter" required>
            </div>
            <div class="input-field">
                <label>Email Address</label>
                <input type="email" name="email" placeholder="student@example.com" required>
            </div>
            <div class="input-field">
                <label>Department</label>
                <input type="text" name="department" placeholder="Computer Science, Physics..." required>
            </div>
            <button type="submit" name="save" class="submit-btn">Save Record →</button>
        </form>
    </div>

    <!-- students table -->
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Department</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result = mysqli_query($conn, "SELECT * FROM students ORDER BY id DESC");
                if(mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                            <td>{$row['id']}</td>
                            <td><strong>" . htmlspecialchars($row['name']) . "</strong></td>
                            <td>" . htmlspecialchars($row['email']) . "</td>
                            <td>" . htmlspecialchars($row['department']) . "</td>
                            <td class='action-links'>
                                <a href='edit.php?id={$row['id']}'>Edit</a>
                                <a href='process.php?delete={$row['id']}' onclick='return confirm(\"Delete this student record?\")'> Delete</a>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "<tr class='empty-row'><td colspan='5'>No student records found. Add your first student above.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>