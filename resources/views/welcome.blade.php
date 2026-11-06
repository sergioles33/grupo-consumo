<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grupo de Consumo - De la huerta a tu mesa</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Alpine.js (Imprescindible para que funcione el carrusel) -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="bg-[#F9F6F0] text-gray-800 font-sans min-h-screen">

    {{-- 1. NAVEGACIÓN SUPERIOR (Proporción: 1/3 Naranja - 2/3 Verde) --}}
    <nav class="bg-[#1B3B2B] flex flex-col md:flex-row w-full shadow-md">

        {{-- Bloque Izquierdo (Naranja - Ocupa 1/3) --}}
        <div class="bg-[#FF6B35] text-white font-bold px-8 py-5 tracking-wide flex flex-col justify-center w-full md:w-1/3">
            <span class="text-xl text-green-900 font-thin">Grupo de Consumo</span>
            <span class="block text-xs font-normal opacity-90">De la huerta a tu mesa</span>
        </div>

        {{-- Bloque Central y Derecho (Verde Oscuro - Ocupa 2/3) --}}
        <div class="flex flex-col md:flex-row items-center justify-between flex-1 px-8 py-4 text-sm font-medium text-white w-full md:w-2/3 gap-4">

            {{-- Enlaces de navegación central --}}
            <div class="flex flex-wrap items-center justify-center md:justify-start gap-6">
                <a href="#" class="text-[#FF6B35] underline underline-offset-4 font-semibold">Inicio</a>
                <a href="#filosofia" class="hover:text-[#FF6B35] transition">Quiénes Somos</a>
                <a href="#catalogo" class="hover:text-[#FF6B35] transition">Cesta Semanal</a>
                <a href="#blog" class="hover:text-[#FF6B35] transition">Noticias</a>
                <a href="#contacto" class="hover:text-[#FF6B35] transition">Contacto</a>
            </div>

            {{-- Zona de Usuario / Acceso --}}
            <div class="flex items-center space-x-4">
                @auth
                    @php
                        $panelRoute = match (Auth::user()->role ?? 'client') {
                            'admin' => route('admin.dashboard'),
                            'producer' => route('producer.dashboard'),
                            default => route('client.dashboard'),
                        };
                    @endphp
                    <a href="{{ $panelRoute }}"
                        class="flex items-center gap-2 bg-[#FF6B35] hover:bg-[#e05a2b] px-4 py-2 rounded text-white font-semibold transition">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                clip-rule="evenodd"></path>
                        </svg>
                        Mi Panel
                    </a>
                @else
                    <a href="{{ route('login') }}"
                        class="flex items-center gap-2 hover:text-[#FF6B35] transition font-semibold">
                        <svg class="w-5 h-5 text-[#FF6B35]" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                clip-rule="evenodd"></path>
                        </svg>
                        Log In
                    </a>
                @endauth
            </div>

        </div>
    </nav>

    {{-- 2. CABECERA PRINCIPAL (CARRUSEL CON IMÁGENES LOCALES) --}}
    <section class="relative h-[550px] overflow-hidden bg-[#1B3B2B]" 
             x-data="{ 
                 activeSlide: 0, 
                 slides: [
                     {
                         image: '{{ asset('images/cajaVegetales.jpg') }}',
                         title: 'Reparto de Cestas<br>de Temporada',
                         subtitle: 'Alimentos frescos del campo directos a tu punto de recogida'
                     },
                     {
                         image: '{{ asset('images/huerta.png') }}',
                         title: 'Agricultura Ecológica<br>y de Proximidad',
                         subtitle: 'Apoyamos a los productores locales de nuestra comarca'
                     },
                     {
                         image: '{{ asset('images/cajaNaranjas.jpg') }}',
                         title: 'Sabor Auténtico<br>en Tu Mesa',
                         subtitle: 'Productos recolectados en su punto óptimo de maduración'
                     }
                 ],
                 init() {
                     setInterval(() => {
                         this.activeSlide = (this.activeSlide + 1) % this.slides.length;
                     }, 5000);
                 }
             }">

       {{-- Bucle de Diapositivas --}}
<template x-for="(slide, index) in slides" :key="index">
    <div x-show="activeSlide === index"
         x-transition.opacity.duration.700ms
         class="absolute inset-0 bg-cover bg-center bg-no-repeat flex items-center"
         :style="'background-image: url(' + slide.image + ')'">
        
        {{-- Capa oscura para legibilidad del texto --}}
        <div class="absolute inset-0 bg-black/50"></div>

        {{-- Contenido de texto --}}
        <div class="relative max-w-5xl mx-auto px-8 text-white space-y-4 z-10">
            <h1 class="text-5xl md:text-7xl font-extrabold tracking-tight leading-tight" x-html="slide.title">
            </h1>
            <p class="text-xl md:text-2xl font-light pt-2 text-stone-200" x-text="slide.subtitle">
            </p>
            <div class="pt-6">
                <a href="#catalogo" class="bg-white text-gray-900 hover:bg-gray-100 font-semibold px-8 py-3.5 shadow-md transition inline-block">
                    Ver Cesta de esta Semana
                </a>
            </div>
        </div>
    </div>
