<?php $this->view("admin/header", $data); ?>

<?php $this->view("admin/sidebar", $data); ?>

<style type="text/css">

    .add_new {

        width: 500px;
        height: 600px;
        background-color: #eae8e8;
        box-shadow: 0px 0px 10px #aaa;
        position:absolute;
        padding: 6px;
        z-index: 100;
    }

    .edit_product {

    width: 500px;
    height: 600px;
    background-color: #eae8e8;
    box-shadow: 0px 0px 10px #aaa;
    position:absolute;
    padding: 6px;

    }



    .show{

        display:block;

    }
    .hide{


        display:none;

}

.edit_product_images{

    display: flex;
    width: 100%;

}

.edit_product_images img{

flex: 1;
width: 10px;
margin: 2px;
}





</style>


<div class="row mt">
        <div class="col-md-12">
            <div class="content-panel">
                <h3>Advanced Search</h3>
<!----searchbox-->
<style>
    .my-table{
        background-color:#eee;
    }

    .my-table th{
        background-color:#ddd;
    }
</style>

    <form method="get">
        <table class="my-table table table-condensed">
                <tr>
                    <th>Description</th>
                <td>
                    <input value="<?php Search::get_sticky('textbox','description')?>" autofocus="true" type="text" class="form-control" name="description" placeholder="Type what to search for">
                </td>     
                
                <th>Category</th>
                <td>
                    <select class="form-control" name="category">
                        <option>--Select Category--</option>
                        <?php Search::get_categories(); ?>
                    </select>
                </td>
                </tr>

            <tr>
                    <th>Brands</th>
                <td colspan="3">

                <?php Search::get_brands(); ?>

                </td>
            </tr>

          

            <tr>
                    <th>Price</th>
                <td>
                    <div class="form-inline">
                    <label for="">Min Price: </label>
                      <input value="<?php Search::get_sticky('number','min-price')?>" class="form-control"  type="number" step="0.1" name="min-price">

                      <label for="">max Price: </label>
                      <input value="<?php Search::get_sticky('number','max-price')?>" class="form-control" type="number" step="0.1" name="max-price">
                      </div>
                </td>   
                
                <th>Quantity</th>
                <td>
                <div class="form-inline">

                <label for="">Min Quantity: </label>
                <input class="form-control" value="<?php Search::get_sticky('number','min-qty')?>" type="number" step="1" name="min-qty">

                <label for="">max Quantity: </label>
                <input class="form-control" value="<?php Search::get_sticky('number', 'max-qty')?>" type="number" step="1" name="max-qty">
                </div>
                </td>
            </tr>


            <tr>
                    <th>Year</th>
                <td>
                    <select class="form-control" name="year">
                        <option>--Select Year--</option>
                        <?php Search::get_years('year'); ?>
                    </select>
                </td>
            </tr>
                <tr><td colspan="4"><input type="submit" name="search" value="Search" class="btn-success pull-right"></td></tr>
        </table>
    </form>
  



<!----/endd searchbox-->

           
            <table class="table table-striped table-advance table-hover">
    <h4><i class="fa fa-angle-right"></i> Products <button class="btn btn-primary btn-xs" onclick="show_add_new(event)"><i class="fa fa-plus"></i> Add New</button></h4>
    
    <!--add new product-->
    <div class="add_new add_edit_panel hide">
    
        <h4 class="mb"><i class="fa fa-angle-right"></i> Add New Product</h4>
        <form class="form-horizontal style-form" method="post">
            <div class="form-group">
                <label class="col-sm-2 col-sm-2 control-label">Product Name:</label>
                <div class="col-sm-10">
                    <input id="description" name="description" type="text" class="form-control" autofocus required>
                </div>
            </div>
            <br><br style="clear: both;">
            <div class="form-group">
                <label class="col-sm-2 col-sm-2 control-label">Quantity:</label>
                <div class="col-sm-10">
                    <input id="quantity" name="quantity" type="number" value="1" class="form-control" required>
                </div>
            </div>

            <br><br style="clear: both;">
            <div class="form-group">
                <label class="col-sm-2 col-sm-2 control-label">Category:</label>
                <div class="col-sm-10">
                <select id="category" name="category"  class="form-control" required>
                    <option></option>
                    <?php if(is_array($categories)): ?>
                        <?php foreach($categories as $categ): ?>

                            <option value="<?=$categ->id?>"><?=$categ->category?></option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
                </div>
            </div>

            <br><br style="clear: both;">
            <div class="form-group">
                <label class="col-sm-2 col-sm-2 control-label">Brand:</label>
                <div class="col-sm-10">
                <select id="brand" name="brand"  class="form-control" required>
                    <option></option>
                    <?php if(is_array($brands)): ?>
                        <?php foreach($brands as $brand): ?>

                            <option value="<?=$brand->id?>"><?=$brand->brand?></option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
                </div>
            </div>
                        
