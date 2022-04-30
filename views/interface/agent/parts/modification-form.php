<?php $current_user = \RA_ELITE_USA\Controller\Classes\User::get_current_user(); ?>
<?php if ($current_user['roles'][0] == 'elite_usa_insurance_agent') : ?>
      <v-dialog v-model="edit_dialog" max-width="75%" style="z-index: 100000;">
        <v-card>
          <v-toolbar color="primary" elevation="0">
            <v-toolbar-title class="white--text">Modification Request</v-toolbar-title>
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
              <v-row v-if="quotes.editedIndex != -1" style="display: inline">
                <v-form ref="request_edit_form" v-model="request_edit_form_valid" lazy-validation>
                 <v-col cols="12">
                   <v-textarea v-model="modifications.content" label="Specify the modifications to do" auto-grow outlined></v-textarea>
                 </v-col>
                </v-form>
              </v-row>
              <v-row v-if="quotes.editedIndex != -1">
                <v-btn color="primary" :disabled="!request_edit_form_valid" :loading="quote_loading" @click="sendModificationRequest" block light>Request changes</v-btn>
              </v-row>
            </v-container>
          </v-card-text>
        </v-card>
      </v-dialog>
<?php endif ?>