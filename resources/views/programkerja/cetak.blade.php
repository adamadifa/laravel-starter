<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Program Kerja </title>
    <!-- Normalize or reset CSS with your favorite library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">
    <!-- Load paper.css for happy printing -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">
    <link rel="stylesheet" href="{{ asset('assets/css/report.css') }}">
    <style>
        @page {
            size: A4,
        }


        .judul {
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            font-size: 20px;
            text-align: center;
            color: #005e2f
        }

        .judul2 {
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            font-size: 16px;


        }

        .huruf {
            font-family: Verdana, Geneva, Tahoma, sans-serif;
        }

        .ukuranhuruf {
            font-size: 12px;
        }


        hr.style2 {
            border-top: 3px double #8c8b8b;
        }

        .sheet {
            overflow: visible ! important;
            height: auto ! important;
        }
    </style>
</head>

<body>

    <body class="A4 landscape">

        <!-- Each sheet element should have the class "sheet" -->
        <!-- "padding-**mm" is optional: you can set 10, 15, 20 or 25 -->
        <section class="sheet padding-10mm">
            <table style="width: 100%">
                <tr>
                    <td style="text-align: center">
                        <h3 style="font-family:'Cambria'; line-height:0px">PROGRAM KERJA</h3>
                        <h3 style="font-family:'Cambria'; line-height:0px">BIDANG {{ strtoupper($departemen->nama_dept) }}</h3>
                        <h3 style="font-family:'Cambria'; line-height:0px">PESANTREN PERSATUAN ISLAM 80 AL AMIN </h3>
                        <h3 style="font-family:'Cambria'; line-height:0px">SINDANGKASIH - CIAMIS</h3>
                        <h3 style="font-family:'Cambria'; line-height:0px">TAHUN AJARAN {{ $ta_aktif->tahun_ajaran }}</h3>
                    </td>
                </tr>
            </table>
            <hr>
            <table class="datatable3" style="width: 100%">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Program Kerja</th>
                        <th>Taget Pencapaian</th>
                        <th>Keterangan</th>
                        <th>Pelaksanaan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($programkerja as $d)
                        @php
                            $realisasi_program = explode(',', $d->realisasi_program);
                        @endphp
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $d->program_kerja }}</td>
                            <td>{{ removeHtmltag($d->target_pencapaian) }}</td>
                            <td>{{ removeHtmltag($d->keterangan) }}</td>
                            <td class="m-0 p-0">
                                <ol type="1" class="m-0 p-0">
                                    @foreach ($realisasi_program as $rp)
                                        <li>{{ $rp }}</li>
                                    @endforeach
                                </ol>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>

    </body>

</html>
