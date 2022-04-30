<?php 
 $folder = \RA_ELITE_USA\Controller\Classes\Template::folder_by_rol($current_user);
?>
<v-list dense>
	<v-sheet class="d-flex justify-center">
  	<v-subheader class="subtitle-1 black--text">Welcome, <?php echo "{$current_user['first_name']} {$current_user['last_name']}" ?></v-subheader>
	</v-sheet>
	<v-sheet color="primary">
  	<v-subheader class="subtitle-1 white--text">
  		Notifications
  		<v-badge class="ml-2 font-weight-bold" color="secondary" :content="notifications.length" v-if="notifications.length > 0"></v-badge>
  	</v-subheader>
	</v-sheet>
  <template v-if="selectedItem == 0 || selectedItem == 4">
    <v-list-item-group color="primary" class="custom-scroll" style="max-height: 300px;overflow-y: scroll">
      <v-list-item v-for="(n, i) in notifications">
        <v-list-item-content @click="filterQuotes(n.quote_id);markNotificationAsRead(n.ID, i);">
          <v-list-item-title class="black--text">Quote ID: <b>{{ n.quote_id }}</b></v-list-item-title>

          <v-list-item-subtitle class="no-white-space">
            <?php echo \RA_ELITE_USA\Controller\Classes\Template::show_template("interface/parts/notifications/{$folder}/description"); ?>
          </v-list-item-subtitle>
          <v-list-item-subtitle class="primary--text">{{ n.since }}</v-list-item-subtitle>
        </v-list-item-content>
        <v-list-item-action class="ml-0">
          <v-tooltip top>
            <template #activator="{ on, attrs }">
              <v-btn color="primary" v-bind="attrs" v-on="on" @click="markNotificationAsRead(n.ID, i)"  fab small text>
                <v-icon color="primary" link="test">mdi-eye-check</v-icon>
              </v-btn>
            </template>
            <span>Mark as read</span>
          </v-tooltip>
        </v-list-item-action>
      </v-list-item>
    </v-list-item-group>
  </template>
  <template v-else>
    <v-list-item-group color="primary" class="custom-scroll" style="max-height: 300px;overflow-y: scroll">
    	<v-list-item v-for="(n, i) in notifications">
        <v-list-item-content :href="n.relative_url">
          <a :href="n.relative_url">
            <v-list-item-title class="black--text">Quote ID: <b>{{ n.quote_id }}</b></v-list-item-title>

            <v-list-item-subtitle class="no-white-space">
            	<?php echo \RA_ELITE_USA\Controller\Classes\Template::show_template("interface/parts/notifications/{$folder}/description"); ?>
          	</v-list-item-subtitle>
            <v-list-item-subtitle class="primary--text">{{ n.since }}</v-list-item-subtitle>
          </a>
        </v-list-item-content>
        <v-list-item-action>
          <v-tooltip top>
            <template #activator="{ on, attrs }">
              <v-btn color="primary" @click="markNotificationAsRead(n.ID, i)" v-bind="attrs" v-on="on" fab small text>
                <v-icon color="primary">mdi-eye-check</v-icon>
              </v-btn>
            </template>
            <span>Mark as read</span>
          </v-tooltip>
        </v-list-item-action>
      </v-list-item>
    </v-list-item-group>
  </template>
  <template v-if="notifications.length == 0 && !notifications_loading">
  	<v-row class="d-flex align-center justify-center py-5">
  		<v-col class="d-flex justify-center" cols="12">
  			<img src="<?php echo RA_ELITE_USA_INSURANCE_URL ?>/assets/images/empty_notifications.svg" width="60%" />
  		</v-col>
  		<v-col cols="12">
  			<p class="subtitle-1 text-center">There is not notifications</p>
  		</v-col>
  	</v-row>	
  </template>
  <template v-else-if="notifications.length == 0 && notifications_loading">
    <v-row class="d-flex align-center justify-center py-5">
      <v-col class="d-flex justify-center" cols="12">
        <img src="<?php echo RA_ELITE_USA_INSURANCE_URL ?>/assets/animations/double-ring.svg" alt="preloader" width="80px">
      </v-col>
    </v-row> 
  </template>
</v-list>