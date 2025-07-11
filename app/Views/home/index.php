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



<!-- SOLUTIONS GRID SECTION -->
<section class="py-16 md:py-24 bg-white" x-data="solutionsGridApp()" x-init="init()" x-cloak>
  <div class="container mx-auto px-4">

    <div x-show="loading" class="text-center text-slate-500 py-8">
      <p>Loading solutions...</p>
      <i class="fas fa-spinner fa-spin text-2xl mt-4"></i>
    </div>

    <div x-show="error" class="text-center text-red-600 py-8">
      <p x-text="error"></p>
      <p>Please try again later or contact support.</p>
    </div>

    <div x-show="!loading && !error">
      <div class="max-w-3xl mx-auto text-center pb-12 md:pb-16">
        <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-slate-800 mb-4" x-text="solutionsData.mainHeading">
        </h2>
        <p class="mt-4 text-lg text-slate-500" x-text="solutionsData.subDescription">
        </p>
      </div>

      <div aria-hidden="true" class="relative mb-12">
        <div class="absolute inset-0 flex justify-center space-x-4 opacity-20">
          <span class="block w-1 h-32 bg-slate-200 rounded"></span>
          <span class="block w-1 h-32 bg-slate-200 rounded"></span>
          <span class="block w-1 h-32 bg-slate-200 rounded"></span>
          <span class="block w-1 h-32 bg-slate-200 rounded"></span>
        </div>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-12" data-aos-id-blocks>
        <template x-for="f in solutionsData.features" :key="f.id">
          <div
            class="group flex flex-col items-center text-center space-y-4 p-6 rounded-lg hover:shadow-lg transition-shadow duration-300"
            data-aos="fade-up" data-aos-anchor="[data-aos-id-blocks]" :data-aos-delay="f.aosDelay">
            <div
              class="w-16 h-16 rounded-full flex items-center justify-center transform transition-transform duration-200 group-hover:scale-110"
              :class="f.bg"> <i :class="`${f.icon} text-2xl transition-colors duration-200 ${f.fg}`"></i> </div>
            <h3 class="text-xl font-semibold transition-colors duration-200 group-hover:text-blue-600" x-text="f.title">
            </h3>
            <p class="text-slate-600 max-w-xs transition-colors duration-200 group-hover:text-slate-800"
              x-text="f.description"></p>
          </div>
        </template>
      </div>
    </div>
  </div>
</section>



<!-- SERVICES CAROUSEL -->
<section class="relative w-full bg-slate-900 py-12" x-data="servicesCarouselComponent()" x-init="init()" x-cloak>
  <div class="max-w-7xl mx-auto px-4 sm:px-6">
    <div class="text-center mb-8">
      <h2 class="text-3xl font-bold text-white">Our Services</h2>
    </div>

    <div x-show="loading" class="text-center text-slate-500 py-8">
      <p>Loading services...</p>
      <i class="fas fa-spinner fa-spin text-2xl mt-4"></i>
    </div>

    <div x-show="error" class="text-center text-red-600 py-8">
      <p x-text="error"></p>
      <p>Please check your internet connection or try again later.</p>
    </div>

    <template x-if="!loading && !error && services.length">
      <div @mouseenter="pauseCarousel()" @mouseleave="playCarousel()" class="relative overflow-hidden">
        <div
          class="absolute inset-y-0 left-0 w-24 bg-gradient-to-r from-slate-900 to-transparent z-10 pointer-events-none">
        </div>
        <div
          class="absolute inset-y-0 right-0 w-24 bg-gradient-to-l from-slate-900 to-transparent z-10 pointer-events-none">
        </div>

        <div x-ref="track" class="flex space-x-6 will-change-transform" :style="{
             animation: `scroll-left ${carouselDuration}s linear infinite`,
             'animation-play-state': playing ? 'running' : 'paused'
           }">
          <template x-for="(svc,i) in loopedServices" :key="i">
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

    <div class="text-center mt-8" x-show="!loading && !error && services.length">
      <a href="services.html" class="px-6 py-3 bg-yellow-500 text-white rounded hover:bg-yellow-600 transition">
        View More
      </a>
    </div>
  </div>
