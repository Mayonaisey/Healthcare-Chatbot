CREATE TABLE doctors (
    doctor_id INT AUTO_INCREMENT PRIMARY KEY,  
    first_name VARCHAR(50) NOT NULL,           
    last_name VARCHAR(50) NOT NULL,            
    email VARCHAR(100) UNIQUE NOT NULL,        
    password_hashed VARCHAR(255) NOT NULL,    
    gender ENUM('Male', 'Female') NOT NULL,
    clinic_address VARCHAR(255) NOT NULL,     
 phone_number VARCHAR(15) CHECK (LENGTH(phone_number) = 11 AND phone_number LIKE '0%'),    specialty VARCHAR(100),
    experience_years INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP 
);

