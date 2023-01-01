/*VUE PLUGINS*/
/*VUETIFY OPTIONS AND SET UP*/

const vuetify = new Vuetify(vuetify_opts);
const api_url = ra_elite_usa_insurance_ajaxurl

/*VUE INSTANCE*/
let vm = new Vue({
  vuetify,
  el: '#ra-elite-usa-insurance-container',
  data: {
    agreement_form_valid: false,
    declined: false,
    loading: false,
    barAlert: false,
    barTimeout: 8000,
    barMessage: '',
    valids: {
      agreement_form_valid: false,
    },
    modals: {
      birthdate: false,
      date: false,
    },
    form: {
      first_name: '',
      last_name: '',
      birthdate: '',
      ssn: '',
      license_number: '',
      address: '',
      city: '',
      address: '',
      zip_code: '',
      phone_number: '',
      email: '',
      introduction: {
        crime_involving: {
          apply: '0',
          explanation: '',
          attachments: undefined,
        },
        license_suspended: {
          apply: '0',
          explanation: ''
        }
      },
      agreement: {
        agent_signature: '',
        print_name: '',
        license_number: ''
      },
      full_name: '',
      signature: '',
      date: moment().format('YYYY-MM-DD'),
    },
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

  created () {
  },
  mounted () {

  },

  methods: {

    logout () {
      var app = this
      var url = api_url + 'ra_elite_usa_insurance_logout'
      app.$http.get(url).then( res => {
        window.location = res.body.redirect_url
      }, err => {
      })
    },

    declineContract () {
      var app = this
      app.declined = true
      app.logout()
    },

    submitContract () {
      var app = this
      var data = new FormData()
      var url = api_url + 'ra_elite_usa_insurance_submit_contract'
      if (!app.$refs.agreement_form.validate()) {
        app.barAlert = true
        app.barMessage = 'You must fill all the fields required, check the fields and try again'
        return false
      }
      app.loading = true
      data.append('form', JSON.stringify(app.form))
      app.$http.post(url, data).then( res => {
        app.loading = false
        app.barAlert = true
        app.barMessage = res.body.message
        if (res.body.status == 'success') {
          location.reload()
        }
      }, err => {
        app.loading = false
        app.barAlert = true
        app.barMessage = "There was an error, it can't be possible process the information sent"
      }) 
    },

    getFormatDate(d) {
      if (d == '') {
        return ''
      }
      return formatDateByBrowser(d, moment, 'MM/DD/YYYY')
    },

    getFormatDateShort(d) {
      if (d == '') {
        return ''
      }
      return formatDateByBrowser(d, moment, 'MM/YYYY')
    },

    getFormatDateExtended(d) {
      if (d == '') {
        return ''
      }
      return formatDateByBrowser(d, moment, 'MM/DD/YYYY, h:mm:ss a')
    },

    getcustomDateFormat(d, format) {
      if (d == '') {
        return ''
      }
      return moment(d).format(format)
    }

  }
});
