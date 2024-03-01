@extends('layouts.app')
@section('content')
    <div class="row justify-content-center my-4">
        <div class="col-12">
        </div>
        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-header">
                    <h2>Registrar oferta gas</h2>
                </div>
                <div class="card-body">
                    @if (session('info'))
                        <div class="alert alert-success">
                            {{ session('info') }}
                        </div>
                    @endif
                    {!! Form::open(['route' => 'parrillagas.store']) !!}
                    <div class="form-group">
                        {!! Form::label('comercializadora', 'Comercializadora', ['class' => 'form-label']) !!}
                        {!! Form::select('comercializadora', $comercializadoras->pluck('nombre', 'id'), null, [
                            'class' => 'form-control',
                        ]) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('estado', 'Estado', ['class' => 'form-label']) !!}
                        @foreach ($states as $state)
                            <div>
                                <label>
                                    {!! Form::radio('estado', $state->id, null, ['class' => 'my-1 d-flex', 'required' => 'required']) !!}
                                    {{ $state->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                    <div class="form-group">
                        {!! Form::label('nombre_tarifa', 'Nombre de la tarifa', ['class' => 'form-label']) !!}
                        {!! Form::text('nombre_tarifa', null, [
                            'class' => 'form-control',
                            'required' => 'required',
                        ]) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('parrilla_bloque_1', 'característica #1', ['class' => 'form-label']) !!}
                        {!! Form::textarea('parrilla_bloque_1', null, [
                            'class' => 'form-control',
                            'rows' => 2,
                        ]) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('parrilla_bloque_2', 'característica #2', ['class' => 'form-label']) !!}
                        {!! Form::textarea('parrilla_bloque_2', null, [
                            'class' => 'form-control',
                            'rows' => 2,
                        ]) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('parrilla_bloque_3', 'característica #3', ['class' => 'form-label']) !!}
                        {!! Form::textarea('parrilla_bloque_3', null, [
                            'class' => 'form-control',
                            'rows' => 2,
                        ]) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('parrilla_bloque_4', 'característica #4', ['class' => 'form-label']) !!}
                        {!! Form::textarea('parrilla_bloque_4', null, [
                            'class' => 'form-control',
                            'rows' => 2,
                        ]) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('landing_dato_adicional', 'Landing dato adicional', ['class' => 'form-label']) !!}
                        {!! Form::text('landing_dato_adicional', null, [
                            'class' => 'form-control',
                        ]) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('meses_permanencia', 'Meses permanencia', ['class' => 'form-label']) !!}
                        {!! Form::selectRange('meses_permanencia', 0, 12, null, [
                            'class' => 'form-control',
                        ]) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('precio', ' Precio', ['class' => 'form-label']) !!}
                        {!! Form::text('precio', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('precio_final', 'Precio final', ['class' => 'form-label']) !!}
                        {!! Form::text('precio_final', null, [
                            'class' => 'form-control',
                        ]) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('num_meses_promo', 'Meses de promoción', ['class' => 'form-label']) !!}
                        {!! Form::selectRange('num_meses_promo', 0, 12, null, [
                            'class' => 'form-control',
                        ]) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('promocion', 'Promoción', ['class' => 'form-label']) !!}
                        {!! Form::text('promocion', null, [
                            'class' => 'form-control',
                        ]) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('fecha_expiracion', 'Fecha expiración', ['class' => 'form-label']) !!}
                        {!! Form::date('fecha_expiracion', \Carbon\Carbon::now(), [
                            'class' => 'form-control',
                        ]) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('coste_mantenimiento', 'Coste mantenimiento', ['class' => 'form-label']) !!}
                        {!! Form::number('coste_mantenimiento', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('coste_de_gestion', 'Coste de gestión', ['class' => 'form-label']) !!}
                        {!! Form::number('coste_de_gestion', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('gas_tipo_precio', 'Tipo precio', ['class' => 'form-label']) !!}
                        {!! Form::text('gas_tipo_precio', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('gas_precio_termino_fijo', 'Precio gas termino fijo', ['class' => 'form-label']) !!}
                        {!! Form::number('gas_precio_termino_fijo', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('gas_precio_termino_variable', 'Precio gas termino variable', ['class' => 'form-label']) !!}
                        {!! Form::number('gas_precio_termino_variable', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('gas_precio_energia', 'Precio gas energía', ['class' => 'form-label']) !!}
                        {!! Form::number('gas_precio_energia', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('pais', 'Visible en', ['class' => 'form-label']) !!}
                        {!! Form::select('pais', $paises->pluck('nombre', 'id'), null, [
                            'class' => 'form-control',
                        ]) !!}
                        {!! Form::submit('Registrar', ['class' => 'btn btn-primary mt-3']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    @endsection
