@extends('master')

@section('title', 'Home')

@section('content')
@include('navbar')
<div>
    {{-- @dd(asset('storage/' . $candidate[0]['imagePath'])); --}}
    <img id="userImage" src="" alt="User Image">
    <h3 id="userName">{{ $candidate[0]['name'] }}</h3>
  </div>
  <button id="likeButton">Like</button>
  <button id="dislikeButton">Dislike</button>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    const candidate = @json($candidate->toArray()); // Convert Laravel Collection to JavaScript array

    let currentUserIndex = 0;

    function showUser() {
      const userImage = document.getElementById("userImage");
      const userName = document.getElementById("userName");

      // Get the current user data
      const currentUser = candidate[currentUserIndex];

      // Update the HTML with the current user data
      userImage.src = 'storage/' + currentUser.imagePath;
      userName.textContent = currentUser.name;
    }

    function dislikeUser() {
      // Increment the index to show the next user
      currentUserIndex = (currentUserIndex + 1) % candidate.length;

      // Display the next user
      showUser();
    }

    function likeUser() {
    // Assuming candidate[currentUserIndex] has the necessary candidate data.
    var candidateId = candidate[currentUserIndex]['id'];
    // Make an AJAX request to the backend API endpoint to check if the user has liked the candidate.
    $.ajax({
        type: 'GET',
        url: '/checkLike/' + candidateId, // Replace with your actual API endpoint URL.
        success: function(response) {
            if (response.hasLiked) {
                // The current user has already liked the candidate.
                // Handle this situation accordingly.
                window.location.href = '/wedding';
            } else {
                // The current user has not liked the candidate yet.
                // Perform the actions to like the candidate.
                // Increment the index to show the next user
                currentUserIndex = (currentUserIndex + 1) % candidate.length;

                // Display the next user
                showUser();
            }
        },
        error: function() {
            // Handle any errors that occur during the AJAX request.
        }
    });
}

    // Show the first user when the page loads
    showUser();

    // Add click event listener to the next button
    const likeButton = document.getElementById("likeButton");
    const dislikeButton = document.getElementById("dislikeButton");
    likeButton.addEventListener("click", likeUser);
    dislikeButton.addEventListener("click", dislikeUser);
    </script>

@endsection
