<!-- resources/views/cameras/create.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center" x-data="{ isLoading: false, fetchUpdates: fetchUpdates }">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Cadastrar nova Camera') }}
            </h2>
        </div>
    </x-slot>
    <div class="py-12" x-data="">
    
        <div id="photoGrid" class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-2">
                    
                        <div @click="">
                            <img src="" alt="" class="w-full h-auto cursor-pointer transition ease-in-out duration-300">
                        </div>
                    
                </div>
            </div>
            <div class="mt-4">
            </div>
        </div>

    </x-app-layout>