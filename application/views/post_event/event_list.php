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
        <h1 class="page-title"> Events
        </h1>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-dark">
                           <form action="<?php echo base_url(); ?>post_event/post_event" method="post"  id="add_student">
                                <div class="btn-group btn-group-devided" >
                                    <button type="submit" class="btn purple-plum">Post Event</button>
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
                                    <th> Event title </th>
                                    <th> Description </th>
                                    <th> Event Date </th>
                                    <th> Action </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($eventlist as $event) { ?>
                                    <tr>
                                        <td> <?php echo $event['title'];?> </td>
                                        <td> <?php echo $event['description'];?> </td>
                                        <td> <?php echo $event['event_date'];?> </td>
                                        <td> 
                                            <form action="<?php echo base_url(); ?>post_event/delete_event" method="post" id="delete_event_row_<?php echo $event['bid']; ?>" style="float:left"> 
                                                <input type="hidden" value="<?php echo $event['bid']; ?>" name ="bid"/>
                                                <button type="button" onclick="delete_event('delete_event_row_<?php echo $event['bid']; ?>')" class="btn red-mint"><i class="icon icon-trash"></i></button> 
                                            </form>
                                            <form action="<?php echo base_url(); ?>post_event/edit_event" method="post" id="edit_event_row_<?php echo $event['bid']; ?>"  style="float:left"> 
                                                <input type="hidden" value="<?php echo $event['bid']; ?>" name ="bid"/>
                                                <button type="button" onclick="edit_event('edit_event_row_<?php echo $event['bid']; ?>')" class="btn green-haze"><i class="icon icon-pencil"></i></button>
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
    function delete_event(form_id) {
        if (confirm("Are you sure to delete the student")) {
            $('form#' + form_id).submit();
        }
    }

    function edit_event(form_id) {
        if (confirm("Are you sure to Edit the student details")) {
            $('form#' + form_id).submit();
        }
    }
</script>