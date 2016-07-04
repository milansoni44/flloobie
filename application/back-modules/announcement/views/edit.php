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
            <?php echo form_open_multipart('announcement/edit/'.$id,'class="form-horizontal form-bordered"'); ?>
                <div class="panel panel-default">
                        <div class="form-group">
                            <?php echo form_label('Title','title',array('class'=>'col-sm-3 control-label')); ?>
                            <div class="col-sm-6">
                                <?php echo form_input($title); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <?php echo form_label('Message','message',array('class'=>'col-sm-3 control-label')); ?>
                            <div class="col-sm-8">
                                <?php echo form_textarea($message); ?>
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