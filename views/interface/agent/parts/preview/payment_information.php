<template v-if="quotes.editedItem.payment_information.type != ''">
  <v-col cols="12">
    <h3 class="font-weight-bold primary--text">PAYMENT INFORMATION</h3>
  </v-col>
  <v-col cols="6">
    <p class="font-weight-bold">PAYMENT TYPE: <span class="font-weight-light">{{ quotes.editedItem.payment_information.type }}</span></p>
  </v-col>
  <v-col cols="6">
    <p class="font-weight-bold">AUTOPAY: <span class="font-weight-light">
        <template v-if="quotes.editedItem.payment_information.autopay">
          YES
        </template>
        <template v-else>
          NO
        </template>
      </span>
    </p>
  </v-col>
  <template v-if="quotes.editedItem.payment_information.type == 'BANK ACCOUNT'">
    <v-col cols="12" md="6">
      <p class="font-weight-bold">ACCOUNT TYPE: <span class="font-weight-light">{{ quotes.editedItem.payment_information.bank.type }}</span></p>
    </v-col>
    <v-col cols="12" md="6">
      <p class="font-weight-bold">BANK NAME: <span class="font-weight-light">{{ quotes.editedItem.payment_information.bank.name }}</span></p>
    </v-col>
    <v-col cols="12" md="6">
      <p class="font-weight-bold">NAME ON ACCOUNT: <span class="font-weight-light">{{ quotes.editedItem.payment_information.bank.owner_name }}</span></p>
    </v-col>
    <v-col cols="12" md="6">
      <p class="font-weight-bold">ROUTING NUMBER: <span class="font-weight-light">{{ quotes.editedItem.payment_information.bank.routing_number }}</span></p>
    </v-col>
    <v-col cols="12" md="6">
      <p class="font-weight-bold">ACCOUNT NUMBER: <span class="font-weight-light">{{ quotes.editedItem.payment_information.bank.account_number }}</span></p>
    </v-col>
    <v-col cols="12" md="6">
      <p class="font-weight-bold">CITY: <span class="font-weight-light">{{ quotes.editedItem.payment_information.bank.city }}</span></p>
    </v-col>
    <v-col cols="12" md="6">
      <p class="font-weight-bold">ESTATE: <span class="font-weight-light">{{ quotes.editedItem.payment_information.bank.estate }}</span></p>
    </v-col>
  </template>
  <template v-if="quotes.editedItem.payment_information.type == 'CREDIT OR DEBIT CARD'">
    <v-col cols="12" md="6">
      <p class="font-weight-bold">NAME ON CARD: <span class="font-weight-light">{{ quotes.editedItem.payment_information.card.name }}</span></p>
    </v-col>
    <v-col cols="12" md="6">
      <p class="font-weight-bold">TYPE: <span class="font-weight-light">{{ quotes.editedItem.payment_information.card.type }} <span class="primary--text">({{ quotes.editedItem.payment_information.card.entity }})</span></span></p>
    </v-col>
    <v-col cols="12" md="6">
      <p class="font-weight-bold">CARD NUMBER: <span class="font-weight-light">{{ quotes.editedItem.payment_information.card.number }}</span></p>
    </v-col>
    <v-col cols="12" md="6">
      <p class="font-weight-bold">DATE OF EXPIRATION: <span class="font-weight-light">{{ getFormatDateShort(quotes.editedItem.payment_information.card.expiration_date) }}</span></p>
    </v-col>
    <v-col cols="12" md="6">
      <p class="font-weight-bold">CODE(CCV): <span class="font-weight-light">{{ quotes.editedItem.payment_information.card.ccv }}</span></p>
    </v-col>
    <v-col cols="12" md="6">
      <p class="font-weight-bold">BANK NAME: <span class="font-weight-light">{{ quotes.editedItem.payment_information.card.bank_name }}</span></p>
    </v-col>
  </template>
</template>
