<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$servername = "localhost";
$username = "pdf_uploads";
$password = "123";
$dbname = "pdf_uploads";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

header('Content-Type: application/json'); // Ensure the response is JSON

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $verification_code = rand(1000, 9999);

    // Check if email already exists
    $checkEmail = $conn->prepare("SELECT COUNT(*) FROM registration WHERE email = :email");
    $checkEmail->bindParam(':email', $email);
    $checkEmail->execute();
    $emailExists = $checkEmail->fetchColumn() > 0;

    if ($emailExists) {
        echo json_encode(['error' => 'Email is already registered.']);
        exit();
    }

    try {
        $sql = "INSERT INTO registration (first_name, last_name, email, password, verification_code) VALUES (:first_name, :last_name, :email, :password, :verification_code)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':first_name', $first_name);
        $stmt->bindParam(':last_name', $last_name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':verification_code', $verification_code);
        $stmt->execute();

        if (sendVerificationEmail($email, $verification_code)) {
            echo json_encode(['success' => 'Verification email sent.']);
        } else {
            echo json_encode(['error' => 'Error: Verification email could not be sent.']);
        }
    } catch(PDOException $e) {
        echo json_encode(['error' => 'Error: ' . $e->getMessage()]);
    }
}

$conn = null;

function sendVerificationEmail($email, $verification_code) {
    $mail = new PHPMailer(true);
    try {
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; 
        $mail->SMTPAuth = true;
        $mail->Username = 'thesixit53@gmail.com'; 
        $mail->Password = 'oazj jphh rrgr xbhw'; 
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('thesixit53@gmail.com', 'THESIX');
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = 'Email Verification';
        $mail->Body    = 'Your verification code is: ' . $verification_code;

        $mail->send();
        return true;
    } catch (Exception $e) {
        error_log("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
        return false;
    }
}
?>
