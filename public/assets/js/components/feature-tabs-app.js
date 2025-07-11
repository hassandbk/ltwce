// public/assets/js/components/featureTabs.js

// No 'import' or 'export' statements here.
// All helper functions are expected to be available globally via the 'window' object
// after being loaded by the CodeIgniter footer scripts.

function featureTabsComponent() {
  return {
    loading: false,
    tabs: [], // This will store the array of tab objects from the JSON
    activeTab: 0, // Stores the index of the currently active tab (0-indexed)

    async init() {
      this.loading = true;
      try {
        // Use the globally exposed loadJSON helper from window.api
        const data = await window.api.loadJSON('/data/featureTabs.json');

        // Ensure data.featureTabs exists and is an array before assigning
        if (data && Array.isArray(data.featureTabs)) {
          this.tabs = data.featureTabs; // Assign the array under 'featureTabs' key

          // Use the globally exposed setDelays helper from window.format
          // This will add an 'aosDelay' property to each tab object
          window.format.setDelays(this.tabs);

          // Set the initial active tab to the first item's index if data exists
          if (this.tabs.length > 0) {
            this.activeTab = 0;
          }
        } else {
          console.warn(
            'JSON data for featureTabs is missing or not an array:',
            data
          );
          this.tabs = []; // Ensure tabs is an empty array to prevent further errors
        }
      } catch (e) {
        console.error('Failed to load tabs:', e);
        this.tabs = []; // Ensure tabs is an empty array on error
        // Optionally, handle error state in UI
      } finally {
        this.loading = false;
        // Use the globally exposed refreshAOS helper from window.dom
        // This ensures AOS re-scans the DOM after dynamic content is loaded
        this.$nextTick(() => {
          window.dom.refreshAOS(); // <--- THIS IS THE LINE IN QUESTION
        });
      }
    },

    // Method to change the active tab based on its index
    selectTab(index) {
      this.activeTab = index;
      // If you had a scrolling feature, you would implement it here.
      // Example:
      // if (this.tabs[index] && this.tabs[index].targetId) {
      //    const targetElement = document.getElementById(this.tabs[index].targetId);
      //    if (targetElement) {
      //      window.dom.smoothScrollToElement(targetElement, 80); // Adjust offset as needed
      //    }
      // }
    },
  };
}

// Make the component available globally for Alpine.js to find
// The name 'featureTabsComponent' must match the x-data attribute in your HTML.
window.featureTabsComponent = featureTabsComponent;
