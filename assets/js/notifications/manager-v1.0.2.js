var set_n_loading = false
var set_n_function = false
function initNotifications (app) {
  if (!set_n_function) {
    app.markNotificationAsRead = markNotificationAsRead
  }
  app.notifications_loading = set_n_loading ? true : false
  let url = api_url + 'ra_elite_usa_insurance_get_admin_notifications'
  app.$http.get(url).then( res => {
    if (res.body.length > 0) {
      let items = []
      res.body.forEach( (inbox) => {
        let item = inbox
        item.quote_id = item.post_type == 'quote_form' ? item.ID : item.post_parent
        item.published_at = moment(item.post_date).format('DD/MM/YYYY, h:mm:ss a')
        item.since = usesGMT ? moment.utc(moment(item.post_modified).format('YYYY-MM-DD, h:mm:ss')).local().fromNow() : moment(item.post_modified).fromNow()
        item.relative_url = domain + '/' + routes.quotes + '?quotation_id='+ item.quote_id + '&notification_id=' + item.ID + '&markNotification=read'
        var url_params = new URLSearchParams(window.location.search)

        if (moment(item.post_modified).isSameOrBefore(item['date_user_' + udata['id'] + '_n_seen'])) {
          return;
        }
        else if (item.ID == parseInt(url_params.get('notification_id')) && url_params.get('markNotification') == 'read') {
          var url = api_url + 'ra_elite_usa_insurance_mark_read_notification'
          var current_date = moment().format('YYYY-MM-DD, h:mm:ss')
          app.$http.post(url, {ID: item.ID, date: current_date})
          return;
        }
        else if (item.post_type == 'quote_doc_r' && parseInt(item.status) == 0) {
          return;
        }
        else if (item.post_type == 'quote_data_r' && parseInt(item.status) == 0 || item.post_type == 'quote_data_r' && parseInt(item.status) == 2) {
          return;
        }
        items.push(item)
      })
      app.notifications = items
      app.notifications_loading = false
    }
  }, err => {
    app.notifications_loading = false
  })
  set_n_loading = true
  set_n_function = true
}

function markNotificationAsRead (id, index) {
  var app = this
  var url = api_url + 'ra_elite_usa_insurance_mark_read_notification'
  var current_date = moment().format('YYYY-MM-DD, h:mm:ss')
  app.$http.post(url, {ID: id, date: current_date}).then( res => {
    if (res.body.status == 'success') {
      app.notifications.splice(index, 1)
    }
  }, err => {

  })
}
