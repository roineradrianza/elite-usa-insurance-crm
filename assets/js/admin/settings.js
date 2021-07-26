/*VUE PLUGINS*/
/*VUETIFY OPTIONS AND SET UP*/

const vuetify = new Vuetify(vuetify_opts);
const api_url = ra_elite_usa_insurance_ajaxurl
/*VUE INSTANCE*/
let vm = new Vue({
    vuetify,
    el: '#ra-elite-usa-insurance-container',
    data: {
      loading: false,
      error: '',
      alert: false,
      alert_type: '',
      alert_message: '',
      settings:{
        routes:{
          dashboard: '',
          quote_form: '',
          quotes: '',
        },
      },
      nonce: nonce,
      domain: domain + '/'
    },
    methods: {
      save_settings () {
        var app = this;
        app.loading = true
        app.alert = false
        var url = api_url + "ra_elite_usa_insurance_save_settings&nonce=" + app.nonce;
        var settings = app.settings;
        app.$http.post(url, settings).then(res => {
          app.alert = true
          app.alert_type = res.body.status
          app.alert_message = res.body.message
          var colors = app.settings.colors;
          app.loading = false
        }, error => {
          //error
        })
      },
    },
    mounted: function () {
      var app = this;
      var url = api_url + "ra_elite_usa_insurance_get_settings&nonce=" + app.nonce;
      app.$http.get(url).then(res => {
        app.settings.routes = res.body.routes;
        app.loading = false;
      }, 
      error => {
        console.log(error);
        switch (error.status) {
          case 400:
            app.error = 'Check your connection.'; 
            break;
          default:
            app.error = 'Try again.'; 
            break;
        }
      })
    },
});