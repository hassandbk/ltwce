<!-- Hero Section -->
<section class="relative">
  <!-- Background with dark overlay and hero image -->
  <div class="absolute inset-0 -z-10 pointer-events-none">
    <div class="relative h-[497px]" data-aos="fade">
      <!-- Dark overlay -->
      <div class="absolute inset-0 bg-slate-900 opacity-70 z-10"></div>

      <!-- Background image -->
      <img src="<?= base_url('assets/images/about-hero.jpg'); ?>" alt="Members meeting in Lubaga"
        class="w-full h-full object-cover opacity-90" />
    </div>
  </div>

  <!-- Text and image content -->
  <div class="relative max-w-6xl mx-auto px-4 sm:px-6 pt-32 md:pt-40 z-20">
    <!-- Heading -->
    <div class="text-center pb-16">
      <h1 class="font-playfair text-slate-100 text-4xl md:text-6xl font-bold leading-tight tracking-tight"
        data-aos="fade">
        Empowering Communities, One Savings at a Time
      </h1>
    </div>

    <!-- Hero image -->
    <div class="flex justify-center items-center" data-aos="fade-up" data-aos-delay="100">
      <img class="mx-auto" src="<?= base_url('assets/images/about-intro.jpg'); ?>" width="1024" height="576"
        alt="LTWCE members in workshop" />
    </div>
  </div>
</section>



<!-- Stats Section -->
<section class="relative z-10" x-data="saccoNumbersApp()" x-init="init()" x-cloak>
  <div class="max-w-6xl mx-auto px-4 sm:px-6">
    <div
      class="max-w-4xl mx-auto bg-gradient-to-r from-yellow-400 via-blue-500 to-slate-800 py-8 px-4 sm:px-6 shadow-xl rounded-lg">

      <div x-show="loading" class="text-center text-white py-4">
        <p>Loading key statistics...</p>
        <i class="fas fa-spinner fa-spin text-2xl mt-4"></i>
      </div>

      <div x-show="error" class="text-center text-red-300 py-4">
        <p>Error loading key statistics:</p>
        <p x-text="error"></p>
        <p class="text-sm mt-2">Please check the data source or try again.</p>
      </div>

      <ul x-show="!loading && !error && numbersData.stats.length"
        class="flex flex-col sm:flex-row justify-center text-center divide-y sm:divide-y-0 sm:divide-x divide-slate-600"
        data-aos="fade-up">
        <template x-for="(stat, index) in numbersData.stats.slice(0, 3)" :key="stat.id">
          <li class="w-full sm:w-1/3 px-4 py-4 sm:py-0" :data-aos-delay="(index + 1) * 150">
            <div class="font-dm-serif text-white text-4xl md:text-5xl font-bold mb-1" x-text="stat.value">
            </div>
            <div class="text-blue-200 text-sm sm:text-base font-medium" x-text="stat.title">
            </div>
          </li>
        </template>
      </ul>
    </div>
  </div>
</section>

