@extends('layouts.master')
@section('content')

    <main class="container max-w-xl mx-auto space-y-8 mt-8 px-2 md:px-0 min-h-screen">
        <!-- Profile Edit Form -->
        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-xl font-semibold leading-7 text-gray-900">
                    Edit Profile
                </h2>
                <p class="mt-1 text-sm leading-6 text-gray-600">
                    This information will be displayed publicly so be careful what you
                    share.
                </p>

                @if (session('success'))
                    <p class="w-lg bg-green-500 p-2 text-white text-center">
                        {{ session('success') }}
                    </p>
                @endif

                @if (session('error'))
                    <p class="w-lg bg-red-500 p-2 text-white text-center">
                        {{ session('error') }}
                    </p>
                @endif

                <div class="mt-10 border-b border-gray-900/10 pb-12">
                    <div class="col-span-full mt-10 pb-10">
                        <label for="photo" class="block text-sm font-medium leading-6 text-gray-900">Photo</label>

                        <div class="mt-2 flex items-center gap-x-3">
                            {{ Form::open([
                                'url' => '/profile/' . Auth::user()->username . '/image',
                                'method' => 'POST',
                                'enctype' => 'multipart/form-data',
                            ]) }}
                            <input class="hidden" type="file" name="avatar" id="avatar" />

                            @if (count($user->media) == 0)
                                <div class="flex-shrink-0">
                                    <img class="w-32 h-32 rounded-full border-2 border-gray-800" src="/img/avatar_male.jpg"
                                        alt="">
                                </div>
                            @else
                                <div class="flex-shrink-0">
                                    @foreach ($user->media as $media)
                                        <div class="flex items-center justify-center">
                                            <img class="w-32 h-32 rounded-full border-2 border-gray-800"
                                                src="/media/{{ $media->id }}/{{ $media->file_name }}" alt="">
                                        </div>
                                    @endforeach
                                </div>
                            @endif


                            {{-- @endif --}}
                            <div class="flex">
                                <label for="avatar">
                                    <div
                                        class="rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                                        Change
                                    </div>
                                </label>

                                <button type="submit"
                                    class="rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">Submit</button>

                            </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                    {{ Form::open([
                        'url' => '/' . Auth::user()->username . '/update/',
                        'method' => 'POST',
                        'enctype' => 'multipart/form-data',
                    ]) }}
                    <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-full">
                            <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Full
                                name</label>
                            <div class="mt-2">
                                <input type="text" name="name" id="name" autocomplete="given-name"
                                    value="{{ $user->name }}"
                                    class="block w-full rounded-md border-0 p-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-gray-600 sm:text-sm sm:leading-6" />
                            </div>
                        </div>

                        <div class="col-span-full">
                            <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email
                                address</label>
                            <div class="mt-2">
                                <input id="email" name="email" type="email" autocomplete="email"
                                    value="{{ $user->email }}"
                                    class="block w-full rounded-md border-0 p-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-gray-600 sm:text-sm sm:leading-6" />
                            </div>
                        </div>

                        <div class="col-span-full">
                            <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
                            <div class="mt-2">
                                <input type="password" name="password" id="password" autocomplete="password" value=""
                                    class="block w-full rounded-md border-0 p-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-gray-600 sm:text-sm sm:leading-6" />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="col-span-full">
                        <label for="bio" class="block text-sm font-medium leading-6 text-gray-900">Bio</label>
                        <div class="mt-2">
                            <textarea id="bio" name="bio" rows="3"
                                class="block w-full rounded-md border-0 p-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-gray-600 sm:text-sm sm:leading-6">
                         {{ $user->bio }}
                        </textarea>
                        </div>
                        <p class="mt-3 text-sm leading-6 text-gray-600">
                            Write a few sentences about yourself.
                        </p>
                    </div>
                </div>
            </div>
        </div>


        <div class="mt-6 flex items-center justify-end gap-x-6">
            <button type="button" class="text-sm font-semibold leading-6 text-gray-900">
                Cancel
            </button>
            <button type="submit"
                class="rounded-md bg-gray-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-gray-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-600">
                Save
            </button>
        </div>
        {{ Form::close() }}
        <!-- /Profile Edit Form -->
    </main>

@endsection
