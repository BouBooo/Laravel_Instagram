@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Modifier mes informations</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('profiles.update', ['user' => $user]) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="title">Titre</label>
                                <input placeholder="Titre de mon image" id="title" type="text" class="form-control @error('title') is-invalid @enderror" 
                                name="title" value="{{ old('title') ?? $user->profile->title }}" autocomplete="title" autofocus>

                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                                <textarea placeholder="Description de mon image" id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" autocomplete="description" autofocus>
                                    {{ old('description') ?? $user->profile->description }} 
                                </textarea>
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                        <div class="form-group">
                            <label for="url">URL</label>
                                <input placeholder="Url de mon image" id="url" type="text" class="form-control @error('url') is-invalid @enderror" 
                                name="url" autocomplete="url" value="{{ old('url') ?? $user->profile->url }}" autofocus>           
                                @error('url')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                        <div class="form-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input @error('image') is-invalid @enderror" id="customFile" name="image">
                                <label class="custom-file-label" for="customFile">Choisir une image</label>
                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            Sauvegarder
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
