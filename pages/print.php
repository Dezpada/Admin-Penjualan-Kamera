<?php
    include '../connection/connection.php';

    $id = "";
?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Income</title>

        <style>
            body {
                font-family: arial;
            }

            .print {
                margin-top: 10px;
            }

            @media print {
                .print {
                    display: none;
                }
            }

            table {
                border-collapse: collapse;
            }
        </style>
    </head>

    <body>
        <h3><br />LAPORAN PENGHASILAN PERBULAN</h3>
        <br />
        <hr />
        <?php
        $result = $conn->query("SELECT pembayaran.ID_BAYAR, pemesanan.ID_PESAN, penyewa.NAMA_PENYEWA, pemesanan.TANGGAL_SEWA, pemesanan.TOTAL_HARGA FROM pembayaran INNER JOIN pemesanan ON pembayaran.ID_PESAN = pemesanan.ID_PESAN INNER JOIN penyewa ON pemesanan.ID_PENYEWA = penyewa.ID_PENYEWA WHERE ID_BAYAR = '$_GET[id]'");
        $row = mysqli_fetch_row($result);

        ?>
        <table>
            <tr>
                <td>Nama Pemesan </td>
                <td>:</td>
                <td> <?= $row[2] ?></td>
            </tr>
            <tr>
                <td>ID Pembayaran </td>
                <td>:</td>
                <td> <?= $row[0] ?></td>
            </tr>
        </table>
        <hr>
        <table border="1" cellspacing="" cellpadding="4" width="100%">
            <tr>
                <th>NO</th>
                <th>ID BAYAR</th>
                <th>ID PESAN</th>
                <th>NAMA</th>
                <th>TANGGAL SEWA</th>
                <th>TOTAL</th>
            </tr>
            <?php
            $result1 = $conn->query("SELECT pembayaran.ID_BAYAR, pemesanan.ID_PESAN, penyewa.NAMA_PENYEWA, pemesanan.TANGGAL_SEWA, pemesanan.TOTAL_HARGA FROM pembayaran INNER JOIN pemesanan ON pembayaran.ID_PESAN = pemesanan.ID_PESAN INNER JOIN penyewa ON pemesanan.ID_PENYEWA = penyewa.ID_PENYEWA WHERE ID_BAYAR = '$_GET[id]' ORDER BY 1 ASC");
            $i = 1;
            $total = 0;
            while ($dta = mysqli_fetch_row($result1)) :
            ?>
                <tr>
                    <td align="center"><?= $i ?></td>
                    <td align="center"><?= $dta[0] ?></td>
                    <td align="center"><?= $dta[1] ?></td>
                    <td align="left"><?= $dta[2] ?></td>
                    <td align="center"><?= $dta[3] ?></td>
                    <td align="right"><?= $dta[4] ?></td>
                </tr>
                <?php $i++; ?>


            <?php endwhile; ?>

        </table>
        <a href="#" onclick="window.print();"><button class="print">CETAK</button></a>
    </body>

    </html>


<?php

?>