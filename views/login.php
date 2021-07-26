<?php echo RA_ELITE_USA_INSURANCE_TEMPLATE::show_template('interface/parts/preloader') ?>
<!-- App.vue -->
<div id="ra-elite-usa-insurance-container">
  <v-app style="display: none;">

    <!-- Sizes your content based upon application components -->
    <v-main>
      <!-- Provides the application the proper gutter -->
      <v-container class="mb-n2" id="app-container" fluid>
        <v-row>
          <v-col cols="12" md="8" offset-md="2">
            <v-form ref="login_form" v-model="login_form_valid" lazy-validation>
              <v-row class="px-3">
                <v-sheet color="white" width="100%" elevation="3">       
                  <v-col cols="12">
                    <v-text-field v-model="email" label="E-mail" v-on:keyup.enter="login" :rules="rules.email" required></v-text-field>
                  </v-col>
                  <v-col cols="12">
                    <v-text-field type="password" label="Password" v-on:keyup.enter="login" v-model="password" :rules="rules.required" required></v-text-field>
                  </v-col>
                  <v-col class="my-n5" cols="12">
                    <v-checkbox v-model="remember" label="Remember me"></v-checkbox>
                  </v-col>
                  <v-col cols="12">
                    <v-btn color="primary" @click="login" :disabled="!login_form_valid" :loading="loading" light block>Login</v-btn>
                  </v-col>
                  <v-col cols="12">
                    <?php echo RA_ELITE_USA_INSURANCE_TEMPLATE::show_template('components/alert') ?>
                  </v-col>
                </v-sheet>
              </v-row>
            </v-form>
          </v-col>
        </v-row>
      </v-container>
    </v-main>
  </v-app>
</div>
