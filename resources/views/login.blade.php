@extends('master')

@section('title', 'Login')

@section('content')

@if(session('error'))
    <div class="alert alert-danger bg-red-600 text-white z-3">
        {{ session('error') }}
    </div>
@endif

<div class="flex flex-row h-screen justify-center">

    <div class="w-1/2 flex flex-col h-screen items-center justify-center">
        <h1>SkyUniverse</h1>
        <div class="flex flex-col bg-red-100 container w-5/6 items-center justify-center">
                <h2 class="fw-bold">Login</h2>
                <form class="w-full items-center" caction="/login" method="POST">
                @csrf
                    <div class="px-10 mb-3 flex flex-col">
                        <label for="email">Id or Email address</label>
                        <input name="email" type="text" class="" value="{{ old('email') }}" id="email">
                        @error('email')
                            <div id="emailHelp">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="px-10 mb-3 w-full flex flex-col">
                        <label for="password" class="form-label">Password</label>
                        <input name="password" type="password" class="form-control" id="password">
                        @error('password')
                            <div id="passwordHelp">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
                        Submit
                    </button>
                </form>
            <p>Copyright @ studio 2022</p>
        </div>
    </div>
    <div class="w-1/2 flex h-screen  items-center justify-center">
        <img class="w-4/6" src="wedding.png" alt="">
    </div>

</div>
@endsection
