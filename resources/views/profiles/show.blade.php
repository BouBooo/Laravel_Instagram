@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-4">
        <div class="col-4 text-center">
                <img class="rounded-circle" src="{{ $user->profile->getImage() }}" width="214px"/>
        </div>
        <div class="col-8">
            <div class="d-flex align-items-baseline">
                <div class="h4 mr-3 pt-3">{{ $user->username }}</div>
                <follow-button profile-id="{{ $user->profile->id }}" follows="{{ $follows }}"></follow-button>
            </div>
            <div class="d-flex mt-3">
                <div class="mr-3"><strong>{{ $postsCount }}</strong> publication(s) </div>
                <div class="mr-3"><strong>{{ $followersCount }}</strong> abonnés</div>
                <div class="mr-3"><strong>{{ $followingCount }}</strong> abonnements</div>
            </div>
            @can('update', $user->profile)
                <a class="btn btn-outline-secondary mt-3" href="{{ route('profiles.edit', ['username' => $user->username]) }}">Modifier mes informations</a>
            @endcan
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
