<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<div class="container-fluid">
    <div class="row">
    <h2 class="text-muted admin-page-title">
            Add location
        </h2><br/>
        <div class="col-md-8">
                      
            <div class="col-md-8 pad-left-0 col-md-offset-2">
                <form role="form" name="manage_location_form" method="post" action="/admin/admin_manage_location/add_location">
                    <div class="form-group">
                        <label for="laction_name">Location<span class="required">*</span></label>
                        <input type="text" class="form-control" id="location" name="location_name" required="" />
                    </div>               
                   
                    <button type="submit" name="btn_create" value="btn_create" class="btn btn-primary">Create</button>&nbsp;&nbsp;                    
                    <button type="submit" class="btn btn-danger">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>