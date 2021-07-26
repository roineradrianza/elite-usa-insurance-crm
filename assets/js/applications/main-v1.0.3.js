/*VUE PLUGINS*/
/*VUETIFY OPTIONS AND SET UP*/

const vuetify = new Vuetify(vuetify_opts);
const api_url = ra_elite_usa_insurance_ajaxurl

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
    stepper: 1,
    preview: false,
    form: {
      personal_information_birthdate_modal: false,
      personal_information_document_expiration_modal: false,
      affordable_care_act_date_modal: false,
      espouse_information_birthdate_modal: false,
      espouse_information_document_expiration_modal: false,
      dependent_birthdate_modal: false,
      dependent_expires_modal: false,
      payment_expiration_date_modal: false,
      options: {
        general: [{text: 'Yes', value: 1}, {text: 'No', value: 0}],
        coverage_type: ['INDIVIDUAL', 'FAMILY'],
        marital_status: ['MARRIED', 'SINGLE'],
        inmigration_status: ['WORK PERMIT AUTHORIZATION', 'RESIDENT / GREEN CARD'],
        work_type: ['W2', '1099'],
        payment_by: ['PER HOUR', 'WEEKLY', 'BIWEEKLY', 'MONTHLY', 'YEARLY'],
        relative: ['Child', 'Mother', 'Father', 'Other'],
        payment_type: ['BANK ACCOUNT', 'CREDIT OR DEBIT CARD'],
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
          v => (v && v.length <= 10) || 'Name must be less than 10 characters',
        ],
        email: [
          v => !!v || 'E-mail is required',
          v => /.+@.+\..+/.test(v) || 'E-mail must be valid',
        ],
      },
      default: {
        affordable_care_act: {
          mfc: 0,
          complany_plan: '',
          premium: 0,
          deductible: 0,
          moop: 0,
          agent_name: udata.first_name + ' ' + udata.last_name,
          coverage_type: '',
          coverage_nro_members: '',
          date: moment().format('YYYY-MM-DD hh:mm:ss'),
        },
        personal_information: {
          total_income: 0,
          marital_status: '',
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
          state: '',
          county: '',
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
          income: 0,
          payment_by: ''
        },
        espouse_employment_information: {
          is_employed: 0,
          work_type: '',
          employer: '',
          income: 0,
          payment_by: ''
        },
        dependents: [],
        payment_information: {
          type: '',
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
          mfc: 0,
          complany_plan: '',
          premium: 0,
          deductible: 0,
          moop: 0,
          agent_name: udata.first_name + ' ' + udata.last_name,
          coverage_type: '',
          coverage_nro_members: '',
          date: moment().format('YYYY-MM-DD hh:mm:ss'),
        },
        personal_information: {
          total_income: 0,
          marital_status: '',
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
          county: '',
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
          income: 0,
          payment_by: ''
        },
        espouse_employment_information: {
          is_employed: 0,
          work_type: '',
          employer: '',
          income: 0,
          payment_by: ''
        },
        dependents: [],
        payment_information: {
          type: '',
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
  },
  mounted () {

  },

  methods: {

    getAge(form) {
      var app = this
      var age = moment().diff(app.form.content[form].birthdate, 'years')
      app.form.content[form].age = age
      return age
    },

    calcTotalIncome() {
      var app = this
      var form = app.form.content
      var personal_income = parseInt(form.employment_information.income)
      var espouse_income = parseInt(form.espouse_employment_information.income)
      var has_espouse = form.espouse_information.added

      var total_income = has_espouse ? personal_income + espouse_income : personal_income 
      
      form.personal_information.total_income = total_income

      return total_income
    },

    addDependent() {
      var app = this
      var item = {
        first_name: '',
        last_name: '',
        birthdate: '',
        relative: '',
        is_citizen: 0,
        ssn: '',
        inmigration_status: '',
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
      var quote_form = app.form.content
      var url = api_url + 'ra_elite_usa_insurance_save_quote_form'

      app.quote_loading = true
      app.$http.post(url,quote_form).then( res => {
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

    resetQuoteForm () {
      var app = this
      var default_form = app.form.default
      app.preview = false
      app.already_sent = false
      app.stepper = 1
      app.form.content = {}
      Object.assign(app.form.content, default_form)
      app.scrollToTopStepper()
    }

  }
});