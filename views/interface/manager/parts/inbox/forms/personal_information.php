<v-form ref="personal_information_form" v-model="personal_information_valid" lazy-validation>
    <v-row class="mt-md-12 mt-lg-0">
        <v-col cols="12">
            <h3 class="font-weight-bold primary--text">PERSONAL INFORMATION</h3>
        </v-col>
        <v-col cols="12">
            <v-select v-model="inbox.editedItem.personal_information.added" label="APPLICANT" :items="options.general">
            </v-select>
        </v-col>
        <v-col cols="12" md="6">
            <v-select v-model="inbox.editedItem.personal_information.gender" label="GENDER"
                :items="[{text: 'Male', value: 'M'},{text: 'Female', value: 'F'}]"></v-select>
        </v-col>
        <v-col cols="12" md="6">
            <v-select v-model="inbox.editedItem.personal_information.marital_status" label="MARITAL STATUS"
                :items="options.marital_status"></v-select>
        </v-col>
        <v-col cols="12" md="6">
            <v-dialog ref="personal_information_birthdate_dialog" v-model="personal_information_birthdate_modal"
                :return-value.sync="inbox.editedItem.personal_information.birthdate" width="300px">
                <template #activator="{ on, attrs }">
                    <v-text-field :value="getFormatDate(inbox.editedItem.personal_information.birthdate)"
                        label="Birthdate" prepend-icon="mdi-calendar" readonly v-bind="attrs" v-on="on"
                        :rules="rules.required"></v-text-field>
                </template>
                <v-date-picker v-model="inbox.editedItem.personal_information.birthdate" scrollable>
                    <v-spacer></v-spacer>
                    <v-btn text color="primary" @click="personal_information_birthdate_modal = false">
                        Cancel
                    </v-btn>
                    <v-btn text color="primary"
                        @click="$refs.personal_information_birthdate_dialog.save(inbox.editedItem.personal_information.birthdate);getAge('personal_information')">
                        OK
                    </v-btn>
                </v-date-picker>
            </v-dialog>
        </v-col>
        <v-col cols="12" md="6">
            <v-text-field v-model="inbox.editedItem.personal_information.age" label="AGE" :rules="rules.required"
                disabled></v-text-field>
        </v-col>
        <v-col cols="12" md="6">
            <v-text-field v-model="inbox.editedItem.personal_information.first_name" label="FIRST NAME"
                :rules="rules.required"></v-text-field>
        </v-col>
        <v-col cols="12" md="6">
            <v-text-field v-model="inbox.editedItem.personal_information.middle_name" label="MIDDLE NAME">
            </v-text-field>
        </v-col>
        <v-col cols="12" md="6">
            <v-text-field v-model="inbox.editedItem.personal_information.last_name" label="LAST NAME"
                :rules="rules.required"></v-text-field>
        </v-col>
        <v-col cols="12" md="6">
            <v-text-field v-model="inbox.editedItem.personal_information.email" label="EMAIL" :rules="rules.email">
            </v-text-field>
        </v-col>
        <v-col cols="12" md="6">
            <v-text-field type="tel" v-model="inbox.editedItem.personal_information.telephone" label="PHONE NUMBER">
            </v-text-field>
        </v-col>
        <v-col cols="12" md="6">
            <v-select v-model="inbox.editedItem.personal_information.is_citizen" label="CITIZEN"
                :items="options.general"></v-select>
        </v-col>
        <template>
            <v-col cols="12" md="6">
                <v-text-field v-model="inbox.editedItem.personal_information.ssn" label="SOCIAL SECURITY NUMBER (SSN)"
                    maxlength="9" counter="9"></v-text-field>
            </v-col>
        </template>
        <template v-if="!inbox.editedItem.personal_information.is_citizen">
            <v-col cols="12" md="6">
                <v-select v-model="inbox.editedItem.personal_information.inmigration_status" label="INMIGRATION STATUS"
                    :items="options.inmigration_status"
                    @change="inputOtherIS(inbox.editedItem.personal_information.inmigration_status, inbox.editedItem.personal_information)"
                    :rules="rules.required"></v-select>
            </v-col>
            <v-col cols="12" md="6" v-if="inbox.editedItem.personal_information.inmigration_status == 'OTHER'">
                <v-text-field v-model="inbox.editedItem.personal_information.inmigration_status_selected"
                    label="SPECIFY" :rules="rules.required"></v-text-field>
            </v-col>
            <v-col cols="12" md="6">
                <v-text-field v-model="inbox.editedItem.personal_information.uscis_number" label="UCIS NUMBER"
                    :rules="rules.ucis" prefix="A-" maxlength="9" counter="9"></v-text-field>
            </v-col>
            <v-col cols="12" md="6">
                <v-text-field v-model="inbox.editedItem.personal_information.card_number" label="CARD NUMBER"
                    :rules="rules.card_number" maxlength="13" counter="13"></v-text-field>
            </v-col>
            <v-col cols="12" md="6">
                <v-text-field v-model="inbox.editedItem.personal_information.category" label="CATEGORY"
                    :rules="rules.required"></v-text-field>
            </v-col>
            <v-col cols="12" md="6">
                <v-text-field v-model="inbox.editedItem.personal_information.document_from" label="DOCUMENT FROM">
                </v-text-field>
            </v-col>
            <v-col cols="12" md="6">
                <v-dialog ref="personal_information_document_expiration_dialog"
                    v-model="personal_information_document_expiration_modal" persistent width="290px">
                    <template #activator="{ on, attrs }">
                        <v-text-field :value="getFormatDate(inbox.editedItem.personal_information.document_expires)"
                            label="DOCUMENT EXPIRATION DATE" prepend-icon="mdi-calendar" readonly v-bind="attrs"
                            v-on="on"></v-text-field>
                    </template>
                    <v-date-picker v-model="inbox.editedItem.personal_information.document_expires" scrollable>
                        <v-spacer></v-spacer>
                        <v-btn text color="primary" @click="personal_information_document_expiration_modal = false">
                            Cancel
                        </v-btn>
                        <v-btn text color="primary"
                            @click="$refs.personal_information_document_expiration_dialog.save(inbox.editedItem.payment_information.card.expiration_date)">
                            OK
                        </v-btn>
                    </v-date-picker>
                </v-dialog>
            </v-col>
        </template>
        <v-col cols="12" md="6">
            <v-text-field v-model="inbox.editedItem.personal_information.address" label="ADDRESS"></v-text-field>
        </v-col>
        <v-col cols="12" md="6">
            <v-checkbox v-model="inbox.editedItem.personal_information.same_address" label="USE AS ADDRESS FOR MAILING"
                :true-value="1" :false-value="0"></v-checkbox>
        </v-col>
        <v-col cols="12" md="6">
            <v-text-field v-model="inbox.editedItem.personal_information.state" label="STATE" :rules="rules.required">
            </v-text-field>
        </v-col>
        <v-col cols="12" md="6">
            <v-select v-model="inbox.editedItem.personal_information.type" label="TYPE" :items="['HOUSE', 'APARTMENT']"
                :rules="rules.required"></v-select>
        </v-col>
        <v-col cols="12" md="6" v-if="inbox.editedItem.personal_information.type == 'APARTMENT'">
            <v-text-field v-model="inbox.editedItem.personal_information.apartment_number" label="APARTAMENT NUMBER"
                :rules="rules.required"></v-text-field>
        </v-col>
        <v-col cols="12" md="6">
            <v-text-field v-model="inbox.editedItem.personal_information.county" label="COUNTY" :rules="rules.required">
            </v-text-field>
        </v-col>
        <v-col cols="12" md="6">
            <v-text-field v-model="inbox.editedItem.personal_information.city" label="CITY" :rules="rules.required">
            </v-text-field>
        </v-col>
        <v-col cols="12" md="6">
            <v-text-field v-model="inbox.editedItem.personal_information.zip_code" label="ZIP CODE"
                :rules="rules.required"></v-text-field>
        </v-col>
        <v-col cols="12"
            v-if="inbox.editedItem.personal_information.hasOwnProperty('same_address') && !inbox.editedItem.personal_information.same_address">
            <v-row>
                <v-col cols="12">
                    <h4 class="text-h5">MAILING ADDRESS</h4>
                </v-col>
                <v-col cols="12" md="6">
                    <v-text-field v-model="inbox.editedItem.personal_information.mailing_address" label="ADDRESS">
                    </v-text-field>
                </v-col>
                <v-col cols="12" md="6">
                    <v-select v-model="inbox.editedItem.personal_information.mailing_type" label="TYPE"
                        :items="['HOUSE', 'APARTMENT']" :rules="rules.required"></v-select>
                </v-col>
                <v-col cols="12" md="6">
                    <v-text-field v-model="inbox.editedItem.personal_information.mailing_state" label="STATE"
                        :rules="rules.required"></v-text-field>
                </v-col>
                <v-col cols="12" md="6" v-if="inbox.editedItem.personal_information.mailing_type == 'APARTMENT'">
                    <v-text-field v-model="inbox.editedItem.personal_information.mailing_apartment_number"
                        label="APARTAMENT NUMBER" :rules="rules.required"></v-text-field>
                </v-col>
                <v-col cols="12" md="6">
                    <v-text-field v-model="inbox.editedItem.personal_information.mailing_county" label="COUNTY"
                        :rules="rules.required"></v-text-field>
                </v-col>
                <v-col cols="12" md="6">
                    <v-text-field v-model="inbox.editedItem.personal_information.mailing_city" label="CITY"
                        :rules="rules.required"></v-text-field>
                </v-col>
                <v-col cols="12" md="6">
                    <v-text-field v-model="inbox.editedItem.personal_information.mailing_zip_code" label="ZIP CODE"
                        :rules="rules.required"></v-text-field>
                </v-col>
            </v-row>
        </v-col>
        <v-col cols="12" md="6">
            <v-select v-model="inbox.editedItem.personal_information.birth_country" label="COUNTRY OF BIRTH"
                :items="countries" item-text="name" item-value="name"></v-select>
        </v-col>
    </v-row>
