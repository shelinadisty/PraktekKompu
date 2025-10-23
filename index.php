<?php
session_start();

// Inisialisasi data buku tamu
if (!isset($_SESSION['bukutamu'])) {
    $_SESSION['bukutamu'] = [];
}

// Tambah data
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
    $_SESSION['bukutamu'] = array_values($_SESSION['bukutamu']); 
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
        color: #e0e0e0;
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: flex-start;
        background: linear-gradient(270deg, #0f0c29, #302b63, #24243e, #141e30, #243b55);
        background-size: 1200% 1200%;
        animation: gradientShift 35s ease infinite;
    }
    @keyframes gradientShift {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }
    .container {
        margin-top: 60px;
        background: rgba(20, 20, 35, 0.7);
        padding: 30px;
        border-radius: 20px;
        box-shadow: 0 0 40px rgba(0, 0, 0, 0.6);
        width: 90%;
        max-width: 800px;
        backdrop-filter: blur(15px);
        border: 1px solid rgba(255,255,255,0.05);
        animation: fadeIn 1.2s ease-in-out;
    }
    @keyframes fadeIn {
        from {opacity: 0; transform: translateY(20px);}
        to {opacity: 1; transform: translateY(0);}
    }
    h1 {
        text-align: center;
        margin-bottom: 25px;
        font-size: 2.3em;
        color: #fff;
        text-shadow: 0 0 15px rgba(150,150,255,0.6);
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
        background: rgba(255, 255, 255, 0.1);
        color: #fff;
        transition: background 0.3s;
    }
    input:focus, textarea:focus {
        background: rgba(255, 255, 255, 0.2);
    }
    textarea {
        resize: none;
        height: 80px;
    }
    button {
        background: linear-gradient(90deg, #5f72bd, #9b23ea);
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
        background: linear-gradient(90deg, #9b23ea, #5f72bd);
        transform: scale(1.05);
        box-shadow: 0 0 15px rgba(155, 35, 234, 0.4);
    }
    table {
        width: 100%;
        border-collapse: collapse;
        color: #ddd;
        margin-top: 10px;
    }
    th, td {
        padding: 10px;
        text-align: left;
        border-bottom: 1px solid rgba(255,255,255,0.1);
    }
    tr:hover {
        background-color: rgba(255,255,255,0.05);
    }
    a {
        color: #a38ef7;
        text-decoration: none;
        font-weight: bold;
    }
    a:hover {
        color: #fff;
    }
    .no-data {
        text-align: center;
        padding: 20px;
        color: rgba(255,255,255,0.7);
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
