    <!-- body content starts -->
    <div class="section">
        <div class="container">
            <div class="row review_listing">
                <h3 style="padding-left:15px;">Registration Form</h3>
                <hr style="width:100%;">
                <div id="infoMessage"><?php echo $message;?></div>
                <?php echo form_open_multipart("auth/create_user","class='form-horizontal'");?>
                    <table style="width:70%;margin-left:100px;cellpadding:0 cellspacing:0" class="table borderless">
                        <tr>
                            <td><?php echo lang('create_user_fname_label', 'first_name');?> </td>
                            <td><?php echo form_input($first_name);?></td>
                        </tr>
                        <tr>
                            <td><?php echo lang('create_user_lname_label', 'last_name');?> </td>
                            <td><?php echo form_input($last_name);?></td>
                        </tr>
                        <tr>
                            <td><?php echo form_label('Phone','phone') ?></td>
                            <td><?php echo form_input($phone);?></td>
                        </tr>
                        <tr>								
                            <td><?php echo form_label('Date of Birth','dob') ?></td>
                                <td> 
                                    <div class="form-group">
                                        <select class="form-control" style="width:29%;float:left;margin-left:15px;margin-right:15px;" name="day"> 
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                            <option value="11">11</option>
                                            <option value="12">12</option>
                                            <option value="13">13</option>
                                            <option value="14">14</option>
                                            <option value="15">15</option>
                                            <option value="16">16</option>
                                            <option value="17">17</option>
                                            <option value="18">18</option>
                                            <option value="19">19</option>
                                            <option value="20">20</option>
                                            <option value="21">21</option>
                                            <option value="22">22</option>
                                            <option value="23">23</option>
                                            <option value="24">24</option>
                                            <option value="25">25</option>
                                            <option value="26">26</option>
                                            <option value="27">27</option>
                                            <option value="28">28</option>
                                            <option value="29">29</option>
                                            <option value="30">30</option>
                                            <option value="31">31</option>
                                        </select>			
                                        <select class="form-control" style="width:29%;float:left;padding:2px;" name="month">
                                            <option value="1">January</option>
                                            <option value="2">February</option>
                                            <option value="3">March</option>
                                            <option value="4">April</option>
                                            <option value="5">May</option>
                                            <option value="6">June</option>
                                            <option value="7">July</option>
                                            <option value="8">August</option>
                                            <option value="9">September</option>
                                            <option value="10">October</option>
                                            <option value="11">November</option>
                                            <option value="12">December</option>
                                        </select>
                                        <select class="form-control" style="width:29%;float:left;margin-left:15px;margin-right:15px" name="year"> 
                                            <option value="1985">1985</option>
                                            <option value="1986">1986</option>
                                            <option value="1987">1987</option>
                                            <option value="1988">1988</option>
                                            <option value="1989">1989</option>
                                            <option value="1990">1990</option>
                                            <option value="1991">1991</option>
                                            <option value="1992">1992</option>
                                            <option value="1993">1993</option>
                                            <option value="1994">1994</option>
                                            <option value="1995">1995</option>
                                            <option value="1996">1996</option>
                                            <option value="1997">1997</option>
                                            <option value="1998">1998</option>
                                            <option value="1999">1999</option>
                                            <option value="2000">2000</option>
                                            <option value="2001">2001</option>
                                            <option value="2002">2002</option>
                                            <option value="2003">2003</option>
                                            <option value="2004">2004</option>
                                            <option value="2005">2005</option>
                                            <option value="2006">2006</option>
                                            <option value="2007">2007</option>
                                            <option value="2008">2008</option>
                                            <option value="2009">2009</option>
                                            <option value="2010">2010</option>
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
                            <td><?php //echo form_input($city); ?>
                                <?php
                                    $optionC = array('0'=>'Select City');
                                    if(!empty($cities)){
                                        foreach($cities as $rt){
                                            $optionC[$rt->id] = $rt->name;
                                        }
                                    }
                                    echo form_dropdown('city',$optionC,isset($_POST['city'])?$_POST['city']:'','class="form-control" id="city"');
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td><?php echo form_label('State:','state'); ?></td>
                            <td><?php //echo form_input($state); ?>
                                <?php
                                    $optionS = array('0'=>'Select State');
                                    if(!empty($states)){
                                        foreach($states as $rw){
                                            $optionS[$rw->id] = $rw->name;
                                        }
                                    }
                                    echo form_dropdown('state',$optionS,isset($_POST['state'])?$_POST['state']:'','class="form-control" id="state"');
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td><?php echo form_label('Pincode:','pincode'); ?></td>
                            <td><?php echo form_input($pincode); ?></td>
                        </tr>
                        <tr>
                            <td><?php echo form_label('Address:','address') ?></td>
                            <td><?php echo form_textarea($address); ?></td>
                        </tr>
                        <tr>
                            <td><?php echo form_label('Image:','image') ?></td>
                            <td><?php echo form_input($image); ?></td>
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
