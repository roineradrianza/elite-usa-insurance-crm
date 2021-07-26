<template v-if="form.content.dependents.length > 0 && form.content.affordable_care_act.coverage_type == 'FAMILY'">
  <v-col cols="12">
    <h3 class="font-weight-bold primary--text">DEPENDENTS</h3>
  </v-col>

  <template v-for="(dependent, index) in form.content.dependents">
    <v-col cols="12">
      <h4 class="font-weight-bold">Dependent {{ index + 1 }}</h4>
    </v-col>
    <v-col cols="12" md="6">
      <p class="font-weight-bold">APPLICANT: 
        <span class="font-weight-light">
          <template v-if="dependent.added">
            Yes
          </template>
          <template v-else>
            No
          </template>
        </span>
      </p>
    </v-col>
    <v-col cols="12" md="6">
      <p class="font-weight-bold">GENDER: 
        <span class="font-weight-light">
          <template v-if="dependent.gender == 'M'">
            Male
          </template>
          <template v-if="dependent.gender == 'F'">
            Female
          </template>
        </span>
      </p>
    </v-col>
    <v-col cols="12" md="6">
      <p class="font-weight-bold">BIRTHDATE: <span class="font-weight-light">{{ getFormatDate(dependent.birthdate) }}</span></p>
    </v-col>
    <v-col cols="12" md="6">
      <p class="font-weight-bold">FULL NAME: <span class="font-weight-light">{{ dependent.first_name }} {{ dependent.last_name }} </span></p>
    </v-col>
    <v-col cols="12" md="6" v-if="dependent.relative_selected == 'Other'">
      <p class="font-weight-bold">RELATIVE: <span class="font-weight-light">{{ dependent.relative }}</span></p>
    </v-col>
    <v-col cols="12" md="6">
      <p class="font-weight-bold">CITIZEN: 
        <span class="font-weight-light">
          <template v-if="dependent.is_citizen">
            YES
          </template>
          <template v-else>
            NO
          </template>
        </span>
      </p>
    </v-col>
    <template>
      <v-col cols="12" md="6">
        <p class="font-weight-bold">SOCIAL SECURITY NUMBER (SSN): <span class="font-weight-light">{{ dependent.ssn }}</span></p>
      </v-col>
    </template>
    <template v-if="!dependent.is_citizen">
    <v-col cols="12" md="6">
      <p class="font-weight-bold">INMIGRATION STATUS: <span class="font-weight-light">{{ dependent.inmigration_status_selected }}</span></p>
    </v-col>
    <v-col cols="12" md="6">
      <p class="font-weight-bold">UCIS NUMBER: <span class="font-weight-light" v-if="dependent.uscis_number != ''">A-{{ dependent.uscis_number }}</span></p>
    </v-col>
    <v-col cols="12" md="6">
      <p class="font-weight-bold">CARD NUMBER: <span class="font-weight-light">{{ dependent.card_number }}</span></p>
    </v-col>
    <v-col cols="12" md="6">
      <p class="font-weight-bold">CATEGORY: <span class="font-weight-light">{{ dependent.category }}</span></p>
    </v-col>
    <v-col cols="12" md="6">
      <p class="font-weight-bold">DOCUMENT FROM: <span class="font-weight-light">{{ dependent.document_from }}</span></p>
    </v-col>
    <v-col cols="12" md="6">
      <p class="font-weight-bold">DOCUMENT EXPIRATION DATE: <span class="font-weight-light">{{ getFormatDate(dependent.document_expires) }}</span></p>   
    </v-col>
    <v-col cols="12">
      <v-divider></v-divider>
    </v-col>
    </template>
  </template>
</template>
