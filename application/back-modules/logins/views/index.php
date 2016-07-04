   <script>
        jQuery(document).ready(function() {
            jQuery('#table2').dataTable({
                "order": [0, 'desc'],
            });
            
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
                                <th>No</th>
                                <th>User Name</th>
                                <th>Login Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($result)) {
                                foreach($result as $row){
                            ?>
                            <tr class="odd gradeX">
                                <td><?php echo $row->ID; ?></td>
                                <td><?php echo $row->first_name; ?></td>
                                <td><?php echo $row->timestamp; ?></td>
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