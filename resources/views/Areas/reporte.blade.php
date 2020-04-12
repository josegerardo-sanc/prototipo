@extends('Principal.Body')

@section('style')

<link rel="stylesheet" href="{{asset('DataTable/css/archivo_1.css')}}">
<link rel="stylesheet" href="{{asset('DataTable/css/archivo_2.css')}}">

@endsection

@section('contenido')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">

          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Reporte</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">                              
                    <a class="" href="{{url('/allUser')}}">Agregar nuevo Usuario</a>
                </li>
                <li class="breadcrumb-item">                              
                    <a class="" href="{{url('/home')}}">Lista de Usuarios</a>
                </li>
                <li class="breadcrumb-item active">Generar reporte</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
  
      <!-- Main content -->
      <section class="content">
        
          <div class="container">
              <div class="row">
                <div class="col-sm-12 mb-4">
                <form action="{{url('/imprimir')}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12 col-md-6 col-lg-6 form-row form-group">
                                 <label for="" class="col col-form-label">Desde</label>
                                 <input type="date" class="fecha_AJAX col-sm-12 col-lg-10 form-control" id="fecha_ini" name="fecha_ini">
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6 form-row form-group">
                                 <label for="" class="col col-form-label">Hasta</label>
                                <input type="date" class="fecha_AJAX col-sm-12 col-lg-10  form-control" id="fecha_fin" name="fecha_fin">
                            </div>
                            <div class="col-sm-12 mb-4">
                                <label for="" class="col col-form-label">area</label>
                                <select class="custom-select" id="area_perfil"  name="area_perfil" >
                                   <option selected disabled value="0">Eliga una opcion</option>
                                    @if (isset($areas))
                                        @foreach ($areas as $item) 
                                            <option 
                                            @isset($user_edit)
                                                @if ($user_edit[0]->id_area==$item->id)
                                                    selected
                                                @endif
                                            @endisset  
                                            value="{{$item->id}}">{{$item->area_new}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col-sm-12 col-lg-2 form-group">
                
                            <button type="submit"  class="btn btn-danger"><i class="fas fa-print"></i>Imprimir</button>
                            {{--<a href="{{route('customer.printpdf')}}" class="btn btn-primary" >Print PDF</a>--}}
                           </div>
                        </div>
                    </form>
                </div>
                <div class="col-sm-12">
                  @if (session('status'))
                    <div class="alert  alert-dismissible fade show" style="background-color: #B7E7C6;" role="alert">
                      {{ session('status') }}
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                  @endif
              </div>
                <div class="col-sm-12">
                  @if (isset($users))
                  {{-- {{$users_logueado}} --}}
                  @endif
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
                </div>
              </div>
          </div>
      </section>
      <!-- /.content -->
@endsection



@section('script')
   <script src="{{asset('DataTable/js/archivo_1.js')}}"></script>
   <script src="{{asset('DataTable/js/archivo_2.js')}}"></script>
   <script src="{{asset('DataTable/js/archivo_3.js')}}"></script>
   <script src="{{asset('DataTable/js/archivo_4.js')}}"></script>



   <script> 
    $(document).ready(function() {
    $('#example').DataTable({
        language: {
          "decimal": "",
          "emptyTable": "No hay información",
          "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
          "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
          "infoFiltered": "(Filtrado de _MAX_ total entradas)",
          "infoPostFix": "",
          "thousands": ",",
          "lengthMenu": "Mostrar _MENU_ Entradas",
          "loadingRecords": "Cargando...",
          "processing": "Procesando...",
          "search": "Buscar:",
          "zeroRecords": "Sin resultados encontrados",
          "paginate": {
              "first": "Primero",
              "last": "Ultimo",
              "next": "Siguiente",
              "previous": "Anterior"
          }
      }
    });
    });
   </script> 
@endsection


