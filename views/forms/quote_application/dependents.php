<template>
  <v-form ref="dependent_information_form" v-model="dependents_information_valid" lazy-validation>
    <v-row class="mt-md-12 mt-lg-0">
      <v-col class="d-md-none" cols="8">
        <h3 class="text-center">DEPENDENTS</h3>
      </v-col>

      <v-col class="d-flex justify-end" cols="4" md="12">
        <v-btn color="primary" @click="addDependent" dark>ADD DEPENDENT<v-icon>mdi-plus</v-icon></v-btn>
      </v-col>
      <template v-for="(dependent, index) in form.content.dependents">
        <v-col cols="11">
          <h3>Dependent {{ index + 1 }}</h3>
        </v-col>
        <v-col cols="1">
          <v-btn color="error" @click="removeDependent(index)" dark><v-icon>mdi-trash-can</v-icon></v-btn>
        </v-col>
        <v-col cols="12">
          <v-select v-model="dependent.added" label="APPLICANT" :items="form.options.general"></v-select>
        </v-col>
        <v-col cols="12">
          <v-select v-model="dependent.gender" label="GENDER" :items="[{text: 'Male', value: 'M'},{text: 'Female', value: 'F'}]"></v-select>
        </v-col>
        <v-col cols="12" md="6">
          <v-dialog ref="dependent_dialog" v-model="form.dependent_birthdate_modal" persistent width="290px">
            <template v-slot:activator="{ on, attrs }">
              <v-text-field :value="getFormatDate(dependent.birthdate)" label="BIRTHDATE" prepend-icon="mdi-calendar" readonly v-bind="attrs" v-on="on" :rules="form.rules.required"></v-text-field>
            </template>
            <v-date-picker v-model="dependent.birthdate" scrollable>
              <v-spacer></v-spacer>
              <v-btn text color="primary" @click="form.dependent_birthdate_modal = false">
                Ok
              </v-btn>
            </v-date-picker>
          </v-dialog>
        </v-col>
        <v-col cols="12" md="6">
          <v-text-field v-model="dependent.first_name" label="FIRST NAME" :rules="form.rules.required"></v-text-field>
        </v-col>
        <v-col cols="12" md="6">
          <v-text-field v-model="dependent.last_name" label="LAST NAME" :rules="form.rules.required"></v-text-field>
        </v-col>
        <v-col cols="12" md="6">
          <v-select v-model="dependent.relative_selected" label="RELATIVE" :items="form.options.relative" :rules="form.rules.required" @change="inputRelative(dependent)"></v-select>
        </v-col>
        <v-col cols="12" md="6" v-if="dependent.relative_selected == 'Other'">
          <v-text-field v-model="dependent.relative" label="SPECIFY" :rules="form.rules.required"></v-text-field>
        </v-col>
        <v-col cols="12" md="6">
          <v-select v-model="dependent.is_citizen" label="CITIZEN" :items="form.options.general"></v-select>
        </v-col>
        <template>
          <v-col cols="12" md="6">
            <v-text-field v-model="dependent.ssn" label="SOCIAL SECURITY NUMBER (SSN)" maxlength="9" counter="9"></v-text-field>
          </v-col>
        </template>
        <template v-if="!dependent.is_citizen">
        <v-col cols="12" md="6">
          <v-select v-model="dependent.inmigration_status" label="INMIGRATION STATUS" :items="form.options.inmigration_status" @change="inputOtherIS(dependent.inmigration_status, dependent)" :rules="form.rules.required"></v-select>
        </v-col>
        <v-col cols="12" md="6" v-if="dependent.inmigration_status == 'OTHER'">
          <v-text-field v-model="dependent.inmigration_status_selected" label="SPECIFY" :rules="form.rules.required"></v-text-field>
        </v-col>
        <v-col cols="12" md="6">
          <v-text-field v-model="dependent.uscis_number" label="UCIS NUMBER" :rules="form.rules.ucis" prefix="A-" maxlength="9" counter="9"></v-text-field>
        </v-col>
        <v-col cols="12" md="6">
          <v-text-field v-model="dependent.card_number" label="CARD NUMBER" :rules="form.rules.card_number" maxlength="13" counter="13"></v-text-field>
        </v-col>
        <v-col cols="12" md="6">
          <v-text-field v-model="dependent.category" label="CATEGORY" :rules="form.rules.required"></v-text-field>
        </v-col>
        <v-col cols="12" md="6">
          <v-text-field v-model="dependent.document_from" label="DOCUMENT FROM"></v-text-field>
        </v-col>
        <v-col cols="12" md="6">
          <v-dialog ref="dependent_expires_dialog" v-model="form.dependent_expires_modal" persistent width="290px">
            <template v-slot:activator="{ on, attrs }">
              <v-text-field :value="getFormatDate(dependent.document_expires)" label="DOCUMENT EXPIRATION DATE" prepend-icon="mdi-calendar" readonly v-bind="attrs" v-on="on" :rules="form.rules.required" :rules="form.rules.required"></v-text-field>
            </template>
            <v-date-picker v-model="dependent.document_expires" scrollable>
              <v-spacer></v-spacer>
              <v-btn text color="primary" @click="form.dependent_expires_modal = false">
                Ok
              </v-btn>
            </v-date-picker>
          </v-dialog>
          
        </v-col>
        <v-col cols="12">
          <v-divider></v-divider>
        </v-col>
        </template>
      </template>
      <v-col class="d-flex justify-center" cols="12" v-if="form.content.dependents.length > 0">
        <v-btn color="primary" @click="addDependent" dark>ADD DEPENDENT<v-icon>mdi-plus</v-icon></v-btn>
      </v-col>
    </v-row>
  </v-form>
</template>
