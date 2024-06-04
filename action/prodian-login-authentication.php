<?php
include ('../conn/connection.php');

// Check if the username and password fields are set
if (isset($_POST['username']) && isset($_POST['password'])) {
$username = $_POST['username'];
$password = $_POST['password'];

$stmt = $conn->prepare("SELECT * FROM `users` WHERE username=:username and password=:password");
$stmt->bindParam(':username', $username);
$stmt->bindParam(':password', $password);
$stmt->execute();

if ($stmt->rowCount() > 0) {
    session_start();
    $_SESSION['username'] = $username;

    if ($username == "admin") {
        $_SESSION['success'] = 1;

        $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->execute(array(':username' => 'admin'));
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        $_SESSION['user'] = $user;
        header("Location:../index.php");
        $_SESSION['redirect'] = "E3/admin/prodian-dashboard.php";
    } else if ($username == "staff") {
        $_SESSION['success'] = 1;
        
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->execute(array(':username' => 'staff'));
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        $_SESSION['user'] = $user;
        header("Location:../index.php");
        $_SESSION['redirect'] = "E3/staff/prodian-staff-dashboard.php";
    } else if ($username == "mro") {
        $_SESSION['success'] = 1;
        
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->execute(array(':username' => 'mro'));
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        $_SESSION['user'] = $user;
        header("Location:../index.php");
        $_SESSION['redirect'] = "E3/mro/prodian-mro-dashboard.php";
    } else if ($username == "dispatch") {
        $_SESSION['success'] = 1;
        
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->execute(array(':username' => 'dispatch'));
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        $_SESSION['user'] = $user;
        header("Location:../index.php");
        $_SESSION['redirect'] = "E3/dispatch/prodian-dispatch-dashboard.php";
    } else if ($username == "acad") {
        $_SESSION['success'] = 1;
        
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->execute(array(':username' => 'acad'));
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        $_SESSION['user'] = $user;
        header("Location:../index.php");
        $_SESSION['redirect'] = "subsystem/acad/subsystem.php";
    } else if ($username == "logistic") {
        $_SESSION['success'] = 1;
        
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->execute(array(':username' => 'acad'));
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        $_SESSION['user'] = $user;
        header("Location:../index.php");
        $_SESSION['redirect'] = "subsystem/logistic/subsystem.php";
    }
} else {
    // Start a session and set the 'error' session variable to 1
    session_start();
    $_SESSION['error'] = 1;
    header("Location:../index.php");
}
$conn = null;
}
?>
