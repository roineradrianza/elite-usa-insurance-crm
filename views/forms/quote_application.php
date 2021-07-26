<?php $current_user = RA_ELITE_USA_INSURANCE_USER::get_current_user(); ?>
<?php echo RA_ELITE_USA_INSURANCE_TEMPLATE::show_template('interface/parts/preloader') ?>
<!-- App.vue -->
<div id="ra-elite-usa-insurance-container" ref="stepper_h">
  <v-app style="display: none;">

    <!-- Sizes your content based upon application components -->
    <v-main>
      <!-- Provides the application the proper gutter -->
      <v-container class="mb-n2" id="app-container" fluid>
        <v-row>
          <v-col cols="4" md="2">
            <?php if ($current_user['roles'][0] == 'elite_usa_superuser'): ?>
            <?php echo RA_ELITE_USA_INSURANCE_TEMPLATE::show_template('interface/parts/sidebar', RA_ELITE_USA_INSURANCE_TEMPLATE::dashboard_superuser_tabs()); ?>
            <?php endif ?>
            <?php if ($current_user['roles'][0] == 'elite_usa_quote_manager' || $current_user['roles'][0] == 'administrator'): ?>
            <?php echo RA_ELITE_USA_INSURANCE_TEMPLATE::show_template('interface/parts/sidebar', RA_ELITE_USA_INSURANCE_TEMPLATE::dashboard_manager_tabs()); ?>
            <?php endif ?>
            <?php if ($current_user['roles'][0] == 'elite_usa_insurance_agent'): ?>
            <?php echo RA_ELITE_USA_INSURANCE_TEMPLATE::show_template('interface/parts/sidebar', RA_ELITE_USA_INSURANCE_TEMPLATE::dashboard_tabs()); ?>
            <?php endif ?>
          </v-col>
          <v-col cols="8" md="10">
            <v-stepper v-model="stepper" v-if="!already_sent">
              <v-stepper-header>
                <v-stepper-step ref="stepper_1" :complete="stepper > 1" step="1">
                  AFFORDABLE CARE ACT
                </v-stepper-step>

                <v-divider></v-divider>

                <v-stepper-step ref="stepper_2" :complete="stepper > 2" step="2">
                  PERSONAL INFORMATION
                </v-stepper-step>

                <v-divider></v-divider>
                <template v-if="form.content.affordable_care_act.coverage_type == 'FAMILY'">
                  <v-stepper-step ref="stepper_3" :complete="stepper > 3" step="3">
                    SPOUSE
                  </v-stepper-step>

                  <v-divider></v-divider>

                  <v-stepper-step ref="stepper_4" :complete="stepper > 4" step="4">
                    DEPENDENTS
                  </v-stepper-step>

                  <v-divider></v-divider>
                </template>

                <v-stepper-step ref="stepper_5" :step="form.content.affordable_care_act.coverage_type == 'FAMILY' ? 5 : 3">
                  PAYMENT
                </v-stepper-step>
              </v-stepper-header>

              <v-stepper-items>
                <v-stepper-content step="1">
                  <?php echo RA_ELITE_USA_INSURANCE_TEMPLATE::show_template('forms/quote_application/affordable_care_act'); ?>

                  <v-btn color="primary" @click="stepper = 2;scrollToTopStepper()" :disabled="!affordable_care_act_valid">
                    Continue
                  </v-btn>

                </v-stepper-content>

                <v-stepper-content step="2">
                  <?php echo RA_ELITE_USA_INSURANCE_TEMPLATE::show_template('forms/quote_application/personal_information'); ?>
                  <?php echo RA_ELITE_USA_INSURANCE_TEMPLATE::show_template('forms/quote_application/employment_information'); ?>
                  <template v-if="form.content.affordable_care_act.coverage_type == 'FAMILY'">
                    <v-btn color="primary" @click="stepper = 3;scrollToTopStepper()" :disabled="!personal_information_valid || !employment_information_valid">
                      Continue
                    </v-btn>
                  </template>
                  <template v-else>
                    <v-btn color="primary" @click="stepper = 3;scrollToTopStepper()" :disabled="!personal_information_valid || !employment_information_valid">
                      Continue
                    </v-btn>                    
                  </template>

                  <v-btn @click="stepper = 1;scrollToTopStepper()" text>
                    GO BACK
                  </v-btn>
                </v-stepper-content>
                <template v-if="form.content.affordable_care_act.coverage_type == 'FAMILY'">
                  <v-stepper-content step="3">
                    <?php echo RA_ELITE_USA_INSURANCE_TEMPLATE::show_template('forms/quote_application/espouse_information'); ?>
                    <?php echo RA_ELITE_USA_INSURANCE_TEMPLATE::show_template('forms/quote_application/espouse_employment_information'); ?>
                    <v-btn color="primary" @click="stepper = 4;scrollToTopStepper()" :disabled="!espouse_information_valid || !espouse_employment_information_valid">
                      Continue
                    </v-btn>

                   <v-btn @click="stepper = 2;scrollToTopStepper()" text>
                      GO BACK
                    </v-btn>
                  </v-stepper-content>

                  <v-stepper-content step="4">
                    <?php echo RA_ELITE_USA_INSURANCE_TEMPLATE::show_template('forms/quote_application/dependents'); ?>

                    <v-btn color="primary" @click="stepper = 5;scrollToTopStepper()" :disabled="!dependents_information_valid">
                      Continue
                    </v-btn>

                   <v-btn @click="stepper = 3;scrollToTopStepper()" text>
                      GO BACK
                    </v-btn>
                  </v-stepper-content>
                </template>

                <v-stepper-content :step="form.content.affordable_care_act.coverage_type == 'FAMILY' ? 5 : 3">
                  <?php echo RA_ELITE_USA_INSURANCE_TEMPLATE::show_template('forms/quote_application/payment_information'); ?>

                  <v-btn color="primary" @click="preview = true;scrollToPreview();" ref="application_preview" :disabled="!payment_information_valid">
                    PREVIEW
                  </v-btn>
                  <template v-if="form.content.affordable_care_act.coverage_type == 'FAMILY'">
                   <v-btn @click="stepper = 4;scrollToTopStepper()" text>
                      GO BACK
                    </v-btn>
                  </template>
                  <template v-else>
                    <v-btn @click="stepper = 2;scrollToTopStepper()" text>
                      GO BACK
                    </v-btn>
                  </template>
                </v-stepper-content>
              </v-stepper-items>
            </v-stepper>
            <v-row class="elite-usa-application-border mx-1" v-if="preview">
              <?php echo RA_ELITE_USA_INSURANCE_TEMPLATE::show_template('forms/quote_application/preview/affordable_care_act'); ?>
              <?php echo RA_ELITE_USA_INSURANCE_TEMPLATE::show_template('forms/quote_application/preview/personal_information'); ?>
              <?php echo RA_ELITE_USA_INSURANCE_TEMPLATE::show_template('forms/quote_application/preview/espouse_information'); ?>
              <?php echo RA_ELITE_USA_INSURANCE_TEMPLATE::show_template('forms/quote_application/preview/dependents'); ?>
              <?php echo RA_ELITE_USA_INSURANCE_TEMPLATE::show_template('forms/quote_application/preview/payment_information'); ?>
              <v-col class="d-flex justify-center" cols="12" v-if="!already_sent">
                <v-btn color="primary" @click="sendQuoteForm" :loading="quote_loading" dark>SUBMIT</v-btn>
                <v-btn color="info" @click="generateQuotePDF" :loading="pdf_loading" dark>Download Quote</v-btn>
              </v-col>
              <v-col class="d-flex justify-center" cols="12" v-if="already_sent">
                <v-btn-toggle>
                  <v-btn color="info" @click="generateQuotePDF" :loading="pdf_loading" dark>Download Quote</v-btn>
                  <v-btn color="primary" @click="resetQuoteForm()" dark>Sent Another Quote</v-btn>
                  <v-btn color="secondary" href="<?php echo site_url() . '/' . RA_ELITE_USA_INSURANCE_OPTIONS::get_option('routes')['quotes'] ?>" dark>Go to Dashboard</v-btn>
                </v-btn-toggle>
              </v-col>
              <v-col cols="12" md="8" offset-md="2">
                <?php echo RA_ELITE_USA_INSURANCE_TEMPLATE::show_template('components/alert'); ?>
              </v-col>
            </v-row>
          </v-col>
        </v-row>
      </v-container>
    </v-main>
  </v-app>
</div>