  <v-dialog v-model="inbox.view_dialog" max-width="600px" style="z-index: 100000;" @click:outside="closeDetailsView">
    <v-card>
      <v-toolbar color="primary" elevation="0">
        <v-toolbar-title class="white--text">Details</v-toolbar-title>
        <v-spacer></v-spacer>
        <v-toolbar-items>
        <v-btn icon dark @click="closeDetailsView">
          <v-icon color="white">mdi-close</v-icon>
        </v-btn>
        </v-toolbar-items>
      </v-toolbar>

      <v-divider></v-divider>

      <v-card-text>
        <v-container fluid>
          <template v-if="inbox.editedItem.hasOwnProperty('post_type')">
            <v-row ref="preview_quote" v-if="inbox.editedItem.post_type == 'quote_form_mr'">
              <v-col class="mt-n10" cols="12">
                <div class="text-center body-1">{{ inbox.editedItem.post_content }}</div>
              </v-col>
            </v-row>
            <v-row ref="preview_quote" v-else-if="inbox.editedItem.post_type == 'quote_data_r'">
              <template v-if="inbox.editedItem.post_content == ''">
                <v-col class="mt-n10" cols="12">
                  <p class="text-center body-1"><b>Information Requested:</b> {{ inbox.editedItem.post_title }}</p>
                </v-col>
              </template>
              <template v-else>
                <v-col class="mt-n10" cols="6">
                  <p class="text-center body-1"><b>Information Requested:</b> <br> {{ inbox.editedItem.post_title }}</p>
                </v-col>
                <v-col class="mt-n10" cols="6">
                  <p class="text-center body-1"><b>Information sent:</b> <br> {{ inbox.editedItem.post_content }}</p>
                </v-col>
              </template>
            </v-row>
          </template>
          <v-row>
            <v-btn color="primary" @click="filterQuotes(inbox.editedItem.post_parent)" :loading="inbox.loading_details" block>Go to quote</v-btn>
          </v-row>
        </v-container>
      </v-card-text>
    </v-card>
  </v-dialog>