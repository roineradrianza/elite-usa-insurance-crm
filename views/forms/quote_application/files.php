<template>
    <v-row class="mt-md-12 mt-lg-0">
        <v-col class="d-md-none" cols="12">
            <h3 class="text-center">FILES</h3>
        </v-col>
        <v-col class="px-3" cols="12" md="4" v-for="(document, index) in form.content.documents" :key="index">
            <v-row class="px-0 d-flex justify-end">
                <v-btn @click="form.content.documents.splice(index, 1)" fab text>
                    <v-icon color="error">mdi-close</v-icon>
                </v-btn>
            </v-row>
            <v-text-field v-if="undefined !== document.file" v-model="document.file.post_title"
                label="FILE NAME" class="mt-3 fl-text-input" filled dense></v-text-field>
            <v-file-input class="mt-3 fl-text-input"
                accept="image/*,.pdf,.doc,.docx,.xml,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document, xlsx, .xls, .txt"
                v-model="document.file" label="Select a file" prepend-icon="mdi-file-document" :clearable="false"
                show-size filled dense>
            </v-file-input>
            <v-textarea v-if="undefined !== document.file" v-model="document.file.post_content"
                label="NOTES" class="mt-3 fl-text-input" filled dense></v-textarea>
        </v-col>
        <v-col class="d-flex align-center" cols="12" md="4">
            <v-btn color="primary" @click="form.content.documents.push({file: undefined})" block dark>ADD FILE
            </v-btn>
        </v-col>
    </v-row>
</template>