</section>



<!-- FEATURE TABS SECTION -->
<!-- Section: Everything You Need, One Portal -->
<section class="relative bg-white" x-data="featureTabsComponent()" x-init="init()">
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

      <!-- Feature Tabs -->
      <div class="space-y-8" x-cloak>
        <!-- Tab buttons -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-8">
          <!-- Iterate over the 'tabs' array from the component's state -->
          <template x-for="(t, idx) in tabs" :key="t.id">
            <button @click="selectTab(idx)" :class="activeTab === idx ? 'text-slate-800' : 'text-slate-500'"
              class="group flex flex-col items-center space-y-2 focus:outline-none" x-bind:data-aos="`fade-down`"
              x-bind:data-aos-delay="t.aosDelay">
              <div
                :class="activeTab === idx ? 'bg-yellow-200' : 'bg-white opacity-50 hover:opacity-100 hover:bg-yellow-50'"
                class="w-16 h-16 flex items-center justify-center rounded-full shadow transition-colors duration-200">
                <i
                  :class="`${t.icon} text-2xl transition-transform duration-300 group-hover:scale-110 group-hover:-rotate-3 ${activeTab === idx ? 'text-blue-600' : 'text-gray-400'}`"></i>
              </div>
              <span class="font-semibold leading-tight" x-text="t.label"></span>
            </button>
          </template>
        </div>

        <!-- Tab panels -->
        <div class="relative flex flex-col items-center">
          <!-- Iterate over the 'tabs' array for panels -->
          <template x-for="(t, idx) in tabs" :key="t.id">
            <div x-show="activeTab === idx" x-transition x-bind:data-aos="`fade-up`"
              x-bind:data-aos-delay="t.aosDelay + 200" class="flex justify-center">
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




<!-- FEATURES SECTION -->

<section x-data="featuresSectionApp()" x-init="init()">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8  flex items-center">
    <div class="border-t border-slate-200 pt-12 sm:pt-20 pb-12 sm:pb-20 w-full">

      <div class="text-center mb-12 sm:mb-20">
        <h2 class="font-playfair-display text-4xl sm:text-5xl font-bold text-slate-800"
          x-text="featuresData.mainHeading">
        </h2>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 gap-8 items-center">

        <div class="w-full flex justify-center sm:justify-start order-2 sm:order-1" data-aos="fade-down">
          <div class="relative w-full max-w-lg sm:max-w-full lg:max-w-xl xl:max-w-2xl 2xl:max-w-3xl"
            style="padding-top: 114.814814815%;">
            <template x-for="item in featuresData.items" :key="item.id">
              <div class="absolute inset-0 flex items-center justify-center" x-show="activeFeatureTabId === item.id"
                x-transition:enter="transition ease-in-out duration-1500" x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in-out duration-1500"
                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" x-cloak>
                <div class="relative w-full h-full aspect-[54/62]">
                  <img class="w-full h-full object-contain rounded-lg"
                    :src="`<?= base_url('assets/images/'); ?>${item.image}`" width="540" height="620" :alt="item.alt">
                </div>
              </div>
            </template>
          </div>
        </div>

        <div class="w-full sm:w-full order-1 sm:order-2" data-aos="fade-up">
          <div class="text-center sm:text-left mb-8 sm:mb-12">
            <h3 class="font-playfair-display text-3xl sm:text-4xl font-bold text-slate-800 mb-6"
              x-text="featuresData.subHeading">
            </h3>
            <p class="text-xl text-slate-500" x-text="featuresData.subDescription">
            </p>
          </div>

          <div class="flex gap-4 sm:gap-6 justify-center sm:justify-start flex-wrap">
            <template x-for="item in featuresData.items" :key="item.id">
              <button
                :class="activeFeatureTabId !== item.id ? 'opacity-50 border-transparent hover:bg-slate-100' : 'border-2 border-blue-500 bg-white text-slate-800 shadow-md ring-2 ring-blue-500 hover:bg-blue-100 transition-all'"
                class="flex items-start p-6 rounded-lg transition duration-300 transform hover:scale-105 w-full sm:w-full"
                @click="setFeatureTab(item.id)">
                <svg class="w-8 h-8 text-blue-500 mr-4" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                  <path fill="currentColor" d="M9.4 6.6c.8.8.8 2 0 2.8-.8.8-2 .8-2.8 0-.8-.8-5-7.8-5-7.8s7 4.2 7.8 5Z">
                  </path>
                  <path fill="currentColor"
                    d="M8 16c-4.4 0-8-3.6-8-8 0-.6.4-1 1-1s1 .4 1 1c0 3.3 2.7 6 6 6s6-2.7 6-6-2.7-6-6-6c-.6 0-1-.4-1-1s.4-1 1-1c4.4 0 8 3.6 8 8s-3.6 8-8 8Z">
                  </path>
                </svg>
                <div>
                  <div class="font-semibold" x-text="item.heading"></div>
                  <div class="text-sm text-slate-400" x-text="item.description"></div>
                </div>
              </button>
            </template>
          </div>
        </div>

      </div>
    </div>
  </div>
