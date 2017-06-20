<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <!-- BEGIN PAGE BAR -->
        <div class="page-bar">
            <ul class="page-breadcrumb">

            </ul>
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
        <h1 class="page-title"> Course List
        </h1>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-dark">
                            <form action="<?php echo base_url(); ?>course/add_course" method="post"  id="add_student">
                                <div class="btn-group btn-group-devided" >
                                    <button type="submit" class="btn purple-plum">Add Course</button>
                                </div>
                            </form>
                        </div>
                        <div class="actions">

                            <div class="btn-group">
                                <a class="btn red btn-outline btn-circle" href="javascript:;" data-toggle="dropdown">
                                    <i class="fa fa-share"></i>
                                    <span class="hidden-xs"> Trigger Tools </span>
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu pull-right" id="sample_3_tools">
                                    <li>
                                        <a href="javascript:;" data-action="0" class="tool-action">
                                            <i class="icon-printer"></i> Print</a>
                                    </li>
                                    <li>
                                        <a href="javascript:;" data-action="1" class="tool-action">
                                            <i class="icon-check"></i> Copy</a>
                                    </li>
                                    <li>
                                        <a href="javascript:;" data-action="2" class="tool-action">
                                            <i class="icon-doc"></i> PDF</a>
                                    </li>
                                    <li>
                                        <a href="javascript:;" data-action="3" class="tool-action">
                                            <i class="icon-paper-clip"></i> Excel</a>
                                    </li>
                                    <li>
                                        <a href="javascript:;" data-action="4" class="tool-action">
                                            <i class="icon-cloud-upload"></i> CSV</a>
                                    </li>
                                    <li class="divider"> </li>
                                    
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover table-header-fixed" id="sample_3">
                            <thead>
                                <tr class="">
                                    <th> Course id</th>
                                    <th> Course Name</th>
                                    <th> No. of Leaves </th>
                                    <th> Start Date </th>
                                    <th> End Date </th>
                                    <th> Course Credits </th>
                                    <th> Action </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($courselist as $course) { ?>
                                    <tr>
                                        <td> <?php echo $course['cid']; ?> </td>
                                        <td> <?php echo $course['course_name']; ?> </td>
                                        <td> <?php echo $course['no_of_leaves']; ?> </td>
                                        <td> <?php echo $course['from_date']; ?> </td>
                                        <td> <?php echo $course['to_date']; ?> </td>
                                        <td> <?php echo $course['credits']; ?> </td>
                                        <td> 
                                            <form action="<?php echo base_url(); ?>course/delete_course" method="post" id="delete_course_row_<?php echo $course['cid']; ?>" style="float:left"> 
                                                <input type="hidden" value="<?php echo $course['cid']; ?>" name ="cid"/>
                                                <button type="button" onclick="delete_course('delete_course_row_<?php echo $course['cid']; ?>')" class="btn red-mint"><i class="icon icon-trash"></i></button> 
                                            </form>
                                            <form action="<?php echo base_url(); ?>course/edit_course" method="post" id="edit_course_row_<?php echo $course['cid']; ?>"  style="float:left"> 
                                                <input type="hidden" value="<?php echo $course['cid']; ?>" name ="cid"/>
                                                <button type="button" onclick="edit_course('edit_course_row_<?php echo $course['cid']; ?>')" class="btn green-haze"><i class="icon icon-pencil"></i></button>
                                            </form>
                                            <?php if ($course['is_active'] == 1) { ?>
                                                <form action="<?php echo base_url(); ?>course/hide_course" method="post" id="hide_course_row_<?php echo $course['cid']; ?>"  style="float:left"> 
                                                    <input type="hidden" value="<?php echo $course['cid']; ?>" name ="cid"/>
                                                    <button type="button" onclick="hide_course('hide_course_row_<?php echo $course['cid']; ?>')" class="btn purple-plum"><i class="icon icon-eye-close"></i></button>
                                                </form>
                                            <?php } else { ?>
                                                <form action="<?php echo base_url(); ?>course/visible_course" method="post" id="visible_course_row_<?php echo $course['cid']; ?>"  style="float:left"> 
                                                    <input type="hidden" value="<?php echo $course['cid']; ?>" name ="cid"/>
                                                    <button type="button" onclick="visible_course('visible_course_row_<?php echo $course['cid']; ?>')" class="btn purple-plum"><i class="icon icon-eye-open"></i></button>
                                                </form>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->
            </div>
        </div>
    </div>
    <!-- END CONTENT BODY -->
</div>
<script>
    function delete_course(form_id) {
        if (confirm("Are you sure to delete the course?")) {
            $('form#' + form_id).submit();
        }
    }

    function edit_course(form_id) {
        if (confirm("Are you sure to Edit the student details?")) {
            $('form#' + form_id).submit();
        }
    }

    function visible_course(form_id) {
        if (confirm("Are you sure to active the course?")) {
            $('form#' + form_id).submit();
        }
    }

    function hide_course(form_id) {
        if (confirm("Are you sure to inactive the course?")) {
            $('form#' + form_id).submit();
        }
    }
</script>