    
	    <v-alert class="white--text" :type="alert_type" elevation="2" v-if="alert">
	    	<span v-html="alert_message"></span>
	    </v-alert>