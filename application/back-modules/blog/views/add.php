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
            <?php echo form_open_multipart('blog/add','class="form-horizontal form-bordered"'); ?>
                <div class="panel panel-default">
                        <div class="form-group">
                            <?php echo form_label('Blog Category','blog_category',array('class'=>'col-sm-3 control-label')); ?>
                            <div class="col-sm-6">
                                <?php
                                    $option = array('0'=>'Select Category');
                                    if(!empty($blog_category)){
                                        foreach($blog_category as $row){
                                            $option[$row->id] = $row->blog_category_name; 
                                        }
                                    }
                                ?>
                                <?php echo form_dropdown('blog_category',$option,'','class="form-control" id="blog_category" style="width:50%"'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <?php echo form_label('Blog Name','blog_name',array('class'=>'col-sm-3 control-label')); ?>
                            <div class="col-sm-6">
                                <?php echo form_input($blog_name); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <?php echo form_label('Feature Image','feature_image',array('class'=>'col-sm-3 control-label')); ?>
                            <div class="col-sm-6">
                                <?php echo form_input($blog_featured_image); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <?php echo form_label('Blog Content','blog_content',array('class'=>'col-sm-3 control-label')); ?>
                            <div class="col-sm-8">
                                <?php echo form_textarea($blog_content); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <?php echo form_label('Blog Keyword','blog_keywords',array('class'=>'col-sm-3 control-label')); ?>
                            <div class="col-sm-6">
                                <?php echo form_input($blog_keywords); ?>
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