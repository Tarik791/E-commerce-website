<?php

$this->view("header", $data);
//OVO ĆE BITI STRANICA ZA REZERVACIJU I DODATI SVE ŠTO JE POTREBNO ZA REZERVACIJU
?>
<section id="cart_items" style="margin-top: -50px;">
<div class="container">
<div class="breadcrumbs">
<ol class="breadcrumb">
<li><a href="#">Home</a></li>
<li class="active">Shopping Cart</li>
</ol>
</div>
<div class="table-responsive cart_info" style="margin-top: -50px;">
<table class="table table-condensed">
<thead>
    <tr class="cart_menu">
        <td class="image">Item</td>
        <td class="description"></td>
        <td class="price">Price</td>
        <td class="quantity">Quantity</td>
        <td class="total">Total</td>
        <td></td>
    </tr>
</thead>
<tbody>

<?php if($ROWS): ?>
<?php foreach($ROWS as $row): ?>

    <tr>
        <td class="cart_product">
            <a href=""><img src="<?=ROOT?><?=$row->image?>" style="width:100px;" alt=""></a>
        </td>
        <td class="cart_description">
            <h4><a href=""><?=$row->description?></a></h4>
            <p>prod ID: <?=$row->id?></p>
        </td>
        <td class="cart_price">
            <p><?=$row->price?></p>
        </td>
        <td class="cart_quantity">
            <div class="cart_quantity_button">
                <a class="cart_quantity_up" href="<?=ROOT?>add_to_cart/add_quantity/<?=$row->id?>"> + </a>
                <input oninput="edit_quantity(this.value, '<?=$row->id?>')" class="cart_quantity_input" type="text" name="quantity" value="<?=$row->cart_qty?>" autocomplete="off" size="2">
                <a  class="cart_quantity_down" href="<?=ROOT?>add_to_cart/subtract_quantity/<?=$row->id?>"> - </a>
            </div>
        </td>
        <td class="cart_total">
            <p class="cart_total_price">$<?=$row->price * $row->cart_qty?></p>
        </td>
        <td class="cart_delete">
            <a class="cart_quantity_delete" delete_id="<?=$row->id?>" onclick="delete_item(this.getAttribute('delete_id'))" href="<?=ROOT?>add_to_cart/remove/<?=$row->id?>"><i class="fa fa-times"></i></a>
        </td>
    </tr>
    <?php endforeach; ?>
    <?php else: ?>

        <div style="font-size:18px; text-align:center; padding: 6px; font-weight: bold;">No items were found in the cart!</div>
    <?php endif; ?>
</tbody>
</table><div class="pull-right" style="font-size: 25px;">Sub Total:  $<?= number_format($sub_total, 2)?></div>
</div>

<a href="<?=ROOT?>checkout">
<input type="button" class="btn btn-warning pull-right" value="Checkout >" name="" id="">
</a>

<a href="<?=ROOT?>shop">
<input type="button" class="btn btn-warning pull-left" value="< Continue shopping" name="" id="">
</a>

</div>
</section> <!--/#cart_items-->
<br><br>

<script type="text/javascript">

     //slanje podatak 
    function edit_quantity(quantity, id){
        
    //koristimo funkciju send data i stavljamo u nju quantitiy tako da saljemo podatke kroz ajax
    if(isNaN(quantity))

        return;
    
    send_data({

        quantity:quantity.trim(),
        id:id.trim()



    },"edit_quantity");

}


    //brisanje podatak 
    function delete_item(id){
        
        //koristimo funkciju send data i stavljamo u nju quantitiy tako da saljemo podatke kroz ajax
        
        send_data({
            
            id:id.trim()
    
        },"delete_item");
    
    }



    //slanje podataka putem ajaxa
function send_data(data = {},data_type){


var ajax = new XMLHttpRequest();



ajax.addEventListener('readystatechange', function(){

if(ajax.readyState == 4 && ajax.status == 200){


    handle_result(ajax.responseText);


}

});

//json podaci za slanje i rukovatelk
ajax.open("POST", "<?=ROOT?>ajax_cart/"+data_type+"/"+ JSON.stringify(data), true);
ajax.send();


}


//funkcija za rezultat
function handle_result(result){

console.log(result);


if(result != ""){
var obj = JSON.parse(result);

if(typeof obj.data_type != 'undefined'){


    if(obj.data_type == "delete_item"){

        window.location.href = window.location.href;

    }else
        if(obj.data_type == "edit_quantity"){

                window.location.href = window.location.href;

            }

        }

    }

}
</script>

<?php

$this->view("footer", $data);

?>