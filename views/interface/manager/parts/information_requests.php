<?php $current_user = \RA_ELITE_USA\Controller\Classes\User::get_current_user(); ?>
<v-col cols="12" md="6">
  <v-data-table :headers="information_requests.header" :items="information_requests.items" item-key="ID" sort-by="['status','published_at']" class="elevation-1" :loading="information_requests_table_loading" multi-sort>
    <template #top>
      <v-toolbar class="mb-n3" flat>
        <v-toolbar-title>Information requested</v-toolbar-title>
        <v-spacer></v-spacer>
        <?php if ($current_user['roles'][0] == 'administrator' || $current_user['roles'][0] == 'elite_usa_quote_manager' || $current_user['roles'][0] == 'elite_usa_superuser'): ?>
        <v-dialog v-model="information_requests.dialog" max-width="500px">
          <template #activator="{ on, attrs }">
            <v-btn color="primary" class="mb-2" v-bind="attrs" v-on="on" dark>
              Request a Information
            </v-btn>
          </template>
          <v-card>
            <v-card-title>
              <span class="text-h5 primary--text">{{ formRequestInformationTitle }}</span>
            </v-card-title>

            <v-card-text>
              <v-container class="mt-n10">
                <v-form>
                  <v-row>
                    <v-col cols="12">
                      <v-text-field label="Information to be requested" v-model="information_requests.editedItem.post_title"></v-text-field>
                    </v-col>
                  </v-row>
                </v-form>
              </v-container>
            </v-card-text>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="secondary" text @click="closeInformationRequest">
                Cancel
              </v-btn>
              <v-btn color="primary" text @click="saveInformationRequest" :loading="information_requests_loading">
                Save
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
        <v-dialog v-model="information_requests.delete_dialog" max-width="60%">
          <v-card>
            <v-toolbar color="primary" elevation="0">
              <v-toolbar-title class="white--text">Remove Information Request</v-toolbar-title>
              <v-spacer></v-spacer>
              <v-toolbar-items>
              <v-btn icon dark @click="closeInformationRequestDelete">
                <v-icon color="white">mdi-close</v-icon>
              </v-btn>
              </v-toolbar-items>
            </v-toolbar>

            <v-divider></v-divider>

            <v-card-text>
              <v-container fluid>
                <v-row>
                  <v-col cols="12">
                    <h4 class="text-center text-h5">Are you sure that you want to delete it? This action can not be undone.</h4>
                  </v-col>
                  <v-col class="d-flex justify-end" cols="6">
                    <v-btn color="primary" @click="closeInformationRequestDelete" text light>Cancel</v-btn>
                  </v-col>
                  <v-col class="d-flex justify-start" cols="6">
                    <v-btn color="secondary" @click="deleteInformationRequest" light>Delete</v-btn>
                  </v-col>
                </v-row>
              </v-container>
            </v-card-text>
          </v-card>
        </v-dialog>
        <?php if ($current_user['roles'][0] == 'elite_usa_superuser'): ?>
        <v-dialog v-model="information_requests.upload_dialog" max-width="500px">
          <v-card>
            <v-card-title>
              <span class="text-h5 primary--text">Send Information</span>
            </v-card-title>

            <v-card-text>
              <v-container class="mt-n10">
                <v-form>
                  <v-row>
                    <v-col cols="12">
                        <v-text-field label="Information"></v-text-field>
                    </v-col>
                  </v-row>
                </v-form>
              </v-container>
            </v-card-text>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="secondary" text @click="closeUploadInformationRequest">
                Cancel
              </v-btn>
              <v-btn color="primary" text @click="uploadInformationRequest" :loading="attachment_loading">
                Send
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
          
        <?php endif ?>
        <?php else: ?>
        <v-dialog v-model="information_requests.dialog" max-width="500px">
          <v-card>
            <v-card-title>
              <span class="text-h5 primary--text">Send Information</span>
            </v-card-title>

            <v-card-text>
              <v-container class="mt-n10">
                <v-form>
                  <v-row>
                    <v-col cols="12">
                        <v-text-field v-model="information_requests.editedItem.post_content" label="Information"></v-text-field>
                    </v-col>
                  </v-row>
                </v-form>
              </v-container>
            </v-card-text>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="secondary" text @click="closeInformationRequest">
                Cancel
              </v-btn>
              <v-btn color="primary" text @click="uploadInformationRequest" :loading="information_requests_loading">
                Send
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
        <?php endif ?>
      </v-toolbar>
    </template>
    <template #item.published_at="{ item }">
      {{ getFormatDate(item.post_date) }}
    </template>
    <template #item.status="{ item }">
      <v-chip color="success" v-if="parseInt(item.status)">Approved</v-chip>
      <v-chip color="success" v-else-if="parseInt(item.status) == 2">Sent</v-chip>
      <v-chip color="warning" v-else>Pending</v-chip>
    </template>
    <?php if ($current_user['roles'][0] == 'administrator' || $current_user['roles'][0] == 'elite_usa_quote_manager' || $current_user['roles'][0] == 'elite_usa_superuser'): ?>
    <template #item.post_title="props">
      <v-edit-dialog ref="information_request_edit_dialog" @save="updateInformationTitle(props.item)" :return-value.sync="props.item.post_title" large>
          {{ props.item.post_title }} <v-icon color="success" small>mdi-pencil</v-icon>
          <template #input>
            <v-text-field v-model="props.item.post_title" label="Edit Information" hint="Change information to request" single-line autofocus></v-text-field>
          </template>
        </v-edit-dialog>
    </template>
    <?php endif ?>
    <template #item.status="{item}">
      <v-chip color="primary" v-if="parseInt(item.status) == 2">Received</v-chip>
      <v-chip color="success" v-else-if="parseInt(item.status)">Ready</v-chip>
      <v-chip color="warning" v-else>Processing</v-chip>
    </template>
    <template #item.actions="props">
      <v-row class="d-flex justify-center pr-4" dense>
      <?php if ($current_user['roles'][0] == 'administrator' || $current_user['roles'][0] == 'elite_usa_quote_manager' || $current_user['roles'][0] == 'elite_usa_superuser'): ?>

        <v-icon  color="success" @click="approveInformation(props.item)" v-if="parseInt(props.item.status) == 2">mdi-check-circle</v-icon>
        <v-icon  color="error" @click="deleteInformationRequestItem(props.item)">mdi-trash-can</v-icon>
        <?php else: ?>
        <v-btn @click="editInformationRequestItem(props.item)" v-if="parseInt(props.item.status) != 1" icon text><v-icon color="primary">mdi-pencil</v-icon></v-btn>
      <?php endif ?>
      </v-row>
    </template>
  </v-data-table>
</v-col>