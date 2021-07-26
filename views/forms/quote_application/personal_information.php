<template>
  <v-form ref="personal_information_form" v-model="personal_information_valid" lazy-validation>
    <v-row class="mt-md-12 mt-lg-0">
      <v-col class="d-md-none" cols="12">
        <h3 class="text-center">PERSONAL INFORMATION</h3>
      </v-col>
      <v-col cols="12">
        <v-select v-model="form.content.personal_information.added" label="APPLICANT" :items="form.options.general"></v-select>
      </v-col>
      <v-col cols="12" md="6">
        <v-select v-model="form.content.personal_information.gender" label="GENDER" :items="[{text: 'Male', value: 'M'},{text: 'Female', value: 'F'}]"></v-select>
      </v-col>
      <v-col cols="12" md="6">
        <v-select v-model="form.content.personal_information.marital_status" label="MARITAL STATUS" :items="form.options.marital_status"></v-select>
      </v-col>
      <v-col cols="12" md="6">
        <v-dialog ref="personal_information_birthdate_dialog" v-model="form.personal_information_birthdate_modal" :return-value.sync="form.content.personal_information.birthdate" width="300px">
          <template v-slot:activator="{ on, attrs }">
            <v-text-field :value="getFormatDate(form.content.personal_information.birthdate)" label="Birthdate" prepend-icon="mdi-calendar" readonly v-bind="attrs" v-on="on" :rules="form.rules.required"></v-text-field>
          </template>
          <v-date-picker v-model="form.content.personal_information.birthdate" scrollable>
            <v-spacer></v-spacer>
            <v-btn text color="primary" @click="form.personal_information_birthdate_modal = false">
              Cancel
            </v-btn>
            <v-btn text color="primary" @click="$refs.personal_information_birthdate_dialog.save(form.content.personal_information.birthdate);getAge('personal_information')">
              OK
            </v-btn>
          </v-date-picker>
        </v-dialog>
       </v-col>
       <v-col cols="12" md="6">
        <v-text-field v-model="form.content.personal_information.age" label="AGE" :rules="form.rules.required" disabled></v-text-field>
      </v-col>
      <v-col cols="12" md="6">
        <v-text-field v-model="form.content.personal_information.first_name" label="FIRST NAME" :rules="form.rules.required"></v-text-field>
      </v-col>
      <v-col cols="12" md="6">
        <v-text-field v-model="form.content.personal_information.middle_name" label="MIDDLE NAME"></v-text-field>
      </v-col>
      <v-col cols="12" md="6">
        <v-text-field v-model="form.content.personal_information.last_name" label="LAST NAME" :rules="form.rules.required"></v-text-field>
      </v-col>
      <v-col cols="12" md="6">
        <v-text-field v-model="form.content.personal_information.email" label="EMAIL" :rules="form.rules.email"></v-text-field>
      </v-col>
      <v-col cols="12" md="6">
        <v-text-field type="tel" v-model="form.content.personal_information.telephone" label="PHONE NUMBER"></v-text-field>
      </v-col>
      <v-col cols="12" md="6">
        <v-select v-model="form.content.personal_information.is_citizen" label="CITIZEN" :items="form.options.general"></v-select>
      </v-col>
      <template>
        <v-col cols="12" md="6">
          <v-text-field v-model="form.content.personal_information.ssn" label="SOCIAL SECURITY NUMBER (SSN)" maxlength="9" counter="9"></v-text-field>
        </v-col>
      </template>
      <template v-if="!form.content.personal_information.is_citizen">
        <v-col cols="12" md="6">
          <v-select v-model="form.content.personal_information.inmigration_status" label="INMIGRATION STATUS" :items="form.options.inmigration_status" @change="inputOtherIS(form.content.personal_information.inmigration_status, form.content.personal_information)" :rules="form.rules.required"></v-select>
        </v-col>
        <v-col cols="12" md="6" v-if="form.content.personal_information.inmigration_status == 'OTHER'">
          <v-text-field v-model="form.content.personal_information.inmigration_status_selected" label="SPECIFY" :rules="form.rules.required"></v-text-field>
        </v-col>
        <v-col cols="12" md="6">
          <v-text-field v-model="form.content.personal_information.uscis_number" label="UCIS NUMBER" :rules="form.rules.ucis" prefix="A-" maxlength="9" counter="9"></v-text-field>
        </v-col>
        <v-col cols="12" md="6">
          <v-text-field v-model="form.content.personal_information.card_number" label="CARD NUMBER" :rules="form.rules.card_number" maxlength="13" counter="13"></v-text-field>
        </v-col>
        <v-col cols="12" md="6">
          <v-text-field v-model="form.content.personal_information.category" label="CATEGORY"></v-text-field>
        </v-col>
        <v-col cols="12" md="6">
          <v-text-field v-model="form.content.personal_information.document_from" label="DOCUMENT FROM"></v-text-field>
        </v-col>
        <v-col cols="12" md="6">
          <v-dialog ref="personal_information_document_expiration_dialog" v-model="form.personal_information_document_expiration_modal" persistent width="290px">
            <template v-slot:activator="{ on, attrs }">
              <v-text-field :value="getFormatDate(form.content.personal_information.document_expires)" label="DOCUMENT EXPIRATION DATE" prepend-icon="mdi-calendar" readonly v-bind="attrs" v-on="on" :rules="form.rules.required"></v-text-field>
            </template>
            <v-date-picker v-model="form.content.personal_information.document_expires" scrollable>
              <v-spacer></v-spacer>
              <v-btn text color="primary" @click="form.personal_information_document_expiration_modal = false">
                Cancel
              </v-btn>
              <v-btn text color="primary" @click="$refs.personal_information_document_expiration_dialog.save(form.content.payment_information.card.expiration_date)">
                OK
              </v-btn>
            </v-date-picker>
          </v-dialog>
        </v-col>
      </template>
      <v-col cols="12" md="6">
        <v-text-field v-model="form.content.personal_information.address" label="ADDRESS"></v-text-field>
      </v-col>
      <v-col cols="12" md="6">
        <v-select v-model="form.content.personal_information.type" label="TYPE" :items="['HOUSE', 'APARTMENT']" :rules="form.rules.required"></v-select>
      </v-col>
      <v-col cols="12" md="6">
        <v-text-field v-model="form.content.personal_information.state" label="STATE" :rules="form.rules.required"></v-text-field>
      </v-col>
      <v-col cols="12" md="6" v-if="form.content.personal_information.type == 'APARTMENT'">
        <v-text-field v-model="form.content.personal_information.apartment_number" label="APARTAMENT NUMBER" :rules="form.rules.required"></v-text-field>
      </v-col>
      <v-col cols="12" md="6">
        <v-text-field v-model="form.content.personal_information.county" label="COUNTY" :rules="form.rules.required"></v-text-field>
      </v-col>
      <v-col cols="12" md="6">
        <v-text-field v-model="form.content.personal_information.city" label="CITY" :rules="form.rules.required"></v-text-field>
      </v-col>
      <v-col cols="12" md="6">
        <v-text-field v-model="form.content.personal_information.zip_code" label="ZIP CODE" :rules="form.rules.required"></v-text-field>
      </v-col>
      <v-col cols="12" md="6">
        <v-select v-model="form.content.personal_information.birth_country" label="COUNTRY OF BIRTH" :items="countries" item-text="name" item-value="name"></v-select>
      </v-col>
    </v-row>
  </v-form>
</template>
