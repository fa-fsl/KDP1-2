<?php
$servername = "localhost";
$username = "root"; // Ubah sesuai konfigurasi Anda
$password = "";
$dbname = "OpetCoffee";

// Buat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// CREATE
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];

    $sql = "INSERT INTO users (name, email, phone, message) VALUES ('$name', '$email', '$phone', '$message')";
    if ($conn->query($sql) === TRUE) {
        // Jika berhasil, arahkan ke index.html
        header("Location: index.html");
        exit(); // Hentikan script setelah redirect
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// READ
$sql = "SELECT * FROM users";
$result = $conn->query($sql);
?>
