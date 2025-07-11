// public/assets/js/components/services-carousel.js

/**
 * Alpine.js component for the Services Carousel section.
 * Fetches services data and handles the infinite auto-scrolling carousel logic.
 * Relies on `window.api.loadJSON` for data fetching.
 */
function servicesCarouselComponent() {
  return {
    // ───────────────────────────────────────────────────────────────────────
    // STATE VARIABLES
    // ───────────────────────────────────────────────────────────────────────
    loading: true, // Set to true by default for initial loading state
    services: [], // Array to hold the fetched services data
    error: null, // Stores any error messages during data loading
    secondsPerCard: 2, // How many seconds it takes for one card to scroll past
    playing: true, // Controls if the carousel animation is running

    // ───────────────────────────────────────────────────────────────────────
    // COMPUTED PROPERTIES
    // These values are derived from the state and automatically update.
    // ───────────────────────────────────────────────────────────────────────
    get loopedServices() {
      // Duplicate the services array to create a seamless infinite scroll effect.
      // This allows the animation to loop back to the start without a visual jump.
      return [...this.services, ...this.services];
    },
    get carouselDuration() {
      // Calculate the total duration for one full scroll cycle.
      // This is the number of original services multiplied by seconds per card.
      // Ensures the animation speed is consistent regardless of the number of services.
      return (this.services.length || 1) * this.secondsPerCard;
    },

    // ───────────────────────────────────────────────────────────────────────
    // METHODS
    // ───────────────────────────────────────────────────────────────────────
    /**
     * Initializes the component by loading services data and setting up the carousel animation.
     */
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

        // Fetch the services data from the JSON file.
        const data = await window.api.loadJSON('/data/services.json');

        // Basic validation of the fetched data.
        if (Array.isArray(data)) {
          this.services = data;
        } else {
          console.warn('services.json data is not an array:', data);
          this.services = []; // Ensure it's an array to prevent rendering errors
          this.error = 'Invalid services data received.';
        }
      } catch (e) {
        console.error('Failed to load services for carousel:', e);
        this.services = []; // Ensure services is empty on error
        this.error = `Failed to load services: ${e.message || e}`;
        // The UI's x-show="error" will now display this message.
      } finally {
        this.loading = false; // Always set loading to false in finally block.

        // --- Carousel Animation Setup ---
        // Use $nextTick to ensure the DOM has been updated by Alpine.js
        // (i.e., x-for has rendered the cards) before calculating dimensions.
        this.$nextTick(() => {
          const track = this.$refs.track; // Get a reference to the scrolling track element

          if (track && this.services.length > 0) {
            // Calculate the total width of the *original* set of cards.
            // The animation will scroll exactly this distance to achieve an infinite loop.
            // The scrollWidth is the entire content width, including hidden parts.
            // We need to scroll half of the total track's width because we duplicated the services.
            const totalTrackWidth = track.scrollWidth;
            const scrollDistance = -(totalTrackWidth / 2); // Negative for leftward scroll

            // Set CSS custom properties (variables) for use in the CSS animation.
            track.style.setProperty('--scroll-dist', `${scrollDistance}px`);
            track.style.setProperty(
              '--scroll-duration',
              `${this.carouselDuration}s`
            );

            // Optional: If you had AOS elements within your carousel cards
            // and they needed refreshing after dynamic content, you'd put
            // window.dom.refreshAOS() here, inside this $nextTick.
            // However, typical AOS usage doesn't apply to continuously scrolling elements.
          } else if (!track) {
            console.warn("Carousel track element (x-ref='track') not found.");
          }
        });
      }
    },

    /**
     * Pauses the carousel animation.
     */
    pauseCarousel() {
      this.playing = false;
    },

    /**
     * Resumes the carousel animation.
     */
    playCarousel() {
      this.playing = true;
    },
  };
}

// Make the component available globally for Alpine.js to find.
// The name 'servicesCarouselComponent' must match the x-data attribute in your HTML.
window.servicesCarouselComponent = servicesCarouselComponent;
