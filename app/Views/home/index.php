<!-- Hero Section -->
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
          <div class="flex flex-col sm:flex-row sm:space-x-4 space-y-4 sm:space-y-0 justify-center md:justify-start">
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
        <div x-data="{ open: false }" class="mt-12 md:mt-0 w-full md:w-1/2 flex justify-center" data-aos="fade-left">
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
            <div x-show="open" x-cloak @click="open = false" class="fixed inset-0 bg-black bg-opacity-75 z-40"></div>

            <!-- Modal dialog -->
            <div x-show="open" x-cloak class="fixed inset-0 flex items-center justify-center z-50 p-4">
              <div @click.away="open = false" @keydown.escape.window="open = false"
                class="bg-black rounded-lg overflow-hidden shadow-lg max-w-3xl w-full">
                <video x-init="$watch('open', val => val ? $el.play() : $el.pause())" class="w-full h-auto" controls
                  loop>
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
          <h3 class="text-xl font-semibold transition-colors duration-200 group-hover:text-blue-600" x-text="f.title">
          </h3>
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
              <div :class="tab === t.id ? 'bg-yellow-200' : 'bg-white opacity-50 hover:opacity-100 hover:bg-yellow-50'"
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
      <div class="relative bg-white rounded-lg shadow-xl transform transition hover:scale-105 hover:shadow-2xl p-6"
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