<!-- Our Story -->
<section class="pt-12 pb-16 bg-gradient-to-b from-slate-50 to-white">
  <div class="max-w-4xl mx-auto px-4 sm:px-6">
    <div class="bg-white shadow-xl rounded-2xl overflow-hidden">
      <div class="bg-gradient-to-r from-yellow-400 via-blue-500 to-slate-800 px-6 py-6 sm:px-8 sm:py-8">
        <h2 class="font-dm-serif text-3xl sm:text-4xl lg:text-5xl text-white text-center" data-aos="fade-right">
          Our Story
        </h2>
      </div>
      <div class="px-6 py-8 sm:px-12 sm:py-12">
        <div class="prose prose-xl max-w-none text-slate-700 text-justify leading-relaxed mx-auto">
          <p>
            Back in 2014, a group of passionate entrepreneurs and
            community advocates in Lubaga, Kampala recognized a critical
            gap: access to fair, community‑driven financial services.
            United by the motto
            <strong class="text-gold-600 font-semibold not-prose">“Together We Can”</strong>, they founded the
            <strong class="text-blue-600 font-semibold not-prose">Empowerment Sacco (LTWCE)</strong>
            to uplift local families and small businesses through savings,
            loans, and shared expertise.
          </p>
          <p>
            What began as
            <span class="text-emerald-600 font-semibold not-prose">50 members</span>
            meeting under a mango tree has blossomed into a thriving
            cooperative of over
            <strong class="text-emerald-600 not-prose">3,500</strong> Ugandans. From
            market vendors in Wakaliga to artisans in Nateete, our members
            have launched enterprises, financed school fees, and built
            lasting financial security.
          </p>
          <p>
            At <span class="text-blue-600 font-semibold not-prose">LTWCE</span>,
            empowerment means more than just lending money—it’s about
            <span class="text-gold-600 font-medium not-prose">financial literacy workshops</span>, peer mentorship
            circles, and a
            network of support that
            spans every corner of Lubaga. Every share, every vote, and
            every success story belongs to
            <span class="text-emerald-600 font-semibold not-prose">you—our community</span>.
          </p>
          <p class="font-semibold text-slate-800">
            — The LTWCE “Together We Can” Team
          </p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- LOCATIONS SECTION -->
<section class="bg-slate-100" x-data="locationsComponent()" x-init="init()" x-cloak>
  <div class="max-w-6xl mx-auto px-4 sm:px-6">
    <div class="pt-12 md:pt-20">
      <div class="text-center max-w-3xl mx-auto pb-12 md:pb-20">
        <h2 class="font-playfair-display text-slate-800 text-4xl md:text-5xl font-bold" x-text="mainHeading">
        </h2>
      </div>
    </div>
  </div>

  <div class="relative left-1/2 transform -translate-x-1/2 w-[110vw]">
    <div class="px-4 sm:px-6">
      <div class="flex flex-wrap -mx-2 md:-mx-4">
        <template x-for="(imagePath, index) in imageGallery" :key="index">
          <div :class="{
            'w-full sm:w-1/2 lg:w-1/3 px-2 md:px-4 mb-4 md:mb-0': true,
            'hidden sm:block': index === 2 && imageGallery.length === 2, /* Example for specific visibility based on count */
          }" :data-aos="index === 0 ? 'fade-right' : (index === 1 ? 'fade' : 'fade-left')"
            :data-aos-delay="(index + 1) * 100">
            <div class="relative overflow-hidden rounded-lg">
              <img :src="imagePath" :alt="'Team ' + (index + 1)" class="w-full h-60 md:h-72 object-cover" />
              <template x-if="index === 0">
                <div class="absolute inset-y-0 left-0 w-11/12 bg-gradient-to-r from-white to-transparent opacity-90"
                  aria-hidden="true"></div>
              </template>
              <template x-if="index === imageGallery.length - 1">
                <div class="absolute inset-y-0 right-0 w-11/12 bg-gradient-to-l from-white to-transparent opacity-90"
                  aria-hidden="true"></div>
              </template>
            </div>
          </div>
        </template>
      </div>
    </div>
  </div>

  <div class="max-w-6xl mx-auto px-4 sm:px-6 relative">
    <div class="py-12 md:py-20">
      <div class="hidden md:block absolute left-1/2 top-0 -mt-4 -ml-px bg-slate-300 w-0.5 h-12" aria-hidden="true">
      </div>

      <div x-show="loading" class="text-center text-slate-500 py-8">
        <p>Loading locations...</p>
        <i class="fas fa-spinner fa-spin text-2xl mt-4"></i>
      </div>

      <div x-show="error" class="text-center text-red-600 py-8">
        <p x-text="error"></p>
        <p>Please check your internet connection or try again later.</p>
      </div>

      <div x-show="!loading && !error && locations.length"
        class="grid md:grid-cols-3 max-w-sm md:max-w-none mx-auto mb-12 md:mb-20 gap-12 items-start text-center">
        <template x-for="(location, idx) in locations" :key="location.id">
          <div class="flex flex-col items-center text-center h-full" data-aos="fade-up"
            :data-aos-delay="location.aosDelay">
            <div class="inline-flex w-16 h-16 mb-4">
              <svg class="w-full h-full" width="62" height="61" viewBox="0 0 62 61">
                <path :d="location.iconPath"></path>
              </svg>
            </div>
            <h4 class="font-playfair-display text-slate-800 text-2xl font-bold mb-2" x-text="location.city"></h4>
            <p class="text-slate-600 mb-2" x-text="location.description"></p>
            <div class="text-sm text-slate-800" x-text="location.open_positions + ' open positions'"></div>
          </div>
        </template>
      </div>

      <div x-show="!loading && !error && locations.length" class="text-center">
        <button
          class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-medium rounded transition hover:bg-blue-700">
          See Open Positions
          <span class="ml-2">→</span>
        </button>
      </div>
    </div>
  </div>
