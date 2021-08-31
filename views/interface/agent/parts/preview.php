  <?php $current_user = RA_ELITE_USA_INSURANCE_USER::get_current_user(); ?>
  <v-dialog v-model="view_dialog" max-width="95%" style="z-index: 100000;">
    <v-card>
      <v-toolbar color="primary" elevation="0">
        <v-toolbar-title class="white--text">Quote Information</v-toolbar-title>
        <v-spacer></v-spacer>
        <v-toolbar-items>
        <v-btn icon dark @click="closeView">
          <v-icon color="white">mdi-close</v-icon>
        </v-btn>
        </v-toolbar-items>
      </v-toolbar>

      <v-divider></v-divider>

      <v-card-text>
        <v-container fluid>
          <v-row ref="preview_quote" v-if="quotes.editedIndex != -1">
            <v-col class="mt-n10" cols="12" md="2">
              <h5 class="text-h5">Quote ID: <b>{{ quotes.editedItem.ID }}</b></h5>
            </v-col>
            <v-col class="d-flex justify-end mt-n10" cols="10">
              <v-btn class="mr-3 py-4" color="primary" @click="generateQuotePDF" :loading="pdf_loading" small>Download Quote</v-btn>
              <?php if ($current_user['roles'][0] == 'administrator' || $current_user['roles'][0] == 'elite_usa_quote_manager'): ?>
                <v-btn class="mr-3 py-4" color="success" @click="edit_dialog = true" small>Edit <v-icon small>mdi-pencil</v-icon></v-btn>
              <?php endif ?>
              <v-chip :color="checkStatusColor(quotes.editedItem.status)" dark>{{ quotes.editedItem.status }}</v-chip>
            </v-col>
            <?php echo RA_ELITE_USA_INSURANCE_TEMPLATE::show_template('interface/manager/parts/manager_attachments') ?>
            <?php echo RA_ELITE_USA_INSURANCE_TEMPLATE::show_template('interface/manager/parts/information_requests') ?>
            <?php echo RA_ELITE_USA_INSURANCE_TEMPLATE::show_template('interface/manager/parts/modification_requests') ?>
            <?php echo RA_ELITE_USA_INSURANCE_TEMPLATE::show_template('interface/agent/parts/request-edit') ?>
            <?php echo RA_ELITE_USA_INSURANCE_TEMPLATE::show_template('interface/agent/parts/modification-form') ?>
            <?php echo RA_ELITE_USA_INSURANCE_TEMPLATE::show_template('interface/manager/parts/attachments') ?>
            <?php echo RA_ELITE_USA_INSURANCE_TEMPLATE::show_template('interface/agent/parts/preview/files') ?>
            <?php echo RA_ELITE_USA_INSURANCE_TEMPLATE::show_template('interface/agent/parts/preview/affordable_care_act') ?>
            <?php echo RA_ELITE_USA_INSURANCE_TEMPLATE::show_template('interface/agent/parts/preview/personal_information') ?>
            <?php echo RA_ELITE_USA_INSURANCE_TEMPLATE::show_template('interface/agent/parts/preview/espouse_information') ?>
            <?php echo RA_ELITE_USA_INSURANCE_TEMPLATE::show_template('interface/agent/parts/preview/dependents') ?>
            <?php echo RA_ELITE_USA_INSURANCE_TEMPLATE::show_template('interface/agent/parts/preview/payment_information') ?>
          </v-row>
        </v-container>
      </v-card-text>
    </v-card>
  </v-dialog>