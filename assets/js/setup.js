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

const formatDateByBrowser = (date, moment, format) => {
  let user_agent = navigator.userAgent

  if(user_agent.indexOf("Firefox") > -1) {
    let regex = / am| pm/gi

    let match = date.match(regex)
    let extracted = match ? match[0] : ''
    let replaced_date = date.replace(regex, '')
    let formatted_date = moment(replaced_date).format(format).replace(regex, '')
    let final_date = `${formatted_date} ${extracted}`

    switch (format) {
      case 'YYYY' || 'MM/YYYY' || 'MM/DD/YYYY':
        final_date = formatted_date
        break;
    }

    return final_date
  }

  return moment(date).format(format)
}