</section>

<!-- TEAM SECTION -->
<section class="bg-white" x-data="teamComponent()" x-init="init()" x-cloak>
  <div class="max-w-6xl mx-auto px-4 sm:px-6">
    <div class="py-12 md:py-20">
      <div class="max-w-3xl mx-auto text-center pb-12 md:pb-20">
        <h2 class="font-playfair-display text-slate-800 text-4xl md:text-5xl font-bold mb-4" x-text="mainHeading"></h2>
        <p class="text-xl text-slate-600" x-text="subHeading"></p>
      </div>

      <div x-show="loading" class="text-center text-slate-500 py-8">
        <p>Loading team members...</p>
        <i class="fas fa-spinner fa-spin text-2xl mt-4"></i>
      </div>

      <div x-show="error" class="text-center text-red-600 py-8">
        <p x-text="error"></p>
        <p>Please try again later or contact support.</p>
      </div>

      <div x-show="!loading && !error && team.length"
        class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8 md:gap-y-12">
        <template x-for="member in team" :key="member.id">
          <div class="flex flex-col items-center" data-aos="fade-up" :data-aos-delay="member.aosDelay">
            <img class="rounded-full mb-4" :src="member.imgSrc" width="120" height="120" :alt="member.imgAlt" />
            <h4 class="h4 mb-2 text-slate-800" x-text="member.name"></h4>
            <p class="text-slate-600 text-center" x-text="member.role"></p>
          </div>
        </template>
      </div>
    </div>
  </div>
</section>



<!-- INVESTORS SECTION -->
<section class="bg-slate-900" x-data="investorsComponent()" x-init="init()" x-cloak>
  <div class="max-w-6xl mx-auto px-4 sm:px-6 py-12 md:py-20">
    <div class="text-center max-w-3xl mx-auto pb-12">
      <h2 class="font-playfair-display text-white text-4xl md:text-5xl font-bold" x-text="mainHeading">
      </h2>
    </div>

    <div x-show="loading" class="text-center text-slate-500 py-8">
      <p>Loading investors...</p>
      <i class="fas fa-spinner fa-spin text-2xl mt-4"></i>
    </div>

    <div x-show="error" class="text-center text-red-600 py-8">
      <p x-text="error"></p>
      <p>Please try again later or contact support.</p>
    </div>

    <div x-show="!loading && !error && investors.length" class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">
      <template x-for="client in investors" :key="client.id">
        <div
          class="group relative bg-white border border-slate-200 p-4 h-24 flex items-center justify-center overflow-hidden"
          data-aos="fade-up" :data-aos-delay="client.aosDelay">
          <img :src="client.logo" :alt="client.name" class="h-full w-full object-contain" />
          <div class="absolute inset-0 bg-slate-200/50 group-hover:bg-transparent transition-colors duration-200"></div>
        </div>
      </template>
    </div>
  </div>
</section>

<!-- CALL TO ACTION -->
<?= view('partials/call_to_action'); ?>