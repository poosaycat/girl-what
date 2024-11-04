<?php
session_start();

// Check if the necessary session variables are set
if (!isset($_SESSION["name"]) || !isset($_SESSION["bankacc"]) || !isset($_SESSION["amount"]) || !isset($_SESSION["email"])) {
    // Redirect to the login page if any session variable is missing
    header("Location: accadmin.php");
    exit();
}

class Receipt {
    private $firstName;
    private $lastName;
    private $bankacc;
    private $amount;
    private $email;

    public function __construct($firstName, $lastName, $bankacc, $amount, $email) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->bankacc = $bankacc;
        $this->amount = $amount;
        $this->email = $email;
    }

    public function generateReceipt() {
        // Generate a random 11-digit reference number
        $referenceNo = rand(10000000000, 99999999999);

        // Generate the receipt HTML
        $receiptHtml = "
            <h2>Official Receipt</h2>
            <div class='receipt-info'>
                <p><strong><span style='color: #B14749;'>First Name:</span> $this->firstName</strong></p>
                <p><strong><span style='color: #B14749;'>Last Name:</span> $this->lastName</strong></p>
                <hr>
                <p><strong><span style='color: #B14749;'>Bank Account Number:</span> $this->bankacc</strong></p>
                <hr>
                <p><strong><span style='color: #B14749;'>Amount:</span> $this->amount</strong></p>
                <hr>
                <p><strong><span style='color: #B14749;'>Email:</span> $this->email</strong></p>
                <hr>
                <p><strong><span style='color: #B14749;'>Reference No.:</span> $referenceNo</strong></p>
                <div class='image-container'>
                    <img src='assets/aid.png' alt='Receipt Image' style='width: 150px; height: 75px; margin: 10px auto; display: block;'>
                </div>
            </div>
        ";

        // Output the receipt HTML
        echo $receiptHtml;      
    }
}

// Retrieve the form data from session variables and split the name into first and last names
$name = $_SESSION["name"];
$bankacc = $_SESSION["bankacc"];
$amount = $_SESSION["amount"];
$email = $_SESSION["email"];

// Split the name into first and last name
$nameParts = explode(" ", $name);
$firstName = $nameParts[0];
$lastName = isset($nameParts[1]) ? $nameParts[1] : '';

// Create the receipt object with the separated names
$receipt = new Receipt($firstName, $lastName, $bankacc, $amount, $email);
?>

<html>
<head>
    <title>Receipt</title>
    <link rel="stylesheet" type="text/css" href="receipt.css">
</head>
<body>
    <header>
        <div class="app-bar">
            <a href="mainpage.html">
                <div><img src="assets/aid.png" alt="Logo"></div>
            </a>
            <nav>
                <button class="nav-btn emergency-planning" onclick="window.location.href='emergency planning.html';">Emergency Planning</button>    
                <button class="nav-btn disaster-management" onclick="window.location.href='disaster management.html';">Disaster Management</button>
                <button class="nav-btn resources" onclick="window.location.href='resources.html';">Resources</button>
                <button class="nav-btn charity-programs" onclick="window.location.href='charity.html';">Charity Programs</button>
                <button class="nav-btn new-button" onclick="window.location.href='../PrelimWEBSITE-main/donations.php';">Send Donations</button>
            </nav>
        </div>
    </header>
    <div class="receipt-container">
        <?php $receipt->generateReceipt(); ?>
    </div>
    
    <div class="contact-section">
        <h2>Contact Us</h2>
        <div class="contact-container">
            <div class="contact-info">
                <p><strong>Phone:</strong> +123 456 7890</p>
                <p><strong>Email:</strong> contact@charity.org</p>
                <p><strong>Address:</strong> 123 Charity Lane, Goodville, GV 12345</p>
            </div>
            <div class="contact-social">
                <p><strong>Follow Us:</strong></p>
                <a href="https://www.facebook.com/charity" class="contact-link">Facebook</a> |
                <a href="https://twitter.com/charity" class="contact-link">Twitter</a> |
                <a href="https://www.instagram.com/charity" class="contact-link">Instagram</a>
            </div>
            <a href="accadmin.php">
                <button class="new-button" style="float: right;">Be Our Partner!</button>
            </a>
        </div>
    </div>
</body>
</html>
