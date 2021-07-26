<?php $current_user = RA_ELITE_USA_INSURANCE_USER::get_current_user(); ?>
<?php if ($current_user['roles'][0] == 'elite_usa_insurance_agent') : ?>
<v-col cols="12" md="6">
  <v-data-table :headers="modifications.header" :items="modifications.items" item-key="ID" sort-by="['status','published_at']" class="elevation-1" :loading="requests_table_loading" :expanded.sync="modifications.expanded" show-expand multi-sort>
    <template #top>
      <v-toolbar class="mb-n3" flat>
        <v-toolbar-title>List of Modifications Requested</v-toolbar-title>
        <v-spacer></v-spacer>
        <v-btn color="primary" @click="edit_dialog = true; modifications.content = ''">Request modification</v-btn>
      </v-toolbar>
    </template>
    <template v-slot:item.published_at="{ item }">
      {{ getFormatDate(item.post_date) }}
    </template>
    <template v-slot:item.status="{ item }">
      <v-chip color="success" v-if="parseInt(item.status)">Ready</v-chip>
      <v-chip color="warning" v-else>Processing</v-chip>
    </template>
    <template v-slot:expanded-item="{ headers, item }">
      <td :colspan="headers.length">
        <h5 class="text-h5 mt-5">Modification requested:</h5>
        <div class="mb-5">{{ item.post_content }}</div>
      </td>
    </template>
  </v-data-table>
</v-col>
<?php endif ?>