</section>


<!-- FEATURE CARD SECTION -->
<section class="relative overflow-hidden" x-data="featureCardsApp()" x-init="init()">
  <div aria-hidden="true"
    class="absolute inset-x-0 top-0 h-120 bg-slate-900 pointer-events-none -z-10 [clip-path:polygon(0_0,5760px_0,5760px_calc(100%_-_352px),0_100%)]">
  </div>

  <div class="relative z-20 text-center pt-16 pb-4">
    <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white" x-text="featureCardsData.mainHeading">
    </h2>
    <p class="mt-4 text-lg text-slate-300 max-w-2xl mx-auto" x-text="featureCardsData.subDescription">
    </p>
  </div>

  <div class="container mx-auto px-4 relative z-20 grid gap-8 grid-cols-1 md:grid-cols-2 lg:grid-cols-3 pb-16">
    <template x-for="(card, index) in featureCardsData.cards" :key="card.id">
      <article class="relative max-w-sm mx-auto group" :data-aos="card.aos || 'fade-up'"
        :data-aos-delay="(index * 100).toString()">
        <div
          class="absolute inset-0 rounded-lg border border-gray-300 opacity-0 group-hover:opacity-50 transition-opacity duration-300 translate-x-4 translate-y-4 -z-10">
        </div>
        <div
          class="bg-white rounded-lg overflow-hidden shadow-lg transform transition duration-300 group-hover:scale-105 group-hover:shadow-md">
          <div
            :class="`absolute top-0 left-0 -translate-y-1/2 -translate-x-1/2 w-16 h-16 bg-blue-500 text-white rounded-full flex items-center justify-center font-bold text-2xl z-10 ring-4 ring-white ring-offset-2 ring-offset-gray-100 transition-all duration-300 group-hover:left-1/2 group-hover:top-1/2 group-hover:-translate-x-1/2 group-hover:-translate-y-1/2 group-hover:bg-${card.badgeHoverColorClass}`"
            x-text="card.badgeNumber">
          </div>
          <img :src="card.image" :alt="card.alt" class="w-full block" />
          <div class="p-6 text-left">
            <h3 class="text-xl font-semibold text-slate-900 mb-2" x-text="card.title">
            </h3>
            <p class="text-sm text-slate-600" x-text="card.description">
            </p>
          </div>
        </div>
      </article>
    </template>
  </div>
</section>

