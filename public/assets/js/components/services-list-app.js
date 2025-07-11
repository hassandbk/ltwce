// src/components/services.js
function servicesListComponent() {
  return {
    loading: false,
    services: [],
    servicesPerPage: 12,
    currentPage: 1,
    gridView: true, // true for grid view, false for list view

    // Initialize the component
    async init() {
      this.loading = true;
      try {
        // Use the global loadJSON helper from window.api
        this.services = await window.api.loadJSON('/data/services.json');
        // Use the global setDelays helper from window.format
        window.format.setDelays(this.services);
      } catch (e) {
        console.error('Failed to load services list:', e);
        // Optionally, set an error state to display a message to the user
      } finally {
        this.loading = false;
        // Use the global refreshAOS helper from window.dom
        this.$nextTick(() => window.dom.refreshAOS());
      }
    },

    // Computed property to get services for the current page
    get pagedServices() {
      // Use the global getPagedItems helper from window.pagination
      return window.pagination.getPagedItems(
        this.services,
        this.currentPage,
        this.servicesPerPage
      );
    },

    // Computed property to get the total number of pages
    get servicesPageCount() {
      // Use the global getPageCount helper from window.pagination
      return window.pagination.getPageCount(
        this.services.length,
        this.servicesPerPage
      );
    },

    // Navigate to the next page of services
    servicesNextPage() {
      if (this.currentPage < this.servicesPageCount) {
        this.currentPage++;
        // Use the global scrollToTop helper from window.dom
        window.dom.scrollToTop();
      }
    },

    // Navigate to the previous page of services
    servicesPrevPage() {
      if (this.currentPage > 1) {
        this.currentPage--;
        // Use the global scrollToTop helper from window.dom
        window.dom.scrollToTop();
      }
    },

    // Toggle between grid and list view
    toggleView() {
      this.gridView = !this.gridView;
    },
  };
}

// Make the component available globally for Alpine.js to find
window.servicesListComponent = servicesListComponent;
