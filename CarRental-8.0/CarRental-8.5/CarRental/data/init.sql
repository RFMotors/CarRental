CREATE DATABASE IF NOT EXISTS car_rental;
USE car_rental;

CREATE TABLE IF NOT EXISTS Admin (
                                     idAdmin INT AUTO_INCREMENT PRIMARY KEY,
                                     firstName VARCHAR(50) NOT NULL,
    lastName VARCHAR(50) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    phoneNumber VARCHAR(20) NOT NULL
    );

CREATE TABLE IF NOT EXISTS Client (
                                      idClient INT AUTO_INCREMENT PRIMARY KEY,
                                      firstName VARCHAR(45) NOT NULL,
    secondName VARCHAR(45) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    phoneNumber VARCHAR(20) NOT NULL,
    address VARCHAR(200),
    dateOfBirth DATE,
    driverLicenseNumber VARCHAR(45) UNIQUE NOT NULL
    );

CREATE TABLE IF NOT EXISTS Car (
                                   CarID INT AUTO_INCREMENT PRIMARY KEY,
                                   Make VARCHAR(50) NOT NULL,
    Model VARCHAR(50) NOT NULL,
    Year YEAR NOT NULL,
    RegNumber VARCHAR(20) UNIQUE NOT NULL,
    PricePerDay DECIMAL(10,2) NOT NULL,
    EngineType VARCHAR(30),
    AvailabilityStatus VARCHAR(20) DEFAULT 'Available' CHECK (AvailabilityStatus IN ('Available', 'Rented'))
    );

CREATE TABLE IF NOT EXISTS Booking (
                                       idBooking INT AUTO_INCREMENT PRIMARY KEY,
                                       paymentDate DATE DEFAULT NULL,
                                       startDate DATE NOT NULL,
                                       endDate DATE NOT NULL,
                                       totalPrice DECIMAL(10,2) NOT NULL,
    bookingStatus VARCHAR(20) DEFAULT 'Pending',
    Client_idClient INT NOT NULL,
    Car_idCar INT NOT NULL,
    FOREIGN KEY (Client_idClient) REFERENCES Client(idClient) ON DELETE CASCADE,
    FOREIGN KEY (Car_idCar) REFERENCES Car(CarID) ON DELETE CASCADE
    );

CREATE TABLE IF NOT EXISTS Payment (
                                       idPayment INT AUTO_INCREMENT PRIMARY KEY,
                                       paymentDate DATE NOT NULL,
                                       amount DECIMAL(10,2) NOT NULL,
    paymentMethod VARCHAR(50) CHECK (paymentMethod IN ('Credit Card', 'Debit Card', 'PayPal', 'Cash')),
    paymentStatus VARCHAR(20) DEFAULT 'Pending',
    Booking_idBooking INT NOT NULL,
    FOREIGN KEY (Booking_idBooking) REFERENCES Booking(idBooking) ON DELETE CASCADE
    );

-- Insert Sample Data
INSERT INTO Admin (firstName, lastName, email, password, phoneNumber)
VALUES ('John', 'Doe', 'admin@rental.com', SHA2('admin123', 256), '1234567890');

INSERT INTO Car (Make, Model, Year, RegNumber, PricePerDay, EngineType, AvailabilityStatus)
VALUES
    ('Toyota', 'Corolla', 2020, 'REG001', 50.00, 'Petrol', 'Available'),
    ('Honda', 'Civic', 2021, 'REG002', 60.00, 'Diesel', 'Available'),
    ('Ford', 'Focus', 2019, 'REG003', 45.00, 'Electric', 'Rented');
