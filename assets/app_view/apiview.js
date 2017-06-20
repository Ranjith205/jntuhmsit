/**
 * Javascript for API test bench
 * 
 * @author Hari Dornala <hari@clout.com>
 * @url /toos/appview/index
 */
function API() {
    var api = this;
    this.baseUrl = '';

    this.init = function() {
         $('li').click(function() {
            api.hideContent();
            $("html, body").animate({ scrollTop: 0 }, "slow");
            $('#params').empty();

            var data = $(this).data('item');

            var method = (typeof data.method != 'undefined') ? data.method : false;
            var url = data.url;
            var parts = url.split('.');
            var label;
            var params;

            if (parts.length > 1) {
                url = parts[0];
            }
            
            url = api.baseUrl + url;
            $('#params').append("<b>URL : </b>"+url);
            
            var param_size = 0;
            if (method == 'get') {
                method = 'GET';
                label = 'Get Parameters: ';
                params = data.get;
                param_size = $(params).length;
            } else if (method == 'post') {
                method = 'POST';
                label = 'Post Parameters: ';
                params = data.post;
                param_size = $(params).length;
            } else {
                method = 'GET';
            }
           
            $('<div/>').html('<b>Notes:</b><br>'+data.notes).appendTo($('#params'));          
            var form = $('<form/>',{
                id: 'testbench',
                enctype: 'multipart/form-data'
            }).appendTo('#params');
            
            if (param_size > 0) {
                
                 $('<hr><b>'+label+'</b><br>').appendTo($('#testbench'));
                $('<div/>', {
                    id: 'input_params'
                }).html('<hr><b>Input Parameters:<b><br>').appendTo($('#params'));
            
                $('#url').empty();

                $.each(params, function (index, val) {
                    var temp=index.split("$");
                    var typ = "text";
                    if(temp.length>1)
                     {
                         index=temp[0];
                         typ = temp[1];
                     }
                    $('<label>',{
                        html: '<b>'+index+'</b>'
                    }).appendTo(form);

                    /**
                     * If field type is array repeat the field until the specified number.
                     * For array field type the vlaue will be in the format array_<num>
                     */
                    if (typeof(val) == 'string' && val.substr(0,5) == 'array') {
                        var parts = val.split('_');
                        var cnt = parseInt(parts[1]);

                        for(var i=0; i<cnt; i++) {
                            $('<input/>', { 
                                type: typ,
                                name: index + '[]',
                                value: '',
                                class: 'input-block-level'
                            }).appendTo(form);
                        }
                    } else if (typeof(val) == 'object') {
                        var attr = {
                            name: index,
                            class: 'input-block-level'
                        }
                        
                        if (index.indexOf('[]') > 0) {
                            attr.multiple = 'multiple';
                        }
                        
                        var select = $('<select/>', attr);
                        $.each(val, function(ind, item) {
                            var option = $('<option>',{
                                value: ind
                               
                            }).text(item);
                            select.append(option);
                        });
                        form.append(select)
                    } else {
                        if(index==="csvformat")
                        {
                            var arr = [
                            {val : 1, text: 'CSV - Outlook contacts'},
                            {val : 2, text: 'CSV - Thunderbird contacts'},
                            {val : 3, text: 'CSV - generic file'},
                            {val : 6, text: 'CSV - Yahoo address book'},
                            {val : 7, text: 'CSV - Gmail address book'},
                            {val : 8, text: 'CSV - Hotmail address book'},
                            {val : 9, text: 'CSV - Aol address book'},
                            {val : 4, text: 'Text file - comma delimited'},
                            {val : 5, text: 'Text file - tab delimited'}
                          ];
                          var sel = $('<select />',{name : 'csvformat', class: 'input-block-level'}).appendTo(form);
                          $(arr).each(function() {
                           sel.append($("<option>").attr('value',this.val).text(this.text));
                          });
                        }
                        else
                        {
                            $('<input/>', { 
                                type: typ,
                                name: index,
                                value: val,
                                class: 'input-block-level'
                            }).appendTo(form);
                        }
                    }


                });   
            } 
            
             $('<input/>', {
                type: 'button',
                class: 'btn',
                on: {
                    click: function() {
                        api.hideContent();
                        
                        var utemp=url.split("/");
                        if(utemp[utemp.length-1]==="upload_contacts_csv.json")
                        {
                            document.forms[0].action=url;
                            document.forms[0].method='POST';
                            document.forms[0].target="hiddeniframe";
                            $('#url').html('<div style="text-align:center; padding:30px;"><img src="/assets/img/loader.gif" /></div>');
                            //return;
                            document.forms[0].submit();
                            return;
                        }
                        
                        if (method != false) {
                            var data = $("#testbench").serialize(); 
                        } else {
                            date = '';
                            method = 'GET'
                        }
                        $.ajax({
                            type: method,
                            data: data,
                            url: url,
							dataType: "json",
                            beforeSend: function() {
                                //$('#url').html('Loading... please wait.')
                                $('#url').html('<div style="text-align:center; padding:30px;"><img src="/assets/img/loader.gif" /></div>');
                            },
                            success: function(data) {
                                $('#toggle-div').show();
                                $('#url').html('<b>'+url+'</b>')
                                var ppTable = prettyPrint(data);
                                $('#prettyprint').html(ppTable).hide();
                                var jsonData = $('<pre/>', {
                                }).html(JSON.stringify(data, null, "  "));
                                $('#jsonview').html(jsonData)

                                api.toggleView();
                                $("html, body").animate({ scrollTop: 0 }, "slow");
                            }
                        });
                    }
                },
                value: 'Submit',
            }).appendTo(form);
             
            $.each(data.input_parameters, function(index, val){
                $('<b>'+index+'</b><br>'+val+'<br>').appendTo('#input_params');
            });
            
            $('<div/>', {
                id: 'output_responses'
            }).html('<hr><b>Output Responses:<b><br>').appendTo($('#params'));
            
            $.each(data.output_responses, function(index, val){
                $('<b>'+index+'</b><br>'+val+'<br>').appendTo('#output_responses');
            });
           
        });

        $('#toggle-view').click(function(){
            api.toggleView();
        });
    };
    
    this.hideContent = function() {
        $('#url').empty();
        $('#jsonview').empty().hide();
        $('#prettyprint').empty().hide();
        $('#toggle-div').hide();
    };
    
    this.toggleView = function() {
        if ($('#prettyprint').is(':hidden'))
        {
            $('#jsonview').hide();
            $('#prettyprint').show();
        } else {
            $('#jsonview').show();
            $('#prettyprint').hide();
        }
    };
};