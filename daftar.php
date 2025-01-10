<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Harga Alat Diagnostik</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="container">
        <header>
            <h1>Daftar Harga Alat Diagnostik</h1>
        </header>

        <table class="price-list">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Alat</th>
                    <th>Deskripsi</th>
                    <th>Harga (IDR)</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Data alat diagnostik
                $alat_diagnostik = [
                    ['nama' => 'Alat EKG', 'deskripsi' => 'Alat untuk memantau aktivitas listrik jantung.', 'harga' => 2500000],
                    ['nama' => 'Thermometer Digital', 'deskripsi' => 'Alat pengukur suhu tubuh dengan teknologi digital.', 'harga' => 350000],
                    ['nama' => 'Sphygmomanometer', 'deskripsi' => 'Alat pengukur tekanan darah.', 'harga' => 500000],
                    ['nama' => 'Stetoskop', 'deskripsi' => 'Alat untuk mendengarkan suara organ tubuh, terutama jantung dan paru-paru.', 'harga' => 450000],
                    ['nama' => 'Oximeter', 'deskripsi' => 'Alat untuk mengukur tingkat oksigen dalam darah.', 'harga' => 300000],
                ];

                // Menampilkan data alat diagnostik
                foreach ($alat_diagnostik as $index => $alat) {
                    echo "<tr>
                            <td>" . ($index + 1) . "</td>
                            <td>" . $alat['nama'] . "</td>
                            <td>" . $alat['deskripsi'] . "</td>
                            <td>" . number_format($alat['harga'], 0, ',', '.') . "</td>
                          </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

</body>
</html>