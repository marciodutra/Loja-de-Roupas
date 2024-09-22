@extends('layouts.admin')
@section('content')
<div class="main-content-inner">
    <!-- main-content-wrap -->
    <div class="main-content-wrap">
        <div class="flex items-center flex-wrap justify-between gap20 mb-27">
            <h3>Editar Controle deslizante</h3>
            <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                <li>
                    <a href="{{route('admin.index')}}">
                        <div class="text-tiny">Dashboard</div>
                    </a>
                </li>
                <li>
                    <i class="icon-chevron-right"></i>
                </li>
                <li>
                    <a href="{{route('admin.slide.add')}}">
                        <div class="text-tiny">Controle deslizante</div>
                    </a>
                </li>
                <li>
                    <i class="icon-chevron-right"></i>
                </li>
                <li>
                    <div class="text-tiny">Editar controle deslizante</div>
                </li>
            </ul>
        </div>        
        <div class="wg-box">
            <form class="form-new-product form-style-1" action="{{route('admin.slide.update')}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" value="{{$slide->id}}" />
                <fieldset class="name">
                    <div class="body-title">Slogan <span class="tf-color-1">*</span></div>
                    <input class="flex-grow" type="text" placeholder="Slogan" name="tagline" tabindex="0" value="{{$slide->tagline}}" aria-required="true" required="">                    
                </fieldset>
                @error('tagline') <span class="alert alert-danger text-center">{{$message}}</span> @enderror
                <fieldset class="name">
                    <div class="body-title">Título <span class="tf-color-1">*</span></div>
                    <input class="flex-grow" type="text" placeholder="Título" name="title" tabindex="0" value="{{$slide->title}}" aria-required="true" required="">                    
                </fieldset>
                @error('title') <span class="alert alert-danger text-center">{{$message}}</span> @enderror
                <fieldset class="name">
                    <div class="body-title">Subtitulo <span class="tf-color-1">*</span></div>
                    <input class="flex-grow" type="text" placeholder="Subtitulo" name="subtitle" tabindex="0" value="{{$slide->subtitle}}" aria-required="true" required="">                    
                </fieldset>
                @error('subtitle') <span class="alert alert-danger text-center">{{$message}}</span> @enderror                        
                <fieldset>
                    <div class="body-title">Carregar imagens <span class="tf-color-1">*</span>
                    </div>
                    <div class="upload-image flex-grow">
                        @if ($slide->image)                        
                        <div class="item" id="imgpreview">
                            <img src="{{asset('uploads/slides')}}/{{$slide->image}}" class="effect8" alt=""/>
                        </div>
                        @endif
                        <div class="item up-load">
                            <label class="uploadfile" for="myFile">
                                <span class="icon">
                                    <i class="icon-upload-cloud"></i>
                                </span>
                                <span class="body-text">Solte suas imagens aqui ou selecione <span class="tf-color">Clique para navegar</span></span>
                                <input type="file" id="myFile" name="image">
                            </label>
                        </div>
                    </div>                    
                </fieldset>
                @error('image') <span class="alert alert-danger text-center">{{$message}}</span> @enderror
                <fieldset class="category">
                    <div class="body-title">Status</div>
                    <div class="select flex-grow">
                        <select class="" name="status">
                            <option>Selecione</option>
                            <option value="1" @if ($slide->status=="1") selected @endif>Ativo</option>
                            <option value="0" @if ($slide->status=="0") selected @endif>Inativo</option>
                        </select>
                    </div>                    
                </fieldset>
                @error('status') <span class="alert alert-danger text-center">{{$message}}</span> @enderror
                <div class="bot">
                    <div></div>
                    <button class="tf-button w208" type="submit">Salvar</button>
                </div>
            </form>
        </div>        
    </div>    
</div>
@endsection
@push('scripts')
    <script>
        $(function(){
            $("#myFile").on("change",function(e){
                const photoInp = $("#myFile");
                const [file] = this.files;
                if(file)
            {
                $("#imgpreview img").attr('src',URL.createObjectURL(file));
                $("#imgpreview").show();
            }
            });            
        });        
    </script>
@endpush