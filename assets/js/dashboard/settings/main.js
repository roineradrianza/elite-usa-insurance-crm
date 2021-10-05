/*VUE PLUGINS*/
/*VUETIFY OPTIONS AND SET UP*/

const vuetify = new Vuetify(vuetify_opts);
const api_url = ra_elite_usa_insurance_ajaxurl

/*VUE INSTANCE*/
let vm = new Vue({
  vuetify,
  el: '#ra-elite-usa-insurance-container',
  data: {
    selectedItem: 2,
    barAlert: false,
    barTimeout: 6000,
    logout_loading: false,
    password_loading: false,
    notifications_loading: false,
    barMessage: '',
    password: '',
    password_confirm: '',
    routes,
    notifications: [],
  },

  created () {
    initNotifications(this)
    setInterval(initNotifications, 30000, this)
  },

  methods: {

    logout () {
      var app = this
      var url = api_url + 'ra_elite_usa_insurance_logout'
      app.logout_loading = true
      app.$http.get(url).then( res => {
        app.logout_loading = false
        window.location = res.body.redirect_url
      }, err => {
        app.logout_loading = false
      })
    },

    changePassword () {
      var app = this
      var url = api_url + 'ra_elite_usa_insurance_change_password'
      if (app.password != app.password_confirm) {
        app.barAlert = true
        app.barMessage = 'Password must match with password confirm field'
        return false
      }
      app.password_loading = true
      app.$http.post(url, {password: app.password}).then( res => {
        app.password_loading = false
        app.barAlert = true
        app.barMessage = res.body.message
      }, err => {
        app.password_loading = false
      })
    },

  }
});
