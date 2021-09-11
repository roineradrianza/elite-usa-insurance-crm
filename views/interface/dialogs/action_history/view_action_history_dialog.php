<v-dialog v-model="action_history.details_dialog" max-width="1000px" transition="dialog-transition">
    <v-card>
        <v-toolbar color="primary" elevation="0">
            <v-toolbar-title class="white--text"> 
                <template v-if="action_history.editedItem.hasOwnProperty('action_message')"> {{ action_history.editedItem.action_message }} </template> - 
                Details
            </v-toolbar-title>
            <v-spacer></v-spacer>
            <v-toolbar-items>
                <v-btn icon dark @click="action_history.details_dialog = false">
                    <v-icon color="white">mdi-close</v-icon>
                </v-btn>
            </v-toolbar-items>
        </v-toolbar>
        <v-card-text>
            <v-container fluid>
                <v-row>
                    <v-col cols="12">
                        <?php echo RA_ELITE_USA_INSURANCE_TEMPLATE::show_template('interface/dialogs/action_history/timelines/information_requested') ?>
                        <?php echo RA_ELITE_USA_INSURANCE_TEMPLATE::show_template('interface/dialogs/action_history/timelines/document_requested') ?>
                        <?php echo RA_ELITE_USA_INSURANCE_TEMPLATE::show_template('interface/dialogs/action_history/timelines/modification_requested') ?>
                        <?php echo RA_ELITE_USA_INSURANCE_TEMPLATE::show_template('interface/dialogs/action_history/timelines/attachments') ?>
                    </v-col>
                </v-row>
            </v-container>
        </v-card-text>
    </v-card>
</v-dialog>