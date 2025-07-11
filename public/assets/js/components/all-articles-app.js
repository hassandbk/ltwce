// public/assets/js/components/all-articles-page.js

/**
 * Alpine.js component for the "All Articles" page.
 * Manages fetching, filtering, and paginating articles, and toggling view modes.
 */
function allArticlesComponent() {
  return {
    // --- State Variables ---
    loading: true, // Indicates if data is currently being loaded
    rawArticles: [], // All articles fetched from the JSON, immutable
    filteredArticles: [], // Articles after applying search and date filters
    viewMode: 'list', // 'list' or 'grid' for article display
    articlesPerPage: 9, // Number of articles to show per page
    currentPage: 1, // Current page number for pagination
    filters: {
      query: '', // Search query string
      from: '', // Start date for filtering (YYYY-MM-DD format from input)
      to: '', // End date for filtering (YYYY-MM-DD format from input)
    },
    error: null, // Stores any error messages during data loading

    // --- Computed Properties ---
    /**
     * Returns the articles for the current page based on filtered results.
     * @returns {Array} Array of articles for the current page.
     */
    get pagedItems() {
      const start = (this.currentPage - 1) * this.articlesPerPage;
      const end = start + this.articlesPerPage;
      return this.filteredArticles.slice(start, end);
    },

    /**
     * Calculates the total number of pages based on filtered articles and articlesPerPage.
     * @returns {number} Total number of pages.
     */
    get pageCount() {
      return Math.ceil(this.filteredArticles.length / this.articlesPerPage);
    },

    // --- Methods ---
    /**
     * Initializes the component by fetching articles and setting up initial state.
     */
    async init() {
      this.loading = true;
      this.error = null; // Clear any previous errors

      try {
        // Ensure window.api.loadJSON exists before attempting to use it
        if (
          typeof window.api === 'undefined' ||
          typeof window.api.loadJSON !== 'function'
        ) {
          throw new Error(
            'window.api.loadJSON is not defined. Ensure api.js is loaded before this component.'
          );
        }

        // Fetch articles from the specified JSON path
        // This path should point to the JSON structure you provided with 'sections'
        const response = await window.api.loadJSON('/data/articles.json'); // **Verify this path matches your JSON file**

        // Flatten the 'sections' array into a single array of raw articles
        if (response && Array.isArray(response.sections)) {
          this.rawArticles = response.sections.flatMap(
            (section) => section.articles || []
          );
        } else if (Array.isArray(response)) {
          // Fallback: if the response itself is a flat array of articles
          this.rawArticles = response;
        } else {
          console.warn('Unexpected JSON structure:', response);
          throw new Error(
            'Invalid articles data received. Expected object with "sections" or a direct array.'
          );
        }

        // Apply initial filters to populate `filteredArticles`
        this.applyFilters();
      } catch (e) {
        console.error('Failed to load articles for all-articles page:', e);
        this.error = `Failed to load articles: ${e.message || e}`;
        this.rawArticles = []; // Ensure empty on error
        this.filteredArticles = []; // Ensure empty on error
      } finally {
        this.loading = false; // Always set loading to false

        // Ensure AOS is refreshed after content is rendered by Alpine.js
        this.$nextTick(() => {
          if (
            typeof window.dom === 'undefined' ||
            typeof window.dom.refreshAOS !== 'function'
          ) {
            console.warn(
              'window.dom.refreshAOS is not defined. AOS animations may not trigger correctly.'
            );
          } else {
            window.dom.refreshAOS();
          }
        });
      }
    },

    /**
     * Applies search and date filters to the raw articles and updates `filteredArticles`.
     * Resets the current page to 1 after filtering.
     */
    applyFilters() {
      let tempArticles = [...this.rawArticles]; // Start with a fresh copy of all articles

      // 1. Apply query filter
      if (this.filters.query) {
        const query = this.filters.query.toLowerCase();
        tempArticles = tempArticles.filter(
          (article) =>
            article.headline.toLowerCase().includes(query) ||
            article.excerpt.toLowerCase().includes(query) ||
            article.authorName.toLowerCase().includes(query)
        );
      }

      // 2. Apply date filters
      const fromDate = this.filters.from ? new Date(this.filters.from) : null;
      const toDate = this.filters.to ? new Date(this.filters.to) : null;

      if (fromDate || toDate) {
        tempArticles = tempArticles.filter((article) => {
          // Parse article date string into a Date object for comparison
          // Example date: "Sep 24, 2021" is generally parseable by new Date()
          const articleDate = new Date(article.date);

          let matchesFrom = true;
          let matchesTo = true;

          // Check if article date is on or after 'from' date
          if (fromDate) {
            // Normalize dates to start of day to ensure 'inclusive' comparison
            const articleDay = new Date(
              articleDate.getFullYear(),
              articleDate.getMonth(),
              articleDate.getDate()
            );
            matchesFrom = articleDay >= fromDate;
          }
          // Check if article date is on or before 'to' date
          if (toDate) {
            // Normalize dates to end of day to ensure 'inclusive' comparison
            const articleDay = new Date(
              articleDate.getFullYear(),
              articleDate.getMonth(),
              articleDate.getDate()
            );
            matchesTo = articleDay <= toDate;
          }
          return matchesFrom && matchesTo;
        });
      }

      this.filteredArticles = tempArticles;
      this.currentPage = 1; // Always reset to the first page after any filter change
    },

    /**
     * Resets all filters and re-applies them to show all original articles.
     */
    resetFilters() {
      this.filters = { query: '', from: '', to: '' };
      this.applyFilters(); // Re-apply filters to refresh the list
    },

    /**
     * Generates the URL for a given article.
     * Customize this based on your application's routing.
     * @param {Object} article - The article object.
     * @returns {string} The URL to the article.
     */
    linkFor(article) {
      // Corrected: Matches CodeIgniter route: /resources/articles/(:segment)
      return article.slug
        ? `/resources/articles/${article.slug}`
        : `/resources/articles?id=${article.id}`; // Fallback if slug is missing, though slug is preferred
    },
  };
}

