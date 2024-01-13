
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- AlpineJS CDN -->
    <script
      defer
      src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <link
      rel="preconnect"
      href="https://fonts.googleapis.com" />
    <link
      rel="preconnect"
      href="https://fonts.gstatic.com"
      crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap"
      rel="stylesheet" />
      <!-- Include jQuery from a CDN -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!-- Alphine Js -->
    <script defer src="https://unpkg.com/alpinejs@latest/dist/cdn.min.js"></script>



    <style>
      * {
        font-family: 'Inter', sans-serif;
      }
    </style>
  </head>
  <body class="bg-gray-100">
    <header class="sticky top-0">
      <!-- Navigation -->
      <nav
        x-data="{ mobileMenuOpen: false, userMenuOpen: false }"
        class="bg-white shadow border-t-2">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
          <div class="flex h-16 justify-between">
            <div class="flex">
              <div class="flex flex-shrink-0 items-center">
                <a href="/">
                  {{-- <h2 class="font-bold text-2xl">Barta</h2> --}}
                  <img class="w-20 h-10" src="/img/logo.PNG" alt="Barta">
                </a>
              </div>
            </div>

                {{ Form::open([
                    'id' => 'searchForm',
                    'methode' => 'get',
                    'url' => '/search',
                    'enctype' => 'multipart/form-data',
                ])}}
                <input
                        onkeyup="getText()"
                        id="searchText"
                        type="text"
                        name="searchText"
                        placeholder="Search..."
                        class="border-2 border-gray-300 bg-white h-10 px-5 pr-10 mt-3 rounded-full text-sm focus:outline-none"
                />
              {{  Form::close() }}

              <script>
                function getText(){
                    const text = document.getElementById('searchText').value;
                    let url = '/search/' + text;

                    const form = document.getElementById('searchForm');
                    form.setAttribute('action', url);
                }
              </script>

            <div class="hidden sm:ml-6 sm:flex gap-2 sm:items-center">
              <!-- This Button Should Be Hidden on Mobile Devices -->

              {{-- Notification --}}
              <div x-data="{ showDropdown: false }" class="space-y-2">
                <button @click="showDropdown = !showDropdown" class="underline relative">
                  <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 21">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 3.464V1.1m0 2.365a5.338 5.338 0 0 1 5.133 5.368v1.8c0 2.386 1.867 2.982 1.867 4.175C15 15.4 15 16 14.462 16H1.538C1 16 1 15.4 1 14.807c0-1.193 1.867-1.789 1.867-4.175v-1.8A5.338 5.338 0 0 1 8 3.464ZM4.54 16a3.48 3.48 0 0 0 6.92 0H4.54Z"></path>
                </svg>
                </button>
              
                <div x-cloak x-show="showDropdown" class="p-4 bg-gray-300 absolute shadow-md" style="margin-top: 24px; margin-left:-100px;">
                  <p class="underline font-bold text-xl pb-4 border-b-2 border-black text-center">Notifications</p>
                   {{-- @if(Auth()->user()->notifications) 

                     @foreach (Auth()->user()->notifications as $notification )
                      <div class="py-4 border-b-2 border-black">
                        <a href="#" class=" py-3 px-2 text-sm"><b class=" text-sm">{{ $notification->data['name']}} :</b> Comment on your post!</a><br>
                      </div>
                     @endforeach
                   @endif --}}
                   
                  @if(session()->get('noti'))
                    @foreach(session('noti') as $not)
                        <div class="py-4 border-b-2 border-black">
                            <a href="#" class=" py-3 px-2 text-sm"><b class=" text-sm">{{ $not['author']->name }} : </b> Comment on your post</a><br>
                        </div>
                    @endforeach
                @endif

                  {{-- @if (session('notifications'))
                      @foreach (session('notifications') as $notification)
                          <div class="py-4">
                              <a href="#" class="border-b-2 border-black py-3 px-2">{{ $notification['data']}}</a><br>
                          </div>
                      @endforeach
                  @endif --}}

                  {{-- <div class="py-4">
                     <a href="#" class=" border-b-2 border-black py-3 px-2">This is comment notification</a><br>
                  </div>
                  <div class="py-4">
                    <a href="#" class=" border-b-2 border-black py-3 px-2">{{ session('notifications.data') }}</a><br>
                 </div> --}}
                  
                </div>
              </div>


              <!-- Profile dropdown -->
              <div
                class="relative ml-3"
                x-data="{ open: false }">
                <div>
                  <button
                    @click="open = !open"
                    type="button"
                    class="flex rounded-full bg-white text-sm focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2"
                    id="user-menu-button"
                    aria-expanded="false"
                    aria-haspopup="true">
                    <span class="sr-only">Open user menu</span>
                    @if (Auth::user()->getFirstMediaUrl('profile_image') == null)
                    <div class="flex-shrink-0">
                        <img class="w-10 h-10 rounded-full border-2 border-gray-800" src="/img/avatar_male.jpg"
                            alt="">
                    </div>
                    @else
                        <div class="flex-shrink-0">
                            <div class="flex items-center justify-center">
                                <img class="w-10 h-10 rounded-full border-2 border-gray-800"
                                    src="{{ Auth::user()->getFirstMediaUrl('profile_image') }}" alt="">
                            </div>
                        </div>
                @endif
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
                    href="/{{Auth::user()->username}}/profile"
                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                    role="menuitem"
                    tabindex="-1"
                    id="user-menu-item-0"
                    >Your Profile</a
                  >

                  {{ Form::open(['url' => '/logout', 'method' => 'POST', 'enctype' =>'multipart/form-data']) }}
                  <button
                  type="submit"
                  class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 w-full text-left"
                  tabindex="-1"
                  role="menuitem"
                  id="user-menu-item-2"
                  >
                      Logout
                  </button>
                {{ Form::close() }}
                </div>
              </div>
            </div>
            <div class="-mr-2 flex items-center sm:hidden">
              <!-- Mobile menu button -->
              <button
                @click="mobileMenuOpen = !mobileMenuOpen"
                type="button"
                class="inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-100 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-gray-500"
                aria-controls="mobile-menu"
                aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <!-- Icon when menu is closed -->
                <svg
                  x-show="!mobileMenuOpen"
                  class="block h-6 w-6"
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke-width="1.5"
                  stroke="currentColor"
                  aria-hidden="true">
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>

                <!-- Icon when menu is open -->
                <svg
                  x-show="mobileMenuOpen"
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke-width="1.5"
                  stroke="currentColor"
                  class="w-6 h-6">
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M6 18L18 6M6 6l12 12" />
                </svg>
              </button>
            </div>
          </div>
        </div>

        <!-- Mobile menu, show/hide based on menu state. -->