<br><br style="clear: both;">
            <div class="form-group">
                <label class="col-sm-2 col-sm-2 control-label">Price:</label>
                <div class="col-sm-10">
                    <input id="price" name="price" type="number" placeholder="0.00" step="0.01" class="form-control" required>
                </div>
            </div>

            <br><br style="clear: both;">
            <div class="form-group">
                <label class="col-sm-2 col-sm-2 control-label">Image:</label>
                <div class="col-sm-10">
                    <input id="image" name="image" type="file"  onchange="display_image(this.files[0],this.name,'js-product-images-add')" class="form-control" required>
                </div>
            </div>
                <br><br style="clear: both;">
            <div class="form-group">
                <label class="col-sm-2 col-sm-2 control-label">Image2 (optional):</label>
                <div class="col-sm-10">
                    <input id="image2" name="image2" type="file"  onchange="display_image(this.files[0],this.name,'js-product-images-add')" class="form-control" >
                </div>
            </div>
                <br><br style="clear: both;">
            <div class="form-group">
                <label class="col-sm-2 col-sm-2 control-label">Image3 (optional):</label>
                <div class="col-sm-10">
                    <input id="image3" name="image3" type="file"  onchange="display_image(this.files[0],this.name,'js-product-images-add')" class="form-control" >
                </div>
            </div>
                <br><br style="clear: both;">
            <div class="form-group">
                <label class="col-sm-2 col-sm-2 control-label">Image4 (optional):</label>
                <div class="col-sm-10">
                    <input id="image4" name="image4" type="file"  onchange="display_image(this.files[0],this.name,'js-product-images-add')" class="form-control" >
                </div>
            </div>
            <br><br style="clear: both;">
            <div class="form-group">
                <label class="col-sm-2 col-sm-2 control-label">Image4 (optional):</label>
                <div class="col-sm-10">
                    <input id="image5" name="image5" type="file"  onchange="display_image(this.files[0],this.name,'js-product-images-add')" class="form-control" >
                </div>
            </div>
            <div class="js-product-images-add edit_product_images">
                <img src="">
                <img src="">
                <img src="">
                <img src="">
            </div>		                          
            
            <button type="button" class="btn btn-warning" onclick="show_add_new(event)" style="position:absolute;bottom:10px; left:10px;">Close</button>
            <button type="button" class="btn btn-primary" onclick="collect_data(event)" style="position:absolute;bottom:10px; right:10px;">Save</button>
    
        </form>
 					           

            <br><br>


                    </div>

        <!---add new product end--->


                
        <!---add new product--->
        <div class="edit_product hide" >