// Make the component globally available for Alpine.js to discover.
window.allArticlesComponent = allArticlesComponent;

// --- GLOBAL UTILITY PLACEHOLDERS ---
// These are included here for completeness, but ideally, they should reside
// in separate, dedicated utility files (e.g., api.js, dom.js) and be loaded
// *before* this component script.

// Placeholder for window.api for JSON loading
if (typeof window.api === 'undefined') {
  window.api = {
    async loadJSON(path) {
      console.log('API: Loading JSON from:', path);
      const response = await fetch(path);
      if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status} from ${path}`);
      }
      return await response.json();
    },
  };
}

// Placeholder for window.dom for DOM manipulation and AOS refresh
if (typeof window.dom === 'undefined') {
  window.dom = {
    refreshAOS() {
      if (typeof AOS !== 'undefined') {
        AOS.refresh();
        console.log('DOM: AOS refreshed.');
      } else {
        console.warn("DOM: AOS library not found. Can't refresh animations.");
      }
    },
    smoothScrollToElement(element, offset = 0) {
      if (element) {
        const elementPosition =
          element.getBoundingClientRect().top + window.scrollY;
        window.scrollTo({
          top: elementPosition - offset,
          behavior: 'smooth',
        });
        console.log('DOM: Smooth scrolled to element.');
      }
    },
  };
}

// Placeholder for window.format (if you need it for specific formatting logic)
if (typeof window.format === 'undefined') {
  window.format = {
    setDelays(items, baseDelay = 100) {
      // This utility can be used if you need to dynamically set AOS delays on items.
      // For this specific 'all-articles' page, AOS is typically applied directly in HTML.
      items.forEach((item, index) => {
        item.delay = item.delay ?? baseDelay * index;
      });
      console.log('FORMAT: Delays potentially set on items.');
    },
  };
}
