<?php
/**  @var $conn */
if (isset($_POST['login'])) {
    $username = sanitiseData($_POST['username']);
    $password = sanitiseData($_POST['password']);

    $query = $conn->query("SELECT COUNT(*) as count, * FROM customers WHERE EmailAddress='$username'");
    $row = $query->fetchArray();
    $count = $row['count'];
    if ($count > 0) {
        if (password_verify($password, $row['HashedPassword'])) {
            $_SESSION["FirstName"] = $row['FirstName'];
            $_SESSION['EmailAddress'] = $row['EmailAddress'];
            $_SESSION['AccessLevel'] = $row['AccessLevel'];
            $_SESSION['CustomerID'] = $row['CustomerID'];
            $_SESSION["flash_message"] = "<div class='bg-success'>Login Successful</div>";

            header("location:index.php");
        }else {
            echo "<div class='alert alert-danger'>Invalid username or password</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>Invalid username or password</div>";
    }
}
    ?>