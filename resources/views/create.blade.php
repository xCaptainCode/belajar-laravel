<x-layout>
  {{-- {{ dd($categories) }} --}}
  <x-slot:title>{{ $title }}</x-slot:>

    <section class="dark:bg-gray-900">
      <div class="py-2 px-4 mx-auto max-w-4xl">
        <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Buat artikel baru</h2>
        <form action="{{ route('posts.store') }}" method="POST">
          @csrf
          <div class="grid gap-1 sm:grid-cols-2 sm:gap-6">
            <div class="sm:col-span-2">
              <label for="title" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Judul
                Artikel</label>
              <input type="text" name="title" id="title"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                placeholder="Tulis Judul artikel" required="">
            </div>

            <div>
              <label for="category_id"
                class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Category</label>
              <select id="category_id" name="category_id"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                <option value="">Pilih Kategori</option>
                @foreach ($categories as $category)
                  <option value="{{ $category->id }}">{{ $category->category }}</option>
                @endforeach
              </select>
            </div>

            <div class="sm:col-span-2">
              <!-- Editor Quill -->
              <div class="mb-3">
                <label class="block mb-1 font-medium">Isi Artikel</label>
                <div id="quill-editor" class="h-64 bg-white border"></div>
                <input type="hidden" name="content" id="content">
              </div>
            </div>
          </div>
          <button type="submit"
            class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
            Simpan Artikel
          </button>
        </form>
      </div>
    </section>


    <!-- Init Quill -->
    <script>
      document.addEventListener("DOMContentLoaded", function() {
        initQuill('#quill-editor', 'content');
      });
    </script>
</x-layout>