<!-- SACCO NUMBER SECTION -->
<section class="py-16 bg-slate-50" x-data="saccoNumbersApp()" x-init="init()">
  <div class="max-w-6xl mx-auto px-4 sm:px-6">
    <div class="text-center max-w-2xl mx-auto mb-12">
      <h2 class="font-playfair text-3xl md:text-4xl font-bold text-slate-800" x-text="numbersData.mainHeading">
      </h2>
      <p class="mt-4 text-lg text-slate-600" x-text="numbersData.subDescription">
      </p>
    </div>
    <div class="flex flex-col lg:flex-row items-center gap-12">
      <ul class="flex-1 space-y-8" data-aos="fade-right">
        <template x-for="stat in numbersData.stats" :key="stat.id">
          <li class="flex items-start space-x-4">
            <svg class="w-16 h-16 flex-shrink-0" :class="stat.iconColorClass" fill="currentColor" viewBox="0 0 16 16">
              <path :d="stat.iconPath"></path>
            </svg>
            <div>
              <div class="text-4xl md:text-5xl font-bold text-slate-800" x-text="stat.value">
              </div>
              <p class="text-lg text-slate-600" x-text="stat.description">
              </p>
            </div>
          </li>
        </template>
      </ul>
      <div class="flex-1" data-aos="fade-left">
        <img :src="numbersData.illustrationImage" :alt="numbersData.illustrationAlt"
          class="w-full rounded-lg shadow-lg" />
      </div>
    </div>
  </div>
</section>


<!-- MEMBERSHIP TIERS SECTION -->
<section x-data="membershipTiersApp()" class="bg-white">
  <div class="bg-slate-900 pt-20 pb-32 text-center">
    <h2 class="font-playfair text-4xl md:text-5xl font-bold text-white" x-text="tiersData.mainHeading"></h2>
    <p class="mt-4 text-lg text-slate-300 max-w-2xl mx-auto" x-html="tiersData.subDescription"></p>

    <div class="mt-8 flex justify-center items-center gap-4">
      <span class="text-slate-300" x-text="tiersData.toggleLabels.fee"></span>
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
      <span class="text-slate-300" x-text="tiersData.toggleLabels.shares"></span>
    </div>
  </div>

  <div class="relative -mt-24 z-10 px-4">
    <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-8 pb-20">
      <div x-show="loading" class="md:col-span-3 text-center text-slate-700 text-lg py-10">
        Loading membership tiers...
      </div>

      <template x-for="tier in tiersData.tiers" :key="tier.id">
        <div x-show="!loading"
          class="relative bg-white rounded-lg shadow-xl transform transition hover:scale-105 hover:shadow-2xl p-6"
          data-aos="fade-up" :data-aos-delay="tier.aosDelay">
          <div x-show="tier.isPopular"
            class="absolute -top-3 left-1/2 -translate-x-1/2 bg-green-400 text-slate-900 px-4 py-1 rounded-full font-medium">
            Most Popular
          </div>
          <h3 class="text-xl font-semibold text-slate-800 mb-4" :class="{ 'mt-4': tier.isPopular }" x-text="tier.name">
          </h3>
          <div class="flex items-baseline mb-4">
            <span x-show="!showShares" class="flex items-baseline">
              <span class="text-lg text-slate-500 mr-1">UGX</span>
              <span class="text-4xl font-bold text-slate-900" x-text="formatNumber(tier.fee)"></span>
              <span class="ml-1 text-slate-500">/member</span>
            </span>
            <span x-show="showShares" class="flex flex-col">
              <div class="flex items-baseline">
                <span class="text-4xl font-bold text-slate-900" x-text="tier.shares"></span>
                <span class="text-lg text-slate-500 ml-1">shares</span>
              </div>
              <span class="text-sm text-slate-500"
                x-text="`Total UGX\u00a0${formatNumber(tier.shares * tiersData.sharesPricePerUnit)}`"></span>
            </span>
          </div>
          <p class="text-slate-600 mb-6" x-text="tier.description"></p>
          <ul class="space-y-2 mb-6 text-slate-600">
            <template x-for="feature in tier.features" :key="feature">
              <li x-text="`✅ ${feature}`"></li>
            </template>
          </ul>
          <a :href="tier.link"
            class="block text-center bg-yellow-500 text-white font-semibold px-4 py-2 rounded hover:bg-yellow-600 transition">
            <span x-show="!showShares" x-text="tier.callToActionTextFee"></span>
            <span x-show="showShares" x-text="tier.callToActionTextShares"></span>
          </a>
        </div>
      </template>
    </div>
  </div>
</section>



<!-- CALL TO ACTION -->

<?= view('partials/call_to_action'); ?>