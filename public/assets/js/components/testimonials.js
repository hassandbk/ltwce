/**
 * Alpine.js component for the "Wall of Love" page,
 * managing testimonials (both text and video) and page headings.
 */
function testimonialsComponent() {
  return {
    loading: true, // Indicates if data is currently being loaded
    error: null, // Stores any error messages
    testimonials: [], // Array for all testimonials (text and video)
    pageContent: null, // IMPORTANT: Initial state is null. This signals that data hasn't loaded yet.

    /**
     * Initializes the component by fetching all necessary data.
     */
    async init() {
      this.loading = true;
      this.error = null;
      this.testimonials = []; // Clear previous testimonials on re-init if any
      this.pageContent = null; // Clear previous pageContent on re-init if any

      try {
        // Ensure window.api.loadJSON exists before attempting to use it
        if (
          typeof window.api === 'undefined' ||
          typeof window.api.loadJSON !== 'function'
        ) {
          throw new Error(
            'window.api.loadJSON is not defined. Ensure api.js is loaded.'
          );
        }

        // Fetch all data from testimonials.json
        const data = await window.api.loadJSON('/data/testimonials.json');

        if (data) {
          // Validate and assign testimonials
          if (Array.isArray(data.testimonials)) {
            this.testimonials = data.testimonials;
          } else {
            console.warn('Unexpected testimonials array structure:', data);
            // Don't throw, just set empty testimonials if structure is off
            this.testimonials = [];
          }

          // Populate pageContent only if data is valid
          // Use defensive checks (|| {}) to ensure sub-objects exist even if data.json is missing them
          this.pageContent = {
            heroSection: data.heroSection || {},
            testimonialsSection: data.testimonialsSection || {},
            investorsSection: data.investorsSection || {}, // Ensure this is also captured if present in JSON
            // Add any other top-level sections you expect from this JSON
          };
        } else {
          console.warn('Empty or invalid data received from JSON.');
          throw new Error('Invalid data received from JSON.');
        }
      } catch (e) {
        console.error('Failed to load Wall of Love data:', e);
        this.error = `Failed to load content: ${e.message || e}`; // More specific error message
        this.testimonials = []; // Ensure testimonials is empty on error
        this.pageContent = null; // IMPORTANT: Set pageContent to null on error to keep template hidden
      } finally {
        this.loading = false; // Always set loading to false after the fetch attempt

        // Refresh AOS after content is potentially rendered by Alpine.js
        // $nextTick ensures DOM updates are flushed before AOS refresh
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
  };
}

// Make the component globally available for Alpine.js to discover.
window.testimonialsComponent = testimonialsComponent;

// --- GLOBAL UTILITY PLACEHOLDERS ---
// These are included here for completeness. In a real project,
// ensure these are defined in their respective utility files (e.g., api.js, dom.js, format.js)
// and loaded *before* this component script.

// Dummy window.api if not already defined (for local testing/dev)
if (typeof window.api === 'undefined') {
  window.api = {
    async loadJSON(path) {
      console.log('API: Loading JSON from:', path);
      try {
        const response = await fetch(path);
        if (!response.ok) {
          throw new Error(
            `HTTP error! status: ${response.status} from ${path}`
          );
        }
        return await response.json();
      } catch (e) {
        console.error('API: Error fetching JSON:', e);
        throw e; // Re-throw to be caught by the component's try-catch
      }
    },
  };
}

// Dummy window.dom if not already defined (for local testing/dev)
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

// Dummy window.format if not already defined (for local testing/dev)
if (typeof window.format === 'undefined') {
  window.format = {
    setDelays(items, baseDelay = 100) {
      // Ensures each item has a 'delay' property for AOS.
      // Modifies the original array.
      items.forEach((item, index) => {
        if (item.delay === undefined) {
          // Only set if not already defined
          item.delay = baseDelay * index;
        }
      });
      console.log('FORMAT: Delays potentially set on items.');
    },
  };
}
