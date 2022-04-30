<?php $current_user = \RA_ELITE_USA\Controller\Classes\User::get_current_user(); ?>
<v-col cols="12" md="6">
    <v-data-table :headers="agent_attachments.header" :items="agent_attachments.items" item-key="ID"
        sort-by="['published_at']" class="elevation-1" :loading="agent_attachments_table_loading" multi-sort>
        <template #top>
            <v-toolbar class="mb-n3" flat>
                <v-toolbar-title>Agent Attachments</v-toolbar-title>
                <v-spacer></v-spacer>
                <?php if ($current_user['roles'][0] == 'elite_usa_insurance_agent' || $current_user['roles'][0] == 'elite_usa_superuser'): ?>
                <v-dialog v-model="agent_attachments.dialog" max-width="500px">
                    <template #activator="{ on, attrs }">
                        <v-btn color="primary" class="mb-2" v-bind="attrs" v-on="on"
                            @click="agent_attachments.editedItem = {post_title: '', file: undefined}; agent_attachments.editedIndex = -1"
                            dark>
                            Add a Document
                        </v-btn>
                    </template>
                    <v-card>
                        <v-card-title>
                            <span class="text-h5 primary--text">{{ formAgentAttachmentTitle }}</span>
                        </v-card-title>

                        <v-card-text>
                            <v-container class="mt-n10">
                                <v-form>
                                    <v-row>
                                        <v-col cols="12">
                                            <v-text-field label="Document to be uploaded"
                                                v-model="agent_attachments.editedItem.post_title"></v-text-field>
                                        </v-col>
                                        <v-col cols="12">
                                            <v-file-input v-model="agent_attachments.editedItem.doc"
                                                accept="image/*,.pdf,.doc,.docx,.xml,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document, xlsx, .xls, .txt"
                                                label="Attach here the file" show-size filled
                                                prepend-icon="mdi-file-document"></v-file-input>
                                        </v-col>
                                        <template v-if="percent_loading_active">
                                            <v-col class="p-0 mb-n6" cols="12">
                                                <p class="text-center" v-if="percent_loading < 100">Uploading
                                                    document...</p>
                                                <p class="text-center" v-else>Document uploaded, wait a few minutes...
                                                </p>
                                            </v-col>
                                            <v-col class="p-0" cols="12">
                                                <v-progress-linear :active="percent_loading_active"
                                                    :value="percent_loading"></v-progress-linear>
                                            </v-col>
                                        </template>
                                    </v-row>
                                </v-form>
                            </v-container>
                        </v-card-text>
                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn color="secondary" text @click="closeAgentAttachment">
                                Cancel
                            </v-btn>
                            <v-btn color="primary" text @click="saveAgentAttachment" :loading="attachment_loading">
                                Save
                            </v-btn>
                        </v-card-actions>
                    </v-card>
                </v-dialog>
                <v-dialog v-model="agent_attachments.delete_dialog" max-width="60%">
                    <v-card>
                        <v-toolbar color="primary" elevation="0">
                            <v-toolbar-title class="white--text">Remove Document</v-toolbar-title>
                            <v-spacer></v-spacer>
                            <v-toolbar-items>
                                <v-btn icon dark @click="closeAgentAttachmentDelete">
                                    <v-icon color="white">mdi-close</v-icon>
                                </v-btn>
                            </v-toolbar-items>
                        </v-toolbar>

                        <v-divider></v-divider>

                        <v-card-text>
                            <v-container fluid>
                                <v-row>
                                    <v-col cols="12">
                                        <h4 class="text-center text-h5">Are you sure that you want to delete it? This
                                            action can not be undone.</h4>
                                    </v-col>
                                    <v-col class="d-flex justify-end" cols="6">
                                        <v-btn color="primary" @click="closeAgentAttachmentDelete" text light>Cancel
                                        </v-btn>
                                    </v-col>
                                    <v-col class="d-flex justify-start" cols="6">
                                        <v-btn color="secondary" @click="deleteAgentAttachment" light>Delete</v-btn>
                                    </v-col>
                                </v-row>
                            </v-container>
                        </v-card-text>
                    </v-card>
                </v-dialog>
                <?php endif ?>
            </v-toolbar>
        </template>
        <template #item.published_at="{ item }">
            {{ getFormatDate(item.post_date) }}
        </template>
        <template #item.actions="{ item }">
            <v-row class="d-flex justify-center pr-4" dense>

                <?php if ($current_user['roles'][0] == 'administrator' || $current_user['roles'][0] == 'elite_usa_superuser' || $current_user['roles'][0] == 'elite_usa_quote_manager'): ?>

                <v-btn v-if="item.attachment_url != ''" icon text>
                    <v-icon color="primary" @click="markAgentAttachmentAsSeen(item)">mdi-file-download</v-icon>
                </v-btn>

                <?php else: ?>

                <v-btn :href="item.attachment_url" v-if="item.attachment_url != ''" download icon text>
                    <v-icon color="primary">mdi-file-download</v-icon>
                </v-btn>

                <?php endif ?>
                
                <?php if ($current_user['roles'][0] == 'elite_usa_insurance_agent' || $current_user['roles'][0] == 'elite_usa_superuser'): ?>
                <v-btn class="ml-n2 mr-n1" @click="editAgentAttachmentItem(item)" icon text>
                    <v-icon color="success">mdi-pencil</v-icon>
                </v-btn>
                <v-icon color="error" @click="deleteManagerAttachmentItem(item)">mdi-trash-can</v-icon>
                <?php endif ?>

            </v-row>
        </template>
    </v-data-table>
</v-col>