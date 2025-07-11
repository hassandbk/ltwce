// public/assets/js/components/locations.js

/**
 * Alpine.js component for the Locations and Positions section.
 * Fetches location data, including icon SVG paths and open positions, to display dynamically.
 * Relies on global utility functions: window.api.loadJSON, window.format.setDelays, window.dom.refreshAOS.
 */
function locationsComponent() {
  return {
    // ───────────────────────────────────────────────────────────────────────
    // STATE VARIABLES
    // ───────────────────────────────────────────────────────────────────────
    loading: true, // Indicates if data is currently being loaded
    mainHeading: '', // Stores the main heading text
    imageGallery: [], // Stores image paths for the gallery
    locations: [], // Array to store individual location data from JSON
    error: null, // Stores any error messages during data loading

    // ───────────────────────────────────────────────────────────────────────
    // INITIALIZATION
    // Called by Alpine.js when the component is mounted (x-init).
    // ───────────────────────────────────────────────────────────────────────
    async init() {
      this.loading = true;
      this.error = null; // Clear any previous errors

      try {
        // --- Data Loading ---
        // Ensure window.api and loadJSON are available globally.
        if (
          typeof window.api === 'undefined' ||
          typeof window.api.loadJSON !== 'function'
        ) {
          throw new Error(
            'window.api.loadJSON is not defined. Ensure api.js is loaded before this component.'
          );
        }

        // Fetch the locations data from the JSON file.
        const data = await window.api.loadJSON('/data/locations.json');

        // Validate that the fetched data has the expected structure
        if (data && typeof data === 'object' && Array.isArray(data.locations)) {
          this.mainHeading = data.mainHeading || ''; // Set the main heading
          this.imageGallery = data.imageGallery || []; // Set the image gallery array
          this.locations = data.locations; // Set the locations array

          // Ensure window.format and setDelays are available for AOS animations.
          if (
            typeof window.format === 'undefined' ||
            typeof window.format.setDelays !== 'function'
          ) {
            console.warn(
              'window.format.setDelays is not defined. AOS delays for locations may not be applied.'
            );
          } else {
            // Apply AOS delays to the location items for staggered animation.
            window.format.setDelays(this.locations);
          }
        } else {
          console.warn(
            'locations.json data is not in the expected format:',
            data
          );
          this.locations = []; // Ensure locations is an empty array to prevent rendering errors
          this.error = 'Invalid locations data received.';
        }
      } catch (e) {
        console.error('Failed to load locations data:', e);
        this.locations = []; // Ensure locations is empty on error
        this.error = `Failed to load locations: ${e.message || e}`;
        // The UI's x-show="error" will now display this message.
      } finally {
        this.loading = false; // Always set loading to false in finally block.

        // --- AOS Refresh ---
        // Use $nextTick to ensure the DOM has been updated by Alpine.js
        // (i.e., x-for has rendered the location cards) before refreshing AOS.
        this.$nextTick(() => {
          // Ensure window.dom and refreshAOS are available for AOS animations.
          if (
            typeof window.dom === 'undefined' ||
            typeof window.dom.refreshAOS !== 'function'
          ) {
            console.warn(
              'window.dom.refreshAOS is not defined. AOS animations for locations may not trigger correctly.'
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
// The name 'locationsComponent' must match the x-data attribute in your HTML.
window.locationsComponent = locationsComponent;
