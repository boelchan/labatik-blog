
var FormWizard = function () {


    return {
        //main function to initiate the module
        init: function () {
            if (!jQuery().bootstrapWizard) {
                return;
            }

            function format(state) {
                if (!state.id) return state.text; // optgroup
                return "<img class='flag' src='../assets/global/img/flags/" + state.id.toLowerCase() + ".png'/>&nbsp;&nbsp;" + state.text;
            }

            $("#country_list").select2({
                placeholder: "Select",
                allowClear: true,
                formatResult: format,
                formatSelection: format,
                escapeMarkup: function (m) {
                    return m;
                }
            });

            var form = $('#submit_form');
            var error = $('.alert-danger', form);
            var success = $('.alert-success', form);

            form.validate({
                doNotHideMessage: true, //this option enables to show the error/success messages on tab switch.
                errorElement: 'span', //default input error message container
                errorClass: 'help-block help-block-error', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                rules: {

                },

                messages: { // custom messages for radio buttons and checkboxes
                    'payment[]': {
                        required: "Please select at least one option",
                        minlength: jQuery.validator.format("Please select at least one option")
                    }
                },

                errorPlacement: function (error, element) { // render error placement for each input type
                    if (element.attr("name") == "gender") { // for uniform radio buttons, insert the after the given container
                        error.insertAfter("#form_gender_error");
                    } else if (element.attr("name") == "payment[]") { // for uniform checkboxes, insert the after the given container
                        error.insertAfter("#form_payment_error");
                    } else {
                        error.insertAfter(element); // for other inputs, just perform default behavior
                    }
                },

                invalidHandler: function (event, validator) { //display error alert on form submit   
                    success.hide();
                    error.show();
                    App.scrollTo(error, -200);
                },

                highlight: function (element) { // hightlight error inputs
                    $(element)
                        .closest('.form-group').removeClass('has-success').addClass('has-error'); // set error class to the control group
                },

                unhighlight: function (element) { // revert the change done by hightlight
                    $(element)
                        .closest('.form-group').removeClass('has-error'); // set error class to the control group
                },

                success: function (label) {
                    if (label.attr("for") == "gender" || label.attr("for") == "payment[]") { // for checkboxes and radio buttons, no need to show OK icon
                        label
                            .closest('.form-group').removeClass('has-error').addClass('has-success');
                        label.remove(); // remove error label here
                    } else { // display success icon for other inputs
                        label
                            .addClass('valid') // mark the current input as valid and display OK icon
                        .closest('.form-group').removeClass('has-error').addClass('has-success'); // set success class to the control group
                    }
                },

                submitHandler: function (form) {
                    //success.show();
                    error.hide();
                    //add here some ajax code to submit your form or just call form.submit() if you want to submit the form without ajax
                }

            });

            var displayConfirm = function() {
                $('#tab4 .form-control-static', form).each(function(){
                    var input = $('[name="'+$(this).attr("data-display")+'"]', form);
                    if (input.is(":radio")) {
                        input = $('[name="'+$(this).attr("data-display")+'"]:checked', form);
                    }
                    if (input.is(":text") || input.is("textarea")) {
                        $(this).html(input.val());
                    } else if (input.is("select")) {
                        $(this).html(input.find('option:selected').text());
                    } else if (input.is(":radio") && input.is(":checked")) {
                        $(this).html(input.attr("data-title"));
                    } else if ($(this).attr("data-display") == 'payment[]') {
                        var payment = [];
                        $('[name="payment[]"]:checked', form).each(function(){ 
                            payment.push($(this).attr('data-title'));
                        });
                        $(this).html(payment.join("<br>"));
                    }
                });
            }

            var handleTitle = function(tab, navigation, index) {
                var total = navigation.find('li').length;
                var current = index + 1;
                // set wizard title
                $('.step-title', $('#form_wizard_1')).text('Step ' + (index + 1) + ' of ' + total);
                // set done steps
                jQuery('li', $('#form_wizard_1')).removeClass("done");
                var li_list = navigation.find('li');
                for (var i = 0; i < index; i++) {
                    jQuery(li_list[i]).addClass("done");
                }

                if (current == 1) {
                    $('#form_wizard_1').find('.button-previous').hide();
                } else {
                    $('#form_wizard_1').find('.button-previous').show();
                }

                if (current >= total) {
                    $('#form_wizard_1').find('.button-next').hide();
                    $('#form_wizard_1').find('.button-submit').show();
                    displayConfirm();
                } else {
                    $('#form_wizard_1').find('.button-next').show();
                    $('#form_wizard_1').find('.button-submit').hide();
                }
                App.scrollTo($('.page-title'));
            }

            // default form wizard
            $('#form_wizard_1').bootstrapWizard({
                'nextSelector': '.button-next',
                'previousSelector': '.button-previous',
                onTabClick: function (tab, navigation, index, clickedIndex) {
                    if (mode == 'w') {
                        // success.hide();
                        // error.hide();
                        if (form.valid() == false) 
                        {
                            // return false;
                        }
                        else
                        {
                            handleTitle(tab, navigation, clickedIndex);
                            // return false;
                        }
                    }else{
                        // return false;
                    }
                    
                    
                },
                onNext: function (tab, navigation, index) {
                    success.hide();
                    error.hide();

                    if (form.valid() == false) {
                        return false;
                    }
                    
                    if(submit_tab(index)){
                        handleTitle(tab, navigation, index);
                    }else{
                        return false;
                    }
                },
                onPrevious: function (tab, navigation, index) {
                    success.hide();
                    error.hide();

                    if(submit_tab(index+2)){
                        handleTitle(tab, navigation, index);
                    }
                },
                onTabShow: function (tab, navigation, index) {
                    var total = navigation.find('li').length;
                    var current = index + 1;
                    var $percent = (current / total) * 100;
                    $('#form_wizard_1').find('.progress-bar').css({
                        width: $percent + '%'
                    });
                    var tab_form_id =$('#tab'+current).data("form-id") ;
                    if (typeof window["setting_" + tab_form_id]  !== 'undefined' ) {window["setting_" + tab_form_id]() ; }

                }
            });
            
            function submit_tab (index) {
                var datastring = $('#tab'+index+' :input').serialize();
                var tab_form_id =$('#tab'+index).data("form-id") ;

                datastring +="&pk_id="+pk_id+"&permohonan_jenis_id="+permohonan_jenis_id+"&"+csrf_token+"="+csrf_hash;
                
                var status_send = false;
                $('#ajax_loading').modal('show');
                $.ajax({
                    type: "POST",
                    url: $('body').data('siteurl')+"Permohonan/saveTabForm/"+tab_form_id,
                    data: datastring,
                    dataType: "json",
                    async:false
                })
                .done(function(data) {
                    console.log(data);
                    if(data && data!=""){
                        if(data.pk_id != null){
                            pk_id = data.pk_id; 
                        }                            
                    }
                    status_send=true; //remove latter
                })
                .fail(function() {
                    status_send=false;
                    alert('Network Error');
                })
                .always(function() {
                    $('#ajax_loading').modal('hide');
                });

                return status_send;
            }

            $('#form_wizard_1').find('.button-previous').hide();
            $('#form_wizard_1 .button-submit').click(function () {
                bootbox.confirm("Data yang anda isikan akan diajukan ke Desa sehingga tidak dapat diubah kembali. Apa anda yakin?",  function(result) {
                    if (result)
                    {
                        var datastring = "&pk_id="+pk_id+"&"+csrf_token+"="+csrf_hash;

                        $.ajax({
                            type: "POST",
                            url: $('body').data('siteurl')+"Permohonan/saveTabForm/submit",
                            data: datastring,
                            dataType: "json",
                            success: function(data) {
                                if(data != null){
                                    if(data.success == true){
                                        NotifikasiToast({
                                            type : 'success', // ini tipe notifikasi success,warning,info,error
                                            msg : 'Simpan berhasil', //ini isi pesan})
                                        });
                                        $('#form_wizard_1').find('.button-submit').remove();
                                        $('#form_wizard_1').find('.button-pdf').show();
                                        $('#form_wizard_1').find('.button-pdf').attr("href", data.printlink);  

                                        window.location.replace(data.printlink); 
                                    }else{
                                        alert("Gagal");
                                    }
                                }else{
                                    alert("Gagal");
                                }
                                
                                
                            },
                            error: function(){
                                  alert('error handing here');
                            }
                        });
                    }
                });
            }).hide();


        }

    };

}();
jQuery(document).ready(function() {
    FormWizard.init();
});