    <script>
        jQuery(document).ready(function() {
            // Chosen Select
            jQuery("select").chosen({
                'min-width': '100px',
                'white-space': 'nowrap',
                disable_search_threshold: 10
            });
        });
    </script>
    <?php
        $sub_category_code = array(
            'name'          => 'sub_category_code',
            'id'            => 'sub_category_code',
            'type'          => 'text',
            'placeholder'   => 'Sub Category Code',
            'class'         => 'form-control',
            'value'         => $this->form_validation->set_value('sub_category_code',$sub_category->sub_category_code),
        );
        $sub_category_name = array(
            'name'          => 'sub_category_name',
            'id'            => 'sub_category_name',
            'type'          => 'text',
            'placeholder'   => 'Sub Category Name',
            'class'         => 'form-control',
            'value'         => $this->form_validation->set_value('sub_category_name',$sub_category->sub_category_name),
        );
        $sub_category_description = array(
            'name'          => 'sub_category_description',
            'id'            => 'sub_category_description',
            'type'          => 'text',
            'placeholder'   => 'Sub Category Description',
            'class'         => 'form-control',
            'cols'          => 50,
            'rows'          => 5,
            'value'         => $this->form_validation->set_value('sub_category_description',$sub_category->sub_category_description),
        );
        $sub_category_image = array(
            'name'          => 'sub_category_image',
            'id'            => 'sub_category_image',
            'type'          => 'file',
            'class'         => 'form-control',
            // 'value'         => $this->form_validation->set_value('sub_category_image'),
        );
        $subcategory_img = array(
            'name'  => 'subcategory_img',
            'type'  => 'hidden',
            'value' => $sub_category->sub_category_image,
        );
    ?>
    <div class="contentpanel">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-btns">
                    <a href="#" class="panel-close">&times;</a>
                    <a href="#" class="minimize">&minus;</a>
                </div>
                <h4 class="panel-title"><?php echo $page_title;?></h4>
            </div>
            <?php
                if($errors){
                    foreach($errors as $error){
            ?>
                    <div class="alert alert-block alert-danger fade in">
                        <button type="button" class="close close-sm" data-dismiss="alert">
                            <i class="fa fa-times"></i>
                        </button>
                        <?php echo $error; ?>
                    </div>
            <?php
                    }
                }
            ?>
            <?php echo form_open_multipart('subcategory/edit/'.$id,'class="form-horizontal form-bordered"'); ?>
                <div class="panel panel-default">
                        <div class="form-group">
                            <?php echo form_label('Category','category',array('class'=>'col-sm-3 control-label')); ?>
                            <div class="col-sm-6">
                                <?php
                                    $option = array('0'=>'Select Category');
                                    if(!empty($category)){
                                        foreach($category as $row){
                                            $option[$row->id] = $row->category_code."-".$row->category_name;
                                        }
                                    }
                                ?>
                                <?php echo form_dropdown('category',$option,$sub_category->category_id,'class="form-control chosen-select" style="width:50%;" id="category"'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <?php echo form_label('Sub Category Code','sub_category_code',array('class'=>'col-sm-3 control-label')); ?>
                            <div class="col-sm-6">
                                <?php echo form_input($sub_category_code); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <?php echo form_label('Sub Category Name','sub_category_name',array('class'=>'col-sm-3 control-label')); ?>
                            <div class="col-sm-6">
                                <?php echo form_input($sub_category_name); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <?php echo form_label('Sub Category Description','sub_category_description',array('class'=>'col-sm-3 control-label')); ?>
                            <div class="col-sm-6">
                                <?php echo form_textarea($sub_category_description); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <?php echo form_label('Sub Category Image','sub_category_image',array('class'=>'col-sm-3 control-label')); ?>
                            <div class="col-sm-6">
                                <?php echo form_input($sub_category_image); ?>
                            </div>
                        </div>
                        <?php echo form_input($subcategory_img) ?>
                        <div class="panel-footer">
                            <button class="btn btn-primary">Submit</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                        </div>
                </div><!-- panel-body -->
            <?php echo form_close(); ?>
        </div><!-- panel -->
    </div><!-- contentpanel -->