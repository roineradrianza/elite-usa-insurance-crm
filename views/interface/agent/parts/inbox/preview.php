  <?php $current_user = RA_ELITE_USA_INSURANCE_USER::get_current_user(); ?>
  <v-dialog v-model="view_dialog" max-width="95%" style="z-index: 100000;" @click:outside="closeView">
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
                  <v-row ref="preview_quote"
                      v-if="inbox.editedIndex != -1 || inbox.editedItem.post_type == 'quote_form'">
                      <v-col class="mb-4 mt-n10" cols="12" md="6" lg="4" offset-md="3" offset-lg="4"
                          v-if="inbox.editedItem.renewals.length > 0">
                          <v-alert class="elevation-10" color="primary" prominent type="info">
                              <v-row align="center">
                                  <v-col class="grow">
                                      This quote has been renewed. You can take a look by clicking the button
                                  </v-col>
                                  <v-col class="shrink">
                                      <v-btn class="primary--text" color="white"
                                          @click="filterQuotes(inbox.editedItem.renewals[0].ID)">
                                          Take me to
                                      </v-btn>
                                  </v-col>
                              </v-row>
                          </v-alert>
                      </v-col>
                      <v-col cols="12">

                      </v-col>
                      <v-col class="mt-n10" cols="12" md="2">
                          <h5 class="text-h5">Quote ID: {{ inbox.editedItem.ID }}</h5>
                      </v-col>
                      <v-col class="d-flex justify-end mt-n10" cols="12">
                          <v-btn class="mr-3 py-4" color="primary"
                              :href="'<?php echo site_url() . "/" . RA_ELITE_USA_INSURANCE_TEMPLATE::get_tab_url('New Quote') ?>/?quote_id='+ inbox.editedItem.ID +'&action=renew'"
                              v-if="inbox.editedItem.renewals.length <= 0" outlined small>Renew Quote</v-btn>
                          <v-btn class="mr-3 py-4" color="info"
                              @click="action_history.dialog = true;getActionsHistory(inbox.editedItem)" small>View
                              Actions History</v-btn>
                          <v-btn class="mr-3 py-4" color="primary" @click="generateQuotePDF" :loading="pdf_loading"
                              small>Download Quote</v-btn>
                          <?php if ($current_user['roles'][0] == 'administrator' || $current_user['roles'][0] == 'elite_usa_quote_manager' || $current_user['roles'][0] == 'elite_usa_superuser'): ?>
                          <v-btn class="mr-3 py-4" color="success" @click="edit_dialog = true" small>Edit <v-icon small>
                                  mdi-pencil</v-icon>
                          </v-btn>
                          <?php endif ?>
                          <v-chip :color="checkStatusColor(inbox.editedItem.status, inbox.editedItem.post_type)" dark>
                              {{ returnStatusType(inbox.editedItem.status, inbox.editedItem.post_type) }}</v-chip>
                      </v-col>
                      <?php echo RA_ELITE_USA_INSURANCE_TEMPLATE::show_template('interface/dialogs/quote_action_history') ?>
                      <?php echo RA_ELITE_USA_INSURANCE_TEMPLATE::show_template('interface/manager/parts/inbox/manager_attachments') ?>
                      <?php echo RA_ELITE_USA_INSURANCE_TEMPLATE::show_template('interface/manager/parts/inbox/information_requests') ?>
                      <?php echo RA_ELITE_USA_INSURANCE_TEMPLATE::show_template('interface/manager/parts/inbox/modification_requests') ?>
                      <?php echo RA_ELITE_USA_INSURANCE_TEMPLATE::show_template('interface/manager/parts/inbox/request-edit') ?>
                      <?php echo RA_ELITE_USA_INSURANCE_TEMPLATE::show_template('interface/manager/parts/inbox/modification-form') ?>
                      <?php echo RA_ELITE_USA_INSURANCE_TEMPLATE::show_template('interface/manager/parts/inbox/attachments') ?>
                      <?php echo RA_ELITE_USA_INSURANCE_TEMPLATE::show_template('interface/manager/parts/inbox/preview/files') ?>
                      <?php echo RA_ELITE_USA_INSURANCE_TEMPLATE::show_template('interface/manager/parts/inbox/preview/affordable_care_act') ?>
                      <?php echo RA_ELITE_USA_INSURANCE_TEMPLATE::show_template('interface/manager/parts/inbox/preview/personal_information') ?>
                      <?php echo RA_ELITE_USA_INSURANCE_TEMPLATE::show_template('interface/manager/parts/inbox/preview/espouse_information') ?>
                      <?php echo RA_ELITE_USA_INSURANCE_TEMPLATE::show_template('interface/manager/parts/inbox/preview/dependents') ?>
                      <?php echo RA_ELITE_USA_INSURANCE_TEMPLATE::show_template('interface/manager/parts/inbox/preview/payment_information') ?>
                  </v-row>
              </v-container>
          </v-card-text>
      </v-card>
  </v-dialog>