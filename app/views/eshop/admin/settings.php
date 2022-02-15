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

<form method="post" enctype="multipart/form-data">

<table class="table table-striped table-advance table-hover">
<!----SOCIAL PAGE IN ADMIN PANEL---->
    <?php  if($type == "socials"): ?>
	<thead>
		<tr><th>Setting</th><th>Value</th></tr>
	</thead>
	<tbody>
		<?php if(isset($settings) && is_array($settings)):?>
			<?php foreach($settings as $setting):?>

			<tr>
                
                <td>
                    <?=ucwords(str_replace("_", " ", $setting->setting));?>
                </td>
                <td>
                    <?php if($setting->type == "" || $setting->type == "text"): ?>
                        <input placeholder="<?=ucwords(str_replace("_", " ", $setting->setting));?>" name="<?=$setting->setting;?>" class="form-control" type="text" value="<?=$setting->value;?>" />

                    <?php elseif($setting->type == "textarea"): ?>

                        <textarea placeholder="<?=ucwords(str_replace("_", " ", $setting->setting))?>" name="<?=$setting->setting?>" class="form-control" ><?=$setting->value?></textarea> 
                </td>
                <?php endif;?>

            </tr>
			<?php endforeach;?>
		<?php endif;?>
	</tbody>

    <input type="submit" value="Save Settings" class="btn btn-warning pull-right">

        <!----SLIDER IMAGES--->
    <?php  elseif($type == "slider_images"): ?>

        <?php if($action == "show"): ?>
        <thead>
		<tr><th>Header 1</th><th>Header 2 Text</th><th>Main Message</th><th>Product link</th><th>Product Image</th><th>Product Image 2</th><th>Disabled</th></tr>
	</thead>
	<tbody>


		<?php if(isset($rows) && is_array($rows)):?>
			<?php foreach($rows as $row):?>

			<tr>
                
                <td><?=$row->header1_text?></td>
                <td><?=$row->header2_text?></td>
                <td><?=$row->text?></td>
                <td><?=$row->link?></td>
                <td><img src="<?= ROOT .$row->image?>" style="width:130px;"/></td>
                <td><?=$row->disabled ? "Yes":"No"?></td>

            </tr>
       
			<?php endforeach;?>
		<?php endif;?>
	</tbody>

    <a href="<?=ROOT?>admin/settings/slider_images?action=add">
        <input type="button" value="Add Row" class="btn btn-warning pull-right">
    </a>
    <?php elseif($action == "add"):?>



        <h2>Add New Row</h2>
            <div class="form-group">
                <label for="header1_text">Header 1 Text</label>

                    <input  id="header1_text" type="text" value="<?= (isset($POST['header1_text'])) ? $POST['header1_text'] : ''; ?>" class="form-control" name="header1_text">
            </div>

            <div class="form-group">
                <label for="header2_text">Header 2 Text</label>

                    <input  id="header2_text" value="<?= (isset($POST['header2_text'])) ? $POST['header2_text'] : ''; ?>" type="text" class="form-control" name="header2_text">
            
            </div>
        
            <div class="form-group">
                <label for="text">Main message</label>

                    <textarea id="text" class="form-control" name="text"><?= (isset($POST['text'])) ? $POST['text'] : ''; ?></textarea>
            </div>


            <div class="form-group">
                <label for="link">Content Link</label>

                    <input  id="link" type="text" class="form-control" name="link" value="<?= (isset($POST['link'])) ? $POST['link'] : ''; ?>" placeholder="e.g http://yourwebsite.com/your_product">
            
            </div>


            <div class="form-group">
                <label for="Image"> Slider Image</label>

                <input id="image" class="form-control" type="file" name="image" >
            
            </div>

            <input type="submit" value="Add" class="btn btn-primary" style="float:right;">

        <?php endif; ?>
    <?php endif; ?>

</table>

</form>



<?php $this->view("admin/footer", $data); ?>
