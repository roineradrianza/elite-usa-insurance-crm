/*VUE PLUGINS*/
//@routes
/*VUETIFY OPTIONS AND SET UP*/

const vuetify = new Vuetify(vuetify_opts);
const api_url = ra_elite_usa_insurance_ajaxurl

/*VUE INSTANCE*/
let vm = new Vue({
  vuetify,
  el: '#ra-elite-usa-insurance-container',
  data: {
    selectedItem: 4,
    barAlert: false,
    barTimeout: 6000,
    barMessage: '',
    table_loading: false,
    alert: false,
    alert_type: '',
    alert_message: '',
    notifications_loading: false,
    pdf_loading: false,
    percent_loading_active: false,
    percent_loading: false,
    requests_table_loading: false,
    attachments_table_loading: false,
    manager_attachments_table_loading: false,
    manager_attachment_loading: false,
    information_requests_table_loading: false,
    information_requests_loading: false,
    quote_loading: false,
    attachment_loading: false,
    view_dialog: false,
    edit_dialog: false,
    delete_dialog: false,
    request_edit_form_valid: false,
    routes,
    notifications: [],
    options: {
      general: [{text: 'Yes', value: 1}, {text: 'No', value: 0}],
      coverage_type: ['INDIVIDUAL', 'FAMILY'],
      status: ['Processing', 'In tray', 'Approved'],
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
      delete_dialog: false,
      upload_dialog: false,
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
      dialog: false,
      delete_dialog: false,
      header: [
        { text: 'Date', align: 'center', value: 'published_at' },
        { text: 'Name', align: 'center', value: 'post_title' },
        { text: 'Action', align: 'center', value: 'actions' },
      ],
      items: [],
      editedItem: {
        post_title: '',
      },
      editedIndex: -1,
    },
    inbox: {
      view_dialog: false,
      loading_details: false,
      search: '',
      header: [
        { text: 'ID', align: 'left', value: 'quote_id' },
        { text: 'Date', align: 'center', value: 'published_at' },
        { text: 'Description', align: 'center', value: 'post_title' },
        { text: 'type', align: 'center', value: 'post_type' },
        { text: 'Status', align: 'center', value: 'status' },
        { text: 'Action', align: 'center', value: 'actions' },
      ],
      items: [],
      editedItem: {},
      editedIndex: -1,
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

  computed: {
  },

  watch: {},

  created () {
    this.initialize()
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
      var url = api_url + 'ra_elite_usa_insurance_get_agent_inbox'
      app.inbox.items = []
      app.table_loading = true
      app.$http.get(url).then( res => {
        app.table_loading = false
        if (res.body.length > 0) {
          var items = []
          var item = {}
          res.body.forEach( (inbox) => {
            var item = inbox
            item.published_at = moment(item.post_date).format('DD/MM/YYYY, h:mm:ss a')
            item.quote_id = item.post_type == 'quote_form' ? item.ID : item.post_parent
            if (item.post_type == 'quote_form') {
              item.applicant = item.personal_information.first_name + ' ' + 
              item.personal_information.middle_name + ' ' + 
              item.personal_information.last_name
            }
            else if (item.post_type == 'quote_doc_r' && parseInt(item.status) == 2) {
              return;
            }
            else if (item.post_type == 'quote_data_r' && parseInt(item.status) == 2) {
              return;
            }
            app.inbox.items.push(item)
          })
        }
      }, err => {
        app.table_loading = false
      })
    },

    generateQuotePDF() {
      var app = this
      var quote = app.inbox.editedItem
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

    getModificationRequests () {
      var app = this
      app.modifications.items = []
      var quote_form = app.inbox.editedItem
      var url = api_url + 'ra_elite_usa_insurance_get_quote_modification_requests'
      var index = app.inbox.editedIndex
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
      var quote_form = app.inbox.editedItem
      var url = api_url + 'ra_elite_usa_insurance_get_quote_attachment_requests'
      var index = app.inbox.editedIndex
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
      var quote_form = app.inbox.editedItem
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
      var quote_form = app.inbox.editedItem
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

    showItem (item) {
      this.inbox.editedIndex = this.inbox.items.indexOf(item)
      this.inbox.editedItem = Object.assign({}, item)
      this.view_dialog = true
    },

    editItem (item) {
      this.inbox.editedIndex = this.inbox.items.indexOf(item)
      this.inbox.editedItem = Object.assign({}, item)
      this.edit_dialog = true
    },

    editInformationRequestItem (item) {
      this.information_requests.editedIndex = this.information_requests.items.indexOf(item)
      this.information_requests.editedItem = Object.assign({}, item)
      this.information_requests.dialog = true
    },
    
    editAttachmentItem (item) {
      this.attachments.editedIndex = this.attachments.items.indexOf(item)
      this.attachments.editedItem = Object.assign({}, item)
      this.attachments.dialog = true
    },

    editUploadAttachmentItem (item) {
      this.attachments.editedIndex = this.attachments.items.indexOf(item)
      this.attachments.editedItem = Object.assign({}, item)
      this.attachments.upload_dialog = true
    },

    deleteItem (item) {
      this.inbox.editedIndex = this.inbox.items.indexOf(item)
      this.inbox.editedItem = Object.assign({}, item)
      this.delete_dialog = true
    },

    showDetailsItem (item) {
      this.inbox.editedItem = Object.assign({}, item)
      this.inbox.view_dialog = true
    },

    closeDetailsView () {
      this.inbox.view_dialog = false
      this.$nextTick(() => {
        this.inbox.editedItem = Object.assign({}, {})
        this.inbox.editedIndex = -1
      })
    },

    closeView () {
      this.view_dialog = false
      this.$nextTick(() => {
        this.inbox.editedItem = Object.assign({}, {})
        this.inbox.editedIndex = -1
      })
    },

    closeAttachment () {
      this.attachments.dialog = false
      this.$nextTick(() => {
        this.attachments.editedItem = Object.assign({}, {})
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
      var quote_form = app.inbox.editedItem
      var url = api_url + 'ra_elite_usa_insurance_save_quote_modification_request'
      var index = app.inbox.editedIndex
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

    closeUploadAttachment () {
      this.attachments.upload_dialog = false
      this.$nextTick(() => {
        this.attachments.editedItem = Object.assign({}, {})
        this.attachments.editedIndex = -1
      })
    },

    closeEdit () {
      this.edit_dialog = false
      if (!this.view_dialog) {
        this.$nextTick(() => {
          this.inbox.editedItem = Object.assign({}, {})
          this.inbox.editedIndex = -1
        })
      }
    },

    closeDelete () {
      this.delete_dialog = false
      this.$nextTick(() => {
        this.inbox.editedItem = Object.assign({}, {})
        this.inbox.editedIndex = -1
      })
    },

    closeAttachmentDelete () {
      this.attachments.delete_dialog = false
      this.$nextTick(() => {
        this.attachments.editedItem = Object.assign({}, {})
        this.attachments.editedIndex = -1
      })
    },

    getAge(form) {
      var app = this
      var age = moment().diff(app.inbox.editedItem[form].birthdate, 'years')
      app.inbox.editedItem[form].age = age
      return age
    },

    calcTotalIncome() {
      var app = this
      var form = app.inbox.editedItem
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
        uscis_number: '',
        card_number: '',
        document_from: '',
        document_expires: '',
      }
      app.inbox.editedItem.dependents.push(item)
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
      app.inbox.editedItem.dependents.splice(index, 1)
    },

    closeAttachment () {
      this.attachments.dialog = false
      this.$nextTick(() => {
        this.attachments.editedItem = Object.assign({}, {file: ''})
        this.attachments.editedIndex = -1
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
      data.append('agent', app.inbox.editedItem.affordable_care_act.agent_name)

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
      information.agent = app.inbox.editedItem.affordable_care_act.agent_name
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

    returnPostType (post_type) {
      switch (post_type) {

        case 'quote_form':
          return 'Quote Form'
          break;

        case 'quote_form_mr':
          return 'Modification'
          break;

        case 'quote_data_r':
          return 'Information Requested'
          break;

        case 'quote_doc_r':
          return 'Document Requested'
          break;
      }
    },

    checkStatusColor (status, post_type) {
      if (post_type == 'quote_form') {
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
      }
      else if (post_type == 'quote_doc_r') {
        status = parseInt(status)
        switch (status) {
          case 0:

            return 'warning'
            break;

          case 1:
            return 'green'
            break;

          case 2:
            return 'primary'
            break;

          case 3:
            return 'warning'
            break;
        }
      }
      else {
        status = parseInt(status)
        switch (status) {
          case 0:

            return 'warning'
            break;

          case 1:
            return 'green'
            break;

          case 2:
            return 'primary'
            break;
        }
      }
    },

    returnStatusType (status, post_type) {
      if (post_type == 'quote_form') {
         return status
      }
      else if (post_type == 'quote_doc_r') {
        status = parseInt(status)
        switch (status) {
          case 0:

            return 'Pending'
            break;

          case 1:
            return 'Approved'
            break;

          case 2:

            return 'Sent'
            break;

          case 3:

            return 'Processing'
            break;
        }
      }
      else {
        status = parseInt(status)
        switch (status) {
          case 0:

            return 'Processing'
            break;

          case 1:
            return 'Approved'
            break;

          case 2:

            return 'Sent'
            break;
        }
      }
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

    markItemAsRead (item, index) {
      var app = this
      var url = api_url + 'ra_elite_usa_insurance_mark_read_notification'

      app.$http.post(url, item).then( res => {
        app.barAlert = true
        if (res.body.hasOwnProperty('message')) {
          app.barMessage = res.body.message
          if (res.body.status == 'success') {
            app.inbox.items.splice(index, 1)
          }
        }
        else {
          app.alert_type = 'error'
          app.barMessage = 'There was an error'
        }
      }, err => {
        app.barAlert = true
        app.barMessage = "There was an error, it can't be possible process the information sent"
      })
    },

    filterQuotes (id) {
      var app = this
      var inbox = app.inbox
      inbox.loading_details = true
      var quote = inbox.items.filter( (e) => {
        return e.ID == id
      })
      if (quote.length > 0) {
        app.showItem(quote[0]) 
        app.getModificationRequests()
        app.getAttachmentsRequests()
        app.getManagerAttachments()
        app.getInformationRequests()
        inbox.view_dialog = false
        inbox.loading_details = false
      }
      else {
        var app = this
        var url = api_url + 'ra_elite_usa_insurance_get_quote'
        app.$http.post(url, {ID: id}).then( res => {
          if (res.body != null && res.body.hasOwnProperty('ID')) {
              quote = res.body
              quote.published_at = moment(quote.affordable_care_act.date).format('DD/MM/YYYY, h:mm:ss a')
              quote.applicant = quote.personal_information.first_name + ' ' + 
              quote.personal_information.middle_name + ' ' + 
              quote.personal_information.last_name

              inbox.editedItem = Object.assign({}, quote)
              app.showItem(quote) 
              app.getModificationRequests()
              app.getAttachmentsRequests()
              app.getManagerAttachments()
              app.getInformationRequests()
              inbox.view_dialog = false
              inbox.loading_details = false
          }
          else {
            app.barAlert = true
            app.barMessage = 'Any quote was found using the item requested'
            inbox.loading_details = false
          }
        }, err => {
          app.table_loading = false
        })
      } 
    },


  }
});
