<?php $current_user = RA_ELITE_USA_INSURANCE_USER::get_current_user(); ?>
<v-col cols="12" md="6">
  <v-data-table :headers="attachments.header" :items="attachments.items" item-key="ID" sort-by="['status','published_at']" class="elevation-1" :loading="attachments_table_loading" multi-sort>
    <template #top>
      <v-toolbar class="mb-n3" flat>
        <v-toolbar-title>Documents requested</v-toolbar-title>
        <v-spacer></v-spacer>
        <?php if ($current_user['roles'][0] == 'administrator' || $current_user['roles'][0] == 'elite_usa_quote_manager' || $current_user['roles'][0] == 'elite_usa_superuser'): ?>
        <v-dialog v-model="attachments.dialog" max-width="500px">
          <template #activator="{ on, attrs }">
            <v-btn color="primary" class="mb-2" v-bind="attrs" v-on="on" dark>
              Request a Document
            </v-btn>
          </template>
          <v-card>
            <v-card-title>
              <span class="text-h5 primary--text">{{ formAttachmentTitle }}</span>
            </v-card-title>

            <v-card-text>
              <v-container class="mt-n10">
                <v-form>
                  <v-row>
                    <v-col cols="12">
                      <v-text-field label="Document to be requested" v-model="attachments.editedItem.post_title"></v-text-field>
                    </v-col>
                  </v-row>
                </v-form>
              </v-container>
            </v-card-text>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="secondary" text @click="closeAttachment">
                Cancel
              </v-btn>
              <v-btn color="primary" text @click="saveAttachmentRequest" :loading="attachment_loading">
                Save
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
        <v-dialog v-model="attachments.delete_dialog" max-width="60%">
          <v-card>
            <v-toolbar color="primary" elevation="0">
              <v-toolbar-title class="white--text">Remove Document Request</v-toolbar-title>
              <v-spacer></v-spacer>
              <v-toolbar-items>
              <v-btn icon dark @click="closeAttachmentDelete">
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
                    <v-btn color="primary" @click="closeAttachmentDelete" text light>Cancel</v-btn>
                  </v-col>
                  <v-col class="d-flex justify-start" cols="6">
                    <v-btn color="secondary" @click="deleteDocumentRequested" light>Delete</v-btn>
                  </v-col>
                </v-row>
              </v-container>
            </v-card-text>
          </v-card>
        </v-dialog>
        <?php if ($current_user['roles'][0] == 'elite_usa_superuser'): ?>
        <v-dialog v-model="attachments.upload_dialog" max-width="500px">
          <v-card>
            <v-card-title>
              <span class="text-h5 primary--text">Upload Document</span>
            </v-card-title>

            <v-card-text>
              <v-container class="mt-n10">
                <v-form>
                  <v-row>
                    <v-col cols="12">
                      <label>{{ attachments.editedItem.post_title }}</label>
                      <v-file-input v-model="attachments.editedItem.doc" 
                      accept="image/*,.pdf,.doc,.docx,.xml,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document, xlsx, .xls, .txt" 
                      label="Upload Document" multiple counter show-size filled prepend-icon="mdi-file-document">
                      </v-file-input>
                    </v-col>
                    <template v-if="percent_loading_active">
                      <v-col class="p-0 mb-n6" cols="12">
                        <p class="text-center" v-if="percent_loading < 100">Uploading document...</p>
                        <p class="text-center" v-else>Document uploaded, wait a few minutes...</p>
                      </v-col>
                      <v-col class="p-0" cols="12">
                        <v-progress-linear :active="percent_loading_active" :value="percent_loading"></v-progress-linear>
                      </v-col>
                    </template>
                  </v-row>
                </v-form>
              </v-container>
            </v-card-text>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="secondary" text @click="closeUploadAttachment">
                Cancel
              </v-btn>
              <v-btn color="primary" text @click="uploadAttachment" :loading="attachment_loading">
                Upload
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
          
        <?php endif ?>
        <?php else: ?>
        <v-dialog v-model="attachments.dialog" max-width="500px">
          <v-card>
            <v-card-title>
              <span class="text-h5 primary--text">Upload Document</span>
            </v-card-title>

            <v-card-text>
              <v-container class="mt-n10">
                <v-form>
                  <v-row>
                    <v-col cols="12">
                        <label>{{ attachments.editedItem.post_title }}</label>
                        <v-file-input v-model="attachments.editedItem.doc" accept="image/*,.pdf,.doc,.docx,.xml,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document, xlsx, .xls, .txt" 
                        label="Upload Document" multiple counter show-size filled prepend-icon="mdi-file-document">
                        </v-file-input>
                    </v-col>
                    <template v-if="percent_loading_active">
                      <v-col class="p-0 mb-n6" cols="12">
                        <p class="text-center" v-if="percent_loading < 100">Uploading document...</p>
                        <p class="text-center" v-else>Document uploaded, wait a few minutes...</p>
                      </v-col>
                      <v-col class="p-0" cols="12">
                        <v-progress-linear :active="percent_loading_active" :value="percent_loading"></v-progress-linear>
                      </v-col>
                    </template>
                  </v-row>
                </v-form>
              </v-container>
            </v-card-text>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="secondary" text @click="closeAttachment">
                Cancel
              </v-btn>
              <v-btn color="primary" text @click="uploadAttachment" :loading="attachment_loading">
                Upload
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
      <v-chip color="warning" v-if="parseInt(item.status) == 3">Processing</v-chip>
      <v-chip color="primary" v-else-if="parseInt(item.status) == 2">Sent</v-chip>
      <v-chip color="success" v-else-if="parseInt(item.status)">Approved</v-chip>
      <v-chip color="warning" v-else>Pending</v-chip>
    </template>
    <?php if ($current_user['roles'][0] == 'administrator' || $current_user['roles'][0] == 'elite_usa_quote_manager' || $current_user['roles'][0] == 'elite_usa_superuser'): ?>
    <template #item.post_title="props">
      <v-edit-dialog ref="attachment_edit_dialog" @save="updateAttachmentName(props.item)" :return-value.sync="props.item.post_title" large>
          {{ props.item.post_title }} <v-icon color="success" small>mdi-pencil</v-icon>
          <template #input>
            <v-text-field v-model="props.item.post_title" label="Edit Document" hint="Write the new document name" single-line autofocus></v-text-field>
          </template>
        </v-edit-dialog>
    </template>
    <?php endif ?>
    <template #item.actions="props">
      <v-row class="d-flex justify-center pr-4" dense>
      <?php if ($current_user['roles'][0] == 'administrator' || $current_user['roles'][0] == 'elite_usa_quote_manager' || $current_user['roles'][0] == 'elite_usa_superuser'): ?>

        <template v-if="parseInt(props.item.status) == 2">
          <v-tooltip top>
            <template v-slot:activator="{ on, attrs }">
              <v-icon color="warning" @click="markAsProcessingDocumentRequested(props.item)" v-bind="attrs" v-on="on">
                mdi-file-move
              </v-icon>
            </template>
            <span>Mark as Processing</span>
          </v-tooltip>
        </template>
        <template v-else-if="parseInt(props.item.status) == 3">
          <v-tooltip top>
            <template v-slot:activator="{ on, attrs }">
              <v-icon color="success" @click="approveDocumentRequested(props.item)" v-bind="attrs" v-on="on">
                mdi-check-circle
              </v-icon>
            </template>
            <span>Mark as Approved</span>
          </v-tooltip>
        </template>
        
        <v-btn  :href="props.item.attachment_url" v-if="props.item.attachment_url != ''" download icon text><v-icon color="primary">mdi-file-download</v-icon></v-btn>

        <?php if ($current_user['roles'][0] == 'elite_usa_superuser'): ?>
        <v-btn class="ml-n2 mr-n1"  @click="editUploadAttachmentItem(props.item)" icon text><v-icon color="primary">mdi-upload</v-icon></v-btn>
        <?php endif ?>

        <v-icon  color="error" @click="deleteDocumentItem(props.item)">mdi-trash-can</v-icon>
        <?php else: ?>
        <v-btn  :href="props.item.attachment_url" v-if="props.item.attachment_url != ''" download icon text><v-icon color="success">mdi-file-download</v-icon></v-btn>
        <v-btn  @click="editAttachmentItem(props.item)" icon text><v-icon color="primary">mdi-upload</v-icon></v-btn>
      <?php endif ?>
      </v-row>
    </template>
  </v-data-table>
</v-col>