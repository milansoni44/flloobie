   <script>
        jQuery(document).ready(function() {
            jQuery('#table2').dataTable();
            
            // Chosen Select
            jQuery("select").chosen({
                'min-width': '100px',
                'white-space': 'nowrap',
                disable_search_threshold: 10
            });
        });
    </script>
    <!--<div class="pageheader">
        <h2><i class="fa fa-table"></i> Tables <span>Subtitle goes here...</span></h2>
        <div class="breadcrumb-wrapper">
            <span class="label">You are here:</span>
            <ol class="breadcrumb">
              <li><a href="index.html">Bracket</a></li>
              <li class="active">Tables</li>
            </ol>
        </div>
    </div>-->
    
    <div class="contentpanel">
        <div class="panel panel-default">
            <div class="panel-body">
                <h5 class="subtitle mb5"><?php echo $page_title; ?><span style="float:right;"><a href="<?php echo base_url(); ?>subcategory/add">Create SubCategory</a></span></h5>
                <br />
                <div class="table-responsive">
                    <table class="table" id="table2">
                        <thead>
                            <tr>
                                <th>Category</th>
                                <th>Sub Category Code</th>
                                <th>Sub Category Name</th>
                                <th>Sub Category Description</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($sub_category)) {
                                foreach($sub_category as $row){
                            ?>
                            <tr class="odd gradeX">
                                <td><?php echo $row->category_name; ?></td>
                                <td><?php echo $row->sub_category_code; ?></td>
                                <td><?php echo $row->sub_category_name; ?></td>
                                <td><?php echo $row->sub_category_description; ?></td>
                                <td class="center"><?php echo anchor('subcategory/edit/'.$row->id,'Edit'); ?></td>
                            </tr>
                            <?php
                                    }
                                }
                            ?>
                        </tbody>
                    </table>
                </div><!-- table-responsive -->
            </div><!-- panel-body -->
        </div><!-- panel -->
    </div><!-- contentpanel -->