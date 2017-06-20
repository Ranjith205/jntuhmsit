<!-- BEGIN SIDEBAR -->
<div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">
        <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false"
            data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
            <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
            <li class="sidebar-toggler-wrapper hide">
                <div class="sidebar-toggler">
                    <span></span>
                </div>
            </li>
            <!-- DOC: To remove the search box from the sidebar you just need to completely remove the be -->
            <li class="sidebar-search-wrapper">
                <!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
                <form class="sidebar-search" action="page_general_search_3.html" method="POST">
                    <a href="javascript:;" class="remove">
                        <i class="icon-close"></i>
                    </a>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search...">
                        <span class="input-group-btn">
                            <a href="javascript:;" class="btn submit">
                                <i class="icon-magnifier"></i>
                            </a>
                        </span>
                    </div>
                </form>
                <!-- END RESPONSIVE QUICK SEARCH FORM -->
            </li>
            <?php $user_type = $this->login_user->user_type; if ($user_type == '3') { ?>
                <li class="nav-item  ">
                    <a href="<?php echo base_url() ?>students/upload_students" class="nav-link nav-toggle">
                        <i class="fa fa-graduation-cap"></i>
                        <span class="title">Upload Student</span>
                        <span class="arrow"></span>
                    </a>
                </li>
                <li class="nav-item  ">
                    <a href="<?php echo base_url() ?>marks/upload_students_marks" class="nav-link nav-toggle">
                        <i class="icon-bar-chart"></i>
                        <span class="title">Upload Marks</span>
                        <span class="arrow"></span>
                    </a>
                </li>
                <li class="nav-item  ">
                    <a href="<?php echo base_url() ?>course/course_enrollment" class="nav-link nav-toggle">
                        <i class="fa fa-graduation-cap"></i>
                        <span class="title">Upload Course  Enrollments</span>
                        <span class="arrow"></span>
                    </a>
                </li>
            <?php } else { ?>

                <li class="nav-item start ">
                    <a href="<?php echo base_url(); ?>Dashboard/show_dashboard" class="nav-link nav-toggle">
                        <i class="icon-home"></i>
                        <span class="title">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item  ">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="fa fa-graduation-cap"></i>
                        <span class="title">User Management</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item  ">
                            <a href="<?php echo base_url(); ?>students/students_list" class="nav-link ">
                                <span class="title">View Students</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="<?php echo base_url(); ?>students/show_parents" class="nav-link ">
                                <span class="title">View Parents</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="<?php echo base_url(); ?>mentors/mentors_list" class="nav-link ">
                                <span class="title">View Mentors</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="<?php echo base_url(); ?>clark/clark_list" class="nav-link ">
                                <span class="title">View Office Assistant</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item  ">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="icon-bar-chart"></i>
                        <span class="title">Marks</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item  ">
                            <a href="<?php echo base_url(); ?>marks/students_marks_list" class="nav-link ">
                                <span class="title">Students Marks List</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item  ">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="fa fa-graduation-cap"></i>
                        <span class="title">Courses</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item  ">
                            <a href="<?php echo base_url(); ?>course/show_course_list" class="nav-link ">
                                <span class="title">Courses List</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="<?php echo base_url(); ?>course/course_enrollment_list" class="nav-link ">
                                <span class="title">View Courses Enrollment</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item  ">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="icon-flag"></i>
                        <span class="title">Post Event</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item  ">
                            <a href="<?php echo base_url(); ?>post_event/event_list" class="nav-link ">
                                <span class="title">Events List</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item  ">
                    <a href="<?php echo base_url(); ?>leave_approvel/leave_approvel_list" class="nav-link nav-toggle">
                        <i class="icon-check"></i>
                        <span class="title">Leave Approvals</span>
                    </a>
                </li>
            <?php } ?>
        </ul>
        <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->
</div>