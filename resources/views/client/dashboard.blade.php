<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Panel de Cliente') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Tarjeta de bienvenida y acceso al catálogo -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border border-gray-200 dark:border-gray-700 p-6 mb-6">
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    ¡Bienvenido a tu panel, cliente!
                </h3>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    Desde aquí puedes explorar los productos disponibles de nuestros productores locales y realizar tus compras.
                </p>

                <!-- Botón de acceso al catálogo -->
                <div class="mt-6">
                    <a href="{{ route('client.products.index') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                        🛍️ Ver Catálogo de Productos
                    </a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>