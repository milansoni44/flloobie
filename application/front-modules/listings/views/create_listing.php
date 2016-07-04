    <script>
    function validate(){
        $("#file_error").html("");
        $(".demoInputBox").css("border-color","#F0F0F0");
        var file_size = $('#image')[0].files[0].size;
        if(file_size>1048576) {
            alert("File size is greater than 1MB");
            $("#file_error").html("File size is greater than 2MB");
            $(".demoInputBox").css("border-color","#FF0000");
            return false;
        } 
        return false;
    }
  // When the browser is ready...
  $(function() {
    // Setup form validation on the #register-form element
    $("#register-form").validate({
    
        // Specify the validation rules
        rules: {
            title: "required",
            price: { required: true, number: true, },
            description: "required",
            phone: {
                required: true,
                number: true,
            },
            street: {
                required: true,
                lettersonly: true,
            },
            country: "required",
            zip: {
                required: true,
                number: true,
            },
            tag: "required",
            google_map: "required",
            image: {
                required: true,
                accept: "image/*",
            },
            listing_type: "required",
            // email: {
                // required: true,
                // email: true
            // },
            // password: {
                // required: true,
                // minlength: 5
            // },
            // agree: "required"
        },
        
        // Specify the validation error messages
        messages: {
            title: "Please enter your title.",
            price: { 
                required : "Please enter your price.",
                number : "Please enter only number in price.",
            },
            description: "Please Enter description.",
            phone: {
                required: "Please Enter your phone number.",
                number: "Enter only number in phone.",
            },
            street: {
                required: "Please Enter street.",
                lettersonly: "Please Enter only characters street.",
            },
            country: "Please Enter your country",
            zip: {
                required: "Please enter zip/postal code",
                number: "Only numbers allowed.",
            },
            tag: "Please enter tag.",
            google_map: "Please enter google map iframe",
            image: {
                required: "Image is required.",
                accept: "Only images allowed.",
            },
            listing_type: "Please select appropriate listing type.",
            // password: {
                // required: "Please provide a password",
                // minlength: "Your password must be at least 5 characters long"
            // },
            // email: "Please enter a valid email address",
            // agree: "Please accept our policy"
        },
        
        submitHandler: function(form) {
            form.submit();
        }
    });

  });
  
  </script>
    <!-- body content starts -->
    <div class="section">
        <div class="container">
            <div class="row review_listing">
                <h3 style="padding-left:15px;">Create new Ad</h3>
                <hr style="width:100%;">
                <?php
                    // if($errors){
                        // foreach($errors as $error){
                ?>
                        <!--<div class="alert alert-block alert-danger fade in">
                            <button type="button" class="close close-sm" data-dismiss="alert">
                                <i class="fa fa-times"></i>
                            </button>
                            <?php echo $error; ?>
                        </div>-->
                <?php
                        // }
                    // }
                ?>
                <?php echo form_open_multipart('listings/create_listing',array('class'=>'form-horizontal','id'=>'register-form', 'onSubmit'=>"return validate();")) ?>
                     <table style="width:50%;margin-left:100px;cellpadding:0 cellspacing:0" class="table borderless">
                        <tr>
                            <td><?php echo form_label('Category:','category'); ?> </td>
                            <td><?php echo $this->session->userdata('category').'/'.$this->session->userdata('sub_category');?><a href="<?php echo base_url(); ?>index.php/listings/createadv">(change)</a></td>
                        </tr>
                        <tr>
                            <td><?php echo form_label('Title:','title'); ?> </td>
                            <td><?php echo form_input($title); ?></td>
                        </tr>
                        <tr>
                            <td><?php echo form_label('Price:','price'); ?> </td>
                            <td><?php echo form_input($price); ?></td>
                        </tr>
                        <tr>
                            <td><?php echo form_label('Description:','description'); ?></td>
                            <td><?php echo form_textarea($description); ?></td>
                        </tr>
                        <tr>
                            <td><?php echo form_label('Preferred Contact Method:','contact_method'); ?> </td>
                            <td><input type="checkbox" name="contact_method[]" id="contact_method" value="Call"> Call<br/>
                                <input type="checkbox" name="contact_method[]" id="contact_method" value="Conatct Form"> Conatct Form<br/>
                                <input type="checkbox" name="contact_method[]" id="contact_method" value="Text"> Text<br/>
                            </td>
                        </tr>
                        <tr>
                            <td><?php echo form_label('Phone:','phone'); ?> </td>
                            <td><?php echo form_input($phone); ?></td>
                        </tr>
                        <tr>
                            <td><?php echo form_label('Street:','street'); ?></td>
                            <td><?php echo form_input($street); ?></td>
                        </tr>
                        <tr>
                            <td><?php echo form_label('Country:','country'); ?></td>
                            <td><?php echo form_input($country); ?></td>
                        </tr>
                        <tr>
                            <td><?php echo form_label('Zip/Postal code:','zip') ?> </td>
                            <td><?php echo form_input($zip); ?></td>
                        </tr>
                        <tr>
                            <td><?php echo form_label('Tag:','tag') ?></td>
                            <td><?php echo form_input($tags); ?></td>
                        </tr>
                        <tr>
                            <td><?php echo form_label('Google Map:','google_map') ?></td>
                            <td><?php echo form_input($google_map); ?></td>
                        </tr>
                        <tr>
                            <td><?php echo form_label('Image:','image'); ?></td>
                            <td><?php echo form_input($image); ?></td><span id="file_error"></span>
                        </tr>
                        <tr>
                            <td><?php echo form_label('Negotiable:','negotiable'); ?></td>
                            <td><?php echo form_input($negotiable); ?></td>
                        </tr>
                        <tr>
                            <td><?php echo form_label('Listing Type:','listing_type'); ?></td>
                            <td>
                                <?php
                                    $option = array(
                                        ''=> '--Select--',
                                        'free'=> 'Free',
                                        'paid'=> 'Paid',
                                    );
                                    echo form_dropdown('listing_type',$option,'','class="form-control" id="listing_type"');
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td align="center" colspan="2"><button type="submit" class="btn prmbtn1" class="btn btn-default" name="create">Submit</button></td>
                        </tr>
                </table>
                <?php echo form_input($cat_id); ?>
                <?php echo form_input($sub_cat_id); ?>
                <?php echo form_close(); ?>
            </div>
        </div><!-- container closed here  -->
    </div><!-- section closed here  -->