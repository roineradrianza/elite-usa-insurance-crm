<template v-if="action_history.editedItem.hasOwnProperty('extra_info') 
&& action_history.editedItem.extra_info.post_type == 'quote_doc_r'">
    <h4 class="text-h5 text-center mt-n6">Document requested: {{ action_history.editedItem.extra_info.post_title }}</h4>
    <v-timeline align-top :dense="$vuetify.breakpoint.smAndDown">
        <template v-for="(item, i) in action_history.detail_items">
            <template v-if="!parseInt(item.extra_info.meta_input.status)">
                <v-timeline-item :key="i" color="info" icon="mdi-clipboard" fill-dot>
                    <v-card color="info" dark>
                        <v-card-title class="text-h6">
                            {{ getFormatDateExtended(item.created_at) }}
                        </v-card-title>
                        <v-card-text class="white text--primary">
                            <p class="text-h6 pt-4">
                                Requested
                            </p>
                        </v-card-text>
                    </v-card>
                </v-timeline-item>
            </template>

            <template v-else-if="item.extra_info.meta_input.status == 2">
                <v-timeline-item :key="i" color="primary" icon="mdi-upload" fill-dot>
                    <v-card color="primary" dark>
                        <v-card-title class="text-h6">
                            {{ getFormatDateExtended(item.created_at) }}
                        </v-card-title>
                        <v-card-text class="white text--primary">
                            <p class="text-h6 pt-4">
                                Sent
                            </p>
                            <template v-if="item.extra_info.meta_input.attachment_url != ''">
                                <template v-if="typeof item.extra_info.meta_input.attachment_url === 'string'">
                                    <v-btn color="primary" :href="item.extra_info.meta_input.attachment_url" download
                                        outlined block>Download document/s</v-btn>
                                    </v-btn>
                                </template>
                                <template v-else>
                                    <v-btn color="primary"
                                        @click="download(item.extra_info.meta_input.attachment_url)"
                                        outlined block>Download document/s</v-btn>
                                </template>
                            </template>

                        </v-card-text>
                    </v-card>
                </v-timeline-item>
            </template>

            <template v-else-if="item.extra_info.meta_input.status == 3">
                <v-timeline-item :key="i" color="warning" icon="mdi-repeat" fill-dot>
                    <v-card color="warning" dark>
                        <v-card-title class="text-h6">
                            {{ getFormatDateExtended(item.created_at) }}
                        </v-card-title>
                        <v-card-text class="white text--primary">
                            <p class="text-h6 pt-4">
                                Processing
                            </p>
                        </v-card-text>
                    </v-card>
                </v-timeline-item>
            </template>

            <template v-else-if="item.extra_info.meta_input.status">
                <v-timeline-item :key="i" color="success" icon="mdi-check-circle" fill-dot>
                    <v-card color="success" dark>
                        <v-card-title class="text-h6">
                            {{ getFormatDateExtended(item.created_at) }}
                        </v-card-title>
                        <v-card-text class="white text--primary">
                            <p class="text-h6 pt-4">
                                Approved
                            </p>
                        </v-card-text>
                    </v-card>
                </v-timeline-item>
            </template>

        </template>
    </v-timeline>
</template>