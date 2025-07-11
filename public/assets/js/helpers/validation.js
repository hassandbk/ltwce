// public\assets\js\helpers\validation.js
(function (window) {
  /**
   * Validates an object against a list of required fields.
   * @param {Object} data - The object to validate.
   * @param {Array<string>} requiredFields - An array of field names that must not be empty.
   * @returns {Object} - An object containing validation errors, or empty if no errors.
   */
  function validateRequiredFields(data, requiredFields) {
    const errors = {};
    requiredFields.forEach((field) => {
      if (!data[field] || String(data[field]).trim() === '') {
        errors[field] = `${
          field.charAt(0).toUpperCase() + field.slice(1)
        } is required.`;
      }
    });
    return errors;
  }

  /**
   * Basic email validation.
   * @param {string} email - The email string to validate.
   * @returns {boolean} - True if valid, false otherwise.
   */
  function isValidEmail(email) {
    const re =
      /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
  }

  /**
   * Checks the strength of a given password and returns a percentage score.
   * @param {string} password - The password string to check.
   * @returns {number} - The strength percentage (0-100).
   */
  function checkPasswordStrength(password) {
    const tests = [
      /.{8,}/, // Minimum 8 characters
      /[A-Z]/, // At least one uppercase letter
      /\d/, // At least one digit
      /\W|_/, // At least one special character (or underscore)
    ];
    // Calculate score based on how many tests pass
    const score = tests.reduce(
      (currentScore, regex) => currentScore + (regex.test(password) ? 1 : 0),
      0
    );
    // Convert score to a percentage (out of 4 tests)
    return (score / tests.length) * 100;
  }

  // Expose functions globally under a 'validation' namespace
  window.validation = window.validation || {}; // Ensure window.validation exists
  window.validation.validateRequiredFields = validateRequiredFields;
  window.validation.isValidEmail = isValidEmail;
  window.validation.checkPasswordStrength = checkPasswordStrength;
})(window);
