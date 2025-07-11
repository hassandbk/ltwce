// public\assets\js\helpers\pagination.js
(function (window) {
  /**
   * Filters a list of items based on a query and date range.
   * @param {Array} items - The array of items to filter.
   * @param {Object} filters - The filter criteria ({ query, from, to }).
   * @param {Function} [filterLogic] - Optional custom filter function.
   * @returns {Array} - The filtered array.
   */
  function filterItems(items, filters, filterLogic = null) {
    const { query, from, to } = filters;

    if (!query && !from && !to && !filterLogic) {
      return items;
    }

    // Use custom filter logic if provided, otherwise default for articles
    if (filterLogic) {
      return items.filter((item) => filterLogic(item, filters));
    }

    // Default filtering logic (e.g., for articles)
    const q = query ? query.toLowerCase() : '';

    return items.filter((item) => {
      const matchesQuery =
        !q ||
        (item.headline && item.headline.toLowerCase().includes(q)) ||
        (item.authorName && item.authorName.toLowerCase().includes(q)) ||
        (item.excerpt && item.excerpt.toLowerCase().includes(q)) ||
        (item.body && item.body.toLowerCase().includes(q));

      const itemDate = item.date ? new Date(item.date) : null;
      const fromDate = from ? new Date(from) : null;
      const toDate = to ? new Date(to) : null;

      const fromOK = !fromDate || (itemDate && itemDate >= fromDate);
      const toOK = !toDate || (itemDate && itemDate <= toDate);

      return matchesQuery && fromOK && toOK;
    });
  }

  /**
   * Calculates the total number of pages.
   * @param {number} totalItems - The total number of items.
   * @param {number} itemsPerPage - The number of items per page.
   * @returns {number} - The total page count.
   */
  function getPageCount(totalItems, itemsPerPage) {
    return Math.ceil(totalItems / itemsPerPage) || 1;
  }

  /**
   * Returns the items for the current page.
   * @param {Array} items - The array of all items.
   * @param {number} currentPage - The current page number (1-indexed).
   * @param {number} itemsPerPage - The number of items per page.
   * @returns {Array} - The items for the current page.
   */
  function getPagedItems(items, currentPage, itemsPerPage) {
    const start = (currentPage - 1) * itemsPerPage;
    return items.slice(start, start + itemsPerPage);
  }

  // Expose functions globally under a 'pagination' namespace
  window.pagination = window.pagination || {}; // Ensure window.pagination exists
  window.pagination.filterItems = filterItems;
  window.pagination.getPageCount = getPageCount;
  window.pagination.getPagedItems = getPagedItems;
})(window);
