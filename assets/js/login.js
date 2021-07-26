/*VUE PLUGINS*/
/*VUETIFY OPTIONS AND SET UP*/

const vuetify = new Vuetify(vuetify_opts);
const api_url = ra_elite_usa_insurance_ajaxurl

/*VUE INSTANCE*/
let vm = new Vue({
  vuetify,
  el: '#ra-elite-usa-insurance-container',
  data: {
    login_form_valid: false,
    loading: false,
    alert: false,
    alert_type: '',
    alert_message: '',
    redirect_url: url_params.get('quote_id'),
    email: '',
    password: '',
    remember: '',
    rules: {
      required: [
        v => !!v || 'This field is required',
      ],
      email: [
        v => !!v || 'E-mail is required',
        v => /.+@.+\..+/.test(v) || 'E-mail must be valid',
      ],
    },
  },

  computed: {},

  watch: {},

  created () {
  },
  mounted () {

  },

  methods: {
    login () {
      var app = this
      var url = api_url + 'ra_elite_usa_insurance_login'
      var data = {
        email: app.email,
        password: app.password,
        remember: app.remember ? true : ''
      }
      app.loading = true
      app.$http.post(url, data).then( res => {
        app.loading = false
        app.alert = true
        if (res.body.hasOwnProperty('message')) {
          app.alert_message = res.body.message
          if (res.body.status == 'success') {
            if (res.body.data.hasOwnProperty('errors')) {
              app.alert_type = 'error'
              var errors = res.body.data.errors
              if (errors.hasOwnProperty('incorrect_password')) {
                app.alert_message = errors.incorrect_password[0]
              }
              else if (errors.hasOwnProperty('invalid_email')) {
                app.alert_message = errors.invalid_email[0]
              }
            }
            else {
              app.alert_type = 'success'
              if (typeof app.redirect_url !== null) {
                location.reload()
              }
              else {
                window.location = domain + res.body.redirect_url
              }
            }
          }
        }
        else {
          app.alert_type = 'error'
          app.alert_message = 'There was an error'
        }
      }, err => {
        app.loading = false
        app.alert_type = 'error'
        app.alert_message = "There was an error, it can't be possible process the information sent"
      })
    },
  }
});
