<template v-if="action_history.editedItem.hasOwnProperty('extra_info') 
&& action_history.editedItem.extra_info.post_type == 'quote_data_r'">
    <h4 class="text-h5 text-center mt-n6">Information requested: {{ action_history.editedItem.extra_info.post_title }}</h4>
    <v-timeline align-top :dense="$vuetify.breakpoint.smAndDown">
        <template v-for="(item, i) in action_history.detail_items">
            <template v-if="!item.extra_info.meta_input.status">
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
                            <p class="subtitle-1 mt-n4">
                                Information sent: {{ item.extra_info.post_content }}
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