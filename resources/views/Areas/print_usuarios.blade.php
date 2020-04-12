<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>


    <style>

html {
  font-family: 'helvetica neue', helvetica, arial, sans-serif;
}

thead th, tfoot th {
  font-family: 'Rock Salt', cursive;
}

th {
  letter-spacing: 2px;
}

td {
  letter-spacing: 1px;
}

tbody td {
  text-align: center;
  font-size: 10px;
}

tfoot th {
  text-align: right;
}
    </style>
</head>
<body>
    @if ($data_reporte=="[]")
    <h1> No se encontraron resultados </h1>
    @else
    <table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
        <thead>
            <tr>
                <th>nombre</th>
                <th>telefono</th>
                <th>correo</th>
                <th>area</th>
                <th>Entrada</th>
                <th>Salida</th>
            
            </tr>
        </thead>
        <tbody>
            <?php
                
        function fechaCastellano ($fecha) {
                $fecha = substr($fecha, 0, 10);
                $numeroDia = date('d', strtotime($fecha));
                $dia = date('l', strtotime($fecha));
                $mes = date('F', strtotime($fecha));
                $anio = date('Y', strtotime($fecha));
                $dias_ES = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
                $dias_EN = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
                $nombredia = str_replace($dias_EN, $dias_ES, $dia);
                $meses_ES = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
                $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
                $nombreMes = str_replace($meses_EN, $meses_ES, $mes);
                return $nombredia." ".$numeroDia." de ".$nombreMes." de ".$anio;
            }    
                
            ?>
             @if (isset($data_reporte))
                @foreach ($data_reporte as $item)
                <tr>
                <td>{{$item->nombre}} {{$item->paterno}} {{$item->materno}}</td>
                  <td>{{$item->telefono}}</td>
                  <td>{{$item->email}}</td>
                  <td><strong>{{$item->area_new}}</strong></td>
                  <td>
                      <div>
                        {{fechaCastellano($item->fecha_entrada)}}
                        {{date('h:i A', strtotime($item->hora_entrada))}}
                      </div>
                    </td>
                  <td>
                    <div>
                        {{fechaCastellano($item->fecha_salida)}}
                           {{date('h:i A', strtotime($item->hora_salida))}}
                      </div>
                  </td>
                </tr>
                @endforeach
            @endif  
        </tbody>
    </table> 
    @endif 
   

</body>
</html>