<?php $current_user = RA_ELITE_USA_INSURANCE_USER::get_current_user(); ?>
<?php echo RA_ELITE_USA_INSURANCE_TEMPLATE::show_template('interface/parts/preloader') ?>
<!-- App.vue -->
<div id="ra-elite-usa-insurance-container">
  <v-app class="ml-0" style="display: none;">

    <!-- Sizes your content based upon application components -->
    <v-main>
      <!-- Provides the application the proper gutter -->
      <v-container class="mb-n2" id="app-container" fluid>
        <v-row>
          <v-col class="px-0" cols="12">
            <v-sheet color="primary">
              <v-row>
                <v-col cols="12" md="8" offset-md="2">
                  <h2 class="text-h4 white--text text-center">
                    AGENT INFORMATION SHEET & APPOINTMENT APPLICATION
                  </h2>
                </v-col>
              </v-row>
            </v-sheet>
          </v-col>
          <v-col cols="12" md="10" lg="8" offset-md="1" offset-lg="2" style="max-height: 85vh; overflow-y: scroll;">
            <v-form ref="agreement_form" v-model="agreement_form_valid" lazy-validation>
              <v-row ref="agreement_container">
                <?php echo RA_ELITE_USA_INSURANCE_TEMPLATE::show_template('components/snackbar') ?>
                <?php echo RA_ELITE_USA_INSURANCE_TEMPLATE::show_template('interface/parts/agreement_form/general'); ?>
                <?php echo RA_ELITE_USA_INSURANCE_TEMPLATE::show_template('interface/parts/agreement_form/introduction'); ?>
                <?php echo RA_ELITE_USA_INSURANCE_TEMPLATE::show_template('interface/parts/agreement_form/ethics_code'); ?>
                <v-col cols="8" offset-md="2" v-if="declined">
                  <v-alert border="bottom" colored-border type="warning" elevation="2">
                    THANK YOU
                    <br>
                    Please contact a representative of EliteUSAInsurance
                  </v-alert>
                </v-col>
                <v-col class="d-flex justify-center" cols="12">
                  <v-btn color="primary" @click="submitContract" :loading="loading" :disabled="!agreement_form_valid || declined">Accept</v-btn>
                  <v-btn class="ml-4" color="secondary" @click="declineContract" :loading="loading" :disabled="!agreement_form_valid">Decline</v-btn>
                </v-col>
              </v-row>
            </v-form>
          </v-col>
        </v-row>
      </v-container>
    </v-main>
  </v-app>
</div>
