<?php $current_user = \RA_ELITE_USA\Controller\Classes\User::get_current_user(); ?>
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
          <v-col cols="10">
            <?php echo \RA_ELITE_USA\Controller\Classes\Template::show_template('components/snackbar') ?>
            <?php echo \RA_ELITE_USA\Controller\Classes\Template::show_template('interface/settings/parts/password') ?>
          </v-col>
        </v-row>
      </v-container>
    </v-main>
  </v-app>
</div>
