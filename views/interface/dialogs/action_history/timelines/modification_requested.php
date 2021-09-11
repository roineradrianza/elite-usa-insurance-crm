<template v-if="action_history.editedItem.hasOwnProperty('extra_info') 
&& action_history.editedItem.extra_info.post_type == 'quote_form_mr'">
    <h4 class="text-h5 text-center mt-n6">Modification requested: {{ action_history.editedItem.extra_info.post_content }}</h4>
    <v-timeline align-top :dense="$vuetify.breakpoint.smAndDown">
        <template v-for="(item, i) in action_history.detail_items">
            <template v-if="!parseInt(item.extra_info.meta_input.status)">
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