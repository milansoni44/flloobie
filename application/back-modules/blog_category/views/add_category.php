    <div class="contentpanel">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-btns">
                    <a href="#" class="panel-close">&times;</a>
                    <a href="#" class="minimize">&minus;</a>
                </div>
                <h4 class="panel-title"><?php echo $page_title;?></h4>
            </div>
            <?php echo form_open('blog_category/add','class="form-horizontal form-bordered"'); ?>
                <div class="panel panel-default">
                        <div class="form-group">
                            <?php echo form_label('Blog Category Name','category_name',array('class'=>'col-sm-3 control-label')); ?>
                            <div class="col-sm-6">
                                <?php echo form_input($cat_name); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <?php echo form_label('Category Description','category_description',array('class'=>'col-sm-3 control-label')); ?>
                            <div class="col-sm-6">
                                <?php echo form_textarea($cat_description); ?>
                            </div>
                        </div>
                        <div class="panel-footer">
                            <button class="btn btn-primary">Submit</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                        </div>
                </div><!-- panel-body -->
            <?php echo form_close(); ?>
        </div><!-- panel -->
    </div><!-- contentpanel -->