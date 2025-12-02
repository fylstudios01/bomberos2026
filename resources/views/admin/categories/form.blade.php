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
                		'route' => isset($register) ? [$name.'.update', $register]: $name.'.store',
                		'method' => isset($register) ? 'put' : 'post',
                		'class' => 'row g-3 needs-validation',
                		'novalidate',
                		'autocomplete' => 'off'
                	];
                	@endphp
                	{!! Form::open($attributes) !!}
                    	<div class="col-md-8">
                    		<label for="name" class="form-label">{{ __('app.categories.name') }}</label>
                    		<input 
                    			type="text" 
                    			name="name" 
                    			class="form-control @error('name') 'is-invalid' @enderror" 
                    			value="{{ isset($register) ? $register->name : $request->old('name') }}"
                    			autofocus>
                    		@error('name')
                    		<div class="invalid-feedback">
                    			{{ $message }}
                    		</div>
                    		@enderror
                    	</div>
                    	<div class="col-md-4">
                    		<label for="enabled" class="form-label">{{ __('app.categories.enabled') }}</label>
                    		@php
                    		$selectValue = isset($register) ? $register->enabled : $request->old('enabled');
                    		$selectAttributes = [
                				'class' => 'form-control '.($errors->first('enabled') ? 'is-invalid' : ''), 
                				'placeholder' => __('app.select')
                    		];
                    		@endphp
                    		{{ 
                    			Form::select(
                    				'enabled', 
                    				trans('app.boolean'), 
                    				$selectValue, 
                    				$selectAttributes
                				) 
                			}}
                    		@error('enabled')
                    		<div class="invalid-feedback">
                    			{{ $message }}
                    		</div>
                    		@enderror
                    	</div>
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
