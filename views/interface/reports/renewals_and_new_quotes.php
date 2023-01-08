<?php $current_user = \RA_ELITE_USA\Controller\Classes\User::get_session(); ?>
<?php echo \RA_ELITE_USA\Controller\Classes\Template::show_template('interface/parts/preloader') ?>
<!-- App.vue -->
<div id="ra-elite-usa-insurance-container">
    <v-app style="display: none;">

        <!-- Sizes your content based upon application components -->
        <v-main>
            <!-- Provides the application the proper gutter -->
            <v-container class="mb-n2" id="app-container" fluid>
                <v-row>
                    <v-col cols="2">
                        <?php \RA_ELITE_USA\Controller\Classes\Template::render_sidebar_view($current_user) ?>
                    </v-col>
                    <v-col cols="10">
                        <v-row>
                            <v-col cols="6">
                                <v-row>
                                    <?php if(\RA_ELITE_USA\Controller\Classes\User::has_manager_access()): ?>
                                    <v-col cols="12">
                                        <v-select v-model="agent" :items="agents" menu-props="auto" label="Choose an agent"
                                            prepend-icon="mdi-account-circle"
                                            :item-text="item => item.first_name + ' ' + item.last_name" single-line clearable
                                            return-object
                                            hint="If you want to show reports from an specific agent, you can select it here"
                                            :loading="agents_loading || quotes_loading"
                                            :disabled="agents_loading || quotes_loading"
                                            persistent-hint>
                                            <template #prepend-item>
                                                <v-list-item>
                                                    <v-list-item-content>
                                                        <v-text-field v-model="search_agent" placeholder="Search agent"
                                                            @input="searchAgents" append-icon="mdi-account-search"></v-text-field>
                                                    </v-list-item-content>
                                                </v-list-item>
                                                <v-divider class="mt-2"></v-divider>
                                            </template>
                                        </v-select>
                                    </v-col>
                                    <?php endif ?>
                                    <v-col cols="12">
                                        <v-select v-model="status" :items="status_items" label="Choose an status"
                                            prepend-icon="mdi-file-document" single-line hint="Select an status"
                                            :disabled="quotes_loading"
                                            persistent-hint>
                                        </v-select>
                                    </v-col>
                                    <v-col cols="12">
                                        <v-select v-model="year" :items="years" label="Choose an year"
                                            prepend-icon="mdi-calendar" single-line hint="Select year"
                                            :loading="quotes_loading" :disabled="quotes_loading" persistent-hint>
                                        </v-select>
                                    </v-col>
                                </v-row>
                            </v-col>
                            
                            <v-col cols="6">
                                <v-sheet :rounded="true" class="mx-auto px-6 py-6" elevation="2">
                                    <h2 class="text-h5">Renewals & New Quotes Report</h2>
                                    <v-row>
                                        <v-col cols="12">
                                            <v-sheet :rounded="true" class="mx-auto px-3 py-3"
                                                elevation="2" v-show="!quotes_loading && !chart.loading">
                                                    <line-chart ref="monthly_chart" :chartData="chart.monthly_data">
                                                    </line-chart>
                                            </v-sheet>
                                            <v-sheet :rounded="true" class="mx-auto px-3 py-3" min-width="100%"
                                                elevation="2" v-show="quotes_loading && chart.loading">
                                                    <div id="preload-container" style=" 
                                                            display: flex;
                                                        justify-content: center;
                                                        min-height: 20vh;">
                                                        <img src="<?php echo RA_ELITE_USA_INSURANCE_URL ?>/assets/animations/double-ring.svg" alt="preloader">
                                                    </div>
                                            </v-sheet>
                                        </v-col>
                                    </v-row>
                                </v-sheet>
                            </v-col>
                        </v-row>
                    </v-col>
                </v-row>
            </v-container>
        </v-main>
    </v-app>
</div>