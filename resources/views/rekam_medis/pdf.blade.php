<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rekam Medisku</title>
    <style>
        @page {
            margin: 0cm;
        }

        #tabel {
            width: 26cm;
            border: 2px solid black;
            border-collapse: collapse;
            text-align: center;
        }

        #tabel td,
        #tabel th {
            border: 2px solid black;
            height: 0.5cm;
            padding-right: 0.2cm;
            padding-left: 0.2cm;
            word-wrap: break-word;
        }

        body {
            padding: 0.5cm;
            background-color: rgb(255, 254, 150);
            width: 29cm;
            height: 20cm;
            font-family: Arial, Helvetica, sans-serif;
        }
    </style>
</head>

<body>
    <div style="width:100%;text-align:left;">
        <h4 style='margin-top:0;padding-top:0;'>
            REKAM MEDISKU ( {{ $tipe_rekam_medis == 'personal' ? 'PERSONAL' : 'TENAGA KESEHATAN' }}
            @if ($tipe_rekam_medis == 'tenaga_kesehatan')
                {{ $filters['tipe_tenaga_kesehatan'] == 'all' ? 'SEMUA TIPE' : ($filters['tipe_tenaga_kesehatan'] == 1 ? 'DOKTER' : 'PENGOBAT TRADISIONAL') }})
            @else
                )
            @endif
            <br>
            {{ Carbon::parse($filters['awal_tanggal'])->format('d M Y') }} -
            {{ Carbon::parse($filters['akhir_tanggal'])->format('d M Y') }}
        </h4>
        <table>
            <tr>
                <td style='width:3cm;'>Nama Lengkap</td>
                <td style='width:6cm;'>: {{ $pasien->nama }}</td>
                <td style='width:3cm;'>Jenis Kelamin</td>
                <td style='width:6cm;'>: {{ $pasien->jenis_kelamin == 1 ? 'Laki laki' : 'Perempuan' }}</td>
            </tr>
            <tr>
                <td style='width:3cm;'>Tanggal Lahir</td>
                <td style='width:6cm;'>: {{ Carbon::parse($pasien->tanggal_lahir)->format('d M Y') }} (
                    {{ str_replace('yang lalu', '', Carbon::parse($pasien->tanggal_lahir)->diffForHumans()) }})</td>
                <td style='width:3cm;'>No. HP</td>
                <td style='width:6cm;'>: {{ $pasien->no_hp }}</td>
            </tr>
        </table>
    </div>
    <table id='tabel' style='margin-top:0.5cm;'>
        <thead>
            <tr>
                <th style='width:3cm;'>Tanggal</th>
                @if ($tipe_rekam_medis == 'tenaga_kesehatan')
                    <th style='width:3cm;'>Tenaga Kesehatan</th>
                    <th style='width:8cm;'>Anamnesa</th>
                    <th style='width:6cm;'>Diagnosis</th>
                    <th style='width:6cm;'>Terapi</th>
                @else
                    <th style='width:10cm;'>Anamnesa</th>
                    <th style='width:7cm;'>Diagnosis</th>
                    <th style='width:7cm;'>Terapi</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @if (count($rekam_medises) == 0)
                <tr>
                    <td colspan="{{ $tipe_rekam_medis == 'personal' ? '4' : '5' }}">Belum ada data</td>
                </tr>
            @else
                @foreach ($rekam_medises as $rekam_medis)
                    <tr>
                        <td>{{ Carbon::parse($rekam_medis->tanggal)->format('d M Y') }}</td>
                        @if ($tipe_rekam_medis == 'tenaga_kesehatan')
                            <td>{{ $rekam_medis->tenaga_kesehatan->nama }}</td>
                        @endif
                        <td style="text-align:justify;">{!! $rekam_medis->anamnesa !!}</td>
                        <td style="text-align:justify;">{!! $rekam_medis->diagnosis !!}</td>
                        <td style="text-align:justify;">{!! $rekam_medis->terapi !!}</td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</body>

</html>
