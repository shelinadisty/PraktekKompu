<?php
// File tempat menyimpan data
$file = "data.json";

// Baca data dari file JSON
if (file_exists($file)) {
    $data = json_decode(file_get_contents($file), true);
} else {
    $data = [];
}

// Simpan data baru
if (isset($_POST['submit'])) {
    $nama = htmlspecialchars($_POST['nama']);
    $email = htmlspecialchars($_POST['email']);
    $pesan = htmlspecialchars($_POST['pesan']);

    $data[] = [
        "nama" => $nama,
        "email" => $email,
        "pesan" => $pesan
    ];

    file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT));
    header("Location: " . $_SERVER['PHP_SELF']); // Refresh halaman agar data tampil langsung
    exit;
}

// Hapus data
if (isset($_GET['hapus'])) {
    $index = $_GET['hapus'];
    unset($data[$index]);
    $data = array_values($data);
    file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT));
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buku Tamu Online</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(120deg, #004d40, #2e7d32, #a8e063);
            margin: 0;
            padding: 0;
            color: #333;
            background-attachment: fixed;
        }

        .container {
            max-width: 900px;
            background: #ffffffee;
            margin: 60px auto;
            border-radius: 20px;
            padding: 30px 40px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
        }

        h1 {
            text-align: center;
            color: #1b5e20;
            margin-bottom: 20px;
        }

        h2 {
            color: #2e7d32;
            border-bottom: 3px solid #66bb6a;
            padding-bottom: 5px;
        }

        form label {
            font-weight: bold;
            color: #1b5e20;
        }

        form input[type="text"], form input[type="email"], form textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            border-radius: 8px;
            border: 1px solid #81c784;
            font-size: 15px;
            transition: 0.3s;
        }

        form input[type="text"]:focus, form input[type="email"]:focus, form textarea:focus {
            border-color: #2e7d32;
            box-shadow: 0 0 6px #66bb6a;
            outline: none;
        }

        form input[type="submit"] {
            background-color: #2e7d32;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s;
        }

        form input[type="submit"]:hover {
            background-color: #1b5e20;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 25px;
            text-align: left;
        }

        table th, table td {
            border: 1px solid #c8e6c9;
            padding: 10px;
        }

        table th {
            background-color: #a5d6a7;
            color: #1b5e20;
        }

        table tr:nth-child(even) {
            background-color: #f1f8e9;
        }

        .btn {
            padding: 6px 12px;
            border: none;
            border-radius: 6px;
            font-size: 14px;
            cursor: pointer;
            text-decoration: none;
        }

        .btn-hapus {
            background-color: #c62828;
            color: white;
        }

        .btn-hapus:hover {
            background-color: #b71c1c;
        }

        footer {
            text-align: center;
            margin-top: 40px;
            color: white;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Buku Tamu Online</h1>

        <h2>Tambah Tamu</h2>
        <form method="POST" action="">
            <label>Nama:</label>
            <input type="text" name="nama" placeholder="Masukkan nama kamu" required>

            <label>Email:</label>
            <input type="email" name="email" placeholder="Masukkan email kamu" required>

            <label>Pesan:</label>
            <textarea name="pesan" rows="3" placeholder="Tulis pesan kamu..." required></textarea>

            <input type="submit" name="submit" value="Kirim">
        </form>

        <h2>Daftar Tamu</h2>
        <table>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Pesan</th>
                <th>Aksi</th>
            </tr>
            <?php if (!empty($data)): ?>
                <?php foreach ($data as $index => $tamu): ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= $tamu['nama'] ?></td>
                        <td><?= $tamu['email'] ?></td>
                        <td><?= $tamu['pesan'] ?></td>
                        <td>
                            <a href="?hapus=<?= $index ?>" class="btn btn-hapus" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="5" style="text-align:center; color:gray;">Belum ada tamu yang mengisi.</td></tr>
            <?php endif; ?>
        </table>
    </div>

    <footer>
        &copy; <?= date("Y") ?> Buku Tamu Online — Tema Hijau Gradasi 🌿
    </footer>
</body>
</html>
