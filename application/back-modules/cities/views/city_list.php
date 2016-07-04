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
                <h5 class="subtitle mb5"><?php echo $page_title; ?></h5>
                <br />
                <div class="table-responsive">
                    <table class="table" id="table2">
                        <thead>
                            <tr>
                                <th>City Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($city)) {
                                foreach($city as $row){
                            ?>
                            <tr class="odd gradeX">
                                <td><?php echo $row->name; ?></td>
                                <td class="center"><?php echo anchor('cities/disable/'.$row->id,'Disable',array('onclick' => "return confirm('Are you sure')")); ?></td>
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