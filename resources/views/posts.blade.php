<x-layout>
  <x-slot:title>{{ $title }}</x-slot:>
    <div class="py-3 px-2 mx-auto max-w-screen-xl lg:px-3">
      <div class="mx-auto max-w-screen-md sm:text-center">
        <form>
          @if (request('category'))
            <input type="hidden" name="category" value="{{ request('category') }}">
          @endif
          @if (request('author'))
            <input type="hidden" name="author" value="{{ request('author') }}">
          @endif
          <div class="items-center mx-auto mb-3 space-y-4 max-w-screen-sm sm:flex sm:space-y-0">
            <div class="relative w-full">
              <label for="search" class="hidden mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Email
                address lorem</label>
              <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true"
                  xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                  <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                    d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z" />
                </svg>
              </div>
              <input
                class="block p-3 pl-10 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 sm:rounded-none sm:rounded-l-lg focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                placeholder="Search for article" type="search" id="search" name="search" required="">
            </div>
            <div>
              <button type="submit"
                class="py-3 px-5 w-full text-sm font-medium text-center text-white rounded-lg border cursor-pointer bg-primary-700 border-primary-600 sm:rounded-none sm:rounded-r-lg hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Search</button>
            </div>
          </div>
        </form>
      </div>
    </div>
    <section class=" dark:bg-gray-900">
      <div class="py-4 px-4 mx-auto max-w-screen-xl lg:py-5 lg:px-5">
        <div class="grid gap-4 lg:grid-cols-3 sm:grid-cols-2">
          @forelse ($posts as $post)
            <article
              class="p-6 bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
              <div class="flex justify-between items-center mb-5 text-gray-500">
                <a href="/posts?category={{ $post->category->slug }}">
                  <span
                    class="bg-{{ $post->category->color }}-100 text-primary-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded dark:bg-primary-200 dark:text-primary-800">
                    <svg class="mr-1 w-3 h-3" fill="currentColor" viewBox="0 0 20 20"
                      xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd"
                        d="M2 5a2 2 0 012-2h8a2 2 0 012 2v10a2 2 0 002 2H4a2 2 0 01-2-2V5zm3 1h6v4H5V6zm6 6H5v2h6v-2z"
                        clip-rule="evenodd"></path>
                      <path d="M15 7h1a2 2 0 012 2v5.5a1.5 1.5 0 01-3 0V7z"></path>
                    </svg>
                    {{ $post->category->category }}
                  </span>
                </a>
                <span class="text-sm">{{ $post->created_at->diffForHumans() }}</span>
              </div>
              <h2 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white hover:underline">
                <a href="/posts/{{ $post->slug }}">{{ $post->title }}</a>
              </h2>
              <p class="mb-5 font-light text-gray-500 dark:text-gray-400">
                {!! Str::limit($post['content'], 150) !!}
              </p>
              <div class="flex justify-between items-center">
                <a href="/posts?author={{ $post->author->name }}">
                  <div class="flex items-center space-x-2">
                    <img class="w-7 h-7 rounded-full" src="/img/logo.png" alt="{{ $post->author->name }}" />
                    <span class="font-medium text-sm dark:text-white">
                      {{ $post->author->name }}
                    </span>
                  </div>
                </a>
                <a href="/posts/{{ $post->slug }}"
                  class="text-xs inline-flex items-center text-medium text-primary-600 dark:text-primary-500 hover:underline">
                  Read more &raquo;
                </a>
              </div>
            </article>
          @empty
            <div class="text-center col-span-3 space-y-3">
              <p class="text-center text-2xl font-bold text-gray-900 dark:text-white">No post found!</p>
              <a href="/posts"
                class="text-sm font-medium text-primary-600 dark:text-primary-500 hover:underline">&laquo; Back to all
                posts</a>
            </div>
          @endforelse
        </div>
        <div class="pt-3">{{ $posts->links() }}</div>
      </div>
    </section>

    <a href="{{ route('posts.create') }}" id="floating-button" type="button"
      class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm p-3 text-center inline-flex items-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
      <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
        width="24" height="24" fill="none" viewBox="0 0 24 24">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M5 12h14m-7 7V5" />
      </svg>
      <span class="sr-only">Icon description</span>
    </a>

</x-layout>
