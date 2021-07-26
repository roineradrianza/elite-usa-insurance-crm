let date =  new Date()
const domain = window.location.origin
const usesGMT = false
const url_params = new URLSearchParams(window.location.search);
const current_date = date.getFullYear() + "-" + (date.getMonth() + 1) + "-" + date.getDate();
const vuetify_opts = {
  theme: {
    themes: {
      light: {
        primary: "#1231ef",
        secondary: "#d41200",
      }
    },
  }
};
