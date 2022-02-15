<?php $this->view("admin/header", $data); ?>

<?php $this->view("admin/sidebar", $data); ?>

<style tyle="text/css">

    .details {

        background-color: #eee;
        box-shadow: 0px 0px 10px #aaa;
        width: 100%;
        position: absolute;
        min-height:100px;
        left: 0px;
        padding: 10px;
        z-index: 2;

    }

</style>

<table class="table table-striped table-advance table-hover">

    <thead>
		<tr><th>Order no</th><th>Customer</th><th>Order date</th><th>Amount</th><th>Check-out date</th><th>City/State</th><th>Mobile Phone</th><th>Status</th><th>...</th></tr>
	</thead>
    <tbody onclick="show_details(event)">
	<?php if(isset($orders) && is_array($orders)):?>
			<?php foreach($orders as $order): ?>

				<tr style="position: relative;"><td><?=$order->id?></td><td><a href="<?=ROOT?>profile/<?=$order->user->url_address?>"><?=$order->user->email?></a></td><td><?=date("jS M Y H:i a", strtotime($order->date))?></td><td>$<?=$order->total?></td><td><?=$order->datetimetwo?></td><td><?=$order->state?></td><td><?=$order->mobile_phone?></td><td><?=is_paid($order)?></td>
				
		<td>
			<i class="fa fa-arrow-down"></i>

		<div class="js-order-details details hide">
		<a style="float:right; cursor:pointer">Close</a>
		<!---postavljanje svih detalja i njegov niz svih detalja-->
		
		<h3>Order #<?=$order->id?></h3>
        <h4>Customer: <?=$order->user->name?><br>Email: <?=$order->user->email?></h4>
        
        <!--Order details--->
        <div style="display:flex;">
            <table class="table" style="flex: 1; margin: 4px;">
                

                <tr><th>Country</th><td><?=$order->country?></td></tr>
                <tr><th>State</th><td><?=$order->state?></td</tr>
                <tr><th>Check-out date</th><td><?=$order->datetimetwo?></td</tr>

                </table>

                <table class="table" style="flex: 1; margin: 4px;">

                <tr><th>Check-in date</th><td><?=$order->datetime?></td</tr>
                <tr><th>Mobile Phone</th><td><?=$order->mobile_phone?></td</tr>
                <tr><th>Date</th><td><?=$order->date?></td</tr>


                    
            </table>
        </div>
        <hr>
        <h4>Order Summamry</h4>


		<table class="table">
		<thead>
			<tr><th>Qty</th><th>Description</th><th>Amount</th><th>Total</th></tr>
		</thead>
		<?php if(isset($order->details) && is_array($order->details)): ?>
			<!---onda smo spremni da idemo na svoj teritoij--->
			<tbody>
				<?php foreach($order->details as $detail): ?>

				<tr></td><td><?=$detail->qty?></td><td><?=$detail->description?></td><td><?=$detail->amount?></td><td><?=$detail->total?></td></tr>

				<?php endforeach; ?>
			</tbody>		

			<?php else: ?>

			<div>No order details wee found for this order</div>

			<?php endif; ?>				
		</table>
		<h3 class="pull-right">Grand total: <?=$order->grand_total?></h3>

		</div>
			
		</td>
	</tr>
			<?php endforeach; ?>

			<?php endif;?>
			<tr><td colspan="4"><?php Page::show_links(); ?></tr></td>

			</tbody>
</table>

<script type="text/javascript">
	//prikaz detalja 
	function show_details(e){

		var row = e.target.parentNode;

		//ako nije jednako retku tabele
		if(row.tagName != "TR") 

			row = row.parentNode;
		

		var details = row.querySelector(".js-order-details");
		
		//get all rows
		var all = e.currentTarget.querySelectorAll(".js-order-details");
		for(var i = 0; i < all.length; i++){

			if(all[i] != details){

				all[i].classList.add("hide");

			}
		}

		//uklanjanje redova
		if(details.classList.contains("hide")){
			details.classList.remove("hide");

		}else{

			details.classList.add("hide");

		}


	}


</script>
<?php $this->view("admin/footer", $data); ?>
