<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "medical_chatbot";  

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Handle form submission for adding a new doctor
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['first_name']) && !isset($_POST['doctor_id_edit'])) {
  // Get form data
  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];
  $email = $_POST['email'];
  $gender = $_POST['gender'];
  $clinic_address = $_POST['clinic_address'];
  $phone_number = $_POST['phone_number'];
  $specialty = $_POST['specialty'];
  $experience_years = $_POST['experience_years'];

  // Insert data into the table
  $sql = "INSERT INTO doctors (first_name, last_name, email, gender, clinic_address, phone_number, specialty, experience_years) 
            VALUES ('$first_name', '$last_name', '$email', '$gender', '$clinic_address', '$phone_number', '$specialty', '$experience_years')";
            
          

  if ($conn->query($sql) === TRUE) {
    header("Location:tables.php");
    exit();
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}

// Handle deletion of a doctor
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_doctor'])) {
  $doctor_id = $_POST['doctor_id'];

  $sql = "DELETE FROM doctors WHERE doctor_id = $doctor_id";
  


  if ($conn->query($sql) === TRUE) {
    header("Location:tables.php");
    exit();
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}

// Handle editing of doctor data
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['doctor_id_edit'])) {
  $doctor_id = $_POST['doctor_id_edit'];
  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];
  $email = $_POST['email'];
  $gender = $_POST['gender'];
  $clinic_address = $_POST['clinic_address'];
  $phone_number = $_POST['phone_number'];
  $specialty = $_POST['specialty'];
  $experience_years = $_POST['experience_years'];

  // Update the doctor's data
  $sql = "UPDATE doctors 
          SET first_name='$first_name', last_name='$last_name', email='$email', gender='$gender', 
              clinic_address='$clinic_address', phone_number='$phone_number', specialty='$specialty', 
              experience_years='$experience_years'
          WHERE doctor_id=$doctor_id";



  if ($conn->query($sql) === TRUE) {
    header("Location: tables.php");
    exit();
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}


// Close connection
$conn->close();
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Doctors List </title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="robots" content="all,follow">
  <!-- Bootstrap CSS-->
  <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome CSS-->
  <link rel="stylesheet" href="vendor/font-awesome/css/font-awesome.min.css">
  <!-- Custom Font Icons CSS-->
  <link rel="stylesheet" href="css/font.css">
  <!-- Google fonts - Muli-->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:300,400,700">
  <!-- theme stylesheet-->
  <link rel="stylesheet" href="css/style.default.css" id="theme-stylesheet">
  <!-- Custom stylesheet - for your changes-->
  <link rel="stylesheet" href="css/custom.css">
  <!-- Favicon-->
  <link rel="shortcut icon" href="img/favicon.ico">


  <style>
    table {
      width: 100%;
      border-collapse: collapse;
    }

    table,
    th,
    td {
      border: 1px solid black;
    }

    th,
    td {
      padding: 10px;
      text-align: left;
    }

    .form-row {
      display: none;
    }

    .form-row input,
    .form-row select {
      width: 100%;
    }

    .form-row td {
      padding: 5px;
    }

    #add-button {
      margin-bottom: 10px;
      color:  #ced4da;
      background-color: #6c757d;


    }
    button{
      color:  #ced4da;
      background-color: #6c757d;
    }

    .edit-form {
      display: none;
    }

    .form-row, .edit-form {
    display: none; /* Hide the rows initially */
  }
  </style>
  <script>
    function showAddDoctorForm() {
    document.getElementById('add-doctor-row').style.display = 'table-row';
}

function showEditDoctorForm(doctorId, firstName, lastName, email, gender, clinicAddress, phoneNumber, specialty, experienceYears) {
    document.getElementById('doctor_id_edit').value = doctorId;
    document.getElementById('edit_first_name').value = firstName;
    document.getElementById('edit_last_name').value = lastName;
    document.getElementById('edit_email').value = email;
    document.getElementById('edit_gender').value = gender;
    document.getElementById('edit_clinic_address').value = clinicAddress;
    document.getElementById('edit_phone_number').value = phoneNumber;
    document.getElementById('edit_specialty').value = specialty;
    document.getElementById('edit_experience_years').value = experienceYears;
    document.getElementById('edit-doctor-row').style.display = 'table-row';
}

  </script>
</head>

