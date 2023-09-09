<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center" x-data="{ isLoading: false, fetchUpdates: fetchUpdates }">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Dashboard') }}
            </h2>
            <button @click="fetchUpdates" :disabled="isLoading" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                <span x-show="!isLoading">Forçar Sincronização</span>
                <span x-show="isLoading">Loading...</span>
            </button>
        </div>
    </x-slot>

    <script>
        function fetchUpdates() {
            this.isLoading = true;

            fetch('/telegram/getupdates')
                .then(response => response.json())
                .then(data => {
                    this.isLoading = false;
                    if (data.status === 'success') {
                        location.reload(); // Recarrega a página inteira
                    }
                })
                .catch(error => {
                    console.error('Error fetching updates:', error);
                    this.isLoading = false;
                });
        }
    </script>

    <!-- O resto do seu código HTML e Blade permanece o mesmo -->




    <div class="py-12" x-data="{ modalOpen: false, imgSrc: '' }">

        <div id="photoGrid" class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-2">
                    @foreach($photos as $photo)
                    <div @click="modalOpen = true; imgSrc = '{{ Storage::url($photo->file_path) }}'">
                        <img src="{{ Storage::url($photo->file_path) }}" alt="{{ $photo->file_unique_id }}" class="w-full h-auto cursor-pointer transition ease-in-out duration-300">
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="mt-4">
                {{ $photos->links() }}
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