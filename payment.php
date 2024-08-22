<?php
session_start();

// Check if the user is logged in, if not redirect to login page
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activate Account</title>
    <link rel="stylesheet" href="paymentform.css">
</head>
<body>
    <div class="container">
        <h1><b>LEGIT 💲 EARN</b></h1>
        <h2><u>Activate Account</u></h2>
        <p style=" color: hsl(49, 100%, 50%);"><b>(MTN) MOMO PAY</b></p>
        <ol>
            <li>Kanda <b>*182*8*1*1095054#</b></li>
            <li>Shyiramo Umubare Wamafaranga (Amount) <b>3500Rwf</b></li>
            <li>COMFIRM NAME: <b>antoinette</b></li>
            <li>Enter Pin</li>
        </ol>

        <p style="color:red">AIRTEL MONEY</p>
        <ol>
            <li>Kanda <b>*500*1*2*0789794991#</b></li>
            <li>Shyiramo Umubare Wamafaranga (Amount)<b>3500Rwf</b></li>
            <li>COMFIRM NAME: <b>antoinette</b></li>
            <li>Enter Pin</li> 
        </ol>
        <p>Send transaction screenshot message to: <b>+250789794991</b></p>
        <p>Send the transaction message/screenshot to WhatsApp number <b>0789794991</b></p>
        <button id="proceedButton">PROCEED</button>
        
    </div>

    <script>
        // Add event listener to the "PROCEED" button
        document.getElementById('proceedButton').addEventListener('click', function() {
            // Send a request to check_activation.php to verify if the account is active
            fetch('check_activation.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: 'action=check_activation'
            })
            .then(response => response.json())
            .then(data => {
                // Check the response to see if the account is active
                if (data.active) {
                    // Redirect to dashboard if the account is active
                    window.location.href = 'dashboard.php';
                } else {
                    // Show a notification if the account is not active
                    alert("Account is not active");
                }
            })
            .catch(error => {
                console.error('Error:', error);
                document.getElementById('notification').innerText = 'An error occurred. Please try again.';
            });
        });
    </script>
</body>
</html>
