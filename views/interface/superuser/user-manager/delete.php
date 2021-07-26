  <v-dialog v-model="users.delete_dialog" max-width="60%" style="z-index: 100000;" @click:outside="closeDelete">
    <v-card>
      <v-toolbar color="primary" elevation="0">
        <v-toolbar-title class="white--text">Delete User Information</v-toolbar-title>
        <v-spacer></v-spacer>
        <v-toolbar-items>
        <v-btn icon dark @click="closeDelete">
          <v-icon color="white">mdi-close</v-icon>
        </v-btn>
        </v-toolbar-items>
      </v-toolbar>

      <v-divider></v-divider>

      <v-card-text>
        <v-container fluid>
          <v-row>
            <v-col cols="12">
              <h3 class="text-center text-h4">Are you sure that you want to delete it? This action can not be undone.</h3>
            </v-col>
            <v-col class="d-flex justify-end" cols="6">
              <v-btn color="primary" @click="closeDelete" :disabled="users.delete_loading" text light>Cancel</v-btn>
            </v-col>
            <v-col class="d-flex justify-start" cols="6">
              <v-btn color="secondary" @click="deleteUser" :loading="users.delete_loading" light>Delete</v-btn>
            </v-col>
          </v-row>
        </v-container>
      </v-card-text>
    </v-card>
  </v-dialog>