<?php
session_start();

$servername = "localhost";
$username = "pdf_uploads";
$password = "123";
$dbname = "pdf_uploads";

require 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'];
    $email = $_POST['email'];

    if ($action == 'verify') {
        $submitted_code = $_POST['code1'] . $_POST['code2'] . $_POST['code3'] . $_POST['code4'];

        if (strlen($submitted_code) != 4 || !ctype_digit($submitted_code)) {
            echo json_encode(["status" => "error", "message" => "Invalid verification code format. Please enter a 4-digit code."]);
            exit();
        }

        try {
            $stmt = $conn->prepare("SELECT verification_code FROM registration WHERE email = :email");
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $stored_code = $row['verification_code'];

                if ($submitted_code === $stored_code) {
                    $_SESSION['email_verified'] = true;

                    $stmt = $conn->prepare("UPDATE registration SET verification_code = NULL WHERE email = :email");
                    $stmt->bindParam(':email', $email);
                    $stmt->execute();

                    echo json_encode(["status" => "success", "message" => "Verification successful"]);
                    exit();
                } else {
                    echo json_encode(["status" => "error", "message" => "Invalid verification code. Please try again."]);
                }
            } else {
                echo json_encode(["status" => "error", "message" => "No record found for the provided email."]);
            }
        } catch(PDOException $e) {
            echo json_encode(["status" => "error", "message" => "Error: " . $e->getMessage()]);
        }
    }
}

$conn = null;
?>
