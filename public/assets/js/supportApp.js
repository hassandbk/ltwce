// ─────────────────────────────────────────────────────────────────────────────
// HELPER: FETCH JSON FROM ANY GIVEN PATH, THROWS ON NON-OK RESPONSE
// ─────────────────────────────────────────────────────────────────────────────
async function loadJSON(path) {
  const res = await fetch(path); // Fetch JSON from the specified path
  if (!res.ok) throw new Error(`Couldn’t load ${path}`); // Throw error if response is not OK
  return res.json(); // Return parsed JSON data
}

// ─────────────────────────────────────────────────────────────────────────────
// SUPPORTAPP: ALPINE COMPONENT FOR SUPPORT, SERVICES CAROUSEL, ETC.
// ─────────────────────────────────────────────────────────────────────────────
function supportApp() {
  return {
    // ───────────────────────────────────────────────────────────────────────
    // STATE VARIABLES
    // ───────────────────────────────────────────────────────────────────────
    modal: null, // Tracks current modal (login, signup, etc.)
    features: [], // Features loaded from 'features.json'
    tabs: [], // Tabs loaded from 'tabs.json'
    locations: [], // Locations loaded from 'locations.json'
    services: [], // Services loaded from 'services.json'
    secondsPerCard: 2, // Carousel speed in seconds
    playing: true, // Carousel state (true for playing, false for paused)

    // Login-related state
    login: {
      email: '',
      password: '',
    },
    showPwd: false, // Initialize showPwd to false (used to toggle password visibility)
    loading: false, // Loading state for async actions (e.g., login/signup)

    // Forgot password state
    forgot: {
      email: '',
      code: '',
    },

    // Password reset state
    reset: {
      password: '',
      confirm: '',
    },

    // Signup-related state
    signup: {
      name: '',
      email: '',
      password: '',
      confirm: '',
    },
    showPwd2: false, // Initialize showPwd2 to false (used to toggle password visibility in signup)
    signupStrength: 0,

    // Articles and feedback
    articles: [],
    feedbackByArticle: {}, // Feedback data grouped by article ID
    selectedArticleId: 't1', // Default selected article ID
    form: {
      article: '',
      name: '',
      email: '',
      location: '',
      phone: '', // Optional phone number
      message: '',
    },
    errors: {}, // Validation errors for feedback form
    sections: [],
    raw: [],

    // Pagination and view settings
    currentPage: 1, // Current page for pagination
    perPage: 6, // Articles per page
    viewMode: 'list', // View mode (list or grid)

    // Filters for articles
    filters: { query: '', from: '', to: '' }, // Filters for article search and date range

    // ───────────────────────────────────────────────────────────────────────
    // COMPUTED PROPERTIES
    // ───────────────────────────────────────────────────────────────────────
    get looped() {
      return [...this.services, ...this.services]; // Loop services for continuous carousel
    },

    get duration() {
      return (this.services.length || 1) * this.secondsPerCard; // Duration for carousel animation
    },

    get pageCount() {
      return Math.ceil(this.filtered.length / this.perPage) || 1; // Total page count for articles
    },

    get pagedItems() {
      const start = (this.currentPage - 1) * this.perPage;
      return this.filtered.slice(start, start + this.perPage); // Paginated filtered articles
    },

    get filtered() {
      return this.raw.filter((a) => {
        const q = this.filters.query.toLowerCase(); // Filter query in lowercase
        const matchesQ =
          !q ||
          a.headline.toLowerCase().includes(q) ||
          a.authorName.toLowerCase().includes(q) ||
          (a.excerpt && a.excerpt.toLowerCase().includes(q)) ||
          (a.body && a.body.toLowerCase().includes(q));
        const d = new Date(a.date);
        const fromOK = !this.filters.from || d >= new Date(this.filters.from); // Filter by start date
        const toOK = !this.filters.to || d <= new Date(this.filters.to); // Filter by end date
        return matchesQ && fromOK && toOK; // Return filtered articles
      });
    },

    // ───────────────────────────────────────────────────────────────────────
    // METHODS
    // ───────────────────────────────────────────────────────────────────────
    async init() {
      // Load support data (articles, feedback, etc.)
      try {
        const data = await loadJSON('/data/supportData.json');
        this.articles = data.articles;
        this.feedbackByArticle = {};
        for (const [aid, list] of Object.entries(data.feedbackByArticle)) {
          this.feedbackByArticle[aid] = list.map((fb) => ({
            ...fb,
            timestamp: Date.now() - fb.timestampDiff * 3600_000, // Adjust timestamp
          }));
        }
      } catch (e) {
        console.error('Support init error:', e); // Log error
      }

      // Load articles data
      try {
        const art = await loadJSON('/data/articles.json');
        this.sections = art.sections; // Store sections data
        this.raw = art.sections.flatMap((s) => s.articles); // Flatten articles array
        this.$nextTick(() => {
          if (window.AOS) window.AOS.refresh(); // Reinitialize AOS animations
        });
      } catch (e) {
        console.error('Articles load error:', e); // Log error
      }

      // Load services data and setup carousel
      try {
        this.services = await loadJSON('/data/services.json');
        this.$nextTick(() => {
          if (window.AOS) window.AOS.refresh(); // Reinitialize AOS
        });
        this.setupCarousel(); // Initialize carousel setup
      } catch (e) {
        console.error('Services load error:', e); // Log error
      }

      // Load other data files (team, testimonials, features, etc.)
      try {
        const team = await loadJSON('/data/team.json');
        this.team = team.team; // Store team data
      } catch (e) {
        console.error('Team load error:', e); // Log error
      }

      try {
        const testimonials = await loadJSON('/data/testimonials.json');
        this.testimonials = testimonials.testimonials; // Store testimonials data
      } catch (e) {
        console.error('Testimonials load error:', e); // Log error
      }

      try {
        const features = await loadJSON('/data/features.json');
        this.features = features.features; // Store features data
      } catch (e) {
        console.error('Features load error:', e); // Log error
      }

      try {
        const tabs = await loadJSON('/data/tabs.json');
        this.tabs = tabs.tabs;
        this.tab = this.tabs.length ? this.tabs[0].id : null; // Set default tab
      } catch (e) {
        console.error('Tabs load error:', e); // Log error
      }

      try {
        const locationsData = await loadJSON('/data/locations.json');
        this.locations = locationsData; // Store locations data
      } catch (e) {
        console.error('Locations load error:', e); // Log error
      }
    },

    // ───────────────────────────────────────────────────────────────────────
    // CAROUSEL CONTROL METHODS
    // ───────────────────────────────────────────────────────────────────────
    pauseCarousel() {
      this.playing = false; // Pause the carousel
    },

    playCarousel() {
      this.playing = true; // Resume carousel
    },

    // ───────────────────────────────────────────────────────────────────────
    // RESET FILTERS TO INITIAL STATE
    // ───────────────────────────────────────────────────────────────────────
    resetFilters() {
      this.filters = { query: '', from: '', to: '' }; // Reset search filters
      this.currentPage = 1; // Reset to the first page
    },

    selectArticle(id) {
      this.selectedArticleId = id; // Set selected article for detailed view
    },

    submitFeedback() {
      this.errors = {}; // Clear any previous validation errors
      // Validate form fields
      if (!this.form.article) this.errors.article = 'Topic is required.';
      if (!this.form.name) this.errors.name = 'Name is required.';
      if (!this.form.email) this.errors.email = 'Email is required.';
      if (!this.form.message) this.errors.message = 'Message is required.';
      if (Object.keys(this.errors).length) return; // If errors, prevent submission

      const id = this.form.article || this.selectedArticleId; // Use selected article or form article
      this.feedbackByArticle[id].push({
        userId: this.form.email.split('@')[0], // Generate user ID from email
        name: this.form.name,
        email: this.form.email,
        location: this.form.location || 'Unknown', // Default to 'Unknown' if no location
        timestamp: Date.now(), // Store timestamp
        message: this.form.message, // Store message content
      });

      // Reset form after submission
      this.form = {
        article: '',
        name: '',
        email: '',
        location: '',
        phone: '',
        message: '',
      };
      this.$nextTick(() => {
        const el = this.$refs.feedContainer;
        if (el) el.scrollTop = el.scrollHeight; // Scroll to latest feedback
      });
    },

    // ───────────────────────────────────────────────────────────────────────
    // TIME AGO (CONVERT TIMESTAMP TO READABLE FORMAT)
    // ───────────────────────────────────────────────────────────────────────
    timeAgo(ts) {
      const d = Date.now() - ts;
      if (d < 60_000) return 'just now';
      if (d < 3_600_000) return `${Math.floor(d / 60_000)}m ago`;
      if (d < 86_400_000) return `${Math.floor(d / 3_600_000)}h ago`;
      return `${Math.floor(d / 86_400_000)}d ago`; // Convert timestamp to human-readable format
    },

    // ───────────────────────────────────────────────────────────────────────
    // AVATAR URL GENERATOR
    // ───────────────────────────────────────────────────────────────────────
    getAvatarUrl(u) {
      return `https://i.pravatar.cc/150?u=${u}`; // Generate avatar URL based on user ID
    },

    // ───────────────────────────────────────────────────────────────────────
    // MODAL METHODS (OPEN/CLOSE)
    // ───────────────────────────────────────────────────────────────────────
    open(name) {
      this.modal = name; // Open a modal by its name
      if (name === 'forgotOTP') this.startOtpTimer(); // Start OTP timer if forgot password modal
    },

    close() {
      this.modal = null; // Close modal
      this.loading = false; // Reset loading state
      clearInterval(this.otpInterval); // Clear OTP timer
      this.otpTimer = 0; // Reset OTP timer
    },

    // ───────────────────────────────────────────────────────────────────────
    // SIMULATE ASYNC OPERATION (e.g., for login, signup)
    // ───────────────────────────────────────────────────────────────────────
    simulate(ok = true, ms = 1000) {
      return new Promise(
        (res, rej) => setTimeout(() => (ok ? res() : rej()), ms) // Simulate async behavior
      );
    },

    // ───────────────────────────────────────────────────────────────────────
    // USER LOGIN
    // ───────────────────────────────────────────────────────────────────────
    async doLogin() {
      this.loading = true; // Set loading state to true
      await this.simulate(); // Simulate async login action
      this.loading = false; // Set loading state to false
      this.close(); // Close modal after login
    },

    // ───────────────────────────────────────────────────────────────────────
    // SOCIAL LOGIN
    // ───────────────────────────────────────────────────────────────────────
    social(p) {
      this.loading = true; // Set loading state for social login
      this.simulate().then(() => {
        this.loading = false; // Set loading state to false after social login
        this.close(); // Close modal
      });
    },

    // ───────────────────────────────────────────────────────────────────────
    // PASSWORD STRENGTH CHECKER
    // ───────────────────────────────────────────────────────────────────────
    checkStrength(pw, which) {
      const tests = [/.{8,}/, /[A-Z]/, /\d/, /\W/]; // Password strength criteria
      const score = tests.reduce((s, r) => s + (r.test(pw) ? 1 : 0), 0); // Calculate score
      if (which === 'signup') this.signupStrength = (score / 4) * 100;
      // Set signup strength percentage
      else this.resetStrength = (score / 4) * 100; // Set reset password strength percentage
    },

    // ───────────────────────────────────────────────────────────────────────
    // STRENGTH BAR BASED ON PASSWORD STRENGTH
    // ───────────────────────────────────────────────────────────────────────
    strengthBar(pct) {
      if (pct < 50) return { bg: 'bg-red-500' }; // Red for weak password
      if (pct < 75) return { bg: 'bg-yellow-500' }; // Yellow for medium password
      return { bg: 'bg-green-500' }; // Green for strong password
    },

    // ───────────────────────────────────────────────────────────────────────
    // USER SIGNUP
    // ───────────────────────────────────────────────────────────────────────
    async doSignup() {
      this.loading = true; // Set loading state for signup
      await this.simulate(); // Simulate async signup process
      this.loading = false; // Set loading state to false
      this.open('verifyEmail'); // Open email verification modal
    },

    // ───────────────────────────────────────────────────────────────────────
    // RESEND EMAIL VERIFICATION
    // ───────────────────────────────────────────────────────────────────────
    async resendVerify() {
      this.loading = true; // Set loading state for resend verification
      await this.simulate(); // Simulate resend verification action
      this.loading = false; // Set loading state to false
    },

    // ───────────────────────────────────────────────────────────────────────
    // SEND OTP FOR RESET PASSWORD
    // ───────────────────────────────────────────────────────────────────────
    async sendResetOTP() {
      this.loading = true; // Set loading state to true
      await this.simulate(); // Simulate sending OTP
      this.loading = false; // Set loading state to false
      this.open('forgotOTP'); // Open OTP modal
    },

    // ───────────────────────────────────────────────────────────────────────
    // START OTP TIMER (FOR FORGOT PASSWORD)
    // ───────────────────────────────────────────────────────────────────────
    startOtpTimer() {
      this.otpTimer = 60; // Start OTP timer at 60 seconds
      this.otpInterval = setInterval(() => {
        if (this.otpTimer > 0)
          this.otpTimer--; // Decrease OTP timer every second
        else clearInterval(this.otpInterval); // Clear timer when it reaches zero
      }, 1000); // Run every second
    },

    // ───────────────────────────────────────────────────────────────────────
    // VERIFY OTP FOR PASSWORD RESET
    // ───────────────────────────────────────────────────────────────────────
    async verifyResetOTP() {
      this.loading = true; // Set loading state to true
      await this.simulate(); // Simulate OTP verification
      this.loading = false; // Set loading state to false
      this.open('resetPass'); // Open reset password modal
    },

    // ───────────────────────────────────────────────────────────────────────
    // RESET PASSWORD
    // ───────────────────────────────────────────────────────────────────────
    async doResetPass() {
      this.loading = true; // Set loading state to true
      await this.simulate(); // Simulate password reset
      this.loading = false; // Set loading state to false
      this.close(); // Close modal after reset
    },

    // ───────────────────────────────────────────────────────────────────────
    // CAROUSEL SETUP
    // ───────────────────────────────────────────────────────────────────────
    setupCarousel() {
      this.$nextTick(() => {
        const track = this.$refs.track; // Get reference to the carousel track
        if (!track) return;
        const dist = -(track.scrollWidth / 2) + 'px'; // Calculate scroll distance
        track.style.setProperty('--scroll-dist', dist); // Set custom scroll distance for carousel
      });
    },
  };
}

// Expose the supportApp globally
window.supportApp = supportApp;
