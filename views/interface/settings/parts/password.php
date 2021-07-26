<v-row>
	<v-col cols="12">
		<v-form>
			<v-row>
				<v-col cols="12">
					<h4 class="text-h4">Change your password</h4>
				</v-col>
				<v-col cols="6">
					<v-text-field type="password" v-model="password" label="Password"></v-text-field>
				</v-col>
				<v-col cols="6">
					<v-text-field type="password" v-model="password_confirm" label="Confirm your password"></v-text-field>
				</v-col>
				<v-btn color="primary" @click="changePassword" :loading="password_loading" block>Change your password</v-btn>
			</v-row>
		</v-form>
	</v-col>
</v-row>