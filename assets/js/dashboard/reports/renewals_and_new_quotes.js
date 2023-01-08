/*VUE PLUGINS*/
/*VUETIFY OPTIONS AND SET UP*/

const vuetify = new Vuetify(vuetify_opts);
const api_url = ra_elite_usa_insurance_ajaxurl;

/*CHARTJS COMPONENTS*/
Vue.component("line-chart", {
  extends: VueChartJs.Bar,
  mixins: VueChartJs.mixins.reactiveProp,
  props: ["chartdata", "options"],
  mounted() {
    this.renderChart(this.chartdata, {
      responsive: true,
      maintainAspectRatio: true,
    });
  },
});

/*VUE INSTANCE*/
let vm = new Vue({
  vuetify,
  el: "#ra-elite-usa-insurance-container",
  data: {
    selectedItem: 3,
    loading: false,
    logout_loading: false,
    agents_loading: false,
    quotes_loading: false,
    notifications_loading: false,
    search_agent: "",
    notifications: [],
    year: parseInt(moment().format("YYYY")),
    years: [2023, 2022, 2021], //TODO: Load years available
    agent: {},
    agents: [],
    agents_source: [],
    quotes: [],
    status: "Approved",
    status_items: ["Processing", "In tray", "Approved", "Archived"],
    chart: {
      loading: true,
      monthly_data: {
        current_year: "",
        months: [
          "01",
          "02",
          "03",
          "04",
          "05",
          "06",
          "07",
          "08",
          "09",
          "10",
          "11",
          "12",
        ],
        labels: [
          "January",
          "February",
          "March",
          "April",
          "May",
          "June",
          "July",
          "August",
          "September",
          "October",
          "November",
          "December",
        ],
        datasets: [
          {
            label: "New",
            backgroundColor: "#000",
            data: [],
          },
          {
            label: "Renewals",
            backgroundColor: vuetify.preset.theme.themes.light.secondary,
            data: [],
          },
          {
            label: "Total",
            backgroundColor: vuetify.preset.theme.themes.light.primary,
            data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
          },
        ],
      },
    },
  },

  computed: {},

  watch: {
    agent(val) {
      this.loadStatistics();
    },
    year(val) {
      this.chart.monthly_data.current_year = val;
      this.loadStatistics();
    },
    status(val) {
      this.loadStatistics();
    },
  },

  created() {
    initNotifications(this);
    setInterval(initNotifications, 30000, this);
  },
  mounted() {
    this.initialize();
  },

  methods: {
    initialize() {
      this.chart.monthly_data.current_year = this.year;
      this.loadYears();
      this.loadAgents().then(() => this.loadQuotes());
    },
    logout() {
      let app = this;
      let url = api_url + "ra_elite_usa_insurance_logout";
      app.logout_loading = true;
      app.$http.get(url).then(
        (res) => {
          app.logout_loading = false;
          window.location = res.body.redirect_url;
        },
        (err) => {
          app.logout_loading = false;
        }
      );
    },
    async loadAgents() {
      let app = this;
      let url = api_url + "ra_elite_usa_insurance_get_users";
      let data = {
        args: {
          role__in: ["elite_usa_insurance_agent"],
        },
      };

      app.agents_loading = true;
      app.$http.post(url, data).then(
        (res) => {
          app.agents = app.agents_source = res.body;
          app.agents_loading = false;
        },
        (err) => {
          app.agents_loading = false;
        }
      );
    },
    loadQuotes() {
      let app = this;
      let url = api_url + "ra_elite_usa_insurance_get_quotes";

      app.quotes_loading = true;
      app.$http.get(url).then(
        (res) => {
          if (res.body.length > 0) {
            var items = [];
            var item = {};
            res.body.forEach((quote) => {
              var item = quote;
              item.published_at = moment(item.affordable_care_act.date).format(
                "DD/MM/YYYY, h:mm:ss a"
              );
              item.applicant =
                item.personal_information.first_name +
                " " +
                item.personal_information.middle_name +
                " " +
                item.personal_information.last_name;
              item.type = item.post_parent <= 0 ? "First-Time" : "Renewal";
              item.personal_information.same_address =
                item.personal_information.hasOwnProperty("same_address")
                  ? item.personal_information.same_address
                  : 1;
              if (item.affordable_care_act.hasOwnProperty("renewal_date")) {
                item.year = moment(
                  item.affordable_care_act.renewal_date
                ).format("YYYY");
              } else {
                item.year = moment(
                  item.affordable_care_act.effectiveness_date
                ).isSameOrAfter(moment(item.affordable_care_act.date))
                  ? moment(item.affordable_care_act.effectiveness_date).format(
                      "YYYY"
                    )
                  : moment(item.affordable_care_act.date).format("YYYY");
              }

              items.push(item);
            });
            app.quotes = items;
          }
          app.quotes_loading = false;
          app.loadStatistics();
        },
        (err) => {
          app.quotes_loading = false;
        }
      );
    },
    loadYears() {
      let app = this;
    },
    loadStatistics() {
      let app = this;
      let agent = Object.assign({}, app.agent);
      let year = app.chart.monthly_data.current_year;
      let status = app.status;
      filtered_items = app.quotes;

      app.chart.loading = true;

      if (
        agent !== undefined &&
        agent !== "" &&
        Object.keys(agent).length > 0
      ) {
        filtered_items = filtered_items.filter(
          (item) => item.post_author == agent.id
        );
      }

      if (year == null || year == "") {
        app.chart.loading = false;
        return false;
      }

      filtered_items = filtered_items.filter((item) =>
        item.published_at.includes(year)
      );

      if (status != null || status != "") {
        filtered_items = filtered_items.filter((item) => item.status == status);
      }

      app.chart.monthly_data.months.forEach((month_number, i) => {
        var filtered_month = filtered_items.filter((item) =>
          item.published_at.includes(`${month_number}/${year}`)
        );

        var filtered_month_news = filtered_month.filter(
          (item) => item.type == "First-Time"
        );
        var filtered_month_renewals = filtered_month.filter(
          (item) => item.type == "Renewal"
        );

        // Total quotes news
        app.chart.monthly_data.datasets[0].data[i] = filtered_month_news.length;
        // Total quotes renewals
        app.chart.monthly_data.datasets[1].data[i] =
          filtered_month_renewals.length;
        // Total quotes
        app.chart.monthly_data.datasets[2].data[i] =
          filtered_month_news.length + filtered_month_renewals.length;

        app.$refs.monthly_chart !== undefined
          ? app.$refs.monthly_chart.renderChart(app.chart.monthly_data)
          : "";

        app.chart.loading = false;
      });
    },
    searchAgents(e) {
      let app = this;
      if (!app.search_agent) {
        app.agents = app.agents_source;
      }

      app.agents = app.agents_source.filter((agent) => {
        var full_name = `${agent.first_name} ${agent.last_name}`;
        return (
          full_name.toLowerCase().indexOf(app.search_agent.toLowerCase()) > -1
        );
      });
    },
  },
});
