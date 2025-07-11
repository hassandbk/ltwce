// public/assets/js/components/solutions-grid-section.js

/**
 * Alpine.js component for the Solutions Grid section.
 * This component fetches solution features from a JSON file and renders them dynamically.
 * It relies on global utility functions available on the window object (window.api, window.format, window.dom).
 */
function solutionsGridApp() {
  return {
    // ───────────────────────────────────────────────────────────────────────
    // STATE VARIABLES
    // ───────────────────────────────────────────────────────────────────────
    loading: true, // Indicates if data is currently being loaded
    solutionsData: {
      mainHeading: '',
      subDescription: '',
      features: [], // This array will hold your solution/feature data
    },
    error: null, // Stores any error messages for display or logging

    // ───────────────────────────────────────────────────────────────────────
    // DATA LOADING
    // Fetches the solutions grid JSON data from the specified path.
    // ───────────────────────────────────────────────────────────────────────
    async loadSolutionsData() {
      this.loading = true; // Set loading state to true before fetch
      this.error = null; // Clear any previous errors

      try {
        // Ensure window.api and loadJSON are available
        if (
          typeof window.api === 'undefined' ||
          typeof window.api.loadJSON !== 'function'
        ) {
          throw new Error(
            'window.api.loadJSON is not defined. Ensure api.js is loaded.'
          );
        }

        const rawData = await window.api.loadJSON(
          '/data/solutions-grid-section.json'
        );

        // Validate the structure of the loaded data
        if (
          rawData &&
          typeof rawData === 'object' &&
          Array.isArray(rawData.features)
        ) {
          this.solutionsData = rawData;

          // Ensure window.format and setDelays are available
          if (
            typeof window.format === 'undefined' ||
            typeof window.format.setDelays !== 'function'
          ) {
            console.warn(
              'window.format.setDelays is not defined. AOS delays may not be applied.'
            );
          } else {
            // Apply AOS delays to the features *after* data is loaded
            window.format.setDelays(this.solutionsData.features);
          }
        } else {
          console.warn(
            'JSON data for solutions grid is missing or malformed (expected an object with a "features" array):',
            rawData
          );
          this.solutionsData.features = []; // Ensure features is an empty array to prevent rendering errors
          this.error = 'Failed to load valid solutions data.';
        }
      } catch (e) {
        console.error('Error loading solutions grid data:', e);
        this.solutionsData.features = []; // Ensure features is empty on error
        this.error = `Failed to load solutions data: ${e.message || e}`;
        // Optionally, display a user-friendly error message in the UI using x-show="error"
      } finally {
        this.loading = false; // Ensure loading state is reset even on error

        // Refresh AOS after content is loaded and the DOM is updated.
        // This `$nextTick` ensures Alpine.js has finished rendering the loop.
        this.$nextTick(() => {
          // Ensure window.dom and refreshAOS are available
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

    // ───────────────────────────────────────────────────────────────────────
    // INITIALIZATION
    // Called by Alpine.js when the component is mounted (x-init).
    // ───────────────────────────────────────────────────────────────────────
    async init() {
      await this.loadSolutionsData();
    },
  };
}

// Make the component available globally for Alpine.js to find
// The name 'solutionsGridApp' must match the x-data attribute in your HTML.
window.solutionsGridApp = solutionsGridApp;
