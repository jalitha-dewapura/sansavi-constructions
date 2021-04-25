<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Annual Cost of The Company</title>

    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="css/mpdf.css"/>

</head>
<body>
    <!-- page header  -->
    <div class="header">
        <div class="logo">
            <img src="./img/Ransavi-Construction-Logo.png"/>
        </div>
        <div class="details">
            <h3>Ransavi Construction (Pvt) Ltd</h3>
            <p>No. 84,</p>
            <p>Koralawella,Moratuwa,</p>
            <p>Sri Lanka.</p>
        </div>
    </div>
    <hr>
    <h2>Annual Cost of The Company</h2>
    <br>
    <p>Year : {{ $year }}</p>

    <table class="minimalistBlack" >
        <thead>
            <tr>
                <th>ID</th>
                <th>Site</th>
                <th>SRN Date</th>
                <th>Total Cost (Rs)</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $i = 1;
            ?> 
            @isset ($notes)       
                @foreach ($notes as $note)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{$note['site_name']}}</td>
                        <td>{{$note['note_date']}}</td>
                        <td style="text-align: right;">{{ number_format((float)$note['cost'], 2, '.', ',') }}</td>
                    </tr>
                @endforeach
            @endisset
        </tbody>
    </table>
    <br>
    

    <p style="padding-bottom: 20px;">Certified By :</p>
    <p>...........................</p>

</body>
</html>

