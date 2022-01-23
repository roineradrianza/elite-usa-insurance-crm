<?php echo RA_ELITE_USA_INSURANCE_TEMPLATE::show_template('interface/parts/preloader') ?>
<!-- App.vue -->
<div id="ra-elite-usa-insurance-container">
    <v-app style="display: none;">

        <!-- Sizes your content based upon application components -->
        <v-main>
            <!-- Provides the application the proper gutter -->
            <v-container class="mb-n2" id="app-container" fluid>
                <v-row>
                    <v-col cols="2">
                        <?php echo RA_ELITE_USA_INSURANCE_TEMPLATE::show_template('interface/parts/sidebar', RA_ELITE_USA_INSURANCE_TEMPLATE::dashboard_superuser_tabs()); ?>
                    </v-col>
                    <v-col cols="10">
                        <?php echo RA_ELITE_USA_INSURANCE_TEMPLATE::show_template('interface/agent/parts/preview') ?>
                        <?php echo RA_ELITE_USA_INSURANCE_TEMPLATE::show_template('interface/manager/parts/edit') ?>
                        <?php echo RA_ELITE_USA_INSURANCE_TEMPLATE::show_template('interface/manager/parts/delete') ?>
                        <?php echo RA_ELITE_USA_INSURANCE_TEMPLATE::show_template('components/snackbar') ?>
                        <?php echo RA_ELITE_USA_INSURANCE_TEMPLATE::show_template('interface/parts/status_filter') ?>

                        <v-data-table :headers="quotes.header" :items="quotes.items" sort-by="['status','published_at']"
                            class="elevation-1" :loading="table_loading" :search="quotes.search" multi-sort>
                            <template #top>
                                <v-row class="d-flex align-center px-10">
                                    <v-col cols="10">
                                        <v-text-field v-model="quotes.search" append-icon="mdi-magnify" label="Search"
                                            placeholder="search by id, applicant, agent or status..."
                                            hint="search by id, applicant, agent or status..." single-line>
                                        </v-text-field>
                                    </v-col>
                                    <v-col cols="1">
                                        <v-btn class="ml-2" color="primary" @click="initialize" text block>
                                            <v-icon>mdi-reload</v-icon>
                                        </v-btn>
                                    </v-col>
                                    <v-col cols="1">
                                        <download-excel :data="quotes.items" :fields="quotes.excel.header"
                                            worksheet="Quotes" name="Quotes.xls">
                                            <v-btn class="white--text" color="#1d6f42">
                                                <v-icon>mdi-file-excel</v-icon> Export
                                            </v-btn>
                                        </download-excel>
                                    </v-col>
                                </v-row>
                            </template>
                            <template #item.actions="{ item }">
                                <v-icon md color="primary"
                                    @click="showItem(item); getModificationRequests();getAttachmentsRequests();getManagerAttachments();getInformationRequests();">
                                    mdi-eye
                                </v-icon>
                                <v-icon md @click="editItem(item)" color="#00BFA5">
                                    mdi-pencil
                                </v-icon>
                                <v-icon md @click="deleteItem(item)" color="error" v-if="item.post_status == 'publish'">
                                    mdi-archive-arrow-down
                                </v-icon>
                                <v-icon md
                                    @click="
                                        quotes.editedItem = Object.assign({}, item); 
                                        deleteQuoteForm({action: 'unarchive', post_status: 'publish', status: 'Processing'})"
                                    color="info" v-else-if="item.post_status == 'trash'">
                                    mdi-archive-arrow-up
                                </v-icon>
                            </template>
                            <template #item.type="{ item }">
                                <v-chip :color="item.type == 'Renewal' ? 'primary' : 'success'" outlined dark>
                                    {{ item.type }}</v-chip>
                            </template>
                            <template #item.status="{ item }">
                                <v-chip :color="checkStatusColor(item.status)" dark>{{ item.status }}</v-chip>
                            </template>
                        </v-data-table>
                    </v-col>
                </v-row>
            </v-container>
        </v-main>
    </v-app>
</div>