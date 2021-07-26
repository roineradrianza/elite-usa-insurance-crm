<template>
  <v-form ref="employment_information_form" v-model="employment_information_valid" lazy-validation>
    <v-col cols="12">
      <v-divider></v-divider>
    </v-col>
    <v-col cols="12">
      <h3 class="text-center">EMPLOYMENT INFORMATION</h3>
    </v-col>
    <v-row class="mt-md-12 mt-lg-0">
      <v-col cols="12" md="6">
        <v-select v-model="form.content.employment_information.work_type" label="TYPE OF WORK" :items="form.options.work_type" :rules="form.rules.required"></v-select>
      </v-col>
      <template v-if="form.content.employment_information.work_type == 'W2'">
        <v-col cols="12" md="6" >
          <v-text-field v-model="form.content.employment_information.employer" label="COMPANY" :rules="form.rules.required"></v-text-field>
        </v-col>
      </template>
      <v-col cols="12" md="6">
        <v-text-field type="text" v-model="form.content.employment_information.income" label="INCOME" prefix="$" :rules="form.rules.required" @change="calcTotalIncome();form.content.employment_information.income = currencyFormat(form.content.employment_information.income, false)"></v-text-field>
      </v-col>
      <v-col cols="12" md="6">
        <v-select v-model="form.content.employment_information.payment_by" label="PAYMENT BY" :items="form.options.payment_by" :rules="form.rules.required"></v-select>
      </v-col>
  </v-form>
</template>
