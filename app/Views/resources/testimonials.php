<div x-data="testimonialsComponent()" x-init="init()" x-cloak>
  <template x-if="loading">
    <div class="flex justify-center items-center h-screen bg-gray-100">
      <div class="text-center">
        <p class="text-xl text-blue-600 mb-4">Loading page content...</p>
        <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-500 mx-auto"></div>
      </div>
    </div>
  </template>

  <template x-if="!loading && error">
    <div class="flex justify-center items-center h-screen bg-red-50">
      <div class="text-center p-8 border border-red-300 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold text-red-700 mb-4">Oops! Something went wrong.</h2>
        <p class="text-lg text-red-600">Error: <span x-text="error"></span></p>
        <p class="text-md text-red-500 mt-2">Please try refreshing the page.</p>
      </div>
    </div>
  </template>

  <template x-if="!loading && pageContent">
    <div>
      <section class="relative">
        <div aria-hidden="true"
          class="absolute inset-0 bg-slate-900 pointer-events-none -z-10 [clip-path:polygon(0_0,5760px_0,5760px_calc(100%_-_352px),0_100%)]">
        </div>

        <div class="max-w-6xl relative mx-auto px-4 sm:px-6 lg:px-8">
          <div class="pt-8 sm:pt-40">
            <div class="text-center max-w-3xl mx-auto pb-16">
              <h1 class="font-playfair text-5xl md:text-6xl font-bold text-slate-100 mb-4"
                x-text="pageContent.heroSection.mainHeading"></h1>
              <p class="text-xl text-slate-400" x-text="pageContent.heroSection.subHeading"></p>
            </div>

            <div x-data="{ open: false }" class="max-w-3xl mx-auto" data-aos="fade-up">
              <div class="relative flex items-center justify-center">
                <img src="<?= base_url('assets/images/wof-hero.jpg') ?>" alt="Wall of Love hero"
                  class="rounded-lg w-full" width="768" height="432" />
                <button @click="open = true" aria-label="Play hero video"
                  class="absolute inset-0 flex items-center justify-center text-white focus:outline-none focus:ring-4 focus:ring-blue-600 focus:ring-opacity-75 rounded-lg">
                  <svg class="w-16 h-16 md:w-20 md:h-20 fill-current" viewBox="0 0 88 88"
                    xmlns="http://www.w3.org/2000/svg">
                    <circle cx="44" cy="44" r="44" class="text-white/80 transition-colors" fill="currentColor" />
                    <path
                      d="M52 44a.999.999 0 00-.427-.82l-10-7A1 1 0 0040 37V51a.999.999 0 001.573.82l10-7A.995 0 0052 44V44c0 .001 0 .001 0 0z"
                      class="text-blue-600" fill="currentColor" />
                  </svg>
                </button>
              </div>

              <div x-show="open" x-transition:enter="transition-opacity duration-300"
                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                x-transition:leave="transition-opacity duration-300" x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0" x-cloak @click="open = false"
                class="fixed inset-0 bg-black bg-opacity-75 z-40"></div>

              <div x-show="open" x-cloak class="fixed inset-0 flex items-center justify-center z-50 p-4">
                <div @click.away="open = false" @keydown.escape.window="open = false"
                  class="bg-black rounded-lg overflow-hidden shadow-lg max-w-3xl w-full">
                  <video x-init="$watch('open', val => val ? $el.play() : $el.pause())" class="w-full h-auto" controls
                    loop>
                    <source src="<?= base_url('assets/videos/video.mp4') ?>" type="video/mp4" />
                    Your browser does not support the video tag.
                  </video>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section x-data="investorsComponent()" x-init="init()" x-cloak>
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
          <div class="py-8">
            <div class="text-center max-w-3xl mx-auto pb-8 md:pb-12">
              <h2 class="font-playfair text-slate-800 text-4xl md:text-5xl font-bold"
                x-text="mainHeading || (pageContent && pageContent.investorsSection && pageContent.investorsSection.mainHeading) || 'Our Valued Investors'">
              </h2>
            </div>

            <div class="flex flex-wrap justify-center items-center" data-aos-id-clients>
              <template x-if="loading">
                <p class="text-center text-blue-500 py-4">Loading investor logos...</p>
              </template>
              <template x-if="!loading && error && investors.length === 0">
                <p class="text-center text-red-500 py-4">Error loading investors: <span x-text="error"></span></p>
              </template>
              <template x-if="!loading && investors.length === 0 && !error">
                <p class="text-center text-slate-500 py-4">No investor logos available.</p>
              </template>

              <template x-for="investor in investors" :key="investor.id">
                <div :id="investor.id" class="m-8 w-32 h-20 relative group" data-aos="fade-up"
                  data-aos-anchor="[data-aos-id-clients]" :data-aos-delay="investor.delay">
                  <img :src="investor.logo" :alt="investor.name" class="h-full w-full object-contain" />
                  <div class="absolute inset-0 bg-white/50 group-hover:bg-transparent transition"></div>
                </div>
              </template>
            </div>
          </div>
        </div>
      </section>

      <section class="relative bg-white py-16 md:py-24">
        <div class="max-w-6xl mx-auto px-6 sm:px-8 space-y-24">
          <div class="hidden md:block absolute left-1/2 top-0 mt-6 -ml-px h-16 w-px bg-slate-200"></div>

          <div class="text-center max-w-3xl mx-auto pb-8 md:pb-12">
            <h2 class="font-playfair text-slate-800 text-4xl md:text-5xl font-bold"
              x-text="pageContent.testimonialsSection.mainHeading"></h2>
          </div>

          <template x-if="testimonials.length === 0 && !error">
            <p class="text-center text-slate-500 py-4">No testimonials available at the moment.</p>
          </template>

          <template x-for="(testimonial, idx) in testimonials.filter(t => t.type === 'video')" :key="testimonial.id">
            <div x-data="{ open: false }" class="space-y-10">
              <div :class="{'md:flex-row-reverse': testimonial.reverse, 'md:flex-row': !testimonial.reverse}"
                class="flex flex-col items-center gap-10 md:gap-20">
                <div class="md:w-1/2" :data-aos="testimonial.reverse ? 'fade-right' : 'fade-left'">
                  <h2 class="font-playfair-display text-4xl md:text-5xl font-bold mb-6">
                    <a :href="testimonial.companyHref" class="text-slate-800 hover:text-blue-600"
                      x-text="testimonial.company"></a>
                  </h2>
                  <p class="text-xl text-slate-500 mb-8 border-l-4 border-slate-800 pl-6"
                    x-text="testimonial.description">
                  </p>
                  <div class="flex items-center mb-8">
                    <svg class="w-6 h-5 text-blue-600 mr-4" viewBox="0 0 20 16" fill="currentColor">
                      <path
                        d="M2.76 16c2.577 0 5.154-3.219 5.154-5.996 0-1.357-.613-2.272-1.748-2.272s-2.27.726-3.283 1.64C3.16 6.439 5.613 3.346 9.571.885L9.233 0C3.466 2.903 0 7.732 0 12.213 0 14.517.828 16 2.76 16Zm10.43 0c2.577 0 5.154-3.219 5.154-5.996 0-1.357-.614-2.272-1.749-2.272-1.135 0-2.27.726-3.282 1.64.276-2.934 2.73-6.027 6.687-8.488L19.663 0c-5.767 2.903-9.234 7.732-9.234 12.213 0 2.304.829 3.787 2.761 3.787Z" />
                    </svg>
                    <blockquote class="italic text-slate-500 text-lg" x-text="`“${testimonial.quote}”`"></blockquote>
                  </div>
                  <div class="flex items-center">
                    <img :src="testimonial.avatarSrc" :alt="testimonial.avatarAlt"
                      class="w-10 h-10 rounded-full mr-4 object-cover" />
                    <div class="text-lg text-slate-800">
                      <a href="#" class="font-medium hover:underline" x-text="testimonial.person"></a>
                      <span class="text-slate-400"> · </span>
                      <span class="text-slate-400" x-text="testimonial.role"></span>
                    </div>
                  </div>
                </div>

                <div class="md:w-1/2 flex justify-center" :data-aos="testimonial.reverse ? 'fade-left' : 'fade-right'">
                  <div class="relative">
                    <div
                      class="absolute inset-0 border-2 border-slate-200 -translate-x-4 -translate-y-4 z-0 pointer-events-none">
                    </div>
                    <button @click="open = true; $nextTick(() => $refs.videoModal && $refs.videoModal.play())"
                      aria-label="Play video"
                      class="relative z-10 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-2 rounded-lg">
                      <img :src="testimonial.videoPoster" :alt="`Video testimonial from ${testimonial.company}`"
                        class="w-full md:max-w-lg rounded-lg shadow-lg" />
                      <div class="absolute inset-0 flex items-center justify-center text-white">
                        <svg class="w-16 h-16 md:w-20 md:h-20 fill-current" viewBox="0 0 88 88">
                          <circle cx="44" cy="44" r="44" class="text-white/80" fill="currentColor" />
                          <path d="M52 44a.999.999 0 00-.427-.82l-10-7A1 1 0 0040 37V51a.999.999 0 001.573.82l10-7z"
                            class="text-blue-600" fill="currentColor" />
                        </svg>
                      </div>
                    </button>
                  </div>
                </div>
              </div>

              <div x-show="open" x-cloak
                @keydown.window.escape="open = false; $refs.videoModal.pause(); $refs.videoModal.currentTime = 0"
                @click.self="open = false; $refs.videoModal.pause(); $refs.videoModal.currentTime = 0"
                class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black bg-opacity-75">
                <div class="relative bg-black rounded-lg overflow-hidden shadow-lg max-w-3xl w-full">
                  <button @click="open = false; $refs.videoModal.pause(); $refs.videoModal.currentTime = 0"
                    class="absolute top-3 right-3 text-white text-2xl focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-2 rounded-full p-1"
                    aria-label="Close video">
                    &times;
                  </button>
                  <video x-ref="videoModal" class="w-full h-auto" controls loop>
                    <source :src="testimonial.testimonialVideoSrc" type="video/mp4" />
                    Your browser does not support the video tag.
                  </video>
                </div>
              </div>
            </div>
          </template>

          <template
            x-if="testimonials.filter(t => t.type === 'video').length > 0 && testimonials.filter(t => t.type === 'text').length > 0">
            <hr class="my-16 border-t border-slate-200" />
          </template>

          <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3 auto-rows-fr" data-aos-id-testimonials>
            <template x-for="(testimonial, idx) in testimonials.filter(t => t.type === 'text')" :key="testimonial.id">
              <article class="flex flex-col h-full bg-white shadow-2xl px-6 py-4" data-aos="fade-up"
                data-aos-anchor="[data-aos-id-testimonials]" :data-aos-delay="testimonial.delay ?? (idx * 100)">
                <header class="mb-6 flex items-center justify-center">
                  <div class="relative mr-4">
                    <img :src="testimonial.imgSrc" :alt="testimonial.imgAlt"
                      class="w-14 h-14 rounded-full flex-shrink-0 object-cover" />
                    <svg class="absolute top-0 right-0 w-6 h-5 text-blue-600 pointer-events-none" viewBox="0 0 20 16"
                      fill="currentColor">
                      <path
                        d="M2.76 16c2.577 0 5.154-3.219 5.154-5.996 0-1.357-.613-2.272-1.748-2.272s-2.27.726-3.283 1.64C3.16 6.439 5.613 3.346 9.571.885L9.233 0C3.466 2.903 0 7.732 0 12.213 0 14.517.828 16 2.76 16Zm10.43 0c2.577 0 5.154-3.219 5.154-5.996 0-1.357-.614-2.272-1.749-2.272-1.135 0-2.27.726-3.282 1.64.276-2.934 2.73-6.027 6.687-8.488L19.663 0c-5.767 2.903-9.234 7.732-9.234 12.213 0 2.304.829 3.787 2.761 3.787Z" />
                    </svg>
                  </div>
                </header>
                <div class="mb-4 flex-grow">
                  <p class="text-slate-500 italic text-xl leading-snug" x-text="`“${testimonial.quote}”`"></p>
                </div>
                <footer class="text-base font-medium text-slate-800 mt-auto">
                  <span class="text-lg font-extrabold italic text-gray-900" x-text="testimonial.name"></span>
                  <span class="text-slate-300"> · </span>
                  <span class="text-slate-500" x-text="testimonial.role"></span>
                </footer>
              </article>
            </template>
          </div>

          <div class="text-center pt-8">
            <a href="#" class="px-6 py-3 bg-blue-600 text-white rounded transition hover:bg-blue-700"
              x-text="pageContent.testimonialsSection.callToAction"></a>
          </div>
        </div>
      </section>


    </div>
  </template>

</div>
<?= view('partials/call_to_action'); ?>