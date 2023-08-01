@extends('master')

@section('title', 'Register')

@section('content')
<div class="flex flex-row h-screen items-center justify-center">
    <div class="w-1/2 flex h-screen  items-center justify-center">
        <img class="w-4/6" src="wedding.png" alt="">
    </div>
    <div class="w-1/2 flex flex-col h-screen justify-center">
        <h1>SkyUniverse</h1>
        <div class="flex flex-col align-center gap-1">
            <h2 class="fw-bold">Login</h2>
            <form method="POST" class="flex flex-col" action="/register" enctype="multipart/form-data">
                @csrf
                <div class="w-5/6 justify-between flex gap-1">
                    <div class="mb-2 w-1/2 flex flex-col">
                        <label for="name">Name</label>
                        <input name="name" type="text" class="w-full" value="{{ old('name') }}" id="name">
                        @error('name')
                            <div id="nameError">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 flex flex-col">
                        <label for="datingCode">DT Code</label>
                        <input name="datingCode" type="text" value="{{ old('datingCode') }}" id="code">
                        @error('datingCode')
                            <div id="datingCode">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3 w-5/6 flex flex-col">
                    <label for="email">Email</label>
                    <input name="email" type="email" class="w-full" value="{{ old('email') }}" id="email">
                    @error('email')
                        <div id="emailError">{{ $message }}</div>
                    @enderror
                </div>
                <div class="">
                    <div class="mb-2 w-5/6 flex flex-col">
                        <label for="birthdate">Birthdate</label>
                        <input name="birthdate" type="date" value="{{ old('birthdate') }}" id="birthdate">
                        @error('birthdate')
                            <div id="birthdateError">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-2 w-5/6 flex flex-col">
                        <label for="gender">Gender</label>
                        <select name="gender" id="gender">
                            <option>Select gender</option>
                            <option @if (old('gender') == 'male') selected @endif value="male">Male</option>
                            <option @if (old('gender') == 'female') selected @endif value="female">Female</option>
                        </select>
                        @error('gender')
                            <div id="genderError">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="mb-2 w-5/6 flex flex-col">
                    <label for="phoneNumber">Phone number</label>
                    <input name="phoneNumber" type="tel" value="{{ old('phoneNumber') }}"
                        id="phoneNumber">
                    @error('phoneNumber')
                        <div id="phoneNumberError">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-2 w-5/6 flex flex-col">
                    <label for="image">Image</label>
                    <input name="image" type="file" id="image"
                        accept="image/png, image/gif, image/jpeg">
                    @error('image')
                        <div id="imageError">{{ $message }}</div>
                    @enderror
                </div>
                <div class="flex w-5/6 justify-between">
                        <div class="mb-2 w-5/6 flex flex-col">
                            <label for="password">Password</label>
                            <input name="password" type="password" id="password">
                            @error('password')
                                <div id="passwordError">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-2 w-5/6 flex flex-col">
                            <label for="passwordConfirmation">Password Confirmation</label>
                            <input name="passwordConfirmation" type="password" id="passwordConfirmation">
                            @error('passwordConfirmation')
                            <div id="passwordConfirmationError">{{ $message }}</div>
                        @enderror
                        </div>
                </div>
                <button type="submit" class="w-1/6 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
                    Submit
                </button>
            </form>
            {{-- <p class="p-0 m-0">Already Have Account? <a href="{{ route('login') }}">Login</a></p> --}}
        </div>
            <p>Copyright @ studio 2022</p>
        </div>
    </div>


</div>
@endsection
