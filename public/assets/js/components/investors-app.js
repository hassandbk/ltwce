// public/assets/js/components/investors-app.js

/**
 * Alpine.js component for the Investors section.
 * Fetches investor/client data and displays their logos dynamically.
 * Relies on global utility functions: window.api.loadJSON, window.format.setDelays, window.dom.refreshAOS.
 */
function investorsComponent() {
  return {
    // ───────────────────────────────────────────────────────────────────────
    // STATE VARIABLES
    // ───────────────────────────────────────────────────────────────────────
    loading: true, // Indicates if data is currently being loaded
    mainHeading: '', // New: Stores the main heading for the investors section
    investors: [], // Array to store investor/client data from JSON
    error: null, // Stores any error messages during data loading

    // ───────────────────────────────────────────────────────────────────────
    // INITIALIZATION
    // Called by Alpine.js when the component is mounted (x-init).
    // ───────────────────────────────────────────────────────────────────────
    async init() {
      this.loading = true;
      this.error = null; // Clear any previous errors

      try {
        // Ensure window.api and loadJSON are available globally.
        if (
          typeof window.api === 'undefined' ||
          typeof window.api.loadJSON !== 'function'
        ) {
          throw new Error(
            'window.api.loadJSON is not defined. Ensure api.js is loaded.'
          );
        }

        const rawData = await window.api.loadJSON('/data/investors.json');

        // Validate the structure of the loaded data
        if (
          rawData &&
          typeof rawData === 'object' &&
          Array.isArray(rawData.investors)
        ) {
          this.mainHeading = rawData.mainHeading || ''; // Get main heading
          this.investors = rawData.investors;

          // Ensure window.format and setDelays are available for AOS animations.
          // Note: The HTML uses :data-aos-delay="index * 100", so setDelays isn't strictly
          // necessary for the investors section if you're directly using 'index'.
          // However, if you plan to use a pre-calculated 'aosDelay' property, keep this.
          // For now, I'll keep it consistent.
          if (
            typeof window.format === 'undefined' ||
            typeof window.format.setDelays !== 'function'
          ) {
            console.warn(
              'window.format.setDelays is not defined. AOS delays for investors may not be applied.'
            );
          } else {
            window.format.setDelays(this.investors); // This will add 'aosDelay' property
          }
        } else {
          console.warn(
            'JSON data for investors is missing or not an array under "investors" key:',
            rawData
          );
          this.investors = []; // Ensure investors is an empty array to prevent rendering errors
          this.error = 'Failed to load valid investors data.';
        }
      } catch (e) {
        console.error('Failed to load investors data:', e);
        this.investors = []; // Ensure investors is empty on error
        this.error = `Failed to load investors data: ${e.message || e}`;
      } finally {
        this.loading = false; // Always set loading to false.

        // Use $nextTick to ensure the DOM is updated by Alpine.js before refreshing AOS.
        this.$nextTick(() => {
          // Ensure window.dom and refreshAOS are available.
          if (
            typeof window.dom === 'undefined' ||
            typeof window.dom.refreshAOS !== 'function'
          ) {
            console.warn(
              'window.dom.refreshAOS is not defined. AOS animations for investors may not trigger correctly.'
            );
          } else {
            window.dom.refreshAOS();
          }
        });
      }
    },
  };
}

// Make the component available globally for Alpine.js to find.
window.investorsComponent = investorsComponent;
