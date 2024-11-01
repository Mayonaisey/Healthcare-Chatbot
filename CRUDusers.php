<?php
$servername="localhost";
$username = "root";
$password = "";
$dbname = "medical_chatbot";
$conn=new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("connection failed: " . $conn->connect_error);
}
$errors=[];
$data=[];
if($_SERVER['REQUEST_METHOD']==='POST'){
    if(isset($_POST['add_user'])){
        var_dump($_POST);
        $data=[
         'first_name'=>$_POST['first_name']??'',
         'last_name'=>$_POST['last_name']??'',
         'email'=>$_POST['email']??'',
         'password'=>$_POST['password']??'',
         'dob'=>$_POST['dob']??'',
         'gender' => $_POST['gender'] ?? '',
         'phone_number' => $_POST['phone_number'] ?? '',
         'height' => $_POST['height'] ?? '',
         'weight' => $_POST['weight'] ?? '',
         'medical_history' => $_POST['medical_history'] ?? '',
         'allergies' => $_POST['allergies'] ?? '',
         'current_medications' => $_POST['current_medications'] ?? '',
        ];
        if (!preg_match("/^[a-zA-Z]+$/", $data['first_name'])) {
            $errors['first_name'] = "First name must contain only characters.";
        }
        if (!preg_match("/^[a-zA-Z]+$/", $data['last_name'])) {
            $errors['last_name'] = "Last name must contain only characters.";
        }
        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Please enter a valid email address.";
        }
        $stmt=$conn->prepare("SELECT *FROM users WHERE email=?");
        $stmt->bind_param("s",$data['email']);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $errors['email'] = "This email is already taken. Please use a different email.";
        }
        if (!preg_match("/^(010|011|012)\d{8}$/", $data['phone_number'])) {
            $errors['phone_number'] = "Phone number must start with 010, 011, or 012 and contain 11 digits.";
        }
        if (!is_numeric($data['height']) || $data['height'] <= 0) {
            $errors['height'] = "Height must be a positive number.";
        }
        if (!is_numeric($data['weight']) || $data['weight'] <= 0) {
            $errors['weight'] = "Weight must be a positive number.";
        }
    
        foreach (['medical_history', 'allergies', 'current_medications'] as $field) {
            if (!preg_match("/^[a-zA-Z\s]*$/", $data[$field])) {
                $errors[$field] = ucfirst(str_replace('_', ' ', $field)) . " must contain characters only.";
            }
        }
        if(empty($errors)){
            $first_name = $data['first_name'];
            $last_name = $data['last_name'];
            $email = $data['email'];
            $password_hash=$data['password'];
            $dob = $data['dob'];
            $gender = $data['gender'];
            $phone_number = $data['phone_number'];
            $height = (float)$data['height'];
            $weight = (float)$data['weight'];
            $bmi = $weight> 0 && $height > 0 ? $weight / (($height / 100) ** 2) : null;
            $medical_history = $data['medical_history'];
            $allergies = $data['allergies'];
            $current_medications = $data['current_medications'];

            $stmt=$conn->prepare("INSERT INTO users (first_name, last_name, email, password_hash, dob, gender, phone_number, height, weight, bmi, medical_history, allergies, current_medications) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssssssdddsss",$first_name, $last_name, $email, $password_hash, $dob, $gender, $phone_number, $height, $weight, $bmi, $medical_history, $allergies, $current_medications);
            if ($stmt->execute()) {
                echo "user added successfuly";
                header("Location: " . $_SERVER['PHP_SELF']);
                exit();
            }
            else{
                echo "error:".$stmt->error;
            }
            $stmt->close();
        }
    }
}
// $conn->close();
if ($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['user_id'])){
    $id=$_POST['user_id'];
    $first_name=$_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $phone_number = $_POST['phone_number'];
    $height = $_POST['height'];
    $weight = $_POST['weight'];
    $bmi = $_POST['bmi'];
    $medical_history = $_POST['medical_history'];
    $allergies = $_POST['allergies'];
    $current_medications = $_POST['current_medications'];

    $bmi=$weight> 0 && $height >0 ? $weight/(($height/100)*($height/100)):null;
    $stmt=$conn->prepare("UPDATE Users SET first_name=?,last_name=?,email=? ,password_hash=?,dob=?,gender=?,phone_number=?,height=?, weight=?, bmi=?, medical_history=?, allergies=?, current_medications=? WHERE user_id=?");
   if (!empty($password)){
    $password_hash=$password;
    $stmt->bind_param("sssssssdddsssi",$first_name, $last_name, $email,$password, $dob, $gender, $phone_number, $height, $weight, $bmi, $medical_history, $allergies, $current_medications, $id);
   }else{
    $stmt->bind_param("sssssssdddsssi",$first_name, $last_name, $email,$password, $dob, $gender, $phone_number, $height, $weight, $bmi, $medical_history, $allergies, $current_medications, $id);
   }
   $stmt->execute();
    $stmt->close();
}

