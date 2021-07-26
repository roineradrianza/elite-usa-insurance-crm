<template v-if="loaders.table" transition="scroll-y-reverse-transition">
  <v-sheet
    class="pa-3"
  >
    <v-skeleton-loader
      class="mx-auto"
      max-width="100vw"
      type="table-heading, table-tbody"
    ></v-skeleton-loader>
  </v-sheet>
</template>