</template>

        {{-- Botones de Navegación (Anterior / Siguiente) --}}
        <button @click="activeSlide = (activeSlide - 1 + slides.length) % slides.length" 
                class="absolute left-4 top-1/2 -translate-y-1/2 z-20 bg-black/40 hover:bg-black/70 text-white p-3 rounded-full transition focus:outline-none cursor-pointer">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
        </button>
        <button @click="activeSlide = (activeSlide + 1) % slides.length" 
                class="absolute right-4 top-1/2 -translate-y-1/2 z-20 bg-black/40 hover:bg-black/70 text-white p-3 rounded-full transition focus:outline-none cursor-pointer">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        </button>

        {{-- Indicadores (Puntitos inferiores) --}}
        <div class="absolute bottom-6 left-1/2 -translate-x-1/2 z-20 flex space-x-2 bg-black/40 px-4 py-2 rounded-full backdrop-blur-sm">
            <template x-for="(slide, index) in slides" :key="index">
                <button @click="activeSlide = index" 
                        :class="{ 'bg-[#FF6B35] w-6': activeSlide === index, 'bg-white w-2.5': activeSlide !== index }"
                        class="h-2.5 rounded-full transition-all duration-300 focus:outline-none cursor-pointer"></button>
            </template>
        </div>

    </section>

    {{-- 3. SOBRE EL GRUPO Y FILOSOFÍA --}}
    <section class="bg-[#FFFDF9] py-16 px-8 border-b border-stone-200" id="filosofia">
        <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
            <div class="space-y-6">
                <h2 class="text-3xl font-bold text-[#1B3B2B] relative pb-3 after:content-[''] after:absolute after:bottom-0 after:left-0 after:w-16 after:h-1 after:bg-[#FF6B35]">
                    Apoya la Agricultura de Proximidad
                </h2>
                <p class="text-gray-600 leading-relaxed">
                    Somos una asociación autogestionada de consumo responsable. Conectamos a familias con pequeños agricultores y productores locales para acceder a alimentos ecológicos, de temporada y a precios justos sin intermediarios.
                </p>
                <a href="{{ route('register') }}" class="bg-[#FF6B35] hover:bg-[#e05a2b] text-white font-semibold px-6 py-3 inline-block transition">
                    Hacerte Socio/a
                </a>
            </div>
            <div class="flex justify-center">
                <img src="{{ asset('images/filosofia.png') }}" alt="Agricultura de proximidad" class="w-full max-w-md h-80 object-cover mix-blend-multiply opacity-95">
            </div>
        </div>
    </section>

    {{-- 4. CATÁLOGO / CESTA DE LA SEMANA --}}
    <section class="py-16 px-8 bg-[#EBE5DC]" id="catalogo">
        <div class="max-w-6xl mx-auto space-y-8">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-end">
                <div>
                    <h2 class="text-3xl font-bold text-[#1B3B2B] relative pb-3 after:content-[''] after:absolute after:bottom-0 after:left-0 after:w-16 after:h-1 after:bg-[#FF6B35]">
                        Productos y Cestas de la Semana
                    </h2>
                </div>
                <span class="text-sm text-stone-600 font-medium mt-2 md:mt-0 bg-white/60 px-3 py-1 rounded">
                    🕒 Plazo de pedidos: Hasta el martes a las 22:00h
                </span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-4 shadow-sm space-y-3">
                    <img src="https://images.unsplash.com/photo-1540420773420-3366772f4999?auto=format&fit=crop&q=80&w=600" alt="Cesta Básica" class="w-full h-64 object-cover">
                    <div class="flex justify-between items-center">
                        <h3 class="font-bold text-gray-900">Cesta Básica de Huerta</h3>
                        <p class="text-[#1B3B2B] font-bold">15,00 €</p>
                    </div>
                    <p class="text-xs text-stone-500">Ideal para 1-2 personas. Incluye verduras de temporada de la huerta local.</p>
                </div>
                <div class="bg-white p-4 shadow-sm space-y-3">
                    <img src="https://images.unsplash.com/photo-1550989460-0adf9ea622e2?auto=format&fit=crop&q=80&w=600" alt="Cesta Mixta" class="w-full h-64 object-cover">
                    <div class="flex justify-between items-center">
                        <h3 class="font-bold text-gray-900">Cesta Mixta (Fruta y Verdura)</h3>
                        <p class="text-[#1B3B2B] font-bold">25,00 €</p>
                    </div>
                    <p class="text-xs text-stone-500">Selección variada de hortalizas, verduras de hoja y frutas de la comarca.</p>
                </div>
                <div class="bg-white p-4 shadow-sm space-y-3">
                    <img src="https://images.unsplash.com/photo-1560806887-1e4cd0b6cbd6?auto=format&fit=crop&q=80&w=600" alt="Cesta Familiar" class="w-full h-64 object-cover">
                    <div class="flex justify-between items-center">
                        <h3 class="font-bold text-gray-900">Cesta Familiar Completa</h3>
                        <p class="text-[#1B3B2B] font-bold">45,00 €</p>
                    </div>
                    <p class="text-xs text-stone-500">Pensada para 4 personas. Incluye huevos camperos, frutas, verduras y hortalizas.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- 5. NOTICIAS Y BLOG DEL GRUPO --}}
    <section class="bg-[#EBE5DC] pt-4 pb-28 px-8" id="blog">
        <div class="max-w-6xl mx-auto space-y-8 border-t border-stone-300/60 pt-12">
            <h2 class="text-3xl font-bold text-[#1B3B2B] relative pb-3 after:content-[''] after:absolute after:bottom-0 after:left-0 after:w-16 after:h-1 after:bg-[#FF6B35]">
                Novedades y Recetas del Colectivo
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white p-4 space-y-2">
                    <img src="https://images.unsplash.com/photo-1523049673857-eb18f1d7b578?auto=format&fit=crop&q=80&w=500" class="w-full h-40 object-cover">
                    <h4 class="font-bold text-sm text-stone-900">Comienza la temporada de aguacates de Málaga</h4>
                    <p class="text-xs text-stone-500">Conoce al productor de nuestra red que cultiva en axarquía de forma sostenible.</p>
                </div>
                <div class="bg-white p-4 space-y-2">
                    <img src="https://images.unsplash.com/photo-1515586000433-45406d8e6662?auto=format&fit=crop&q=80&w=500" class="w-full h-40 object-cover">
                    <h4 class="font-bold text-sm text-stone-900">Consejos para conservar tus verduras de hoja</h4>
                    <p class="text-xs text-stone-500">Trucos sencillos para que tus lechugas y acelgas duren frescas toda la semana.</p>
                </div>
                <div class="bg-white p-4 space-y-2">
                    <img src="https://images.unsplash.com/photo-1547592166-23ac45744acd?auto=format&fit=crop&q=80&w=500" class="w-full h-40 object-cover">
                    <h4 class="font-bold text-sm text-stone-900">Receta: Crema de calabaza de la huerta</h4>
                    <p class="text-xs text-stone-500">Una opción reconfortante y fácil de preparar con los ingredientes de la cesta.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- 6. PIE DE PÁGINA CON TARJETA DE HORARIOS Y REPARTO SUPERPUESTA --}}
    <footer class="bg-[#1B3B2B] text-white relative pt-28 pb-12 px-8" id="contacto">
        <div class="max-w-4xl mx-auto bg-[#FFFDF9] text-gray-800 p-8 shadow-2xl rounded-sm absolute -top-20 left-1/2 transform -translate-x-1/2 w-11/12 grid grid-cols-1 md:grid-cols-3 gap-6 text-sm border-t-4 border-[#FF6B35]">
            <div>
                <p class="font-bold text-[#1B3B2B] mb-1">Punto de Recogida</p>
                <p class="text-gray-600">Local de la Asociación<br>Calle Mayor, 45, Madrid</p>
            </div>
            <div>
                <p class="font-bold text-[#1B3B2B] mb-1">Atención al Socio</p>
                <p class="text-gray-600">Lunes a Viernes: 9:00 - 14:00h<br>Sábados: 10:00 - 13:00h</p>
            </div>
            <div>
                <p class="font-bold text-[#1B3B2B] mb-1">Días de Reparto</p>
                <p class="text-gray-600">Jueves: 17:00 - 20:30h<br>Viernes: 10:00 - 13:30h</p>
            </div>
        </div>

        <div class="max-w-6xl mx-auto text-center pt-16 space-y-6">
            <h3 class="text-xl font-bold">Suscríbete al Boletín del Grupo de Consumo</h3>
            <p class="text-sm text-emerald-200 max-w-md mx-auto">Recibe avisos sobre la apertura de pedidos semanales y talleres comunitarios.</p>
            
            <form class="flex justify-center max-w-md mx-auto gap-2">
                <input type="email" placeholder="Tu correo electrónico *" class="px-4 py-2 text-gray-800 w-full rounded-none focus:outline-none">
                <button type="submit" class="bg-[#FF6B35] text-white px-6 py-2 font-bold hover:bg-[#e05a2b] transition">Unirme</button>
            </form>
            
            <div class="flex justify-center space-x-8 text-[#FF6B35] font-bold text-base pt-4">
                <a href="#" class="hover:underline">Facebook</a>
                <a href="#" class="hover:underline">Instagram</a>
                <a href="#" class="hover:underline">Canal de Telegram</a>
            </div>

            <p class="text-xs text-stone-400 pt-8">
                &copy; {{ date('Y') }} Grupo de Consumo Responsable. Todos los derechos reservados.
            </p>
        </div>
    </footer>

</body>

</html>