<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <h1 class="page-title"> Students Marks List
        </h1>
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-dark">
                            <form action="<?php echo base_url(); ?>marks/upload_students_marks" method="post"  id="add_student">
                                <div class="btn-group btn-group-devided" >
                                    <button type="submit" class="btn purple-plum">Upload Students Marks</button>
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
                                    <th> Student Name</th>
                                    <th> Course Name</th>
                                    <th> Percentage </th>
                                    <th> Course Start Date </th>
                                    <th> Course End Date </th>
                                    <th> Remarks </th>
                                    <th> Action </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($student_marks_list as $marks) { ?>
                                    <tr>
                                        <td> <?php echo $marks['full_name'];?> </td>
                                        <td> <?php echo $marks['course_name'];?> </td>
                                        <td> <?php echo $marks['percentage'];?> </td>
                                        <td> <?php echo $marks['started_date'];?> </td>
                                        <td> <?php echo $marks['ended_date'];?> </td>
                                         <td> <?php echo $marks['remarks'];?> </td>
                                        <td> 
                                            <form action="<?php echo base_url(); ?>marks/delete_student_marks" method="post" id="delete_student_marks_<?php echo $marks['marks_id']; ?>" style="float:left"> 
                                                <input type="hidden" value="<?php echo $marks['marks_id']; ?>" name ="marks_id"/>
                                                <button type="button" onclick="delete_student_marks('delete_student_marks_<?php echo $marks['marks_id']; ?>')" class="btn red-mint"><i class="icon icon-trash"></i></button> 
                                            </form>
                                            <form action="<?php echo base_url(); ?>marks/edit_student_marks" method="post" id="edit_student_row_<?php echo $marks['marks_id']; ?>"  style="float:left"> 
                                                <input type="hidden" value="<?php echo $marks['marks_id']; ?>" name ="marks_id"/>
                                                <button type="button" onclick="edit_student_marks('edit_student_row_<?php echo $marks['marks_id']; ?>')" class="btn green-haze"><i class="icon icon-pencil"></i></button>
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
    function delete_student_marks(form_id){
        if (confirm("Are you sure to delete the student marks?")) {
                $('form#'+form_id).submit();
            }
    }
    
    function edit_student_marks(form_id){
        if (confirm("Are you sure to Edit the student marks?")) {
                $('form#'+form_id).submit();
            }
    }
</script>