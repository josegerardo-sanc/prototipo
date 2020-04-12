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
              <h1>Lista de Áreas</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">                              
                    <a class="" href="{{url('/allUser')}}">Agregar nuevo Usuario</a>
                </li> 
                <li class="breadcrumb-item">                              
                    <a class="" href="">Agregar área</a>
                </li>
                <li class="breadcrumb-item active">Lista de área</li>
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
                    <div class="form-group">
                          <form action="{{url('/Areas')}}" method="POST">
                            @csrf
                            <div class="form-row">
                                <div class="col-sm-12">
                                    <div class="input-group mb-3">
                                        <input minlength="5" maxlength="25" id="area_new" type="text" class="form-control @error('area_new') is-invalid @enderror" name="area_new" value="{{old('name') }}" required autocomplete="area_new" autofocus
                                         placeholder="Agregar una area" aria-label="" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                          <button class="btn btn-outline-secondary" type="submit">Registrar</button>
                                        </div>
                                            @error('area_new')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                      </div>
                               </div>
                            </div>
                        </form>
                    </div>
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
                  @if (isset($areas))
                  {{-- {{$areas}} --}}
                  @endif
                  <table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>Area</th>
                            <th>Status</th>
                            <th>opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                         <tr>
                             @foreach ($areas as $item)
                                 <tr>
                                 <td>{{$item->area_new}}</td>
                                 <td>
                                    <span class="badge badge-{{$item->activo=="activo"?'success':'danger'}}">{{$item->activo=="activo"?'Activo':'InActivo'}}</span>
                                  </td>
                                  <td>
                                    <div class="d-flex">
                                          <a href="{{url('Areas/'.$item->id.'/edit')}}" class="btn btn-sm btn-light text-warning">editar</a>
                                          <form action="{{url('Areas/'.$item->id)}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="status_area" value="{{$item->activo=="noactivo"?'activo':'noactivo'}}">
                                            <button  class="btn btn-sm text-{{$item->activo=="activo"?'danger':'success'}}">{{$item->activo=="activo"?'Inhabilitar':'Habilitar'}}</button> 
                                         </form>
                                    </div>
                                </td>
                                 </tr>
                             @endforeach
                         </tr>
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


