<v-row class="d-flex align-center">
    <v-col class="d-flex justify-center" cols="12">
        <v-img src=" <?php echo RA_ELITE_USA_INSURANCE_URL ?>/assets/images/searching.svg" alt="not found image" max-width="550px"></v-img>
    </v-col>
    <v-col cols="12">
        <h4 class="text-h5 text-center">
            Any quote was found with the ID requested...
        </h4>
        
    </v-col>
    <v-col class="d-flex justify-center" cols="12">
        <v-btn color="primary" @click="not_quote_found = false">
            Create new quote
        </v-btn>
    </v-col>
</v-row>