@extends('master')

@section('title', 'Payment')

@section('content')

<div class="container">
    <h1 class="fw-bold mt-4">{{$vendor->vendor}}</h1>
    <p>Harga : {{$user->registrationPrice}}</p>
    @if(session('underpaid'))
        <div style="color: red">
            {{ session('underpaid') }}
        </div>
    @endif

    @if(session('overpaid'))
        <div style="color: blue">
            {{ session('overpaid') }}
        </div>
        <form method="POST" action="/balance">
            @csrf
            <label for="balance">Enter the rest of your money in the wallet balance:</label>
            <input type="number" name="balance" id="balance" required>
            <button type="submit" name="option" value="yes">Yes</button>
            <button type="submit" name="option" value="no">No</button>
        </form>
    @else
        <form method="POST" action="/payment">
            @csrf
            <label for="amount">Enter the payment amount:</label>
            <input type="number" name="amount" id="amount" required>
            <button type="submit">Pay</button>
        </form>
    @endif
</div>

@endsection

