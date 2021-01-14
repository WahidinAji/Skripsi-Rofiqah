<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
        th, td {
            padding: 5px;
            text-align: left;    
        }
    </style>
</head>
<body>
    <h2><strong><caption>REKOMENDASI PENERIMA BEASISWA</caption></strong></h2>
    <table style="width:100%;">
        <thead>
            <tr>
                <th scope="col" class="text-center align-middle">No</th>
                <th scope="col" class="text-center align-middle">NISN</th>
                <th scope="col" class="text-center align-middle">Nama</th>
                <th scope="col" class="text-center align-middle">Jenis</th>
                <th scope="col" class="text-center align-middle">Kelas</th>
                <th scope="col" class="text-center align-middle">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($status as $s)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $s->nisn }}</td>
                <td>{{ $s->nama }}</td>
                @if ($s->jenis_kelamin == 'l')
                <td>Laki - laki</td>
                @else
                <td>Perempuan</td>
                @endif
                <td>{{ $s->kelas }}</td>
                <td>{{ $s->beasiswa }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align: center;">
                    <h2><strong>Data kosong!!</strong></h2>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>    
</body>
</html>