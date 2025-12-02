@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                	<div class="float-start h5 mb-0 fw-bold">
	                	{{ '#'.$register->id.' | '.$register->title.' - '.__('app.posts.photos') }}
	                </div>
                	<div class="d-grid gap-2 d-md-flex justify-content-md-end">
                		<a class="btn btn-success btn-sm" href="{{ route($name.'.photos.create', $register) }}">
                			<i class="bi bi-plus-square me-1"></i> {{ __('app.load') }}
                		</a>
                		<a class="btn btn-danger btn-sm" href="{{ route($name.'.index') }}">
                			<i class="bi bi-x-square-fill"></i> {{ __('app.cancel') }}
                		</a>
					</div>
                </div>

                <div class="card-body">
                	@include('flash::message')
                    <div class="row">
                    	@foreach($rows as $r)
                    	<div class="col-md-3">
                    		<div class="card">
                    			@php
                    			$imgSrc = 'photos/'.$r->path.'IMG1_'.$r->filename;
                    			@endphp
                    			<img src="{{ asset($imgSrc) }}" class="card-img-top" alt="...">
                    			<div class="card-body">
                    		  		<h5 class="card-title">{{ $r->title }}</h5>
                    		    	<a href="{{ route($name.'.photos.delete', [$register, $r]) }}" class="btn btn-danger">
                    		    		<i class="bi bi-trash"></i> {{ __('app.delete') }}
                    		    	</a>
                    		  	</div>
                    		</div>
                    	</div>
                    	@endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
