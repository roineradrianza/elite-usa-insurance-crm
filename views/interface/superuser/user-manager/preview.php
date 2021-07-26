  <v-dialog v-model="users.view_dialog" max-width="700px" style="z-index: 100000;" @click:outside="closeView">
    <v-card>
      <v-toolbar color="primary" elevation="0">
        <v-toolbar-title class="white--text">User Information</v-toolbar-title>
        <v-spacer></v-spacer>
        <v-toolbar-items>
        <v-btn icon dark @click="closeView">
          <v-icon color="white">mdi-close</v-icon>
        </v-btn>
        </v-toolbar-items>
      </v-toolbar>

      <v-divider></v-divider>

      <v-card-text>
        <v-container fluid>
          <v-row class="mt-n4">
            <v-col class="d-flex justify-end mt-n8" cols="12" v-if="users.editedItem.roles[0] == 'elite_usa_insurance_agent' && users.editedItem.hasOwnProperty('agreement_form') && users.editedItem.agreement_form != null">
              <v-btn color="primary" @click="generateContractPDF()" :loading="contract_loading">Download Contract</v-btn>
            </v-col>
            <v-col cols="12" md="6">
              <span class="body-1"><b>Username:</b> {{ users.editedItem.user_login }}</span>
            </v-col>
            <v-col cols="12" md="6">
              <span class="body-1"><b>Email:</b> {{ users.editedItem.email }}</span>
            </v-col>
            <v-col cols="12" md="6">
              <span class="body-1"><b>Full Name:</b> {{ users.editedItem.full_name }}</span>
            </v-col>
            <v-col cols="12" md="6">
              <span class="body-1"><b>Profile:</b> {{ users.editedItem.profile }}</span>
            </v-col>
          </v-row>
        </v-container>
      </v-card-text>
    </v-card>
  </v-dialog>