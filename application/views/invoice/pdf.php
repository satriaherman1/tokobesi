<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>test</title>
</head>
<body>

<h2>Detail Invoice</h2>
<br>
    <table cellspacing="0">
        <thead>
            <tr>
                <td>
                    Nomor Invoice
                </td>
                <td>
                    Supplier
                </td>
                <td>
                    Jumlah Kayu
                </td>
                <td>
                    Jenis Kayu
                </td>
                <td>
                    Jumlah Volume
                </td>
                <td>
                    Total Pembayaran
                </td>
            </tr>
        </thead>
        <tbody>
            <?php foreach($invoice as $inv): ?>
                <tr>
                    <td><?= $inv->invoice_number ?></td>
                    <td><?= $inv->supplier ?></td>
                    <td><?= $inv->total_log ?></td>
                    <td><?= $inv->log_type ?></td>
                    <td><?= $inv->total_volume ?></td>
                    <td><?= $inv->total_paid ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <style>
        table tr td{
            border-bottom: 1px solid #f2f2f2;
            padding: 12px 7px;

        }

        body{
            font-family: sans-serif;
        }
        table{
            width: 90vw;
        }

        thead tr{
            background: #00bd9d;
            color: #fff;
            font-weight: 700;
            font-size: 15px;
        }

        h2{
            text-align: center;
        }
    </style>
</body>
</html>