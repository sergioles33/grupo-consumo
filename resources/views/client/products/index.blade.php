<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Catálogo de Productos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Grid de Productos -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @forelse($products as $product)
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border border-gray-200 dark:border-gray-700 flex flex-col justify-between">
                        
                        <div class="p-4">
                            <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100">{{ $product->name }}</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1 line-clamp-2">{{ $product->description }}</p>
                            
                            <!-- Stock y Tipo de Unidad -->
                            <div class="mt-2 text-xs text-gray-500 dark:text-gray-400">
                                Disponibles: {{ $product->stock }} ({{ $product->unit_type }})
                            </div>
                        </div>

                        <!-- Precio y Botón de Añadir -->
                        <div class="p-4 pt-0 flex items-center justify-between mt-4">
                            <span class="text-lg font-bold text-indigo-600 dark:text-indigo-400">
                                ${{ number_format($product->price, 2) }}
                            </span>
                            
                            <!-- Botón provisional para el carrito -->
                            <button type="button" class="inline-flex items-center px-3 py-1.5 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                Añadir
                            </button>
                        </div>

                    </div>
                @empty
                    <div class="col-span-full text-center py-12 text-gray-500 dark:text-gray-400">
                        No hay productos disponibles en este momento.
                    </div>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>