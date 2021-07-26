<template>
  <v-col cols="12">
    <h3 class="font-weight-bold primary--text">PERSONAL INFORMATION</h3>
  </v-col>
  <v-col cols="12" md="6">
    <p class="font-weight-bold">APPLICANT: 
      <span class="font-weight-light">
        <template v-if="form.content.personal_information.added">
          Yes
        </template>
        <template v-else>
          No
        </template>
      </span>
    </p>
  </v-col>
  <v-col cols="12" md="6">
    <p class="font-weight-bold">TOTAL FAMILY INCOME: <span class="font-weight-light">{{ form.content.personal_information.total_income }}$</span></p>
  </v-col>
  <v-col cols="12" md="6">
    <p class="font-weight-bold">MARITAL STATUS: <span class="font-weight-light">{{ form.content.personal_information.marital_status }}</span></p>
  </v-col>
  <v-col cols="12" md="6">
    <p class="font-weight-bold">GENDER: 
      <span class="font-weight-light">
        <template v-if="form.content.personal_information.gender == 'M'">
          Male
        </template>
        <template v-if="form.content.personal_information.gender == 'F'">
          Female
        </template>
      </span>
    </p>
  </v-col>
  <v-col cols="12" md="6">
    <p class="font-weight-bold">BIRTHDATE: <span class="font-weight-light">{{ getFormatDate(form.content.personal_information.birthdate) }}</span></p>
  </v-col>
   <v-col cols="12" md="6">
    <p class="font-weight-bold">AGE: <span class="font-weight-light">{{ form.content.personal_information.age }}</span></p>
  </v-col>
  <v-col cols="12" md="6">
    <p class="font-weight-bold">FULL NAME: <span class="font-weight-light">{{ form.content.personal_information.first_name }} {{ form.content.personal_information.middle_name }} {{ form.content.personal_information.last_name }}</span></p>
  </v-col>
  <v-col cols="12" md="6">
    <p class="font-weight-bold">EMAIL: <span class="font-weight-light">{{ form.content.personal_information.email }}</span></p>
  </v-col>
  <v-col cols="12" md="6">
    <p class="font-weight-bold">PHONE NUMBER: <span class="font-weight-light">{{ form.content.personal_information.telephone }}</span></p>
  </v-col>
  <v-col cols="12" md="6">
    <p class="font-weight-bold">CITIZEN: 
      <span class="font-weight-light">
        <template v-if="form.content.personal_information.is_citizen">
          YES
        </template>
        <template v-else>
          NO
        </template>
      </span>
    </p>
  </v-col>
  <template v-if="form.content.personal_information.is_citizen">
    <v-col cols="12" md="6">
      <p class="font-weight-bold">SOCIAL SECURITY NUMBER (SSN): <span class="font-weight-light">{{ form.content.personal_information.ssn }}</span></p>
    </v-col>
  </template>
  <template v-else>
    <v-col cols="12" md="6">
      <p class="font-weight-bold">INMIGRATION STATUS: <span class="font-weight-light">{{ form.content.personal_information.inmigration_status_selected }}</span></p>
    </v-col>
    <v-col cols="12" md="6">
      <p class="font-weight-bold">UCIS NUMBER: <span class="font-weight-light" v-if="form.content.personal_information.uscis_number != ''">A-{{ form.content.personal_information.uscis_number }}</span></p>
    </v-col>
    <v-col cols="12" md="6">
      <p class="font-weight-bold">CARD NUMBER: <span class="font-weight-light">{{ form.content.personal_information.card_number }}</span></p>
    </v-col>
    <v-col cols="12" md="6">
      <p class="font-weight-bold">CATEGORY: <span class="font-weight-light">{{ form.content.personal_information.category }}</span></p>
    </v-col>
    <v-col cols="12" md="6">
      <p class="font-weight-bold">DOCUMENT FROM: <span class="font-weight-light">{{ form.content.personal_information.document_from }}</span></p>
    </v-col>
    <v-col cols="12" md="6">
      <p class="font-weight-bold">DOCUMENT EXPIRATION DATE: <span class="font-weight-light">{{ getFormatDate(form.content.personal_information.document_expires) }}</span></p>
    </v-col>
  </template>
  <v-col cols="12" md="6">
    <p class="font-weight-bold">ADDRESS: <span class="font-weight-light">{{ form.content.personal_information.address }}</span></p>
  </v-col>
  <v-col cols="12" md="6">
    <p class="font-weight-bold">TYPE: <span class="font-weight-light">{{ form.content.personal_information.type }}</span></p>
  </v-col>
  <v-col cols="12" md="6">
    <p class="font-weight-bold">STATE: <span class="font-weight-light">{{ form.content.personal_information.state }}</span></p>
  </v-col>
  <v-col cols="12" md="6" v-if="form.content.personal_information.type == 'APARTMENT'">
    <p class="font-weight-bold">APARTAMENT NUMBER: <span class="font-weight-light">{{ form.content.personal_information.apartment_number }}</span></p>
  </v-col>
  <v-col cols="12" md="6">
    <p class="font-weight-bold">COUNTY: <span class="font-weight-light">{{ form.content.personal_information.county }}</span></p>
  </v-col>
  <v-col cols="12" md="6">
    <p class="font-weight-bold">CITY: <span class="font-weight-light">{{ form.content.personal_information.city }}</span></p>
  </v-col>
  <v-col cols="12" md="6">
    <p class="font-weight-bold">ZIP CODE: <span class="font-weight-light">{{ form.content.personal_information.zip_code }}</span></p>
  </v-col>
  <v-col cols="12" md="6">
    <p class="font-weight-bold">COUNTRY OF BIRTH: <span class="font-weight-light">{{ form.content.personal_information.birth_country }}</span></p>
  </v-col>
  <v-col cols="12">
    <h3 class="font-weight-bold">EMPLOYMENT INFORMATION</h3>
  </v-col>
  <v-col cols="12" md="6">
    <p class="font-weight-bold">TYPE OF WORK: <span class="font-weight-light">{{ form.content.employment_information.work_type }}</span></p>
  </v-col>
  <template v-if="form.content.employment_information.work_type == 'W2'">
    <v-col cols="12" md="6">
      <p class="font-weight-bold">COMPANY: <span class="font-weight-light">{{ form.content.employment_information.employer }}</span></p>
    </v-col>
  </template>
  <v-col cols="12" md="6">
    <p class="font-weight-bold">INCOME: <span class="font-weight-light">{{ form.content.employment_information.income }}$</span></p>
  </v-col>
  <v-col cols="12" md="6">
    <p class="font-weight-bold">PAYMENT BY: <span class="font-weight-light">{{ form.content.employment_information.payment_by }}</span></p>
  </v-col>
  <v-col cols="12">
    <v-divider></v-divider>
  </v-col>
</template>
