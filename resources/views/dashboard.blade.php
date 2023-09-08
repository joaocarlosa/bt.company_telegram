<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12" x-data="{ modalOpen: false, imgSrc: '' }">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach($photos as $photo)
                    <div @click="modalOpen = true; imgSrc = '{{ Storage::url($photo->file_path) }}'">
                        <img src="{{ Storage::url($photo->file_path) }}" alt="{{ $photo->file_unique_id }}" class="w-full h-auto cursor-pointer transition ease-in-out duration-300">
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div x-show="modalOpen" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50" @click.away="modalOpen = false">
        <div class="bg-white p-4 rounded flex items-center justify-center relative overflow-auto" style="width: 60%; height: 80%;">
            <button @click="modalOpen = false" class="absolute top-0 right-0 mt-4 mr-4 text-white bg-red-500 rounded-full p-2 cursor-pointer">X</button>
            <img :src="imgSrc" alt="" class="max-w-full max-h-full object-contain">
        </div>
    </div>
</div>

</x-app-layout>
