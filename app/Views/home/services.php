<section class="relative pt-16">
  <img src="<?= base_url('assets/images/about-hero.jpg'); ?>" alt="Members meeting in Lubaga"
    class="w-full h-full object-cover opacity-90 absolute inset-0 z-0" />
  <div class="absolute inset-0 bg-slate-900 opacity-60 z-1"></div>
  <div class="relative z-10 text-white py-12">
    <div class="max-w-4xl mx-auto px-4 text-center">
      <h1 class="text-4xl md:text-5xl font-bold mb-4">
        All SACCO Services & Community Projects
      </h1>
      <p class="text-lg mb-6">
        Explore every program we offer to empower Lubaga—click any card to
        learn more.
      </p>
      <a href="index.html" class="inline-block mt-6 px-5 py-3 bg-blue-600 rounded hover:bg-blue-700 transition">
        ← Back to Home
      </a>
    </div>
  </div>
</section>

<section class="max-w-6xl mx-auto px-4 py-12">
  <div x-data="servicesListComponent()" x-init="init()" x-cloak>

    <div class="flex justify-center mt-4 mb-4 md:mb-6 hidden md:flex">
      <button @click="toggleView" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
        <i :class="gridView ? 'fas fa-th-list' : 'fas fa-th'"></i>
      </button>
    </div>

    <div :class="gridView ? 'grid gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4' : 'flex flex-col gap-6'"
      x-show="services.length && !loading">
      <template x-for="(svc, i) in pagedServices" :key="svc.id">
        <div class="relative bg-cover bg-center rounded-lg overflow-hidden shadow-lg"
          :style="`background-image: url('${svc.img}')`" data-aos="fade-up" :data-aos-delay="svc.aosDelay">
          <div class="absolute inset-0 bg-black/50"></div>
          <div class="relative p-6 flex flex-col h-full justify-between text-white">
            <div>
              <h2 class="text-2xl font-bold mb-2">
                <a :href="svc.slug ? `/services/${svc.slug}.html` : `/services.html?id=${svc.id}`"
                  class="hover:underline" x-text="svc.title"></a>
              </h2>
              <p class="text-sm mb-4" x-text="svc.desc"></p>
            </div>
            <div class="flex items-center justify-between">
              <a :href="svc.slug ? `/services/${svc.slug}.html` : `/services.html?id=${svc.id}`"
                class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg font-medium transition">
                Learn More →
              </a>
            </div>
          </div>
        </div>
      </template>
    </div>

    <div class="flex flex-col justify-center items-center mt-6">
      <div class="flex justify-center mb-4 md:hidden">
        <button @click="toggleView" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
          <i :class="gridView ? 'fas fa-th-list' : 'fas fa-th'"></i>
        </button>
      </div>

      <div class="flex justify-center">
        <button @click="servicesPrevPage" :disabled="currentPage === 1"
          class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
          Prev
        </button>
        <span class="px-4 py-2 text-lg text-slate-600"
          x-text="'Page ' + currentPage + ' of ' + servicesPageCount"></span>
        <button @click="servicesNextPage" :disabled="currentPage === servicesPageCount"
          class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
          Next
        </button>
      </div>

    </div>
  </div>
</section>