@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <div class="float-start h5 mb-0 fw-bold">
                        {{ __('app.modules.'.$name).' - '.(isset($register) ? __('app.edit') : __('app.create')) }}
                    </div>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a class="btn btn-danger btn-sm" href="{{ route($name.'.index') }}">
                            <i class="bi bi-x-square-fill"></i> {{ __('app.cancel') }}
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    @include('flash::message')

                    @php
                    $attributes = [
                        'route' => isset($register) ? [$name.'.update', $register] : $name.'.store',
                        'method' => isset($register) ? 'put' : 'post',
                        'class' => 'row g-3 needs-validation',
                        'novalidate',
                        'autocomplete' => 'off'
                    ];
                    @endphp

                    {!! Form::open($attributes) !!}

                    {{-- NOMBRE --}}
                    <div class="col-md-6">
                        <label for="name" class="form-label">Nombre</label>
                        <input type="text" name="name"
                               class="form-control @error('name') is-invalid @enderror"
                               value="{{ isset($register) ? $register->name : old('name') }}">
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- APELLIDO --}}
                    <div class="col-md-6">
                        <label for="last_name" class="form-label">Apellido</label>
                        <input type="text" name="last_name"
                               class="form-control @error('last_name') is-invalid @enderror"
                               value="{{ isset($register) ? $register->last_name : old('last_name') }}">
                        @error('last_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- EMAIL --}}
                    <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email"
                               class="form-control @error('email') is-invalid @enderror"
                               value="{{ isset($register) ? $register->email : old('email') }}">
                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- DNI --}}
                    <div class="col-md-6">
                        <label for="dni" class="form-label">DNI</label>
                        <input type="text" name="dni"
                               class="form-control @error('dni') is-invalid @enderror"
                               value="{{ isset($register) ? $register->dni : old('dni') }}">
                        @error('dni') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- TELÉFONO --}}
                    <div class="col-md-6">
                        <label for="phone" class="form-label">Teléfono</label>
                        <input type="text" name="phone"
                               class="form-control @error('phone') is-invalid @enderror"
                               value="{{ isset($register) ? $register->phone : old('phone') }}">
                        @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- DIRECCIÓN --}}
                    <div class="col-md-6">
                        <label for="address" class="form-label">Dirección</label>
                        <input type="text" name="address"
                               class="form-control @error('address') is-invalid @enderror"
                               value="{{ isset($register) ? $register->address : old('address') }}">
                        @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- FECHA NACIMIENTO --}}
                    <div class="col-md-6">
                        <label for="birthdate" class="form-label">Fecha de nacimiento</label>
                        <input type="date" name="birthdate"
                               class="form-control @error('birthdate') is-invalid @enderror"
                               value="{{ isset($register->birthdate) ? $register->birthdate->format('Y-m-d') : old('birthdate') }}">
                        @error('birthdate') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- N° LEGAJO --}}
                    <div class="col-md-3">
                        <label for="legajo_number" class="form-label">N° de legajo</label>
                        <input type="text" name="legajo_number"
                               class="form-control @error('legajo_number') is-invalid @enderror"
                               value="{{ isset($register) ? $register->legajo_number : old('legajo_number') }}">
                        @error('legajo_number') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- FECHA INGRESO --}}
                    <div class="col-md-3">
                        <label for="ingreso_date" class="form-label">Fecha de ingreso</label>
                        <input type="date" name="ingreso_date"
                               class="form-control @error('ingreso_date') is-invalid @enderror"
                               value="{{ isset($register->ingreso_date) ? $register->ingreso_date->format('Y-m-d') : old('ingreso_date') }}">
                        @error('ingreso_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- JERARQUÍA --}}
                    <div class="col-md-6">
                        <label for="hierarchy_id" class="form-label">Jerarquía</label>
                        <select name="hierarchy_id"
                                class="form-control @error('hierarchy_id') is-invalid @enderror">
                            <option value="">Seleccione</option>
                            @foreach($hierarchies as $h)
                                <option value="{{ $h->id }}"
                                  {{ old('hierarchy_id', $register->hierarchy_id ?? '') == $h->id ? 'selected' : '' }}>
                                  {{ $h->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('hierarchy_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- HABILITADO --}}
                    <div class="col-md-3">
                        <label for="enabled" class="form-label">{{ __('app.users.enabled') }}</label>
                        @php
                            $selectValue = isset($register) ? $register->enabled : old('enabled');
                            $selectAttributes = [
                                'class' => 'form-control '.($errors->first('enabled') ? 'is-invalid' : ''),
                                'placeholder' => __('app.select')
                            ];
                        @endphp
                        {{ Form::select('enabled', trans('app.boolean'), $selectValue, $selectAttributes) }}
                        @error('enabled') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- CONTRASEÑA --}}
                    <div class="col-md-4">
                        <label for="password" class="form-label">{{ __('app.users.password') }}</label>
                        <input type="password" name="password"
                               class="form-control @error('password') is-invalid @enderror">
                        @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- CONFIRMAR CONTRASEÑA --}}
                    <div class="col-md-4">
                        <label for="password_confirmation" class="form-label">{{ __('app.users.password_confirmation') }}</label>
                        <input type="password" name="password_confirmation"
                               class="form-control @error('password') is-invalid @enderror">
                    </div>

                    {{-- BOTÓN GUARDAR --}}
                    <div class="col-12">
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-check2-circle"></i> {{ __('app.save') }}
                        </button>
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
