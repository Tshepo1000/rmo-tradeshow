# rmo-tradeshow
A PHP, HTML, CSS, and JavaScript system for managing suppliers and tradeshow data for Ridgeline Mountain Outfitters.

# Ridgeline Mountain Outfitters — Tradeshow Supplier Management System

A lightweight, secure PHP and MySQL web application designed for **Ridgeline Mountain Outfitters (RMO)** to manage, track, and streamline supplier information collected during seasonal tradeshows.

This system replaces manual spreadsheets with a fast, structured database solution featuring responsive layout grids and dual-layer data validation.

---

## 🚀 Features

*   **Dynamic Navigation System:** Handled via PHP backend routing to automatically apply active link states (`class="active"`) based on the current URI viewport.
*   **Structured Grid Layout:** Built entirely with CSS Grid (`grid-template-columns: max-content 1fr;`) ensuring perfect side-by-side field alignment where inputs dynamically stretch while text labels remain neatly packed to their content width.
*   **Robust Client-Side Validation:** Form submission is intercepted via JavaScript event listeners to inspect values against RegEx patterns—preventing page reloads on bad data and providing inline visual error states.
*   **Secure CRUD Actions:** Incorporates backend workflows to view, insert, and delete records cleanly. The delete sequence utilizes parameterized prepared statements in PHP to safeguard against SQL Injection vulnerabilities.

---

## 🛠️ Tech Stack

*   **Backend:** PHP 8.x
*   **Database:** MySQL / MariaDB
*   **Frontend:** HTML5, CSS3 (CSS Grid & Flexbox), Vanilla JavaScript
*   **Version Control:** Git & GitHub

---

## 📂 Project Structure

```text
rmo-tradeshow/
│
├── index.php                 # Main dashboard / entry point
├── db_connect.php            # MySQL database connection configuration
├── style.css                 # Universal stylesheet (Form Grids, Navigation, Layouts)
│
└── supplier/
    ├── list.php              # Tabular view of all registered suppliers + action hooks
    ├── add.php               # Front-facing registration form with JavaScript validation
    ├── insert.php            # Secure backend processing script for record creation
    └── delete.php            # Parameterized extraction script for safe record deletion

⚙️ Setup & Installation
Prerequisite
Make sure you have a local web server solution installed (e.g., XAMPP, WAMP, or MAMP).

1. Clone the Repository
Navigate to your local server root directory (htdocs or www) and clone this repository:

Bash
git clone [https://github.com/tshepo1000/rmo-tradeshow.git](https://github.com/tshepo1000/rmo-tradeshow.git)
2. Configure the Database
Open phpMyAdmin (http://localhost/phpmyadmin).

Create a new database named rmo_tradeshow.

Import your table schema or execute the SQL statement below:

SQL
CREATE TABLE suppliers (
    SupplierID INT AUTO_INCREMENT PRIMARY KEY,
    Name VARCHAR(255) NOT NULL,
    SupplierEmail VARCHAR(255) NOT NULL,
    ContactNumber VARCHAR(255) NOT NULL,
    Address1 VARCHAR(255) NOT NULL,
    City VARCHAR(100) NOT NULL,
    StateProvince VARCHAR(100) NOT NULL,
    PostalCode VARCHAR(20) NOT NULL,
    Country VARCHAR(100) NOT NULL,
    SupplierWebURL VARCHAR(255) NOT NULL,
    Comments TEXT,
    CreatedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
3. Link Environment Credentials
Open db_connect.php and update your MySQL connection configurations if different from defaults:

PHP
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "rmo_tradeshow";

$conn = new mysqli($servername, $username, $password, $dbname);
4. Run the Application
Open your browser and navigate to:
http://localhost/rmo/rmo-tradeshow/

🔒 Security Practices Implemented
SQL Injection Prevention: All mutations targeting the database layer (such as deletions inside supplier/delete.php) utilize native PHP mysqli::prepare operations to bind input tokens securely.

Data Integrity: Combined native HTML5 constraints, rigorous client-side regex checking, and backend sanitization parameters to enforce valid entries.
