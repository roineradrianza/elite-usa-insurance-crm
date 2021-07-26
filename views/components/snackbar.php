   <v-snackbar v-model="barAlert" :timeout="barTimeout" style="z-index: 1000000;">
      {{ barMessage }}
      <template v-slot:action="{ attrs }">
        <v-btn color="secondary" text v-bind="attrs" @click="barAlert = false">
          Close
        </v-btn>
      </template>
    </v-snackbar>