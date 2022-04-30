<?php echo \RA_ELITE_USA\Controller\Classes\Template::show_template('interface/dialogs/action_history/view_action_history_dialog') ?>
<v-dialog v-model="action_history.dialog" max-width="800px" style="z-index: 100000;">
    <v-card>
        <v-toolbar color="primary" elevation="0">
            <v-toolbar-title class="white--text">Actions History</v-toolbar-title>
            <v-spacer></v-spacer>
            <v-toolbar-items>
                <v-btn icon dark @click="action_history.dialog = false">
                    <v-icon color="white">mdi-close</v-icon>
                </v-btn>
            </v-toolbar-items>
        </v-toolbar>

        <v-divider></v-divider>
        <v-card-text>
            <v-container fluid>
                <v-row>
                    <v-col cols="12">
                        <v-data-table :headers="action_history.headers" :items="action_history.items"
                            item-key="action_history_id" sort-by="created_at" class="elevation-1"
                            :loading="action_history.loading" :sort-desc="true">
                            <template #item.created_at="{ item }">
                                {{ getFormatDateExtended(item.created_at) }}
                            </template>
                            <template #item.actions="{ item }">
                                <v-icon md @click="showActionDetails(item)" color="primary"
                                    v-if="item.post_type != 'quote_form' && item.post_parent !== null">
                                    mdi-eye
                                </v-icon>
                                <v-icon md @click="filterQuotes(item.post_parent); action_history.dialog = false"
                                    color="primary" v-else>
                                    mdi-eye
                                </v-icon>
                            </template>
                        </v-data-table>
                    </v-col>
                </v-row>
            </v-container>
        </v-card-text>
    </v-card>
</v-dialog>