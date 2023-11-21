@extends('/layouts/master')
@section('content')




        <main class="container max-w-2xl mx-auto space-y-8 mt-8 px-2 min-h-screen">
            <!-- Cover Container -->
            <section
                class="bg-white border-2 p-8 border-gray-800 rounded-xl min-h-[350px] space-y-8 flex items-center flex-col justify-center">
                <!-- Profile Info -->
                <div
                class="flex gap-4 justify-center flex-col text-center items-center">
                <!-- User Meta -->
                {{-- @foreach ($posts as $post ) --}}
                    <div>
                        <h1 class="font-bold md:text-2xl">{{ $user->name }}</h1>
                        <p class="text-gray-700">Less Talk, More Code 💻</p>
                    </div>

                {{-- @endforeach --}}
                <!-- / User Meta -->
                </div>
                <!-- /Profile Info -->

                <!-- Profile Stats -->
                <div
                class="flex flex-row gap-16 justify-center text-center items-center">
                <!-- Total Posts Count -->
                <div class="flex flex-col justify-center items-center">
                    <h4 class="sm:text-xl font-bold">3</h4>
                    <p class="text-gray-600">Posts</p>
                </div>

                <!-- Total Comments Count -->
                <div class="flex flex-col justify-center items-center">
                    <h4 class="sm:text-xl font-bold">14</h4>
                    <p class="text-gray-600">Comments</p>
                </div>
                </div>
                <!-- /Profile Stats -->

                <!-- Edit Profile Button (Only visible to the profile owner) -->
                @if ($user->id == Auth::user()->id)
                    <a
                    href="/{{$user->username}}/edit"
                    type="button"
                    class="-m-2 flex gap-2 items-center rounded-full px-4 py-2 font-semibold bg-gray-100 hover:bg-gray-200 text-gray-700">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="w-5 h-5">
                        <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                    </svg>

                    Edit Profile
                    </a>
                @endif
                <!-- /Edit Profile Button -->
            </section>
            <!-- /Cover Container -->

        <!-- Barta Create Post Card -->


        @if ($user->id == Auth::user()->id)
            {{ Form::open([
                'class' => 'bg-white border-2 border-black rounded-lg shadow mx-auto max-w-none px-4 py-5 sm:px-6 space-y-3',
                'url' => '/create',
                'method' => 'post',
                'enctype' => 'multipart/form-data',
            ])}}
                    <!-- Create Post Card Top -->
                    <div>
                    <div class="flex items-start /space-x-3/">
                        <!-- Content -->
                        <div class="text-gray-700 font-normal w-full">
                        <textarea
                            class="block w-full p-2 text-gray-900 rounded-lg border-none outline-none focus:ring-0 focus:ring-offset-0"
                            name="barta"
                            rows="2"
                            placeholder="What's going on, Shamim?"></textarea>
                        </div>
                    </div>
                    </div>

                    <!-- Create Post Card Bottom -->
                    <div>
                    <!-- Card Bottom Action Buttons -->
                    <div class="flex items-center justify-end">
                        <div>
                        <!-- Post Button -->
                        <button
                            type="submit"
                            class="-m-2 flex gap-2 text-xs items-center rounded-full px-4 py-2 font-semibold bg-gray-800 hover:bg-black text-white">
                            Post
                        </button>
                        <!-- /Post Button -->
                        </div>
                    </div>
                    <!-- /Card Bottom Action Buttons -->
                    </div>
                    <!-- /Create Post Card Bottom -->
                {{ Form::close() }}

        @endif

        <!-- /Barta Create Post Card -->

        <!-- User Specific Posts Feed -->
        <!-- Barta Card -->
        @foreach ($posts as $post)
            <article
            class="bg-white border-2 border-black rounded-lg shadow mx-auto max-w-none px-4 py-5 sm:px-6">
            <!-- Barta Card Top -->
            <header>
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                <!-- User Avatar -->
                <!--                <div class="flex-shrink-0">-->
                <!--                  <img-->
                <!--                    class="h-10 w-10 rounded-full object-cover"-->
                <!--                    src="https://avatars.githubusercontent.com/u/831997"-->
                <!--                    alt="Tony Stark" />-->
                <!--                </div>-->
                <!-- /User Avatar -->

                <!-- User Info -->
                <div class="text-gray-900 flex flex-col min-w-0 flex-1">
                    <a
                    href="/{{ $post->author_username }}/posts"
                    class="hover:underline font-semibold line-clamp-1">
                    {{ $post->author_name}}
                    </a>

                    <a
                    href="profile.html"
                    class="hover:underline text-sm text-gray-500 line-clamp-1">
                    {{ $post->author_username }}
                    </a>
                </div>
                <!-- /User Info -->
                </div>

                <!-- Card Action Dropdown -->
                @if ($post->user_id == Auth::user()->id)
                    <div class="flex flex-shrink-0 self-center" x-data="{ open: false }">
                        <div class="relative inline-block text-left">
                            <div>
                            <button
                                @click="open = !open"
                                type="button"
                                class="-m-2 flex items-center rounded-full p-2 text-gray-400 hover:text-gray-600"
                                id="menu-0-button">
                                <span class="sr-only">Open options</span>
                                <svg
                                class="h-5 w-5"
                                viewBox="0 0 20 20"
                                fill="currentColor"
                                aria-hidden="true">
                                <path
                                    d="M10 3a1.5 1.5 0 110 3 1.5 1.5 0 010-3zM10 8.5a1.5 1.5 0 110 3 1.5 1.5 0 010-3zM11.5 15.5a1.5 1.5 0 10-3 0 1.5 1.5 0 003 0z"></path>
                                </svg>
                            </button>
                            </div>
                            <!-- Dropdown menu -->
                            <div
                            x-show="open"
                            @click.away="open = false"
                            class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                            role="menu"
                            aria-orientation="vertical"
                            aria-labelledby="user-menu-button"
                            tabindex="-1">
                            <a
                                href="/edit/{{ $post->uuid }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                role="menuitem"
                                tabindex="-1"
                                id="user-menu-item-0"
                                >Edit</a
                            >
                            {{ Form::open([
                                'url' => '/post/destroy/'.$post->uuid,
                                'method' => 'post',
                                'enctype' => 'multipart/form',
                            ])}}
                                <button type="submit" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 w-full text-left" id="user-menu-item-1" tabindex="-1" role="menuitem">Delete</button>
                            {{ Form::close() }}
                            </div>
                        </div>
                        </div>
                    <!-- /Card Action Dropdown -->
                </div>
            @endif
            </header>

            <!-- Content -->
            <a href="./single.html">
            <div class="py-4 text-gray-700 font-normal">
                <p>

                <br />
                {{ $post->post }}
                <br />
                <br />
                </p>
            </div>
            </a>

            <!-- Date Created & View Stat -->
            <div class="flex items-center gap-2 text-gray-500 text-xs my-2">
            <a href="">{{ date('d M Y • h:i a', strtotime($post->created_at))}}</a>
            <span class="">•</span>
            <span>4,450 views</span>
            </div>

            <!-- Barta Card Bottom -->
            <footer class="border-t border-gray-200 pt-2">
            <!-- Card Bottom Action Buttons -->
            <div class="flex items-center justify-between">
                <div class="flex gap-8 text-gray-600">
                <!-- Comment Button -->
                <button
                    type="button"
                    class="-m-2 flex gap-2 text-xs items-center rounded-full p-2 text-gray-600 hover:text-gray-800">
                    <span class="sr-only">Comment</span>
                    <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="2"
                    stroke="currentColor"
                    class="w-5 h-5">
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 01-.923 1.785A5.969 5.969 0 006 21c1.282 0 2.47-.402 3.445-1.087.81.22 1.668.337 2.555.337z" />
                    </svg>

                    <p>{{ $post->comments_count }}</p>
                </button>
                <!-- /Comment Button -->
                </div>
            </div>
            <!-- /Card Bottom Action Buttons -->
            </footer>
            <!-- /Barta Card Bottom -->
        </article>
        @endforeach


        <!-- /Barta Card -->
        <!-- User Specific Posts Feed -->
        </main>

@endsection
