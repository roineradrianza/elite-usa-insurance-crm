<?php $current_user = \RA_ELITE_USA\Controller\Classes\User::get_current_user(); ?>
					<?php echo \RA_ELITE_USA\Controller\Classes\Template::show_template('interface/parts/notifications', ['current_user' => $current_user]); ?>
			    <v-list dense>
			    	<v-sheet color="primary">
			      	<v-subheader class="subtitle-1 white--text">Panel</v-subheader>
			    	</v-sheet>
			      <v-list-item-group v-model="selectedItem" color="primary">
			      	<?php foreach ($tabs as $tab): ?>
				        <v-list-item href="<?php echo site_url() . '/'. $tab['url'] ?>" :value="<?php echo $tab['tab_index'] ?>" link>
				          <v-list-item-icon>
				            <v-icon><?php echo $tab['icon'] ?></v-icon>
				          </v-list-item-icon>
				          <v-list-item-content>
				            <v-list-item-title><?php echo $tab['name'] ?></v-list-item-title>
				          </v-list-item-content>
				        </v-list-item>
			      	<?php endforeach ?>
				        <v-list-item @click="logout" :value="99" link>
				          <v-list-item-icon>
				            <v-icon class="secondary--text">mdi-logout</v-icon>
				          </v-list-item-icon>
				          <v-list-item-content>
				            <v-list-item-title class="secondary--text">LOGOUT</v-list-item-title>
				          </v-list-item-content>
				        </v-list-item>
			      </v-list-item-group>
			    </v-list>