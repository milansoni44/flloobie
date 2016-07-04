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
                <h5 class="subtitle mb5"><?php echo $page_title; ?><span style="float:right;"><a href="<?php echo base_url(); ?>blog/add">Create Blog</a></span></h5>
                <br />
                <div class="table-responsive">
                    <table class="table" id="table2">
                        <thead>
                            <tr>
                                <th>Category Name</th>
                                <th>Blog Name</th>
                                <th>Blog Keywords</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($blog)) {
                                foreach($blog as $row){
                            ?>
                            <tr class="odd gradeX">
                                <td><?php echo $row->blog_category_name; ?></td>
                                <td><?php echo $row->blog_name; ?></td>
                                <td><?php echo $row->blog_keywords; ?></td>
                                <td class="center"><?php echo anchor('blog/edit/'.$row->id,'Edit'); ?></td>
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