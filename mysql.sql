-- Create Users table
CREATE TABLE Users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    dob DATE,
    gender ENUM('Male', 'Female'),
    phone_number VARCHAR(15),
    height DECIMAL(5,2),
    weight DECIMAL(5,2),
    bmi DECIMAL(4,2),
    medical_history TEXT,
    allergies TEXT,
    current_medications TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Create Doctors table
CREATE TABLE doctors (
    doctor_id INT AUTO_INCREMENT PRIMARY KEY,  
    first_name VARCHAR(50) NOT NULL,           
    last_name VARCHAR(50) NOT NULL,            
    email VARCHAR(100) UNIQUE NOT NULL,        
    gender ENUM('Male', 'Female') NOT NULL,
    clinic_address VARCHAR(255) NOT NULL,     
 phone_number VARCHAR(15) CHECK (LENGTH(phone_number) = 11 AND phone_number LIKE '0%'),  
   specialty VARCHAR(100),
    experience_years INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP 
);


-- Create Appointments table
CREATE TABLE Appointments (
    appointment_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    doctor_id INT NOT NULL,
    appointment_date DATE NOT NULL,
    appointment_time TIME NOT NULL,
    status VARCHAR(20) DEFAULT 'confirmed',  -- Status can be 'pending', 'confirmed', 'canceled', etc.
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES Users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (doctor_id) REFERENCES Doctors(doctor_id) ON DELETE CASCADE
);

-- Optional: Create Health Logs table (if needed to track user's health records)
CREATE TABLE Health_Logs (
    log_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    log_date DATE NOT NULL,
    symptoms TEXT,
    diagnosis VARCHAR(255),
    recommended_exercise TEXT,
    recommended_diet TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES Users(user_id) ON DELETE CASCADE
);
