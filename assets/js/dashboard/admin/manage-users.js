/*VUE PLUGINS*/
/*VUETIFY OPTIONS AND SET UP*/

const vuetify = new Vuetify(vuetify_opts);
const api_url = ra_elite_usa_insurance_ajaxurl

/*VUE INSTANCE*/
let vm = new Vue({
  vuetify,
  el: '#ra-elite-usa-insurance-container',
  data: {
    selectedItem: 3,
    barAlert: false,
    barTimeout: 6000,
    barMessage: '',
    notifications_loading: false,
    table_loading: false,
    logout_loading: false,
    contract_loading: false,
    user_form_valid: false,
    user_id: url_params.get('user_id'),
    routes,
    notifications: [],
    rules: {
      required: [
        v => !!v || 'This field is required',
      ],
      email: [
        v => !!v || 'E-mail is required',
        v => /.+@.+\..+/.test(v) || 'E-mail must be valid',
      ],
    },
    users: {
      view_dialog: false,
      edit_dialog: false,
      delete_dialog: false,
      save_loading: false,
      delete_loading: false,
      search: '',
      roles: [
        'Administrator',
        'Insurance Agent',
        'Policy Quote manager',
        'Super User',
      ],
      header: [
        { text: 'Full Name', align: 'start', value: 'full_name' },
        { text: 'Email', align: 'start', value: 'email' },
        { text: 'Profile', align: 'start', value: 'profile' },
        { text: 'Actions', value: 'actions', align:'center', sortable: false },
      ],
      items: [],
      editedItem: {
        user_login: '',
        first_name: '',
        last_name: '',
        email: '',
        roles: [],
        profile: '',
        user_pass: '',
        send_user_notification: '0',
      },
      defaultItem: {
        user_login: '',
        first_name: '',
        last_name: '',
        email: '',
        roles: [],
        profile: '',
        user_pass: '',
        send_user_email: '0',
      },
      editedIndex: -1,
    },
  },

  computed: {
    formTitle () {
      return this.users.editedIndex === -1 ? 'New User' : 'Edit User'
    }
  },

  watch: {},

  created () {
    if (this.user_id === null) {
      this.initialize()
    }
    else {
      this.initializeAndPrevisualize()
    }
    initNotifications(this)
    setInterval(initNotifications, 30000, this)
  },
  mounted () {

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

    initialize () {
      var app = this
      var url = api_url + 'ra_elite_usa_insurance_get_users'
      app.table_loading = true
      app.$http.get(url).then( res => {
        app.table_loading = false
        app.users.items = []
        if (res.body.length > 0) {
          res.body.forEach( (e) => {
            e.full_name = e.first_name + ' ' + e.last_name
            e.profile = app.displayRol(e.roles[0])
            e.user_pass = ''
            e.send_user_email = '0'
            app.users.items.push(e)
          })
        }
      }, err => {
        app.table_loading = false
      })
    },

    initializeAndPrevisualize () {
      var app = this
      var url = api_url + 'ra_elite_usa_insurance_get_users'
      app.table_loading = true
      app.$http.get(url).then( res => {
        app.table_loading = false
        app.users.items = []
        if (res.body.length > 0) {
          res.body.forEach( (e) => {
            e.full_name = e.first_name + ' ' + e.last_name
            e.profile = app.displayRol(e.roles[0])
            e.user_pass = ''
            e.send_user_email = '0'
            app.users.items.push(e)
          })
        }
        var item = app.users.items.filter(item => parseInt(item.id) == parseInt(app.user_id))
        if (item.length > 0) {
          app.showItem(item[0])
          app.generateContractPDF()
        }
        else {
          app.barAlert = true
          app.barMessage = 'The user requested is not available'
        }
      }, err => {
        app.table_loading = false
      })
    },

    showItem (item) {
      this.users.editedIndex = this.users.items.indexOf(item)
      this.users.editedItem = Object.assign({}, item)
      this.users.view_dialog = true
    },

    editItem (item) {
      this.users.editedIndex = this.users.items.indexOf(item)
      this.users.editedItem = Object.assign({}, item)
      this.users.edit_dialog = true
    },

    deleteItem (item) {
      this.users.editedIndex = this.users.items.indexOf(item)
      this.users.editedItem = Object.assign({}, item)
      this.users.delete_dialog = true
    },

    closeView () {
      this.users.view_dialog = false
      this.$nextTick(() => {
        this.users.editedItem = Object.assign({}, this.users.defaultItem)
        this.users.editedIndex = -1
      })
    },

    closeEdit () {
      this.users.edit_dialog = false
      if (!this.view_dialog) {
        this.$nextTick(() => {
          this.users.editedItem = Object.assign({}, this.users.defaultItem)
          this.users.editedIndex = -1
        })
      }
    },

    closeDelete () {
      this.users.delete_dialog = false
      this.$nextTick(() => {
        this.users.editedItem = Object.assign({}, this.users.defaultItem)
        this.users.editedIndex = -1
      })
    },

    displayRol (rol) {
      switch (rol) {
        case 'administrator':
          return 'Administrator'
          break;
        case 'elite_usa_quote_manager':
          return 'Policy Quote manager'
          break;
        case 'elite_usa_insurance_agent':
          return 'Insurance Agent'
          break;
        case 'elite_usa_superuser':
          return 'Super User'
          break;
        default:
          return ''
          break;
      }
    },

    displayRolValue (rol) {
      switch (rol) {    
        case 'Administrator':
          return 'administrator'
          break;
        case 'Policy Quote manager':
          return 'elite_usa_quote_manager'
          break;
        case 'Insurance Agent':
          return 'elite_usa_insurance_agent'
          break;
        case 'Super User':
          return 'elite_usa_superuser'
          break;
        default:
          return ''
          break;
      }
    },

    saveUser () {
      var app = this
      var data = app.users.editedItem
      data.roles[0] = app.displayRolValue(data.profile)
      app.users.save_loading = true
      if (app.users.editedIndex != -1) {
        var editedIndex = app.users.editedIndex
        var url = api_url + 'ra_elite_usa_insurance_update_user'
        app.$http.post(url, app.users.editedItem).then( res => {
          app.users.save_loading = false
          app.barAlert = true
          app.barMessage = res.body.message
          app.users.editedItem.full_name = app.users.editedItem.first_name + ' ' + app.users.editedItem.last_name
          Object.assign(app.users.items[editedIndex], app.users.editedItem)
          app.closeEdit()
        }, err => {
          app.users.save_loading = false
          app.barAlert = true
          app.barMessage = 'There was an unknown error, try again.'
        })
      }
      else {
        var url = api_url + 'ra_elite_usa_insurance_create_user'
        app.$http.post(url, app.users.editedItem).then( res => {
          app.users.save_loading = false
          if (res.body.status == 'success') {
            app.users.editedItem.id = res.body.data
            app.users.editedItem.full_name = app.users.editedItem.first_name + ' ' + app.users.editedItem.last_name
            app.users.items.push(app.users.editedItem)
            app.closeEdit()
          }
          app.barAlert = true
          app.barMessage = res.body.message
        }, err => {
          app.users.save_loading = false
          app.barAlert = true
          app.barMessage = 'There was an unknown error, try again.'
        })
      }
    },

    deleteUser () {
      var app = this
      var data = app.users.editedItem
      var editedIndex = app.users.editedIndex
      var url = api_url + 'ra_elite_usa_insurance_delete_user'
      app.users.delete_loading = true
      app.$http.post(url, app.users.editedItem).then( res => {
        app.users.delete_loading = false
        app.barAlert = true
        app.barMessage = res.body.message
        app.users.items.splice(editedIndex, 1)
        app.closeDelete()
      }, err => {
        app.users.delete_loading = false
        app.barAlert = true
        app.barMessage = 'There was an unknown error, try again.'
      })
      if (app.users.editedIndex != -1) {
      }
    },

    generatePassword() {
      var length = 15
      var charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"
      var retVal = ""
      for (var i = 0, n = charset.length; i < length; ++i) {
          retVal += charset.charAt(Math.floor(Math.random() * n))
      }
      return retVal
    },

    generateContractPDF() {
      var app = this
      var user = app.users.editedItem
      var url = api_url + 'ra_elite_usa_insurance_generate_contract_pdf'
      app.contract_loading = true
      var full_name = user.first_name + ' ' + user.last_name
      app.$http.post(url, user.agreement_form).then( res => {
        if (res.body.status == 'success') {
          app.contract_loading = false
          var pdf_doc = res.body
          var a = document.createElement('a')
          a.href = pdf_doc.content
          document.body.append(a)
          a.download = full_name + " - Contract.pdf"
          a.click()
          a.remove()
        }
      }, err => {

      })
    },
  }
});
