  <v-dialog v-model="edit_dialog" max-width="95%" style="z-index: 100000;">
    <v-card>
      <v-toolbar color="primary" elevation="0">
        <v-toolbar-title class="white--text">Edit Quote Information</v-toolbar-title>
        <v-spacer></v-spacer>
        <v-toolbar-items>
        <v-btn icon dark @click="closeEdit">
          <v-icon color="white">mdi-close</v-icon>
        </v-btn>
        </v-toolbar-items>
      </v-toolbar>

      <v-divider></v-divider>

      <v-card-text>
        <v-container fluid>
          <v-row v-if="quotes.editedIndex != -1">
            <v-col class="px-0 mt-n10" cols="12">
              <v-select v-model="quotes.editedItem.status" label="Status" :items="options.status" chips>
                <template #selection="item">
                  <v-chip :color="checkStatusColor(quotes.editedItem.status)" dark>{{ quotes.editedItem.status }}</v-chip>
                </template>
              </v-select>
            </v-col>
            <?php echo \RA_ELITE_USA\Controller\Classes\Template::show_template('interface/manager/parts/forms/affordable_care_act') ?>
            <?php echo \RA_ELITE_USA\Controller\Classes\Template::show_template('interface/manager/parts/forms/personal_information') ?>
            <?php echo \RA_ELITE_USA\Controller\Classes\Template::show_template('interface/manager/parts/forms/espouse_information') ?>
            <?php echo \RA_ELITE_USA\Controller\Classes\Template::show_template('interface/manager/parts/forms/dependents') ?>
            <?php echo \RA_ELITE_USA\Controller\Classes\Template::show_template('interface/manager/parts/forms/payment_information') ?>
          </v-row>
          <v-row v-if="quotes.editedIndex != -1">
            <v-btn color="primary" :disabled="!affordable_care_act_valid || !personal_information_valid || !employment_information_valid || !espouse_information_valid || !espouse_employment_information_valid || !dependents_information_valid || !payment_information_valid" @click="updateQuoteForm" :loading="quote_loading" block light>Apply changes</v-btn>
          </v-row>
        </v-container>
      </v-card-text>
    </v-card>
  </v-dialog>