<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        .container {
            position: relative;
            width: 100%;
            height: 100%;
            padding: 10px;
        }

        .table-data {
            position: absolute;
            top: 180px;
            width: 100%;
            border-collapse: collapse;
        }

        .table-data th,
        td {
            border: 1px solid black;
            padding: 3px;
        }
    </style>
</head>

<body>
    <table>
        <tr>
            <th width="780px">
                <div style="font-size: 18px;"><b>PT. TRIHAMAS FINANCE</b>
                    <div style="font-size: 10px;">Sistem Reservasi Ruang Rapat</div>
                    <hr>
                </div>

            </th>
        </tr>
        <tr>
            <td colspan="3" style="border: none">
                <h6>Data Rservasi per Tanggal : <?= $tanggal_mulai . ' s/d ' . $tanggal_selesai; ?></h6>
                <br>
            </td>
        </tr>
    </table>



    <table class="table-data" cellpadding="2">
        <tr style="background-color:#c9c7c1; font-weight:bold;">
            <th width="25px">No</th>
            <th width="90">Kode Booking</th>
            <th width="130">Cabang</th>
            <th width="130">Nama Ruangan</th>
            <th width="130">Topik</th>
            <th width="80">Tanggal</th>
            <th width="60">Jam Mulai</th>
            <th width="60">Jam Akhir</th>
            <th width="80">Pemesan</th>
        </tr>
        <?php
        $i = 1;
        // koneksi database manual
        $conn = mysqli_connect('localhost', 'root', '', 'booking_meet_room');
        $query = mysqli_query($conn, "SELECT * FROM booking WHERE tanggal_meeting BETWEEN '$tanggal_mulai' AND '$tanggal_selesai' ORDER BY tanggal_meeting ASC");

        foreach ($query as $data) :
            // get data cabang
            $kode_cabang = $data['kode_cabang'];
            $query_cabang = mysqli_query($conn, "SELECT * FROM cabang WHERE kode_cabang = '$kode_cabang'");
            $data_cabang = mysqli_fetch_assoc($query_cabang);

            // get data nama ruangan
            $kode_ruangan = $data['kode_room'];
            $query_ruangan = mysqli_query($conn, "SELECT * FROM ruangan WHERE kode_room = '$kode_ruangan'");
            $data_ruangan = mysqli_fetch_assoc($query_ruangan);

            // get data nama pemesan
            $kode_guest = $data['pemesan'];
            $query_pemesan = mysqli_query($conn, "SELECT * FROM guest WHERE kode_guest = '$kode_guest'");
            $data_pemesan = mysqli_fetch_assoc($query_pemesan);
        ?>
            <tr>
                <td><?= $i; ?></td>
                <td><?= $data['kode_booking']; ?></td>
                <td><?= $data_cabang['nama_cabang'] ?></td>
                <td><?= $data_ruangan['nama_ruangan'] ?></td>
                <td><?= $data['topik']; ?></td>
                <td><?= $data['tanggal_meeting']; ?></td>
                <td><?= $data['jam_mulai']; ?></td>
                <td><?= $data['jam_akhir']; ?></td>
                <td><?= $data_pemesan['nama_lengkap'] ?></td>
            </tr>
        <?php
            $i++;
        endforeach;
        ?>
    </table>
    <div class="div"></div>

    <br>
    <br>
</body>

</html>