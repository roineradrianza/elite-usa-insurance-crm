<?php echo RA_ELITE_USA_INSURANCE_TEMPLATE::show_template('interface/parts/preloader') ?>
<!-- App.vue -->
<div id="ra-elite-usa-insurance-container">
  <v-app style="display: none;">

    <!-- Sizes your content based upon application components -->
    <v-main>
      <!-- Provides the application the proper gutter -->
      <v-container class="mb-n2" fluid>
        <v-row>
          <v-col cols="2">
            <?php $current_user = RA_ELITE_USA_INSURANCE_USER::get_current_user(); ?>
            <?php if ($current_user['roles'][0] == 'elite_usa_superuser'): ?>
            <?php echo RA_ELITE_USA_INSURANCE_TEMPLATE::show_template('interface/parts/sidebar', RA_ELITE_USA_INSURANCE_TEMPLATE::dashboard_superuser_tabs()); ?>
            <?php else: ?>
            <?php echo RA_ELITE_USA_INSURANCE_TEMPLATE::show_template('interface/parts/sidebar', RA_ELITE_USA_INSURANCE_TEMPLATE::dashboard_manager_tabs()); ?>
            <?php endif ?>
          </v-col>
          <v-col cols="10">
            <?php echo RA_ELITE_USA_INSURANCE_TEMPLATE::show_template('interface/manager/parts/inbox/preview') ?>
            <?php echo RA_ELITE_USA_INSURANCE_TEMPLATE::show_template('interface/manager/parts/inbox/edit') ?>
            <?php echo RA_ELITE_USA_INSURANCE_TEMPLATE::show_template('interface/manager/parts/inbox/delete') ?>
            <?php echo RA_ELITE_USA_INSURANCE_TEMPLATE::show_template('interface/manager/parts/inbox/view_modification') ?>
            <?php echo RA_ELITE_USA_INSURANCE_TEMPLATE::show_template('components/snackbar') ?>
            <v-row>
              <v-col cols="12">
                <v-data-table :headers="inbox.header" :items="inbox.items" sort-by="['status','published_at']" :search="inbox.search" class="elevation-1" :loading="table_loading" multi-sort>
                  <template #top>
                    <v-row class="px-10 d-flex align-center">
                      <v-col cols="11">
                        <v-text-field v-model="inbox.search" append-icon="mdi-magnify" label="Search" placeholder="search by quote id, date, type, description or status..." hint="search by quote id, date, type, description or status..." single-line></v-text-field>
                      </v-col>
                      <v-col class="d-flex justify-center px-0" cols="1">
                        <v-btn class="ml-2" color="primary"@click="initialize"  text block>
                          <v-icon >mdi-reload</v-icon>
                        </v-btn>
                      </v-col>
                    </v-row>
                  </template>
                  <template #item.post_type="{ item }">
                    {{ returnPostType(item.post_type) }}
                  </template>
                  <template #item.actions="{ item }">
                    <v-icon class="ml-n2" md color="primary" @click="showItem(item); getModificationRequests();getAttachmentsRequests();getManagerAttachments();getInformationRequests();" v-if="item.post_type == 'quote_form'">
                      mdi-eye
                    </v-icon>
                    <v-icon class="ml-n2" md color="primary" @click="filterQuotes(item.post_parent)" v-if="item.post_type == 'quote_doc_r'">
                      mdi-eye
                    </v-icon>
                    <v-icon class="ml-n2" md color="primary" @click="showDetailsItem(item)" v-if="item.post_type == 'quote_form_mr' || item.post_type == 'quote_data_r'">
                      mdi-eye
                    </v-icon>
                  </template>
                  <template #item.status="{ item }">
                    <v-chip :color="checkStatusColor(item.status, item.post_type)" dark>{{ returnStatusType(item.status, item.post_type) }}</v-chip>
                  </template>
                </v-data-table>
              </v-col>
            </v-row>
          </v-col>
        </v-row>
      </v-container>
    </v-main>
  </v-app>
</div>