<body>

  <!--el header file henaaaa-->
   <?php include 'header.html';?>

  <div class="d-flex align-items-stretch">
  <!--sideee-->
  <?php include 'side.html';?>

      <section class="no-padding-top">
        <div class="container-fluid">


          <div class="block">
            <!-- Add Doctor Button -->
            <button id="add-button" onclick="showAddDoctorForm()">Add Doctor</button>

            <div class="title"><strong>Doctors Table</strong></div>
            <div class="table-responsive">
              <table class="table table-striped table-hover">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Gender</th>
                    <th>Clinic Address</th>
                    <th>Phone Number</th>
                    <th>Specialty</th>
                    <th>Experience (Years)</th>
                    <th>Created At</th>
                    <th>...</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $conn = new mysqli("localhost", "root", "", "medical_chatbot");
                  
                


                  if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                  }

                  $sql = "SELECT doctor_id, first_name, last_name, email, gender, clinic_address, phone_number, specialty, experience_years, created_at FROM doctors";
                  $result = $conn->query($sql);
                  if (!$result) {
                    die("Query failed  fe 244 ya zee: " . $conn->error);
                }
                

                  if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                      echo "<tr>
                        <td>" . $row["doctor_id"] . "</td>
                        <td>" . $row["first_name"] . "</td>
                        <td>" . $row["last_name"] . "</td>
                        <td>" . $row["email"] . "</td>
                        <td>" . $row["gender"] . "</td>
                        <td>" . $row["clinic_address"] . "</td>
                        <td>" . $row["phone_number"] . "</td>
                        <td>" . $row["specialty"] . "</td>
                        <td>" . $row["experience_years"] . "</td>
                        <td>" . $row["created_at"] . "</td>
                        <td>
                            <!-- Edit button -->
                            <button onclick=\"showEditDoctorForm(
                                '" . $row["doctor_id"] . "',
                                '" . $row["first_name"] . "',
                                '" . $row["last_name"] . "',
                                '" . $row["email"] . "',
                                '" . $row["gender"] . "',
                                '" . $row["clinic_address"] . "',
                                '" . $row["phone_number"] . "',
                                '" . $row["specialty"] . "',
                                '" . $row["experience_years"] . "'
                            )\">Edit</button>

                            <!-- Delete button -->
                            <form action='tables.php' method='POST' style='display:inline;'>
                                <input type='hidden' name='doctor_id' value='" . $row["doctor_id"] . "'>
                                <button type='submit' name='delete_doctor'>Delete</button>
                            </form>
                        </td>
                      </tr>";
                    }
                  } else {
                    echo "<tr><td colspan='12'>No data found</td></tr>";
                  }

                  $conn->close();
                  ?>

                  <!-- Form Row for Adding a New Doctor -->
                  <tr id="add-doctor-row" class="form-row">
                    <form action="tables.php" method="POST">
                      <td>#</td>
                      <td><input type="text" name="first_name" required></td>
                      <td><input type="text" name="last_name" required></td>
                      <td><input type="email" name="email" required></td>
                      <td>
                        <select name="gender" required>
                          <option value="Male">Male</option>
                          <option value="Female">Female</option>
                        </select>
                      </td>
                      <td><input type="text" name="clinic_address" required></td>
                      <td><input type="text" name="phone_number" pattern="0[0-9]{10}" required></td>
                      <td>
                        <select name="specialty" required>
                          <option value="Cardiology">Cardiology</option>
                          <option value="Dermatology">Dermatology</option>
                          <option value="Emergency Medicine">Emergency Medicine</option>
                          <option value="Family Medicine">Family Medicine</option>
                          <option value="Internal Medicine">Internal Medicine</option>
                          <option value="Neurology">Neurology</option>
                          <option value="Obstetrics and Gynecology">Obstetrics and Gynecology</option>
                          <option value="Pediatrics">Pediatrics</option>
                          <option value="Psychiatry">Psychiatry</option>
                          <option value="Surgery">Surgery</option>
                          <option value="Ophthalmology">Ophthalmology</option>
                          <option value="Orthopedics">Orthopedics</option>
                          <option value="Anesthesiology">Anesthesiology</option>
                          <option value="Radiology">Radiology</option>
                          <option value="Gastroenterology">Gastroenterology</option>
                        </select>
                      </td>
                      <td><input type="number" name="experience_years" min="0" max="11"></td>
                      <td colspan="2">
                        <button type="submit">Add Doctor</button>
                      </td>
                    </form>
                  </tr>

                  <!-- Form Row for Editing doctor -->
                  <tr id="edit-doctor-row" class="form-row edit-form">
                    <form action="tables.php" method="POST">
                      <td>#</td>
                      <td><input type="hidden" id="doctor_id_edit" name="doctor_id_edit">
                        <input type="text" id="edit_first_name" name="first_name" required>
                      </td>
                      <td><input type="text" id="edit_last_name" name="last_name" required></td>
                      <td><input type="email" id="edit_email" name="email" required></td>
                      <td>
                        <select id="edit_gender" name="gender" required>
                          <option value="Male">Male</option>
                          <option value="Female">Female</option>
                        </select>
                      </td>
                      <td><input type="text" id="edit_clinic_address" name="clinic_address" required></td>
                      <td><input type="text" id="edit_phone_number" name="phone_number" pattern="0[0-9]{10}" required></td>
                      <td> <select name="specialty" required>
                          <option value="Cardiology">Cardiology</option>
                          <option value="Dermatology">Dermatology</option>
                          <option value="Emergency Medicine">Emergency Medicine</option>
                          <option value="Family Medicine">Family Medicine</option>
                          <option value="Internal Medicine">Internal Medicine</option>
                          <option value="Neurology">Neurology</option>
                          <option value="Obstetrics and Gynecology">Obstetrics and Gynecology</option>
                          <option value="Pediatrics">Pediatrics</option>
                          <option value="Psychiatry">Psychiatry</option>
                          <option value="Surgery">Surgery</option>
                          <option value="Ophthalmology">Ophthalmology</option>
                          <option value="Orthopedics">Orthopedics</option>
                          <option value="Anesthesiology">Anesthesiology</option>
                          <option value="Radiology">Radiology</option>
                          <option value="Gastroenterology">Gastroenterology</option>
                        </select></td>
                      <td><input type="number" id="edit_experience_years" name="experience_years" min="0" max="11"></td>
                      <td colspan="2">
                        <button type="submit">Save Changes</button>
                      </td>
                    </form>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>

    </div>
  </div>
  </section>
  <?php include 'footer.html';?>

  </div>
  </div>
  <!-- JavaScript files-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/popper.js/umd/popper.min.js"> </script>
  <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
  <script src="vendor/jquery.cookie/jquery.cookie.js"> </script>
  <script src="vendor/chart.js/Chart.min.js"></script>
  <script src="vendor/jquery-validation/jquery.validate.min.js"></script>
  <script src="js/front.js"></script>
</body>

</html>