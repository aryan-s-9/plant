<?php
// SECURITY → Change this login password
$ADMIN_PASSWORD = "plantura123";

session_start();
if (!isset($_SESSION['logged_in'])) {

    if (isset($_POST['password']) && $_POST['password'] === $ADMIN_PASSWORD) {
        $_SESSION['logged_in'] = true;
    } else {
        ?>
        <form method="POST" style="margin:100px auto; width:300px; text-align:center;">
            <h2>Admin Login</h2>
            <input type="password" name="password" placeholder="Enter Password" required style="padding:10px; width:100%;">
            <br><br>
            <button type="submit" style="padding:10px 20px;">Login</button>
        </form>
        <?php
        exit;
    }
}

// Database connection
$host     = "localhost";
$user     = "u522649222_contact"; 
$password = "Shriaunsh@09";
$dbname   = "u522649222_form";
$conn = new mysqli($host, $user, $password, $dbname);

$result = $conn->query("SELECT * FROM contact_form ORDER BY created_at DESC");

echo "<h2 style='text-align:center;'>Contact Form Submissions</h2>";
echo "<table border='1' cellpadding='10' style='width:90%; margin:auto; border-collapse:collapse;'>";
echo "<tr><th>ID</th><th>Name</th><th>Email</th><th>Subject</th><th>Message</th><th>Date</th></tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr>
            <td>{$row['id']}</td>
            <td>{$row['name']}</td>
            <td>{$row['email']}</td>
            <td>{$row['subject']}</td>
            <td>{$row['message']}</td>
            <td>{$row['created_at']}</td>
          </tr>";
}

echo "</table>";
?>
