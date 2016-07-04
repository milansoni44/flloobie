    <!-- body content starts -->
    <div class="section">
        <div class="container">
            <div class="row review_listing">
                <h3 style="padding-left:15px;">Registration Form</h3>
                <hr style="width:100%;">
                <div id="infoMessage"><?php echo $message;?></div>
                <?php echo form_open("auth/create_user","class='form-horizontal'");?>
                    <table style="width:70%;margin-left:100px;cellpadding:0 cellspacing:0" class="table borderless">
                        <tr>
                            <td><?php echo lang('create_user_fname_label', 'first_name');?> </td>
                            <td><?php echo form_input($first_name);?></td>
                        </tr>
                        <tr>
                            <td><?php echo lang('create_user_lname_label', 'last_name');?> </td>
                            <td><?php echo form_input($last_name);?></td>
                        </tr>
                        <!--<tr>
                            <td>User Name: </td>
                            <td><input type="text" class="form-control" id="username" placeholder="discription"></td>
                        </tr>-->
                        <tr>								
                            <td><?php echo form_label('Date of Birth','dob') ?></td>
                                <td> 
                                    <div class="form-group">
                                        <select class="form-control" style="width:29%;float:left;margin-left:15px;margin-right:15px;" name="day"> 
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                        </select>			
                                        <select class="form-control" style="width:29%;float:left;padding:2px;" name="month">
                                            <option value="1">January</option>
                                            <option value="2">February</option>
                                            <option value="3">March</option>
                                            <option value="4">April</option>
                                        </select>
                                        <select class="form-control" style="width:29%;float:left;margin-left:15px;margin-right:15px" name="year"> 
                                            <option value="2011">2011</option>
                                            <option value="2012">2012</option>
                                            <option value="2013">2013</option>
                                            <option value="2014">2014</option>
                                        </select>
                                    </div>
                                </td>
                            </tr>
                        <tr>
                            <td><?php echo form_label('Gender','sex'); ?></td>
                            <div class="form-group">
                                <td><?php echo form_radio($gender,'Male',isset($_POST['sex']) && $_POST['sex'] == 'Male' ? 'Male':''); ?> Male
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo form_radio($gender,'Female',isset($_POST['sex']) && $_POST['sex'] == 'Female' ? 'Female':''); ?> Female</td>
                            </div>
                        </tr>
                        <tr>
                            <td><?php echo lang('create_user_email_label', 'email');?> </td>
                            <td><?php echo form_input($email);?></td>
                        </tr>
                        <tr>
                            <td><?php echo lang('create_user_password_label', 'password');?></td>
                            <td><?php echo form_input($password);?></td>
                        </tr>
                        <tr>
                            <td><?php echo lang('create_user_password_confirm_label', 'password_confirm');?></td>
                            <td><?php echo form_input($password_confirm);?></td>
                        </tr>
                        <tr>
                            <td><?php echo form_label('Country','country'); ?></td>
                            <td>
                                <select class="form-control" name="country"> 
                                    <option value="india">india</option>
                                    <option value="usa">usa</option>
                                    <option value="japan">japan</option>
                                    <option value="china">china</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><?php echo form_label('City:','city'); ?></td>
                            <td><?php echo form_input($city); ?></td>
                        </tr>
                        <tr>
                            <td><?php echo form_label('Pincode:','pincode'); ?></td>
                            <td><?php echo form_input($pincode); ?></td>
                        </tr>
                        <tr>
                            <td><?php echo form_label('Address:','address') ?></td>
                            <td><?php echo form_textarea($address); ?></td>
                        </tr>
                        <tr><td></td>
                            <td>
                                <?php echo form_submit('submit', 'Register','class="btn prmbtn1"');?>
                                <button type="reset" class="btn prmbtn1" class="btn btn-default">Reset</button>

                            </td>
                        </tr>
                    </table>
                <?php echo form_close();?>
            </div>
        </div><!-- container closed here  -->
    </div><!-- section closed here  -->