@extends('layouts.master')
@section('content')

    <main
      class="container max-w-2xl mx-auto space-y-8 mt-8 px-2 md:px-0 min-h-screen">
      <!-- Newsfeed -->
      <section
        id="newsfeed"
        class="space-y-6">
        <!-- Barta Card -->
        <article
          class="bg-white border-2 border-black rounded-lg shadow mx-auto max-w-none px-4 py-5 sm:px-6">
          <!-- Barta Card Top -->

            <header>
                <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="flex-shrink-0">

                        @if (count($post->author->media) == 0 )
                        <div class="flex-shrink-0">
                            <img class="h-10 w-10 rounded-full object-cover border-gray-800" src="/img/avatar_male.jpg" alt="">
                        </div>
                        @else
                            <div class="flex-shrink-0">
                                @foreach($post->author->media as $media)
                                <div class="flex items-center justify-center">
                                    <img class="h-10 w-10 rounded-full object-cover" src="/media/{{ $media->id }}/{{ $media->file_name }}" alt="">
                                </div>
                                @endforeach
                            </div>
                        @endif


                        </div>

                    <!-- User Info -->
                    <div class="text-gray-900 flex flex-col min-w-0 flex-1">
                    <a
                        href="/{{ $post->author->username }}/profile"
                        class="hover:underline font-semibold line-clamp-1">
                        {{ $post->author->name }}
                    </a>

                    <a
                        href="/{{ $post->author->username }}/profile"
                        class="hover:underline text-sm text-gray-500 line-clamp-1">
                        {{ $post->author->email }}
                    </a>
                    </div>
                    <!-- /User Info -->
                </div>

                <!-- Card Action Dropdown -->
                <div
                    class="flex flex-shrink-0 self-center"
                    x-data="{ open: false }">
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
                        href="#"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                        role="menuitem"
                        tabindex="-1"
                        id="user-menu-item-0"
                        >Edit</a
                        >
                        <a
                        href="#"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                        role="menuitem"
                        tabindex="-1"
                        id="user-menu-item-1"
                        >Delete</a
                        >
                    </div>
                    </div>
                </div>
                <!-- /Card Action Dropdown -->
                </div>
            </header>

            <!-- Content -->
            <div class="py-4 text-gray-700 font-normal">
                @foreach($post->media as $media)
                <div class="flex items-center justify-center">
                    <img class="mt-4 rounded-lg w-full" src="/media/{{ $media->id }}/{{ $media->file_name }}" alt="">
                </div>
            @endforeach
                <p>
                    {{ $post->post }}
                <br />

                <br />
                <br />


                </p>
            </div>

            <!-- Date Created & View Stat -->
            <div class="flex items-center justify-between gap-2 text-gray-500 text-xs my-2">
                <span class="">{{ $post->created_at }}</span>
                <span class="">•</span>
                <span>{{ $post->comments_count }} comments</span>
                <span class="">•</span>
                <span>450 views</span>
            </div>


            <hr class="my-6" />

            <div>
                {{ Form::open([
                    'url' => '/post/like/'. $post->id,
                    'method' => 'POST',
                    'enctype' => 'multipart/form-data',
                ])}}

                <div class="flex">
                    <button type="submit" class="">
                        {!! App\Helpers\PostHelper::getLikeIcon($post->likes, $post->id, Auth::id()) !!}
                     </button>

                    <span class="">{{ $post->likes_count}}</span>
                </div>

                {{ Form::close() }}
            </div>

            <hr class="my-3" />

          <!-- Barta Create Comment Form -->
          {{ Form::open(['url' => '/post/comment/'.$post->id, 'method' => 'post', 'enctype' => 'multipart/form-data']) }}
            <div>
              <div class="flex items-start /space-x-3/">
                <div class="text-gray-700 font-normal w-full">
                  <textarea
                    name="comment"
                    placeholder="Write a comment..."
                    class="flex w-full h-auto min-h-[40px] px-3 py-2 text-sm bg-gray-100 focus:bg-white border border-sm rounded-lg border-neutral-300 ring-offset-background placeholder:text-neutral-400 focus:border-neutral-300 focus:outline-none focus:ring-1 focus:ring-offset-0 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50 text-gray-900"></textarea>
                </div>
              </div>
            </div>

            <!-- Create Comment Card Bottom -->
            <div>
              <!-- Card Bottom Action Buttons -->
              <div class="flex items-center justify-end">
                <button
                  type="submit"
                  class="mt-2 flex gap-2 text-xs items-center rounded-full px-4 py-2 font-semibold bg-gray-800 hover:bg-black text-white">
                  Comment
                </button>
              </div>
              <!-- /Card Bottom Action Buttons -->
            </div>
            <!-- /Create Comment Card Bottom -->
          {{ Form::close() }}
          <!-- /Barta Create Comment Form -->

          <!-- /Barta Card Bottom -->
        </article>
        <!-- /Barta Card -->

        <hr />
        <div class="flex flex-col space-y-6">
          <h1 class="text-lg font-semibold">Comments ({{ $post->comments_count }})</h1>

          <!-- Barta User Comments Container -->
          <article
            class="bg-white border-2 border-black rounded-lg shadow mx-auto max-w-none px-4 py-2 sm:px-6 min-w-full divide-y">
            <!-- Comments -->

            @foreach($post->comments as $comment)
            <div class="py-4">
              <!-- Barta User Comments Top -->
              <header>
                <div class="flex items-center justify-between">
                  <div class="flex items-center space-x-3">
                    <div class="flex-shrink-0">

                        @if (count($comment->author->media) == 0 )
                        <div class="flex-shrink-0">
                            <img class="h-10 w-10 rounded-full object-cover border-gray-800" src="/img/avatar_male.jpg" alt="">
                        </div>
                        @else
                            <div class="flex-shrink-0">
                                @foreach($comment->author->media as $media)
                                <div class="flex items-center justify-center">
                                    <img class="h-10 w-10 rounded-full object-cover" src="/media/{{ $media->id }}/{{ $media->file_name }}" alt="">
                                </div>
                                @endforeach
                            </div>
                        @endif

                        </div>
                    <!-- User Info -->
                    <div class="text-gray-900 flex flex-col min-w-0 flex-1">
                      <a
                        href="/{{ $comment->author->username }}/profile"
                        class="hover:underline font-semibold line-clamp-1">
                        {{ $comment->author->name }}
                      </a>

                      <a
                        href="/{{ $comment->author->username }}/profile"
                        class="hover:underline text-sm text-gray-500 line-clamp-1">
                        @ {{ $comment->author->username }}
                      </a>
                    </div>
                    <!-- /User Info -->
                  </div>
                </div>
              </header>

              <!-- Content -->
              <div class="py-4 text-gray-700 font-normal">
                <p>{{ $comment->comment }}</p>
              </div>

              <!-- Date Created -->
              <div class="flex items-center gap-2 text-gray-500 text-xs">
                <span class="">{{ $comment->created_at }}</span>
              </div>
            </div>
            @endforeach

            <!-- /Comments -->
          </article>
          <!-- /Barta User Comments -->
        </div>
      </section>
      <!-- /Newsfeed -->
    </main>

@endsection
