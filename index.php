<?php
session_start();

// Inisialisasi array data jika belum ada
if (!isset($_SESSION['bukutamu'])) {
    $_SESSION['bukutamu'] = [];
}

// Tambah data baru
if (isset($_POST['submit'])) {
    $data = [
        'nama' => $_POST['nama'],
        'nim' => $_POST['nim'],
        'email' => $_POST['email'],
        'pesan' => $_POST['pesan']
    ];
    $_SESSION['bukutamu'][] = $data;
    header("Location: index.php");
    exit;
}

// Hapus data
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    unset($_SESSION['bukutamu'][$id]);
    $_SESSION['bukutamu'] = array_values($_SESSION['bukutamu']); // reset index
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Buku Tamu Online Mahasiswa</title>
<style>
    * {
        font-family: 'Poppins', sans-serif;
        box-sizing: border-box;
    }
    body {
        margin: 0;
        padding: 0;
        color: #fff;
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: flex-start;
        background: linear-gradient(270deg, #ff9a9e, #fad0c4, #a18cd1, #fbc2eb, #84fab0, #8fd3f4);
        background-size: 1200% 1200%;
        animation: gradientShift 12s ease infinite;
    }
    @keyframes gradientShift {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }
    .container {
        margin-top: 50px;
        background: rgba(255, 255, 255, 0.15);
        padding: 30px;
        border-radius: 20px;
        box-shadow: 0 0 25px rgba(255,255,255,0.25);
        width: 90%;
        max-width: 800px;
        backdrop-filter: blur(15px);
    }
    h1 {
        text-align: center;
        margin-bottom: 25px;
        font-size: 2.2em;
        text-shadow: 0 0 15px rgba(255,255,255,0.7);
    }
    form {
        display: flex;
        flex-direction: column;
        gap: 12px;
        margin-bottom: 30px;
    }
    input, textarea {
        padding: 12px 15px;
        border: none;
        border-radius: 10px;
        outline: none;
        font-size: 15px;
    }
    textarea {
        resize: none;
        height: 80px;
    }
    button {
        background: linear-gradient(90deg, #667eea, #764ba2);
        border: none;
        color: #fff;
        padding: 12px;
        border-radius: 10px;
        font-weight: bold;
        font-size: 15px;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    button:hover {
        background: linear-gradient(90deg, #764ba2, #667eea);
        transform: scale(1.05);
    }
    table {
        width: 100%;
        border-collapse: collapse;
        color: #fff;
    }
    th, td {
        padding: 10px;
        text-align: left;
        border-bottom: 1px solid rgba(255,255,255,0.3);
    }
    tr:hover {
        background-color: rgba(255,255,255,0.1);
    }
    a {
        color: #ffd166;
        text-decoration: none;
        font-weight: bold;
    }
    a:hover {
        color: #fff;
    }
    .no-data {
        text-align: center;
        padding: 20px;
        color: rgba(255,255,255,0.8);
        font-style: italic;
    }
</style>
</head>
<body>

<div class="container">
    <h1>📖 Buku Tamu Online Mahasiswa</h1>

    <form method="POST">
        <input type="text" name="nama" placeholder="Nama Lengkap" required>
        <input type="text" name="nim" placeholder="NIM" required>
        <input type="email" name="email" placeholder="Email" required>
        <textarea name="pesan" placeholder="Pesan..." required></textarea>
        <button type="submit" name="submit">Tambah Data</button>
    </form>

    <table>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>NIM</th>
            <th>Email</th>
            <th>Pesan</th>
            <th>Aksi</th>
        </tr>
        <?php if (empty($_SESSION['bukutamu'])): ?>
            <tr><td colspan="6" class="no-data">Belum ada data tamu</td></tr>
        <?php else: ?>
            <?php $no=1; foreach ($_SESSION['bukutamu'] as $index => $mhs): ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= htmlspecialchars($mhs['nama']) ?></td>
                <td><?= htmlspecialchars($mhs['nim']) ?></td>
                <td><?= htmlspecialchars($mhs['email']) ?></td>
                <td><?= htmlspecialchars($mhs['pesan']) ?></td>
                <td><a href="?hapus=<?= $index ?>" onclick="return confirm('Yakin hapus data ini?')">🗑️</a></td>
            </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </table>
</div>

</body>
</html>
