@extends('master')

@section('title', 'Wedding')

@section('content')
@include('navbar')
<div class="container w-screen flex flex-col align-center justify-center">
    <div class="w-screen flex align-center justify-center">
        <h1>Here is your wedding partner</h1>
    </div>
    <div class="w-screen flex align-center justify-center">
        <img class="w-1/3" src="{{ asset('storage/' . $partner->imagePath) }}">
    </div>

</div>

<div class="flex flex-row h-screen justify-center">
    <div class="container">
        <h2>Choose Your Location</h2> <!-- Use url() to generate the URL -->
        <select name="location" class="my-3" id="location" onchange="changePeriod()">
            <option>Wedding Location</option>
            <option @if (old('location') == 'Jakarta') selected @endif value="Jakarta">Jakarta</option>
            <option @if (old('location') == 'Singapore') selected @endif value="Singapore">Singapore</option>
            <option @if (old('location') == 'Tangerang') selected @endif value="Tangerang">Tangerang</option>
        </select>

        <script>
            // Add an event listener to the <select> element
            document.getElementById('location').addEventListener('change', function() {
                // Submit the form when the selection changes
                document.getElementById('filterForm').submit();
            });
        </script>

        <div class="flex flex-wrap justify-between mx-auto">
            @foreach ($vendors as $vendor)
                <a class="flex card w-1/3" id="vendorcard" href="/checkout/{{$vendor->id}}">
                    <img src="{{ asset($vendor['image']) }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $vendor['vendor'] }}</h5>
                        <p class="card-text">{{ $vendor['address'] }}</p>
                        <p class="card-text">{{ $vendor['price'] }}</p>
                    </div>
                </a>
            @endforeach
        </div>


        <div class="flex flex-row align-center justify-center">
            {{ $vendors->links() }}
        </div>
    </div>
</div>

<script>
     function changePeriod() {

        var location = document.getElementById("location").value;
        var url = '/wedding/' + encodeURIComponent(location);

        // Redirect to the constructed URL
        window.location.href = url;
    }
</script>

@endsection