<!-- BASIC FORM ELELEMNTS -->

            <h4 class="mb"><i class="fa fa-angle-right"></i> Edit Product</h4>
            <form class="form-horizontal style-form" method="post">
            <label class="col-sm-2 col-sm-2 control-label">Product Name</label>
                    <div class="col-sm-10">
                        <input id="edit_description" name="description" type="text" class="form-control" autofocus required>
                    </div>
                <br><br style="clear:both;">
                    <label class="col-sm-2 col-sm-2 control-label"> Quantity</label>
                    <div class="col-sm-10">
                        <input id="edit_quantity" name="quantity" type="number" value="1" class="form-control" autofocus required>
                    </div>
                
                <br><br style="clear:both;">
                <label class="col-sm-2 col-sm-2 control-label"> Category</label>
                <div class="col-sm-10">
                
                    <select id="edit_category" name="category" class="form-control" required>
                        <option></option>
    <?php if(is_array($categories)): ?>
        <?php foreach($categories as $categ): ?>
            <option value="<?=$categ->id?>"><?=$categ->category?></option>
        <?php endforeach; ?>
        <?php endif; ?>
                    </select>
                </div>

                <br><br style="clear:both;">
                <label class="col-sm-2 col-sm-2 control-label"> Price</label>
                <div class="col-sm-10">
                    <input id="edit_price" name="price" type="number" placeholder="0.00" class="form-control" required>
                </div>


                <br><br style="clear:both;">
                <label class="col-sm-2 col-sm-2 control-label">Image</label>
                <div class="col-sm-10">
                    <input id="edit_image" name="image" type="file" onchange="display_image(this.files[0],this.name), 'js-product-images-edit')" class="form-control" class="form-control">
                </div>

                <br><br style="clear:both;">
                <label class="col-sm-2 col-sm-2 control-label">Image2
                    <br>(optional)</label>
                <div class="col-sm-10">
                    <input id="edit_image2" name="image2" type="file" onchange="display_image(this.files[0],this.name, 'js-product-images-edit')" class="form-control)" class="form-control">
                </div>

                <br><br style="clear:both;">
                <label class="col-sm-2 col-sm-2 control-label">Image3
                    <br>(optional)</label>
                <div class="col-sm-10">
                    <input id="edit_image3" name="image3" type="file" onchange="display_image(this.files[0],this.name, 'js-product-images-edit')" class="form-control)" class="form-control">
                </div>

                <br><br style="clear:both;">
                <label class="col-sm-2 col-sm-2 control-label">Image4
                    <br>(optional)</label>
                <div class="col-sm-10">
                    <input id="edit_image4" name="image4" type="file" onchange="display_image(this.files[0],this.name, 'js-product-images-edit')" class="form-control">
                </div>
                <br><br style="clear:both;">
                <label class="col-sm-2 col-sm-2 control-label">Image4
                    <br>(optional)</label>
                <div class="col-sm-10">
                    <input id="edit_image5" name="image5" type="file" onchange="display_image(this.files[0],this.name, 'js-product-images-edit')" class="form-control">
                </div>
            <br>


        <div class="js-product-images-edit edit_product_images">
            
        </div> 
        
        
        <button type="button" class="btn btn-warning" onclick="show_edit_product(0,'', false)" style="position:absolute; bottom:10px; left:10px;">Cancel</button>

        <button type="button" class="btn btn-primary" onclick="collect_edit_data(event)" style="position:absolute; bottom:10px; right:10px;">Save</button>

            </form>

            <br><br>


                    </div>

                        <!---add new product end--->


                    <hr>
                    <thead>
                    <tr>
                        <th> Product id</th>
                        <th>Product Name</th>

                        <th> Quantity</th>
                        <th> Category</th>
                        <th> Brand</th>

                        <th> price</th>
                        <th> Date</th>

                        <th><i class=" fa fa-edit"></i> Action</th>

                        <th></th>
                    </tr>
                    </thead>
                    <tbody id="table_body">

                    <?=$tbl_rows?>


                
                
                    </tbody>


                    <?php Page::show_links(); ?>
                </table>



            </div><!-- /content-panel -->
        </div><!-- /col-md-12 -->
    </div><!-- /row -->

    <script type="text/javascript">


var EDIT_ID = 0;
/*funkcija namijenjena za otvaranje input polja koje sluzi za dodavanje kategorije */
function show_add_new(){
 
    var show_edit_box = document.querySelector(".add_new");
    var product_input = document.querySelector("#description");

    if(show_edit_box.classList.contains("hide")){

        show_edit_box.classList.remove("hide");
        product_input.focus();
    }else{

        show_edit_box.classList.add("hide");
        product_input.value = "";
    }

}


