@extends('master')

@section('title', 'Checkout')

@section('content')
@include('navbar')
<div class="cover">
    <img src="{{asset($vendor->image)}}" alt="">
</div>
<div class="container">
    <h1 class="fw-bold mt-4">{{$vendor->vendor}}</h1>
    <p>Harga : {{$vendor->price}}</p>
    <p>Location : {{$vendor->location}}</p>
    <p>Address : {{$vendor->address}}</p>
    <form method="POST" action="/checkout">
        @csrf
        <div class="mb-3">
            <input type="hidden" name="id" value="{{$vendor->id}}">
            <input type="hidden" name="price" value="{{$vendor->price}}">
            <label for="payment" >Payment</label> <br/>
            <input type="radio" name="payment" id="payment" value="BCA"> BCA <br/>
            <input type="radio" name="payment" id="payment" value="Gopay"> Gopay <br/>
            <input type="radio" name="payment" id="payment" value="Shopee"> Shopee <br/>
            <input type="radio" name="payment" id="payment" value="Mandiri"> Mandiri <br/>
        </div>
        <div class="mb-3">
            <label for="date" >Date</label>
            <input name="date" type="date" value="{{ old('date') }}" id="date" required>
        </div>

        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
            Pay
        </button>
    </form>
</div>

@endsection

