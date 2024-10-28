<?php
$servername="localhost";
$username = "root";
$password = "";
$dbname = "mysql;";
$conn=new mysqli($servername, $username, $password, $dbname);

if($conn->connect_error){
    die("connection failed:".$conn->connect_error);
}
$errors=[];
$data=[];
if($_SERVER['REQUEST_METHOD']==='POST'){
    if(isset($_POST['add_user'])){
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
            $password_hash = password_hash($data['password'], PASSWORD_DEFAULT);
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
            $password_hash=password_hash($password,PASSWORD_DEFAULT);
            $stmt->bind_param("sssssssdddsss",$first_name, $last_name, $email, $password_hash, $dob, $gender, $phone_number, $height, $weight, $bmi, $medical_history, $allergies, $current_medications);
            if ($stmt->execute()) {
                echo "user added successfuly";
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
    $password_hash=password_hash($password,PASSWORD_DEFAULT);
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management - Admin</title>
    <style>
     body{
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 20px;
     }
     .error{
        color:red;
     }
     .add{
        width:40%;
        margin:0 auto;
        padding:20px;
        background-color: #fff;
        border-radius:8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
     }
     .add form input,
     .add select{
        width: 50%;
        margin-bottom:10px;
        padding:10px;
        border:1px solid #ccc;
        border-radius:4px;
        justify-content:center;
     }
     .table-responsive {
        overflow-x: hidden; 
     }

     table {
      width: 100%; 
      border-collapse: collapse;
      table-layout: fixed; 
     }

     th, td {
      padding: 8px; 
      text-align: left;
      border: 1px solid #ddd;
      overflow: hidden; 
      text-overflow: ellipsis; 
      white-space: nowrap; 
     }

     th {
      background-color: #f2f2f2;
     }

     tr:hover {
     background-color: #f5f5f5;
     }

     td:nth-child(1), th:nth-child(1) { width: 8%; } /* User ID */
     td:nth-child(2), th:nth-child(2) { width: 12%; } /* First Name */
     td:nth-child(3), th:nth-child(3) { width: 12%; } /* Last Name */
     td:nth-child(4), th:nth-child(4) { width: 20%; } /* Email */
     td:nth-child(5), th:nth-child(5) { width: 15%; } /*password*/
     td:nth-child(6), th:nth-child(6) { width: 12%; } /* DOB */
     td:nth-child(7), th:nth-child(7) { width: 7%; } /* Gender */
     td:nth-child(8), th:nth-child(8) { width: 10%; }  /* Phone Number */
     td:nth-child(9), th:nth-child(9) { width: 7%; }  /* Height */
     td:nth-child(10), th:nth-child(10) { width: 5%; } /* Weight */
     td:nth-child(11), th:nth-child(11) { width: 5%; } /* BMI */
     td:nth-child(12), th:nth-child(12) { width: 10%; } /* Medical History */
     td:nth-child(13), th:nth-child(13) { width: 10%; } /* Allergies */
     td:nth-child(14), th:nth-child(14) { width: 10%; } /* Current Medications */
     td:nth-child(15), th:nth-child(15) { width: 15%; } /* Actions */

     .save-btn {
      display: none;
     }

     td>div{
      text-align:center;
     }
      
     button {
      margin-bottom: 5px; 
      padding: 5px 10px; 
      cursor: pointer;  
     }
     button:hover{
        cursor:pointer;
     }

     input[type="text"], input[type="email"], input[type="date"], input[type="password"], select {
      width: 100%; 
      padding: 5px; 
      box-sizing: border-box; 
     }

     @media (max-width: 768px) {
      th, td {
        font-size: 12px; 
        padding: 5px; 
        white-space: normal; 
      }
     }

    </style>
    </head>
    <body>
        <h1>Users</h1>
        <div class="add" style="text-align:center">
           <h2>add user</h2>
            <form method="POST" action="">
                First Name: <input type="text" name="first_name" placeholder="First Name" value="<?= htmlspecialchars($data['first_name'] ?? '') ?>" required><br>
                Last Name: <input type="text" name="last_name" placeholder="Last Name" value="<?= htmlspecialchars($data['last_name'] ?? '') ?>" required><br>
                Email: <input type="email" name="email" placeholder="Email"  value="<?= htmlspecialchars($data['email'] ?? '') ?>" required><br>
                Password: <input type="password" name="password" placeholder="Password" required><br>
                Date of Birth:<input type="date" name="dob" placeholder="Date of Birth"  value="<?= htmlspecialchars($data['dob'] ?? '') ?>" required><br>
                Gender:<select name="gender" required>
                         <option value="">Select Gender</option>
                         <option value="Male" <?= (isset($data['gender']) && $data['gender'] === 'Male') ? 'selected' : '' ?>>Male</option>
                         <option value="Female" <?= (isset($data['gender']) && $data['gender'] === 'Female') ? 'selected' : '' ?>>Female</option>
                        </select><br>
                Phone Number: <input type="text" name="phone_number" placeholder="Phone Number" value="<?= htmlspecialchars($data['phone_number'] ?? '') ?>" required><br>
                Height:  <input type="text" name="height" placeholder="Height (cm)" value="<?= htmlspecialchars($data['height'] ?? '') ?>" required><br>
                Weight:<input type="text" name="weight" placeholder="Weight (kg)" value="<?= htmlspecialchars($data['weight'] ?? '') ?>" required><br>
                Medical History : <input type="text" name="medical_history" placeholder="Medical History" value="<?= htmlspecialchars($data['medical_history'] ?? '') ?>" required><br>
                Allergies: <input type="text" name="allergies" placeholder="Allergies"  value="<?= htmlspecialchars($data['allergies'] ?? '') ?>" required><br>
                Cuurent Medications:<input type="text" name="current_medications" placeholder="Current Medications"  value="<?= htmlspecialchars($data['current_medications'] ?? '') ?>" required><br>
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
        <h2>User list</h2>
     <div class="table_responsive">
        <table >
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