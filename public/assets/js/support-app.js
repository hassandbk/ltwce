// ─────────────────────────────────────────────────────────────────────────────
// HELPER: FETCH JSON FROM ANY GIVEN PATH, THROWS ON NON-OK RESPONSE
// ─────────────────────────────────────────────────────────────────────────────
async function loadJSON(path) {
  const res = await fetch(path);
  if (!res.ok) throw new Error(`Couldn’t load ${path}`);
  return res.json();
}

// ─────────────────────────────────────────────────────────────────────────────
// SUPPORTAPP: ALPINE COMPONENT FOR SUPPORT, SERVICES CAROUSEL, ETC.
//─────────────────────────────────────────────────────────────────────────────
function supportApp() {
  return {
    // ───────────────────────────────────────────────────────────────────────
    // STATE VARIABLES
    // ───────────────────────────────────────────────────────────────────────
    modal: null, // tracks current modal name
    loading: false, // global loading state for async operations
    showPwd: false, // Initialize for toggling password visibility
    showPwd2: false, // Initialize for toggling password visibility in signup
    showPwd3: false, // Initialize for toggling password visibility in reset
    // Data arrays
    articles: [],
    feedbackByArticle: {},
    sections: [],
    raw: [],
    services: [],
    team: [],
    testimonials: [], // textual testimonials
    videoTestimonials: [], // video testimonials
    features: [],
    tabs: [],
    locations: [],
    clients: [],
    activeTab: 0, // Initially, the first tab is active
    // Carousel settings
    secondsPerCard: 2,
    playing: true,

    // Pagination & Filters
    currentPage: 1,
    perPage: 6,
    viewMode: 'list',
    filters: { query: '', from: '', to: '' },
    servicesPerPage: 12, // Number of services per page
    gridView: true, // State to toggle between grid and list view

    // Authentication & forms
    login: { email: '', password: '' },
    forgot: { email: '', code: '' },
    reset: { password: '', confirm: '' },
    signup: { name: '', email: '', password: '', confirm: '' },
    form: {
      article: '',
      name: '',
      email: '',
      location: '',
      phone: '',
      message: '',
    },
    errors: {},
    selectedArticleId: 't1',

    // OTP Timer for forgot password
    otpTimer: 0,
    otpInterval: null,

    // Password strength indicators
    signupStrength: 0,
    resetStrength: 0,

    // ───────────────────────────────────────────────────────────────────────
    // DEFINE THE SETDELAYS FUNCTION
    // ───────────────────────────────────────────────────────────────────────
    setDelays(dataArray) {
      dataArray.forEach((item, index) => {
        // Automatically increment delay based on index
        item.delay = index * 100; // Adjust the multiplier (100) if needed
      });
    },

    // ───────────────────────────────────────────────────────────────────────
    // COMPUTED PROPERTIES
    // ───────────────────────────────────────────────────────────────────────
    get looped() {
      // Duplicate services array for infinite carousel
      return [...this.services, ...this.services];
    },
    get duration() {
      // Total duration for carousel scroll
      return (this.services.length || 1) * this.secondsPerCard;
    },
    get filtered() {
      // If no filters are applied, return all articles
      if (!this.filters.query && !this.filters.from && !this.filters.to) {
        return this.raw; // Return all articles when no filters are applied
      }

      // Filter articles by search query and date range
      return this.raw.filter((a) => {
        const q = this.filters.query.toLowerCase();
        const matches =
          !q ||
          a.headline.toLowerCase().includes(q) ||
          a.authorName.toLowerCase().includes(q) ||
          (a.excerpt && a.excerpt.toLowerCase().includes(q)) ||
          (a.body && a.body.toLowerCase().includes(q));

        const d = new Date(a.date);
        const fromOK = !this.filters.from || d >= new Date(this.filters.from);
        const toOK = !this.filters.to || d <= new Date(this.filters.to);

        return matches && fromOK && toOK;
      });
    },
    // Get services for current page
    get pagedServices() {
      const start = (this.currentPage - 1) * this.servicesPerPage;
      const end = start + this.servicesPerPage;
      return this.services.slice(start, end);
    },
    get servicesPageCount() {
      return Math.ceil(this.services.length / this.servicesPerPage); // Service pagination
    },
    get pageCount() {
      // Number of pages for pagination
      return Math.ceil(this.filtered.length / this.perPage) || 1;
    },
    get pagedItems() {
      // Items for current page
      const start = (this.currentPage - 1) * this.perPage;
      return this.filtered.slice(start, start + this.perPage);
    },
    // Method to get the link for each article
    linkFor(art) {
      // This assumes you have a `slug` property in your articles
      return art.slug
        ? `/blog/${art.slug}.html` // If the article has a slug, create a link like /blog/article-slug.html
        : `/blog.html?id=${art.id}`; // Otherwise, fallback to using the article ID
    },
    // Method to handle tab selection and smooth scroll
    selectTab(index) {
      this.activeTab = index; // Set the active tab index
      const section = document.getElementById(this.sections[index].id); // Use section's id for tab selection

      if (section) {
        // Offset scroll to account for the fixed header height
        const headerOffset = 80; // Adjust this value according to your nav height
        const elementPosition = section.getBoundingClientRect().top;
        const offsetPosition =
          elementPosition + window.pageYOffset - headerOffset;

        window.scrollTo({
          top: offsetPosition,
          behavior: 'smooth',
        });
      } else {
        console.warn(`Section with id '${this.sections[index].id}' not found!`);
      }
    },

    // ───────────────────────────────────────────────────────────────────────
    // LIFE-CYCLE: INIT
    // ───────────────────────────────────────────────────────────────────────
    async init() {
      try {
        // 1.

        const response = await fetch('/data/articles.json');
        const data = await response.json();
        this.sections = data.sections;

        // Populate the raw array with all articles from the sections
        this.raw = this.sections.flatMap((section) => section.articles);

        // 3. Load services and setup carousel
        this.loading = true; // Set loading state to true before fetching services
        this.services = await loadJSON('/data/services.json');
        this.loading = false; // Set loading state to false once services are loaded
        this.setupCarousel();

        // 4. Load team members
        const t = await loadJSON('/data/team.json');
        this.team = t.team;

        // 5. Load textual testimonials
        const txt = await loadJSON('/data/testimonials.json');
        this.testimonials = txt.testimonials;

        // 6. Load video testimonials
        const vid = await loadJSON('/data/videoTestimonials.json');
        this.videoTestimonials = vid.videoTestimonials || vid;

        // 7. Load feature list
        const f = await loadJSON('/data/features.json');
        this.features = f.features;

        // 8. Load tabs and select first
        const tb = await loadJSON('/data/tabs.json');
        this.tabs = tb.tabs;
        this.tab = this.tabs.length ? this.tabs[0].id : null;

        // 9. Load locations
        this.locations = await loadJSON('/data/locations.json');

        // 10. Load clients logos
        const cl = await loadJSON('/data/clients.json');
        this.clients = cl.clients;

        // 11. Set delays automatically based on the index in the array
        this.setDelays(this.sections); // Apply delays to sections
        this.setDelays(this.clients); // Apply delays to clients
        this.setDelays(this.features); // Apply delays to features
        this.setDelays(this.team); // Apply delays to team members
        this.setDelays(this.testimonials); // Apply delays to testimonials
        this.setDelays(this.videoTestimonials); // Apply delays to video testimonials
        this.setDelays(this.services); // Apply delays to services
        this.setDelays(this.tabs); // Apply delays to tabs
        this.setDelays(this.locations); // Apply delays to locations
      } catch (e) {
        console.error('Init error:', e);
      } finally {
        // Refresh AOS animations once all elements are in DOM
        this.$nextTick(() => {
          if (window.AOS) {
            window.AOS.refresh();
          }
        });
      }
    },

    // ───────────────────────────────────────────────────────────────────────
    // CAROUSEL CONTROLS
    // ───────────────────────────────────────────────────────────────────────
    pauseCarousel() {
      this.playing = false;
    },
    playCarousel() {
      this.playing = true;
    },

    // ───────────────────────────────────────────────────────────────────────
    // PAGINATION & FILTERS
    // ───────────────────────────────────────────────────────────────────────
    resetFilters() {
      this.filters = { query: '', from: '', to: '' };
      this.currentPage = 1;
    },
    selectArticle(id) {
      this.selectedArticleId = id;
    },
    // ───────────────────────────────────────────────────────────────────────
    // PAGINATION CONTROLS
    // ───────────────────────────────────────────────────────────────────────
    servicesNextPage() {
      if (this.currentPage < this.servicesPageCount) {
        this.currentPage++;
        this.scrollToTop(); // Scroll to top after next page
      }
    },

    servicesPrevPage() {
      if (this.currentPage > 1) {
        this.currentPage--;
        this.scrollToTop(); // Scroll to top after prev page
      }
    },

    scrollToTop() {
      window.scrollTo({ top: 0, behavior: 'smooth' });
    },

    // ───────────────────────────────────────────────────────────────────────
    // VIEW TOGGLE
    // ───────────────────────────────────────────────────────────────────────
    toggleView() {
      this.gridView = !this.gridView;
    },

    // ───────────────────────────────────────────────────────────────────────
    // FEEDBACK FORM SUBMISSION
    // ───────────────────────────────────────────────────────────────────────
    submitFeedback() {
      this.errors = {};
      // Validate required fields
      ['article', 'name', 'email', 'message'].forEach((f) => {
        if (!this.form[f])
          this.errors[f] = `${
            f.charAt(0).toUpperCase() + f.slice(1)
          } is required.`;
      });
      if (Object.keys(this.errors).length) return;

      const id = this.form.article || this.selectedArticleId;
      this.feedbackByArticle[id].push({
        userId: this.form.email.split('@')[0],
        name: this.form.name,
        email: this.form.email,
        location: this.form.location || 'Unknown',
        timestamp: Date.now(),
        message: this.form.message,
      });

      // Reset form fields
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
        if (el) el.scrollTop = el.scrollHeight;
      });
    },

    // ───────────────────────────────────────────────────────────────────────
    // UTILS: TIME AGO & AVATAR
    // ───────────────────────────────────────────────────────────────────────
    timeAgo(ts) {
      const d = Date.now() - ts;
      if (d < 60000) return 'just now';
      if (d < 3600000) return `${Math.floor(d / 60000)}m ago`;
      if (d < 86400000) return `${Math.floor(d / 3600000)}h ago`;
      return `${Math.floor(d / 86400000)}d ago`;
    },
    getAvatarUrl(u) {
      return `https://i.pravatar.cc/150?u=${u}`;
    },

    // ───────────────────────────────────────────────────────────────────────
    // MODAL & AUTH FLOW
    // ───────────────────────────────────────────────────────────────────────
    open(name) {
      this.modal = name;
      if (name === 'forgotOTP') this.startOtpTimer();
    },
    close() {
      this.modal = null;
      this.loading = false;
      clearInterval(this.otpInterval);
      this.otpTimer = 0;
    },

    simulate(ok = true, ms = 1000) {
      return new Promise((res, rej) =>
        setTimeout(() => (ok ? res() : rej()), ms)
      );
    },
    async doLogin() {
      this.loading = true;
      await this.simulate();
      this.loading = false;
      this.close();
    },
    social() {
      this.loading = true;
      this.simulate().then(() => {
        this.loading = false;
        this.close();
      });
    },

    // ───────────────────────────────────────────────────────────────────────
    // PASSWORD STRENGTH & RESET FLOW
    // ───────────────────────────────────────────────────────────────────────
    checkStrength(pw, which) {
      const tests = [/.{8,}/, /[A-Z]/, /\d/, /\W/];
      const score = tests.reduce((s, r) => s + (r.test(pw) ? 1 : 0), 0);
      if (which === 'signup') this.signupStrength = (score / 4) * 100;
      else this.resetStrength = (score / 4) * 100;
    },
    strengthBar(pct) {
      if (pct < 50) return { bg: 'bg-red-500' };
      if (pct < 75) return { bg: 'bg-yellow-500' };
      return { bg: 'bg-green-500' };
    },

    async doSignup() {
      this.loading = true;
      await this.simulate();
      this.loading = false;
      this.open('verifyEmail');
    },
    async resendVerify() {
      this.loading = true;
      await this.simulate();
      this.loading = false;
    },
    async sendResetOTP() {
      this.loading = true;
      await this.simulate();
      this.loading = false;
      this.open('forgotOTP');
    },

    startOtpTimer() {
      this.otpTimer = 60;
      this.otpInterval = setInterval(() => {
        if (this.otpTimer > 0) this.otpTimer--;
        else clearInterval(this.otpInterval);
      }, 1000);
    },

    async verifyResetOTP() {
      this.loading = true;
      await this.simulate();
      this.loading = false;
      this.open('resetPass');
    },
    async doResetPass() {
      this.loading = true;
      await this.simulate();
      this.loading = false;
      this.close();
    },

    // ───────────────────────────────────────────────────────────────────────
    // CAROUSEL SETUP
    // ───────────────────────────────────────────────────────────────────────
    setupCarousel() {
      this.$nextTick(() => {
        const track = this.$refs.track;
        if (!track) return;
        const dist = -(track.scrollWidth / 2) + 'px';
        track.style.setProperty('--scroll-dist', dist);
      });
    },
  };
}

// Expose globally
window.supportApp = supportApp;
