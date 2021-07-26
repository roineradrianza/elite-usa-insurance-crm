<v-col cols="12">
  THE FOLLOWING STATEMENT MUST BE TOTALLY COMPLETED BY THE AGENT
  <ol>
    <li>Has the applicant listed above pled guilty or no contendere to or been guilty of a felony or a crime involving moral turpitude since qualifying for this appointment?
    <v-radio-group class="mb-n5" v-model="form.introduction.crime_involving.apply" :rules="rules.required" row>
      <v-radio label="No" value="0"></v-radio>
      <v-radio label="Yes" value="1"></v-radio>
    </v-radio-group>
    <br>
    <v-textarea v-model="form.introduction.license_suspended.explanation" v-if="parseInt(form.introduction.crime_involving.apply)" label='If "Yes", please explain' :rules="rules.required" rows="1" auto-grow outlined></v-textarea>
    </li>
    <li>
      Has your license ever been suspended or revoked?
      <v-radio-group class="mb-n5" v-model="form.introduction.license_suspended.apply" :rules="rules.required" row>
      <v-radio label="No" value="0"></v-radio>
      <v-radio label="Yes" value="1"></v-radio>
    </v-radio-group>
    <br>
    <v-textarea v-model="form.introduction.license_suspended.explanation" v-if="parseInt(form.introduction.license_suspended.apply)" label='If "Yes", please explain' :rules="rules.required" rows="1" auto-grow outlined></v-textarea>
    </li>
  </ol>
</v-col>

<v-col cols="12">
  Through the following document I completely understand that, if I’m eligible to appointed with Elite USA Insurance, I will be consider an independent contractor and I am not an employee and I represent the buyer and these documents will be part of my file with Elite USA Insurance.  
</v-col>

<v-col cols="12">
  <h4 class="text-h5 primary--text">COMMISIONS</h4>
  Elite USA Insurance will only pay commission on qualified enrollments. Qualified is defined as an enrollment for which an enrollment application has been reviewed and validated by Elite USA Insurance and approved and confirmed by CMS.
  The following commission rates will be paid depending on state and company based on the commissions update each company provides on each enrollment period.
</v-col>

<v-col cols="12">
  <h4 class="text-h5 primary--text">AGREEMENT</h4>
 <span class="font-weight-bold">{{ form.first_name + ' ' + form.last_name }}</span> ("Agent"), agrees to be bound by all the provisions of this Agency Agreement from this date <span class="font-weight-bold">{{ getcustomDateFormat(form.date, 'LL') }}</span>.
By executing this Agreement, the agent hereby acknowledges that has read the terms and conditions of the Agreement and agrees to, and shall, be bound, and abide, by all terms, conditions, contractors and obligations applicable to Agents under the Agreement as of the date set forth below. In addition, Elite USA Insurance assumes full responsibility for the specific Agent mentioned herein and all responsibilities assumed by this Agent mentioned within the Agreement. 
The agent also certifies that will immediately notify if for any reason no longer satisfies all the requirements to be an Agent, or if the representations in this agreement are no longer true. In case the agent does not longer satisfied these requirements by law to be an agent this will result on the termination of any compensation payable to the Agent.
  <v-row>
    <v-col cols="6" md="4">
      <v-text-field :value="getFormatDate(form.date)" label="Date"  :rules="rules.required"readonly></v-text-field>
    </v-col>
    <v-col cols="6" md="4">
      <v-text-field v-model="form.agreement.license_number" label="License Number" :rules="rules.required"></v-text-field>
    </v-col>
  </v-row> 
</v-col>