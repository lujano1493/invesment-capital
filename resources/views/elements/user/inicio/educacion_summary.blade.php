@php

$user = Auth::user();

$cuestionarios =$user->cuestionarios()->wherePivot("visto", false)->orderBy('id','asc')->paginate(5)->items();

@endphp

<div class="row">
    <div class="panel panel-default">
        <div class="panel-heading">
        	<i class="fa fa-tasks fa-fw"></i>
            últimos Cuestionarios Asignados
        </div>
        <!-- /.panel-heading -->
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre de Cuestionario</th>
                            <th>Fecha de Fecha Limite</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach( $cuestionarios as $cuestionario )
                        <tr>
                            <td> {{ $cuestionario->id }} </td>
                            <td>{{ $cuestionario->titulo }}</td>
                            <td> {{ $cuestionario->fecha_limite->format('d-m-Y') }}</td>
                            <td> <a class="btn btn-primary" href="{{ route('capital.educacion') }}"> Ver Detalles  </a></td>
                        </tr>
                        @endforeach



                    </tbody>
                    
                </table>
            </div>
            <!-- /.table-responsive -->
        </div>
    <!-- /.panel-body -->
    </div>
	</div>