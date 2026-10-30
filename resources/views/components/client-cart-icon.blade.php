@php
    $cartCount = count(session('cart', []));
@endphp

<a href="{{ route('client.cart.index') }}" class="inline-flex items-center gap-2.5 p-2.5 text-slate-700 hover:text-emerald-600 dark:text-slate-200 dark:hover:text-emerald-400 transition rounded-xl hover:bg-gray-100 dark:hover:bg-gray-700 group">
    
    <!-- Contenedor exclusivo para el icono y su badge -->
    <div class="relative flex items-center justify-center">
        <!-- 🛒 Cesta de 34x34 -->
        <svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-amber-800 dark:text-amber-400 transition group-hover:scale-105">
            <path d="M4 10C4 6 7 4 9 4h6c2 0 5 2 5 6" />
            <path d="M3.5 10h17l-1.3 8.5a2 2 0 0 1-2 1.5H6.8a2 2 0 0 1-2-1.5L3.5 10z" fill="currentColor" fill-opacity="0.15" />
            <path d="M4 13h16M4.5 16h15" stroke-width="1.5" />
            <path d="M8 10v9M12 10v9M16 10v9" stroke-width="1.5" />
        </svg>

        @if ($cartCount > 0)
            <!-- 🟢 Círculo verde bien posicionado en la esquina inferior derecha del icono -->
            <span class="absolute -bottom-1 -right-2 bg-emerald-600 dark:bg-emerald-500 text-white text-[10px] font-extrabold w-4 h-4 flex items-center justify-center rounded-full border-2 border-white dark:border-gray-800 shadow-sm animate-pulse">
                {{ $cartCount }}
            </span>
        @endif
    </div>

    <!-- Texto de la Cesta al lado -->
    <span class="text-base font-bold hidden md:inline">Cesta</span>
</a>
