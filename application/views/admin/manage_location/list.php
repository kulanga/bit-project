<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<div class="container-fluid">
    <div class="row">
    <h2 class="text-muted admin-page-title">
            Location list
        </h2><br/>
        <div class="dataTable_wrapper">
         <table class="table table-striped table-hover" id="subjects-table">
                <thead>
                    <tr>
                        <th>Location</th>
                        
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach($list as $l) {?>
                        <tr id='row-<?=$l->id?>'>
                            <td><?=$l->name?></td>                           
                            
                            <td>
                                <a href="#"   data-location-id="<?=$l->id?>" role="button" class="btn btn-sm btn-danger btn-delete">Delete</a>
                                
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('.btn-delete').on('click', function() {
            var lid = $(this).data('location-id');
            bootbox.confirm('Are you sure you want to delete?', function(confirm) {
                if(confirm) {
                    delete_location(lid);
                }

            })
        });
    });

    function delete_location(id) {
        $.ajax({
            url: '/admin/admin_manage_location/del_location/' + id,
            type: 'get',
            success: function(res) {
                if(res == '1') {
                   $('#row-' + id).remove();
                }
            }
        });
    }
</script>