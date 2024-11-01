<?php
// Start the session to access session variables
session_start();

// Check if the user is logged in by checking the name and birthdate passed from the login page
if (!isset($_GET['name']) || !isset($_GET['birthdate'])) {
    echo "Access denied. Please log in.";
    exit();
}

// Retrieve the user's name and birthdate from the URL parameters
$user_name = htmlspecialchars($_GET['name']);
$user_birthdate = htmlspecialchars($_GET['birthdate']);
$user_email = isset($_GET['email']) ? htmlspecialchars($_GET['email']) : 'Not provided'; // Ensure email is optional
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Membership Page</title>
    <link rel="stylesheet" href="membership.css"> <!-- Link to separate CSS file -->
    <script>
        function navigateTo(page) {
            window.location.href = page;
        }

        function showMonthlyGivingForm() {
            document.getElementById('monthly-giving-step-1').style.display = 'block';
            document.getElementById('sections').style.display = 'none';
        }

        function goToStep2() {
            document.getElementById('monthly-giving-step-1').style.display = 'none';
            document.getElementById('monthly-giving-step-2').style.display = 'block';
        }

        function goToStep3() {
            document.getElementById('monthly-giving-step-2').style.display = 'none';
            document.getElementById('monthly-giving-step-3').style.display = 'block';
        }

        function confirmPayment() {
            alert('Payment method confirmed. Thank you!');
        }

        function showEditAccountForm() {
            document.getElementById('edit-account-info').style.display = 'block';
        }

        function hideEditForm() {
            document.getElementById('edit-account-info').style.display = 'none';
        }
    </script>
</head>
<body>
    <div class="app-bar">
        <a href="mainpage.html">
            <div><img src="assets/aid.png" alt="Logo"></div>
        </a>
        <nav>
            <button class="nav-btn new-button" onclick="window.location.href='../PrelimWEBSITE-main/donations.php';">Send Donations</button>
        </nav>
    </div>

    <div class="container">
        <h1>Welcome, <?php echo $user_name; ?>!</h1>
        <p>Your registered email is: <?php echo $user_email; ?></p>
        <p>Your birthdate is: <?php echo $user_birthdate; ?></p>

        <div id="sections" class="sections">
            <div class="card" onclick="navigateTo('account_summary.php')">
                <h2>Account Summary</h2>
                <p>Here you'll see your donation activity.</p>
            </div>
            <div class="card" onclick="showMonthlyGivingForm()">
                <h2>Monthly Giving</h2>
                <p>Manage your monthly subscription and giving settings here.</p>
            </div>
            <div class="card" onclick="showEditAccountForm()">
                <h2>Edit Account Information</h2>
                <p>Update your personal details and change your password.</p>
            </div>
        </div>

        <!-- Edit Account Information Section -->
        <div id="edit-account-info" style="display:none;">
            <h2>Edit Account Information</h2>
            <form id="edit-account-form" action="update_account.php" method="POST">
                <label>Name:</label>
                <input type="text" name="name" value="<?php echo $user_name; ?>" required><br>
                <label>Email Address:</label>
                <input type="email" name="email" value="<?php echo $user_email; ?>" required><br>
                <label>Phone Number:</label>
                <input type="text" name="phone" required><br>
                <label>Birthday:</label>
                <input type="date" name="birthdate" value="<?php echo $user_birthdate; ?>" required><br>
                <label>New Password:</label>
                <input type="password" name="new_password" placeholder="Leave blank to keep current password"><br>
                <label>Confirm Password:</label>
                <input type="password" name="confirm_password"><br>
                <button type="submit">Save Changes</button>
                <button type="button" onclick="hideEditForm()">Cancel</button>
            </form>
        </div>

        <!-- Step 1: Choose an Amount -->
        <div id="monthly-giving-step-1" style="display:none;">
            <h2>Select Monthly Subscription Amount</h2>
            <button onclick="goToStep2()">200</button>
            <button onclick="goToStep2()">500</button>
            <button onclick="goToStep2()">1000</button>
            <button onclick="goToStep2()">Other Amount</button>
        </div>

        <!-- Step 2: Fill in Personal Information -->
        <div id="monthly-giving-step-2" style="display:none;">
            <h2>Step 2: Fill in your Information</h2>
            <form id="monthly-giving-form">
                <label>First Name:</label>
                <input type="text" name="first_name" required><br>
                <label>Last Name:</label>
                <input type="text" name="last_name" required><br>
                <label>Email Address:</label>
                <input type="email" name="email" required><br>
                <label>Phone Number:</label>
                <input type="text" name="phone" required><br>
                <label>Birthdate (MM/DD/YYYY):</label>
                <input type="text" name="birthdate" required><br>
                <label>Address:</label>
                <input type="text" name="address" placeholder="House number/Unit, Street, Barangay" required><br>
                <label>City:</label>
                <input type="text" name="city" required><br>
                <label>Province:</label>
                <input type="text" name="province" required><br>
                <label>ZIP Code:</label>
                <input type="text" name="zip_code" required><br>
                <button type="button" onclick="goToStep3()">Continue</button>
            </form>
        </div>

        <!-- Step 3: Payment Method -->
        <div id="monthly-giving-step-3" style="display:none;">
            <h2>Step 3: Select Your Payment Method</h2>
            <button onclick="confirmPayment()">Credit Card</button>
            <button onclick="confirmPayment()">Gcash</button>
            <button onclick="confirmPayment()">Online Payment</button>
        </div>
    </div>
</body>
</html>
