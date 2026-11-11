
<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard Absensi</title>

    <link rel="stylesheet" href="style.css">

    <style>
        .fingerprint-box {
            text-align: center;
            margin-top: 25px;
            padding: 25px;
            background: #f4f8ff;
            border-radius: 12px;
        }

        .fingerprint-icon {
            font-size: 85px;
            color: #1677ff;
            animation: pulse 1.5s infinite;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
                opacity: 1;
            }

            50% {
                transform: scale(1.12);
                opacity: 0.6;
            }

            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        .fingerprint-button {
            background: #1677ff;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            margin-top: 15px;
        }

        .fingerprint-button:hover {
            background: #0056cc;
        }

        .scan-message {
            margin-top: 15px;
            color: #333;
        }

        .scan-modal {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.7);
            justify-content: center;
            align-items: center;
            z-index: 999;
        }

        .scan-content {
            background: white;
            padding: 30px;
            border-radius: 15px;
            text-align: center;
            width: 300px;
            max-width: 85%;
        }

        .close-button {
            margin-top: 20px;
            padding: 10px 20px;
            background: #dc3545;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }
    </style>
</head>

<body>

<div class="container">

    <!-- HEADER -->

    <div class="header">

        <div>
            <h2>Dashboard Absensi</h2>
            <p>Sistem Absensi Sekolah</p>
        </div>

        <div>
            <span class="admin">
                <?= htmlspecialchars($_SESSION['username']); ?>
            </span>

            <a href="logout.php" class="logout">
                Logout
            </a>
        </div>

    </div>

    <!-- MENU -->

    <div class="menu">

        <a href="dashboard.php">
            Input Absensi
        </a>

        <a href="data absensi.php">
            Data Absensi
        </a>

    </div>

    <!-- FORM ABSENSI -->

    <div class="card">

        <h3>Form Absensi Siswa</h3>

        <form action="simpan.php" method="POST">

            <label>Nama Siswa</label>

            <input
                type="text"
                name="nama"
                placeholder="Masukkan nama siswa"
                required
            >

            <label>Kelas</label>

            <select name="kelas" required>

                <option value="">-- Pilih Kelas --</option>
                <option value="X TKJ 1">X TKJ 1</option>
                <option value="X TKJ 2">X TKJ 2</option>
                <option value="X RPL 1">X RPL 1</option>
                <option value="X RPL 2">X RPL 2</option>
                <option value="XI TKJ">XI TKJ</option>
                <option value="XI RPL">XI RPL</option>
                <option value="XII TKJ">XII TKJ</option>
                <option value="XII RPL">XII RPL</option>

            </select>

            <label>Tanggal</label>

            <input
                type="date"
                name="tanggal"
                value="<?= date('Y-m-d'); ?>"
                required
            >

            <label>Status Kehadiran</label>

            <select name="status" required>

                <option value="">-- Pilih Status --</option>
                <option value="Hadir">Hadir</option>
                <option value="Izin">Izin</option>
                <option value="Sakit">Sakit</option>
                <option value="Alpa">Alpa</option>

            </select>

            <label>Keterangan</label>

            <textarea
                name="keterangan"
                placeholder="Masukkan keterangan jika ada"
                rows="4"
            ></textarea>

            <button type="submit">
                SIMPAN ABSENSI
            </button>

        </form>

        <!-- FINGERPRINT -->

        <div class="fingerprint-box">

            <h3>Absensi Sidik Jari</h3>

            <div class="fingerprint-icon">
                🫆
            </div>

            <p>Gunakan sidik jari untuk absensi</p>

            <button
                type="button"
                class="fingerprint-button"
                onclick="bukaScanner()"
            >
                MULAI SCAN
            </button>

        </div>

    </div>

</div>

<!-- POPUP SCANNER -->

<div class="scan-modal" id="scanModal">

    <div class="scan-content">

        <h3>Fingerprint Scanner</h3>

        <div class="fingerprint-icon">
            🫆
        </div>

        <p id="scanMessage">
            Siap melakukan pemindaian...
        </p>

        <button
            class="close-button"
            onclick="tutupScanner()"
        >
            TUTUP
        </button>

    </div>

</div>

<script>

function bukaScanner() {

    document.getElementById("scanModal").style.display = "flex";

    document.getElementById("scanMessage").innerText =
        "Tampilan scanner siap. Hubungkan perangkat fingerprint untuk membaca sidik jari.";

}

function tutupScanner() {

    document.getElementById("scanModal").style.display = "none";

}

</script>

</body>
</html>