if(isset($_GET['delete_id'])){
    $delete_id=$_GET['delete_id'];
    $conn->query("DELETE FROM Users WHERE user_id = $delete_id");
}

$result=$conn->query("SELECT * FROM Users");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>User Management - Admin</title>
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
    .error{
        color:red;
    }
    .add{
        width:40%;
        margin:0 auto;
        padding:20px;
        border-radius:8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .add form input,
    .add select{
        width: 50%;
        margin-bottom:10px;
        padding:10px;
        border-radius:4px;
        box-sizing: border-box;
    }
    .add form button {
        color: white;
        border: none;
        padding: 10px;
        cursor: pointer;
        border-radius: 4px;
        transition: background-color 0.3s;
        width: 100%; 
    }
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
            <h1>Users</h1>
        <div class="add" style="text-align:center">
           <h2>add user</h2>
            <form method="POST" action="">
                First Name:<br> <input type="text" name="first_name" placeholder="First Name" value="<?= htmlspecialchars($data['first_name'] ?? '') ?>" required><br>
                Last Name:<br> <input type="text" name="last_name" placeholder="Last Name" value="<?= htmlspecialchars($data['last_name'] ?? '') ?>" required><br>
                Email: <br><input type="email" name="email" placeholder="Email"  value="<?= htmlspecialchars($data['email'] ?? '') ?>" required><br>
                Password: <br><input type="password" name="password" placeholder="Password" required><br>
                Date of Birth:<br><input type="date" name="dob" placeholder="Date of Birth"  value="<?= htmlspecialchars($data['dob'] ?? '') ?>" required><br>
                Gender:<br><select name="gender" required>
                         <option value="">Select Gender</option>
                         <option value="Male" <?= (isset($data['gender']) && $data['gender'] === 'Male') ? 'selected' : '' ?>>Male</option>
                         <option value="Female" <?= (isset($data['gender']) && $data['gender'] === 'Female') ? 'selected' : '' ?>>Female</option>
                        </select><br>
                Phone Number:<br> <input type="text" name="phone_number" placeholder="Phone Number" value="<?= htmlspecialchars($data['phone_number'] ?? '') ?>" required><br>
                Height: <br> <input type="text" name="height" placeholder="Height (cm)" value="<?= htmlspecialchars($data['height'] ?? '') ?>" required><br>
                Weight:<br><input type="text" name="weight" placeholder="Weight (kg)" value="<?= htmlspecialchars($data['weight'] ?? '') ?>" required><br>
                Medical History :<br> <input type="text" name="medical_history" placeholder="Medical History" value="<?= htmlspecialchars($data['medical_history'] ?? '') ?>" required><br>
                Allergies: <br><input type="text" name="allergies" placeholder="Allergies"  value="<?= htmlspecialchars($data['allergies'] ?? '') ?>" required><br>
                Cuurent Medications:<br><input type="text" name="current_medications" placeholder="Current Medications"  value="<?= htmlspecialchars($data['current_medications'] ?? '') ?>" required><br>
                <button type="submit" name="add_user">Add User</button>
            </form>
            <?php if(!empty($errors)):?>
            <div class="error">
                <ul>
                    <?php foreach($errors as $error):?>
                        <li><?=htmlspecialchars($error)?></li>
                        <?php endforeach;?> 
                </ul>
            </div>
            <?php endif;?>
        </div>
            <div class="title"><strong>User Table</strong></div>
            <div class="table-responsive">
              <table class="table table-striped table-hover">
                <!-- <thead> -->
                  <tr>
                  <th>User ID</th>
                  <th>First Name</th>
                 <th>Last Name</th>
                 <th>Email</th>
                 <th>Password</th>
                 <th>DOB</th>
                 <th>Gender</th>
                 <th>Phone Number</th>
                 <th>Height</th>
                 <th>Weight</th>
                 <th>BMI</th>
                 <th>Medical History</th>
                 <th>Allergies</th>
                 <th>Current Medications</th>
                 <th>Actions</th>
                  </tr>
                <!-- </thead> -->
                <tbody>
                <?php while($user=$result->fetch_assoc()):?>
            <tr id="user-<?=$user['user_id']?>">
              <form method="POST" action="" >
               <td><?= htmlspecialchars($user['user_id']) ?></td>
                <td><input type="text" name="first_name" value="<?= htmlspecialchars($user['first_name']) ?>" readonly></td>
                <td><input type="text" name="last_name" value="<?= htmlspecialchars($user['last_name']) ?>" readonly></td>
                <td><input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" readonly></td>
                <td><input type="password" name="password" value="<?= htmlspecialchars($user['password_hash']) ?>" readonly></td> 
                <td><input type="date" name="dob" value="<?= htmlspecialchars($user['dob']) ?>" readonly></td>
                <td>
                    <select name="gender" disabled>
                        <option value="Male" <?= ($user['gender'] == 'Male') ? 'selected' : '' ?>>Male</option>
                        <option value="Female" <?= ($user['gender'] == 'Female') ? 'selected' : '' ?>>Female</option>
                        <option value="Other" <?= ($user['gender'] == 'Other') ? 'selected' : '' ?>>Other</option>
                    </select>
                </td>
                <td><input type="text" name="phone_number" value="<?= htmlspecialchars($user['phone_number']) ?>" readonly></td>
                <td><input type="text" name="height" value="<?= htmlspecialchars($user['height']) ?>" readonly></td>
                <td><input type="text" name="weight" value="<?= htmlspecialchars($user['weight']) ?>" readonly></td>
                <td><input type="text" name="bmi" value="<?= htmlspecialchars($user['bmi']) ?>" readonly></td>
                <td><input type="text" name="medical_history" value="<?= htmlspecialchars($user['medical_history']) ?>" readonly></td>
                <td><input type="text" name="allergies" value="<?= htmlspecialchars($user['allergies']) ?>" readonly></td>
                <td><input type="text" name="current_medications" value="<?= htmlspecialchars($user['current_medications']) ?>" readonly></td>
                <td>
                    <div>
                     <button type="button" onclick="toggleEdit(<?= $user['user_id'] ?>)">Edit</button>
                     <button type="submit" style="display:none;" class="save-btn">Save</button>
                     <input type="hidden" name="user_id" value="<?= htmlspecialchars($user['user_id']) ?>">
                    </div>
                    <div style="text-align:center; display: block; ">
                    <button type="button" onclick="confirmDelete(<?= $user['user_id'] ?>)" >Delete</button>
                    </div>
                </td>
              </form>  
            </tr>
            <?php endwhile; ?>
        </table>
      </div>
  <!-- JavaScript files-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/popper.js/umd/popper.min.js"> </script>
  <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
  <script src="vendor/jquery.cookie/jquery.cookie.js"> </script>
  <script src="vendor/chart.js/Chart.min.js"></script>
  <script src="vendor/jquery-validation/jquery.validate.min.js"></script>
  <script src="js/front.js"></script>
  <script>
        let originalValues={};
        function toggleEdit(userId){
            const row=document.getElementById(`user-${userId}`);
            const inputs=row.querySelectorAll('input, select');
            const editButton = row.querySelector('button[type="button"]:first-of-type');
            const saveButton = row.querySelector('.save-btn');
            const bmiInput = row.querySelector('input[name="bmi"]');
            const pass=row.querySelector('input[name="password"]');
            if (editButton.innerText==='Edit'){
                inputs.forEach(input=>{
                    originalValues[input.name]=input.value;
                });
            
            inputs.forEach(input => {
             input.readOnly = false; 
                if(input.name==='bmi'){
                  bmiInput.readOnly=true;
                }
                // if(input.name==='password'){
                // pass.password_hash($password,PASSWORD_BCRYPT);
                // }
                if (input.tagName === 'SELECT') {
                 input.disabled = false; 
                }
            });
               pass.type='text';
               editButton.innerText = 'Cancel';
               saveButton.style.display = 'inline'; 
            } else {
                inputs.forEach(input => {
                 input.readOnly = true; 
                    if (input.tagName === 'SELECT') {
                     input.disabled = true; 
                    }
                    input.value=originalValues[input.name];
                });
                pass.type='password';
                editButton.innerText = 'Edit';
                saveButton.style.display = 'none';
            }
        }

        function confirmDelete(userId) {
            if (confirm('Are you sure you want to delete this user?')) {
             window.location.href = '?delete_id=' + userId;
            }
        }
    function validateForm(row){
        const inputs =row.querySelectorAll('input, select');
        let isValid = true;
        inputs.forEach(input=>{
            input.style.borderColor='';
            if(input.tagName==='INPUT'&&input.type!='hidden'){
                if(input.value.trim()===''){
                    isValid=false;
                    input.style.borderColor='red';
                    alert(`${input.name} cannot be empty`);
                }else if(input.name==='first_name'||input.name==='last_name'){
                    const nameRegex=/^[A-Za-z]+$/;
                    if(!nameRegex.test(input.value)){
                        isValid=false;
                        input.style.borderColor='red';
                        alert(`${input.name} must contain characters only.`);
                    }
                }else if(input.name==='phone_number'){
                    const phoneRegex=/^(010|011|012)[0-9]{8}$/;
                    if(!phoneRegex.test(input.value)){
                        isValid=false;
                        input.style.borderColor='red';
                        alert('Phone number must contain 11 digits and start with 010, 011, or 012.');
                    }
                }else if(input.name === 'height' || input.name === 'weight'){
                    const numberRegex = /^[0-9]+(\.[0-9]+)?$/; // Allows decimal numbers
                    if (!numberRegex.test(input.value)) {
                        isValid = false;
                        input.style.borderColor = 'red'; // Highlight invalid input
                        alert(`${input.name} must be a number.`);
                    }
                }else if(input.name === 'medical_history' || input.name === 'allergies' || input.name === 'current_medications'){
                    const charRegex = /^[A-Za-z\s]+$/; // Allows letters and spaces
                    if (!charRegex.test(input.value)) {
                      isValid = false;
                      input.style.borderColor = 'red'; // Highlight invalid input
                      alert(`${input.name} must contain characters only.`);
                    }
                }else if(input.type==='email'&&!validateEmail(input.value)){
                    isValid = false;
                input.style.borderColor = 'red'; // Highlight invalid input
                alert('Please enter a valid email address.');
                }
            }
        });
        return isValid;
    }
    function validateEmail(email) {
      const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      return re.test(String(email).toLowerCase());
    }

    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', function(event) {
           const userRow = this.closest('tr');
            if (!validateForm(userRow)) {
              event.preventDefault(); 
            }
        });
    });
    document.querySelectorAll('form').forEach(form=>{
        const height=form.queryselector('input[name="height"]');
        const weight=form.queryselector('input[name="weight"]');
        const BMI=form.queryselector('input[name="bmi"]');
        BMI.readonly=ture;
        function calcutateBMI(){
            const heightInput=parseFloat(height.value);
            const weightInput=pasreFloat(weight.value);
            if(heightInput>0 && weightInput>0){
                const bmi=(weightInput/((heightInput/100)**2)).toFixed(2);
                BMI.value=bmi;
            }else{
                BMI.value='';
            }
        }
        height.addEventListener('input',calcutateBMI);
        weight.addEventListener('input',calcutateBMI);
        form.addEventListener('submit',function(event){
            const userRow=this.closest('tr');
            if(!validateForm(userRow)){
                event.preventDefault();
            }
        });
    });
    </script>
</body>
</html>
<?php
 $conn->close();
 ?>