function show_edit_product(id,product,e)
{

var show_add_box = document.querySelector(".edit_product");
var edit_description_input = document.querySelector("#edit_description");

if(e){

    var a = (e.currentTarget.getAttribute("info"));
    var info = JSON.parse(a.replaceAll("'",'"'));

    EDIT_ID = info.id;
    //show_add_box.style.left = (e.clientX - 700) + "px";
    show_add_box.style.top = (e.clientY - 100) + "px";

    edit_description_input.value = info.description;

    var edit_quantity_input = document.querySelector("#edit_quantity");
    edit_quantity_input.value = info.quantity;

    var edit_category_input = document.querySelector("#edit_category");
    edit_category_input.value = info.category;

    var edit_price_input = document.querySelector("#edit_price");
    edit_price_input.value = info.price;
    
    var product_images_input = document.querySelector(".js-product-images-edit");
    product_images_input.innerHTML = `<img src="<?=ROOT?>${info.image}" />`;
    product_images_input.innerHTML += `<img src="<?=ROOT?>${info.image2}" />`;
    product_images_input.innerHTML += `<img src="<?=ROOT?>${info.image3}" />`;
    product_images_input.innerHTML += `<img src="<?=ROOT?>${info.image4}" />`;
    product_images_input.innerHTML += `<img src="<?=ROOT?>${info.image5}" />`;


}


if(show_add_box.classList.contains("hide")){

    show_add_box.classList.remove("hide");
    edit_description_input.focus();
}else{

    show_add_box.classList.add("hide");
    edit_description_input.value = "";
}


}

//slanje informacija putem ajaxa sihrone komunikacije
function collect_data(e){

    //Onemogu??eno kucanje brojeva
    var product_input = document.querySelector("#description");
    if(product_input.value.trim() == "" || !isNaN(product_input.value.trim())){

        alert("Please enter a valid product name");
        return;
    }

     //Onemogu??eno kucanje brojeva
     var quantity_input = document.querySelector("#quantity");
    if(quantity_input.value.trim() == "" || isNaN(quantity_input.value.trim())){

        alert("Please enter a valid quantity name");
        return;
    }


    //Onemogu??eno kucanje brojeva
    var category_input = document.querySelector("#category");
    if(category_input.value.trim() == "" || isNaN(category_input.value.trim())){

        alert("Please enter a valid catgory category");
        return;
    }


    //Onemogu??eno kucanje brojeva
    var brand_input = document.querySelector("#brand");
    if(brand_input.value.trim() == "" || isNaN(brand_input.value.trim())){

        alert("Please enter a valid brand");
        return;
    }


    //Onemogu??eno kucanje brojeva
    var price_input = document.querySelector("#price");
    if(price_input.value.trim() == "" || isNaN(price_input.value.trim())){

        alert("Please enter a valid price ");
        return;
    }


    //image
    var image_input = document.querySelector("#image");
    if(image_input.files.length == 0){

        alert("Please enter a valid main image");
        return;
    }

    //create a form    
    var data = new FormData();

var image2_input = document.querySelector("#image2");
if(image2_input.files.length > 0)
{
   data.append('image2',image2_input.files[0]);
}

var image3_input = document.querySelector("#image3");
if(image3_input.files.length > 0)
{
   data.append('image3',image3_input.files[0]);
}

var image4_input = document.querySelector("#image4");
if(image4_input.files.length > 0)
{
   data.append('image4',image4_input.files[0]);
}

var image5_input = document.querySelector("#image5");
if(image5_input.files.length > 0)
{
   data.append('image5',image5_input.files[0]);
}

//sending data 
data.append('description',product_input.value.trim());
data.append('quantity',quantity_input.value.trim());
data.append('category',category_input.value.trim());
data.append('brand',brand_input.value.trim());

data.append('price',price_input.value.trim());
data.append('data_type','add_product');
data.append('image',image_input.files[0]);

send_data_files(data);

}



