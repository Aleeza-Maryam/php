<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Record System | Nexus</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #0b1120 0%, #19233c 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        /* animated background orbs */
        body::before {
            content: '';
            position: absolute;
            width: 60vw;
            height: 60vw;
            background: radial-gradient(circle, rgba(99, 102, 241, 0.25) 0%, rgba(99, 102, 241, 0) 70%);
            top: -30vh;
            right: -20vw;
            border-radius: 50%;
            pointer-events: none;
        }

        body::after {
            content: '';
            position: absolute;
            width: 50vw;
            height: 50vw;
            background: radial-gradient(circle, rgba(236, 72, 153, 0.2) 0%, rgba(236, 72, 153, 0) 70%);
            bottom: -25vh;
            left: -20vw;
            border-radius: 50%;
            pointer-events: none;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
            z-index: 10;
            position: relative;
        }

        /* main card */
        .landing-card {
            background: rgba(15, 23, 42, 0.7);
            backdrop-filter: blur(20px);
            border-radius: 48px;
            padding: 4rem 3rem;
            border: 1px solid rgba(255, 255, 255, 0.08);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5), 0 0 0 0.5px rgba(255, 255, 255, 0.05) inset;
            transition: transform 0.4s cubic-bezier(0.2, 0.9, 0.4, 1.1), box-shadow 0.4s ease;
        }

        .landing-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 35px 60px -15px rgba(0, 0, 0, 0.6);
            border-color: rgba(255, 255, 255, 0.12);
        }

        /* content layout */
        .content {
            text-align: center;
            max-width: 800px;
            margin: 0 auto;
        }

        /* badge */
        .badge {
            display: inline-block;
            background: rgba(99, 102, 241, 0.2);
            backdrop-filter: blur(4px);
            padding: 0.5rem 1.2rem;
            border-radius: 100px;
            font-size: 0.8rem;
            font-weight: 500;
            letter-spacing: 0.3px;
            color: #a5b4fc;
            border: 1px solid rgba(99, 102, 241, 0.4);
            margin-bottom: 2rem;
        }

        /* main heading */
        h1 {
            font-size: 4.5rem;
            font-weight: 800;
            line-height: 1.1;
            background: linear-gradient(135deg, #ffffff 0%, #c7d2fe 40%, #a5b4fc 100%);
            background-clip: text;
            -webkit-background-clip: text;
            color: transparent;
            margin-bottom: 1.5rem;
            letter-spacing: -0.02em;
        }

        /* description */
        .description {
            font-size: 1.2rem;
            line-height: 1.6;
            color: #94a3b8;
            margin-bottom: 2.5rem;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        /* stats row - minimal */
        .stats-row {
            display: flex;
            justify-content: center;
            gap: 3rem;
            margin-bottom: 2.5rem;
            flex-wrap: wrap;
        }

        .stat-item {
            text-align: center;
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 800;
            background: linear-gradient(135deg, #fbbf24, #f97316);
            background-clip: text;
            -webkit-background-clip: text;
            color: transparent;
            letter-spacing: -0.02em;
        }

        .stat-label {
            font-size: 0.85rem;
            color: #64748b;
            margin-top: 0.3rem;
            font-weight: 500;
        }

        /* interactive counter widget - clean */
        .counter-preview {
            background: rgba(30, 41, 59, 0.6);
            border-radius: 80px;
            padding: 0.5rem;
            display: inline-flex;
            align-items: center;
            gap: 0.8rem;
            margin-bottom: 2rem;
            border: 1px solid rgba(255, 255, 255, 0.05);
        }

        .counter-value {
            background: rgba(0, 0, 0, 0.4);
            padding: 0.6rem 1.4rem;
            border-radius: 60px;
            font-weight: 700;
            font-size: 1.5rem;
            color: #fbbf24;
            font-family: monospace;
            letter-spacing: 1px;
            min-width: 100px;
            text-align: center;
        }

        .counter-btn {
            background: rgba(99, 102, 241, 0.2);
            border: none;
            width: 44px;
            height: 44px;
            border-radius: 60px;
            font-size: 1.3rem;
            font-weight: 600;
            color: #cbd5e1;
            cursor: pointer;
            transition: all 0.2s ease;
            backdrop-filter: blur(4px);
        }

        .counter-btn:hover {
            background: #6366f1;
            color: white;
            transform: scale(1.05);
        }

        .counter-reset {
            background: rgba(71, 85, 105, 0.4);
            width: auto;
            padding: 0 1.2rem;
            font-size: 0.85rem;
        }

        /* CTA button */
        .cta-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            background: linear-gradient(105deg, #6366f1, #8b5cf6);
            padding: 1rem 2.8rem;
            border-radius: 80px;
            font-weight: 600;
            font-size: 1.1rem;
            color: white;
            text-decoration: none;
            transition: all 0.3s cubic-bezier(0.2, 0.9, 0.4, 1.1);
            box-shadow: 0 8px 20px -8px rgba(99, 102, 241, 0.5);
            border: 1px solid rgba(255, 255, 255, 0.15);
            letter-spacing: 0.3px;
        }

        .cta-button:hover {
            transform: scale(1.03);
            background: linear-gradient(105deg, #818cf8, #a78bfa);
            box-shadow: 0 15px 30px -10px rgba(99, 102, 241, 0.6);
            gap: 16px;
        }

        /* simple footer note */
        .footer-note {
            margin-top: 2rem;
            font-size: 0.75rem;
            color: #475569;
        }

      
    </style>
</head>
<body>

<div class="container">
    <div class="landing-card">
        <div class="content">
            <div class="badge">
                ✦ STUDENT RECORD SYSTEM ✦
            </div>
            
            <h1>
                Manage Records<br>
                With Precision
            </h1>
            
            <p class="description">
                Centralized dashboard for student data, analytics, and seamless updates.
            </p>

            <!-- minimal stats -->
            <div class="stats-row">
                <div class="stat-item">
                    <div class="stat-number">2.5k+</div>
                    <div class="stat-label">Active Students</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">98%</div>
                    <div class="stat-label">Data Accuracy</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">24/7</div>
                    <div class="stat-label">Secure Access</div>
                </div>
            </div>

        

            <!-- main CTA -->
            <a href="index.php" class="cta-button">
                Enter System
                <span style="font-size: 1.2rem;">→</span>
            </a>
            
            <div class="footer-note">
                Secure • Real-time • Intuitive
            </div>
        </div>
    </div>
</div>


</body>
</html>