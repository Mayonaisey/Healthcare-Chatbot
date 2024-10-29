<?php
// Database connection credentials
$servername = "localhost";
$username = "root";  // Replace with your database username
$password = "";  // Replace with your database password
$dbname = "medical_chatbot";  // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


      // Query to retrieve appointment details, joining with user and doctor tables for more information
      $sql1 = "
    SELECT 
        a.appointment_id, 
        a.appointment_date, 
        a.appointment_time, 
        a.status, 
        u.first_name AS user_first_name, 
        u.last_name AS user_last_name, 
        d.first_name AS doctor_first_name, 
        d.last_name AS doctor_last_name
    FROM 
        Appointments a
    JOIN 
        Users u ON a.user_id = u.user_id
    JOIN 
        Doctors d ON a.doctor_id = d.doctor_id
    ORDER BY 
        a.appointment_date, a.appointment_time
";

      // Execute query
      $result = $conn->query($sql1);
// Handle new appointment form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['UserEmail']) && isset($_POST['DoctorEmail'])) {
  // Get user and doctor emails
  $user_email = $_POST['UserEmail'];
  $doctor_email = $_POST['DoctorEmail'];
  $appointment_date = $_POST['date'];
  $appointment_time = $_POST['time'];

  // Fetch user ID based on email
  $user_result = $conn->query("SELECT user_id, first_name, last_name FROM Users WHERE email='$user_email'");
  $user = $user_result->fetch_assoc();

  // Fetch doctor ID based on email
  $doctor_result = $conn->query("SELECT doctor_id, first_name, last_name FROM doctors WHERE email='$doctor_email'");
  $doctor = $doctor_result->fetch_assoc();

  if ($user && $doctor) {
    // Insert appointment into database
    $user_id = $user['user_id'];
    $doctor_id = $doctor['doctor_id'];
    
    $sql = "INSERT INTO Appointments (user_id, doctor_id, appointment_date, appointment_time, status) 
            VALUES ('$user_id', '$doctor_id', '$appointment_date', '$appointment_time', 'confirmed')";
    
    if ($conn->query($sql) === TRUE) {
      header("Location: appointments.php");
      exit();
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
  } else {
    echo "User or Doctor not found.";
  }
}

// Close connection at the end
$conn->close();
?>
