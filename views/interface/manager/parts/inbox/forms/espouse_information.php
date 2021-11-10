<v-form ref="espouse_information_form" v-model="espouse_information_valid" 
v-if="inbox.editedItem.affordable_care_act.coverage_type == 'FAMILY' && inbox.editedItem.personal_information.marital_status == 'MARRIED'" lazy-validation>
  <v-row class="mt-md-12 mt-lg-0">
    <v-col cols="12">
      <h3 class="font-weight-bold primary--text">SPOUSE INFORMATION</h3>
    </v-col>
    <v-col cols="12">
      <v-select v-model="inbox.editedItem.espouse_information.added" label="APPLICANT" :items="options.general"></v-select>
    </v-col>
    <v-col cols="12" md="6">
      <v-select v-model="inbox.editedItem.espouse_information.gender" label="GENDER" :items="[{text: 'Male', value: 'M'},{text: 'Female', value: 'F'}]"></v-select>
    </v-col>
    <v-col cols="12" md="6">
      <v-dialog ref="espouse_information_birthdate_dialog" v-model="espouse_information_birthdate_modal" :return-value.sync="inbox.editedItem.espouse_information.birthdate" persistent width="290px">
        <template v-slot:activator="{ on, attrs }">
          <v-text-field :value="getFormatDate(inbox.editedItem.espouse_information.birthdate)" label="Birthdate" prepend-icon="mdi-calendar" readonly v-bind="attrs" v-on="on" :rules="rules.required"></v-text-field>
        </template>
        <v-date-picker v-model="inbox.editedItem.espouse_information.birthdate" scrollable>
          <v-spacer></v-spacer>
          <v-btn text color="primary" @click="espouse_information_birthdate_modal = false">
            Cancel
          </v-btn>
          <v-btn text color="primary" @click="$refs.espouse_information_birthdate_dialog.save(inbox.editedItem.espouse_information.birthdate);getAge('espouse_information')">
            OK
          </v-btn>
        </v-date-picker>
      </v-dialog>
    </v-col>
    <v-col cols="12" md="6">
      <v-text-field v-model="inbox.editedItem.espouse_information.age" label="AGE" :rules="rules.required" disabled></v-text-field>
    </v-col>
    <v-col cols="12" md="6">
      <v-text-field v-model="inbox.editedItem.espouse_information.first_name" label="FIRST NAME" :rules="rules.required"></v-text-field>
    </v-col>
    <v-col cols="12" md="6">
      <v-text-field v-model="inbox.editedItem.espouse_information.middle_name" label="MIDDLE NAME"></v-text-field>
    </v-col>
    <v-col cols="12" md="6">
      <v-text-field v-model="inbox.editedItem.espouse_information.last_name" label="LAST NAME" :rules="rules.required"></v-text-field>
    </v-col>
    <v-col cols="12" md="6">
      <v-text-field v-model="inbox.editedItem.espouse_information.email" label="EMAIL"></v-text-field>
    </v-col>
    <v-col cols="12" md="6">
      <v-text-field type="tel" v-model="inbox.editedItem.espouse_information.telephone" label="PHONE NUMBER"></v-text-field>
    </v-col>
    <v-col cols="12" md="6">
      <v-select v-model="inbox.editedItem.espouse_information.is_citizen" label="CITIZEN" :items="options.general"></v-select>
    </v-col>
    <template>
      <v-col cols="12" md="6">
        <v-text-field v-model="inbox.editedItem.espouse_information.ssn" label="SOCIAL SECURITY NUMBER (SSN)" maxlength="9" counter="9"></v-text-field>
      </v-col>
    </template>
    <template v-if="!inbox.editedItem.espouse_information.is_citizen">
      <v-col cols="12" md="6">
        <v-select v-model="inbox.editedItem.espouse_information.inmigration_status" label="INMIGRATION STATUS" :items="options.inmigration_status" @change="inputOtherIS(inbox.editedItem.espouse_information.inmigration_status, inbox.editedItem.espouse_information)" :rules="rules.required"></v-select>
      </v-col>
      <v-col cols="12" md="6" v-if="inbox.editedItem.espouse_information.inmigration_status == 'OTHER'">
        <v-text-field v-model="inbox.editedItem.espouse_information.inmigration_status_selected" label="SPECIFY" :rules="rules.required"></v-text-field>
      </v-col>
      <v-col cols="12" md="6">
        <v-text-field v-model="inbox.editedItem.espouse_information.uscis_number" label="UCIS NUMBER" :rules="rules.ucis" prefix="A-" maxlength="9" counter="9"></v-text-field>
      </v-col>
      <v-col cols="12" md="6">
        <v-text-field v-model="inbox.editedItem.espouse_information.card_number" label="CARD NUMBER" :rules="rules.card_number" maxlength="13" counter="13"></v-text-field>
      </v-col>
      <v-col cols="12" md="6">
        <v-text-field v-model="inbox.editedItem.espouse_information.category" label="CATEGORY"></v-text-field>
      </v-col>
      <v-col cols="12" md="6">
        <v-text-field v-model="inbox.editedItem.espouse_information.document_from" label="DOCUMENT FROM"></v-text-field>
      </v-col>
      <v-col cols="12" md="6">
        <v-dialog ref="espouse_information_document_expiration_dialog" v-model="espouse_information_document_expiration_modal" persistent width="290px">
          <template v-slot:activator="{ on, attrs }">
            <v-text-field :value="getFormatDate(inbox.editedItem.espouse_information.document_expires)" label="DOCUMENT EXPIRATION DATE" prepend-icon="mdi-calendar" 
            readonly v-bind="attrs" v-on="on"></v-text-field>
          </template>
          <v-date-picker v-model="inbox.editedItem.espouse_information.document_expires" scrollable>
            <v-spacer></v-spacer>
            <v-btn text color="primary" @click="espouse_information_document_expiration_modal = false">
              Cancel
            </v-btn>
            <v-btn text color="primary" @click="$refs.espouse_information_document_expiration_dialog.save(inbox.editedItem.espouse_information.document_expires)">
              OK
            </v-btn>
          </v-date-picker>
        </v-dialog>
      </v-col>
    </template>
    <v-col cols="12" md="6">
      <v-select v-model="inbox.editedItem.espouse_information.birth_country" label="COUNTRY OF BIRTH" :items="countries" item-text="name" item-value="name"></v-select>
    </v-col>
    <v-col cols="12">
      <v-form ref="espouse_employment_information_form" v-model="espouse_employment_information_valid" lazy-validation>
        <v-row class="mt-md-12 mt-lg-0">
          <v-col cols="12">
            <h3 class="font-weight-bold">EMPLOYMENT INFORMATION</h3>
          </v-col>
          <v-col cols="12" md="6">
            <v-select v-model="inbox.editedItem.espouse_employment_information.is_employed" label="IS EMPLOYED?" :items="options.general"></v-select>
          </v-col>
          <template v-if="inbox.editedItem.espouse_employment_information.is_employed">
            <v-col cols="12" md="6">
              <v-select v-model="inbox.editedItem.espouse_employment_information.work_type" label="TYPE OF WORK" :items="options.work_type" :rules="rules.required"></v-select>
            </v-col>
            <template v-if="inbox.editedItem.espouse_employment_information.work_type == 'W2'">
              <v-col cols="12" md="6">
                <v-text-field v-model="inbox.editedItem.espouse_employment_information.employer" label="COMPANY" :rules="rules.required"></v-text-field>
              </v-col>
            </template>
            <v-col cols="12" md="6">
              <v-text-field type="text" v-model="inbox.editedItem.espouse_employment_information.income" label="INCOME" prefix="$" :rules="rules.required" @change="calcTotalIncome();inbox.editedItem.espouse_employment_information.income = currencyFormat(inbox.editedItem.espouse_employment_information.income, false)"></v-text-field>
            </v-col>
            <v-col cols="12" md="6">
              <v-select v-model="inbox.editedItem.espouse_employment_information.payment_by" label="PAYMENT BY" :items="options.payment_by" :rules="rules.required"></v-select>
            </v-col>
          </template>
      </v-form>
      
    </v-col>

  </v-row>
</v-form>
<v-col cols="12" v-if="inbox.editedItem.affordable_care_act.coverage_type == 'FAMILY'">
  <v-divider></v-divider>
</v-col>