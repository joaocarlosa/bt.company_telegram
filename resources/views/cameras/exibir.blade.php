<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center" x-data="{ isLoading: false, fetchUpdates: fetchUpdates }">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Cameras') }}
            </h2>
        </div>
    </x-slot>
    <div class="py-12" x-data="">
        <div class="py-2 dark:bg-gray-800">
            <div id="cameraGrid" class="max-w-full mx-auto sm:px-6 lg:px-8">
                <div class="bg-transparent dark:bg-transparent overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-2">
                        @foreach($cameras as $camera)
                        <!-- Div de câmera responsiva -->
                        <div class="p-2 bg-white border rounded shadow-md w-full h-full h-[600px] m-2 flex flex-col justify-center items-center">
                            <h2 class="text-center font-bold">{{ $camera->camera_name }}</h2>
                            <p class="text-center">{{ $camera->area_name }}</p>
                            <!-- Vídeo responsivo -->
                            <video id="video_{{ $camera->id }}" class="video-js w-full h-auto" height="600" controls preload="auto" data-setup="{}">
                                <source src="{{ $camera->rtsp_link }}" type="application/x-mpegURL">
                            </video>
                            <script>
                                var player = videojs('video_{{ $camera->id }}');
                                player.play();
                            </script>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
