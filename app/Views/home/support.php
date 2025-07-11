<div x-data="feedbackApp()" x-init="init()">

  <section class="relative bg-slate-900 text-white">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 py-32 text-center">
      <h1 class="font-dm-serif text-4xl sm:text-5xl md:text-6xl mb-8">
        Advice &amp; Answers from the LTWCE Team
      </h1>
      <form class="max-w-xl mx-auto relative">
        <input type="search" placeholder="Search for articles…" x-model="searchQuery"
          class="w-full rounded-full bg-slate-800 placeholder-slate-400 text-white px-6 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500" />
        <button type="submit" @click.prevent="searchArticles"
          class="absolute right-3 top-1/2 transform -translate-y-1/2 text-slate-400 hover:text-white"
          aria-label="Search">
          <svg class="w-5 h-5" viewBox="0 0 16 16">
            <path fill="currentColor"
              d="m14.293 13.707 3.182 3.182a1 1 0 0 1-1.414 1.414l-3.182-3.182a8 8 0 1 1 1.414-1.414zM8 14A6 6 0 1 0 8 2a6 6 0 0 0 0 12z" />
          </svg>
        </button>
      </form>
    </div>
  </section>

  <section
    class="pt-20 flex-1 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 lg:divide-x lg:divide-slate-200 gap-y-8 md:gap-y-0">
    <div class="px-4 py-8 lg:py-12">
      <h2 class="font-dm-serif text-4xl sm:text-5xl font-bold text-slate-800 mb-8 text-center">
        Submit Your Feedback
      </h2>
      <div class="max-w-md mx-auto bg-white p-8 rounded-xl shadow-lg">
        <form @submit.prevent="submitFeedback" class="space-y-6">
          <div>
            <label for="article" class="flex justify-between items-center text-sm font-medium mb-1">
              <span>Topic</span><span class="text-red-500">*</span>
            </label>
            <select id="article" x-model="form.article" required
              class="w-full border border-slate-200 rounded px-4 py-2 focus:border-blue-500">
              <option value="" disabled>Select a topic...</option>
              <template x-for="art in searchResults" :key="art.articleId">
                <option :value="art.articleId" x-text="art.title"></option>
              </template>
            </select>
            <p x-show="errors.article" class="text-red-600 text-xs mt-1" x-text="errors.article"></p>
          </div>
          <div>
            <label for="name" class="flex justify-between items-center text-sm font-medium mb-1">
              <span>Your Name</span><span class="text-red-500">*</span>
            </label>
            <input id="name" type="text" x-model="form.name" required placeholder="e.g. Jane Doe"
              class="w-full border border-slate-200 rounded px-4 py-2 focus:border-blue-500" />
            <p x-show="errors.name" class="text-red-600 text-xs mt-1" x-text="errors.name"></p>
          </div>
          <div>
            <label for="email" class="flex justify-between items-center text-sm font-medium mb-1">
              <span>Your Email</span><span class="text-red-500">*</span>
            </label>
            <input id="email" type="email" x-model="form.email" required placeholder="e.g. jane@example.com"
              class="w-full border border-slate-200 rounded px-4 py-2 focus:border-blue-500" />
            <p x-show="errors.email" class="text-red-600 text-xs mt-1" x-text="errors.email"></p>
          </div>
          <div>
            <label for="message" class="flex justify-between items-center text-sm font-medium mb-1">
              <span>Your Message</span><span class="text-red-500">*</span>
            </label>
            <textarea id="message" rows="4" x-model="form.message" required placeholder="Write your feedback..."
              class="w-full border border-slate-200 rounded px-4 py-2 focus:border-blue-500"></textarea>
            <p x-show="errors.message" class="text-red-600 text-xs mt-1" x-text="errors.message"></p>
          </div>
          <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition">
            Send Feedback
          </button>
        </form>
      </div>
    </div>

    <div class="relative px-4 py-8 lg:py-12 bg-gray-50">
      <h2
        class="sticky top-0 bg-gray-50 font-dm-serif text-4xl sm:text-5xl font-bold text-slate-800 mb-8 text-center z-20">
        Available Topics
      </h2>
      <div
        class="absolute top-[4.5rem] left-0 w-full h-12 bg-gradient-to-b from-gray-50 to-transparent pointer-events-none z-10">
      </div>
      <div class="scroll-area max-h-[700px] overflow-y-auto max-w-md mx-auto space-y-4">
        <template x-for="art in searchResults" :key="art.articleId">
          <article @click="selectArticle(art.articleId)"
            :class="art.articleId === selectedArticleId ? 'bg-white shadow-lg' : 'bg-gray-100'"
            class="rounded-lg p-4 cursor-pointer transition hover:-translate-y-1">
            <div class="flex items-start">
              <div class="flex-1">
                <h3 class="font-playfair text-lg font-bold" x-text="art.title"></h3>
                <p class="text-sm text-slate-500 mb-2" x-text="art.excerpt"></p>
                <div class="flex items-center text-xs text-slate-600">
                  <span x-text="feedbackByArticle[art.articleId]?.length + ' replies'"></span>
                </div>
                <div class="mt-2 flex flex-wrap -space-x-2">
                  <template x-for="fb in feedbackByArticle[art.articleId]" :key="fb.userId">
                    <img class="w-6 h-6 rounded-full border-2 border-white box-content" :src="getAvatarUrl(fb.userId)"
                      alt="User avatar" />
                  </template>
                </div>
              </div>
            </div>
          </article>
        </template>
      </div>
    </div>

    <div class="relative px-4 py-8 lg:py-12 md:col-span-2 lg:col-span-1">
      <h2
        class="sticky top-0 bg-gray-50 font-dm-serif text-4xl sm:text-5xl font-bold text-slate-800 mb-8 text-center z-20">
        Member Responses
      </h2>
      <div
        class="absolute top-[4.5rem] left-0 w-full h-12 bg-gradient-to-b from-gray-50 to-transparent pointer-events-none z-10">
      </div>
      <div class="scroll-area max-h-[700px] overflow-y-auto max-w-md mx-auto flex flex-col space-y-4"
        x-ref="feedContainer">
        <template x-for="msg in feedbackByArticle[selectedArticleId]" :key="msg.feedbackId">
          <div class="bg-white p-4 rounded-lg shadow-sm flex space-x-4">
            <img class="w-10 h-10 rounded-full" :src="getAvatarUrl(msg.userId)" alt="avatar" />
            <div>
              <div class="text-sm font-medium" x-text="msg.name"></div>
              <div class="text-xs text-gray-500" x-text="msg.email"></div>
              <div class="text-xs text-slate-400 mb-1" x-text="timeAgo(msg.timestamp)"></div>
              <p class="text-sm text-slate-700" x-text="msg.message"></p>
              <div class="text-xs text-slate-500 mt-1" x-text="msg.location"></div>
            </div>
          </div>
        </template>
      </div>
    </div>
  </section>

  <section class="bg-slate-50">
    <div class="mx-auto max-w-6xl px-4 sm:px-6">
      <div class="py-12 md:py-20 border-t border-slate-50">
        <div class="mx-auto max-w-3xl text-center pb-12 md:pb-20">
          <h2 class="font-playfair-display text-4xl md:text-5xl font-bold text-slate-800">
            Frequently Asked Questions
          </h2>
        </div>

        <ul class="mx-auto max-w-3xl list-none">
          <template x-for="faq in faqs" :key="faq.id">
            <li x-data="{ expanded: false }" class="border-b border-slate-200">
              <button @click="expanded = !expanded" :aria-expanded="expanded"
                class="w-full flex justify-between items-center text-left font-playfair-display py-5 text-2xl font-bold">
                <span x-text="faq.question"></span>
                <svg :class="{ 'rotate-180': expanded }"
                  class="flex-shrink-0 w-4 h-4 ml-8 text-blue-600 fill-current transition-transform duration-300 ease-in-out"
                  viewBox="0 0 16 16">
                  <path d="m3 5 5 6 5-6z"></path>
                </svg>
              </button>
              <div x-ref="item" class="overflow-hidden text-slate-500 transition-all duration-300 ease-in-out"
                :style="expanded ? 'max-height: ' + $refs.item.scrollHeight + 'px; opacity: 1' : 'max-height: 0; opacity: 0'">
                <p class="pb-5" x-text="faq.answer"></p>
              </div>
            </li>
          </template>
        </ul>
      </div>
    </div>
  </section>
</div>