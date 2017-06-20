<html>
    <head>
        <link href="<?php echo base_url() ?>assets/css/tools/bootstrap.css" rel="stylesheet" type="text/css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
        <script src="<?php echo base_url() ?>assets/scripts/tools/bootstrap-collapse.js"></script>
        <script src="<?php echo base_url() ?>assets/scripts/tools/apiview.js"></script>
        <script src="<?php echo base_url() ?>assets/scripts/tools/prettyprint.js"></script>
        <script>
            $(function(){
                var api = new API();
                api.baseUrl = '<?php echo base_url() ?>';
                api.init();                
            });
            function print_jsondata(data)
            {
                var url = '<?php echo base_url() ?>web/invites/upload_contacts_csv.json';
                $('#toggle-div').show();
                $('#url').html('<b>'+url+'</b>')
                var ppTable = prettyPrint(data);
                $('#prettyprint').html(ppTable).show();

                var jsonData = $('<pre/>', {
                }).html(JSON.stringify(data, null, "  "));

                $('#jsonview').html(jsonData)

                api.toggleView();
                $("html, body").animate({ scrollTop: 0 }, "slow");
            }
        </script>

        <style>
            .accordion-inner {
                padding: 0 0 0 0;
                margin: 0 0 0 0;
                border-top: 0;
            }
            .btn-group-vertical {
                padding: 0 0 0 0;
                margin: 0 0 0 0;
            }
            .btn {
                text-align: left;
            }
        </style>
            
    </head>
    <body>
        <h4>API Test Bench</h4>
        <div>
            <div class="span3">
                
                <h4>API URLs</h4>
                
                <div class="accordion" id="my-accordian">  
                    
                    <?php foreach ($categories as $category => $list) { ?>
                   
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle btn-primary" data-toggle="collapse" data-parent="#my-accordian" href="#collapse<?php echo str_replace(' ', '', $category) ?>">
                                <?php echo $category ?>
                            </a>
                        </div>
                        <div id="collapse<?php echo str_replace(' ', '', $category) ?>" class="accordion-body collapse">
                            <div class="accordion-inner">
                                <ul class="btn-group-vertical" style="width:100%">
                                    
                                    <?php foreach ($list as $index => $item) { ?>
                                    <li class="btn btn-info" data-item='<?php echo json_encode($item) ?>'><?php echo $index ?></li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <?php } ?>  
                </div>
            </div>
            <div class="span4" id="params">  
            </div>
            <div class="span9" id="content"> 
                <div id="url"></div>
                <div id="toggle-div" style="display: none"><button class="btn btn-info" id="toggle-view">Click to toggle view</button></div>
                <div id="prettyprint">
                </div>
                <div id="jsonview">
                </div>
            </div>
        </div>
        <iframe id="hiddeniframe" name="hiddeniframe" style="width:0px; height:0px;"></iframe>
    </body>
</html>