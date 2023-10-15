<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "phpassigment";

// Here we insert the data the user sent us
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = new mysqli($servername, $username, $password, $database);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $email = $conn->real_escape_string($_POST['email']);
    $interests = implode(', ', $_POST['interests']);  // Combine interests into a comma-separated string

    $sql = "INSERT INTO subscribers (email, interests) VALUES ('$email', '$interests')";

    if ($conn->query($sql) === TRUE) {
        echo "Record inserted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }


}
echo '<br>';
echo '<img src="images/atomo.png" height="75" width="75" alt="HTML" />';
echo '<br>';
$result = $conn->query("SELECT email, interests FROM subscribers");
if ($result->num_rows > 0) {
    echo "<h2>All our members:</h2>";
    echo "<ul>";
    while($row = $result->fetch_assoc()) {
        echo "<li>Email: " . $row["email"]. ", Interests: " . $row["interests"]. "</li>";
    }
    echo "</ul>";
} else {
    echo "The list is empty";
}
echo '<br><a href="index.html">Back to Home</a>';
$conn->close();
// Here we have the code to display old records
?>

