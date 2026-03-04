<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: index.php');
    exit;
}

$user_email = $_SESSION['user_email'] ?? 'User';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }
        
        .dashboard-container {
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(15px);
            padding: 20px 30px;
            border-radius: 15px;
            margin-bottom: 30px;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .header h1 {
            color: white;
            font-size: 1.8rem;
            margin: 0;
        }
        
        .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .user-info span {
            color: white;
            font-size: 1rem;
        }
        
        .logout-btn {
            padding: 10px 20px;
            background: linear-gradient(to right, #ff6b6b, #ee5a5a);
            border: none;
            border-radius: 8px;
            color: white;
            cursor: pointer;
            font-weight: bold;
            transition: 0.3s;
        }
        
        .logout-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
        }
        
        .cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(15px);
            border-radius: 15px;
            padding: 25px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: white;
            transition: 0.3s;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        }
        
        .card-icon {
            font-size: 2.5rem;
            margin-bottom: 15px;
        }
        
        .card h3 {
            font-size: 1.2rem;
            margin-bottom: 10px;
        }
        
        .card p {
            opacity: 0.8;
            font-size: 0.9rem;
        }
        
        .card .number {
            font-size: 2rem;
            font-weight: bold;
            margin-top: 10px;
        }
        
        .recent-activity {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(15px);
            border-radius: 15px;
            padding: 25px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: white;
        }
        
        .recent-activity h2 {
            margin-bottom: 20px;
            font-size: 1.5rem;
        }
        
        .activity-item {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .activity-item:last-child {
            border-bottom: none;
        }
        
        .activity-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .activity-text {
            flex: 1;
        }
        
        .activity-text h4 {
            margin: 0 0 5px 0;
            font-size: 1rem;
        }
        
        .activity-text p {
            margin: 0;
            opacity: 0.7;
            font-size: 0.85rem;
        }
        
        .time {
            opacity: 0.6;
            font-size: 0.8rem;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <div class="header">
            <h1><i class='bx bxs-dashboard'></i> Dashboard</h1>
            <div class="user-info">
                <span>Welcome, <strong><?php echo htmlspecialchars($user_email); ?></strong></span>
                <button class="logout-btn" id="logoutBtn"><i class='bx bx-log-out'></i> Logout</button>
            </div>
        </div>
    
    <script>
        // Logout functionality
        $('#logoutBtn').on('click', function() {
            $.ajax({
                url: 'API/logout.php',
                method: 'POST',
                success: function(data) {
                    if (data.success) {
                        window.location.href = 'index.php';
                    }
                },
                error: function() {
                    window.location.href = 'index.php';
                }
            });
        });
    </script>
</body>
</html>

