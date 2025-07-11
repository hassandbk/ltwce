// public/assets/js/components/featureCardsApp.js

// No 'import' or 'export' statements here.
// All helper functions are expected to be available globally via the 'window' object.

function featureCardsApp() {
  return {
    // ───────────────────────────────────────────────────────────────────────
    // STATE VARIABLES
    // ───────────────────────────────────────────────────────────────────────
    loading: false,
    featureCardsData: {
      mainHeading: '',
      subDescription: '',
      cards: [], // This will hold your feature card items
    },

    // ───────────────────────────────────────────────────────────────────────
    // FETCH DATA FROM JSON FILE
    // ───────────────────────────────────────────────────────────────────────
    async loadFeatureCardsData() {
      try {
        this.loading = true;
        // Use the globally exposed loadJSON helper from window.api
        const rawData = await window.api.loadJSON(
          '/data/features-card-section.json'
        );
        this.featureCardsData = rawData;

        // Apply delays to the cards for staggered animations, using window.format.setDelays
        window.format.setDelays(this.featureCardsData.cards);
      } catch (e) {
        console.error('Error loading feature cards data:', e);
        // Implement fallback UI or error message here if the data fails to load
      } finally {
        this.loading = false;
        // Refresh AOS after the content is loaded and available in the DOM, using window.dom.refreshAOS
        this.$nextTick(() => {
          window.dom.refreshAOS();
        });
      }
    },

    // ───────────────────────────────────────────────────────────────────────
    // INITIALIZATION
    // ───────────────────────────────────────────────────────────────────────
    async init() {
      await this.loadFeatureCardsData();
    },
  };
}

// Make the component available globally for Alpine.js to find
window.featureCardsApp = featureCardsApp;
