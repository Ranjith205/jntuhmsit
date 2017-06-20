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
        <h1 class="page-title"> Office Assistant
        </h1>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet light bordered">
                    <div class="portlet-title">
                    <div class="caption font-dark">
                        <form action="<?php echo base_url(); ?>clark/add_clark" method="post"  id="add_student">
                                <div class="btn-group btn-group-devided" >
                                    <button type="submit" class="btn purple-plum">Add Office Assistant</button>
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
                                    <th> Name</th>
                                    <th> Office Assistant Id </th>
                                    <th> Email id </th>
                                    <th> Mobile No </th>
                                    <th> Action </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($clarkList as $clark) { ?>
                                    <tr>
                                        <td> <?php echo $clark['full_name'];?> </td>
                                        <td> <?php echo $clark['roll_number'];?> </td>
                                        <td> <?php echo $clark['email'];?> </td>
                                        <td> <?php echo $clark['mobile'];?> </td>
                                        <td> 
                                            <form action="<?php echo base_url(); ?>clark/delete_clark" method="post" id="delete_clark_row_<?php echo $clark['uid']; ?>" style="float:left"> 
                                                <input type="hidden" value="<?php echo $clark['uid']; ?>" name ="uid"/>
                                                <button type="button" onclick="delete_clark('delete_clark_row_<?php echo $clark['uid']; ?>')" class="btn red-mint"><i class="icon icon-trash"></i></button> 
                                            </form>
                                            <form action="<?php echo base_url(); ?>clark/edit_clark" method="post" id="edit_clark_row_<?php echo $clark['uid']; ?>"  style="float:left"> 
                                                <input type="hidden" value="<?php echo $clark['uid']; ?>" name ="uid"/>
                                                <button type="button" onclick="edit_clark('edit_clark_row_<?php echo $clark['uid']; ?>')" class="btn green-haze"><i class="icon icon-pencil"></i></button>
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
    function delete_clark(form_id) {
        if (confirm("Are you sure to delete the clark?")) {
            $('form#' + form_id).submit();
        }
    }

    function edit_clark(form_id) {
        if (confirm("Are you sure to Edit the clark details?")) {
            $('form#' + form_id).submit();
        }
    }
</script>