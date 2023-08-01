@extends('master')

@section('title', 'Wedding')

@section('content')
@include('navbar')

<div class="flex flex-row h-screen justify-center">
    <div class="container">
        <!-- Display the search results -->
        @if(isset($users) && count($users) > 0)
            <h2>Search Results</h2>
            <div class="flex flex-wrap justify-between mx-auto">
                @foreach ($friends as $friend)
                    <a class="flex card w-1/3" href="/checkout/{{$friend->id}}">
                        <img src="{{ asset($friend['image']) }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $friend['name'] }}</h5>
                        </div>
                    </a>
                @endforeach
            </div>

            <div class="flex flex-row align-center justify-center">
                {{ $friends->links() }}
            </div>
        @else
            <p>No users found.</p>
        @endif

    </div>
</div>

@endsection

