<?php

session_start();

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}


$file = "data/absensi.txt";

$data = [];


// Membaca file

if (file_exists($file)) {

    $data = file(
        $file,
        FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES
    );

}

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>Data Absensi</title>

        <link rel="stylesheet" href="style.css">

</head>

<body>

<div class="container">

    <!-- HEADER -->

    <div class="header">

        <div>

            <h2>📋 Data Absensi</h2>

            <p>
                Daftar kehadiran siswa
            </p>

        </div>

    </div>

    <div>

        <span class="admin">
            👤 <?= $_SESSION['username']; ?>
        </span>

        <a
            href="logout.php"
            class="logout"
        >
            Logout
        </a>

    </div>

        </div>

    <!-- MENU -->


    <div class="menu">

        <a href="dashboard.php">
            📝 Input Absensi
        </a>

        <a href="data_absensi.php">
            📊 Data Absensi
        </a>

    </div>


    <?php if (isset($_GET['success'])) { ?>

        <div class="success">

            ✅ Data absensi berhasil disimpan!

        </div>

    <?php } ?>

    <!-- TABEL -->


    <div class="card">

        <div class="table-wrapper">

            <table>

                <thead>

                    <tr>

                        <th>No</th>

                        <th>Tanggal</th>

                        <th>Nama Siswa</th>

                        <th>Kelas</th>

                        <th>Status</th>

                        <th>Keterangan</th>

                    </tr>

                </thead>


                <tbody>

                    <?php

                    if (count($data) > 0) {

                      $no = 1;

                      foreach ($data as $baris) {

                         $isi = explode("|", $baris);


                         if (count($isi) >= 5) {

                    ?>

                        <tr>

                            <td>
                                  <?= $no++;?>
                            </td>

                        <td>
                            <?= htmlspecialchars($isi[0]); ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($isi[1]); ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($isi[2]); ?>
                        </td>

                        <td>

                            <?php

                            if ($isi[3] == "Hadir") {

                                echo '<span class="hadir">
                                      Hadir
                                      </span>';

                            } elseif ($isi[3] == "Izin") {

                                echo '<span class="izin">
                                      Izin
                                      </span>';

                            } elseif ($isi[3] == "Sakit") {

                                echo '<span class="sakit">
                                      Sakit
                                      </span>';

                            } else {

                                 echo '<span class="alpa">
                                         Alpa
                                      </span>';

                            }

                           ?>

                        </td>

                        <td>
                            <?= htmlspecialchars($isi[4]);?>
                        </td>

                    </tr>

                <?php

                    }

                }

            } else {

           ?>

                <tr>

                    <td colspan="6">

                        Belum ada data absensi.

                    </td>

                </tr>

            <?php

            }

            ?>

            </tbody>

        </table>

    </div>

  </div>

</div>

</body>

</html>