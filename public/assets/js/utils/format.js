// public/assets/js/utils/format.js
(function (window) {
  /**
   * Formats a timestamp into a human-readable "time ago" string.
   * @param {number} timestamp - The timestamp in milliseconds.
   * @returns {string} - The "time ago" string.
   */
  function timeAgo(timestamp) {
    const diff = Date.now() - timestamp;
    if (diff < 60000) return 'just now';
    if (diff < 3600000) return `${Math.floor(diff / 60000)}m ago`;
    if (diff < 86400000) return `${Math.floor(diff / 3600000)}h ago`;
    return `${Math.floor(diff / 86400000)}d ago`;
  }

  /**
   * Generates an avatar URL based on a user identifier.
   * @param {string} userId - A unique identifier for the user.
   * @returns {string} - The URL for the avatar image.
   */
  function getAvatarUrl(userId) {
    return `https://i.pravatar.cc/150?u=${userId}`;
  }

  /**
   * Automatically sets an 'aosDelay' property on each item in an array based on its index.
   * Useful for staggered animations with AOS.
   * @param {Array} dataArray - The array of objects to modify.
   * @param {number} multiplier - The value by which to multiply the index for the delay (in ms).
   */
  function setDelays(dataArray, multiplier = 100) {
    // Added a check to ensure dataArray is an array before iterating
    if (!Array.isArray(dataArray)) {
      console.warn('setDelays received non-array data:', dataArray);
      return; // Exit if not an array to prevent TypeError
    }
    dataArray.forEach((item, index) => {
      // Using 'aosDelay' to be specific for AOS animations
      item.aosDelay = index * multiplier;
    });
  }

  /**
   * Generates a link for an article based on its slug or ID.
   * @param {Object} article - The article object.
   * @returns {string} - The URL for the article.
   */
  function linkForArticle(article) {
    return article.slug
      ? `/blog/${article.slug}.html`
      : `/blog.html?id=${article.id}`;
  }

  // Expose functions globally under a 'format' namespace
  window.format = window.format || {}; // Ensure window.format exists
  window.format.timeAgo = timeAgo;
  window.format.getAvatarUrl = getAvatarUrl;
  window.format.setDelays = setDelays;
  window.format.linkForArticle = linkForArticle;
})(window);
