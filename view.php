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
if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];

    $sql = "INSERT INTO users (name, email, phone, message) VALUES ('$name', '$email', '$phone', '$message')";
    if ($conn->query($sql) === TRUE) {
        header("Location: view.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// UPDATE
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];

    $sql = "UPDATE users SET name='$name', email='$email', phone='$phone', message='$message' WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        header("Location: view.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// DELETE
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $sql = "DELETE FROM users WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        header("Location: view.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// READ
$sql = "SELECT * FROM users";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pengguna</title>
    <style>
        /* Tambahkan CSS di sini (seperti yang sebelumnya) */
        body {
            background-color: #010101;
            color: white;
            font-family: 'Poppins', sans-serif;
            padding: 20px;
        }
        table {
            width: 90%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
            font-size: 1rem;
            text-align: left;
        }
        table th, table td {
            padding: 10px;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        table th {
            background-color: #b6895b;
        }
        .form-container {
            width: 90%;
            margin: 20px auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
        }
        .form-container input, .form-container textarea {
            width: calc(100% - 20px);
            padding: 10px;
            margin: 10px 0;
            border: none;
            border-radius: 5px;
        }
        .form-container button {
            padding: 10px 20px;
            background-color: #b6895b;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .form-container button:hover {
            background-color: #8c6946;
        }
        .action-btn {
            display: inline-block;
            margin-right: 10px;
            padding: 5px 10px;
            background-color: #b6895b;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .action-btn:hover {
            background-color: #8c6946;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Tambah Pengguna</h2>
        <form method="POST" action="">
            <input type="text" name="name" placeholder="Nama Lengkap" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="text" name="phone" placeholder="Nomor Telepon">
            <textarea name="message" placeholder="Pesan"></textarea>
            <button type="submit" name="add">Tambah</button>
        </form>
    </div>

    <h1 style="text-align: center;">Daftar Pengguna</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Telepon</th>
                <th>Pesan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['name'] ?></td>
                <td><?= $row['email'] ?></td>
                <td><?= $row['phone'] ?></td>
                <td><?= $row['message'] ?></td>
                <td>
                    <a href="view.php?delete=<?= $row['id'] ?>" class="action-btn">Hapus</a>
                    <form method="POST" action="" style="display: inline-block;">
                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                        <input type="text" name="name" value="<?= $row['name'] ?>" required>
                        <input type="email" name="email" value="<?= $row['email'] ?>" required>
                        <input type="text" name="phone" value="<?= $row['phone'] ?>">
                        <textarea name="message"><?= $row['message'] ?></textarea>
                        <button type="submit" name="update">Ubah</button>
                    </form>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
