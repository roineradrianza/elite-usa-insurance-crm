<!-- App.vue -->
<div id="ra-elite-usa-insurance-container" style="margin-top: 50px;">
  <v-app>
    <!-- Sizes your content based upon application components -->
    <v-main>
      <!-- Provides the application the proper gutter -->
      <v-container class="mb-n2" id="app-container" fluid>
        <h2 class="text-h4 mb-n6">Settings</h2>
        <v-form ref="routes" lazy-validation>
          <v-row>
            <v-col class="mb-n10" cols="12">
              <h3 class="text-h5">Routes</h3>
            </v-col>
            <v-col cols="6">
              <v-text-field v-model="settings.routes.dashboard" :counter="60" label="Dashboard" persistent-hint :hint="domain + settings.routes.dashboard" required></v-text-field>                    
            </v-col>
            <v-col cols="6">
              <v-text-field v-model="settings.routes.quote_form" :counter="60" label="Quotes Form" persistent-hint :hint="domain + settings.routes.quote_form" required></v-text-field> 
            </v-col>
            <v-col cols="6">
              <v-text-field v-model="settings.routes.quotes" :counter="60" label="Quotes" persistent-hint :hint="domain + settings.routes.quotes" required></v-text-field> 
            </v-col>
            <v-col cols="6">
              <v-text-field v-model="settings.routes.user_settings" :counter="60" label="User Settings" persistent-hint :hint="domain + settings.routes.user_settings" required></v-text-field> 
            </v-col>
            <v-col cols="6">
              <v-text-field v-model="settings.routes.user_manager" :counter="60" label="User Manager(Access limited to SuperUsers)" persistent-hint :hint="domain + settings.routes.user_manager" required></v-text-field>
            </v-col>
            <v-col cols="6">
              <v-text-field v-model="settings.routes.inbox" :counter="60" label="Inbox" persistent-hint :hint="domain + settings.routes.inbox" required></v-text-field>
            </v-col>
          </v-row>
          <v-row>
            <v-col cols="12" class="mb-n10">
              <h4 class="text-h5">Reports routes</h4>
            </v-col>

            <v-col cols="6">
              <v-text-field v-model="settings.routes.reports_renewals_and_new_quotes" :counter="60" label="Renewals & New quotes" persistent-hint :hint="domain + settings.routes.reports_renewals_and_new_quotes" required></v-text-field>                    
            </v-col>
          </v-row>
          <?php \RA_ELITE_USA\Controller\Classes\Template::show_template('components/alert'); ?>
          <v-btn class="mb-10" color="primary" :loading="loading" @click="save_settings" elevation="6" block>
            <?php _e('Save', 'ra_elite_usa'); ?>
          </v-btn>
        </v-form>
      </v-container>
    </v-main>
  </v-app>
</div>
