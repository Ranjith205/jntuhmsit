
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <!-- BEGIN PAGE BAR -->
        <div class="page-bar">
            <div class="page-toolbar">
                <div class="btn-group pull-right">
                    <button type="button" class="btn green btn-sm btn-outline dropdown-toggle" data-toggle="dropdown"> Actions
                        <i class="fa fa-angle-down"></i>
                    </button>
                    <ul class="dropdown-menu pull-right" role="menu">
                        <li>
                            <a href="#">
                                <i class="icon-bell"></i> Action</a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="icon-shield"></i> Another action</a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="icon-user"></i> Something else here</a>
                        </li>
                        <li class="divider"> </li>
                        <li>
                            <a href="#">
                                <i class="icon-bag"></i> Separated link</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h1 class="page-title"> Edit Course
        </h1>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN VALIDATION STATES-->
                <div class="portlet light portlet-fit portlet-form bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class=" icon-layers font-red"></i>
                            <span class="caption-subject font-red sbold uppercase">Edit Course</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <!-- BEGIN FORM-->
                        <form action="<?php echo base_url(); ?>course/update_course" method="post" id="course_add_form">
                            <div class="form-body">
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <div class="input-group">
                                        <input readonly="" type="text" class="form-control" name="course_id" id="form_control_1" value ="<?php echo $course_data->cid ?>">
                                        <label for="form_control_1">Course Id</label>
                                        <span class="input-group-addon">
                                            <i class="fa fa-graduation-cap"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="course_name" id="form_control_1" value ="<?php echo $course_data->course_name ?>">
                                        <label for="form_control_1">Course Name</label>
                                        <span class="input-group-addon">
                                            <i class="fa fa-graduation-cap"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <div class="input-group">
                                        <input type="number" class="form-control" name="no_of_leaves" maxlength="4" value ="<?php echo $course_data->no_of_leaves ?>">
                                        <label for="form_control_1">No of Leaves in Course</label>
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <span class="help-block"> Select date range of Course </span>
                                    <div class="input-group input-large date-picker input-daterange"  data-date-format="yyyy-mm-dd">
                                        <input type="text" class="form-control" name="from_date" placeholder="form Date" value ="<?php echo $course_data->from_date ?>">
                                        <span class="input-group-addon"> to </span>
                                        <input type="text" class="form-control" name="to_date" value ="<?php echo $course_data->to_date ?>" placeholder="to Date"> </div>
                                    <br>
                                </div>
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <div class="input-group">
                                        <input type="number" class="form-control" name="credits" maxlength="4" value ="<?php echo $course_data->credits ?>" > 
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn dark">Submit</button>
                                        <button type="reset" class="btn default">Reset</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>