<?php

session_start();

if (!isset($_GET['name']) || !isset($_GET['birthdate'])) {
    echo "Access denied. Please log in.";
    exit();
}


$user_name = htmlspecialchars($_GET['name']);
$user_birthdate = htmlspecialchars($_GET['birthdate']);


$message = '';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $current_password = $_POST['current-password'];
    $new_password = $_POST['new-password'];
    $confirm_password = $_POST['confirm-password'];

    
    if ($new_password === $confirm_password) {
       
        $message = "Password updated successfully!";
    } else {
        $message = "New password and confirmation do not match.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Membership Page</title>
    <link rel="stylesheet" href="membership.css"> 
</head>
<body>
    <div class="app-bar">
        <a href="mainpage.html">
            <div class="logo"><img src="assets/aid.png" alt="Logo"></div>
        </a>
        <nav>
            <button class="nav-btn" onclick="openModal()">My Account</button>
            <button class="nav-btn" onclick="window.location.href='../PrelimWEBSITE-main/donations.php';">Send Donations</button>
            <button class="nav-btn logout-button" onclick="window.location.href='mainpage.html';">Log Out</button>
        </nav>
    </div>
    
    <header>
        <div class="main-image">
            <img src="assets/main-image.jpeg" alt="Your Image">
            <div class="background-overlay"></div>
            <div class="text-overlay">
                <img src="assets/aid.png" alt="Logo Overlay">
            </div>
        </div>
    </header>

    <div class="sub-section">
        <h2>SUBSCRIPTION PLANS</h2>
        <div class="sub-container">
            <div class="plans-container">
                <div class="plan-box">
                    <h3>₱250</h3>
                    <p>Support our programs with a monthly contribution of ₱250.</p>
                    <button class="join-button" onclick="location.href='payment.php?plan=250&name=<?php echo urlencode($user_name); ?>&birthdate=<?php echo urlencode($user_birthdate); ?>'">JOIN</button>
                </div>
                <div class="plan-box">
                    <h3>₱500</h3>
                    <p>Provide greater support with a monthly contribution of ₱500.</p>
                    <button class="join-button" onclick="location.href='payment.php?plan=500&name=<?php echo urlencode($user_name); ?>&birthdate=<?php echo urlencode($user_birthdate); ?>'">JOIN</button>
                </div>
                <div class="plan-box">
                    <h3>₱1000</h3>
                    <p>Make an impactful contribution with ₱1000 a month.</p>
                    <button class="join-button" onclick="location.href='payment.php?plan=1000&name=<?php echo urlencode($user_name); ?>&birthdate=<?php echo urlencode($user_birthdate); ?>'">JOIN</button>
                </div>
            </div>
        </div>
    </div>

    <div id="edit-info" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>Edit Your Information</h2>

            
            <?php if ($message): ?>
                <p><?php echo $message; ?></p>
            <?php endif; ?>

            <form method="POST">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="<?php echo $user_name; ?>" readonly>

                <label for="birthdate">Birthdate:</label>
                <input type="date" id="birthdate" name="birthdate" value="<?php echo $user_birthdate; ?>" readonly>

                <h3>Change Password</h3>
                <label for="current-password">Current Password:</label>
                <input type="password" id="current-password" name="current-password" required>

                <label for="new-password">New Password:</label>
                <input type="password" id="new-password" name="new-password" required>

                <label for="confirm-password">Confirm New Password:</label>
                <input type="password" id="confirm-password" name="confirm-password" required>

                <button type="submit" class="nav-btn new-button">Update Information</button>
            </form>
        </div>
    </div>

    <script>
        
        function openModal() {
            document.getElementById('edit-info').style.display = 'block';
        }

        function closeModal() {
            document.getElementById('edit-info').style.display = 'none';
        }

        window.onclick = function(event) {
            var modal = document.getElementById('edit-info');
            if (event.target == modal) {
                closeModal();
            }
        }
    </script>
</body>
</html>
