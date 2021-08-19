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
const download = (urls = []) => {
  urls.forEach(url => {
    var name = url.split('/')
    var element = document.createElement('a')
    element.setAttribute('href', url)
    element.setAttribute('download', name[name.length - 1])
    document.body.appendChild(element)
    element.click()
    document.body.removeChild(element)
  });
}

document.addEventListener("DOMContentLoaded", e => {
	if (typeof vm !== undefined) {
    vm.download = download
  }
});