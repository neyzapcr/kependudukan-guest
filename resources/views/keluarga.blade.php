<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Keluarga KK</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f4f6f9;
            margin: 0;
            padding: 30px;
        }

        h1 {
            text-align: center;
            color: #444;
            margin-bottom: 25px;
            font-size: 26px;
            position: relative;
        }

        .container {
            display: flex;
            flex-wrap: wrap; /* kalau ada banyak data bisa sejajar */
            gap: 15px;
            justify-content: flex-start; /* biar mepet ke kiri */
        }

        .card {
            background: #fff;
            border-radius: 14px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            width: 320px;
            padding: 20px 25px;
        }

        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 8px;
        }

        th {
            text-align: left;
            background: #007bff;
            color: #fff;
            padding: 8px 12px;
            width: 40%;
            border-radius: 6px 0 0 6px;
            font-size: 14px;
        }

        td {
            padding: 8px 12px;
            background: #f9f9f9;
            border-radius: 0 6px 6px 0;
            font-size: 14px;
            color: #333;
        }
    </style>
</head>
<body>
    <h1>Detail Keluarga KK</h1>

    <div class="container">
        <div class="card">
            <table>
                <tr>
                    <th>KK ID</th>
                    <td>{{ $kk_id }}</td>
                </tr>
                <tr>
                    <th>Nomor KK</th>
                    <td>{{ $kk_nomor }}</td>
                </tr>
                <tr>
                    <th>ID Kepala</th>
                    <td>{{ $kepala_keluarga_warga_id }}</td>
                </tr>
                <tr>
                    <th>Alamat</th>
                    <td>{{ $alamat }}</td>
                </tr>
                <tr>
                    <th>RT</th>
                    <td>{{ $rt }}</td>
                </tr>
                <tr>
                    <th>RW</th>
                    <td>{{ $rw }}</td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>
