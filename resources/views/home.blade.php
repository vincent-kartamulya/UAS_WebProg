@extends('master')

@section('title', 'Wedding')

@section('content')
@include('navbar')

<div class="flex flex-row h-screen justify-center">
    <div class="container">
        <form action="/search" method="GET">
            <input type="text" name="query" placeholder="Search by hobby or field of work">
            <select name="gender" id="gender">
                <option value="">All Genders</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
            <button type="submit">Search</button>
        </form>

        <div class="flex flex-wrap justify-between mx-auto">
            @foreach ($friends as $friend)
                <div class="flex card w-1/3">
                    <input type="hidden" id='friendId' value={{$friend->id}}>
                    <img src="{{ asset($friend['image']) }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $friend['name'] }}</h5>
                    </div>
                    <button id="likeButton">Thumbs</button>
                </div>
            @endforeach
        </div>


        <div class="flex flex-row align-center justify-center">
            {{ $friends->links() }}
        </div>
    </div>
</div>

<script>
    const candidateId = document.getElementById('friendId');
    function likeUser() {
    $.ajax({
        type: 'GET',
        url: '/checkLike/' + candidateId, // Replace with your actual API endpoint URL.
        success: function(response) {
            if (response.hasLiked) {
                // The current user has already liked the candidate.
                // Handle this situation accordingly.
                window.location.href = '/chat';
            }
        },
        error: function() {
            // Handle any errors that occur during the AJAX request.
        }
    });
}

    // Add click event listener to the next button
    const nextButton = document.getElementById("nextButton");
    nextButton.addEventListener("click", nextUser);
    </script>
@endsection

