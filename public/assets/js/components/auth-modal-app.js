// public/assets/js/components/authModalApp.js

// No more import statements here!
// The helper functions are now expected to be available globally via the `window` object
// after being loaded by the CodeIgniter footer scripts.

// Removed 'export' keyword as this file is not loaded as a module.
function authModalApp() {
  // Initial form states for easy resetting
  const initialLoginState = { email: '', password: '' };
  const initialForgotState = { email: '', code: Array(6).fill('') };
  const initialResetState = { password: '', confirm: '' };
  const initialSignupState = { name: '', email: '', password: '', confirm: '' };

  return {
    // ───────────────────────────────────────────────────────────────────────
    // STATE VARIABLES
    // ───────────────────────────────────────────────────────────────────────
    modal: null, // Tracks the name of the currently open modal
    loading: false, // Global loading state for async auth operations
    showPwd: false, // Toggles visibility for login password
    showPwd2: false, // Toggles visibility for signup password
    showPwd3: false, // Toggles visibility for reset password

    // Form data for different auth flows
    login: { ...initialLoginState },
    forgot: { ...initialForgotState },
    reset: { ...initialResetState },
    signup: { ...initialSignupState },

    errors: {}, // Stores validation errors for forms

    // OTP Timer for forgot password flow
    otpTimer: 0,
    otpInterval: null,

    // Password strength indicators
    signupStrength: 0,
    resetStrength: 0,

    // ───────────────────────────────────────────────────────────────────────
    // COMPUTED PROPERTIES
    // ───────────────────────────────────────────────────────────────────────

    // Returns Tailwind CSS classes for the password strength bar based on percentage.
    strengthBar(pct) {
      if (pct < 50) return { bg: 'bg-red-500' };
      if (pct < 75) return { bg: 'bg-yellow-500' };
      return { bg: 'bg-green-500' };
    },

    // ───────────────────────────────────────────────────────────────────────
    // MODAL CONTROL METHODS
    // ───────────────────────────────────────────────────────────────────────

    // Opens a specific modal by name.
    open(name) {
      this.modal = name;
      // If opening the OTP modal, start the timer
      if (name === 'forgotOTP') {
        this.startOtpTimer();
      }
    },

    // Closes the currently open modal and resets related states.
    close() {
      this.modal = null;
      this.loading = false;
      // Clear OTP timer if it's running
      clearInterval(this.otpInterval);
      this.otpTimer = 0;
      this.errors = {}; // Clear errors on close
      // Reset form data
      this.login = { ...initialLoginState };
      this.forgot = { ...initialForgotState };
      this.reset = { ...initialResetState };
      this.signup = { ...initialSignupState };
      this.signupStrength = 0;
      this.resetStrength = 0;
    },

    // ───────────────────────────────────────────────────────────────────────
    // AUTHENTICATION FLOW SIMULATION METHODS
    // (Replace these with actual API calls to your backend)
    // ───────────────────────────────────────────────────────────────────────

    // Handles login submission.
    async doLogin() {
      this.loading = true;
      this.errors = {};

      // Use the global validation functions from window.validation
      const fieldErrors = window.validation.validateRequiredFields(this.login, [
        'email',
        'password',
      ]);
      if (
        this.login.email &&
        !window.validation.isValidEmail(this.login.email)
      ) {
        fieldErrors.email = 'Please enter a valid email address.';
      }
      this.errors = fieldErrors;

      if (Object.keys(this.errors).length) {
        this.loading = false;
        return;
      }

      try {
        // Use the global API function from window.api
        await window.api.simulateApiCall(); // Simulate API call
        this.close(); // Close modal on successful login
        console.log('Login successful!');
      } catch (e) {
        console.error('Login failed:', e);
        this.errors.general = 'Login failed. Please check your credentials.'; // Display general error
      } finally {
        this.loading = false;
      }
    },

    // Handles social login (e.g., Google, Facebook).
    async social() {
      this.loading = true;
      try {
        // Use the global API function from window.api
        await window.api.simulateApiCall();
        this.close();
        console.log('Social login initiated!');
      } catch (e) {
        console.error('Social login failed:', e);
        this.errors.general = 'Social login failed.';
      } finally {
        this.loading = false;
      }
    },

    // Handles signup submission.
    async doSignup() {
      this.loading = true;
      this.errors = {};

      // Use the global validation functions from window.validation
      const fieldErrors = window.validation.validateRequiredFields(
        this.signup,
        ['name', 'email', 'password', 'confirm']
      );
      if (
        this.signup.email &&
        !window.validation.isValidEmail(this.signup.email)
      ) {
        fieldErrors.email = 'Please enter a valid email address.';
      }
      if (this.signup.password !== this.signup.confirm) {
        fieldErrors.confirm = 'Passwords do not match.';
      }
      if (this.signupStrength < 75) {
        fieldErrors.password = 'Password is too weak.';
      }
      this.errors = fieldErrors;

      if (Object.keys(this.errors).length) {
        this.loading = false;
        return;
      }

      try {
        // Use the global API function from window.api
        await window.api.simulateApiCall(); // Simulate API call
        this.open('verifyEmail'); // Open email verification modal
        console.log('Signup successful, verification email sent!');
      } catch (e) {
        console.error('Signup failed:', e);
        this.errors.general = 'Signup failed. Please try again.';
      } finally {
        this.loading = false;
      }
    },

    // Resends verification email.
    async resendVerify() {
      this.loading = true;
      try {
        // Use the global API function from window.api
        await window.api.simulateApiCall();
        console.log('Verification email resent!');
      } catch (e) {
        console.error('Resend verification failed:', e);
      } finally {
        this.loading = false;
      }
    },

    // Sends OTP for password reset.
    async sendResetOTP() {
      this.loading = true;
      this.errors = {};

      // Use the global validation functions from window.validation
      const fieldErrors = window.validation.validateRequiredFields(
        this.forgot,
        ['email']
      );
      if (
        this.forgot.email &&
        !window.validation.isValidEmail(this.forgot.email)
      ) {
        fieldErrors.email = 'Please enter a valid email address.';
      }
      this.errors = fieldErrors;

      if (Object.keys(this.errors).length) {
        this.loading = false;
        return;
      }

      try {
        // Use the global API function from window.api
        await window.api.simulateApiCall();
        this.open('forgotOTP'); // Open OTP verification modal
        console.log('OTP sent to email!');
      } catch (e) {
        console.error('Sending OTP failed:', e);
        this.errors.general = 'Failed to send OTP. Please try again.';
      } finally {
        this.loading = false;
      }
    },

    // Starts the OTP countdown timer.
    startOtpTimer() {
      this.otpTimer = 60; // Start from 60 seconds
      clearInterval(this.otpInterval); // Clear any existing interval
      this.otpInterval = setInterval(() => {
        if (this.otpTimer > 0) {
          this.otpTimer--;
        } else {
          clearInterval(this.otpInterval); // Stop timer when it reaches 0
        }
      }, 1000);
    },

    // Verifies the entered OTP.
    async verifyResetOTP() {
      this.loading = true;
      this.errors = {};

      // Use the global validation functions from window.validation
      const fieldErrors = window.validation.validateRequiredFields(
        this.forgot,
        ['code']
      );
      this.errors = fieldErrors;

      if (Object.keys(this.errors).length) {
        this.loading = false;
        return;
      }

      try {
        // Use the global API function from window.api
        await window.api.simulateApiCall();
        this.open('resetPass'); // Open password reset form
        console.log('OTP verified!');
      } catch (e) {
        console.error('OTP verification failed:', e);
        this.errors.general = 'Invalid OTP. Please try again.';
      } finally {
        this.loading = false;
      }
    },

    // Resets the password.
    async doResetPass() {
      this.loading = true;
      this.errors = {};

      // Use the global validation functions from window.validation
      const fieldErrors = window.validation.validateRequiredFields(this.reset, [
        'password',
        'confirm',
      ]);
      if (this.reset.password !== this.reset.confirm) {
        fieldErrors.confirm = 'Passwords do not match.';
      }
      if (this.resetStrength < 75) {
        fieldErrors.password = 'Password is too weak.';
      }
      this.errors = fieldErrors;

      if (Object.keys(this.errors).length) {
        this.loading = false;
        return;
      }

      try {
        // Use the global API function from window.api
        await window.api.simulateApiCall();
        this.close(); // Close modal on successful password reset
        console.log('Password reset successful!');
      } catch (e) {
        console.error('Password reset failed:', e);
        this.errors.general = 'Password reset failed. Please try again.';
      } finally {
        this.loading = false;
      }
    },

    // ───────────────────────────────────────────────────────────────────────
    // PASSWORD STRENGTH CHECKING
    // ───────────────────────────────────────────────────────────────────────

    // Wrapper around the external checkPasswordStrength function
    checkStrength(password, whichForm) {
      // Use the global validation function from window.validation
      const percentage = window.validation.checkPasswordStrength(password);
      if (whichForm === 'signup') {
        this.signupStrength = percentage;
      } else if (whichForm === 'reset') {
        this.resetStrength = percentage;
      }
    },

    // ───────────────────────────────────────────────────────────────────────
    // INITIALIZATION
    // ───────────────────────────────────────────────────────────────────────
    init() {
      // Any initial setup for the auth component, if needed.
    },
  };
}

// Make the component available globally for Alpine.js to find
window.authModalApp = authModalApp;