<!--        <div-->
<!--          x-show="mobileMenuOpen"-->
<!--          class="sm:hidden"-->
<!--          id="mobile-menu">-->
<!--          <div class="space-y-1 pt-2 pb-3">-->
<!--            &lt;!&ndash; Current: "bg-gray-50 border-gray-800 text-gray-700", Default: "border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700" &ndash;&gt;-->
<!--            <a-->
<!--              href="#"-->
<!--              class="block border-l-4 border-gray-800 bg-gray-50 py-2 pl-3 pr-4 text-base font-medium text-gray-700"-->
<!--              >Discover</a-->
<!--            >-->
<!--            <a-->
<!--              href="#"-->
<!--              class="block border-l-4 border-transparent py-2 pl-3 pr-4 text-base font-medium text-gray-500 hover:border-gray-300 hover:bg-gray-50 hover:text-gray-700"-->
<!--              >For You</a-->
<!--            >-->
<!--            <a-->
<!--              href="#"-->
<!--              class="block border-l-4 border-transparent py-2 pl-3 pr-4 text-base font-medium text-gray-500 hover:border-gray-300 hover:bg-gray-50 hover:text-gray-700"-->
<!--              >People</a-->
<!--            >-->
<!--          </div>-->
<!--          <div class="border-t border-gray-200 pt-4 pb-3">-->
<!--            <div class="flex items-center px-4">-->
<!--              <div class="flex-shrink-0">-->
<!--                <img-->
<!--                  class="h-10 w-10 rounded-full"-->
<!--                  src="https://avatars.githubusercontent.com/u/831997"-->
<!--                  alt="Ahmed Shamim Hasan Shaon" />-->
<!--              </div>-->
<!--              <div class="ml-3">-->
<!--                <div class="text-base font-medium text-gray-800">-->
<!--                  Ahmed Shamim Hasan Shaon-->
<!--                </div>-->
<!--                <div class="text-sm font-medium text-gray-500">-->
<!--                  shaon@shamim.com-->
<!--                </div>-->
<!--              </div>-->
<!--            </div>-->
<!--            <div class="mt-3 space-y-1">-->
<!--              <a-->
<!--                href="#"-->
<!--                class="block px-4 py-2 text-base font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-800"-->
<!--                >Create New Post</a-->
<!--              >-->
<!--              <a-->
<!--                href="./profile.html"-->
<!--                class="block px-4 py-2 text-base font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-800"-->
<!--                >Your Profile</a-->
<!--              >-->
<!--              <a-->
<!--                href="./edit-profile.html"-->
<!--                class="block px-4 py-2 text-base font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-800"-->
<!--                >Edit Profile</a-->
<!--              >-->
<!--              <a-->
<!--                href="#"-->
<!--                class="block px-4 py-2 text-base font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-800"-->
<!--                >Sign out</a-->
<!--              >-->
<!--            </div>-->
<!--          </div>-->
<!--        </div>-->
      </nav>
</header>
