	<script type="text/javascript">
        $(document).ready(function(){
            $('#category_form').submit(function(){
                var category = $('#category option:selected').val();
                if(category == '0'){
                    $("#msg").html("<b>Please select a category</b>");
                    return false;
                }
            });
            $('#category').change(function(){
                var cat = $('#category').val();
                var data = {
                "category": cat
                };
                $.ajax({
                    type: "POST",
                    datatype: "json",
                    url: "<?php echo base_url(); ?>index.php/listings/getSubCategory",
                    data: data,
                    success: function(data){
                        var dataSub = $.parseJSON(data);
                        // console.log(dataSub);
                        var options = '<option val="0"> Select Sub Category </option>';
                        $.each(dataSub, function (index, value) {
                            options += "<option value='"+value.id+"'>"+value.sub_category_name+"</option>";
                        });
                        $('#sub_category').html(options);
                    }
                });
                return false;
            });
        });
    </script>
    <!-- body content starts -->
    <div class="section">
        <div class="container">
            <div class="row review_listing">
                <div class="row">
                    <div class="col-md-12">
                        <h3 style="padding-left:15px;">Create ad</h3>
                    </div>
                    
                </div>
                <hr style="width:100%;">
                <form method="post" action="<?php echo base_url(); ?>index.php/listings/create_listing" id="category_form">
                    <div class="select_category">
                        <div class="selectcat">
                            <span id="selectcat1">Select Category:</span>
                        </div>
                        <div id="msg"></div>
                        <div class="dropdowncat">
                            <?php
                                $optionCat = array('0'=>'Select Category');
                                if(!empty($category)){
                                    foreach($category as $row){
                                        $optionCat[$row->id] = $row->category_name;
                                    }
                                }
                                echo form_dropdown('category',$optionCat,'','class="form-control" id="category"');
                            ?>
                        </div>
                        <div class="dropdowncat2">
                            <?php
                                $optionSubCat = array('0'=>'Select Sub Category');
                                if(!empty($sub_category)){
                                    foreach($sub_category as $row){
                                        $optionSubCat[$row->id] = $row->sub_category_name;
                                    }
                                }
                                echo form_dropdown('sub_category',$optionSubCat,'','class="form-control" id="sub_category"');
                            ?>
                        </div>
                    </div>
                    <div class="submitbtn">
                        <input type="submit" class="btn prmbtn1" value="Submit" />
                    </div>
                </form>
            </div>
        </div><!-- Container Closed Here  -->
    </div><!-- Section Closed Here  -->