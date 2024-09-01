<?php
session_start();

$servername = "localhost";
$username = "pdf_uploads";
$password = "123";
$dbname = "pdf_uploads";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);


        if (!empty($email) && !empty($password)) {
            $stmt = $pdo->prepare("SELECT password FROM registration WHERE email = :email");
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $stored_password = $row['password'];

              
                if (password_verify($password, $stored_password)) {
                    $_SESSION['email'] = $email;
                    $_SESSION['logged_in'] = true;
                    echo 'success';
                } else {
                    echo 'Invalid password';
                }
            } else {
                echo 'No account found with this email';
            }
        } else {
            echo 'Email and password cannot be empty';
        }
    } else {
        echo 'Invalid request method';
    }
} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
}

$pdo = null;
?>