</v-form>
<v-col cols="12" class="px-0">
    <v-form ref="employment_information_form" v-model="employment_information_valid" lazy-validation>
        <v-row class="mt-md-12 mt-lg-0">
            <v-col cols="12">
                <h3 class="font-weight-bold">EMPLOYMENT INFORMATION</h3>
            </v-col>
            <v-col cols="12" md="6">
                <v-select v-model="inbox.editedItem.employment_information.work_type" label="TYPE OF WORK"
                    :items="options.work_type" :rules="rules.required"></v-select>
            </v-col>
            <template v-if="inbox.editedItem.employment_information.work_type == 'W2'">
                <v-col cols="12" md="6">
                    <v-text-field v-model="inbox.editedItem.employment_information.employer" label="COMPANY"
                        :rules="rules.required"></v-text-field>
                </v-col>
            </template>
            <v-col cols="12" md="6">
                <v-text-field type="text" v-model="inbox.editedItem.employment_information.income" label="INCOME"
                    prefix="$" :rules="rules.required"
                    @change="calcTotalIncome(); inbox.editedItem.employment_information.income = currencyFormat(inbox.editedItem.employment_information.income, false)">
                </v-text-field>
            </v-col>
            <v-col cols="12" md="6">
                <v-select v-model="inbox.editedItem.employment_information.payment_by" label="PAYMENT BY"
                    :items="options.payment_by" :rules="rules.required"></v-select>
            </v-col>
        </v-row>
    </v-form>

</v-col>
<v-col cols="12">
    <v-divider></v-divider>
</v-col>