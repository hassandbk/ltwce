<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>LTWCE – Support Dashboard</title>
  <link rel="icon" href="/assets/images/logo.png" type="image/x-icon" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap"
    rel="stylesheet" />

  <!-- AOS animations -->
  <link rel="stylesheet" href="<?= base_url('assets/css/vendors/aos.css') ?>" />
  <!-- Tailwind utilities -->
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

  <!-- Custom overrides -->


  <link rel="stylesheet" href="<?= base_url('assets/css/styles.css') ?>" />
  <!-- Global Font Styles -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="…"
    crossorigin="anonymous" />

  <!-- Alpine.js -->
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="tracking-tight text-slate-800 antialiased font-inter bg-white" x-data="supportApp()" x-init="init()"
  x-cloak>
  <!-- Page wrapper -->
  <div class="overflow-hidden min-h-screen flex-col flex">
    <!-- Site header -->

    <header class="fixed w-full z-30 bg-slate-900 text-white" x-data="{ mobileOpen: false }">
      <div class="max-w-6xl mx-auto px-5 sm:px-6 flex items-center justify-between py-4">
        <!-- Left: Logo + Desktop Nav -->
        <div class="flex items-center space-x-8">
          <!-- Logo -->
          <a href="index.html" class="flex items-center space-x-3">
            <img src="<?= base_url('assets/images/logo.png'); ?>" alt="Logo" width="40" height="40" />
            <span class="font-playfair text-2xl">LTWCE SACCO</span>
          </a>
          <!-- Desktop nav -->
          <nav class="hidden md:flex items-center space-x-6">
            <a href="about.html" class="text-base font-medium hover:text-yellow-500">About</a>
            <a href="services.html" class="text-base font-medium hover:text-yellow-500">Services</a>
            <a href="blog.html" class="text-base font-medium hover:text-yellow-500">Blog</a>
            <a href="wall-of-love.html" class="text-base font-medium hover:text-yellow-500">Wall of Love</a>

            <!-- Resources dropdown -->
            <div x-data="{ open: false, timeout: null }" @mouseenter="clearTimeout(timeout); open = true"
              @mouseleave="timeout = setTimeout(() => open = false, 300)" class="relative">
              <button @click="open = !open" :aria-expanded="open" aria-haspopup="true"
                class="flex items-center text-base font-medium hover:text-yellow-500 focus:outline-none">
                Resources
                <svg class="ml-1 w-4 h-4 fill-current" viewBox="0 0 12 12">
                  <path
                    d="M10.28 4.305L5.989 8.598 1.695 4.305A1 1 0 00.28 5.72l5 5a1 1 0 001.414 0l5-5a1 1 0 10-1.414-1.414z" />
                </svg>
              </button>
              <ul x-show="open" x-cloak x-transition.opacity.duration.200ms @mouseenter="clearTimeout(timeout)"
                @mouseleave="timeout = setTimeout(() => open = false, 300)"
                class="absolute left-0 mt-2 w-40 bg-white text-slate-800 rounded shadow-lg py-2">
                <li>
                  <a href="404.html" class="block px-4 py-2 text-sm hover:bg-yellow-100">
                    404
                  </a>
                </li>
                <li>
                  <a href="support.html" class="block px-4 py-2 text-sm hover:bg-yellow-100">
                    Support
                  </a>
                </li>
              </ul>
            </div>
          </nav>
        </div>

        <!-- Right: Sign in & CTA -->
        <div class="hidden md:flex items-center space-x-6">
          <a href="#" @click.prevent="open('login')" class="text-base font-medium hover:text-yellow-500">Sign in</a>
          <a href="#" @click.prevent="open('signup')"
            class="inline-flex items-center px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600">
            Join LTWCE <span class="ml-2">→</span>
          </a>
        </div>

        <!-- Mobile menu button -->
        <button @click="mobileOpen = !mobileOpen" aria-label="Toggle mobile menu" :aria-expanded="mobileOpen"
          class="md:hidden p-2 text-white hover:text-yellow-200 focus:outline-none">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
          </svg>
        </button>
      </div>

      <!-- Mobile nav panel -->
      <nav id="mobile-nav" x-show="mobileOpen" x-cloak @click.away="mobileOpen = false"
        @keydown.escape.window="mobileOpen = false" x-transition
        class="md:hidden bg-white text-slate-800 border-t border-slate-200 shadow-lg">
        <ul class="space-y-1 p-4">
          <li>
            <a href="about.html" class="block px-3 py-2 rounded hover:bg-yellow-100">
              About
            </a>
          </li>
          <li>
            <a href="services.html" class="block px-3 py-2 rounded hover:bg-yellow-100">
              services
            </a>
          </li>
          <li></li>
          <li>
            <a href="blog.html" class="block px-3 py-2 rounded hover:bg-yellow-100">
              Blog
            </a>
          </li>
          <li>
            <a href="wall-of-love.html" class="block px-3 py-2 rounded hover:bg-yellow-100">
              Wall of Love
            </a>
          </li>

          <!-- Mobile Resources -->
          <li x-data="{ open: false }" class="space-y-1">
            <button @click="open = !open"
              class="w-full text-left px-3 py-2 rounded hover:bg-yellow-100 flex justify-between items-center">
              Resources
              <svg :class="{ 'rotate-180': open }" class="w-4 h-4 transition-transform" viewBox="0 0 12 12">
                <path
                  d="M10.28 4.305L5.989 8.598 1.695 4.305A1 1 0 00.28 5.72l5 5a1 1 0 001.414 0l5-5a1 1 0 10-1.414-1.414z" />
              </svg>
            </button>
            <ul x-show="open" class="pl-4 space-y-1">
              <li>
                <a href="404.html" class="block px-3 py-2 rounded hover:bg-yellow-100">
                  404
                </a>
              </li>
              <li>
                <a href="support.html" class="block px-3 py-2 rounded hover:bg-yellow-100">
                  Support
                </a>
              </li>
            </ul>
          </li>

          <li>
            <a href="#" @click.prevent="open('login')" class="block px-3 py-2 rounded hover:bg-yellow-100">Sign in</a>
          </li>
          <li>
            <a href="#" @click.prevent="open('signup')"
              class="block text-center px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600">Join LTWCE</a>
          </li>
        </ul>
      </nav>
    </header>

    <main class="flex-1">
      <!-- Hero -->
      <section class="relative">
        <!-- Dark background with custom clip-path -->
        <div aria-hidden="true"
          class="absolute inset-0 bg-slate-900 pointer-events-none -z-10 [clip-path:polygon(0_0,5760px_0,5760px_calc(100%_-_352px),0_100%)]">
        </div>

        <div class="max-w-6xl mx-auto px-4 sm:px-6">
          <div class="pt-32 sm:pt-40 pb-20 sm:pb-44">
            <div class="md:flex md:items-center md:space-x-8 lg:space-x-20 mx-auto">
              <!-- Content -->
              <div class="w-full md:w-1/2 space-y-6 text-center md:text-left" data-aos="fade-right">
                <h1 class="font-playfair text-4xl md:text-5xl font-bold text-white leading-tight mb-4">
                  LTWCE Co-op –
                  <span class="text-emerald-500">Empowering Our Community</span>
                </h1>
                <p class="text-lg text-slate-200 max-w-prose mb-8">
                  Welcome to LTWCE: streamline your member onboarding, manage
                  savings &amp; shares, apply for loans, and access real-time
                  account updates—built exclusively for our LTWCE SACCO.
                </p>
                <div
                  class="flex flex-col sm:flex-row sm:space-x-4 space-y-4 sm:space-y-0 justify-center md:justify-start">
                  <a href="request-demo.html"
                    class="inline-block px-6 py-3 bg-yellow-600 text-white font-medium rounded-md hover:bg-yellow-700 transition">
                    Join LTWCE →
                  </a>
                  <a href="#0"
                    class="inline-block px-6 py-3 border border-white text-white font-medium rounded-md hover:bg-white hover:text-slate-900 transition">
                    Learn More
                  </a>
                </div>
              </div>

              <!-- Image & Video -->
              <div x-data="{ open: false }" class="mt-12 md:mt-0 w-full md:w-1/2 flex justify-center"
                data-aos="fade-left">
                <div class="relative">
                  <!-- gradient overlay -->
                  <div aria-hidden="true"
                    class="absolute inset-0 bg-gradient-to-tr from-black via-transparent to-black rounded-lg"></div>
                  <img src="<?= base_url('assets/images/hero-image-01.jpg'); ?>" width="540" height="405"
                    alt="Cooperative Members" class="relative rounded-lg shadow-xl" />
                  <!-- play button -->
                  <button @click="open = true" aria-label="Play video"
                    class="absolute inset-0 flex items-center justify-center text-white">
                    <svg class="w-16 h-16 md:w-20 md:h-20 fill-current" viewBox="0 0 88 88"
                      xmlns="http://www.w3.org/2000/svg">
                      <circle cx="44" cy="44" r="44" class="text-white/80 transition-colors" fill="currentColor" />
                      <path
                        d="M52 44a.999.999 0 00-.427-.82l-10-7A1 1 0 0040 37V51a.999.999 0 001.573.82l10-7A.995.995 0 0052 44V44c0 .001 0 .001 0 0z"
                        class="text-yellow-600" fill="currentColor" />
                    </svg>
                  </button>

                  <!-- Modal backdrop -->
                  <div x-show="open" x-cloak @click="open = false" class="fixed inset-0 bg-black bg-opacity-75 z-40">
                  </div>

                  <!-- Modal dialog -->
                  <div x-show="open" x-cloak class="fixed inset-0 flex items-center justify-center z-50 p-4">
                    <div @click.away="open = false" @keydown.escape.window="open = false"
                      class="bg-black rounded-lg overflow-hidden shadow-lg max-w-3xl w-full">
                      <video x-init="$watch('open', val => val ? $el.play() : $el.pause())" class="w-full h-auto"
                        controls loop>
                        <source src="<?= base_url('assets/videos/video.mp4'); ?>" type="video/mp4" />

                        Your browser does not support the video tag.
                      </video>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Features blocks -->
      <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
          <!-- Decorative vertical lines -->
          <div aria-hidden="true" class="relative mb-12">
            <div class="absolute inset-0 flex justify-center space-x-4 opacity-20">
              <span class="block w-1 h-32 bg-slate-200 rounded"></span>
              <span class="block w-1 h-32 bg-slate-200 rounded"></span>
              <span class="block w-1 h-32 bg-slate-200 rounded"></span>
              <span class="block w-1 h-32 bg-slate-200 rounded"></span>
            </div>
          </div>

          <!-- Features grid -->
          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-12" data-aos-id-blocks>
            <template x-for="f in features" :key="f.title">
              <div
                class="group flex flex-col items-center text-center space-y-4 p-6 rounded-lg hover:shadow-lg transition-shadow duration-300"
                data-aos="fade-up" data-aos-anchor="[data-aos-id-blocks]" :data-aos-delay="f.delay">
                <!-- circle background + icon -->
                <div
                  class="w-16 h-16 rounded-full flex items-center justify-center transform transition-transform duration-200 group-hover:scale-110"
                  :class="f.bg">
                  <i :class="`${f.icon} text-2xl transition-colors duration-200 ${f.fg}`"></i>
                </div>
                <h3 class="text-xl font-semibold transition-colors duration-200 group-hover:text-blue-600"
                  x-text="f.title"></h3>
                <p class="text-slate-600 max-w-xs transition-colors duration-200 group-hover:text-slate-800"
                  x-text="f.description"></p>
              </div>
            </template>
          </div>
        </div>
      </section>

      <!-- Add CSS for Sliding and Fading Animation -->
      <!-- SERVICES CAROUSEL -->
      <section class="relative w-full bg-slate-900 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
          <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-white">Our Services</h2>
          </div>

          <!-- Alpine root is already on <body x-data="supportApp()"> -->
          <template x-if="services.length">
            <div @mouseenter="pauseCarousel()" @mouseleave="playCarousel()" class="relative overflow-hidden">
              <!-- left fade -->
              <div
                class="absolute inset-y-0 left-0 w-24 bg-gradient-to-r from-slate-900 to-transparent z-10 pointer-events-none">
              </div>
              <!-- right fade -->
              <div
                class="absolute inset-y-0 right-0 w-24 bg-gradient-to-l from-slate-900 to-transparent z-10 pointer-events-none">
              </div>

              <!-- scrolling track -->
              <div x-ref="track" class="flex space-x-6 will-change-transform" :style="{
            animation: `scroll-left ${duration}s linear infinite`,
            'animation-play-state': playing ? 'running' : 'paused'
          }">
                <template x-for="(svc,i) in looped" :key="i">
                  <div
                    class="flex-shrink-0 w-56 sm:w-64 bg-white rounded-lg shadow-md overflow-hidden hover:scale-105 transition-transform">
                    <img :src="svc.img" :alt="svc.title" class="w-full h-40 object-cover rounded-t-lg" />
                    <div class="p-4">
                      <h3 class="text-lg font-semibold text-slate-900" x-text="svc.title"></h3>
                      <p class="text-sm text-slate-600 mt-1" x-text="svc.desc"></p>
                    </div>
                  </div>
                </template>
              </div>
            </div>
          </template>

          <!-- View More -->
          <div class="text-center mt-8" x-show="services.length">
            <a href="services.html" class="px-6 py-3 bg-yellow-500 text-white rounded hover:bg-yellow-600 transition">
              View More
            </a>
          </div>
        </div>
      </section>

      <!-- Section: Everything You Need, One Portal -->
      <section class="relative bg-white">
        <!-- Background overlay -->
        <div aria-hidden="true" class="absolute inset-0 pointer-events-none bg-slate-100" style="height: 474px"></div>

        <div class="relative max-w-6xl mx-auto px-4 sm:px-6">
          <div class="py-12 md:py-20">
            <!-- Section header -->
            <div class="max-w-3xl mx-auto text-center pb-12">
              <h2 class="font-playfair text-slate-800 text-4xl md:text-5xl mb-4 font-bold">
                Discover Your LTWCE SACCO Member Portal
              </h2>
              <p class="text-xl leading-[1.5] tracking-tight text-slate-500">
                Navigate your financial journey effortlessly—register in
                minutes, track your savings, apply for loans, and view
                personalized reports.
              </p>
            </div>

            <!-- Tabs -->
            <div class="space-y-8" x-cloak>
              <!-- Tab buttons -->
              <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-8">
                <template x-for="t in tabs" :key="t.id">
                  <button @click="tab = t.id" :class="tab === t.id ? 'text-slate-800' : 'text-slate-500'"
                    class="group flex flex-col items-center space-y-2 focus:outline-none">
                    <div
                      :class="tab === t.id ? 'bg-yellow-200' : 'bg-white opacity-50 hover:opacity-100 hover:bg-yellow-50'"
                      class="w-16 h-16 flex items-center justify-center rounded-full shadow transition-colors duration-200">
                      <i
                        :class="`${t.icon} text-2xl transition-transform duration-300 group-hover:scale-110 group-hover:-rotate-3 ${tab === t.id ? 'text-blue-600' : 'text-gray-400'}`"></i>
                    </div>
                    <span class="font-semibold leading-tight" x-text="t.label"></span>
                  </button>
                </template>
              </div>

              <!-- Tab panels -->
              <div class="relative flex flex-col items-center">
                <template x-for="t in tabs" :key="t.id">
                  <div x-show="tab === t.id" x-transition class="flex justify-center">
                    <!-- Dynamically resolve image path using base_url() in PHP -->
                    <img :src="`<?= base_url('') ?>${t.image.src}`" :alt="t.image.alt" width="768" height="474"
                      class="rounded-lg shadow-lg" />
                  </div>
                </template>
              </div>
            </div>
          </div>
        </div>
      </section>


      <!-- Section: Simplify Operations & Transparency -->
      <section class="relative overflow-hidden">
        <!-- Dark background with custom clip-path (full height) -->
        <div aria-hidden="true"
          class="absolute inset-x-0 top-0 h-120 bg-slate-900 pointer-events-none -z-10 [clip-path:polygon(0_0,5760px_0,5760px_calc(100%_-_352px),0_100%)]">
        </div>

        <!-- Heading -->
        <div class="relative z-20 text-center pt-16 pb-4">
          <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white">
            Manage Your Money with Ease
          </h2>
          <p class="mt-4 text-lg text-slate-300 max-w-2xl mx-auto">
            As a Lubaga SACCO member, you have everything you need to save,
            borrow, and plan — all in one place.
          </p>
        </div>

        <!-- Cards grid, no fixed pull-up because the clip covers full section -->
        <div class="container mx-auto px-4 relative z-20 grid gap-8 grid-cols-1 md:grid-cols-2 lg:grid-cols-3 pb-16">
          <!-- Card 1 -->
          <article class="relative max-w-sm mx-auto group">
            <!-- gray, faded frame on hover -->
            <div
              class="absolute inset-0 rounded-lg border border-gray-300 opacity-0 group-hover:opacity-50 transition-opacity duration-300 translate-x-4 translate-y-4 -z-10">
            </div>
            <!-- card container: zoom + shadow on hover -->
            <div
              class="bg-white rounded-lg overflow-hidden shadow-lg transform transition duration-300 group-hover:scale-105 group-hover:shadow-md">
              <!-- big sliding badge -->
              <div
                class="absolute top-0 left-0 -translate-y-1/2 -translate-x-1/2 w-16 h-16 bg-blue-500 text-white rounded-full flex items-center justify-center font-bold text-2xl z-10 ring-4 ring-white ring-offset-2 ring-offset-gray-100 transition-all duration-300 group-hover:left-1/2 group-hover:top-1/2 group-hover:-translate-x-1/2 group-hover:-translate-y-1/2 group-hover:bg-green-500">
                1
              </div>
              <img src="<?= base_url('assets/images/features-home-3-01.jpg'); ?>" alt="Full Audit Trail"
                class="w-full block" />
              <div class="p-6 text-left">
                <h3 class="text-xl font-semibold text-slate-900 mb-2">
                  Track Your Transactions
                </h3>
                <p class="text-sm text-slate-600">
                  See every deposit and withdrawal in one simple view, so you
                  always know where your money stands.
                </p>
              </div>
            </div>
          </article>

          <!-- Card 2 -->
          <article class="relative max-w-sm mx-auto group" data-aos="fade-up" data-aos-delay="100">
            <div
              class="absolute inset-0 rounded-lg border border-gray-300 opacity-0 group-hover:opacity-50 transition-opacity duration-300 translate-x-4 translate-y-4 -z-10">
            </div>
            <div
              class="bg-white rounded-lg overflow-hidden shadow-lg transform transition duration-300 group-hover:scale-105 group-hover:shadow-md">
              <div
                class="absolute top-0 left-0 -translate-y-1/2 -translate-x-1/2 w-16 h-16 bg-blue-500 text-white rounded-full flex items-center justify-center font-bold text-2xl z-10 ring-4 ring-white ring-offset-2 ring-offset-gray-100 transition-all duration-300 group-hover:left-1/2 group-hover:top-1/2 group-hover:-translate-x-1/2 group-hover:-translate-y-1/2 group-hover:bg-yellow-300">
                2
              </div>
              <img src="<?= base_url('assets/images/features-home-3-02.jpg'); ?>" alt="Real-Time Dashboard"
                class="w-full block" />
              <div class="p-6 text-left">
                <h3 class="text-xl font-semibold text-slate-900 mb-2">
                  Watch Your Savings Grow
                </h3>
                <p class="text-sm text-slate-600">
                  Check your balance at any time and see how close you are to
                  reaching your goals.
                </p>
              </div>
            </div>
          </article>

          <!-- Card 3 -->
          <article class="relative max-w-sm mx-auto group" data-aos="fade-up" data-aos-delay="200">
            <div
              class="absolute inset-0 rounded-lg border border-gray-300 opacity-0 group-hover:opacity-50 transition-opacity duration-300 translate-x-4 translate-y-4 -z-10">
            </div>
            <div
              class="bg-white rounded-lg overflow-hidden shadow-lg transform transition duration-300 group-hover:scale-105 group-hover:shadow-md">
              <div
                class="absolute top-0 left-0 -translate-y-1/2 -translate-x-1/2 w-16 h-16 bg-blue-500 text-white rounded-full flex items-center justify-center font-bold text-2xl z-10 ring-4 ring-white ring-offset-2 ring-offset-gray-100 transition-all duration-300 group-hover:left-1/2 group-hover:top-1/2 group-hover:-translate-x-1/2 group-hover:-translate-y-1/2 group-hover:bg-teal-500">
                3
              </div>
              <img src="<?= base_url('assets/images/features-home-3-03.jpg'); ?>" alt="Automated Alerts"
                class="w-full block" />
              <div class="p-6 text-left">
                <h3 class="text-xl font-semibold text-slate-900 mb-2">
                  Friendly Reminders
                </h3>
                <p class="text-sm text-slate-600">
                  Receive SMS and email alerts before payments are due, so you
                  never miss a deadline.
                </p>
              </div>
            </div>
          </article>
        </div>
      </section>

      <!-- LTWCE SACCO by the Numbers -->
      <section class="py-16 bg-slate-50">
        <div class="max-w-6xl mx-auto px-4 sm:px-6">
          <!-- Header -->
          <div class="text-center max-w-2xl mx-auto mb-12">
            <h2 class="font-playfair text-3xl md:text-4xl font-bold text-slate-800">
              LTWCE SACCO by the Numbers
            </h2>
            <p class="mt-4 text-lg text-slate-600">
              From rapid onboarding to powerful savings and loan products, see
              how LTWCE SACCO is transforming lives across Kampala.
            </p>
          </div>
          <!-- Stats & Illustration -->
          <div class="flex flex-col lg:flex-row items-center gap-12">
            <ul class="flex-1 space-y-8" data-aos="fade-right">
              <!-- Members -->
              <li class="flex items-start space-x-4">
                <svg class="w-16 h-16 text-yellow-500 flex-shrink-0" fill="currentColor" viewBox="0 0 16 16">
                  <!-- icon path -->
                  <path
                    d="M15.722 4.008C14.408 1.214 10.954-.635 7.318.203 5.6.596 4.072 1.561 2.919 2.757A10.57 10.57 0 0 0 .484 6.93C.03 8.458-.173 10.035.18 11.764c.191.862.518 1.683 1.146 2.479a4.876 4.876 0 0 0 2.256 1.522c1.635.469 3.156.192 4.41-.439 1.242-.615 2.298-1.769 2.494-3.094.094-.656-.537-.657-.69-.18-.781 2.126-3.715 2.534-5.265 1.579-1.568-.922-1.185-3.068-.294-4.801.89-1.729 2.454-3.02 3.92-3.338.376-.098.714-.121 1.026-.098.324.018.658.074.98.188.65.2 1.23.591 1.618 1 .27.3.575.386 1.002.461.436.061.95.117 1.499.045.535-.073 1.06-.287 1.41-.807.345-.504.462-1.348.03-2.273" />
                </svg>
                <div>
                  <div class="text-4xl md:text-5xl font-bold text-slate-800">
                    1,200+
                  </div>
                  <p class="text-lg text-slate-600">
                    Active members onboarded this year via our seamless
                    digital process.
                  </p>
                </div>
              </li>
              <!-- Loans -->
              <li class="flex items-start space-x-4">
                <svg class="w-16 h-16 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 16 16">
                  <!-- icon path -->
                  <path
                    d="M15.722 4.008C14.408 1.214 10.954-.635 7.318.203 5.6.596 4.072 1.561 2.919 2.757A10.57 10.57 0 0 0 .484 6.93C.03 8.458-.173 10.035.18 11.764c.191.862.518 1.683 1.146 2.479a4.876 4.876 0 0 0 2.256 1.522c1.635.469 3.156.192 4.41-.439 1.242-.615 2.298-1.769 2.494-3.094.094-.656-.537-.657-.69-.18-.781 2.126-3.715 2.534-5.265 1.579-1.568-.922-1.185-3.068-.294-4.801.89-1.729 2.454-3.02 3.92-3.338.376-.098.714-.121 1.026-.098.324.018.658.074.98.188.65.2 1.23.591 1.618 1 .27.3.575.386 1.002.461.436.061.95.117 1.499.045.535-.073 1.06-.287 1.41-.807.345-.504.462-1.348.03-2.273" />
                </svg>
                <div>
                  <div class="text-4xl md:text-5xl font-bold text-slate-800">
                    UGX 250 M+
                  </div>
                  <p class="text-lg text-slate-600">
                    Loans disbursed to empower businesses, education, and
                    livelihoods.
                  </p>
                </div>
              </li>
              <!-- Savings -->
              <li class="flex items-start space-x-4">
                <svg class="w-16 h-16 text-indigo-500 flex-shrink-0" fill="currentColor" viewBox="0 0 16 16">
                  <!-- icon path -->
                  <path
                    d="M15.722 4.008C14.408 1.214 10.954-.635 7.318.203 5.6.596 4.072 1.561 2.919 2.757A10.57 10.57 0 0 0 .484 6.93C.03 8.458-.173 10.035.18 11.764c.191.862.518 1.683 1.146 2.479a4.876 4.876 0 0 0 2.256 1.522c1.635.469 3.156.192 4.41-.439 1.242-.615 2.298-1.769 2.494-3.094.094-.656-.537-.657-.69-.18-.781 2.126-3.715 2.534-5.265 1.579-1.568-.922-1.185-3.068-.294-4.801.89-1.729 2.454-3.02 3.92-3.338.376-.098.714-.121 1.026-.098.324.018.658.074.98.188.65.2 1.23.591 1.618 1 .27.3.575.386 1.002.461.436.061.95.117 1.499.045.535-.073 1.06-.287 1.41-.807.345-.504.462-1.348.03-2.273" />
                </svg>
                <div>
                  <div class="text-4xl md:text-5xl font-bold text-slate-800">
                    UGX 500 M+
                  </div>
                  <p class="text-lg text-slate-600">
                    Members’ savings held securely—our community’s trust in
                    action.
                  </p>
                </div>
              </li>
            </ul>
            <div class="flex-1" data-aos="fade-left">
              <img src="<?= base_url('assets/images/target.png'); ?>" alt="Impact Chart"
                class="w-full rounded-lg shadow-lg" />
            </div>
          </div>
        </div>
      </section>

      <!-- Choose Your Membership Tier -->

      <section x-data="{ showShares: false }" class="bg-white">
        <!-- Header -->
        <div class="bg-slate-900 pt-20 pb-32 text-center">
          <h2 class="font-playfair text-4xl md:text-5xl font-bold text-white">
            Choose Your Membership Tier
          </h2>
          <p class="mt-4 text-lg text-slate-300 max-w-2xl mx-auto">
            Toggle below to view either the one‑time fee or the minimum share
            requirement.
            <span class="block mt-2">Each share costs UGX 10 000.</span>
          </p>

          <!-- Toggle -->
          <div class="mt-8 flex justify-center items-center gap-4">
            <span class="text-slate-300">Show Fee</span>
            <label class="inline-flex items-center cursor-pointer">
              <span class="sr-only">Toggle share vs fee view</span>
              <input type="checkbox" class="sr-only" x-model="showShares" title="Toggle share vs fee view" />
              <div class="w-12 h-6 bg-slate-700 rounded-full relative transition-colors duration-300"
                :class="{ 'bg-yellow-500': showShares }">
                <span
                  class="absolute top-0.5 left-0.5 w-5 h-5 bg-white rounded-full shadow transform transition-transform duration-300"
                  :class="{ 'translate-x-6': showShares }"></span>
              </div>
            </label>
            <span class="text-slate-300">Show Shares</span>
          </div>
        </div>

        <!-- Cards -->
        <div class="relative -mt-24 z-10 px-4">
          <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-8 pb-20">
            <!-- Starter Card -->
            <div class="bg-white rounded-lg shadow-xl transform transition hover:scale-105 hover:shadow-2xl p-6"
              data-aos="fade-up">
              <h3 class="text-xl font-semibold text-slate-800 mb-4">
                Starter
              </h3>
              <div class="flex items-baseline mb-4">
                <!-- Fee view -->
                <span x-show="!showShares" class="flex items-baseline">
                  <span class="text-lg text-slate-500 mr-1">UGX</span>
                  <span class="text-4xl font-bold text-slate-900">10 000</span>
                  <span class="ml-1 text-slate-500">/member</span>
                </span>
                <!-- Shares view -->
                <span x-show="showShares" class="flex flex-col">
                  <div class="flex items-baseline">
                    <span class="text-4xl font-bold text-slate-900">2</span>
                    <span class="text-lg text-slate-500 ml-1">shares</span>
                  </div>
                  <span class="text-sm text-slate-500">Total UGX 20 000</span>
                </span>
              </div>
              <p class="text-slate-600 mb-6">
                Perfect for new savers—start small and join our community.
              </p>
              <ul class="space-y-2 mb-6 text-slate-600">
                <li>✅ Digital savings wallet & USSD access</li>
                <li>✅ Community welcome kit</li>
                <li>✅ Introductory savings workshop</li>
                <li>✅ Peer support circle</li>
                <li>✅ Monthly SMS balance alerts</li>
                <li>✅ Quarterly member newsletter</li>
              </ul>
              <a href="#"
                class="block text-center bg-yellow-500 text-white font-semibold px-4 py-2 rounded hover:bg-yellow-600 transition">
                <span x-show="!showShares">Join for UGX 10 000</span>
                <span x-show="showShares">Buy 2 shares (UGX 20 000)</span>
              </a>
            </div>

            <!-- Growth Card -->
            <div
              class="relative bg-white rounded-lg shadow-xl transform transition hover:scale-105 hover:shadow-2xl p-6"
              data-aos="fade-up" data-aos-delay="100">
              <div
                class="absolute -top-3 left-1/2 -translate-x-1/2 bg-green-400 text-slate-900 px-4 py-1 rounded-full font-medium">
                Most Popular
              </div>
              <h3 class="mt-4 text-xl font-semibold text-slate-800 mb-4">
                Growth
              </h3>
              <div class="flex items-baseline mb-4">
                <span x-show="!showShares" class="flex items-baseline">
                  <span class="text-lg text-slate-500 mr-1">UGX</span>
                  <span class="text-4xl font-bold text-slate-900">30 000</span>
                  <span class="ml-1 text-slate-500">/member</span>
                </span>
                <span x-show="showShares" class="flex flex-col">
                  <div class="flex items-baseline">
                    <span class="text-4xl font-bold text-slate-900">5</span>
                    <span class="text-lg text-slate-500 ml-1">shares</span>
                  </div>
                  <span class="text-sm text-slate-500">Total UGX 50 000</span>
                </span>
              </div>
              <p class="text-slate-600 mb-6">
                Ideal for entrepreneurs—access loans, dividends, and deeper
                insights.
              </p>
              <ul class="space-y-2 mb-6 text-slate-600">
                <li>✅ All Starter benefits</li>
                <li>✅ Loan access up to UGX 5 million</li>
                <li>✅ 48‑hour loan approval</li>
                <li>✅ Financial health dashboard</li>
                <li>✅ Monthly PDF statements</li>
                <li>✅ Annual dividend & profit share</li>
                <li>✅ Business toolkit webinars</li>
              </ul>
              <a href="#"
                class="block text-center bg-yellow-500 text-white font-semibold px-4 py-2 rounded hover:bg-yellow-600 transition">
                <span x-show="!showShares">Join for UGX 30 000</span>
                <span x-show="showShares">Buy 5 shares (UGX 50 000)</span>
              </a>
            </div>

            <!-- Leader Card -->
            <div class="bg-white rounded-lg shadow-xl transform transition hover:scale-105 hover:shadow-2xl p-6"
              data-aos="fade-up" data-aos-delay="200">
              <h3 class="text-xl font-semibold text-slate-800 mb-4">
                Leader
              </h3>
              <div class="flex items-baseline mb-4">
                <span x-show="!showShares" class="flex items-baseline">
                  <span class="text-lg text-slate-500 mr-1">UGX</span>
                  <span class="text-4xl font-bold text-slate-900">50 000</span>
                  <span class="ml-1 text-slate-500">/member</span>
                </span>
                <span x-show="showShares" class="flex flex-col">
                  <div class="flex items-baseline">
                    <span class="text-4xl font-bold text-slate-900">10</span>
                    <span class="text-lg text-slate-500 ml-1">shares</span>
                  </div>
                  <span class="text-sm text-slate-500">Total UGX 100 000</span>
                </span>
              </div>
              <p class="text-slate-600 mb-6">
                Full privileges—large loans, coaching, governance, and
                insurance.
              </p>
              <ul class="space-y-2 mb-6 text-slate-600">
                <li>✅ All Growth benefits</li>
                <li>✅ Investment loans up to UGX 20 million</li>
                <li>✅ Quarterly one‑on‑one coaching</li>
                <li>✅ Governance & voting rights</li>
                <li>✅ Invite‑only Leaders’ Forum</li>
                <li>✅ Complimentary micro‑insurance</li>
                <li>✅ Priority customer support</li>
              </ul>
              <a href="#"
                class="block text-center bg-yellow-500 text-white font-semibold px-4 py-2 rounded hover:bg-yellow-600 transition">
                <span x-show="!showShares">Join for UGX 50 000</span>
                <span x-show="showShares">Buy 10 shares (UGX 100 000)</span>
              </a>
            </div>
          </div>
        </div>
      </section>

      <!-- Call to Action -->

      <section class="py-16 bg-gray-100 text-gray-900">
        <div class="max-w-3xl mx-auto px-4 text-center space-y-6">
          <!-- Headline wrapper, now relative so we can position the flourish -->
          <div class="relative inline-block">
            <!-- Your headline -->
            <h2 class="text-3xl md:text-4xl font-bold">
              Skip the paperwork, cut wait times, and eliminate
              <span class="text-green-500">uncertainty</span>.
            </h2>

            <!-- Gold flourish, bigger and at top-right -->
            <svg class="absolute top-0 right-0 w-16 h-12 text-yellow-400 transform translate-x-1/2 -translate-y-1/2"
              fill="currentColor" viewBox="0 0 56 43">
              <path
                d="M4.532 30.45C15.785 23.25 24.457 12.204 29.766.199c.034-.074-.246-.247-.3-.186-4.227 5.033-9.298 9.282-14.372 13.162C10 17.07 4.919 20.61.21 24.639c-1.173 1.005 2.889 6.733 4.322 5.81M18.96 42.198c12.145-4.05 24.12-8.556 36.631-12.365.076-.024.025-.349-.055-.347-6.542.087-13.277.083-19.982.827-6.69.74-13.349 2.24-19.373 5.197-1.53.75 1.252 7.196 2.778 6.688" />
            </svg>
          </div>

          <!-- Sub-text -->
          <p class="text-lg">
            Apply for savings, manage loans, and get instant updates—no more
            lines.
          </p>

          <!-- Call-to-action -->
          <a href="request-demo.html"
            class="inline-block bg-green-500 text-white font-semibold px-6 py-3 rounded-lg hover:bg-green-600 transition">
            Join LTWCE&nbsp;→
          </a>
        </div>
      </section>
    </main>
    <!-- Footer -->

    <!-- BACKDROP -->
    <div x-show="modal" x-transition.opacity class="fixed inset-0 bg-black bg-opacity-50 z-40"></div>

    <!-- LOGIN MODAL -->
    <template x-if="modal==='login'">
      <div x-transition class="fixed inset-0 flex items-center justify-center z-50 px-4">
        <div class="bg-white rounded-xl shadow-2xl max-w-5xl w-full grid grid-cols-1 lg:grid-cols-2 overflow-hidden">
          <!-- Left: Login Form -->
          <div class="p-8">
            <h2 class="font-dm-serif text-3xl font-bold text-slate-800 mb-6 text-center">
              Sign in to LTWCE
            </h2>
            <div class="space-y-4 mb-6">
              <button @click="social('google')"
                class="w-full flex items-center justify-center space-x-3 bg-white border border-slate-200 rounded px-4 py-2 hover:shadow">
                <svg class="w-5 h-5" viewBox="0 0 16 16">
                  <path d="…" />
                </svg>
                <span class="text-sm font-medium">Login with Google</span>
              </button>
              <button @click="social('facebook')"
                class="w-full flex items-center justify-center space-x-3 bg-yellow-600 text-white rounded px-4 py-2 hover:bg-yellow-700">
                <svg class="w-5 h-5" viewBox="0 0 16 16">
                  <path d="…" />
                </svg>
                <span class="text-sm font-medium">Login with Facebook</span>
              </button>
            </div>
            <div class="flex items-center my-6">
              <div class="flex-1 h-px bg-slate-200"></div>
              <span class="mx-3 text-sm text-slate-500">or</span>
              <div class="flex-1 h-px bg-slate-200"></div>
            </div>
            <form @submit.prevent="doLogin()" class="space-y-6">
              <div>
                <label class="block text-sm font-medium mb-1">Email <span class="text-rose-500">*</span></label>
                <input type="email" x-model="login.email" required
                  class="w-full border border-slate-200 rounded px-4 py-2 focus:border-yellow-500" />
              </div>
              <div>
                <label class="block text-sm font-medium mb-1">Password <span class="text-rose-500">*</span></label>
                <div class="relative">
                  <input :type="showPwd?'text':'password'" x-model="login.password" required
                    class="w-full border border-slate-200 rounded px-4 py-2 focus:border-yellow-500" />
                  <button type="button" @click="showPwd=!showPwd"
                    class="absolute inset-y-0 right-2 flex items-center text-gray-500">
                    <template x-if="showPwd">🙈</template>
                    <template x-if="!showPwd">👁️</template>
                  </button>
                </div>
              </div>
              <button type="submit" :disabled="loading"
                class="w-full bg-yellow-600 text-white py-2 rounded hover:bg-yellow-700 disabled:opacity-50 flex justify-center">
                <svg x-show="loading" class="w-5 h-5 mr-2 animate-spin" viewBox="0 0 24 24">
                  <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" fill="none"></circle>
                </svg>
                Sign In
              </button>
              <p class="text-center text-sm">
                <a href="#" @click.prevent="open('forgotEmail')" class="text-yellow-600 hover:underline">Forgot your
                  password?</a>
              </p>
            </form>
            <p class="mt-4 text-center text-sm">
              Don’t have an account?
              <a href="#" @click.prevent="open('signup')" class="text-green-600 hover:underline">Sign Up</a>
            </p>
          </div>
          <!-- Right: Testimonial -->
          <div class="relative hidden lg:block">
            <div class="absolute inset-0">
              <img class="w-full h-full object-cover opacity-10" src="<?= base_url('assets/images/sign-in-bg.jpg'); ?>"
                alt="" />
            </div>
            <div class="relative z-10 flex items-center justify-center h-full p-8">
              <div class="bg-white bg-opacity-80 p-8 rounded-xl shadow-xl">
                <h3 class="font-dm-serif text-3xl font-bold mb-4 text-center text-slate-900">
                  The Wealth Inc.
                </h3>
                <blockquote class="text-slate-700 italic mb-6 flex items-start space-x-4">
                  <svg class="w-5 h-4 text-yellow-600" viewBox="0 0 20 16">
                    <path d="…" />
                  </svg>
                  <p>“Joining LTWCE doubled our productivity overnight.”</p>
                </blockquote>
                <div class="flex items-center">
                  <img class="w-12 h-12 rounded-full mr-4"
                    src="<?= base_url('assets/images/customer-avatar-05.jpg'); ?>" alt="Michael" />
                  <div>
                    <p class="text-sm font-medium text-slate-800">
                      Michael hassan
                    </p>
                    <p class="text-sm text-slate-500">CEO, The Wealth Inc.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- CLOSE -->
          <button @click="close()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 p-2">
            ✕
          </button>
        </div>
      </div>
    </template>

    <!-- SIGNUP MODAL -->
    <template x-if="modal==='signup'">
      <div x-transition class="fixed inset-0 flex items-center justify-center z-50 px-4">
        <div class="bg-white rounded-xl shadow-2xl max-w-5xl w-full grid grid-cols-1 lg:grid-cols-2 overflow-hidden">
          <!-- Left: Sign Up Form -->
          <div class="p-8">
            <h2 class="font-dm-serif text-3xl font-bold text-slate-800 mb-6 text-center">
              Create Your Account
            </h2>
            <div class="space-y-4 mb-6">
              <button @click="social('google')"
                class="w-full flex items-center justify-center space-x-3 bg-white border border-slate-200 rounded px-4 py-2 hover:shadow">
                <svg class="w-5 h-5">
                  <path d="…" />
                </svg>
                <span class="text-sm font-medium">Sign up with Google</span>
              </button>
              <button @click="social('facebook')"
                class="w-full flex items-center justify-center space-x-3 bg-yellow-600 text-white rounded px-4 py-2 hover:bg-yellow-700">
                <svg class="w-5 h-5">
                  <path d="…" />
                </svg>
                <span class="text-sm font-medium">Sign up with Facebook</span>
              </button>
            </div>
            <div class="flex items-center my-6">
              <div class="flex-1 h-px bg-slate-200"></div>
              <span class="mx-3 text-sm text-slate-500">or</span>
              <div class="flex-1 h-px bg-slate-200"></div>
            </div>
            <form @submit.prevent="doSignup()" class="space-y-6">
              <div>
                <label class="block text-sm font-medium mb-1">Full Name <span class="text-rose-500">*</span></label>
                <input type="text" x-model="signup.name" required
                  class="w-full border border-slate-200 rounded px-4 py-2 focus:border-green-500" />
              </div>
              <div>
                <label class="block text-sm font-medium mb-1">Email <span class="text-rose-500">*</span></label>
                <input type="email" x-model="signup.email" required
                  class="w-full border border-slate-200 rounded px-4 py-2 focus:border-green-500" />
              </div>
              <div>
                <label class="block text-sm font-medium mb-1">Password <span class="text-rose-500">*</span></label>
                <div class="relative">
                  <input :type="showPwd2?'text':'password'" x-model="signup.password"
                    @input="checkStrength(signup.password, 'signup')" required
                    class="w-full border border-slate-200 rounded px-4 py-2 focus:border-green-500" />
                  <button type="button" @click="showPwd2=!showPwd2"
                    class="absolute inset-y-0 right-2 flex items-center text-gray-500">
                    <template x-if="showPwd2">🙈</template><template x-if="!showPwd2">👁️</template>
                  </button>
                </div>
                <!-- strength bar -->
                <div class="w-full bg-gray-200 h-2 rounded mt-2">
                  <div :class="strengthBar(signupStrength).bg" :style="`width:${signupStrength}%`" class="h-2 rounded">
                  </div>
                </div>
              </div>
              <div>
                <label class="block text-sm font-medium mb-1">Confirm Password
                  <span class="text-rose-500">*</span></label>
                <input :type="showPwd2?'text':'password'" x-model="signup.confirm" required
                  class="w-full border border-slate-200 rounded px-4 py-2 focus:border-green-500" />
              </div>
              <button type="submit" :disabled="loading"
                class="w-full bg-green-600 text-white py-2 rounded hover:bg-green-700 disabled:opacity-50 flex justify-center">
                <svg x-show="loading" class="w-5 h-5 mr-2 animate-spin">
                  <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" fill="none" />
                </svg>
                Sign Up
              </button>
            </form>
            <p class="mt-4 text-center text-sm">
              Already have an account?
              <a href="#" @click.prevent="open('login')" class="text-yellow-600 hover:underline">Sign in</a>
            </p>
          </div>
          <!-- Right: Testimonial -->
          <div class="relative hidden lg:block">
            <div class="absolute inset-0">
              <img class="w-full h-full object-cover opacity-10"
                src="<?= base_url('assets/images/customer-avatar-05.jpg'); ?>" alt="" />
            </div>
            <div class="relative z-10 flex items-center justify-center h-full p-8">
              <div class="bg-white bg-opacity-80 p-8 rounded-xl shadow-xl">
                <h3 class="font-dm-serif text-3xl font-bold mb-4 text-center text-slate-900">
                  Join The Wealth Inc.
                </h3>
                <blockquote class="text-slate-700 italic mb-6 flex items-start space-x-4">
                  <svg class="w-5 h-4 text-yellow-600">
                    <path d="…" />
                  </svg>
                  <p>“LTWCE transformed our business within days.”</p>
                </blockquote>
                <div class="flex items-center">
                  <img class="w-12 h-12 rounded-full mr-4"
                    src="<?= base_url('assets/images/customer-avatar-02.jpg'); ?>" alt="Anna" />
                  <div>
                    <p class="text-sm font-medium text-slate-800">
                      Anna Smith
                    </p>
                    <p class="text-sm text-slate-500">CTO, The Wealth Inc.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- CLOSE -->
          <button @click="close()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 p-2">
            ✕
          </button>
        </div>
      </div>
    </template>

    <!-- FORGOT PASSWORD: ENTER EMAIL -->
    <template x-if="modal==='forgotEmail'">
      <div x-transition class="fixed inset-0 flex items-center justify-center z-50 px-4">
        <div class="bg-white rounded-xl shadow-2xl max-w-md w-full p-8 relative">
          <h2 class="font-dm-serif text-2xl font-bold mb-4 text-center">
            Reset Password
          </h2>
          <form @submit.prevent="sendResetOTP()" class="space-y-6">
            <div>
              <label class="block text-sm font-medium mb-1">Email <span class="text-rose-500">*</span></label>
              <input type="email" x-model="forgot.email" required
                class="w-full border border-slate-200 rounded px-4 py-2 focus:border-yellow-500" />
            </div>
            <button type="submit" :disabled="loading"
              class="w-full bg-yellow-500 text-white py-2 rounded hover:bg-yellow-600 disabled:opacity-50 flex justify-center">
              <svg x-show="loading" class="w-5 h-5 mr-2 animate-spin">
                <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" fill="none" />
              </svg>
              Send Code
            </button>
          </form>
          <button @click="close()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 p-2">
            ✕
          </button>
        </div>
      </div>
    </template>

    <!-- FORGOT PASSWORD: VERIFY CODE -->
    <template x-if="modal==='forgotOTP'">
      <div x-transition class="fixed inset-0 flex items-center justify-center z-50 px-4">
        <div class="bg-white rounded-xl shadow-2xl max-w-md w-full p-8 relative">
          <h2 class="font-dm-serif text-2xl font-bold mb-4 text-center">
            Enter Verification Code
          </h2>
          <form @submit.prevent="verifyResetOTP()" class="space-y-6">
            <div>
              <label class="block text-sm font-medium mb-1">6‑digit Code <span class="text-rose-500">*</span></label>
              <input type="text" maxlength="6" x-model="forgot.code" required
                class="w-full border border-slate-200 rounded px-4 py-2 text-center text-lg tracking-widest focus:border-yellow-500" />
            </div>
            <button type="submit" :disabled="loading"
              class="w-full bg-yellow-500 text-white py-2 rounded hover:bg-yellow-600 disabled:opacity-50 flex justify-center">
              <svg x-show="loading" class="w-5 h-5 mr-2 animate-spin">
                <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" fill="none" />
              </svg>
              Verify Code
            </button>
          </form>
          <p class="mt-4 text-center text-sm">
            <button @click="sendResetOTP()" class="text-yellow-600 hover:underline" :disabled="otpTimer>0">
              <template x-if="otpTimer>0">Resend in <span x-text="otpTimer+'s'"></span></template>
              <template x-if="otpTimer===0">Resend Code</template>
            </button>
          </p>
          <button @click="close()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 p-2">
            ✕
          </button>
        </div>
      </div>
    </template>

    <!-- RESET PASSWORD: NEW PASSWORD -->
    <template x-if="modal==='resetPass'">
      <div x-transition class="fixed inset-0 flex items-center justify-center z-50 px-4">
        <div class="bg-white rounded-xl shadow-2xl max-w-md w-full p-8 relative">
          <h2 class="font-dm-serif text-2xl font-bold mb-4 text-center">
            Choose a New Password
          </h2>
          <form @submit.prevent="doResetPass()" class="space-y-6">
            <div>
              <label class="block text-sm font-medium mb-1">New Password <span class="text-rose-500">*</span></label>
              <div class="relative">
                <input :type="showPwd3?'text':'password'" x-model="reset.password"
                  @input="checkStrength(reset.password,'reset')" required
                  class="w-full border border-slate-200 rounded px-4 py-2 focus:border-purple-500" />
                <button type="button" @click="showPwd3=!showPwd3"
                  class="absolute inset-y-0 right-2 flex items-center text-gray-500">
                  <template x-if="showPwd3">🙈</template><template x-if="!showPwd3">👁️</template>
                </button>
              </div>
              <div class="w-full bg-gray-200 h-2 rounded mt-2">
                <div :class="strengthBar(resetStrength).bg" :style="`width:${resetStrength}%`" class="h-2 rounded">
                </div>
              </div>
            </div>
            <div>
              <label class="block text-sm font-medium mb-1">Confirm Password <span
                  class="text-rose-500">*</span></label>
              <input :type="showPwd3?'text':'password'" x-model="reset.confirm" required
                class="w-full border border-slate-200 rounded px-4 py-2 focus:border-purple-500" />
            </div>
            <button type="submit" :disabled="loading"
              class="w-full bg-purple-600 text-white py-2 rounded hover:bg-purple-700 disabled:opacity-50 flex justify-center">
              <svg x-show="loading" class="w-5 h-5 mr-2 animate-spin">
                <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" fill="none" />
              </svg>
              Update Password
            </button>
          </form>
          <button @click="close()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 p-2">
            ✕
          </button>
        </div>
      </div>
    </template>
    <!-- Footer -->

    <footer class="bg-slate-900 text-slate-400">
      <div class="max-w-6xl mx-auto px-4 sm:px-6 py-16">
        <div class="grid grid-cols-1 md:grid-cols-5 gap-8 mb-12">
          <div class="md:col-span-2 space-y-4">
            <a href="index.html" aria-label="LTWCE SACCO">
              <img src="<?= base_url('assets/images/logo.png'); ?>" width="150" height="150" alt="LTWCE SACCO Logo" />
            </a>
            <p>Lubaga Together We Can</p>
          </div>

          <div>
            <h6 class="font-semibold mb-4 text-white">Member Services</h6>
            <ul class="space-y-2">
              <li>
                <a href="#overview" class="hover:text-white">Overview</a>
              </li>
              <li>
                <a href="#plans" class="hover:text-white">Plans</a>
              </li>
              <li>
                <a href="#branches" class="hover:text-white">Branches</a>
              </li>
            </ul>
          </div>

          <div>
            <h6 class="font-semibold mb-4 text-white">Support</h6>
            <ul class="space-y-2">
              <li><a href="#faqs" class="hover:text-white">FAQs</a></li>
              <li>
                <a href="#kb" class="hover:text-white">Knowledge Base</a>
              </li>
              <li>
                <a href="#contact" class="hover:text-white">Contact Us</a>
              </li>
            </ul>
          </div>

          <div>
            <h6 class="font-semibold mb-4 text-white">About</h6>
            <ul class="space-y-2">
              <li>
                <a href="about.html" class="hover:text-white">About Us</a>
              </li>
              <li>
                <a href="careers.html" class="hover:text-white">Careers</a>
              </li>
              <li>
                <a href="privacy.html" class="hover:text-white">Privacy Policy</a>
              </li>
            </ul>
          </div>
        </div>

        <div class="border-t border-slate-700 pt-6 flex flex-col md:flex-row items-center justify-between">
          <ul class="flex space-x-6 mb-4 md:mb-0">
            <li><a href="#" class="hover:text-white">Twitter</a></li>
            <li><a href="#" class="hover:text-white">Facebook</a></li>
            <li><a href="#" class="hover:text-white">Telegram</a></li>
            <li><a href="#" class="hover:text-white">GitHub</a></li>
          </ul>
          <p class="text-sm">&copy; 2025 LTWCE SACCO. All rights reserved.</p>
        </div>
      </div>
    </footer>
  </div>
  <!-- Vendor Scripts -->


  <!-- Main JavaScript -->
  <script src="<?= base_url('assets/js/vendors/aos.js') ?>"></script>


  <!-- Main JavaScript -->
  <script src="<?= base_url('assets/js/main.js') ?>"></script>
  <script defer src="https://static.cloudflareinsights.com/beacon.min.js/vcd15cbe7772f49c399c6a5babf22c1241717689176015"
    integrity="sha512-ZpsOmlRQV6y907TI0dKBHq9Md29nnaEIPlkf84rnaERnq6zvWvPUqr2ft8M1aS28oN72PdrCzSjY4U6VaAw1EQ=="
    data-cf-beacon='{"rayId":"955b15f3eeabb910","version":"2025.6.2","r":1}' crossorigin="anonymous"></script>

  <!-- Main JavaScript -->
  <script src="<?= base_url('assets/js/supportApp.js') ?>"></script>
</body>

</html>