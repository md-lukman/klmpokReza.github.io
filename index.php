<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f0f0f0;
    }

    .logo {
        text-align: center;
        margin: 20px;
    }

    .logo img {
        max-width: 100px;
        height: auto;
    }

    .form-container {
        background-color: #fff;
        max-width: 400px;
        margin: 100px auto;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h2 {
        text-align: center;
    }

    label {
        display: block;
        margin-top: 10px;
    }

    input[type="text"],
    select {
        width: 95%;
        padding: 10px;
        margin-top: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    select {
        height: 36px;
    }

    input[type="submit"] {
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 4px;
        padding: 10px 20px;
        cursor: pointer;
        font-size: 16px;
        margin-top: 10px;
    }

    input[type="submit"]:hover {
        background-color: #0056b3;
    }
</style>

<body>
    <div class="form-container">
        <div class="logo">
            <img src="img/parkir.jpg" alt="logo-parkir">
            <h2>FORM PARKIR</h2>
        </div>
        <form method="post">
            <label for="plat">No Plat :</label>
            <input type="text" name="plat" id="plat">

            <label for="jenis">Jenis Kendaraan :</label>
            <select name="jenis" id="jenis">
                <option value="mobil">Mobil</option>
                <option value="motor">Motor</option>
                <option value="sepeda">Sepeda</option>
            </select>

            <label for="waktum">Jam Masuk :</label>
            <input type="time" name="waktum" id="waktum">

            <label for="waktuk">Jam Keluar :</label>
            <input type="time" name="waktuk" id="waktuk"><br/>

            <input type="submit" value="Submit">
        </form>
    </div>
    
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $plat = $_POST["plat"];
        $jenis = $_POST["jenis"];
        $waktum = $_POST["waktum"];
        $waktuk = $_POST["waktuk"];

        list($jam_masuk_jam, $jam_masuk_menit) = explode(":", $waktum);
        list($jam_keluar_jam, $jam_keluar_menit) = explode(":", $waktuk);

        $jam_masuk_jam = ltrim($jam_masuk_jam, "0");
        $jam_masuk_menit = ltrim($jam_masuk_menit, "0");
        $jam_keluar_jam = ltrim($jam_keluar_jam, "0");
        $jam_keluar_menit = ltrim($jam_keluar_menit, "0");

        $total_waktu = 0;

        if ($jam_masuk_jam == $jam_keluar_jam) {
            $total_waktu = $jam_keluar_menit - $jam_masuk_menit;
        } elseif ($jam_keluar_jam < $jam_masuk_jam) {
            $total_waktu = ((24 + $jam_keluar_jam) - $jam_masuk_jam) * 60 + ($jam_keluar_menit - $jam_masuk_menit);
        } else {
            $total_waktu = ($jam_keluar_jam - $jam_masuk_jam) * 60 + ($jam_keluar_menit - $jam_masuk_menit);
        }

        echo '<div style="border: 1px solid #ccc; padding: 20px; background-color: #f5f5f5; width: 400px; margin: 0 auto; text-align: center; margin-top: 11.5% ">';
        echo '<div style="font-size: 20px; font-weight: bold; text-align: center;">======= STRUK PARKIR =======</div>';
        echo '<div style="font-size: 20px; font-weight: bold; text-align: center;">================================</div>';
        echo " <br/>";
        echo '<div style="margin-top: 10px; font-size: 16px;">Jenis Kendaraan : ' . $jenis . '</div>';
        echo " <br/>";
        echo '<div style="margin-top: 10px; font-size: 16px;">Total Waktu : ' . floor($total_waktu / 60) . ':' . ($total_waktu % 60) . '</div>';
        echo " <br/>";

        switch ($jenis) {
            case "mobil":
                $harga_awal = 5000;
                $harga_tambahan = 3000;
                $total_harga = $harga_awal;

                if ($total_waktu < 0) {
                    echo '<div style="margin-top: 10px; font-size: 16px;">Waktu Tidak Valid</div>';
                } elseif ($total_waktu >= 60) {
                    $jam_penuh = floor($total_waktu / 60);
                    $menit_sisa = $total_waktu % 60;

                    if ($menit_sisa > 0) {
                        $jam_penuh++;
                    }
                    $total_harga = $harga_awal + ($jam_penuh - 1) * $harga_tambahan;
                }
                echo '<div style="margin-top: 10px; font-size: 16px;">Total Harga : Rp ' . number_format($total_harga, 0, ",", ".") . '</div>';
                echo " <br/>";
                break;
            case "motor":
                $harga_awal = 3000;
                $harga_tambahan = 2000;
                $total_harga = $harga_awal;

                if ($total_waktu < 0) {
                    echo '<div style="margin-top: 10px; font-size: 16px;">Waktu Tidak Valid</div>';
                } elseif ($total_waktu >= 60) {
                    $jam_penuh = floor($total_waktu / 60);
                    $menit_sisa = $total_waktu % 60;

                    if ($menit_sisa > 0) {
                        $jam_penuh++;
                    }

                    $total_harga = $harga_awal + ($jam_penuh - 1) * $harga_tambahan;
                }

                echo '<div style="margin-top: 10px; font-size: 16px;">Total Harga : Rp ' . number_format($total_harga, 0, ",", ".") . '</div>';
                echo " <br/>";
                break;
            case "sepeda":
                $harga_awal = 2000;
                $harga_tambahan = 500;
                $total_harga = $harga_awal;

                if ($total_waktu < 0) {
                    echo '<div style="margin-top: 10px; font-size: 16px;">Waktu Tidak Valid</div>';
                } elseif ($total_waktu >= 60) {
                    $jam_penuh = floor($total_waktu / 60);
                    $menit_sisa = $total_waktu % 60;

                    if ($menit_sisa > 0) {
                        $jam_penuh++;
                    }
                    $total_harga = $harga_awal + ($jam_penuh - 1) * $harga_tambahan;
                }

                echo '<div style="margin-top: 10px; font-size: 16px;">Total Harga : Rp ' . number_format($total_harga, 0, ",", ".") . '</div>';
                echo " <br/>";
                break;
            default:
                echo '<div style="color: red;">Terjadi Kesalahan</div>';
        }
        echo " <br/>";
        echo '<div style="font-size: 20px; font-weight: bold; text-align: center;">======= TERIMAKASIH =======</div>';
        echo '<div style="font-size: 20px; font-weight: bold; text-align: center;">==============================</div>';
        echo '</div>';
         }
        ?>
</body>

</html>