<?php $this->view("header", $data); ?>

<?php $this->view("slider", $data); ?>

<?php 

//$str = '{"id":"WH-7DV55593YD6518717-7A663597AB616260R","event_version":"1.0","create_time":"2021-11-17T10:37:32.995Z","resource_type":"checkout-order","resource_version":"2.0","event_type":"CHECKOUT.ORDER.APPROVED","summary":"An order has been approved by buyer","resource":{"create_time":"2021-11-17T10:29:46Z","purchase_units":[{"reference_id":"default","amount":{"currency_code":"USD","value":"6.00","breakdown":{"item_total":{"currency_code":"USD","value":"4.00"},"shipping":{"currency_code":"USD","value":"2.00"},"tax_total":{"currency_code":"USD","value":"0.00"}}},"payee":{"email_address":"sb-p1x43j8549180@business.example.com","merchant_id":"S2WDEMU8JBJKE"},"description":"my item description ","shipping":{"name":{"full_name":"John Doe"},"address":{"address_line_1":"1 Main St","admin_area_2":"San Jose","admin_area_1":"CA","postal_code":"95131","country_code":"US"}}}],"links":[{"href":"https://api.sandbox.paypal.com/v2/checkout/orders/0U12052141410134E","rel":"self","method":"GET"},{"href":"https://api.sandbox.paypal.com/v2/checkout/orders/0U12052141410134E","rel":"update","method":"PATCH"},{"href":"https://api.sandbox.paypal.com/v2/checkout/orders/0U12052141410134E/capture","rel":"capture","method":"POST"}],"id":"0U12052141410134E","intent":"CAPTURE","payer":{"name":{"given_name":"John","surname":"Doe"},"email_address":"sb-iwwkw8549201@personal.example.com","payer_id":"B2UMZNYVC4PHJ","address":{"country_code":"US"}},"status":"APPROVED"},"links":[{"href":"https://api.sandbox.paypal.com/v1/notifications/webhooks-events/WH-7DV55593YD6518717-7A663597AB616260R","rel":"self","method":"GET"},{"href":"https://api.sandbox.paypal.com/v1/notifications/webhooks-events/WH-7DV55593YD6518717-7A663597AB616260R/resend","rel":"resend","method":"POST"}]}';

    //echo "<pre>";
    //$obj = json_decode($str);

    //print_r($obj);


?>

<section>
		<div class="container">
			<div class="row">
				<?php if(isset($_GET['mode']) && $_GET['mode'] == 'approved'):?>

	 				<center><h1>Thanks for shopping with us!</h1></center>
	 			<?php elseif(isset($_GET['mode']) && $_GET['mode'] == 'cancel'):?>

	 				<center><h1>Payment was cancelled!</h1></center>
	 			<?php elseif(isset($_GET['mode']) && $_GET['mode'] == 'error'):?>
	 				
	 				<center><h1>An error occured! Payment unsuccessful!</h1></center>
	 			<?php endif;?>
			</div>
		</div>
	</section>
	
<?php $this->view("footer",$data); ?>
