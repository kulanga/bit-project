<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            
            <h3 class="text-muted">
                Add New Subject
            </h3>

            <div class="col-md-8 pad-left-0">
                <form role="form" name="manage_ac_user_form" method="post" action="/admin/subject/save">
                    <div class="form-group">
                        <label for="full_name">Subject Name<span class="required">*</span></label>
                        <input type="text" class="form-control" id="subject_name" name="subject_name" required="" />
                    </div>

                    <div class="form-group">
                        <label for="email">Subject Code<span class="required">*</span></label>
                        <input type="text" class="form-control" id="subject_code" name="subject_code" required=""/>
                    </div>

                   
                    <button type="submit" class="btn btn-primary">Create</button>&nbsp;&nbsp;
                     <button type="submit" class="btn btn-primary">Create & Exit</button>&nbsp;&nbsp;
                    <button type="submit" class="btn btn-danger">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>