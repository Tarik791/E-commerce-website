<?php

$this->view("header", $data);

?>

<?php 

//prikazivanje errora
if(isset($errors) && count($errors) > 0){

    echo "<div>";
    foreach($errors as $error){


        echo "<div class='alert alert-danger' style='padding:5px; text-align:center; max-width: 500px; margin: auto;'>$error</div>";
    }

    echo "</div>";



}

?>
<section id="cart_items" >
<div class="container">
<div class="breadcrumbs">
    <ol class="breadcrumb">
        <li><a href="#">Home</a></li>
        <li class="active">Check out</li>
    </ol>
</div><!--/breadcrums-->
<?php if(is_array($ROWS)): ?>


<div class="register-req">
    <p>Fields with a * are required</p>
</div><!--/register-req-->

<?php 


$address1 = "";
$address2 = "";
$postal_code = "";
$country = "";
$state = "";
$datetime = "";
$mobile_phone = "";
$message = "";

if(isset($POST_DATA)){

    extract($POST_DATA);

}    
    
?>


<form method="post">

<div class="shopper-informations">
    <div class="row">
        
        <div class="col-sm-8 clearfix">
            <div class="bill-to">
                <p>Bill To</p>
                <div class="form-one">

                     

                        <input name="address2" value="<?=$address2?>" class="form-control"  type="text" placeholder="Address 2" required><br>

                        <input name="postal_code" value="<?=$postal_code?>" class="form-control"  type="text" placeholder="Zip / Postal Code *" required><br>
                </div>
                <div class="form-two">
                        <select name="country" class="js-country" oninput="get_states(this.value)" required>
                            
                        <?php if($country == ""){
                            echo "<option>-- Country --</option>";

                            }else{
                                echo "<option>$country</option>";
                            }?>
                            <!---ako je ovo tacno -->
                            <?php if(isset($countries) && $countries): ?>
                                <!---prikazati ce se ova petlja-->
                                <?php foreach ($countries as $row): ?>

                            <option value="<?=$row->country?>"><?=$row->country?></option>


                            <?php endforeach; ?>
                            <?php endif; ?>

                        </select><br><br>
                        <select name="state" value="<?=$state?>" class="js-state" required>

                        <?php if($state == ""){
                            echo "<option>-- State / Province / Region --</option>
                            ";

                            }else{
                                echo "<option>$state</option>";
                            }?>
                            
                        </select><br><br>
                        <label for="datetime">Check-in date</label>
                        <input name="datetime" class="form-control"  type="date" autofocus required  value="<?=$datetime?>">
                        <br>
                        <label for="datetimetwo">Check-in date</label>
                        <input name="datetimetwo" value="<?=$datetimetwo?>" class="form-control" type="date"  autofocus required><br>
                        <input name="mobile_phone" class="form-control" value="<?=$mobile_phone?>"  type="text" placeholder="Mobile Phone *" required><br>
                        <br>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="order-message">
                <p>Shipping Order</p>
                <textarea name="message"   placeholder="Notes about your order, Special Notes for Delivery" rows="16"><?=$message?></textarea>
                
            </div>	
        </div>					
    </div>

    <input type="submit" class="btn btn-warning pull-right" value="Continue >" name="" id="">

  
</a>
</div>
</form>



    <?php else: ?>
        <p style="text-align:center; font-size:23px; font-weight:bold;"> Please add some items in the cart first!</p>


    <?php endif; ?>
         <a href="<?=ROOT?>cart">
    <input type="button" class="btn btn-warning pull-left" value="< Back to cart" name="" id="">
    </div>
</section> <!--/#cart_items-->

<script>

    //brisanje podatak 
    function get_states(country){
        
        //koristimo funkciju send data i stavljamo u nju quantitiy tako da saljemo podatke kroz ajax
        
        send_data({
            
            id:country.trim()
    
        },"get_states");
    
    }



    //slanje podataka putem ajaxa
function send_data(data = {},data_type){


var ajax = new XMLHttpRequest();



ajax.addEventListener('readystatechange', function(){

if(ajax.readyState == 4 && ajax.status == 200){


    handle_result(ajax.responseText);


}

});

//sredstvo za slanje podataka
var info = {};
info.data_type = data_type;
info.data = data;


//json podaci slanje i rukovatelj
ajax.open("POST", "<?=ROOT?>ajax_checkout", true);
ajax.send(JSON.stringify(info));


}


//funkcija za rezultat
function handle_result(result){

console.log(result);
if(result != ""){
var obj = JSON.parse(result);
 
if(typeof obj.data_type != 'undefined'){


    if(obj.data_type == "get_states"){

            var select_input = document.querySelector(".js-state");
            select_input.innerHTML = "<option>-- State / Province / Region --</option>";

            for (var i = 0; i < obj.data.length; i++) {
                select_input.innerHTML += "<option value='"+obj.data[i].state+"'>"+obj.data[i].state+"</option>";


                
            }

            }
        }

    }

}

</script>


<?php

$this->view("footer", $data);

?>