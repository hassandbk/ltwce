// public\assets\js\helpers\api.js
(function (window) {
  /**
   * Loads JSON data from a specified path.
   * @param {string} path - The path to the JSON file.
   * @returns {Promise<Object>} - A promise that resolves with the JSON data.
   */
  async function loadJSON(path) {
    try {
      const response = await fetch(path);
      if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status} from ${path}`);
      }
      return await response.json();
    } catch (error) {
      console.error(`Error loading JSON from ${path}:`, error);
      throw error; // Re-throw to allow calling context to handle
    }
  }

  /**
   * Simulates an asynchronous operation (e.g., an API call).
   * Useful for testing UI states without a real backend.
   * @param {boolean} ok - Whether the simulation should succeed or fail.
   * @param {number} ms - The duration of the simulation in milliseconds.
   * @returns {Promise<void>} - A promise that resolves or rejects after the specified time.
   */
  function simulateApiCall(ok = true, ms = 1000) {
    return new Promise((res, rej) =>
      setTimeout(() => (ok ? res() : rej(new Error('Simulated API error'))), ms)
    );
  }

  // Expose functions globally under a 'api' namespace
  window.api = window.api || {}; // Ensure window.api exists
  window.api.loadJSON = loadJSON;
  window.api.simulateApiCall = simulateApiCall;
})(window);
