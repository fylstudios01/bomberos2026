@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                	<div class="float-start h5 mb-0 fw-bold">
	                	{{ __('app.modules.'.$name).' - '.__('app.list') }}
	                </div>
                	<div class="d-grid gap-2 d-md-flex justify-content-md-end">
                		<a class="btn btn-success btn-sm" href="{{ route($name.'.create') }}">
                			<i class="bi bi-plus-square me-1"></i> {{ __('app.create') }}
                		</a>
					</div>
                </div>

                <div class="card-body">
                	@include('flash::message')
                    <table class="table">
                    	<thead>
	                        <tr>
	                        	<th scope="col" class="text-center">#</th>
	                        	<th scope="col" class="text-center">{{ __('app.categories.name')}}</th>
	                        	<th scope="col" class="text-center">{{ __('app.categories.enabled') }}</th>
	                        	<th scope="col" class="text-center">{{ __('app.actions') }}</th>
	                        </tr>
	                      </thead>
                      	<tbody>
                      		@foreach($rows as $r)
                        	<tr>
                        		<th scope="row" class="text-center">{{ $r->id }}</th>
	                          	<td>{{ $r->name }}</td>
	                          	<td class="text-center">{{ $r->isEnabled }}</td>
	                          	<td class="text-center">
	                          		<a 
	                          			class="btn btn-sm btn-info" 
	                          			href="{{ route($name.'.edit', $r) }}" 
	                          			>
	                          			<i class="bi bi-pencil-square"></i>
	                          		</a>
	                          		<a
	                          			class="btn btn-sm btn-danger delete"
	                          			href="{{ route($name.'.delete', $r) }}"
	                          			title="{{ __('app.delete') }}"
	                          		>
	                          			<i class="bi bi-trash"></i>
	                          		</a>
	                          	</td>
                        	</tr>
                        	@endforeach
                      	</tbody>
                    </table>
                </div>

                <div class="card-footer">
                	{{ $rows->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
