<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tu Carrito de Compras') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900 dark:text-gray-100">
                
                @if(session('cart') && count(session('cart')) > 0)
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-gray-200 dark:border-gray-700">
                                <th class="py-3 px-4">Producto</th>
                                <th class="py-3 px-4">Precio</th>
                                <th class="py-3 px-4">Cantidad</th>
                                <th class="py-3 px-4">Subtotal</th>
                                <th class="py-3 px-4 text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $total = 0; @endphp
                            @foreach(session('cart') as $id => $details)
                                @php 
                                    $subtotal = $details['price'] * $details['quantity'];
                                    $total += $subtotal;
                                @endphp
                                <tr class="border-b border-gray-100 dark:border-gray-700">
                                    <td class="py-3 px-4 font-semibold">{{ $details['name'] }}</td>
                                    <td class="py-3 px-4">${{ number_format($details['price'], 2) }}</td>
                                    <td class="py-3 px-4">
                                        {{ $details['quantity'] }} {{ $details['unit_type'] }}
                                    </td>
                                    <td class="py-3 px-4 font-bold text-indigo-600 dark:text-indigo-400">
                                        ${{ number_format($subtotal, 2) }}
                                    </td>
                                    //boton para eliminar
                                    <td class="py-3 px-4 text-center">
                                        <form action="{{ route('client.cart.remove', $id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900 dark:hover:text-red-300 text-sm font-semibold transition title:Eliminar producto">
                                               X Eliminar
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Total general -->
                    <div class="mt-6 flex justify-between items-center border-t border-gray-200 dark:border-gray-700 pt-4">
                        <span class="text-xl font-bold">Total a pagar:</span>
                        <span class="text-2xl font-bold text-indigo-600 dark:text-indigo-400">
                            ${{ number_format($total, 2) }}
                        </span>
                    </div>

                    <!-- Botones de acción -->
                    <div class="mt-6 flex justify-between">
                        <a href="{{ route('client.products.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded-md text-sm font-semibold hover:bg-gray-500 transition">
                            ← Seguir Comprando
                        </a>
                        <button type="button" class="px-4 py-2 bg-green-600 text-white rounded-md text-sm font-semibold hover:bg-green-500 transition">
                            Proceder al Pago
                        </button>
                    </div>

                @else
                    <div class="text-center py-12 text-gray-500 dark:text-gray-400">
                        <p class="text-lg mb-4">Tu carrito está vacío.</p>
                        <a href="{{ route('client.products.index') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500 transition">
                            Ir al Catálogo
                        </a>
                    </div>
                @endif

            </div>

        </div>
    </div>
</x-app-layout>