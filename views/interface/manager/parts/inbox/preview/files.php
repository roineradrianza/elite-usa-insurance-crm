<template
    v-if="inbox.editedItem.affordable_care_act.hasOwnProperty('additional_notes') && inbox.editedItem.affordable_care_act.additional_notes != ''">
    <v-col cols="12">
        <h3 class="font-weight-bold primary--text">ADDITIONAL NOTES</h3>
    </v-col>
    <v-col cols="12">
        {{ inbox.editedItem.affordable_care_act.additional_notes }}
    </v-col>
</template>
<template v-if="inbox.editedItem.documents !== null">
    <template v-if="inbox.editedItem.documents.length > 0">
        <v-col cols="12">
            <h3 class="font-weight-bold primary--text">FILES</h3>
        </v-col>
        <template v-for="(document, index) in inbox.editedItem.documents">
            <v-col class="px-3 d-flex" cols="6" md="4" lg="3" :key="index">
                <v-card class="mx-auto flex-grow-1">
                    <v-card-text>
                        <template v-if="document.post_title != ''">
                            <div>FILE NAME</div>
                            <p class="text-h4 text--primary mb-n4">
                                {{ document.post_title }}
                            </p>
                        </template>
                        <template v-if="document.post_content != ''">
                            <p>NOTES</p>
                            <div class="text--primary">
                                {{ document.post_content }}
                            </div>
                        </template>
                    </v-card-text>
                    <v-card-actions>
                        <v-btn text :href="document.url" color="primary" download>
                            Download
                        </v-btn>
                    </v-card-actions>
                </v-card>
            </v-col>
        </template>
    </template>
</template>