// public/assets/js/components/team-app.js

/**
 * Alpine.js component for the Team section.
 * Fetches team member data and displays it dynamically.
 * Relies on global utility functions: window.api.loadJSON, window.format.setDelays, window.dom.refreshAOS.
 */
function teamComponent() {
  return {
    // ───────────────────────────────────────────────────────────────────────
    // STATE VARIABLES
    // ───────────────────────────────────────────────────────────────────────
    loading: true, // Indicates if data is currently being loaded
    mainHeading: '', // New: Stores the main heading for the team section
    subHeading: '', // New: Stores an optional sub-heading
    team: [], // Array to store team member data from JSON
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

        const rawData = await window.api.loadJSON('/data/team.json');

        // Validate the structure of the loaded data
        if (
          rawData &&
          typeof rawData === 'object' &&
          Array.isArray(rawData.team)
        ) {
          this.mainHeading = rawData.mainHeading || ''; // Get main heading
          this.subHeading = rawData.subHeading || ''; // Get sub-heading
          this.team = rawData.team;

          // Ensure window.format and setDelays are available for AOS animations.
          if (
            typeof window.format === 'undefined' ||
            typeof window.format.setDelays !== 'function'
          ) {
            console.warn(
              'window.format.setDelays is not defined. AOS delays for team members may not be applied.'
            );
          } else {
            // Apply AOS delays for staggered animations.
            window.format.setDelays(this.team); // This will add 'aosDelay' property
          }
        } else {
          console.warn(
            'JSON data for team is missing or not an array under "team" key:',
            rawData
          );
          this.team = []; // Ensure team is an empty array to prevent rendering errors
          this.error = 'Failed to load valid team data.';
        }
      } catch (e) {
        console.error('Failed to load team data:', e);
        this.team = []; // Ensure team is empty on error
        this.error = `Failed to load team data: ${e.message || e}`;
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
              'window.dom.refreshAOS is not defined. AOS animations for team may not trigger correctly.'
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
window.teamComponent = teamComponent;
