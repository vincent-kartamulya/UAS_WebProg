@extends('master')

@section('title', 'Register')

@section('content')
<div class="flex flex-row h-screen items-center justify-center">
    <div class="w-1/2 flex h-screen  items-center justify-center">
        <img class="w-1/2" src="friend.png" alt="">
    </div>
        <div class="w-1/2 flex flex-col items-center justify-center px-6 py-8 mx-auto  lg:py-0">
            <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 :text-white">
                ConnectFriends
            </a>
            <div class="w-11/12 bg-white rounded-lg shadow">
                <div class="p-6 space-y-4 md:space-y-6">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl :text-white">
                        Create an account
                    </h1>
                    <form method="POST" class="space-y-4 md:space-y-6" action="/register" enctype="multipart/form-data">
                        @csrf
                        <div class="w-5/6 justify-between flex gap-1">
                            <div class="mb-2 w-1/2 flex flex-col">
                                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 :text-white">Name</label>
                                <input name="name" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 :bg-gray-700 :border-gray-600 :placeholder-gray-400 :text-white :focus:ring-blue-500 :focus:border-blue-500" value="{{ old('name') }}" id="name">
                                @error('name')
                                    <div id="nameError" class="text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-2 w-5/6 flex flex-col">
                                <label for="gender" class="block mb-2 text-sm font-medium text-gray-900 :text-white">Gender</label>
                                <select name="gender" id="gender" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 :bg-gray-700 :border-gray-600 :placeholder-gray-400 :text-white :focus:ring-blue-500 :focus:border-blue-500">
                                    <option>Select gender</option>
                                    <option @if (old('gender') == 'male') selected @endif value="male">Male</option>
                                    <option @if (old('gender') == 'female') selected @endif value="female">Female</option>
                                </select>
                                @error('gender')
                                    <div id="genderError" class="text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-2 w-5/6 flex flex-col">
                            <label for="phoneNumber" class="block mb-2 text-sm font-medium text-gray-900 :text-white">Phone number</label>
                            <input name="phoneNumber" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 :bg-gray-700 :border-gray-600 :placeholder-gray-400 :text-white :focus:ring-blue-500 :focus:border-blue-500" type="tel" value="{{ old('phoneNumber') }}"
                                id="phoneNumber">
                            @error('phoneNumber')
                                <div id="phoneNumberError" class="text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-2 w-5/6 flex flex-col">
                            <label for="hobbies" class="block mb-2 text-sm font-medium text-gray-900 :text-white">Hobbies (one per line)</label>
                            <textarea id="hobbies" name="hobbies" class="form-control" rows="1"></textarea>
                            @error('hobbies')
                                <div id="hobbiesError" class="text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-2 w-5/6 flex flex-col">
                            <label for="usernameInstagram" class="block mb-2 text-sm font-medium text-gray-900 :text-white">Username Instagram</label>
                            <input name="usernameInstagram" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 :bg-gray-700 :border-gray-600 :placeholder-gray-400 :text-white :focus:ring-blue-500 :focus:border-blue-500" type="text" value="{{ old('usernameInstagram') }}"
                                id="usernameInstagram">
                            @error('usernameInstagram')
                                <div id="usernameInstagramError" class="text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-2 w-5/6 flex flex-col">
                            <label for="image" class="block mb-2 text-sm font-medium text-gray-900 :text-white">Image</label>
                            <input name="image" type="file" id="image"
                                accept="image/png, image/gif, image/jpeg">
                            @error('image')
                                <div id="imageError" class="text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-2 w-5/6 flex flex-col">
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 :text-white">Password</label>
                            <input name="password" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 :bg-gray-700 :border-gray-600 :placeholder-gray-400 :text-white :focus:ring-blue-500 :focus:border-blue-500" type="password" id="password">
                            @error('password')
                                <div id="passwordError" class="text-red-600">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="w-1/2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
                            Submit
                        </button>
                    </form>
                </div>
            </div>
        </div>
    {{-- <div class="w-1/2 flex flex-col h-screen justify-center">
        <h1>ConnectFriend</h1>
        <div class="flex flex-col align-center gap-1">
            <h2 class="fw-bold">Login</h2>

        </div>
            <p>Copyright @ studio 2022</p>
        </div>
    </div> --}}


</div>
@endsection
