<?php 
include __DIR__ . '/db.php';

// Validate and sanitize ID
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id <= 0) {
    header("Location: index.php");
    exit;
}

$record = mysqli_query($conn, "SELECT * FROM students WHERE id=$id");
if (!$record || mysqli_num_rows($record) == 0) {
    header("Location: index.php");
    exit;
}
$data = mysqli_fetch_assoc($record);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student | Student Records</title>
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
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .edit-container {
            max-width: 550px;
            width: 100%;
        }

        .edit-card {
            background: rgba(30, 41, 59, 0.8);
            backdrop-filter: blur(12px);
            border-radius: 32px;
            padding: 2.5rem;
            border: 1px solid rgba(255, 255, 255, 0.08);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.4);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .edit-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 35px 55px -15px rgba(0, 0, 0, 0.5);
        }

        /* header */
        .card-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid rgba(59, 130, 246, 0.3);
        }

        .card-header h2 {
            color: #f1f5f9;
            font-size: 1.8rem;
            font-weight: 600;
            letter-spacing: -0.02em;
            background: linear-gradient(135deg, #ffffff, #94a3b8);
            background-clip: text;
            -webkit-background-clip: text;
            color: transparent;
        }

        .edit-icon {
            font-size: 2rem;
        }

        /* form styles */
        .form-group {
            margin-bottom: 1.5rem;
        }

        label {
            display: block;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: #94a3b8;
            margin-bottom: 0.6rem;
            font-weight: 600;
        }

        input {
            width: 100%;
            padding: 0.9rem 1.2rem;
            background: #0f172a;
            border: 1.5px solid #334155;
            border-radius: 16px;
            color: #f1f5f9;
            font-size: 1rem;
            transition: all 0.2s ease;
            outline: none;
            font-family: inherit;
        }

        input:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.2);
        }

        input::placeholder {
            color: #475569;
        }

        /* student info badge */
        .info-badge {
            background: rgba(59, 130, 246, 0.15);
            border-radius: 14px;
            padding: 0.8rem 1rem;
            margin-bottom: 1.8rem;
            display: flex;
            align-items: center;
            gap: 10px;
            border-left: 3px solid #3b82f6;
        }

        .info-badge span {
            font-size: 0.85rem;
            color: #94a3b8;
        }

        .info-badge strong {
            color: #60a5fa;
            font-size: 0.9rem;
        }

        /* button styles */
        .btn-save {
            width: 100%;
            background: linear-gradient(105deg, #3b82f6, #6366f1);
            border: none;
            padding: 1rem;
            border-radius: 40px;
            color: white;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 0.5rem;
            font-family: inherit;
        }

        .btn-save:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 25px -10px #3b82f6;
        }

        .btn-save:active {
            transform: translateY(1px);
        }

        /* cancel link */
        .cancel-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-top: 1.5rem;
            color: #94a3b8;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            transition: color 0.2s;
            width: 100%;
            text-align: center;
        }

        .cancel-link:hover {
            color: #f97316;
        }

        /* separator */
        .divider {
            margin: 1.2rem 0 0.5rem;
            height: 1px;
            background: rgba(255, 255, 255, 0.05);
        }

    </style>
</head>
<body>

<div class="edit-container">
    <div class="edit-card">
        <div class="card-header">
            
            <h2>Update Student Record</h2>
        </div>

        <!-- student ID indicator (silent but useful) -->
        <div class="info-badge">
          
            <span>Editing Record ID: <strong>#<?php echo htmlspecialchars($data['id']); ?></strong></span>
        </div>

        <form action="process.php" method="POST">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($data['id']); ?>">
            
            <div class="form-group">
                <label> Full Name</label>
                <input type="text" name="name" value="<?php echo htmlspecialchars($data['name']); ?>" required>
            </div>

            <div class="form-group">
                <label> Email Address</label>
                <input type="email" name="email" value="<?php echo htmlspecialchars($data['email']); ?>" required>
            </div>

            <div class="form-group">
                <label Department</label>
                <input type="text" name="department" value="<?php echo htmlspecialchars($data['department']); ?>" required>
            </div>

            <button type="submit" name="update" class="btn-save">
                 Save Changes
            </button>
        </form>

        <div class="divider"></div>
        
        <a href="index.php" class="cancel-link">
            ← Cancel & Return to Dashboard
        </a>
    </div>
</div>

</body>
</html>