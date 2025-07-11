// public/assets/js/components/featuresSectionApp.js

// No 'import' or 'export' statements here.
// All helper functions are expected to be available globally via the 'window' object.

function featuresSectionApp() {
  return {
    // ───────────────────────────────────────────────────────────────────────
    // STATE VARIABLES
    // ───────────────────────────────────────────────────────────────────────
    loading: false,
    featuresData: {
      mainHeading: '',
      subHeading: '',
      subDescription: '',
      items: [], // This will hold the actual feature items/tabs
    },
    activeFeatureTabId: '1', // State variable for the currently active tab ID
    autoSwitchInterval: 5000, // Tab switching interval (5 seconds)
    intervalId: null, // To store the interval ID for clearing it later

    // ───────────────────────────────────────────────────────────────────────
    // FETCH DATA FROM JSON FILE
    // ───────────────────────────────────────────────────────────────────────
    async loadFeaturesData() {
      try {
        this.loading = true;
        // Use the globally exposed loadJSON helper from window.api
        const rawData = await window.api.loadJSON(
          '/data/features-section.json'
        );
        this.featuresData = rawData;

        // After loading, ensure activeFeatureTabId is valid or set to the first item's ID
        if (
          this.featuresData.items.length > 0 &&
          !this.featuresData.items.some(
            (item) => item.id.toString() === this.activeFeatureTabId
          )
        ) {
          this.activeFeatureTabId = this.featuresData.items[0].id.toString();
        }
      } catch (e) {
        console.error('Error loading features data:', e);
        // You might want to set default empty state or show an error message in the UI here
      } finally {
        this.loading = false;
        // Refresh AOS using the globally exposed helper from window.dom
        this.$nextTick(() => {
          window.dom.refreshAOS();
        });
      }
    },

    // ───────────────────────────────────────────────────────────────────────
    // METHODS
    // ───────────────────────────────────────────────────────────────────────
    setFeatureTab(tabId) {
      this.activeFeatureTabId = tabId;
      // When a tab is manually set, reset the auto-switch timer
      this.resetAutoSwitchTimer();
    },

    advanceFeatureTab() {
      if (!this.featuresData.items || this.featuresData.items.length === 0) {
        return; // No tabs to advance
      }

      // Find the index of the current active tab
      const currentTabId = this.activeFeatureTabId;
      const currentIndex = this.featuresData.items.findIndex(
        (item) => item.id.toString() === currentTabId
      );

      let nextIndex;
      // Move to the previous tab (reversed as per your original code's logic)
      if (currentIndex === 0) {
        nextIndex = this.featuresData.items.length - 1; // Loop back to the last tab if currently on the first
      } else {
        nextIndex = currentIndex - 1; // Otherwise, go to the previous tab
      }

      this.activeFeatureTabId =
        this.featuresData.items[nextIndex].id.toString();
    },

    startAutoSwitchTimer() {
      // Clear any existing interval before starting a new one
      if (this.intervalId) {
        clearInterval(this.intervalId);
      }
      this.intervalId = setInterval(() => {
        this.advanceFeatureTab();
      }, this.autoSwitchInterval);
    },

    resetAutoSwitchTimer() {
      this.startAutoSwitchTimer(); // Simply restart the timer
    },

    // ───────────────────────────────────────────────────────────────────────
    // INITIALIZATION
    // ───────────────────────────────────────────────────────────────────────
    async init() {
      await this.loadFeaturesData();
      // Start auto-switching only if there are items and not currently loading
      if (!this.loading && this.featuresData.items.length > 0) {
        this.startAutoSwitchTimer();
      }
    },

    // Add a destroy hook to clear the interval when the component is removed from the DOM
    destroy() {
      if (this.intervalId) {
        clearInterval(this.intervalId);
      }
    },
  };
}

// Make the component available globally for Alpine.js to find
window.featuresSectionApp = featuresSectionApp;
