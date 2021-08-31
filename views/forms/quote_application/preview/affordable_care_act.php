<template>
  <v-col cols="12">
    <h3 class="font-weight-bold primary--text">AFFORDABLE CARE ACT</h3>
  </v-col>
  <v-col cols="12" md="6" lg="4">
    <p class="font-weight-bold">CLIENT TYPE: <span class="font-weight-light">{{ form.content.affordable_care_act.client_type }}</span></p>
  </v-col>
  <v-col cols="12" md="6" lg="4">
    <p class="font-weight-bold">DATE OF EFFECTIVENESS: <span class="font-weight-light">{{ getFormatDate(form.content.affordable_care_act.effectiveness_date) }}</span></p>
  </v-col>
  <v-col cols="12" md="6" lg="4">
    <p class="font-weight-bold">COMPANY / PLAN: <span class="font-weight-light">{{ form.content.affordable_care_act.company_plan }}</span></p>
  </v-col>
  <v-col cols="12" md="6" lg="4">
    <p class="font-weight-bold">PLAN: <span class="font-weight-light">{{ form.content.affordable_care_act.plan }}</span></p>
  </v-col>
  <v-col cols="12" md="6" lg="4">
    <p class="font-weight-bold">PREMIUM: <span class="font-weight-light">${{ form.content.affordable_care_act.premium }}</span></p>
  </v-col>
  <v-col cols="12" md="6" lg="4">
    <p class="font-weight-bold">DEDUCTIBLE: <span class="font-weight-light">${{ form.content.affordable_care_act.deductible }}</span></p>
  </v-col>
  <v-col cols="12" md="6" lg="4">
    <p class="font-weight-bold">Maximum Out Of Pocket: <span class="font-weight-light">${{ form.content.affordable_care_act.moop }}</span></p>
  </v-col>
  <v-col cols="12" md="6" lg="4">
    <p class="font-weight-bold">AGENT NAME: <span class="font-weight-light">{{ form.content.affordable_care_act.agent_name }}</span></p>
  </v-col>
  <v-col cols="12" md="6" lg="4">
    <p class="font-weight-bold">COVERAGE TYPE: <span class="font-weight-light">{{ form.content.affordable_care_act.coverage_type }}</span></p>
  </v-col>
  <v-col cols="12" md="6" lg="4">
    <p class="font-weight-bold">NUMBER OF MEMBERS ON COVERAGE: <span class="font-weight-light">{{ form.content.affordable_care_act.coverage_nro_members }}</span></p>
  </v-col>
  <v-col cols="12" md="6" lg="4">
    <p class="font-weight-bold">DATE : <span class="font-weight-light">{{ getFormatDateExtended(form.content.affordable_care_act.date) }}</span></p>
  </v-col>
  <v-col cols="12" md="6" lg="4">
    <p class="font-weight-bold">MONTLY SUBSIDY / MONTHLY FISCAL CREDIT: <span class="font-weight-light">${{ form.content.affordable_care_act.mfc }}</span></p>
  </v-col>
  <v-col cols="12">
    <v-divider></v-divider>  
  </v-col>
</template>
