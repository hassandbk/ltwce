// src/components/feedbackApp.js
function feedbackApp() {
  return {
    // ───────────────────────────────────────────────────────────────────────
    // STATE VARIABLES
    // ───────────────────────────────────────────────────────────────────────
    loading: false, // Global loading state for async operations
    searchQuery: '', // Input for filtering articles
    sections: [], // List of all sections (e.g., categories for articles)
    articles: [], // Articles associated with each section (flattened list)
    feedbackByArticle: {}, // Feedback data mapped by article ID
    selectedSectionId: null, // Currently selected section ID
    selectedArticleId: null, // Currently selected article ID
    faqs: [], // FAQ data

    form: {
      // State for the feedback submission form
      article: '', // This will typically be pre-filled by selectedArticleId
      name: '',
      email: '',
      location: '',
      phone: '',
      message: '',
    },
    errors: {}, // Object to store form validation errors

    // ───────────────────────────────────────────────────────────────────────
    // FETCH THE FEEDBACK DATA FROM JSON FILE
    // ───────────────────────────────────────────────────────────────────────
    async loadData() {
      try {
        this.loading = true;

        // Load feedback and FAQ data using the imported loadJSON helper
        const feedbackResponse = await loadJSON('/data/feedback.json');
        const faqResponse = await loadJSON('/data/faq.json');

        // Process sections: Collect unique sections from feedbackResponse
        const uniqueSectionsMap = new Map();
        feedbackResponse.feedback.forEach((section) => {
          if (!uniqueSectionsMap.has(section.sectionId)) {
            uniqueSectionsMap.set(section.sectionId, {
              id: section.sectionId,
              title: section.sectionTitle,
            });
          }
        });
        this.sections = Array.from(uniqueSectionsMap.values());

        // Reset articles and feedbackByArticle before populating to avoid duplicates on re-load
        this.articles = [];
        this.feedbackByArticle = {};

        // Iterate through sections and then their articles from the loaded feedback data
        feedbackResponse.feedback.forEach((section) => {
          if (section.articles && Array.isArray(section.articles)) {
            section.articles.forEach((article) => {
              // Add article to the flattened articles list
              this.articles.push({
                sectionId: section.sectionId,
                articleId: article.articleId,
                title: article.articleTitle,
                // Safely get excerpt from the first feedback item, if available
                excerpt:
                  article.feedbackList && article.feedbackList.length > 0
                    ? article.feedbackList[0].message.slice(0, 100) + '...'
                    : '',
              });

              // Populate feedbackByArticle for the current article
              this.feedbackByArticle[article.articleId] =
                article.feedbackList.map((feedback) => ({
                  ...feedback,
                  // Ensure timestamp is a number for timeAgo function if createdAt is string
                  timestamp: new Date(feedback.createdAt).getTime(),
                }));
            });
          }
        });

        // Set FAQ data
        this.faqs = faqResponse.faqs || [];
      } catch (e) {
        console.error('Error loading data for feedbackApp:', e);
        // Consider displaying an error message to the user
      } finally {
        this.loading = false;
        // Refresh AOS after content is loaded and the DOM is updated
        this.$nextTick(() => {
          refreshAOS();
        });
      }
    },

    // ───────────────────────────────────────────────────────────────────────
    // COMPUTED PROPERTIES
    // ───────────────────────────────────────────────────────────────────────
    get filteredArticles() {
      if (!this.articles || this.articles.length === 0) {
        return [];
      }

      let filtered = this.articles;

      // Filter by selected section first, if any
      if (this.selectedSectionId) {
        filtered = filtered.filter(
          (art) => art.sectionId === this.selectedSectionId
        );
      }

      // Then filter by search query
      if (this.searchQuery) {
        const query = this.searchQuery.toLowerCase();
        filtered = filtered.filter(
          (art) =>
            art.title.toLowerCase().includes(query) ||
            (art.excerpt && art.excerpt.toLowerCase().includes(query))
        );
      }
      return filtered;
    },

    // ───────────────────────────────────────────────────────────────────────
    // METHODS
    // ───────────────────────────────────────────────────────────────────────
    selectSection(sectionId) {
      this.selectedSectionId = sectionId;
      this.selectedArticleId = null; // Reset selected article when changing sections
      this.searchQuery = ''; // Clear search query when changing sections
    },

    selectArticle(articleId) {
      this.selectedArticleId = articleId;
      this.form.article = articleId; // Pre-fill form's article field
    },

    submitFeedback() {
      this.errors = {}; // Reset errors

      // Validate required fields
      ['article', 'name', 'email', 'message'].forEach((f) => {
        if (!this.form[f]) {
          this.errors[f] = `${
            f.charAt(0).toUpperCase() + f.slice(1)
          } is required.`;
        }
      });

      // Basic email validation
      if (
        this.form.email &&
        !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(this.form.email)
      ) {
        this.errors.email = 'Invalid email format.';
      }

      if (Object.keys(this.errors).length) return; // Stop if validation fails

      // Ensure there's an article selected/provided
      const targetArticleId = this.form.article || this.selectedArticleId;
      if (!targetArticleId) {
        console.error('No article selected for feedback submission.');
        this.errors.article = 'Please select an article.';
        return;
      }

      if (!this.feedbackByArticle[targetArticleId]) {
        this.feedbackByArticle[targetArticleId] = [];
      }

      // Generate a simple unique ID for this feedback (for display purposes)
      const feedbackId = `${targetArticleId}-${
        this.form.email.split('@')[0]
      }-${Date.now()}`;

      this.feedbackByArticle[targetArticleId].push({
        feedbackId,
        userId: this.form.email.split('@')[0], // Use part of email as userId
        name: this.form.name,
        email: this.form.email,
        location: this.form.location || 'Unknown',
        timestamp: Date.now(), // Current timestamp for the new feedback
        message: this.form.message,
      });

      // Reset form fields after successful submission
      this.form = {
        article: '',
        name: '',
        email: '',
        location: '',
        phone: '',
        message: '',
      };
      this.selectedArticleId = null; // Clear selected article in UI if desired after submission

      this.$nextTick(() => {
        // Scroll to the bottom of the feedback container after submission
        // Ensure you have x-ref="feedContainer" on the div wrapping the feedback list for a specific article
        const el = this.$refs.feedContainer;
        if (el) el.scrollTop = el.scrollHeight;
      });
    },

    // Expose imported helper functions for use in Alpine templates
    get timeAgoFormatted() {
      return (timestamp) => timeAgo(timestamp);
    },
    get avatarUrlGenerated() {
      return (userId) => getAvatarUrl(userId);
    },

    // ───────────────────────────────────────────────────────────────────────
    // INITIALIZATION
    // ───────────────────────────────────────────────────────────────────────
    async init() {
      try {
        await this.loadData(); // Load data (feedback and FAQ)
      } catch (e) {
        console.error('Error initializing feedback app:', e);
      }
    },
  };
}

// Make the component available globally for Alpine.js to find
window.feedbackApp = feedbackApp;
