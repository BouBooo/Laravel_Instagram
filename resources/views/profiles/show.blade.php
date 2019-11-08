@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-4">
        {{ dump($user) }}
        <div class="col-4 text-center">
                <img class="rounded-circle" src="https://cdn.iconscout.com/icon/free/png-512/laravel-226015.png" width="214px"/>
        </div>
        <div class="col-8">
            <div class="d-flex align-items-baseline">
                <div class="h4 mr-3 pt-3">{{ $user->username }}</div>
                <button class="btn btn-sm btn-primary">
                    S'abonner
                </button>
            </div>
            <div class="d-flex mt-3">
                <div class="mr-3"><strong>{{ count($user->posts) }}</strong> publication(s) </div>
                <div class="mr-3"><strong>X</strong> abonnés</div>
                <div class="mr-3"><strong>X</strong> abonnements</div>
            </div>
            <div class="mt-3">
                <div class="font-weight-bold">{{ $user->profile->title }}</div>
                <div>{{ $user->profile->description }}</div>
                <a href="{{ $user->profile->url }}">{{ $user->profile->url }}</a>
            </div>
        </div>
    </div>
    <div class="row mt-5">
        @foreach ($user->posts as $post)
        <div class="col-4 mt-3">
            <a href="{{ route('posts.show', ['post' => $post->id]) }}">
                <img class="w-100" src="{{ asset('storage') . '/' . $post->image }}"/>
            </a>
        </div>
        @endforeach
    </div>
</div>
@endsection
