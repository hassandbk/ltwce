// src/components/articles.js
function articlesComponent() {
  return {
    // State
    loading: false,
    sections: [],
    rawArticles: [], // All articles from sections
    articlesPerPage: 6,
    currentPage: 1,
    filters: { query: '', from: '', to: '' },
    activeTab: 0, // For sections/tabs

    // Computed Properties
    get filteredArticles() {
      // Assuming filterItems is a global utility or part of window.api/window.dom
      // If it's a separate utility, ensure it's loaded globally or prefixed similarly.
      // For now, let's assume it's a standalone utility function
      // (or you might move it to window.api if it's data-related).
      return filterItems(this.rawArticles, this.filters);
    },
    get articlePageCount() {
      // Assuming getPageCount is a global utility
      return getPageCount(this.filteredArticles.length, this.articlesPerPage);
    },
    get pagedArticles() {
      // Assuming getPagedItems is a global utility
      return getPagedItems(
        this.filteredArticles,
        this.currentPage,
        this.articlesPerPage
      );
    },
    linkFor: (art) => linkForArticle(art), // Assuming linkForArticle is a global utility

    // Methods
    async init() {
      this.loading = true;
      try {
        // Correctly reference loadJSON from window.api
        if (
          typeof window.api === 'undefined' ||
          typeof window.api.loadJSON !== 'function'
        ) {
          throw new Error(
            'window.api.loadJSON is not defined. Ensure api.js is loaded before this component.'
          );
        }
        const response = await window.api.loadJSON('/data/articles.json');
        this.sections = response.sections;
        this.rawArticles = this.sections.flatMap((section) => section.articles);

        // Correctly reference setDelays (assuming it's part of a 'format' utility, or similar, like in solutions-grid-section)
        // If setDelays is a general utility that works with AOS, it might be on window.format or window.dom
        // For consistency with other components, let's assume it's on window.format if it manipulates delays for AOS.
        if (
          typeof window.format === 'undefined' ||
          typeof window.format.setDelays !== 'function'
        ) {
          console.warn(
            'window.format.setDelays is not defined. AOS delays may not be applied.'
          );
        } else {
          window.format.setDelays(this.sections); // Apply delays to sections if they are rendered with AOS
        }
      } catch (e) {
        console.error('Failed to load articles:', e);
      } finally {
        this.loading = false;
        // Correctly reference refreshAOS from window.dom
        this.$nextTick(() => {
          if (
            typeof window.dom === 'undefined' ||
            typeof window.dom.refreshAOS !== 'function'
          ) {
            console.warn(
              'window.dom.refreshAOS is not defined. AOS animations may not trigger correctly.'
            );
          } else {
            window.dom.refreshAOS(); // Refresh AOS for articles section
          }
        });
      }
    },
    resetFilters() {
      this.filters = { query: '', from: '', to: '' };
      this.currentPage = 1;
    },
    articlesNextPage() {
      if (this.currentPage < this.articlePageCount) {
        this.currentPage++;
        // Optionally scroll to top of article list here
      }
    },
    articlesPrevPage() {
      if (this.currentPage > 1) {
        this.currentPage--;
        // Optionally scroll to top of article list here
      }
    },
    selectTab(index) {
      this.activeTab = index;
      const section = document.getElementById(this.sections[index].id);
      // Assuming smoothScrollToElement is a global utility or part of window.dom
      if (
        typeof window.dom === 'undefined' ||
        typeof window.dom.smoothScrollToElement !== 'function'
      ) {
        console.warn(
          'window.dom.smoothScrollToElement is not defined. Smooth scroll will not work.'
        );
        section.scrollIntoView({ behavior: 'smooth' }); // Fallback
      } else {
        window.dom.smoothScrollToElement(section, 80); // Adjust offset as needed
      }
    },
    // You might need a way to emit an event if another component (like feedbackForm)
    // needs to know the selected article. Alpine's `$dispatch` can be used.
    selectArticleForFeedback(articleId) {
      this.$dispatch('article-selected', { id: articleId });
    },
  };
}

// Expose globally for Alpine.js to find
window.articlesComponent = articlesComponent;
