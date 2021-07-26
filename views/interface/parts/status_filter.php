<v-row class="d-flex justify-center">
  <v-col class="d-flex jusitfy-center" cols="4" md="2">
    <v-chip class="ma-2" color="info" text-color="white" @click="quotes.search = ''">
      <v-avatar left class="grey lighten-1">
        {{ countStatus('') }}
      </v-avatar>
      All
    </v-chip>
  </v-col>
  <v-col class="d-flex jusitfy-center" cols="4" md="2">
    <v-chip class="ma-2" color="warning" text-color="white" @click="quotes.search = 'Processing'">
      <v-avatar left class="grey lighten-1">
        {{ countStatus('Processing') }}
      </v-avatar>
      Processing
    </v-chip>
  </v-col>
  <v-col class="d-flex jusitfy-center" cols="4" md="2">
    <v-chip class="ma-2" color="primary" text-color="white" @click="quotes.search = 'In Tray'">
      <v-avatar left class="grey lighten-1">
        {{ countStatus('In tray') }}
      </v-avatar>
      In Tray
    </v-chip>
  </v-col>
  <v-col class="d-flex jusitfy-center" cols="4" md="2">
    <v-chip class="ma-2" color="success" text-color="white" @click="quotes.search = 'Approved'">
      <v-avatar left class="grey lighten-1">
       {{ countStatus('Approved') }}
      </v-avatar>
      Approved
    </v-chip>
  </v-col>
</v-row>