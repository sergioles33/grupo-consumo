<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Catálogo de Productos') }}
            </h2>
            <div>
                <x-client-cart-icon />
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Barra de Búsqueda y Filtros -->
            <div
                class="mb-6 bg-white dark:bg-gray-800 p-4 shadow-sm sm:rounded-lg border border-gray-200 dark:border-gray-700">
                <form method="GET" action="{{ route('client.products.index') }}" class="flex flex-col sm:flex-row gap-3">

                    <!-- Campo de texto -->
                    <input type="text" name="search" value="{{ $search ?? '' }}"
                        placeholder="Buscar por nombre o descripción..."
                        class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm">

                    <div class="flex gap-2">
                        <!-- Botón Buscar -->
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500 focus:outline-none transition">
                            🔍 Buscar
                        </button>

                        <!-- Botón Ver Todos / Limpiar -->
                        <a href="{{ route('client.products.index') }}"
                            class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-500 focus:outline-none transition">
                            📋 Ver Todos
                        </a>
                    </div>

                </form>
            </div>


            <!-- Grid de Productos -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @forelse($products as $product)
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border border-gray-200 dark:border-gray-700 flex flex-col justify-between">

                        <!-- CONTENEDOR DE LA IMAGEN -->
                        <div>
                            <img src="{{ $product->image ? asset($product->image) : 'https://images.unsplash.com/photo-1540420773420-3366772f4999?auto=format&fit=crop&q=80&w=600' }}" 
                                 alt="{{ $product->name }}" 
                                 class="w-full h-48 object-cover">
                        </div>

                        <div class="p-4">
                            <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100">{{ $product->name }}</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1 line-clamp-2">
                                {{ $product->description }}</p>
                                

                            <!-- Stock y Tipo de Unidad -->
                            <div class="mt-2 text-xs text-gray-500 dark:text-gray-400">
                                Disponibles: {{ $product->stock }} ({{ $product->unit_type }})
                            </div>
                        </div>


                        <!-- Precio y Formulario de Añadir al Carrito -->
                        <div class="p-4 pt-0 flex items-center justify-between mt-4">
                            <span class="text-lg font-bold text-indigo-600 dark:text-indigo-400">
                                ${{ number_format($product->price, 2) }}
                            </span>

                            <!-- Formulario para añadir al carrito -->
                            <form action="{{ route('client.cart.add', $product->id) }}" method="POST"
                                class="flex items-center gap-2">
                                @csrf

                                <!-- Input para elegir cantidad / kilos -->
                                <input type="number" name="quantity" value="1" min="0.1" step="0.01"
                                    max="{{ $product->stock }}"
                                    class="w-16 rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 text-sm py-1 px-2">

                                <!-- Botón de Añadir -->
                                <button type="submit"
                                    class="inline-flex items-center px-3 py-1.5 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500 transition">
                                    Añadir
                                </button>
                            </form>
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