<template v-if="action_history.editedItem.hasOwnProperty('extra_info') 
&& action_history.editedItem.extra_info.post_type == 'quote_m_doc'">
    <h4 class="text-h5 text-center mt-n6">Attachment: {{ action_history.editedItem.extra_info.post_title }}</h4>
    <v-timeline align-top :dense="$vuetify.breakpoint.smAndDown">
        <template v-for="(item, i) in action_history.detail_items">
            <v-timeline-item :key="i" color="primary" icon="mdi-upload" fill-dot>
                <v-card color="primary" dark>
                    <v-card-title class="text-h6">
                        {{ getFormatDateExtended(item.created_at) }}
                    </v-card-title>
                    <v-card-text class="white text--primary">
                        <p class="text-h6 pt-4">
                            Sent
                        </p>
                        <v-btn color="primary" :href="item.extra_info.meta_input.attachment_url" download outlined
                            block>Download document</v-btn>
                        </v-btn>
                    </v-card-text>
                </v-card>
            </v-timeline-item>
        </template>
    </v-timeline>
</template>