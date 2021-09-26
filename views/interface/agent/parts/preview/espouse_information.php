  <template v-if="quotes.editedItem.affordable_care_act.coverage_type == 'FAMILY' && quotes.editedItem.personal_information.marital_status == 'MARRIED'">
    <v-col cols="12">
      <h3 class="font-weight-bold primary--text">SPOUSE INFORMATION</h3>
    </v-col>
    <v-col cols="12" md="6">
      <p class="font-weight-bold">APPLICANT: 
        <span class="font-weight-light">
          <template v-if="quotes.editedItem.espouse_information.added">
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
          <template v-if="quotes.editedItem.espouse_information.gender == 'M'">
            Male
          </template>
          <template v-if="quotes.editedItem.espouse_information.gender == 'F'">
            Female
          </template>
        </span>
      </p>
    </v-col>
    <v-col cols="12" md="6">
      <p class="font-weight-bold">BIRTHDATE: <span class="font-weight-light">{{  getFormatDate(quotes.editedItem.espouse_information.birthdate) }}</span></p>
    </v-col>
    <v-col cols="12" md="6">
      <p class="font-weight-bold">AGE: <span class="font-weight-light">{{ quotes.editedItem.espouse_information.age }}</span></p>
    </v-col>
    <v-col cols="12" md="6">
      <p class="font-weight-bold">FULL NAME: <span class="font-weight-light">{{ quotes.editedItem.espouse_information.first_name }} {{ quotes.editedItem.espouse_information.middle_name }} {{ quotes.editedItem.espouse_information.last_name }}</span></p>
    </v-col>
    <v-col cols="12" md="6">
      <p class="font-weight-bold">EMAIL: <span class="font-weight-light">{{ quotes.editedItem.espouse_information.email }}</span></p>
    </v-col>
    <v-col cols="12" md="6">
      <p class="font-weight-bold">PHONE NUMBER: <span class="font-weight-light">{{ quotes.editedItem.espouse_information.telephone }}</span></p>
    </v-col>
    <v-col cols="12" md="6">
      <p class="font-weight-bold">CITIZEN: <span class="font-weight-light">
        <span class="font-weight-light">
          <template v-if="quotes.editedItem.espouse_information.is_citizen">
            YES
          </template>
          <template v-else>
            NO
          </template>
          </span>
        </span>
      </p>
    </v-col>
    <template v-if="quotes.editedItem.espouse_information.is_citizen">
      <v-col cols="12" md="6">
        <p class="font-weight-bold">SOCIAL SECURITY NUMBER (SSN): <span class="font-weight-light">{{ quotes.editedItem.espouse_information.ssn }}</span></p>
      </v-col>
    </template>
    <template v-else>
    <v-col cols="12" md="6">
      <p class="font-weight-bold">INMIGRATION STATUS: <span class="font-weight-light">{{ quotes.editedItem.espouse_information.inmigration_status_selected }}</span></p>
    </v-col>
    <v-col cols="12" md="6">
      <p class="font-weight-bold">UCIS NUMBER: <span class="font-weight-light" v-if="quotes.editedItem.espouse_information.uscis_number != ''">A-{{ quotes.editedItem.espouse_information.uscis_number }}</span></p>
    </v-col>
    <v-col cols="12" md="6">
      <p class="font-weight-bold">CARD NUMBER: <span class="font-weight-light">{{ quotes.editedItem.espouse_information.card_number }}</span></p>
    </v-col>
    <v-col cols="12" md="6">
      <p class="font-weight-bold">CATEGORY: <span class="font-weight-light">{{ quotes.editedItem.espouse_information.category }}</span></p>
    </v-col>
    <v-col cols="12" md="6">
      <p class="font-weight-bold">DOCUMENT FROM: <span class="font-weight-light">{{ quotes.editedItem.espouse_information.document_from }}</span></p>
    </v-col>
    <v-col cols="12" md="6">
      <p class="font-weight-bold">DOCUMENT EXPIRATION DATE: <span class="font-weight-light">{{ getFormatDate(quotes.editedItem.espouse_information.document_expires) }}</span></p>
    </v-col>
    </template>
    <v-col cols="12" md="6">
      <p class="font-weight-bold">COUNTRY OF BIRTH: <span class="font-weight-light">{{ quotes.editedItem.espouse_information.birth_country }}</span></p>
    </v-col>
    <v-col cols="12">
      <h3 class="font-weight-bold">EMPLOYMENT INFORMATION</h3>
    </v-col>
    <v-col cols="12" md="6">
      <p class="font-weight-bold">EMPLOYED: 
        <span class="font-weight-light">
          <template v-if="quotes.editedItem.espouse_employment_information.is_employed">Yes</template>
          <template v-else>
            No
          </template>
        </span>
      </p>
    </v-col>
    <template v-if="quotes.editedItem.espouse_employment_information.is_employed">
      <v-col cols="12" md="6">
        <p class="font-weight-bold">TYPE OF WORK: <span class="font-weight-light">{{ quotes.editedItem.espouse_employment_information.work_type }}</span></p>
      </v-col>
      <template v-if="quotes.editedItem.espouse_employment_information.work_type == 'W2'">
        <v-col cols="12" md="6">
          <p class="font-weight-bold">COMPANY: <span class="font-weight-light">{{ quotes.editedItem.espouse_employment_information.employer }}</span></p>
        </v-col>
      </template>
      <v-col cols="12" md="6">
        <p class="font-weight-bold">INCOME: <span class="font-weight-light">{{ currencyFormat(quotes.editedItem.espouse_employment_information.income) }}</span></p>
      </v-col>
      <v-col cols="12" md="6">
        <p class="font-weight-bold">PAYMENT BY: <span class="font-weight-light">{{ quotes.editedItem.espouse_employment_information.payment_by }}</span></p>
      </v-col>
    </template>
    <v-col cols="12">
      <v-divider></v-divider>
    </v-col>
  </template>