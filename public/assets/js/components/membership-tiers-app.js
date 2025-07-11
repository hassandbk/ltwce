// public/assets/js/components/membershipTiersApp.js

// No 'import' or 'export' statements here.
// All helper functions are expected to be available globally via the 'window' object.

function membershipTiersApp() {
  return {
    // ───────────────────────────────────────────────────────────────────────
    // STATE VARIABLES
    // ───────────────────────────────────────────────────────────────────────
    loading: true, // Reintroduce loading state for a smoother initial experience
    showShares: false, // Controls the toggle for fee vs shares
    tiersData: {
      mainHeading: '',
      subDescription: '',
      toggleLabels: {
        fee: '',
        shares: '',
      },
      sharesPricePerUnit: 0,
      tiers: [], // This array will hold your membership tier data
    },

    // ───────────────────────────────────────────────────────────────────────
    // UTILITY FUNCTIONS (Specific to this component or global if moved)
    // ───────────────────────────────────────────────────────────────────────

    // HELPER FUNCTION FOR CURRENCY/NUMBER FORMATTING (specific to Uganda Shillings)
    // Keep this here if it's unique to this component or extract to utils/format.js
    // if other components will also format UGX numbers.
    formatNumber(number) {
      // Formats number for en-UG locale, removing commas and using thin space as thousands separator
      return number
        .toLocaleString('en-UG', {
          minimumFractionDigits: 0,
          maximumFractionDigits: 0,
        })
        .replace(/,/g, '\u202F'); // Replace standard comma with thin space (U+202F)
    },

    // ───────────────────────────────────────────────────────────────────────
    // DATA LOADING
    // Fetches the membership tiers JSON data directly.
    // ───────────────────────────────────────────────────────────────────────
    async loadTiersData() {
      try {
        this.loading = true; // Set loading state to true before fetch
        // Use the globally exposed loadJSON helper from window.api
        const rawData = await window.api.loadJSON(
          '/data/membership-tiers-section.json'
        );
        this.tiersData = rawData;

        // Apply AOS delays to the tiers *after* data is loaded using window.format.setDelays
        window.format.setDelays(this.tiersData.tiers);
      } catch (e) {
        console.error('Error loading membership tiers data:', e);
        // Optionally, set an error message state here to display to the user
      } finally {
        this.loading = false; // Ensure loading state is reset even on error
        // Refresh AOS after content is loaded and the DOM is updated, using window.dom.refreshAOS
        this.$nextTick(() => {
          window.dom.refreshAOS();
        });
      }
    },

    // ───────────────────────────────────────────────────────────────────────
    // INITIALIZATION
    // Called by Alpine.js when the component is mounted.
    // ───────────────────────────────────────────────────────────────────────
    async init() {
      await this.loadTiersData();
    },
  };
}

// Make the component available globally for Alpine.js to find
window.membershipTiersApp = membershipTiersApp;
