
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
        <h1 class="page-title"> Student Marks List
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
                            <span class="caption-subject font-red sbold uppercase">Edit Student Marks</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <!-- BEGIN FORM-->
                        <form action="<?php echo base_url(); ?>marks/update_student_marks" method="post" id="student_add_form">
                            <div class="form-body">
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <div class="input-group">
                                        <input readonly="" type="text" class="form-control" name="student_full_name" id="form_control_1" value="<?php echo $user_data->full_name; ?>">
                                        <label for="form_control_1">Student Name</label>
                                        <span class="input-group-addon">
                                            <i class="fa fa-graduation-cap"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <div class="input-group">
                                        <input readonly=""  type="text" class="form-control" name="course_name" value="<?php echo $user_data->course_name; ?>">
                                        <label for="form_control_1">Course name</label>
                                        <span class="input-group-addon">
                                            <i class="fa fa-navicon"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <div class="input-group">
                                        <input type="number" class="form-control" name="percentage" value="<?php echo $user_data->percentage; ?>">
                                        <label for="form_control_1">Percentage</label>
                                        <span class="input-group-addon">
                                            <i class="fa fa-mobile-phone"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <div class="input-group">
                                        <input class="form-control form-control-inline input-medium date-picker" placeholder="Course Start Date" value="<?php echo $user_data->started_date; ?>"  data-date-format="yyyy-mm-dd" size="16" type="text" name="started_date">
                                        <span class="help-block"> Course Start Date </span>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <div class="input-group">
                                        <input class="form-control form-control-inline input-medium date-picker" placeholder="Course End Date" value="<?php echo $user_data->ended_date; ?>" data-date-format="yyyy-mm-dd" size="16" type="text" name="ended_date">
                                        <span class="help-block"> Course End Date </span>
                                    </div>
                                </div>
                                <input type="hidden" name="marks_id" value="<?php echo $user_data->marks_id; ?>">
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
                        <!-- END FORM-->
                    </div>
                </div>
                <!-- END VALIDATION STATES-->
            </div>
        </div>
    </div>
    <!-- END CONTENT BODY -->
</div>
<!-- END CONTENT -->