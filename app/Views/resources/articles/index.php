<section class="relative">
  <div class="absolute inset-0 -z-10">
    <div class="absolute inset-0 bg-slate-900 opacity-90"></div>
    <img src="<?= base_url('assets/images/about-hero.jpg'); ?>" alt="Members meeting in Lubaga"
      class="w-full h-full object-cover opacity-40" />
  </div>

  <div class="relative max-w-6xl mx-auto px-4 sm:px-6">
    <div class="pt-32 pb-12 md:pt-40 md:pb-20 text-center">
      <h1 class="font-playfair text-slate-100 text-5xl md:text-6xl font-bold mb-6">
        Several People Are Typing
      </h1>
      <p class="text-xl text-slate-100 leading-snug mb-12 max-w-2xl mx-auto">
        Lessons designed to help you kick start and grow your business and turn your idea into a thriving empire.
      </p>

      <form class="flex flex-col md:flex-row items-center justify-center gap-4 max-w-md mx-auto">
        <input type="email" aria-label="Your email…" placeholder="Your email"
          class="w-full md:flex-1 px-4 py-3 bg-slate-800 border border-slate-700 rounded-lg text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500" />
        <button type="submit"
          class="w-full md:w-auto px-6 py-3 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700 transition-colors duration-200">
          Subscribe
        </button>
      </form>
    </div>
  </div>
</section>



