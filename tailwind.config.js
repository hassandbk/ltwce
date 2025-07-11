// tailwind.config.js
/** @type {import('tailwindcss').Config} */
module.exports = {
  theme: {
    extend: {
      fontFamily: {
        'dm-serif': ['"DM Serif Display"', 'serif'],
      },
      colors: {
        'gold-600': '#D4AF37',
        'emerald-600': '#047857',
      },
      typography: ({ theme }) => ({
        // Add this typography extension
        DEFAULT: {
          css: {
            p: {
              marginBottom: theme('spacing.6'), // This sets paragraph bottom margin to 1.5rem (space-6)
              marginTop: theme('spacing.6'), // You might want margin-top as well
            },
            // You can also customize h1, h2, ul, ol, etc. margins here
            // h2: {
            //   marginTop: theme('spacing.12'),
            //   marginBottom: theme('spacing.4'),
            // },
            // If you want to change the line-height for prose in general:
            // '& :where(p, ul, ol, li)': {
            //   lineHeight: theme('lineHeight.loose'), // Corresponds to leading-loose
            // },
            // Remove the default prose line-height on strong tags if it's interfering with not-prose
            strong: {
              'line-height': 'inherit', // Important to keep original line-height
            },
          },
        },
        // If you're using prose-lg, prose-xl, etc., you can also target them:
        lg: {
          css: {
            p: {
              marginBottom: theme('spacing.8'), // Example: Even more spacing for prose-lg
            },
          },
        },
        xl: {
          css: {
            p: {
              // For prose-xl, the default font size is 1.25rem, you might want more space
              marginBottom: theme('spacing.8'), // Increase paragraph spacing for xl size
              marginTop: theme('spacing.8'),
            },
            // Optionally adjust the line height specifically for prose-xl if leading-relaxed isn't enough
            // '& :where(p, ul, ol, li)': {
            //     lineHeight: theme('lineHeight.relaxed'), // Ensure consistent relaxed leading
            // },
          },
        },
      }),
    },
  },
  plugins: [
    require('@tailwindcss/typography'),
    require('@tailwindcss/forms'),
    // ...
  ],
};
