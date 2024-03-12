@extends('layouts.app')
@section('content')
    @can('fibramoviltv.view.btn-create')
        <div class="row justify-content-center my-4">
            <div class="col-12">
                <a href="{{ route('parrillafibramoviltv.create') }}" class="btn btn-primary">Nueva oferta</a>
            </div>
        </div>
    @endcan

    <div class="row justify-content-center my-2">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body overflow-auto">
                    @if (session('info'))
                        <div class="alert alert-success">
                            {{ session('info') }}
                        </div>
                    @endif
                    <h4>Listado de parrilla Fibra, movil y TV</h4>
                    <table id="parrillafibramoviltvTable" class="table table-striped" style="width:100%">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th>id</th>
                                <th>Estado</th>
                                <th>Operadora</th>
                                <th>Oferta</th>

                                <th>Precio</th>
                                <th>Visible en</th>
                                @can('fibramoviltv.view.btn-edit')
                                    <th></th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tarifas as $tarifa)
                                <tr>
                                    <td class="align-middle">{{ $tarifa->id }}</td>
                                    <td class="align-middle">{{ $tarifa->state->name ?? 'Not Available' }}</td>
                                    <td class="align-middle">{{ $tarifa->operadoras->nombre ?? 'Not Available' }}</td>
                                    <td class="align-middle">{{ $tarifa->nombre_tarifa }}</td>

                                    <td class="align-middle">{{ $tarifa->precio }}</td>
                                    <td class="align-middle">{{ $tarifa->pais }}</td>
                                    <td>
                                        @can('fibramoviltv.view.btn-edit')
                                            <a href="{{ route('parrillafibramoviltv.edit', $tarifa) }}"
                                                class="btn btn-primary">Editar</a>
                                        @endcan
                                        @can('fibramoviltv.view.btn-duplicate')
                                            <a href="{{ route('parrillafibramoviltvDuplicate', $tarifa) }}"
                                                class="btn btn-primary">Duplicar</a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection