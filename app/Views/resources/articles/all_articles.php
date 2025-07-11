<section class="relative pt-16">
  <img src="<?= base_url('assets/images/about-hero.jpg'); ?>" alt="Members meeting in Lubaga"
    class="w-full h-full object-cover opacity-90 absolute inset-0 z-0" />
  <div class="absolute inset-0 bg-slate-900 opacity-60 z-1"></div>
  <div class="relative z-10 text-white py-12">
    <div class="max-w-4xl mx-auto px-4 text-center">
      <h1 class="text-4xl md:text-5xl font-bold mb-4">
        All Articles
      </h1>
      <p class="text-lg mb-6">
        Browse our latest insights, tips, and news to help you grow and thrive.
      </p>
      <a href="#filters" class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg transition">
        Filter Articles ↓
      </a>
    </div>
  </div>
</section>

<section class="max-w-6xl mx-auto px-4 py-12">
  <div x-data="allArticlesComponent()" x-init="init()" x-cloak class="relative flex flex-col lg:flex-row lg:space-x-6">

    <aside class="lg:fixed lg:top-60 lg:left-4 lg:w-120 lg:z-20
         p-4 space-y-6
         bg-slate-700 rounded-lg shadow-xl border border-slate-600
         h-auto  lg:overflow-y-auto">
      <div id="filters" class="bg-slate-800 rounded-lg shadow-lg p-4 space-y-4 text-white">
        <div>
          <label for="search" class="block text-sm font-medium mb-1 text-slate-300">Search</label>
          <div class="relative">
            <input id="search" type="text" x-model="filters.query" @input="applyFilters()"
              placeholder="Search articles..." class="w-full border border-slate-500 rounded-lg pl-10 pr-3 py-2
                 bg-slate-700 text-white placeholder-slate-400
                 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent" />
            <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-slate-400"></i>
          </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div>
            <label for="fromDate" class="block text-sm font-medium mb-1 text-slate-300">From</label>
            <input id="fromDate" type="date" x-model="filters.from" @change="applyFilters()" class="w-full border border-slate-500 rounded-lg px-3 py-2
                 bg-slate-700 text-white
                 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent" />
          </div>

          <div>
            <label for="toDate" class="block text-sm font-medium mb-1 text-slate-300">To</label>
            <input id="toDate" type="date" x-model="filters.to" @change="applyFilters()" class="w-full border border-slate-500 rounded-lg px-3 py-2
                 bg-slate-700 text-white
                 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent" />
          </div>
        </div>
        <button @click="resetFilters()"
          class="w-full bg-slate-600 hover:bg-slate-500 text-white font-medium px-4 py-2 rounded-lg transition duration-200 ease-in-out">
          Reset Filters
        </button>
      </div>

      <div class="bg-slate-800 rounded-lg shadow-lg p-4 flex justify-around text-white">
        <button @click="viewMode = 'list'; currentPage = 1"
          :class="viewMode === 'list' ? 'text-blue-400 font-bold' : 'text-slate-300 hover:text-blue-300'">
          List View
        </button>
        <button @click="viewMode = 'grid'; currentPage = 1"
          :class="viewMode === 'grid' ? 'text-blue-400 font-bold' : 'text-slate-300 hover:text-blue-300'">
          Grid View
        </button>
      </div>

      <div class="bg-slate-800 rounded-lg shadow-lg p-4 space-y-2 text-white">
        <div class="flex justify-between items-center">
          <button @click="currentPage--" :disabled="currentPage === 1"
            class="px-3 py-1 bg-slate-600 text-white rounded disabled:opacity-50 disabled:cursor-not-allowed hover:bg-slate-500 transition duration-200 ease-in-out">
            ‹ Prev
          </button>
          <button @click="currentPage++" :disabled="currentPage === pageCount"
            class="px-3 py-1 bg-slate-600 text-white rounded disabled:opacity-50 disabled:cursor-not-allowed hover:bg-slate-500 transition duration-200 ease-in-out">
            Next ›
          </button>
        </div>
        <div class="flex flex-wrap justify-center gap-1">
          <template x-for="n in pageCount" :key="n">
            <button @click="currentPage = n"
              :class="n === currentPage
                      ? 'px-3 py-1 bg-blue-500 text-white rounded shadow-md'
                      : 'px-2 py-1 bg-slate-700 hover:bg-slate-600 text-slate-200 rounded transition duration-200 ease-in-out'">
              <span x-text="n"></span>
            </button>
          </template>
        </div>
        <div class="text-center text-sm text-slate-400">
          <span x-text="'Page ' + currentPage + ' of ' + pageCount"></span>
        </div>
      </div>
    </aside>

    <section class="flex-1 space-y-12 lg:ml-[calc(theme(space.4)+theme(spacing.64)+theme(space.6))]">
      <ul x-show="viewMode === 'list'" class="space-y-12">
        <template x-for="art in pagedItems" :key="art.id">
          <li class="relative bg-cover bg-center rounded-lg overflow-hidden shadow-lg h-64 md:h-80"
            :style="`background-image: url('${art.imgSrc}')`" data-aos="fade-up">
            <div class="absolute inset-0 bg-black/50"></div>
            <div class="relative p-6 flex flex-col h-full justify-between text-white">
              <div>
                <h2 class="text-2xl font-bold mb-2">
                  <a :href="linkFor(art)" class="hover:underline" x-text="art.headline"></a>
                </h2>
                <p class="text-sm mb-4 line-clamp-3" x-text="art.excerpt"></p>
              </div>
              <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                  <img :src="art.authorImg" :alt="art.authorAlt"
                    class="w-10 h-10 rounded-full border-2 border-white object-cover" />
                  <div class="text-sm">
                    <div x-text="art.authorName"></div>
                    <div x-text="art.date"></div>
                  </div>
                </div>
                <a :href="linkFor(art)"
                  class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg font-medium transition">Read more
                  →</a>
              </div>
            </div>
          </li>
        </template>
      </ul>

      <ul x-show="viewMode === 'grid'" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <template x-for="art in pagedItems" :key="art.id">
          <li class="relative bg-cover bg-center rounded-lg overflow-hidden shadow-lg h-64"
            :style="`background-image: url('${art.imgSrc}')`" data-aos="fade-up">
            <div class="absolute inset-0 bg-black/50"></div>
            <div class="relative p-4 flex flex-col h-full justify-between text-white">
              <div>
                <h3 class="text-xl font-semibold mb-1">
                  <a :href="linkFor(art)" x-text="art.headline" class="hover:underline line-clamp-2"></a>
                </h3>
                <p class="text-sm mb-3 line-clamp-3" x-text="art.excerpt"></p>
              </div>
              <div class="flex items-center justify-between">
                <div class="flex items-center space-x-2">
                  <img :src="art.authorImg" :alt="art.authorAlt"
                    class="w-8 h-8 rounded-full border-2 border-white object-cover" />
                  <div class="text-xs">
                    <div x-text="art.authorName"></div>
                    <div x-text="art.date"></div>
                  </div>
                </div>
                <a :href="linkFor(art)"
                  class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded font-medium text-sm transition">
                  Read →</a>
              </div>
            </div>
          </li>
        </template>
      </ul>

      <template x-if="!loading && filteredArticles.length === 0">
        <p class="text-center text-slate-500 text-lg py-12">
          No articles found matching your criteria. Try adjusting your filters.
        </p>
      </template>

      <template x-if="loading">
        <p class="text-center text-blue-500 text-lg py-12">
          Loading articles... Please wait.
        </p>
      </template>

      <template x-if="error">
        <p class="text-center text-red-500 text-lg py-12">
          Error: <span x-text="error"></span>
        </p>
      </template>
    </section>
  </div>
</section>