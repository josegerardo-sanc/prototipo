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
              <h1>Lista de Usuarios</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">                              
                  <a class="" href="{{url('/reporte')}}">Reporte</a>
              </li>
               <li class="breadcrumb-item">                              
                <a class="" href="{{url('/allUser')}}">Agregar nuevo Usuario</a>
            </li>
                <li class="breadcrumb-item active">Lista de usuarios</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
  
      <!-- Main content -->
      <section class="content">
        
          <div class="container">
              <div class="row">
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
                            <th>apellidos</th>
                            <th>correo</th>
                            <th>telefono</th>
                            <th>estado</th>
                            <th>opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                         @if (isset($users))
                            @foreach ($users as $item)
                            <tr>
                              <td>{{$item->nombre}}</td>
                              <td>{{$item->paterno}} {{$item->materno}}</td>
                              <td>{{$item->email}}</td>
                              <td>{{$item->telefono}}</td>
                              <td>
                                <span class="badge badge-{{$item->activo=="activo"?'success':'danger'}}">{{$item->activo}}</span>
                              </td>
                              <td>
                                  <div class="d-flex">
                                      <form action="{{url('/allUser/'.$item->id_user.'/entrada')}}" method="POST">
                                            @csrf
                                              @if (is_null($item->fecha_salida))
                                                 <input name="control_salida" type="hidden" value="{{is_null($item->fecha_entrada)?'entrada':'salida'}}">
                                                 <button class="btn btn-sm text-{{is_null($item->fecha_entrada)?'info':'danger'}}">{{is_null($item->fecha_entrada)?'Entrada':'Salida'}}</button>       
                                              @else
                                                <button class="btn  text-success btn-sm">completado</button>
                                              @endif
                                      </form>
                                      {{-- <button class="btn btn-sm btn-danger">salida</button>  --}}
                                       <a href="{{url('allUser/'.$item->id_user.'/edit')}}" class="btn btn-sm btn-light text-warning">editar</a> 
                                        <form action="{{url('allUser/'.$item->id_user)}}" method="POST">
                                          @csrf
                                          @method('DELETE')
                                          <input type="hidden" name="status_user" value="{{$item->activo=="noactivo"?'activo':'noactivo'}}">
                                          <button  class="btn btn-sm btn-outline-{{$item->activo=="activo"?'danger':'success'}}">{{$item->activo=="activo"?'Inhabilitar':'Habilitar'}}</button> 
                                       </form>
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


