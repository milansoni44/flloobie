    <script>
        jQuery(document).ready(function() {
            // Chosen Select
            jQuery("select").chosen({
                'min-width': '100px',
                'white-space': 'nowrap',
                disable_search_threshold: 10
            });
            $('#states').change(function(){
                var state_arr = new Array();
                $("#states option:selected").each(function(){
                   // myIDS.push($(this).val());
                   state_arr.push($(this).val());
                });
                var state_IDS = state_arr.toString();
                var form_data = {
                    state: state_IDS,
                }
                $.ajax({
                    url: "<?php echo base_url(); ?>cities/getCities",
                    type: "POST",
                    dataType: 'json',
                    data: form_data,
                    success: function(data){
                        console.log(data);
                        // $.each syntax
                        // $.each(obj, function(key,value)){
                                
                        // }
                        var option = ''; 
                        $.each(data, function(key, value){
                            option += '<option value="'+value.id+'">'+value.name+'</option>';
                        });
                        var select = '<select id="cities" class="form-control" name="cities[]" multiple>'+option+'</select>';
                        $('#city-drop').html(select);
                        $("#cities").chosen({
                            'min-width': '100px',
                            'white-space': 'nowrap',
                            disable_search_threshold: 10
                        });
                        console.log(option);
                    }
                });
            });
            // $('#city-state').submit(function(){
                // var state = $('#states').val();
                // var state_str = state.toString();
                // return false;
            // });
        });
    </script>
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
            <?php echo form_open('cities/city_setting','class="form-horizontal form-bordered" id="city-state"'); ?>
                <div class="panel panel-default">
                        <div class="form-group">
                            <?php echo form_label('States','states',array('class'=>'col-sm-3 control-label')); ?>
                            <div class="col-sm-6">
                                <?php
                                    $option = array();
                                    if(!empty($states)){
                                        foreach($states as $row){
                                            $option[$row->id] = $row->name; 
                                        }
                                    }
                                ?>
                                <?php echo form_multiselect('states[]',$option,isset($_POST['state'])?$_POST['state']:'','class="form-control chosen-select" id="states" style="width:50%"'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <?php echo form_label('Cities','cities',array('class'=>'col-sm-3 control-label')); ?>
                            <div class="col-sm-6" id="city-drop">
                                <select name="cities[]" id="cities" class="form-control" multiple>
                                </select>
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