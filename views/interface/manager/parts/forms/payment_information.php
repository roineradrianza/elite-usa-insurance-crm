<v-form ref="payment_information_form" v-model="payment_information_valid" lazy-validation>
    <v-row class="mt-md-12 mt-lg-0">
        <v-col cols="12">
            <h3 class="font-weight-bold primary--text">PAYMENT INFORMATION</h3>
        </v-col>
        <v-col cols="10" :md="quotes.editedItem.payment_information.type == '' ? 10 : 4">
            <v-select v-model="quotes.editedItem.payment_information.type" label="PAYMENT TYPE"
                :items="options.payment_type"></v-select>
        </v-col>
        <template v-if="quotes.editedItem.payment_information.type != ''">
            <v-col cols="2" v-if="quotes.editedItem.payment_information.type != ''">
                <v-checkbox v-model="quotes.editedItem.payment_information.autopay" label="AUTOPAY" :true-value="1"
                    :false-value="0"></v-checkbox>
            </v-col>
            <v-col cols="12" md="6" v-if="quotes.editedItem.payment_information.autopay">
                <v-dialog ref="autopay_date_dialog" v-model="autopay_date_modal"
                    :return-value.sync="quotes.editedItem.payment_information.autopay_date" persistent width="290px">
                    <template #activator="{ on, attrs }">
                        <v-text-field :value="getFormatDate(quotes.editedItem.payment_information.autopay_date)"
                            label="PAYMENT DATE" prepend-icon="mdi-calendar" readonly v-bind="attrs" v-on="on">
                        </v-text-field>
                    </template>
                    <v-date-picker v-model="quotes.editedItem.payment_information.autopay_date" scrollable>
                        <v-spacer></v-spacer>
                        <v-btn text color="primary" @click="autopay_date_modal = false">
                            Cancel
                        </v-btn>
                        <v-btn text color="primary"
                            @click="$refs.autopay_date_dialog.save(quotes.editedItem.payment_information.autopay_date)">
                            OK
                        </v-btn>
                    </v-date-picker>
                </v-dialog>
            </v-col>
        </template>
        <template v-if="quotes.editedItem.payment_information.type == 'BANK ACCOUNT'">
            <v-col cols="12" md="6">
                <v-select v-model="quotes.editedItem.payment_information.bank.type" label="ACCOUNT TYPE"
                    :items="options.account_type"></v-select>
            </v-col>
            <v-col cols="12" md="6">
                <v-text-field v-model="quotes.editedItem.payment_information.bank.name" label="BANK NAME"
                    :rules="rules.required"></v-text-field>
            </v-col>
            <v-col cols="12" md="6">
                <v-text-field v-model="quotes.editedItem.payment_information.bank.owner_name" label="NAME ON ACCOUNT"
                    :rules="rules.required"></v-text-field>
            </v-col>
            <v-col cols="12" md="6">
                <v-text-field v-model="quotes.editedItem.payment_information.bank.routing_number" label="ROUTING NUMBER"
                    :rules="rules.required"></v-text-field>
            </v-col>
            <v-col cols="12" md="6">
                <v-text-field v-model="quotes.editedItem.payment_information.bank.account_number" label="ACCOUNT NUMBER"
                    :rules="rules.required"></v-text-field>
            </v-col>
            <v-col cols="12" md="6">
                <v-text-field v-model="quotes.editedItem.payment_information.bank.city" label="CITY"></v-text-field>
            </v-col>
            <v-col cols="12" md="6">
                <v-text-field v-model="quotes.editedItem.payment_information.bank.estate" label="ESTATE"></v-text-field>
            </v-col>
        </template>
        <template v-if="quotes.editedItem.payment_information.type == 'CREDIT OR DEBIT CARD'">
            <v-col cols="12" md="6">
                <v-text-field v-model="quotes.editedItem.payment_information.card.name" label="NAME ON CARD"
                    :rules="rules.required"></v-text-field>
            </v-col>
            <v-col cols="12" md="3">
                <v-select v-model="quotes.editedItem.payment_information.card.type" label="TYPE"
                    :items="options.cards_type"></v-select>
            </v-col>
            <v-col cols="12" md="3">
                <v-select v-model="quotes.editedItem.payment_information.card.entity"
                    :items="options.cards_entity_type"></v-select>
            </v-col>
            <v-col cols="12" md="6">
                <v-text-field type="number" v-model="quotes.editedItem.payment_information.card.number"
                    label="CARD NUMBER"></v-text-field>
            </v-col>
            <v-col cols="12" md="6">
                <v-dialog ref="payment_information_card_expiration_date_dialog" v-model="payment_expiration_date_modal"
                    persistent width="290px">
                    <template v-slot:activator="{ on, attrs }">
                        <v-text-field v-model="quotes.editedItem.payment_information.card.expiration_date"
                            label="DATE OF EXPIRATION" prepend-icon="mdi-calendar" readonly v-bind="attrs" v-on="on"
                            :rules="rules.required"></v-text-field>
                    </template>
                    <v-date-picker v-model="quotes.editedItem.payment_information.card.expiration_date" type="month"
                        scrollable>
                        <v-spacer></v-spacer>
                        <v-btn text color="primary" @click="payment_expiration_date_modal = false">
                            Cancel
                        </v-btn>
                        <v-btn text color="primary"
                            @click="$refs.payment_information_card_expiration_date_dialog.save(quotes.editedItem.payment_information.card.expiration_date)">
                            OK
                        </v-btn>
                    </v-date-picker>
                </v-dialog>
            </v-col>
            <v-col cols="12" md="6">
                <v-text-field v-model="quotes.editedItem.payment_information.card.ccv" label="CODE(CCV)"
                    :rules="rules.required"></v-text-field>
            </v-col>
            <v-col cols="12" md="6">
                <v-text-field type="tel" v-model="quotes.editedItem.payment_information.card.bank_name"
                    label="BANK NAME" :rules="rules.required"></v-text-field>
            </v-col>
        </template>
    </v-row>
</v-form>