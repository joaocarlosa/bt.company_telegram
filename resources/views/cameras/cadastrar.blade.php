<!-- resources/views/cameras/create.blade.php -->

<x-app-layout>
    <x-slot name="header">

        <script>
            function modal() {
                return {
                    open: false
                }
            }
        </script>

        <div class="flex justify-between items-center" x-data="{ modalOpen: false }">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Exibir Cameras') }}
            </h2>

        </div>
    </x-slot>
    <div class="container mx-auto mt-10">
        <!-- Formulário para adicionar nova câmera -->
        <div class="mb-8">
            <h3 class="text-2xl mb-4">Adicionar Nova Câmera</h3>
            <form action="{{ route('cameras.store') }}" method="POST" class="bg-white p-8 rounded">
                @csrf
                <!-- Campo para o Link RTSP -->
                <div class="mb-4">
                    <label for="rtsp_link" class="block text-sm font-medium text-gray-600">Link RTSP</label>
                    <input type="text" name="rtsp_link" id="rtsp_link" required class="mt-1 p-2 w-full rounded-md border">
                </div>

                <!-- Campo para o Nome da Área -->
                <div class="mb-4">
                    <label for="area_name" class="block text-sm font-medium text-gray-600">Nome da Área</label>
                    <input type="text" name="area_name" id="area_name" required class="mt-1 p-2 w-full rounded-md border">
                </div>

                <!-- Campo para o Nome da Câmera -->
                <div class="mb-4">
                    <label for="camera_name" class="block text-sm font-medium text-gray-600">Nome da Câmera</label>
                    <input type="text" name="camera_name" id="camera_name" required class="mt-1 p-2 w-full rounded-md border">
                </div>

                <!-- Botão para enviar o formulário -->
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Adicionar Câmera
                </button>
            </form>
        </div>

        <!-- Lista de câmeras -->
        <div>
            <h3 class="text-2xl mb-4 ">Lista de Câmeras</h3>
            <table class="min-w-full bg-white dark:bg-gray-800">
                <thead class="bg-gray-800 dark:bg-gray-600 text-white">
                    <tr>
                        <th class="text-left py-3 px-4">Índice</th>
                        <th class="text-left py-3 px-4">Nome da Câmera</th>
                        <th class="text-left py-3 px-4">Nome da Área</th>
                        <th class="text-left py-3 px-4">Link RTSP</th>
                        <th class="text-left py-3 px-4">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cameras as $index => $camera)
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="py-3 px-4">{{ $index + 1 }}</td>
                        <td class="py-3 px-4">{{ $camera->camera_name }}</td>
                        <td class="py-3 px-4">{{ $camera->area_name }}</td>
                        <td class="py-3 px-4">{{ $camera->rtsp_link }}</td>
                        <td class="py-3 px-4">
                            <form action="{{ route('cameras.destroy', $camera->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                    Apagar
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
        </div>
    </div>


</x-app-layout>