<div x-data="articlesComponent()" x-init="init()" x-cloak>
  <section>
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
      <div class="flex items-center justify-between overflow-x-auto scrollbar-hide border-b border-slate-100 pb-4">
        <ul class="flex space-x-10">
          <template x-for="(section, index) in sections" :key="section.title">
            <li>
              <button :class="{'text-slate-800': activeTab === index, 'text-slate-500': activeTab !== index}"
                @click="selectTab(index)" class="font-medium whitespace-nowrap">
                <span x-text="section.title"></span>
              </button>
            </li>
          </template>
        </ul>
        <button aria-label="Search" class="flex-shrink-0 p-2">
          <svg class="w-5 h-5 text-slate-400 hover:text-slate-600 transition-colors" viewBox="0 0 16 16"
            fill="currentColor">
            <path
              d="M7 14c-3.86 0-7-3.14-7-7s3.14-7 7-7 7 3.14 7 7-3.14 7-7 7ZM7 2C4.243 2 2 4.243 2 7s2.243 5 5 5 5-2.243 5-5-2.243-5-5-5ZM15.707 14.293 13.314 11.9a8.019 8.019 0 0 1-1.414 1.414l2.393 2.393a.997.997 0 0 0 1.414 0 .999.999 0 0 0 0-1.414Z" />
          </svg>
        </button>
      </div>
    </div>
  </section>



  <section>
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
      <article class="flex flex-col md:flex-row md:space-x-8 items-start">
        <a href="blog-post.html" class="relative w-full md:w-1/2 overflow-hidden rounded-lg mb-6 md:mb-0"
          data-aos="fade-down">
          <img src="<?= base_url('assets/images/blog-post-01.jpg'); ?>" alt="News 01"
            class="w-full h-64 md:h-auto object-cover" width="540" height="340" />
          <div class="absolute top-6 right-6">
            <svg class="w-8 h-8 text-slate-900/50" viewBox="0 0 32 32" fill="currentColor">
              <circle cx="16" cy="16" r="16" fill-opacity="0.48" />
              <path
                d="M21.954 14.29A.5.5 0 0 0 21.5 14h-5.36l.845-3.38a.5.5 0 0 0-.864-.446l-6 7A.5.5 0 0 0 10.5 18h5.359l-.844 3.38a.5.5 0 0 0 .864.445l6-7a.5.5 0 0 0 .075-.534Z" />
            </svg>
          </div>
        </a>
        <div class="w-full md:w-1/2" data-aos="fade-up">
          <header class="mb-5">
            <h2 class="font-playfair text-4xl md:text-5xl font-bold text-slate-800">
              <a href="blog-post.html" class="hover:text-blue-600 transition-colors">
                How startups can sell more using smart channels
              </a>
            </h2>
          </header>
          <p class="text-lg text-slate-500 mb-6">
            Lorem ipsum dolor sit amet, consectetur elit, sed do eiusmod tempor incididunt.
          </p>
          <footer class="flex items-center space-x-3 text-sm text-slate-500">
            <a href="#0">
              <img src="<?= base_url('assets/images/news-author-01.jpg'); ?>" alt="Author 01"
                class="w-8 h-8 rounded-full object-cover" width="32" height="32" />
            </a>
            <div>
              <a href="#0" class="font-medium text-slate-800 hover:underline transition-colors">
                Patricia Williams
              </a>
              <span>·</span>
              <span>Sep 24, 2021</span>
            </div>
          </footer>
        </div>
      </article>
    </div>
  </section>


  <section class="bg-slate-50">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24 space-y-24">
      <template x-for="(sect, index) in sections" :key="sect.title">
        <div :id="sect.id">
          <h2 class="font-playfair text-3xl md:text-4xl font-bold text-slate-800 text-center md:text-left mb-8"
            x-text="sect.title"></h2>
          <div class="grid gap-12 lg:grid-cols-3">
            <template x-for="(art, i) in sect.articles" :key="art.id">
              <article class="flex flex-col h-full" data-aos="fade-up" :data-aos-delay="art.delay ?? sect.delayStep">
                <a :href="art.slug ? `/blog/${art.slug}.html` : `/blog.html?id=${art.id}`"
                  class="block overflow-hidden rounded-lg mb-4">
                  <img :src="art.imgSrc" :alt="art.imgAlt" class="w-full h-48 md:h-56 object-cover" :width="540"
                    :height="340" />
                </a>
                <div class="flex flex-col flex-1">
                  <header class="mb-3">
                    <h3 class="text-2xl font-bold text-slate-800">
                      <a :href="art.slug ? `/blog/${art.slug}.html` : `/blog.html?id=${art.id}`"
                        class="hover:text-blue-600 transition" x-text="art.headline"></a>
                    </h3>
                  </header>
                  <p class="text-lg text-slate-500 mb-6" x-text="art.excerpt"></p>
                  <footer class="mt-auto flex items-center space-x-3 text-sm text-slate-500">
                    <a href="#0">
                      <img :src="art.authorImg" :alt="art.authorAlt" class="w-8 h-8 rounded-full object-cover"
                        width="32" height="32" />
                    </a>
                    <div>
                      <a href="#0" class="font-medium text-slate-800 hover:underline transition"
                        x-text="art.authorName"></a>
                      <span>·</span>
                      <span x-text="art.date"></span>
                    </div>
                  </footer>
                </div>
              </article>
            </template>
          </div>
        </div>
      </template>
      <div data-aos="fade-up">
        <div
          class="relative bg-slate-900 rounded-lg overflow-hidden p-12 flex flex-col md:flex-row items-center text-center md:text-left">
          <img src="<?= base_url('assets/images/cta-image.png'); ?>" alt="Free trial"
            class="absolute left-0 bottom-0 w-1/2 opacity-10 pointer-events-none" width="456" height="337" />
          <div class="relative z-10 space-y-6 max-w-lg mx-auto">
            <h3 class="font-playfair text-2xl md:text-3xl font-bold text-white">
              Say goodbye to long queues, big updates, and
              <span class="text-blue-400">confusion</span>.
            </h3>
            <a href="#0"
              class="inline-flex items-center px-6 py-3 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700 transition">
              Start free trial &rarr;
            </a>
            <p class="text-sm text-slate-400">
              No credit card required. Cancel anytime!
            </p>
          </div>
        </div>
      </div>

      <div class="text-center">
        <a class="px-6 py-3 border border-slate-200 text-slate-800 rounded-lg hover:bg-slate-100 transition"
          href="<?= site_url('resources/articles/all') ?>">
          See All Articles &rarr;
        </a>
      </div>
    </div>
  </section>
</div>