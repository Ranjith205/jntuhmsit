<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <!-- BEGIN PAGE BAR -->
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <a href="#">Home</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>Dashboard</span>
                </li>
            </ul>
            <div class="page-toolbar">
                <div id="dashboard-report-range" class="pull-right tooltips btn btn-sm" data-container="body" data-placement="bottom" data-original-title="Change dashboard date range">
                    <i class="icon-calendar"></i>&nbsp;
                    <span class="thin uppercase hidden-xs"></span>&nbsp;
                    <i class="fa fa-angle-down"></i>
                </div>
            </div>
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h1 class="page-title"> Admin Dashboard</h1>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <!-- BEGIN DASHBOARD STATS 1-->
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a class="dashboard-stat dashboard-stat-v2 blue" href="<?php echo base_url();?>post_event/event_list">
                    <div class="visual">
                        <i class="fa fa-comments"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <span data-counter="counterup" data-value="1349"><?php echo $event_count; ?></span>
                        </div>
                        <div class="desc"> Events </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a class="dashboard-stat dashboard-stat-v2 red" href="<?php echo base_url(); ?>leave_approvel/leave_approvel_list">
                    <div class="visual">
                        <i class="fa fa-bar-chart-o"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <span ><?php echo $leave_approvel_count; ?></span>
                        </div>
                        <div class="desc"> Leave Approvals Pending</div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a class="dashboard-stat dashboard-stat-v2 green" href="#">
                    <div class="visual">
                        <i class="fa fa-shopping-cart"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <span ><?php echo $student_leaves_exceeded; ?> </span>
                        </div>
                        <div class="desc"> Students Exceeded Leaves </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a class="dashboard-stat dashboard-stat-v2 purple" href="#">
                    <div class="visual">
                        <i class="fa fa-globe"></i>
                    </div>
                    <div class="details">
                        <div class="number"><span ><?php echo $student_failed; ?>  </span></div>
                        <div class="desc"> Students Failed </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="clearfix"></div>
        <!-- END DASHBOARD STATS 1-->
        <div class="row">
            <div class="col-lg-6 col-xs-12 col-sm-12">
                <div class="portlet light bordered">
                    <div class="portlet-title tabbable-line">
                        <div class="caption">
                            <i class="icon-bubbles font-dark hide"></i>
                            <span class="caption-subject font-dark bold uppercase">Events</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="tab-content">
                            <div class="tab-pane active" id="portlet_comments_1">
                                <!-- BEGIN: Comments -->
                                <?php foreach ($event_list as $event) { ?>
                                    <div class="mt-comments">
                                        <div class="mt-comment">
                                            <div class="mt-comment-body">
                                                <div class="mt-comment-info">
                                                    <span class="mt-comment-author"><?php echo $event['title']; ?></span>
                                                    <span class="mt-comment-date"><?php echo $event['event_date']; ?></span>
                                                </div>
                                                <div class="mt-comment-text"> <?php echo $event['description']; ?></div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                                <!-- END: Comments -->
                                <a href ="<?php echo base_url(); ?>post_event/event_list" class="pull-right">see more...</a><br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-xs-12 col-sm-12">
                <div class="portlet light bordered">
                    <div class="portlet-title tabbable-line">
                        <div class="caption">
                            <i class=" icon-social-twitter font-dark hide"></i>
                            <span class="caption-subject font-dark bold uppercase">Leave Approvals</span>
                        </div>
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#tab_actions_pending" data-toggle="tab"> Pending </a>
                            </li>
                        </ul>
                    </div>
                    <div class="portlet-body">
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_actions_pending">
                                <!-- BEGIN: Actions -->
                                <div class="mt-actions">
                                    <!-- 
                                    <div class="mt-action">
                                        <div class="mt-action-img">
                                            <img src="<?php echo base_url(); ?>assets/pages/media/users/avatar8.jpg" /> </div>
                                        <div class="mt-action-body">
                                            <div class="mt-action-row">
                                                <div class="mt-action-info ">
                                                    <div class="mt-action-icon ">
                                                        <i class="icon-magnet"></i>
                                                    </div>
                                                    <div class="mt-action-details ">
                                                        <span class="mt-action-author">Donna Clarkson </span>
                                                        <p class="mt-action-desc">Simply dummy text of the printing</p>
                                                    </div>
                                                </div>
                                                <div class="mt-action-datetime ">
                                                    <span class="mt-action-date">3 jun</span>
                                                    <span class="mt-action-dot bg-green"></span>
                                                    <span class="mt-action-time">9:30-13:00</span>
                                                </div>
                                                <div class="mt-action-buttons ">
                                                    <div class="btn-group btn-group-circle">
                                                        <button type="button" class="btn btn-outline green btn-sm">Appove</button>
                                                        <button type="button" class="btn btn-outline red btn-sm">Reject</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END CONTENT BODY -->
</div>