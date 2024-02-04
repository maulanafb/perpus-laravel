<!DOCTYPE html>
<html lang="en">

<?php

use Carbon\Carbon;
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        * {
            font-family: Arial, Helvetica, sans-serif;
        }



        #table1 {
            border-collapse: collapse;
            width: 100%;
            margin-top: 32px;
        }

        #table1 td,
        #table1 th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #table1 th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: center;
            color: black;
            font-size: 12px;
        }

        #table1 td {
            font-size: 11px;
        }

        .font-medium {
            font-weight: 500;
        }
        #table2 {

            width: 100%;
            margin-top: 32px;
        }

        #table2 td,
        #table2 th {

            padding: 2px;
        }

        #table2 th {
            padding-top: 12px;
            padding-bottom: 12px;
            color: black;
            font-size: 12px;
        }

        #table2 td {
            font-size: 11px;
        }

        .font-medium {
            font-weight: 500;
        }

        .font-bold {
            font-weight: 600;
        }

        .d-flex {
            display: flex;
            justify-content: space-between;
            align-self: flex-end; /* Align to the bottom */
        }

        .ttd {
            text-align: center;
        }

    </style>

</head>

<body>

    <center>
        <h1 class="font-medium">Laporan Peminjaman Kolektif</h1>
        @if($pdfData['tglawal'] == '')
            <h4 class="font-medium">Semua Tanggal</h4>
        @else
            <h4 class="font-medium">{{ $pdfData['tglawal'] }} - {{ $pdfData['tglakhir'] }}</h4>
        @endif
    </center>

    <table  id="table1">
        <thead>
    <tr >
        <th  width="1%">NO</th>
        <th>NAMA</th>
        <th>JUDUL</th>
        <th>TGL PINJAM</th>
        <th>TGL KEMBALI</th>
        <th>STATUS</th>
        {{-- <th>DENDA</th> --}}
    </tr>
</thead>
        <tbody>
@php $no = 1; @endphp
@foreach ($pdfData['data'] as $d)
    <tr>
        <td align="center">{{ $no++ }}</td>
        <td align="center">{{ $d['name'] }}</td>
        <td align="center">{{ $d['judul'] }}</td>
        <td align="center">{{ Carbon::parse($d['tgl_pinjam'])->translatedFormat('d F Y') }}</td>
        <td align="center">{{ Carbon::parse($d['tgl_kembali'])->translatedFormat('d F Y') }}</td>
        <td align="center">{{ $d['status'] }}</td>
        {{-- <td align="center">{{ $d['denda'] ?? '-' }}</td> --}}
    </tr>
@endforeach

        </tbody>
    </table>


    <table  id="table2">
            <tr align="center" >
                <td colspan="20" rowspan="1">Mengetahui</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
               <td colspan="20" rowspan="1">Mengetahui</td>
            </tr>

           <tr align="center">
               <td colspan="20" rowspan="1">Kepala Sekolah</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
               <td colspan="20" rowspan="1">Petugas Perpustakaan</td>
            </tr>

<tr><td></td></tr>
<tr><td></td></tr>
<tr><td></td></tr>
<tr><td></td></tr>
<tr><td></td></tr>
<tr><td></td></tr>
<tr><td></td></tr>
<tr><td></td></tr>
<tr><td></td></tr>
<tr><td></td></tr>
<tr><td></td></tr>
<tr><td></td></tr>



            <tr align="center" style="a">
                <td colspan="20" rowspan="1">Hamid Darmadi</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
               <td colspan="20" rowspan="1">Siti mahmudah</td>
            </tr>

           <tr align="center">
               <td colspan="20" rowspan="1">1234560</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
               <td colspan="20" rowspan="1">1234560</td>
            </tr>
        </table>






</body>
</html>
