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
        <h1 class="page-title">
        </h1>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-dark">
                            <i class="icon-graduation font-dark"></i>
                            <span class="caption-subject bold uppercase">Leave Approvals</span>
                        </div>
                        <div class="actions">

                        </div>
                    </div>
                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover table-header-fixed" id="sample_3">
                            <thead>
                                <tr class="">
                                    <th> Student Name</th>
                                    <th> Roll Number </th>
                                    <th> Leaves Taken </th>
                                    <th> Applied to  </th>
                                    <th> Status </th>
                                    <th> Action </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($leave_data as $leaves) { ?>
                                    <tr>
                                        <td> <?php echo $leaves['full_name']; ?> </td>
                                        <td> <?php echo $leaves['roll_number']; ?> </td>
                                        <td> <?php echo $leaves['total_leaves_taken']; ?> </td>
                                        <td> <?php echo $leaves['assigned_to']; ?> </td>
                                        <td> <?php echo $leaves['status']; ?> </td>
                                        <td>
                                            <form action="<?php echo base_url(); ?>LeaveApprovel/approve_leave" method="post" id="delete_student_row_<?php echo $leaves['lid']; ?>" style="float:left"> 
                                                <input type="hidden" value="<?php echo $leaves['lid']; ?>" name ="lid"/>
                                                <button type="button" onclick="delete_student('delete_student_row_<?php echo $leaves['lid']; ?>')" class="btn red-mint"><i > Approve</i></button> 
                                            </form>
                                            <form action="<?php echo base_url(); ?>LeaveApprovel/cancel_leave" method="post" id="edit_student_row_<?php echo $leaves['lid']; ?>"  style="float:left"> 
                                                <input type="hidden" value="<?php echo $leaves['lid']; ?>" name ="lid"/>
                                                <button type="button" onclick="edit_student('edit_student_row_<?php echo $leaves['lid']; ?>')" class="btn green-haze"><i >Cancel</i></button>
                                            </form>
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
    function delete_student(form_id) {
        if (confirm("Are you sure to delete the student")) {
            $('form#' + form_id).submit();
        }
    }

    function edit_student(form_id) {
        if (confirm("Are you sure to Edit the student details")) {
            $('form#' + form_id).submit();
        }
    }
</script>