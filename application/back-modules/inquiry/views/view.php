    <div class="contentpanel">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-btns">
                    <a href="#" class="panel-close">&times;</a>
                    <a href="#" class="minimize">&minus;</a>
                </div>
                <h4 class="panel-title"><?php echo $page_title;?></h4>
            </div>
            <div class="panel panel-default">
                    <div class="form-group">
                        <?php echo form_label('First Name','first_name',array('class'=>'col-sm-3 control-label')); ?>
                        <div class="col-sm-6">
                            <?php echo $inq->first_name; ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <?php echo form_label('Last Name','last_name',array('class'=>'col-sm-3 control-label')); ?>
                        <div class="col-sm-6">
                            <?php echo $inq->last_name; ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <?php echo form_label('Email','email',array('class'=>'col-sm-3 control-label')); ?>
                        <div class="col-sm-6">
                            <?php echo $inq->email; ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <?php echo form_label('Subject','subject',array('class'=>'col-sm-3 control-label')); ?>
                        <div class="col-sm-6">
                            <?php echo $inq->subject; ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <?php echo form_label('Message','message',array('class'=>'col-sm-3 control-label')); ?>
                        <div class="col-sm-6">
                            <?php echo $inq->message; ?>
                        </div>
                    </div>
            </div><!-- panel-body -->
        </div><!-- panel -->
    </div><!-- contentpanel -->