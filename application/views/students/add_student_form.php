
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
        <h1 class="page-title"> Add Student(s) </h1>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN VALIDATION STATES-->
                <div class="portlet light portlet-fit portlet-form bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class=" icon-layers font-red"></i>
                            <span class="caption-subject font-red sbold uppercase">Upload Student Excel</span>
                        </div>
                        <div class="actions">
                            <div class="btn-group btn-group-devided" >
                                <form action="<?php echo base_url(); ?>students/students_list" method="post"  id="add_student">
                                    <button type="submit" class="btn purple-plum">Students List</button>
                               
                                <a href="<?php echo base_url(); ?>uploads/student_excel.xlsx">
                                    <button type="button" class="btn purple-plum">Download Sample Excel</button></a>
                                     </form>
                            </div>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <!-- BEGIN FORM-->
                        <form action="<?php echo base_url(); ?>students/file_upload_student" method="post" id="student_add_form" enctype="multipart/form-data">
                            <div class="form-body">
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <div class="input-group">
                                        <input type="file" class="form-control" name="file_upload_studdent" id="form_control_1">
                                        <span class="input-group-addon">
                                            <i class="fa fa-graduation-cap"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <div class="row ">
                                    <div class="col-md-12">
                                        <button type="submit"  class="btn dark ">Submit</button>
                                        <button type="reset" class="btn default">Reset</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!--                <div >
                                    <h1 style="width:100%;height:10%;text-align:center;position:relative;top:40%;">------------------------ Or ------------------------</h1>
                                </div>

                <div class="portlet light portlet-fit portlet-form bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class=" icon-layers font-red"></i>
                            <span class="caption-subject font-red sbold uppercase">Add Student</span>
                            <small>**If only one student to enter use this option</small>
                        </div>
                    </div>
                <!--                    <div class="portlet-body">
                                         BEGIN FORM
                                        <form action="<?php echo base_url(); ?>students/save_student" method="post" id="student_add_form">
                                            <div class="form-body">
                                                <div class="form-group form-md-line-input form-md-floating-label">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" name="name" id="form_control_1">
                                                        <label for="form_control_1">Full Name</label>
                                                        <span class="input-group-addon">
                                                            <i class="fa fa-graduation-cap"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="form-group form-md-line-input form-md-floating-label">
                                                    <div class="input-group">
                                                        <input type="password" class="form-control" name="password">
                                                        <label for="form_control_1">Password</label>
                                                        <span class="input-group-addon">
                                                            <i class="fa fa-key"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="form-group form-md-line-input form-md-floating-label">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" name="rollnumber">
                                                        <label for="form_control_1">Roll Number</label>
                                                        <span class="input-group-addon">
                                                            <i class="fa fa-navicon"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="form-group form-md-line-input form-md-floating-label">
                                                    <div class="input-group">
                                                        <input type="number" class="form-control" name="academic_year" maxlength="4">
                                                        <label for="form_control_1">Academic Year</label>
                                                        <span class="input-group-addon">
                                                            <i class="fa fa-calendar"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="form-group form-md-line-input form-md-floating-label">
                                                    <div class="input-group">
                                                        <input type="number" class="form-control" name="mobile">
                                                        <label for="form_control_1">Mobile Number</label>
                                                        <span class="input-group-addon">
                                                            <i class="fa fa-mobile-phone"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="form-group form-md-line-input form-md-floating-label">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" name="email">
                                                        <label for="form_control_1">Email</label>
                                                        <span class="input-group-addon">
                                                            <i class="fa fa-envelope"></i>
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
                                         END FORM
                                    </div>
            </div>-->
                <!-- END VALIDATION STATES-->
            </div>
        </div>
    </div>
    <!-- END CONTENT BODY -->
</div>
<!-- END CONTENT -->