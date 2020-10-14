<div class="full_width">
	<div class="wide_container">
		<div class="row">
			<div class="sms_notifications">
				<div>
					<h1 class="center">Get a text link to the next gathering. </h1>
					<p class="center">Enter your phone number and we'll text you a link to join the day of the next gathering.</p>
					
					<div style="position: relative;">
						<form class="subscribe" id="sms_subscribe" action="javascript:post_sms_webhook()">
							<div id="error">Please provide your full phone number starting with the area code.</div>
							<input id="phone_number" type="tel" placeholder="*Phone Number">
							<input id="submit" type="submit" value="Send">
						</form>

						<div id="success">
							<p>Sweet. We just sent you a text.</p>
						</div>

						<p class="center fine_print">Message and data rates may apply. 1-2 msgs per month. Reply HELP for help, STOP to cancel. Read our Terms of Service and Privacy Policy for more information. </p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