//slanje informacija putem ajaxa sihrone komunikacije
function collect_edit_data(e)
	{

		var product_input = document.querySelector("#edit_description");
		if(product_input.value.trim() == "" || !isNaN(product_input.value.trim()))
		{
			alert("Please enter a valid product name");
			return;
		}

		var quantity_input = document.querySelector("#edit_quantity");
		if(quantity_input.value.trim() == "" || isNaN(quantity_input.value.trim()))
		{
			alert("Please enter a valid quantity");
			return;
		}

		var category_input = document.querySelector("#edit_category");
		if(category_input.value.trim() == "" || isNaN(category_input.value.trim()))
		{
			alert("Please enter a valid category");
			return;
		}

		var price_input = document.querySelector("#edit_price");
		if(price_input.value.trim() == "" || isNaN(price_input.value.trim()))
		{
			alert("Please enter a valid price");
			return;
		}

 		//create a form
		var data = new FormData();

 		var image_input = document.querySelector("#edit_image");
		if(image_input.files.length > 0)
		{
			data.append('image',image_input.files[0]);
		}

		var image2_input = document.querySelector("#edit_image2");
		if(image2_input.files.length > 0)
		{
			data.append('image2',image2_input.files[0]);
		}
		

 		var image3_input = document.querySelector("#edit_image3");
		if(image3_input.files.length > 0)
		{
			data.append('image3',image3_input.files[0]);
		}

 		var image4_input = document.querySelector("#edit_image4");
		if(image4_input.files.length > 0)
		{
			data.append('image4',image4_input.files[0]);
		}
        var image5_input = document.querySelector("#edit_image5");
		if(image5_input.files.length > 0)
		{
			data.append('image5',image5_input.files[0]);
		}
		

		data.append('description',product_input.value.trim());
		data.append('quantity',quantity_input.value.trim());
		data.append('category',category_input.value.trim());
		data.append('price',price_input.value.trim());
		data.append('data_type','edit_product');
		data.append('id',EDIT_ID);
 
		send_data_files(data);
	}




//slanje podataka putem ajaxa
function send_data(data = {}){


var ajax = new XMLHttpRequest();



ajax.addEventListener('readystatechange', function(){

if(ajax.readyState == 4 && ajax.status == 200){


    handle_result(ajax.responseText);


}

});


ajax.open("POST", "<?=ROOT?>ajax_product", true);
ajax.send(JSON.stringify(data));


}

//slanje podataka putem ajaxa
function send_data_files(formdata){


var ajax = new XMLHttpRequest();



ajax.addEventListener('readystatechange', function(){

if(ajax.readyState == 4 && ajax.status == 200){


    handle_result(ajax.responseText);


}

});


ajax.open("POST", "<?=ROOT?>ajax_product", true);
ajax.send(formdata);


}

//funkcija za rezultat
function handle_result(result){

//console.log(result);
if(result != ""){
var obj = JSON.parse(result);

if(typeof obj.data_type != 'undefined'){


if(obj.data_type == "add_new")
{

if(obj.message_type == "info"){

    alert(obj.message);
    show_add_new();

    var table_body = document.querySelector("#table_body");
    table_body.innerHTML = obj.data;

}else
{

    alert(obj.message);
    }

}else
if(obj.data_type == "edit_product"){

    if(obj.message_type == "info"){

		show_edit_product(0,'',false);

		var table_body = document.querySelector("#table_body");
		table_body.innerHTML = obj.data;

		}else{

		alert(obj.message);
		}
    //poruka
}else
if(obj.data_type == "disable_row"){

    //sve povratne podatke postavljamo u tijelo tablice
    var table_body = document.querySelector("#table_body");
    table_body.innerHTML = obj.data;

}else
    if(obj.data_type == "delete_row"){

    var table_body = document.querySelector("#table_body");
    table_body.innerHTML = obj.data;

    alert(obj.message);

            }

        }



    }

}

//funkcija za prikaz fotografija u editovanju proizvoda nakon sto se odabere fotografija da se odmah prikaze
function display_image(file,name,element)
	{
    var index = 0;
    if(name == "image2"){
        index = 1;
    }else
    if(name == "image3"){
        index = 2;
    }else 
    if(name == "image4"){
        index = 3;
    }else
    if(name == "image5"){
        index = 4;
    }

    var image_holder = document.querySelector("."+element);

    var images = image_holder.querySelectorAll("IMG");

    images[index].src = URL.createObjectURL(file);


	}

//editovanje linje u tabeli 
function edit_row(id){
    

    send_data({
        data_type: ""
    });
}

//brisanje linije u tabeli
function delete_row(id){

    if(!confirm("Are you sure you want to delete this row?"))
    {
        return;

    }

    send_data({
        data_type: "delete_row",
        id:id
    });

}

//funkcija za disabled or enabled
function disable_row(id,state){

    send_data({
        data_type: "disable_row",
        id:id,
        current_state:state

    });
}


    </script>

<?php $this->view("admin/footer", $data); ?>
