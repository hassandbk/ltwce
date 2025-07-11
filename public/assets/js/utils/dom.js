// public\assets\js\utils\dom.js
(function (window) {
  /**
   * Scrolls the window to the top smoothly.
   */
  function scrollToTop() {
    window.scrollTo({ top: 0, behavior: 'smooth' });
  }

  /**
   * Smoothly scrolls to a target DOM element with an optional offset.
   * @param {HTMLElement} element - The target DOM element to scroll to.
   * @param {number} offset - The offset from the top of the element (e.g., for fixed headers).
   */
  function smoothScrollToElement(element, offset = 0) {
    if (element) {
      const elementPosition = element.getBoundingClientRect().top;
      const offsetPosition = elementPosition + window.pageYOffset - offset;

      window.scrollTo({
        top: offsetPosition,
        behavior: 'smooth',
      });
    } else {
      console.warn('Element not found for smooth scroll.');
    }
  }

  /**
   * Refreshes AOS (Animate On Scroll) library.
   */
  function refreshAOS() {
    if (window.AOS) {
      window.AOS.refresh();
    }
  }

  // Expose functions globally under a 'dom' namespace
  window.dom = window.dom || {}; // Ensure window.dom exists
  window.dom.scrollToTop = scrollToTop;
  window.dom.smoothScrollToElement = smoothScrollToElement;
  window.dom.refreshAOS = refreshAOS;
})(window);
