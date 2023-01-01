/*VUE PLUGINS*/
/*VUETIFY OPTIONS AND SET UP*/

const vuetify = new Vuetify(vuetify_opts);
const api_url = ra_elite_usa_insurance_ajaxurl

const quote_id = url_params.get('quote_id')
const action = url_params.get('action')

/*VUE INSTANCE*/
let vm = new Vue({
  vuetify,
  el: '#ra-elite-usa-insurance-container',
  data: {
    selectedItem: 1,
    already_sent: false,
    alert: false,
    alert_type: '',
    alert_message: '',
    countries: countries,
    affordable_care_act_valid: false,
    personal_information_valid: false,
    employment_information_valid: false,
    espouse_information_valid: true,
    espouse_employment_information_valid: false,
    dependents_information_valid: false,
    payment_information_valid: false,
    quote_loading: false,
    pdf_loading: false,
    logout_loading: false,
    renew_loading: false,
    not_able_to_renew: false,
    not_quote_found: false,
    stepper: 1,
    preview: false,
    routes,
    notifications: [],
    form: {
      personal_information_birthdate_modal: false,
      personal_information_document_expiration_modal: false,
      affordable_care_act_date_modal: false,
      espouse_information_birthdate_modal: false,
      autopay_date_modal: false,
      espouse_information_document_expiration_modal: false,
      dependent_birthdate_modal: false,
      dependent_expires_modal: false,
      payment_expiration_date_modal: false,
      options: {
        general: [{text: 'Yes', value: 1}, {text: 'No', value: 0}],
        coverage_type: ['INDIVIDUAL', 'FAMILY'],
        marital_status: ['MARRIED', 'SINGLE'],
        inmigration_status: ['WORK PERMIT AUTHORIZATION', 'RESIDENT / GREEN CARD', 'OTHER'],
        work_type: ['W2', '1099'],
        payment_by: ['PER HOUR', 'WEEKLY', 'BIWEEKLY', 'MONTHLY', 'YEARLY'],
        relative: ['Child', 'Mother', 'Father', 'Other'],
        payment_type: ['', 'BANK ACCOUNT', 'CREDIT OR DEBIT CARD'],
        account_type: ['CHECKING', 'SAVING'],
        cards_type: ['DEBIT', 'CREDIT'],
        cards_entity_type: ['MASTER CARD', 'VISA', 'AMERICAN EXPRESS', 'DISCOVER'],
      },
      rules: {
        required: [
          v => !!v || 'This field is required',
        ],
        name: [
          v => !!v || 'Name is required',
          v => (v && v.length <= 1) || 'Name must be than 1 characters',
        ],
        ucis: [
          v => {
            if (!v == '' && v.length != 9) {
              return 'You need to fill the 9 characters'
            }
            else {
              return true
            }
          },
        ],
        card_number: [
          v => {
            if (!v == '' && v.length != 13) {
              return 'You need to fill the 13 characters'
            }
            else {
              return true
            }
          },
        ],
        email: [
          v => !!v || 'E-mail is required',
          v => /.+@.+\..+/.test(v) || 'E-mail must be valid',
        ],
      },
      default: {
        affordable_care_act: {
          client_type: 'NEW',
          mfc: 0,
          company_plan: '',
          plan: '',
          premium: 0,
          deductible: 0,
          moop: 0,
          agent_name: udata.first_name + ' ' + udata.last_name,
          coverage_type: 'INDIVIDUAL',
          coverage_nro_members: '',
          effectiveness_date: '',
          date: moment().format('YYYY-MM-DD hh:mm:ss a'),
          additional_notes: '',
        },
        personal_information: {
          added: 1,
          total_income: 0,
          marital_status: 'SINGLE',
          gender: '',
          first_name: '',
          middle_name: '',
          last_name: '',
          email: '',
          telephone: '',
          birthdate: '',
          age: '',
          is_citizen: 1,
          ssn: '',
          type: '',
          inmigration_status: '',
          uscis_number: '',
          card_number: '',
          category: '',
          document_from: '',
          document_expires: '',
          same_address: 1,
          address: '',
          state: '',
          zip_code: '',
          county: '',
          city: '',
          mailing_address: '',
          mailing_state: '',
          mailing_zip_code: '',
          mailing_county: '',
          mailing_city: '',
          birth_country: '',
        },
        espouse_information: {
          added: 1,
          first_name: '',
          middle_name: '',
          last_name: '',
          email: '',
          telephone: '',
          birthdate: '',
          age: '',
          is_citizen: 1,
          ssn: '',
          inmigration_status: '',
          uscis_number: '',
          card_number: '',
          category: '',
          document_from: '',
          document_expires: '',
          address: '',
        },
        employment_information: {
          work_type: '',
          employer: '',
          company: '',
          income: 0,
          payment_by: ''
        },
        espouse_employment_information: {
          is_employed: 0,
          work_type: '',
          employer: '',
          company: '',
          income: 0,
          payment_by: ''
        },
        dependents: [],
        documents: [],
        payment_information: {
          type: '',
          autopay: 0,
          autopay_date: '',
          bank: {
            name: '',
            type: '',
            owner_name: '',
            routing_number: '',
            account_number: '',
            city: '',
            estate: '',
          },
          card: {
            name: '',
            type: 'DEBIT',
            entity: '',
            number: '',
            expiration_date: '',
            ccv: '',
            bank_name: ''
          }
        },
      },
      content: {
        affordable_care_act: {
          client_type: 'NEW',
          mfc: 0,
          company_plan: '',
          plan: '',
          premium: 0,
          deductible: 0,
          moop: 0,
          agent_name: udata.first_name + ' ' + udata.last_name,
          coverage_type: 'INDIVIDUAL',
          coverage_nro_members: '',
          effectiveness_date: '',
          date: moment().format('YYYY-MM-DD hh:mm:ss a'),
          additional_notes: '',
        },
        personal_information: {
          added: 1,
          total_income: 0,
          marital_status: 'SINGLE',
          gender: '',
          first_name: '',
          middle_name: '',
          last_name: '',
          email: '',
          telephone: '',
          birthdate: '',
          age: '',
          is_citizen: 1,
          ssn: '',
          type: '',
          inmigration_status: '',
          inmigration_status_selected: '',
          uscis_number: '',
          card_number: '',
          category: '',
          document_from: '',
          document_expires: '',
          same_address: 1,
          address: '',
          state: '',
          zip_code: '',
          county: '',
          city: '',
          mailing_address: '',
          mailing_state: '',
          mailing_zip_code: '',
          mailing_county: '',
          mailing_city: '',
          birth_country: '',
        },
        espouse_information: {
          added: 1,
          gender: '',
          first_name: '',
          middle_name: '',
          last_name: '',
          email: '',
          telephone: '',
          birthdate: '',
          age: '',
          is_citizen: 1,
          ssn: '',
          inmigration_status: '',
          inmigration_status_selected: '',
          uscis_number: '',
          card_number: '',
          category: '',
          document_from: '',
          document_expires: '',
          address: '',
        },
        employment_information: {
          work_type: '',
          employer: '',
          company: '',
          income: 0,
          payment_by: ''
        },
        espouse_employment_information: {
          is_employed: 0,
          work_type: '',
          employer: '',
          company: '',
          income: 0,
          payment_by: ''
        },
        dependents: [],
        documents: [],
        payment_information: {
          type: '',
          autopay: 0,
          autopay_date: '',
          bank: {
            name: '',
            type: '',
            owner_name: '',
            routing_number: '',
            account_number: '',
            city: '',
            estate: '',
          },
          card: {
            name: '',
            type: 'DEBIT',
            entity: '',
            number: '',
            expiration_date: '',
            ccv: '',
            bank_name: ''
          }
        },
      }
    }
  },

  computed: {},

  watch: {},

  created () {
    initNotifications(this)
    setInterval(initNotifications, 30000, this)
    this.initialize()
  },

  mounted () {},

  methods: {

    initialize () {
      var app = this
      if (quote_id !== null) {
        var url = api_url + 'ra_elite_usa_insurance_get_quote'
        app.renew_loading = true
        app.$http.post(url, {ID: quote_id}).then( res => {
          app.renew_loading = false
          if (res.body != null && res.body.hasOwnProperty('ID')) {
            res.body.published_at = moment(res.body.affordable_care_act.date).format('DD/MM/YYYY, h:mm:ss a')
            res.body.affordable_care_act.date = moment().format('YYYY-MM-DD hh:mm:ss a')
            res.body.affordable_care_act.effectiveness_date = moment().format('YYYY-MM-DD')
            res.body.affordable_care_act.renewal_date = moment(moment().format('YYYY') + '-11-22').add('1', 'year').format('YYYY-MM-DD')
            res.body.personal_information.same_address = res.body.personal_information.hasOwnProperty('same_address') 
            ? res.body.personal_information.same_address : 1

            res.body.documents = []
            res.body.applicant = res.body.personal_information.first_name + ' ' + 
            res.body.personal_information.middle_name + ' ' + 
            res.body.personal_information.last_name
            app.form.content = res.body
          } else {
            app.not_quote_found = true
          }
        }, err => {
          if (err.status == 403) {
            app.not_able_to_renew = true
          }
          app.renew_loading = false
        })
      }
    },

    amountOfNumbers (v) {
      if (!v == '' && v.length != 9) {
        return 'You need to fill the 9 characters'
      }
    },

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

    getAge(form) {
      var app = this
      var age = moment().diff(app.form.content[form].birthdate, 'years')
      app.form.content[form].age = age
      return age
    },

    calcTotalIncome() {
      var app = this
      var form = app.form.content
      var personal_income = typeof form.employment_information.income === 'string' ? app.numberFormat(form.employment_information.income) : parseInt(form.employment_information.income)
      var espouse_income = typeof form.espouse_employment_information.income === 'string' ? app.numberFormat(form.espouse_employment_information.income) : parseInt(form.espouse_employment_information.income)

      var total_income = personal_income + espouse_income
      
      form.personal_information.total_income = app.currencyFormat(total_income, true)

      return form.personal_information.total_income
    },

    addDependent() {
      var app = this
      var item = {
        added: 0,
        gender: '',
        first_name: '',
        last_name: '',
        birthdate: '',
        relative: '',
        is_citizen: 0,
        ssn: '',
        inmigration_status: '',
        inmigration_status_selected: '',
        uscis_number: '',
        card_number: '',
        document_from: '',
        document_expires: '',
      }
      app.form.content.dependents.push(item)
    },

    inputRelative(dependent) {
      if (dependent.relative_selected != 'Other') {
        dependent.relative = dependent.relative_selected
        return true
      }
      else {
        dependent.relative = ''
        return false
      }
    },

    inputOtherIS(status, form) {
      if (status != 'OTHER') {
        form.inmigration_status_selected = form.inmigration_status
        return true
      }
      else {
        form.inmigration_status_selected = ''
        return false
      }
    },

    removeDependent(index) {
      var app = this
      app.form.content.dependents.splice(index, 1)
    },

    scrollToTopStepper() {
      var app = this
      app.$refs.stepper_h.scrollIntoView({behavior: 'smooth'})
    },

    sendQuoteForm () {
      var app = this
      app.updateFormDate()
      var quote_form = app.form.content
      var data = new FormData()
      var url = api_url + 'ra_elite_usa_insurance_save_quote_form'

      data.append('post_parent', quote_id)
      data.append('affordable_care_act', JSON.stringify(quote_form.affordable_care_act))
      data.append('personal_information', JSON.stringify(quote_form.personal_information))
      data.append('employment_information', JSON.stringify(quote_form.employment_information))
      data.append('espouse_information', JSON.stringify(quote_form.espouse_information))
      data.append('espouse_employment_information', JSON.stringify(quote_form.espouse_employment_information))
      data.append('dependents', JSON.stringify(quote_form.dependents))
      data.append('payment_information', JSON.stringify(quote_form.payment_information))
      data.append('docs_info', JSON.stringify(quote_form.documents))

      quote_form.documents.forEach((doc, i) => {
        data.append('documents['+i+']', doc.file) 
      });

      app.quote_loading = true
      app.$http.post(url, data).then( res => {
        app.quote_loading = false
        app.alert = true
        if (res.body.hasOwnProperty('message')) {
          app.alert_type = res.body.status
          app.already_sent = res.body.status == 'success' ? true : false
          app.alert_message = res.body.message
        }
        else {
          app.alert_type = 'error'
          app.alert_message = 'There was an error'
        }
      }, err => {
        app.quote_loading = false
        app.alert_type = 'error'
        app.alert_message = "There was an error, it can't be possible process the information sent"
      })
    },

    generateQuotePDF() {
      var app = this
      var quote = app.form.content
      quote.applicant = quote.personal_information.first_name + ' ' + quote.personal_information.middle_name + ' ' + quote.personal_information.last_name
      var url = api_url + 'ra_elite_usa_insurance_generate_quote_pdf'
      app.pdf_loading = true
      app.$http.post(url, quote).then( res => {
        if (res.body.status == 'success') {
          app.pdf_loading = false
          var pdf_doc = res.body
          var a = document.createElement('a')
          a.href = pdf_doc.content
          document.body.append(a)
          a.download = pdf_doc.applicant + ".pdf"
          a.click()
          a.remove()
        }
      }, err => {

      })
    },

    resetQuoteForm () {
      var app = this
      app.preview = false
      app.already_sent = false 
      app.stepper = 1
      quote_id = null
      app.form.content = Object.assign({}, app.form.default)
      app.scrollToTopStepper()
    },

    currencyFormat (amount, show_prefix) {
      var formatter = new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: 'USD',
      });
      var money = formatter.format(amount);
      if (!show_prefix) {
        money = money.split("$")[1]
      }
      return money
    },

    numberFormat (amount) {
      return Number(amount.replace(/[^0-9.-]+/g,""))
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

    updateFormDate() {
      this.form.content.affordable_care_act.date = moment().format('YYYY-MM-DD hh:mm:ss a')
    },

    validateFields(form, stepper) {
      var app = this
      if (app.$refs[form].validate()) {
        app.stepper++
        app.scrollToTopStepper()
        return true
      }
      return false
    }

  }
});
