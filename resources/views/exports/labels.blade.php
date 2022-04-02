<html lang="hu">
<head>
    <title>Cimke generálás</title>
    <style>
        td{
            font-size: 8px;
        }
    </style>
</head>
<body>
    <div>
        @foreach($cars as $car)
                @foreach(range(1,3) as $i)
                    <div align="left" style="width: 33%;float: left;">
                        <table style="width: 98%; display: inline-block; margin: 3% 1%;" border="1">
                            <tr><td style="font-weight: bold; text-align: center;">{{ $car->local_identifier }}</td></tr>
                            <tr><td style="text-align: center;">{{ $car->carMake->make }} {{ $car->carModel->model }} Évj.: {{ $car->year }}</td></tr>
                            <tr><td style="text-align: center;">CM3:{{ $car->engine_ccm }} KW:{{ $car->power }}KW Üzema.: {{ $car->fuelType->name }}</td></tr>
                            <tr><td style="text-align: center;">Kiv.dat.:{{ $car->date_of_demolition }}</td></tr>
                            <tr><td style="text-align: center;">Bont.ig.szam:{{ $car->demolition_certificate_number }}</td></tr>
                            <tr><td style="text-align: center;">Motorkód:{{ $car->engine_code }}</td></tr>
                            <tr><td style="text-align: center;">Alvázszám:{{ $car->vin }}</td></tr>
                        </table>
                    </div>
                @endforeach
                    @if($loop->iteration % 8 == 0)
                        <pagebreak>
                    @endif
        @endforeach
    </div>
</body>
</html>