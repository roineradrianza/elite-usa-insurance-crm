<v-col cols="6" md="4">
  <v-text-field v-model="form.first_name" label="First Name" :rules="rules.required"></v-text-field>
</v-col>
<v-col cols="6" md="4">
  <v-text-field v-model="form.last_name" label="Last Name" :rules="rules.required"></v-text-field>
</v-col>
<v-col cols="6" md="4">
  <v-text-field v-model="form.ssn" label="S.S.N" :rules="rules.required" maxlength="9" counter="9"></v-text-field>
</v-col>
<v-col cols="6" md="4">
  <v-dialog ref="birthdate_dialog" v-model="modals.birthdate" :rules="rules.required" :return-value.sync="form.birthdate" width="300px">
    <template v-slot:activator="{ on, attrs }">
      <v-text-field :value="getFormatDate(form.birthdate)" label="Date of Birth" prepend-icon="mdi-calendar" label="Birthdate" :rules="rules.required" readonly v-bind="attrs" v-on="on" :rules="rules.required"></v-text-field>
    </template>
    <v-date-picker v-model="form.birthdate" scrollable>
      <v-spacer></v-spacer>
      <v-btn text color="primary" @click="modals.birthdate = false">
        Cancel
      </v-btn>
      <v-btn text color="primary" @click="$refs.birthdate_dialog.save(form.birthdate);">
        OK
      </v-btn>
    </v-date-picker>
  </v-dialog>
</v-col>
<v-col cols="6" md="8">
  <v-text-field v-model="form.license_number" label="Independent or Agency Health License Number" :rules="rules.required"></v-text-field>
</v-col>
<v-col cols="6" md="4">
  <v-text-field v-model="form.address" label="Address" :rules="rules.required"></v-text-field>
</v-col>
<v-col cols="6" md="4">
  <v-text-field v-model="form.city" label="City" :rules="rules.required"></v-text-field>
</v-col>
<v-col cols="6" md="4">
  <v-text-field v-model="form.state" label="State" :rules="rules.required"></v-text-field>
</v-col>
<v-col cols="6" md="4">
  <v-text-field v-model="form.zip_code" label="Zip Code" :rules="rules.required"></v-text-field>
</v-col>
<v-col cols="6" md="4">
  <v-text-field v-model="form.phone_number" label="Phone Number" :rules="rules.required"></v-text-field>
</v-col>
<v-col cols="6" md="4">
  <v-text-field v-model="form.email" label="Personal Email" :rules="rules.email"></v-text-field>
</v-col>