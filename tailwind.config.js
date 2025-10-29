/** @type {import('tailwindcss').Config} */
export default {
  content: [],
  theme: {
    extend: {},
  },
  plugins: [],
}

// tailwind.config.js
module.exports = {
  theme: {
    extend: {
      fontFamily: {
        headline: ['Georgia', 'Cambria', '"Times New Roman"', 'serif'],
        body: ['ui-sans-serif', 'system-ui', '-apple-system', 'Inter', 'sans-serif'],
      },
    },
  },
}


// tailwind.config.js
module.exports = {
  content: [
  "./resources/**/*.blade.php",
  "./resources/**/*.js",
  "./resources/**/*.vue",
  "./resources/**/*.tsx",
]

  theme: {
    extend: {
      keyframes: {
        // slow rotation for the conic aura (you already use this)
        spinSlow: {
          "0%": { transform: "rotate(0deg)" },
          "100%": { transform: "rotate(360deg)" },
        },

        // horizontal gradient panning for the floor glow
        gradientX: {
          "0%":   { "background-position": "0% 50%" },
          "50%":  { "background-position": "100% 50%" },
          "100%": { "background-position": "0% 50%" },
        },
      },
      animation: {
        "spin-slow": "spinSlow 8s linear infinite",
        "gradient-x": "gradientX 4s ease-in-out infinite",
      },
    },
  },
  plugins: [],
};
