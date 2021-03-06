<?php $current_user = \RA_ELITE_USA\Controller\Classes\User::get_current_user(); ?>
<?php echo \RA_ELITE_USA\Controller\Classes\Template::show_template('interface/parts/preloader') ?>
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
                        <?php echo \RA_ELITE_USA\Controller\Classes\Template::show_template('interface/parts/sidebar', \RA_ELITE_USA\Controller\Classes\Template::dashboard_superuser_tabs()); ?>
                        <?php endif ?>
                        <?php if ($current_user['roles'][0] == 'elite_usa_quote_manager' || $current_user['roles'][0] == 'administrator'): ?>
                        <?php echo \RA_ELITE_USA\Controller\Classes\Template::show_template('interface/parts/sidebar', \RA_ELITE_USA\Controller\Classes\Template::dashboard_manager_tabs()); ?>
                        <?php endif ?>
                        <?php if ($current_user['roles'][0] == 'elite_usa_insurance_agent'): ?>
                        <?php echo \RA_ELITE_USA\Controller\Classes\Template::show_template('interface/parts/sidebar', \RA_ELITE_USA\Controller\Classes\Template::dashboard_tabs()); ?>
                        <?php endif ?>
                    </v-col>
                    <v-col cols="8" md="10">
                        <template v-if="!renew_loading && !not_able_to_renew && !not_quote_found">
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
                                        <v-stepper-step ref="stepper_3" :complete="stepper > 3"
                                            :step="form.content.personal_information.marital_status == 'MARRIED' ? 3 : 100"
                                            v-if="form.content.personal_information.marital_status == 'MARRIED'">
                                            SPOUSE
                                        </v-stepper-step>

                                        <v-divider v-if="form.content.personal_information.marital_status == 'MARRIED'">
                                        </v-divider>

                                        <v-stepper-step ref="stepper_4"
                                            :complete="form.content.personal_information.marital_status == 'MARRIED' ? stepper > 4 : stepper > 3"
                                            :step="form.content.personal_information.marital_status == 'MARRIED' ? 4 : 3">
                                            DEPENDENTS
                                        </v-stepper-step>

                                        <v-divider></v-divider>
                                        <v-stepper-step ref="stepper_5"
                                            :complete="form.content.personal_information.marital_status == 'MARRIED' ? stepper > 5 : stepper > 4"
                                            :step="form.content.personal_information.marital_status == 'MARRIED' ? 5 : 4">
                                            PAYMENT
                                        </v-stepper-step>

                                        <v-divider></v-divider>
                                        <v-stepper-step ref="stepper_6"
                                            :step="form.content.personal_information.marital_status == 'MARRIED' ? 6 : 5">
                                            FILES
                                        </v-stepper-step>
                                    </template>
                                    <template v-else>
                                        <v-stepper-step ref="stepper_5" :complete="stepper > 3" step="3">
                                            PAYMENT
                                        </v-stepper-step>
                                        <v-divider></v-divider>
                                        <v-stepper-step ref="stepper_6" step="4">
                                            FILES
                                        </v-stepper-step>
                                    </template>
                                </v-stepper-header>

                                <v-stepper-items>
                                    <v-stepper-content id="vs_affodable_care_act" step="1">
                                        <?php echo \RA_ELITE_USA\Controller\Classes\Template::show_template('forms/quote_application/affordable_care_act'); ?>

                                        <v-btn color="primary" @click="validateFields('affordable_care_act_form')"
                                            :disabled="!affordable_care_act_valid">
                                            Continue
                                        </v-btn>

                                    </v-stepper-content>

                                    <v-stepper-content id="vs_personal_information" step="2">
                                        <?php echo \RA_ELITE_USA\Controller\Classes\Template::show_template('forms/quote_application/personal_information'); ?>
                                        <?php echo \RA_ELITE_USA\Controller\Classes\Template::show_template('forms/quote_application/employment_information'); ?>
                                        <v-btn color="primary" @click="validateFields('personal_information_form')"
                                            :disabled="!personal_information_valid || !employment_information_valid">
                                            Continue
                                        </v-btn>

                                        <v-btn @click="stepper = stepper - 1;scrollToTopStepper();updateFormDate();"
                                            text>
                                            GO BACK
                                        </v-btn>
                                    </v-stepper-content>
                                    <template v-if="form.content.affordable_care_act.coverage_type == 'FAMILY'">
                                        <v-stepper-content id="vs_espouse_information"
                                            :step="form.content.personal_information.marital_status == 'MARRIED' ? 3 : 100">
                                            <?php echo \RA_ELITE_USA\Controller\Classes\Template::show_template('forms/quote_application/espouse_information'); ?>
                                            <?php echo \RA_ELITE_USA\Controller\Classes\Template::show_template('forms/quote_application/espouse_employment_information'); ?>
                                            <v-btn color="primary" @click="validateFields('espouse_information_form')"
                                                :disabled="!espouse_information_valid || !espouse_employment_information_valid">
                                                Continue
                                            </v-btn>

                                            <v-btn @click="stepper = stepper - 1;scrollToTopStepper()" text>
                                                GO BACK
                                            </v-btn>
                                        </v-stepper-content>

                                        <v-stepper-content id="vs_dependents"
                                            :step="form.content.personal_information.marital_status == 'MARRIED' ? 4 : 3">
                                            <?php echo \RA_ELITE_USA\Controller\Classes\Template::show_template('forms/quote_application/dependents'); ?>

                                            <v-btn color="primary" @click="validateFields('dependent_information_form')"
                                                :disabled="!dependents_information_valid">
                                                Continue
                                            </v-btn>

                                            <v-btn @click="stepper = stepper - 1;scrollToTopStepper()" text>
                                                GO BACK
                                            </v-btn>
                                        </v-stepper-content>
                                        <v-stepper-content id="vs_payments"
                                            :step="form.content.personal_information.marital_status == 'MARRIED' ? 5 : 4">
                                            <?php echo \RA_ELITE_USA\Controller\Classes\Template::show_template('forms/quote_application/payment_information'); ?>
                                            <v-btn color="primary" @click="validateFields('payment_information_form')"
                                                :disabled="!payment_information_valid">
                                                CONTINUE
                                            </v-btn>
                                            <v-btn @click="stepper = stepper - 1;scrollToTopStepper()" text>
                                                GO BACK
                                            </v-btn>
                                        </v-stepper-content>
                                        <v-stepper-content id="vs_files"
                                            :step="form.content.personal_information.marital_status == 'MARRIED' ? 6 : 5">
                                            <?php echo \RA_ELITE_USA\Controller\Classes\Template::show_template('forms/quote_application/files'); ?>

                                            <v-btn color="primary" @click="preview = true;updateFormDate();"
                                                ref="application_preview" :disabled="!payment_information_valid">
                                                PREVIEW
                                            </v-btn>
                                            <v-btn @click="stepper = stepper - 1;scrollToTopStepper()" text>
                                                GO BACK
                                            </v-btn>
                                        </v-stepper-content>
                                    </template>
                                    <template v-else>
                                        <v-stepper-content id="vs_payments" step="3">
                                            <?php echo \RA_ELITE_USA\Controller\Classes\Template::show_template('forms/quote_application/payment_information'); ?>
                                            <template>
                                                <v-btn color="primary"
                                                    @click="validateFields('payment_information_form')"
                                                    :disabled="!payment_information_valid">
                                                    CONTINUE
                                                </v-btn>
                                            </template>
                                            <template>
                                                <v-btn @click="stepper = stepper - 1;scrollToTopStepper()" text>
                                                    GO BACK
                                                </v-btn>
                                            </template>
                                        </v-stepper-content>
                                        <v-stepper-content id="vs_files" :step="4">
                                            <?php echo \RA_ELITE_USA\Controller\Classes\Template::show_template('forms/quote_application/files'); ?>

                                            <v-btn color="primary" @click="preview = true;updateFormDate();"
                                                ref="application_preview" :disabled="!payment_information_valid">
                                                PREVIEW
                                            </v-btn>
                                            <template>
                                                <v-btn @click="stepper = stepper - 1;scrollToTopStepper()" text>
                                                    GO BACK
                                                </v-btn>
                                            </template>
                                        </v-stepper-content>
                                    </template>

                                </v-stepper-items>
                            </v-stepper>
                            <v-row class="elite-usa-application-border mx-1" v-if="preview">
                                <?php echo \RA_ELITE_USA\Controller\Classes\Template::show_template('forms/quote_application/preview/affordable_care_act'); ?>
                                <?php echo \RA_ELITE_USA\Controller\Classes\Template::show_template('forms/quote_application/preview/personal_information'); ?>
                                <?php echo \RA_ELITE_USA\Controller\Classes\Template::show_template('forms/quote_application/preview/espouse_information'); ?>
                                <?php echo \RA_ELITE_USA\Controller\Classes\Template::show_template('forms/quote_application/preview/dependents'); ?>
                                <?php echo \RA_ELITE_USA\Controller\Classes\Template::show_template('forms/quote_application/preview/payment_information'); ?>
                                <v-col class="d-flex justify-center" cols="12" v-if="!already_sent">
                                    <v-btn color="primary" @click="sendQuoteForm" :loading="quote_loading" dark>SUBMIT
                                    </v-btn>
                                    <v-btn color="info" @click="generateQuotePDF" :loading="pdf_loading" dark>Download
                                        Quote
                                    </v-btn>

                                    <v-btn color="secondary" @click="stepper = stepper - 1;scrollToTopStepper()"
                                        v-if="stepper > 1" dark>Go
                                        back</v-btn>
                                </v-col>
                                <v-col class="d-flex justify-center" cols="12" v-if="already_sent">
                                    <v-btn-toggle>
                                        <v-btn color="info" @click="generateQuotePDF" :loading="pdf_loading" dark>
                                            Download
                                            Quote</v-btn>
                                        <v-btn color="primary" @click="resetQuoteForm()" dark>Sent Another Quote</v-btn>
                                        <v-btn color="secondary" @click="stepper = stepper - 1;scrollToTopStepper()"
                                            v-if="stepper > 1" dark>Go back</v-btn>
                                    </v-btn-toggle>
                                </v-col>
                                <v-col cols="12" md="8" offset-md="2">
                                    <?php echo \RA_ELITE_USA\Controller\Classes\Template::show_template('components/alert'); ?>
                                </v-col>
                            </v-row>
                        </template>

                        <template v-else-if="renew_loading">
                            <v-row class="d-flex align-center">
                                <v-col class="d-flex justify-center" cols="12">
                                    <img src=" <?php echo RA_ELITE_USA_INSURANCE_URL ?>/assets/animations/double-ring.svg"
                                        alt="preloader">
                                </v-col>
                                <v-col cols="12">
                                    <h4 class="text-h5 text-center">
                                        Loading the quote requested to be renovated...
                                    </h4>
                                </v-col>
                            </v-row>
                        </template>

                        <template v-else-if="not_able_to_renew">
                            <?php echo \RA_ELITE_USA\Controller\Classes\Template::show_template('forms/quote_application/unauthorized'); ?>
                        </template>

                        <template v-else-if="not_quote_found">
                            <?php echo \RA_ELITE_USA\Controller\Classes\Template::show_template('forms/quote_application/not_quote_found'); ?>
                        </template>

                    </v-col>
                </v-row>
            </v-container>
        </v-main>
    </v-app>
</div>