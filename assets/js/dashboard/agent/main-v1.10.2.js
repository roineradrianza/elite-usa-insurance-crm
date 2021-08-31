/*VUE PLUGINS*/
/*VUETIFY OPTIONS AND SET UP*/

const vuetify = new Vuetify(vuetify_opts)
const api_url = ra_elite_usa_insurance_ajaxurl
Vue.component("downloadExcel", JsonExcel)
/*VUE INSTANCE*/
let vm = new Vue({
  vuetify,
  el: '#ra-elite-usa-insurance-container',
  data: {
    selectedItem: 0,
    barAlert: false,
    barTimeout: 6000,
    percent_loading_active: false,
    percent_loading: false,
    pdf_loading: false,
    logout_loading: false,
    barMessage: '',
    quote_id: url_params.get('quotation_id'),
    notifications_loading: false,
    quote_loading: false,
    table_loading: false,
    requests_table_loading: false,
    attachments_table_loading: false,
    manager_attachments_table_loading: false,
    information_requests_table_loading: false,
    information_requests_loading: false,
    attachment_loading: false,
    view_dialog: false,
    edit_dialog: false,
    alert: false,
    alert_type: '',
    alert_message: '',
    request_edit_form_valid: false,
    routes,
    notifications: [],
    rules: {
      required: [
        v => !!v || 'This field is required',
      ],
    },
    quotes: {
      modification_content: '',
      search: '',
      excel: {
        header: {
          'Full Name': {
            field: 'personal_information',
            callback (v) {
              return `${v.first_name} ${v.middle_name} ${v.last_name}`
            }
          },
          'Birthdate': {
            field: 'personal_information',
            callback (v) {
              return moment(v.birthdate).format('MM/DD/YYYY')
            }
          },
          'Telephone': {
            field: 'personal_information.telephone',
            callback (v) {
              return `Tel:${v}`
            }
          },
          'Email': {
            field: 'personal_information.email',
          },
          'Company / Plan': {
            field: 'affordable_care_act.company_plan'
          },
          'Income': {
            field: 'personal_information.total_income',
            callback (v) {
              let amount = v
              if (typeof amount !== String) {
                var formatter = new Intl.NumberFormat('en-US', {
                  style: 'currency',
                  currency: 'USD',
                });
                var money = formatter.format(amount);
                if (money == '$NaN' || money === NaN) {
                  return amount
                }
                return money
              }
              else {
                return amount
              }
              return 
            }
          },
          'Total Members': {
            callback (v) {
              total = v.affordable_care_act.coverage_type == 'FAMILY' ? 2 : 1
              total = total + v.dependents.length
              return total
            }
          },
          'Members': {
            callback (v) {
              members = v.affordable_care_act.coverage_type == 'FAMILY' ? `${v.espouse_information.first_name} ${v.espouse_information.middle_name} ${v.espouse_information.last_name}` : ``
              if (members.length > 0 && parseInt(v.espouse_information.added)) {
                members += ` (Apply)`
              }
              else if (members.length > 0 && !parseInt(v.espouse_information.added)) {
                members += ` (No Apply)`
              }
              if (v.dependents.length > 0) {
                v.dependents.forEach( (e) => {
                  member_application = parseInt(e.added) ? '(Apply)' : '(No Apply)'
                  members += `\n${e.first_name} ${e.last_name} ${member_application}`
                });
              }
              return members
            }
          },
        },
      },
      header: [
        { text: 'ID', align: 'start', value: 'ID' },
        { text: 'Date', align: 'start', value: 'published_at' },
        { text: 'Applicant', align: 'start', value: 'applicant' },
        { text: 'Status', value: 'status' },
        { text: 'Actions', value: 'actions', align:'center', sortable: false },
      ],
      items: [],
      editedItem: {},
      editedIndex: -1,
    },
    modifications: {
      expanded: [],
      header: [
        { text: 'Date', align: 'center', value: 'published_at' },
        { text: 'Status', align: 'center', value: 'status' },
      ],
      items: [],
      content: '',
    },
    attachments: {
      dialog: false,
      header: [
        { text: 'Date', align: 'center', value: 'published_at' },
        { text: 'Name', align: 'center', value: 'post_title' },
        { text: 'Status', align: 'center', value: 'status' },
        { text: 'Action', align: 'center', value: 'actions' },
      ],
      items: [],
      editedItem: {
        post_title: '',
      },
      editedIndex: -1,
    },
    manager_attachments: {
      header: [
        { text: 'Date', align: 'center', value: 'published_at' },
        { text: 'Name', align: 'center', value: 'post_title' },
        { text: 'Action', align: 'center', value: 'actions' },
      ],
      items: [],
    },
    information_requests: {
      dialog: false,
      delete_dialog: false,
      header: [
        { text: 'Date', align: 'center', value: 'published_at' },
        { text: 'Information', align: 'center', value: 'post_title' },
        { text: 'Content', align: 'center', value: 'post_content' },
        { text: 'Status', align: 'center', value: 'status' },
        { text: 'Action', align: 'center', value: 'actions' },
      ],
      items: [],
      editedItem: {
        post_title: '',
        post_content: '',
      },
      editedIndex: -1,
    },
  },

  created () {
    if (this.quote_id === null) {
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
      var url = api_url + 'ra_elite_usa_insurance_get_my_quote_forms'
      app.table_loading = true
      app.$http.get(url).then( res => {
        app.table_loading = false
        if (res.body.length > 0) {
          var items = []
          var item = {}
          res.body.forEach( (quote) => {
            var item = quote
            item.published_at = moment(item.affordable_care_act.date).format('DD/MM/YYYY, h:mm:ss a')
            item.applicant = item.personal_information.first_name + ' ' + 
            item.personal_information.middle_name + ' ' + 
            item.personal_information.last_name

            items.push(item)
          })
          app.quotes.items = items
        }
      }, err => {
        app.table_loading = false
      })
    },

    initializeAndPrevisualize () {
      var app = this
      var url = api_url + 'ra_elite_usa_insurance_get_my_quote_forms'
      app.table_loading = true
      app.$http.get(url).then( res => {
        app.table_loading = false
        if (res.body.length > 0) {
          var items = []
          var item = {}
          res.body.forEach( (quote) => {
            var item = quote
            item.published_at = item.affordable_care_act.date 
            item.applicant = item.personal_information.first_name + ' ' + 
            item.personal_information.middle_name + ' ' + 
            item.personal_information.last_name

            items.push(item)
          })
          app.quotes.items = items
          var item = app.quotes.items.filter(quote => parseInt(quote.ID) == parseInt(app.quote_id))
          if (item.length > 0) {
            app.showItem(item[0])
            app.getModificationRequests()
            app.getInformationRequests()
            app.getAttachmentsRequests()
            app.getManagerAttachments()
          }
          else {
            app.barAlert = true
            app.barMessage = 'The quote requested is not available'
          }
        }
      }, err => {
        app.table_loading = false
      })
    },

    getModificationRequests () {
      var app = this
      app.modifications.items = []
      var quote_form = app.quotes.editedItem
      var url = api_url + 'ra_elite_usa_insurance_get_quote_modification_requests'
      var index = app.quotes.editedIndex
      var data = {
        post_parent: quote_form.ID,
      }
      app.requests_table_loading = true
      app.$http.post(url, data).then( res => {
        app.requests_table_loading = false
        var items = []
        if (res.body.length > 0) {
          items = res.body
        }
        app.modifications.items = items
      }, err => {
      })
    },

    getAttachmentsRequests () {
      var app = this
      app.attachments.items = []
      var quote_form = app.quotes.editedItem
      var url = api_url + 'ra_elite_usa_insurance_get_quote_attachment_requests'
      var index = app.quotes.editedIndex
      var data = {
        post_parent: quote_form.ID,
      }
      app.attachments_table_loading = true
      app.$http.post(url, data).then( res => {
        app.attachments_table_loading = false
        var items = []
        if (res.body.length > 0) {
          items = res.body
        }
        app.attachments.items = items
      }, err => {
      })
    },
    
    getManagerAttachments () {
      var app = this
      app.manager_attachments.items = []
      var quote_form = app.quotes.editedItem
      var url = api_url + 'ra_elite_usa_insurance_get_quote_manager_attachments'
      var data = {
        post_parent: quote_form.ID,
      }
      app.manager_attachments_table_loading = true
      app.$http.post(url, data).then( res => {
        app.manager_attachments_table_loading = false
        var items = []
        if (res.body.length > 0) {
          items = res.body
        }
        app.manager_attachments.items = items
      }, err => {
      })
    },

    getInformationRequests () {
      var app = this
      app.information_requests.items = []
      var quote_form = app.quotes.editedItem
      var url = api_url + 'ra_elite_usa_insurance_get_quote_information_requests'
      var data = {
        post_parent: quote_form.ID,
      }
      app.information_requests_table_loading = true
      app.$http.post(url, data).then( res => {
        app.information_requests_table_loading = false
        var items = []
        if (res.body.length > 0) {
          items = res.body
        }
        app.information_requests.items = items
      }, err => {
      })
    },

    checkStatusColor (status) {

      switch (status) {

        case 'Processing':

          return 'warning'
          break;

        case 'Approved':
          return 'green'
          break;

        case 'In tray':
          return 'primary';
          break;
      }
    },

    showItem (item) {
      this.quotes.editedIndex = this.quotes.items.indexOf(item)
      this.quotes.editedItem = Object.assign({}, item)
      this.view_dialog = true
    },

    editItem (item) {
      this.quotes.editedIndex = this.quotes.items.indexOf(item)
      this.quotes.editedItem = Object.assign({}, item)
      this.edit_dialog = true
    },

    editAttachmentItem (item) {
      this.attachments.editedIndex = this.attachments.items.indexOf(item)
      this.attachments.editedItem = Object.assign({}, item)
      this.attachments.dialog = true
    },

    editInformationRequestItem (item) {
      this.information_requests.editedIndex = this.information_requests.items.indexOf(item)
      this.information_requests.editedItem = Object.assign({}, item)
      this.information_requests.dialog = true
    },

    closeView () {
      this.view_dialog = false
      this.$nextTick(() => {
        this.quotes.editedItem = Object.assign({}, {})
        this.quotes.editedIndex = -1
      })
    },

    closeEdit () {
      this.edit_dialog = false
      this.$nextTick(() => {
        this.modifications.content = ''
      })
    },

    closeAttachment () {
      this.attachments.dialog = false
      this.$nextTick(() => {
        this.attachments.editedItem = Object.assign({}, {file: ''})
        this.attachments.editedIndex = -1
      })      
    },

    closeInformationRequest () {
      this.information_requests.dialog = false
      this.$nextTick(() => {
        this.information_requests.editedItem = Object.assign({}, {})
        this.information_requests.editedIndex = -1
      })
    },
    
    sendModificationRequest () {
      var app = this
      var quote_form = app.quotes.editedItem
      var url = api_url + 'ra_elite_usa_insurance_save_quote_modification_request'
      var index = app.quotes.editedIndex
      var data = {
        post_parent: quote_form.ID,
        agent: quote_form.affordable_care_act.agent_name,
        post_date: moment().format('YYYY-MM-DD'),
        post_date_name: moment().format('DD/MM/YYYY'),
        post_content: app.modifications.content
      }
      app.quote_loading = true
      app.$http.post(url, data).then( res => {
        app.quote_loading = false
        app.barAlert = true
        if (res.body.hasOwnProperty('message')) {
          app.barMessage = res.body.message
          if (res.body.status == 'success') {
            data.status = 0;
            data.ID = res.body.data;
            app.modifications.items.push(data)
            app.modifications.content = ''
            app.closeEdit()
          }
        }
        else {
          app.alert_type = 'error'
          app.barMessage = 'There was an error'
        }
      }, err => {
        app.quote_loading = false
        app.barAlert = true
        app.barMessage = "There was an error, it can't be possible process the information sent"
      })
    },

    uploadAttachment () {
      var app = this
      var attachment = app.attachments.editedItem
      var url = api_url + 'ra_elite_usa_insurance_upload_quote_attachment_requested'
      var index = app.attachments.editedIndex

      var data = new FormData();

      data.append('ID', attachment.ID)
      data.append('post_title', attachment.post_title)
      data.append('post_author', attachment.post_author)
      data.append('agent', app.quotes.editedItem.affordable_care_act.agent_name)

      if (attachment.attachment_id != '' ) {
        data.append('attachment_id', attachment.attachment_id)
      }

      attachment.doc.forEach((doc, i) => {
        data.append('attachment['+i+']', doc)
      });

      app.attachment_loading = true
      app.$http.post(url, data, {
          progress(e) {
            if (e.lengthComputable) {
              app.percent_loading_active = true
              app.percent_loading = (e.loaded / e.total ) * 100
            }
          }
        }).then( res => {
        app.attachment_loading = false
        app.barAlert = true
        app.percent_loading_active = false
        app.percent_loading_active = 0
        if (res.body.hasOwnProperty('message')) {
          app.barMessage = res.body.message
          if (res.body.status == 'success') {
            attachment.status = 1
            if (attachment.attachment_id == '') {
              attachment.attachment_id = res.body.data.attachment_id
            }
            attachment.attachment_url = res.body.data.attachment_url
            Object.assign(app.attachments.items[index], attachment)
            app.attachments.dialog = false
          }
        }
        else {
          app.alert_type = 'error'
          app.barMessage = 'There was an error'
        }
      }, err => {
        app.attachment_loading = false
        app.barAlert = true
        app.barMessage = "There was an error, it can't be possible process the information sent"
      })
    },

    uploadInformationRequest () {
      var app = this
      var information = app.information_requests.editedItem
      information.agent = app.quotes.editedItem.affordable_care_act.agent_name
      var url = api_url + 'ra_elite_usa_insurance_upload_quote_information_requested'
      var index = app.information_requests.editedIndex

      app.information_requests_loading = true
      app.$http.post(url, information).then( res => {
        app.information_requests_loading = false
        app.barAlert = true
        if (res.body.hasOwnProperty('message')) {
          app.barMessage = res.body.message
          if (res.body.status == 'success') {
            information.status = 2
            Object.assign(app.information_requests.items[index], information)
            app.information_requests.dialog = false
          }
        }
        else {
          app.alert_type = 'error'
          app.barMessage = 'There was an error'
        }
      }, err => {
        app.attachment_loading = false
        app.barAlert = true
        app.barMessage = "There was an error, it can't be possible process the information sent"
      })
    },

    getAge(form) {
      var app = this
      var age = moment().diff(app.quotes.editedItem[form].birthdate, 'years')
      app.quotes.editedItem[form].age = age
      return age
    },

    currencyFormat (amount, show_prefix) {
      if (typeof amount !== String) {
        var formatter = new Intl.NumberFormat('en-US', {
          style: 'currency',
          currency: 'USD',
        });
        var money = formatter.format(amount);
        if (!show_prefix) {
          money = money.split("$")[1]
        }
        if (money == '$NaN' || money === NaN) {
          if (show_prefix) {
            return '$'+ amount
          }
          return amount
        }
        return money
      }
      else {
        return amount
      }
    },

    numberFormat (amount) {
      return Number(amount.replace(/[^0-9.-]+/g,""))
    },

    getFormatDate(d) {
      if (d == '') {
        return ''
      }
      return moment(d).format('MM/DD/YYYY')
    },

    getFormatDateShort(d) {
      if (d == '') {
        return ''
      }
      return moment(d).format('MM/YYYY')
    },

    getFormatDateExtended(d) {
      if (d == '') {
        return ''
      }
      return moment(d).format('MM/DD/YYYY, h:mm:ss a')
    },

    generateQuotePDF() {
      var app = this
      var quote = app.quotes.editedItem
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

    calcTotalIncome() {
      var app = this
      var form = app.quotes.editedItem
      var personal_income = typeof form.employment_information.income === 'string' ? app.numberFormat(form.employment_information.income) : parseInt(form.employment_information.income)
      var espouse_income = typeof form.espouse_employment_information.income === 'string' ? app.numberFormat(form.espouse_employment_information.income) : parseInt(form.espouse_employment_information.income)

      var total_income = personal_income + espouse_income
      
      form.personal_information.total_income = app.currencyFormat(total_income, true)

      return form.personal_information.total_income
    },

    countStatus (status) {
      if (status == '') {
        return this.quotes.items.length
      }
      var items = this.quotes.items.filter( (e, i) => {
        return e.status == status
      })
      return items.length
    },

    filterQuotes (id) {
      var app = this
      var item = app.quotes.items.filter(quote => parseInt(quote.ID) == parseInt(id))
      if (item.length > 0) {
        app.showItem(item[0])
        app.getModificationRequests()
        app.getInformationRequests()
        app.getAttachmentsRequests()
        app.getManagerAttachments()
      }
      else {
        app.barAlert = true
        app.barMessage = 'The quote requested is not available'
      }
    }

  }
});