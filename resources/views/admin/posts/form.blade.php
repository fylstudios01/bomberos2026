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
                    		<label for="title" class="form-label">{{ __('app.posts.title') }}</label>
                    		<input 
                    			type="text" 
                    			name="title" 
                    			class="form-control @error('title') 'is-invalid' @enderror" 
                    			value="{{ isset($register) ? $register->title : $request->old('title') }}"
                    			autofocus>
                    		@error('title')
                    		<div class="invalid-feedback">
                    			{{ $message }}
                    		</div>
                    		@enderror
                    	</div>
                    	<div class="col-md-4">
                    		<label for="category_id" class="form-label">{{ __('app.posts.category') }}</label>
                    		@php
                    		$selectValue = isset($register) ? $register->category_id : $request->old('category_id');
                    		$selectAttributes = [
                				'class' => 'form-control '.($errors->first('category_id') ? 'is-invalid' : ''), 
                				'placeholder' => __('app.select')
                    		];
                    		@endphp
                    		{{ 
                    			Form::select(
                    				'category_id', 
                    				$categories, 
                    				$selectValue, 
                    				$selectAttributes
                				) 
                			}}
                    		@error('category_id')
                    		<div class="invalid-feedback">
                    			{{ $message }}
                    		</div>
                    		@enderror
                    	</div>
                        <div class="col-md-12">
                            <label for="content" class="form-label">{{ __('app.posts.content') }}</label>
                            {!! Form::textarea('content', isset($register) ? $register->content : null, ['class'=>'form-control editor', 'style' => 'height: 300px']) !!}
                        </div>
                        <div class="col-md-4">
                            <label for="publish" class="form-label">{{ __('app.posts.publish') }}</label>
                            @php
                            $selectValue = isset($register) ? $register->publish : $request->old('publish');
                            $selectAttributes = [
                                'class' => 'form-control '.($errors->first('publish') ? 'is-invalid' : ''), 
                                'placeholder' => __('app.select')
                            ];
                            @endphp
                            {{ 
                                Form::select(
                                    'publish', 
                                    trans('app.boolean'), 
                                    $selectValue, 
                                    $selectAttributes
                                ) 
                            }}
                            @error('publish')
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
