@extends('admin.layouts.app')

@section('content')
<style type="text/css">
    img {
        display: block;
        max-width: 100%;
    }
    .preview {
        overflow: hidden;
        width: 150px; 
        height: 112px;
        border: 1px solid #000;
        background-color: #fff;
    }
    
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                	<div class="float-start h5 mb-0 fw-bold">
                        {{ __('app.photos.load') }}
                        <br />
	                	{!! '#'.$register->id.' | <small>'.$register->title.'</small>' !!}
	                </div>
                	<div class="d-grid gap-2 d-md-flex justify-content-md-end">
                		<a class="btn btn-danger btn-sm" href="{{ route($name.'.photos.index', $register) }}">
                			<i class="bi bi-x-square-fill"></i> {{ __('app.cancel') }}
                		</a>
					</div>
                </div>

                <div class="card-body">
                	@include('flash::message')
                	@php
                	$attributes = [
                        'id' => 'image-form',
                		'route' => [$name.'.photos.store', $register],
                		'method' => 'post',
                		'class' => 'row g-3 needs-validation',
                		'novalidate',
                		'autocomplete' => 'off',
                		'files' => true
                	];
                	@endphp
                	{!! Form::open($attributes) !!}
                    	<div class="col-md-6">
                    		<label for="title" class="form-label">{{ __('app.posts.title') }}</label>
                    		<input 
                    			type="text" 
                    			name="title" 
                    			class="form-control @error('title') 'is-invalid' @enderror" 
                    			value="{{ $request->old('title') }}"
                    			autofocus>
                    		@error('title')
                    		<div class="invalid-feedback">
                    			{{ $message }}
                    		</div>
                    		@enderror
                    	</div>
                    	<div class="col-md-6">
                    		<label for="photo" class="form-label">{{ __('app.posts.photo') }}</label>
                    		{!! Form::file('photo', ['class' => 'form-control form-control-file', 'required']) !!}
                            <div id="photoHelp" class="form-text">
                                Dimensiones mínimas: {{ env('NEWS_IMG0_W').'x'.env('NEWS_IMG1_H').'px' }}
                            </div>
                            <input type="hidden" name="photo-raw" value="">
                            <input type="hidden" name="crop-x" value="">
                            <input type="hidden" name="crop-y" value="">
                            <input type="hidden" name="crop-w" value="">
                            <input type="hidden" name="crop-h" value="">
                    		@error('photo')
                    		<div class="invalid-feedback">
                    			{{ $message }}
                    		</div>
                    		@enderror
                    	</div>
                        <div class="col-md-12" id="image-box" style="display: none;">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="alert alert-info">
                                        A continuación seleccione el area de la foto que quiere que aparezca como vista rápida en el listado de novedades del sitio web.
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <img id="image-upload" />
                                </div>
                                <div class="col-md-4">
                                    <div class="preview"></div>
                                </div>
                            </div>
                        </div>
                    	<div class="col-12">
                    		<button type="submit" class="btn btn-success btn-save">
                    			<i class="bi bi-check2-circle"></i> {{ __('app.load') }}
                    		</button>
                    	</div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript" src="{{ asset('vendor/cropperjs/cropper.min.js') }}"></script>
<script type="text/javascript">
    

$(document).ready(function(){
    var image = document.getElementById('image-upload');
    var cropper,reader,file;

    $("body").on("change", ".form-control-file", function(e) {
        
        var files = e.target.files;
        // alert(files);
        var done = function(url) {
            // var image = document.getElementById('image-upload');
            image.src = url;
        };


        if (files && files.length > 0) {
            file = files[0];

            if (URL) {
                done(URL.createObjectURL(file));
            } else if (FileReader) {
                reader = new FileReader();
                reader.onload = function(e) {
                    done(reader.result);
                };
                reader.readAsDataURL(file);
            }

            cropper = new Cropper(image, {
                aspectRatio: 1.3,
                viewMode: 3,
                movable: false,
                rotatable: false,
                scalable: false,
                zoomable: false,
                preview: '.preview',
                responsive: true,
                highlight: true,
                background: false,
                crop: function(event) {
                    $('input[name="crop-x"]').val(event.detail.x);
                    $('input[name="crop-y"]').val(event.detail.y);
                    $('input[name="crop-w"]').val(event.detail.width);
                    $('input[name="crop-h"]').val(event.detail.height);
                }
            });

            //Muestro
            $("#image-box").show();
        }
    });

    // /* Upload image */
    $("#image-form").submit(function(e){
        var p = $('input[name="photo-raw"]').val();

        if(p !== ''){
            return true;
        }

        e.preventDefault();
        //Corto la imagen
        canvas = cropper.getCroppedCanvas({
            width: {{ env('NEWS_IMG1_W') }},
            height: {{ env('NEWS_IMG1_H') }},
            fillColor: '#fff'
        });
        //Tomo los datos
        canvas.toBlob(function(blob) {
            url = URL.createObjectURL(blob);
            var reader = new FileReader();
            reader.readAsDataURL(blob);
            reader.onloadend = function() {
                //Datos 
                var base64data = reader.result;

                $('input[name="photo-raw"]').val(1);
                
                $("#image-form").submit();
            };
        });
    });

}); 
</script>
@endsection