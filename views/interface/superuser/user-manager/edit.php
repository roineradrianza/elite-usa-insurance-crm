  <v-dialog v-model="users.edit_dialog" max-width="75%" style="z-index: 100000;" @click:outside="closeEdit">
    <v-card>
      <v-toolbar color="primary" elevation="0">
        <v-toolbar-title class="white--text">{{ formTitle }}</v-toolbar-title>
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
          <v-form v-model="user_form_valid" lazy-validation>
            <v-row>
              <v-col cols="12" md="6">
                <v-text-field label="Username" v-model="users.editedItem.user_login" :rules="rules.required" :disabled="users.editedIndex != -1"></v-text-field>
              </v-col>
              <v-col cols="12" md="6">
                <v-text-field label="Email" v-model="users.editedItem.email" :rules="rules.email"></v-text-field>
              </v-col>
              <v-col cols="12" md="3">
                <v-text-field label="First name" v-model="users.editedItem.first_name" :rules="rules.required"></v-text-field>
              </v-col>
              <v-col cols="12" md="3">
                <v-text-field label="Last Name" v-model="users.editedItem.last_name" :rules="rules.required"></v-text-field>
              </v-col>
              <v-col cols="12" md="3">
                <v-select label="Profile" v-model="users.editedItem.profile" :items="users.roles" :rules="rules.required"></v-text-field>
              </v-col>
              <v-col class="mt-n2" cols="12" md="3">
                <v-text-field label="Password" v-model="users.editedItem.user_pass" :rules="rules.required" v-if="users.editedIndex == -1">
                  <template #append>
                    <v-btn color="primary" @click="users.editedItem.user_pass = generatePassword()" text>Generate</v-btn>
                  </template>
                </v-text-field>
                <v-text-field label="Password" v-model="users.editedItem.user_pass" v-else>
                  <template #append>
                    <v-btn color="primary" @click="users.editedItem.user_pass = generatePassword()" text>Generate</v-btn>
                  </template>
                </v-text-field>
              </v-col>
              <v-col class="mt-n4" cols="6" v-if="users.editedIndex == -1 || users.editedItem.user_pass != ''">
                <v-checkbox label="Send the user an email about their account." v-model="users.editedItem.send_user_email" true-value="1" false-value="0"></v-checkbox>
              </v-col>
            </v-row>
          </v-form>

          <v-row>
            <v-btn color="primary" :disabled="!user_form_valid" @click="saveUser" :loading="users.save_loading" block light>Save</v-btn>
          </v-row>
        </v-container>
      </v-card-text>
    </v-card>
  </v-dialog>