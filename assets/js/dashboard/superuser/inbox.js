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
    agent_attachments_table_loading: false,
    agent_attachment_loading: false,
    information_requests_table_loading: false,
    information_requests_loading: false,
    quote_loading: false,
    attachment_loading: false,
    view_dialog: false,
    edit_dialog: false,
    delete_dialog: false,
    countries: countries,
    affordable_care_act_valid: true,
    personal_information_valid: true,
    employment_information_valid: true,
    espouse_information_valid: true,
    espouse_employment_information_valid: true,
    dependents_information_valid: true,
    payment_information_valid: true,
    affordable_care_act_effectiveness_date_modal: false,
    personal_information_birthdate_modal: false,
    personal_information_document_expiration_modal: false,
    affordable_care_act_date_modal: false,
    espouse_information_birthdate_modal: false,
    espouse_information_document_expiration_modal: false,
    dependent_birthdate_modal: false,
    dependent_expires_modal: false,
    payment_expiration_date_modal: false,
    autopay_date_modal: false,
    routes,
    notifications: [],
    options: {
      general: [{ text: 'Yes', value: 1 }, { text: 'No', value: 0 }],
      coverage_type: ['INDIVIDUAL', 'FAMILY'],
      status: ['Processing', 'In tray', 'Approved'],
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
    countries: countries,
    rules: {
      required: [
        v => !!v || 'This field is required',
      ],
      name: [
        v => !!v || 'Name is required',
        v => (v && v.length <= 10) || 'Name must be more than 10 characters',
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
    modifications: {
      expanded: [],
      header: [
        { text: 'Date', align: 'center', value: 'published_at' },
        { text: 'Status', align: 'center', value: 'status' },
        { text: 'Action', align: 'center', value: 'actions' },
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
    agent_attachments: {
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
    routes: routes,
    inbox: {
      view_dialog: false,
      loading_details: false,
      search: '',
      header: [
        { text: 'ID', align: 'left', value: 'quote_id' },
        { text: 'Date', align: 'left', value: 'published_at' },
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
    action_history: {
      dialog: false,
      details_dialog: false,
      loading: false,
      headers: [
        { text: 'Date', align: 'center', value: 'created_at' },
        { text: 'Description', align: 'center', value: 'action_message' },
        { text: 'Action', align: 'center', value: 'actions' },
      ],
      items: [],
      editedItem: {},
      detail_items: [],
    }
  },

  computed: {
    formAttachmentTitle() {
      return this.attachments.editedIndex === -1 ? 'New Document Attachment' : 'Edit Document Attachment'
    },

    formManagerAttachmentTitle() {
      return this.manager_attachments.editedIndex === -1 ? 'New Document Attachment' : 'Edit Document Attachment'
    },

    formRequestInformationTitle() {
      return this.information_requests.editedIndex === -1 ? 'New Information Request' : 'Edit Information Request'
    },
  },

  watch: {},

  created() {
    this.initialize()
    initNotifications(this)
    setInterval(initNotifications, 30000, this)
  },
  mounted() {

  },

  methods: {

    logout() {
      var app = this
      var url = api_url + 'ra_elite_usa_insurance_logout'
      app.logout_loading = true
      app.$http.get(url).then(res => {
        app.logout_loading = false
        window.location = res.body.redirect_url
      }, err => {
        app.logout_loading = false
      })
    },

    initialize() {
      var app = this
      var url = api_url + 'ra_elite_usa_insurance_get_inbox'
      app.inbox.items = []
      app.table_loading = true
      app.$http.get(url).then(res => {
        app.table_loading = false
        if (res.body.length > 0) {
          var items = []
          var item = {}
          res.body.forEach((inbox) => {
            var item = inbox
            item.published_at = moment(item.post_date).format('DD/MM/YYYY, h:mm:ss a')
            item.quote_id = item.post_type == 'quote_form' ? item.ID : item.post_parent
            if (item.post_type == 'quote_form') {
              item.applicant = item.personal_information.first_name + ' ' +
                item.personal_information.middle_name + ' ' +
                item.personal_information.last_name
              item.type = item.post_parent <= 0 ? 'First-Time' : 'Renewal'
              item.personal_information.same_address = item.personal_information.hasOwnProperty('same_address') ? item.personal_information.same_address : 1
              if (item.affordable_care_act.hasOwnProperty('renewal_date')) {
                item.year = moment(item.affordable_care_act.renewal_date).format('YYYY')
              } else {
                item.year = moment(item.affordable_care_act.effectiveness_date).isSameOrAfter(moment(item.affordable_care_act.date)) 
                ? moment(item.affordable_care_act.effectiveness_date).format('YYYY') : moment(item.affordable_care_act.date).format('YYYY')
              }
            }
            else if (item.post_type == 'quote_doc_r' && parseInt(item.status) == 0) {
              return;
            }
            else if (item.post_type == 'quote_data_r' && parseInt(item.status) == 0) {
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
      app.$http.post(url, quote).then(res => {
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

    getModificationRequests() {
      var app = this
      app.modifications.items = []
      var quote_form = app.inbox.editedItem
      var url = api_url + 'ra_elite_usa_insurance_get_quote_modification_requests'
      var index = app.inbox.editedIndex
      var data = {
        post_parent: quote_form.ID,
      }
      app.requests_table_loading = true
      app.$http.post(url, data).then(res => {
        app.requests_table_loading = false
        var items = []
        if (res.body.length > 0) {
          items = res.body
        }
        app.modifications.items = items
      }, err => {
      })
    },

    getAttachmentsRequests() {
      var app = this
      app.attachments.items = []
      var quote_form = app.inbox.editedItem
      var url = api_url + 'ra_elite_usa_insurance_get_quote_attachment_requests'
      var index = app.inbox.editedIndex
      var data = {
        post_parent: quote_form.ID,
      }
      app.attachments_table_loading = true
      app.$http.post(url, data).then(res => {
        app.attachments_table_loading = false
        var items = []
        if (res.body.length > 0) {
          items = res.body
        }
        app.attachments.items = items
      }, err => {
      })
    },

    getManagerAttachments() {
      var app = this
      app.manager_attachments.items = []
      var quote_form = app.inbox.editedItem
      var url = api_url + 'ra_elite_usa_insurance_get_quote_manager_attachments'
      var data = {
        post_parent: quote_form.ID,
      }
      app.manager_attachments_table_loading = true
      app.$http.post(url, data).then(res => {
        app.manager_attachments_table_loading = false
        var items = []
        if (res.body.length > 0) {
          items = res.body
        }
        app.manager_attachments.items = items
      }, err => {
      })
    },

    getInformationRequests() {
      var app = this
      app.information_requests.items = []
      var quote_form = app.inbox.editedItem
      var url = api_url + 'ra_elite_usa_insurance_get_quote_information_requests'
      var data = {
        post_parent: quote_form.ID,
      }
      app.information_requests_table_loading = true
      app.$http.post(url, data).then(res => {
        app.information_requests_table_loading = false
        var items = []
        if (res.body.length > 0) {
          items = res.body
        }
        app.information_requests.items = items
      }, err => {
      })
    },

    getActionsHistory(quote) {
      var app = this
      app.action_history.items = []
      var url = api_url + 'ra_elite_usa_insurance_get_quote_action_history'
      var data = {
        ID: quote.ID,
      }
      app.action_history.loading = true
      app.$http.post(url, data).then(res => {
        app.action_history.loading = false
        var items = []
        if (res.body.length > 0) {
          res.body.forEach((e, i) => {
            e.extra_info = JSON.parse(e.extra_info)
            //e.created_at = usesGMT ? moment.utc(moment(e.created_at).format('YYYY-MM-DD, h:mm:ss')).local() : e.created_at
            if (e.extra_info.post_type == 'quote_doc_r') {
              if (e.extra_info.meta_input.attachment_url.includes('[')) {
                e.extra_info.meta_input.attachment_url = JSON.parse(e.extra_info.meta_input.attachment_url)
              }
            }
          })
        }
        items = res.body
        app.action_history.items = items
      }, err => {
      })
    },

    getAgentAttachments() {
      var app = this
      app.agent_attachments.items = []
      var quote_form = app.quotes.editedItem
      var url = api_url + 'ra_elite_usa_insurance_get_quote_agent_attachments'
      var data = {
        post_parent: quote_form.ID,
      }
      app.agent_attachments_table_loading = true
      app.$http.post(url, data).then(res => {
        app.agent_attachments_table_loading = false
        var items = []
        if (res.body.length > 0) {
          items = res.body
        }
        app.agent_attachments.items = items
      }, err => {
      })
    },

    editAgentAttachmentItem(item) {
      this.agent_attachments.editedIndex = this.agent_attachments.items.indexOf(item)
      this.agent_attachments.editedItem = Object.assign({}, item)
      this.agent_attachments.dialog = true
    },

    deleteAgentAttachmentItem(item) {
      this.agent_attachments.editedIndex = this.agent_attachments.items.indexOf(item)
      this.agent_attachments.editedItem = Object.assign({}, item)
      this.agent_attachments.delete_dialog = true
    },

    closeAgentAttachment() {
      this.agent_attachments.dialog = false
      this.$nextTick(() => {
        this.agent_attachments.editedItem = Object.assign({}, {})
        this.agent_attachments.editedIndex = -1
      })
    },

    saveManagerAttachment() {
      var app = this
      var attachment = app.agent_attachments.editedItem
      var url = api_url + 'ra_elite_usa_insurance_save_quote_agent_attachment'
      var index = app.agent_attachments.editedIndex

      var data = new FormData();
      if (attachment.hasOwnProperty('ID') && attachment.ID != undefined) {
        data.append('ID', attachment.ID)
      }
      data.append('post_parent', app.quotes.editedItem.ID)
      data.append('agent', app.quotes.editedItem.post_author)
      data.append('post_title', attachment.post_title)
      if (attachment.doc != undefined || attachment.doc != '') {
        data.append('attachment', attachment.doc)
      }

      if (attachment.hasOwnProperty('post_author') && attachment.post_author != '') {
        data.append('post_author', attachment.post_author)
      }

      if (attachment.hasOwnProperty('attachment_id') && attachment.attachment_id != '') {
        data.append('attachment_id', attachment.attachment_id)
      }

      if (attachment.hasOwnProperty('attachment_url') && attachment.attachment_url != '') {
        data.append('attachment_url', attachment.attachment_url)
      }

      app.manager_attachment_loading = true
      app.$http.post(url, data, {
        progress(e) {
          if (e.lengthComputable) {
            app.percent_loading_active = true
            app.percent_loading = (e.loaded / e.total) * 100
          }
        }
      }).then(res => {
        app.manager_attachment_loading = false
        app.barAlert = true
        app.percent_loading_active = false
        app.percent_loading_active = 0
        if (res.body.hasOwnProperty('message')) {
          app.barMessage = res.body.message
          if (res.body.status == 'success') {
            if (!attachment.hasOwnProperty('attachment_id') || attachment.attachment_id == '') {
              attachment.ID = res.body.data.ID
              attachment.attachment_id = res.body.data.attachment_id
              attachment.published_at = moment()
            }
            attachment.attachment_url = res.body.data.hasOwnProperty('attachment_url') ? res.body.data.attachment_url : attachment.attachment_url
            if (index === -1) {
              app.agent_attachments.items.push(attachment)
            }
            else {
              Object.assign(app.agent_attachments.items[index], attachment)
            }
            app.agent_attachments.dialog = false
          }
        }
        else {
          app.alert_type = 'error'
          app.barMessage = 'There was an error'
        }
      }, err => {
        app.manager_attachment_loading = false
        app.barAlert = true
        app.barMessage = "There was an error, it can't be possible process the information sent"
      })
    },
    
    deleteAgentAttachment() {
      var app = this
      var attachment = app.agent_attachments.editedItem
      var url = api_url + 'ra_elite_usa_insurance_delete_quote_manager_attachment'
      var index = app.agent_attachments.editedIndex

      app.$http.post(url, { ID: attachment.ID }).then(res => {
        app.barAlert = true
        app.agent_attachments.delete_dialog = false
        if (res.body.hasOwnProperty('message')) {
          app.barMessage = res.body.message
          if (res.body.status == 'success') {
            app.agent_attachments.items.splice(index, 1)
          }
        }
        else {
          app.alert_type = 'error'
          app.barMessage = 'There was an error'
        }
      }, err => {
        app.agent_attachments.delete_dialog = false
        app.barAlert = true
        app.barMessage = "There was an error, it can't be possible process the information sent"
      })
    },

    showActionDetails(item) {
      var app = this
      var action_history = app.action_history
      action_history.editedItem = Object.assign({}, item)
      action_history.detail_items = []
      var items = action_history.items.filter(e => {
        return e.post_parent == action_history.editedItem.post_parent
      })
      action_history.detail_items = items
      action_history.details_dialog = true
    },

    showItem(item) {
      this.inbox.editedIndex = this.inbox.items.indexOf(item)
      this.inbox.editedItem = Object.assign({}, item)
      this.view_dialog = true
    },

    editItem(item) {
      this.inbox.editedIndex = this.inbox.items.indexOf(item)
      this.inbox.editedItem = Object.assign({}, item)
      this.edit_dialog = true
    },

    editManagerAttachmentItem(item) {
      this.manager_attachments.editedIndex = this.manager_attachments.items.indexOf(item)
      this.manager_attachments.editedItem = Object.assign({}, item)
      this.manager_attachments.dialog = true
    },

    editAttachmentItem(item) {
      this.attachments.editedIndex = this.attachments.items.indexOf(item)
      this.attachments.editedItem = Object.assign({}, item)
      this.attachments.dialog = true
    },

    editUploadAttachmentItem(item) {
      this.attachments.editedIndex = this.attachments.items.indexOf(item)
      this.attachments.editedItem = Object.assign({}, item)
      this.attachments.upload_dialog = true
    },

    deleteItem(item) {
      this.inbox.editedIndex = this.inbox.items.indexOf(item)
      this.inbox.editedItem = Object.assign({}, item)
      this.delete_dialog = true
    },

    deleteDocumentItem(item) {
      this.attachments.editedIndex = this.attachments.items.indexOf(item)
      this.attachments.editedItem = Object.assign({}, item)
      this.attachments.delete_dialog = true
    },

    deleteManagerAttachmentItem(item) {
      this.manager_attachments.editedIndex = this.manager_attachments.items.indexOf(item)
      this.manager_attachments.editedItem = Object.assign({}, item)
      this.manager_attachments.delete_dialog = true
    },

    deleteInformationRequestItem(item) {
      this.information_requests.editedIndex = this.information_requests.items.indexOf(item)
      this.information_requests.editedItem = Object.assign({}, item)
      this.information_requests.delete_dialog = true
    },

    markAgentAttachmentAsSeen(item) {
      var app = this
      var url = api_url + 'ra_elite_usa_insurance_mark_seen_quote_agent_attachment'
      if (item.status == 0) {
        app.$http.post(url, item).then(res => {
          if (res.body.status == 'success') {
            item.status = 1
          }
          app.download([item.attachment_url])
        }, err => {
  
        }) 
      } else {
        app.download([item.attachment_url])
      }
    },

    closeView() {
      this.view_dialog = false
      this.$nextTick(() => {
        this.inbox.editedItem = Object.assign({}, {})
        this.inbox.editedIndex = -1
      })
    },

    closeAttachment() {
      this.attachments.dialog = false
      this.$nextTick(() => {
        this.attachments.editedItem = Object.assign({}, {})
        this.attachments.editedIndex = -1
      })
    },

    closeInformationRequest() {
      this.information_requests.dialog = false
      this.$nextTick(() => {
        this.information_requests.editedItem = Object.assign({}, {})
        this.information_requests.editedIndex = -1
      })
    },

    closeUploadInformationRequest() {
      this.information_requests.dialog = false
      this.$nextTick(() => {
        this.information_requests.editedItem = Object.assign({}, {})
        this.information_requests.editedIndex = -1
      })
    },

    closeManagerAttachment() {
      this.manager_attachments.dialog = false
      this.$nextTick(() => {
        this.manager_attachments.editedItem = Object.assign({}, {})
        this.manager_attachments.editedIndex = -1
      })
    },

    closeInformationRequest() {
      this.information_requests.dialog = false
      this.$nextTick(() => {
        this.information_requests.editedItem = Object.assign({}, {})
        this.information_requests.editedIndex = -1
      })
    },

    closeUploadAttachment() {
      this.attachments.upload_dialog = false
      this.$nextTick(() => {
        this.attachments.editedItem = Object.assign({}, {})
        this.attachments.editedIndex = -1
      })
    },

    closeEdit() {
      this.edit_dialog = false
      if (!this.view_dialog) {
        this.$nextTick(() => {
          this.inbox.editedItem = Object.assign({}, {})
          this.inbox.editedIndex = -1
        })
      }
    },

    closeDelete() {
      this.delete_dialog = false
      this.$nextTick(() => {
        this.inbox.editedItem = Object.assign({}, {})
        this.inbox.editedIndex = -1
      })
    },

    closeInformationRequestDelete() {
      this.information_requests.delete_dialog = false
      this.$nextTick(() => {
        this.information_requests.editedItem = Object.assign({}, {})
        this.information_requests.editedIndex = -1
      })
    },

    closeAttachmentDelete() {
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
      app.inbox.editedItem.dependents.splice(index, 1)
    },

    updateQuoteForm() {
      var app = this
      var quote_form = app.inbox.editedItem
      var url = api_url + 'ra_elite_usa_insurance_save_quote_form'
      var index = app.inbox.editedIndex

      app.quote_loading = true
      app.$http.post(url, quote_form).then(res => {
        app.quote_loading = false
        app.barAlert = true
        if (res.body.hasOwnProperty('message')) {
          app.barMessage = res.body.message
          if (res.body.status == 'success') {
            Object.assign(app.inbox.items[index], quote_form)
            app.edit_dialog = false
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

    saveAttachmentRequest() {
      var app = this
      var attachment = app.attachments.editedItem
      var url = api_url + 'ra_elite_usa_insurance_save_quote_attachment_request'
      var index = app.attachments.editedIndex

      attachment.post_parent = app.inbox.editedItem.ID
      attachment.post_author = app.inbox.editedItem.post_author

      app.attachment_loading = true
      app.$http.post(url, attachment).then(res => {
        app.attachment_loading = false
        app.barAlert = true
        if (res.body.hasOwnProperty('message')) {
          app.barMessage = res.body.message
          if (res.body.status == 'success') {
            if (index == -1) {
              attachment.ID = res.body.data
              attachment.attachment_url = ''
              attachment.attachment_id = ''
              app.attachments.items.push(attachment)
            }
            else {
              Object.assign(app.attachments.items[index], attachment)
            }
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

    saveInformationRequest() {
      var app = this
      var information = app.information_requests.editedItem
      var url = api_url + 'ra_elite_usa_insurance_save_quote_information_request'
      var index = app.information_requests.editedIndex

      information.post_parent = app.inbox.editedItem.ID
      information.post_author = app.inbox.editedItem.post_author

      app.information_requests_loading = true
      app.$http.post(url, information).then(res => {
        app.information_requests_loading = false
        app.barAlert = true
        if (res.body.hasOwnProperty('message')) {
          app.barMessage = res.body.message
          if (res.body.status == 'success') {
            if (index == -1) {
              information.ID = res.body.data
              information.status = 0
              app.information_requests.items.push(information)
            }
            else {
              Object.assign(app.information_requests.items[index], information)
            }
            app.closeInformationRequest()
          }
        }
        else {
          app.alert_type = 'error'
          app.barMessage = 'There was an error'
        }
      }, err => {
        app.information_requests_loading = false
        app.barAlert = true
        app.barMessage = "There was an error, it can't be possible process the information sent"
      })
    },

    saveManagerAttachment() {
      var app = this
      var attachment = app.manager_attachments.editedItem
      var url = api_url + 'ra_elite_usa_insurance_save_quote_manager_attachment'
      var index = app.manager_attachments.editedIndex

      var data = new FormData();
      if (attachment.hasOwnProperty('ID') && attachment.ID != undefined) {
        data.append('ID', attachment.ID)
      }
      data.append('post_parent', app.inbox.editedItem.ID)
      data.append('agent', app.inbox.editedItem.post_author)
      data.append('post_title', attachment.post_title)
      if (attachment.doc != undefined || attachment.doc != '') {
        data.append('attachment', attachment.doc)
      }

      if (attachment.hasOwnProperty('post_author') && attachment.post_author != '') {
        data.append('post_author', attachment.post_author)
      }

      if (attachment.hasOwnProperty('attachment_id') && attachment.attachment_id != '') {
        data.append('attachment_id', attachment.attachment_id)
      }

      if (attachment.hasOwnProperty('attachment_url') && attachment.attachment_url != '') {
        data.append('attachment_url', attachment.attachment_url)
      }

      app.manager_attachment_loading = true
      app.$http.post(url, data, {
        progress(e) {
          if (e.lengthComputable) {
            app.percent_loading_active = true
            app.percent_loading = (e.loaded / e.total) * 100
          }
        }
      }).then(res => {
        app.manager_attachment_loading = false
        app.barAlert = true
        app.percent_loading_active = false
        app.percent_loading_active = 0
        if (res.body.hasOwnProperty('message')) {
          app.barMessage = res.body.message
          if (res.body.status == 'success') {
            if (!attachment.hasOwnProperty('attachment_id') || attachment.attachment_id == '') {
              attachment.ID = res.body.data.ID
              attachment.attachment_id = res.body.data.attachment_id
              attachment.published_at = moment()
            }
            attachment.attachment_url = res.body.data.hasOwnProperty('attachment_url') ? res.body.data.attachment_url : attachment.attachment_url
            if (index === -1) {
              app.manager_attachments.items.push(attachment)
            }
            else {
              Object.assign(app.manager_attachments.items[index], attachment)
            }
            app.manager_attachments.dialog = false
          }
        }
        else {
          app.alert_type = 'error'
          app.barMessage = 'There was an error'
        }
      }, err => {
        app.manager_attachment_loading = false
        app.barAlert = true
        app.barMessage = "There was an error, it can't be possible process the information sent"
      })
    },

    closeAttachment() {
      this.attachments.dialog = false
      this.$nextTick(() => {
        this.attachments.editedItem = Object.assign({}, { file: '' })
        this.attachments.editedIndex = -1
      })
    },

    closeInformationRequest() {
      this.information_requests.dialog = false
      this.$nextTick(() => {
        this.information_requests.editedItem = Object.assign({}, {})
        this.information_requests.editedIndex = -1
      })
    },

    updateAttachmentName(item) {
      var app = this
      var attachment = item
      var url = api_url + 'ra_elite_usa_insurance_save_quote_attachment_request'
      var index = app.attachments.items.indexOf(item)
      attachment.post_parent = app.inbox.editedItem.ID
      attachment.post_author = app.inbox.editedItem.post_author

      app.$http.post(url, attachment).then(res => {
        app.barAlert = true
        if (res.body.hasOwnProperty('message')) {
          app.barMessage = res.body.message
          if (res.body.status == 'success') {
            app.$refs.attachment_edit_dialog.save()
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

    approveModification(item) {
      var app = this
      var url = api_url + 'ra_elite_usa_insurance_approve_form_modification_request'

      app.quote_loading = true
      app.$http.post(url, item).then(res => {
        app.quote_loading = false
        app.barAlert = true
        if (res.body.hasOwnProperty('message')) {
          app.barMessage = res.body.message
          if (res.body.status == 'success') {
            item.status = 1
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

    approveInformation(item) {
      var app = this
      var url = api_url + 'ra_elite_usa_insurance_approve_form_information_request'

      app.quote_loading = true
      app.$http.post(url, item).then(res => {
        app.quote_loading = false
        app.barAlert = true
        if (res.body.hasOwnProperty('message')) {
          app.barMessage = res.body.message
          if (res.body.status == 'success') {
            item.status = 1
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

    approveDocumentRequested(item) {
      var app = this
      var url = api_url + 'ra_elite_usa_insurance_approve_form_document_requested'

      app.$http.post(url, item).then(res => {
        app.barAlert = true
        if (res.body.hasOwnProperty('message')) {
          app.barMessage = res.body.message
          if (res.body.status == 'success') {
            item.status = 1
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

    markAsProcessingDocumentRequested(item) {
      var app = this
      var url = api_url + 'ra_elite_usa_insurance_process_form_document_requested'

      app.$http.post(url, item).then(res => {
        app.barAlert = true
        if (res.body.hasOwnProperty('message')) {
          app.barMessage = res.body.message
          if (res.body.status == 'success') {
            item.status = 3
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

    deleteQuoteForm() {
      var app = this
      var quote_form = app.inbox.editedItem
      var url = api_url + 'ra_elite_usa_insurance_delete_quote'
      var index = app.inbox.editedIndex

      app.$http.post(url, { ID: quote_form.ID }).then(res => {
        app.barAlert = true
        app.delete_dialog = false
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
        app.delete_dialog = false
        app.barAlert = true
        app.barMessage = "There was an error, it can't be possible process the information sent"
      })
    },

    deleteDocumentRequested() {
      var app = this
      var attachment = app.attachments.editedItem
      var url = api_url + 'ra_elite_usa_insurance_delete_quote_attachment_requested'
      var index = app.attachments.editedIndex

      app.$http.post(url, { ID: attachment.ID }).then(res => {
        app.barAlert = true
        app.attachments.delete_dialog = false
        if (res.body.hasOwnProperty('message')) {
          app.barMessage = res.body.message
          if (res.body.status == 'success') {
            app.attachments.items.splice(index, 1)
          }
        }
        else {
          app.alert_type = 'error'
          app.barMessage = 'There was an error'
        }
      }, err => {
        app.attachments.delete_dialog = false
        app.barAlert = true
        app.barMessage = "There was an error, it can't be possible process the information sent"
      })
    },

    deleteManagerAttachment() {
      var app = this
      var attachment = app.manager_attachments.editedItem
      var url = api_url + 'ra_elite_usa_insurance_delete_quote_manager_attachment'
      var index = app.manager_attachments.editedIndex

      app.$http.post(url, { ID: attachment.ID }).then(res => {
        app.barAlert = true
        app.manager_attachments.delete_dialog = false
        if (res.body.hasOwnProperty('message')) {
          app.barMessage = res.body.message
          if (res.body.status == 'success') {
            app.manager_attachments.items.splice(index, 1)
          }
        }
        else {
          app.alert_type = 'error'
          app.barMessage = 'There was an error'
        }
      }, err => {
        app.manager_attachments.delete_dialog = false
        app.barAlert = true
        app.barMessage = "There was an error, it can't be possible process the information sent"
      })
    },

    uploadAttachment() {
      var app = this
      var attachment = app.attachments.editedItem
      var url = api_url + 'ra_elite_usa_insurance_upload_quote_attachment_requested'
      var index = app.attachments.editedIndex

      var data = new FormData();

      data.append('ID', attachment.ID)
      data.append('post_title', attachment.post_title)
      data.append('post_author', attachment.post_author)
      data.append('agent', app.inbox.editedItem.affordable_care_act.agent_name)

      if (attachment.attachment_id != '') {
        data.append('attachment_id', attachment.attachment_id)
      }

      attachment.doc.forEach((doc, i) => {
        data.append('attachment[' + i + ']', doc)
      });

      app.attachment_loading = true
      app.$http.post(url, data, {
        progress(e) {
          if (e.lengthComputable) {
            app.percent_loading_active = true
            app.percent_loading = (e.loaded / e.total) * 100
          }
        }
      }).then(res => {
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

    uploadInformationRequest() {
      var app = this
      var information = app.information_requests.editedItem
      information.agent = app.inbox.editedItem.affordable_care_act.agent_name
      var url = api_url + 'ra_elite_usa_insurance_upload_quote_information_requested'
      var index = app.information_requests.editedIndex

      app.information_requests_loading = true
      app.$http.post(url, information).then(res => {
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

    deleteInformationRequest() {
      var app = this
      var attachment = app.information_requests.editedItem
      var url = api_url + 'ra_elite_usa_insurance_delete_quote_information_request'
      var index = app.information_requests.editedIndex

      app.$http.post(url, { ID: attachment.ID }).then(res => {
        app.barAlert = true
        app.information_requests.delete_dialog = false
        if (res.body.hasOwnProperty('message')) {
          app.barMessage = res.body.message
          if (res.body.status == 'success') {
            app.information_requests.items.splice(index, 1)
          }
        }
        else {
          app.alert_type = 'error'
          app.barMessage = 'There was an error'
        }
      }, err => {
        app.manager_attachments.delete_dialog = false
        app.barAlert = true
        app.barMessage = "There was an error, it can't be possible process the information sent"
      })
    },

    currencyFormat(amount, show_prefix) {
      if (typeof amount !== 'string') {
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
            return '$' + amount
          }
          return amount
        }
        return money
      }
      else {
        return amount
      }
    },

    numberFormat(amount) {
      return Number(amount.replace(/[^0-9.-]+/g, ""))
    },

    showDetailsItem(item) {
      this.inbox.editedItem = Object.assign({}, item)
      this.inbox.view_dialog = true
    },

    closeDetailsView() {
      this.inbox.view_dialog = false
      this.$nextTick(() => {
        this.inbox.editedItem = Object.assign({}, {})
        this.inbox.editedIndex = -1
      })
    },

    returnPostType(post_type) {
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

        case 'quote_a_doc':
          return 'Document received'
          break;
  
        case 'quote_doc_r':
          return 'Document Requested'
          break;
      }
    },

    checkStatusColor(status, post_type) {
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

          default:
            return 'grey darken-2'
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
      else if (post_type == 'quote_a_doc') {
        status = parseInt(status)
        switch (status) {

          case 0:

            return 'primary'
            break;

          case 1:
            return 'Seen'
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

    returnStatusType(status, post_type) {
      if (post_type == 'quote_form') {
        return status
      } else if (post_type == 'quote_a_doc') {
        status = parseInt(status)
        switch (status) {
          case 0:

            return 'Received'
            break;

          case 1:
            return 'Seen'
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

            return 'Received'
            break;
        }
      }
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

    filterQuotes(id) {
      var app = this
      var inbox = app.inbox
      inbox.loading_details = true
      var quote = inbox.items.filter((e) => {
        return e.ID == id
      })
      if (quote.length > 0) {
        app.showItem(quote[0])
        app.getModificationRequests()
        app.getAttachmentsRequests()
        app.getManagerAttachments()
        app.getInformationRequests()
        app.getAgentAttachments()
        inbox.view_dialog = false
        inbox.loading_details = false
      }
      else {
        var app = this
        var url = api_url + 'ra_elite_usa_insurance_get_quote'
        app.$http.post(url, { ID: id }).then(res => {
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
            app.getAgentAttachments()
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
