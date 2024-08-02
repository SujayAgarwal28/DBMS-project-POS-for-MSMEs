# Retail Store Management System

The Retail Store Management System is a web-based application designed to streamline retail store operations. Built with PHP and MySQL, it offers comprehensive tools for managing products, customers, orders, employees, and suppliers.

## Key Features

- Product Management
- Customer Management
- Order Management
- Employee Management
- Supplier Management
- Store Management
- Reports and Analytics

## Technologies Used

- Frontend: HTML, CSS, JavaScript, Bootstrap
- Backend: PHP, MySQL
- Web Server: Apache HTTP Server

## Project Objectives

- Provide a user-friendly interface for managing retail operations.
- Automate tasks and reduce manual errors.
- Provide real-time data for informed decision-making.
- Improve customer satisfaction through efficient service delivery.
- Enhance overall productivity and efficiency.

## Future Enhancements

- Integration with E-commerce Platforms
- Mobile Application
- Advanced Analytics
- Customer Loyalty Program

## Getting Started

Follow these instructions to get a copy of the project up and running on your local machine for development and testing purposes.

### Prerequisites

Make sure you have the following software installed on your computer:

- [XAMPP](https://www.apachefriends.org/index.html) (Includes Apache, MySQL, PHP, and phpMyAdmin)
- Git

### Installation

1. **Clone the Repository**

   - Open your terminal or command prompt and run the following command to clone the repository to your local machine:

   ```sh
   git clone https://github.com/SujayAgarwal28/DBMS-project-POS-for-MSMEs
Replace yourusername with your GitHub username.

2. **Start XAMPP**

  - Open XAMPP and start the Apache and MySQL modules.

3. **Set Up the Database**

  - Open your web browser and go to http://localhost/phpmyadmin.
  - Create a new database named retailstore.
  - Import the database schema by selecting the retailstore.sql file from the project directory. Click on the Import tab in phpMyAdmin and choose the file to import.

4. **Configure the Project**

  - Navigate to the project directory and open the db.php file.

  - Update the database connection settings if necessary (default settings should work if you are using XAMPP):
    ```sh
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "retailstore";

5. **Move the Project to XAMPP's htdocs Directory**

  - Copy the project folder (retail-store-management) and paste it into the htdocs directory of your XAMPP installation. The default path for htdocs is C:\xampp\htdocs.

6. **Access the Application**

  - Open your web browser and go to http://localhost/retail-store-management.
  - You should now see the Retail Store Management System's homepage. You can start exploring and using the various features of the application.

### Conclusion
  - This project aims to provide an efficient and user-friendly solution for managing retail store operations. We welcome any contributions or suggestions for future enhancements.
