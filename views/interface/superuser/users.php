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
            <?php $current_user = \RA_ELITE_USA\Controller\Classes\User::get_current_user(); ?>
            <?php if ($current_user['roles'][0] == 'elite_usa_superuser'): ?>
            <?php echo \RA_ELITE_USA\Controller\Classes\Template::show_template('interface/parts/sidebar', \RA_ELITE_USA\Controller\Classes\Template::dashboard_superuser_tabs()); ?>
            <?php else: ?>
            <?php echo \RA_ELITE_USA\Controller\Classes\Template::show_template('interface/parts/sidebar', \RA_ELITE_USA\Controller\Classes\Template::dashboard_manager_tabs()); ?>
            <?php endif ?>
          </v-col>
          <v-col cols="10">
            <?php echo \RA_ELITE_USA\Controller\Classes\Template::show_template('components/snackbar') ?>
            <?php echo \RA_ELITE_USA\Controller\Classes\Template::show_template('components/snackbar') ?>
            <?php echo \RA_ELITE_USA\Controller\Classes\Template::show_template('interface/superuser/user-manager/preview') ?>
            <?php echo \RA_ELITE_USA\Controller\Classes\Template::show_template('interface/superuser/user-manager/edit') ?>
            <?php echo \RA_ELITE_USA\Controller\Classes\Template::show_template('interface/superuser/user-manager/delete') ?>

            <v-data-table :headers="users.header" :items="users.items" sort-by="['status','published_at']" class="elevation-1" :loading="table_loading" :search="users.search" multi-sort>
              <template #top>
                <v-row class="d-flex align-center px-10">
                  <v-col cols="10">
                    <v-text-field v-model="users.search" append-icon="mdi-magnify" label="Search" placeholder="search by name, email or rol..."  hint="search by name, email or rol..."single-line></v-text-field>
                  </v-col>
                  <v-col cols="2">
                    <v-btn color="primary" @click="users.edit_dialog = true" block>Add new User <v-icon>mdi-plus</v-icon></v-btn>
                  </v-col>
                </v-row>
              </template>
              <template #item.actions="{ item }">
                <v-icon md color="primary" @click="showItem(item);">
                  mdi-eye
                </v-icon>
                <v-icon md @click="editItem(item)" color="#00BFA5">
                  mdi-pencil
                </v-icon>
                <v-icon md @click="deleteItem(item)" color="error">
                  mdi-trash-can
                </v-icon>
              </template>
            </v-data-table>
          </v-col>
        </v-row>
      </v-container>
    </v-main>
  </v-app>
</div>
