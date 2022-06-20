<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Node Management') }}
        </h2>
</x-slot>
<div class="py-12">
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        {{--<div class="max-w-full bg-white overflow-hidden sm:rounded-lg">--}}
        <div class="py-6 max-w-xs">
            @if( session()->has('status') )
                <div class="bg-green-500 border-t-4 border-green-400 rounded-b text-white px-4 py-3 shadow-md" role="alert" id="alert">
                    <div class="flex">
                        <div class="py-1">
                            <svg class="fill-current h-6 w-6 text-white mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="font-bold">Acción realizada</p>
                            <p class="text-sm">{{ session('status') }}</p>
                        </div>
                    </div>
                </div>
                <script type="text/javascript">
                    let alert = document.getElementById('alert');
                        setTimeout(function(){
                            alert.classList.add('hidden');
                        },2000);
                </script>
            @endif
        </div>
            <div class="bg-white">
<!-- This example requires Tailwind CSS v2.0+ -->
                <div class="flex flex-col">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                <div class="py-3 px-3">
                                    <x-jet-label for="search" value="{{ __('Search') }}"/>
                                    <x-jet-input type="search" name="search" wire:model="search"/>
                                </div>
                                {{--<x-jet-section-border />--}}
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Observaciones</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                                        <th scope="col" class="relative px-6 py-3">
                                            <span class="sr-only">Edit</span>
                                        </th>
                                        <th scope="col" class="relative px-6 py-3">
                                            <span class="sr-only">Delete</span>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($nodos as $nodo)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10">
                                                    <img class="h-10 w-10 rounded-md" src="{{ url('/storage/node.png') }}" alt="">
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">{{ $nodo->nodename }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900"></div>
                                            <div class="text-sm text-gray-500">{{ $nodo->manifesto }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($nodo->active)
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800"> {{ __('Active') }} </span>
                                            @else
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-600"> No activo </span>
                                            @endif

                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <a class="text-red-600 hover:text-indigo-900" href="{{ route('nodes.edit', $nodo) }}">
                                                <button class="flex px-4 py-2 bg-blue-400 text-white cursor-pointer
                                                hover:bg-blue-700 focus:text-white focus:bg-blue-800 focus:outline-none
                                                focus:ring-blue-200 rounded-md" tabindex="1">
                                                    Editar
                                                </button>
                                            </a>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <form action="{{ route('nodes.destroy', $nodo) }}" method="POST">
                                                @csrf @method('DELETE')
                                                <button class="flex px-4 py-2 bg-red-400 text-white cursor-pointer
                                                hover:bg-red-600 focus:text-white focus:bg-red-700 focus:outline-none
                                                focus:ring-red-200 rounded-md" tabindex="1">
                                                        Eliminar
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                    <!-- More people... -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="py-2 px-2">
                    {{ $nodos->links() }}
                </div>

            </div>
        </div>
    {{--</div>--}}
</div>
