// public/assets/js/components/saccoNumbersApp.js

// No 'import' or 'export' statements here.
// All helper functions are expected to be available globally via the 'window' object.

function saccoNumbersApp() {
  return {
    // ───────────────────────────────────────────────────────────────────────
    // STATE VARIABLES
    // These variables hold the component's data and control its UI state.
    // ───────────────────────────────────────────────────────────────────────
    loading: true, // Indicates if data is currently being fetched. Default to true for initial load.
    error: null, // Holds an error message if data fetching fails, otherwise null.
    numbersData: {
      // Stores the data fetched from the JSON file.
      mainHeading: '',
      subDescription: '',
      illustrationImage: '',
      illustrationAlt: '',
      stats: [], // Array to hold individual statistics.
    },

    // ───────────────────────────────────────────────────────────────────────
    // DATA LOADING
    // Asynchronously fetches the "by the numbers" JSON data.
    // ───────────────────────────────────────────────────────────────────────
    async loadNumbersData() {
      try {
        this.loading = true; // Set loading to true to show loading indicator.
        this.error = null; // Clear any previous error before a new fetch attempt.

        const jsonPath = '/data/sacco-numbers-section.json'; // Path to your JSON data.

        // Use the globally exposed loadJSON helper from window.api to fetch data.
        const rawData = await window.api.loadJSON(jsonPath);

        this.numbersData = rawData; // Assign the fetched data to numbersData.
      } catch (e) {
        // If an error occurs during fetching, log it and set the error state.
        console.error('Error loading SACCO numbers data:', e);
        this.error = 'Failed to load statistics. Please try again later.';
        // Optionally, for debugging, you could use: this.error = `Error: ${e.message}`;
      } finally {
        // This block always runs after try/catch, whether successful or not.
        this.loading = false; // Always reset loading state.

        // Use $nextTick to ensure the DOM is fully updated before refreshing AOS.
        this.$nextTick(() => {
          // Refresh AOS (Animate On Scroll) to ensure animations are correctly applied
          // after content is dynamically loaded and rendered.
          window.dom.refreshAOS();
        });
      }
    },

    // ───────────────────────────────────────────────────────────────────────
    // INITIALIZATION
    // Called by Alpine.js when the component is mounted to the DOM.
    // ───────────────────────────────────────────────────────────────────────
    async init() {
      // Begin loading data as soon as the component initializes.
      await this.loadNumbersData();
    },
  };
}

// Make the component function globally accessible so Alpine.js can discover and use it
// via x-data="saccoNumbersApp()".
window.saccoNumbersApp = saccoNumbersApp;
