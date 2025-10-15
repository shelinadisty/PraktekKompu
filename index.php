<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Data Mahasiswa</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(120deg, #a8e063, #56ab2f);
            margin: 0;
            padding: 0;
            color: #333;
        }

        .container {
            max-width: 700px;
            background: #ffffffcc;
            margin: 80px auto;
            border-radius: 20px;
            padding: 30px 40px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        h1 {
            text-align: center;
            color: #2e7d32;
            margin-bottom: 25px;
        }

        label {
            font-weight: bold;
            color: #1b5e20;
        }

        input[type="text"], input[type="email"], textarea {
            width: 100%;
            padding: 10px 12px;
            margin-top: 5px;
            margin-bottom: 15px;
            border-radius: 8px;
            border: 1px solid #81c784;
            transition: 0.3s;
            font-size: 15px;
        }

        input[type="text"]:focus, input[type="email"]:focus, textarea:focus {
            border-color: #2e7d32;
            box-shadow: 0 0 5px #66bb6a;
            outline: none;
        }

        input[type="submit"] {
            background-color: #2e7d32;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            width: 100%;
            transition: background 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #1b5e20;
        }

        .hasil {
            margin-top: 30px;
            background: #e8f5e9;
            padding: 15px 20px;
            border-left: 6px solid #2e7d32;
            border-radius: 10px;
        }

        footer {
            text-align: center;
            margin-top: 50px;
            color: white;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Form Input Data Mahasiswa</h1>
        <form method="POST" action="">
            <label for="nama">Nama Lengkap</label>
            <input type="text" id="nama" name="nama" placeholder="Masukkan nama kamu" required>

            <label for="nim">NIM</label>
            <input type="text" id="nim" name="nim" placeholder="Masukkan NIM" required>

            <label for="prodi">Program Studi</label>
            <input type="text" id="prodi" name="prodi" placeholder="Masukkan Program Studi" required>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Masukkan email aktif" required>

            <label for="pesan">Kesan dan Pesan</label>
            <textarea id="pesan" name="pesan" rows="3" placeholder="Tuliskan kesan & pesanmu..." required></textarea>

            <input type="submit" name="submit" value="Simpan Data">
        </form>

        <?php
        if (isset($_POST['submit'])) {
            $nama = htmlspecialchars($_POST['nama']);
            $nim = htmlspecialchars($_POST['nim']);
            $prodi = htmlspecialchars($_POST['prodi']);
            $email = htmlspecialchars($_POST['email']);
            $pesan = htmlspecialchars($_POST['pesan']);

            echo "<div class='hasil'>";
            echo "<h3>Data Mahasiswa Tersimpan ✅</h3>";
            echo "<p><b>Nama:</b> $nama</p>";
            echo "<p><b>NIM:</b> $nim</p>";
            echo "<p><b>Program Studi:</b> $prodi</p>";
            echo "<p><b>Email:</b> $email</p>";
            echo "<p><b>Kesan & Pesan:</b> $pesan</p>";
            echo "</div>";
        }
        ?>
    </div>

    <footer>
        &copy; <?= date("Y") ?> Sistem Input Data Mahasiswa | Warna Tema Hijau 🌿
    </footer>
</body>
</html>
