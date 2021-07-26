
<template>
  <v-form ref="affordable_care_act_form" v-model="affordable_care_act_valid" lazy-validation>
    <v-row class="mt-md-12 mt-lg-0">
      <v-col cols="12">
        <h3 class="font-weight-bold primary--text">AFFORDABLE CARE ACT</h3>
      </v-col>
      <v-col cols="12" md="6">
        <v-select
          v-model="quotes.editedItem.affordable_care_act.client_type" :items="['NEW', 'EXISTENT']" label="CLIENT TYPE" :rules="rules.required"></v-select>
      </v-col>
      <v-col cols="12" md="6">
        <v-dialog ref="affordable_care_act_effectiveness_date_dialog" v-model="affordable_care_act_effectiveness_date_modal" :return-value.sync="quotes.editedItem.affordable_care_act.effectiveness_date" width="300px">
          <template v-slot:activator="{ on, attrs }">
            <v-text-field :value="getFormatDate(quotes.editedItem.affordable_care_act.effectiveness_date)" label="DATE OF EFFECTIVENESS" prepend-icon="mdi-calendar" readonly v-bind="attrs" v-on="on" :rules="rules.required"></v-text-field>
          </template>
          <v-date-picker v-model="quotes.editedItem.affordable_care_act.effectiveness_date" scrollable>
            <v-spacer></v-spacer>
            <v-btn text color="primary" @click="form.affordable_care_act_effectiveness_date_modal = false">
              Cancel
            </v-btn>
            <v-btn text color="primary" @click="$refs.affordable_care_act_effectiveness_date_dialog.save(quotes.editedItem.affordable_care_act.effectiveness_date)">
              OK
            </v-btn>
          </v-date-picker>
        </v-dialog>
      </v-col>
      <v-col cols="12" md="6">
        <v-text-field type="text" v-model="quotes.editedItem.affordable_care_act.mfc" label="MONTLY SUBSIDY / MONTHLY FISCAL CREDIT" prefix="$" @change="quotes.editedItem.affordable_care_act.mfc = currencyFormat(quotes.editedItem.affordable_care_act.mfc, false)"></v-text-field>
      </v-col>
      <v-col cols="12" md="6">
        <v-text-field
          v-model="quotes.editedItem.affordable_care_act.company_plan" label="COMPANY / PLAN" :rules="rules.required"></v-text-field>
      </v-col>
      <v-col cols="12" md="6">
        <v-text-field type="text" v-model="quotes.editedItem.affordable_care_act.premium" label="PREMIUM" prefix="$" @change="quotes.editedItem.affordable_care_act.premium = currencyFormat(quotes.editedItem.affordable_care_act.premium, false)" :rules="rules.required"></v-text-field>
      </v-col>
      <v-col cols="12" md="6">
        <v-text-field type="text" v-model="quotes.editedItem.affordable_care_act.deductible" label="DEDUCTIBLE" prefix="$" @change="quotes.editedItem.affordable_care_act.deductible = currencyFormat(quotes.editedItem.affordable_care_act.deductible, false)" :rules="rules.required"></v-text-field>
      </v-col>
      <v-col cols="12" md="6">
        <v-text-field type="text" v-model="quotes.editedItem.affordable_care_act.moop" label="MOOP" prefix="$" :rules="rules.required" @change="quotes.editedItem.affordable_care_act.moop = currencyFormat(quotes.editedItem.affordable_care_act.moop, false)"></v-text-field>
      </v-col>
      <v-col cols="12" md="6">
        <v-text-field v-model="quotes.editedItem.affordable_care_act.agent_name" label="AGENT NAME" :rules="rules.required" disabled></v-text-field>
      </v-col>
      <v-col cols="12" md="6">
        <v-select v-model="quotes.editedItem.affordable_care_act.coverage_type" label="COVERAGE TYPE" :items="options.coverage_type"></v-select>
      </v-col>
      <v-col cols="12" md="6">
        <v-text-field type="number" v-model="quotes.editedItem.affordable_care_act.coverage_nro_members" label="NUMBER OF MEMBERS ON COVERAGE" :rules="rules.required"></v-text-field>
      </v-col>
      <v-col cols="12" md="6">
        <v-text-field :value="getFormatDateExtended(quotes.editedItem.affordable_care_act.date)" label="DATE" :rules="rules.required" readonly></v-text-field>
      </v-col>
    </v-row>
  </v-form>
</template>


