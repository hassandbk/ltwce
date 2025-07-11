// src/components/feedbackForm.js

const initialFormState = {
  article: '',
  name: '',
  email: '',
  location: '',
  phone: '',
  message: '',
};

function feedbackFormComponent() {
  return {
    // State
    form: { ...initialFormState },
    errors: {},
    selectedArticleId: 'defaultArticleId', // Default, or updated by event
    feedbackByArticle: {}, // This component manages its own feedback data

    // Methods
    init() {
      // Listen for an event from the articles component if it dispatches one
      this.$watch('selectedArticleId', (value) => {
        // Optionally update the form's article field if it's meant to be pre-filled
        this.form.article = value;
      });

      // You could also listen for a custom event from another component:
      // @article-selected.window="selectedArticleId = $event.detail.id"
      // on the main x-data element in HTML.
    },
    submitFeedback() {
      this.errors = {}; // Clear previous errors

      const requiredFields = ['name', 'email', 'message'];
      if (!this.form.article && !this.selectedArticleId) {
        // Ensure an article is selected
        requiredFields.unshift('article');
      }

      const fieldErrors = validateRequiredFields(this.form, requiredFields);
      if (this.form.email && !isValidEmail(this.form.email)) {
        fieldErrors.email = 'Please enter a valid email address.';
      }
      this.errors = fieldErrors;

      if (Object.keys(this.errors).length) return;

      const articleId = this.form.article || this.selectedArticleId;
      if (!this.feedbackByArticle[articleId]) {
        this.feedbackByArticle[articleId] = [];
      }
      this.feedbackByArticle[articleId].push({
        userId: this.form.email.split('@')[0],
        name: this.form.name,
        email: this.form.email,
        location: this.form.location || 'Unknown',
        timestamp: Date.now(),
        message: this.form.message,
      });

      this.form = { ...initialFormState }; // Reset form
      this.$nextTick(() => {
        const el = this.$refs.feedContainer; // Assuming a ref for the feedback display
        if (el) el.scrollTop = el.scrollHeight;
      });
    },
    // Utilities for feedback display
    timeAgo: (ts) => timeAgo(ts),
    getAvatarUrl: (u) => getAvatarUrl(u),
    // Method to set selected article externally (e.g., from an article list)
    setSelectedArticle(id) {
      this.selectedArticleId = id;
      this.form.article = id; // Pre-fill form if desired
    },
  };
}

// Expose globally
window.feedbackFormComponent = feedbackFormComponent;
