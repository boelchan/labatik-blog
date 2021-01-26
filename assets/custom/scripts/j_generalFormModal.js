

var submitAjaxModal = function(formObj,options={}) {
    var btnObj = formObj.find('button[type=submit]');

        if(formObj.attr('enctype')=="multipart/form-data"){
            var formData = new FormData(formObj[0]);
            options['cache'] = false;
            options['contentType'] = false;
            options['processData'] = false;
        }else{
            var formData = formObj.serialize();
        }
        // console.log(formData);

        $(".help-block-error" , formObj).remove();
        $(".form-group" , formObj).removeClass('has-error');
        // default settings
        options = $.extend(true, {
            url: formObj.attr('action'),
            dataType: "json",
            data: formData,
            type: formObj.attr('method'),

            beforeSend: function (e) {
                btnObj.button('loading');
            },
            error: function (e) {
                // console.log(e);
                if (e.status == 400){
                    form_set_errors(e.responseJSON.errors,formObj);
                    if (e.responseJSON.message) {
                        toastr.error(e.responseJSON.message);
                    }
                }else{
                    toastr.error('Maaf, telah terjadi kesalahan.');
                }
            },
            success: function(response) {
                // console.log(response);
                if (response.success) {
                    form_success(response);
                }

            },
            complete:function (e) {
                btnObj.button('reset');
            }
        }, options);

        $.ajax(
            options
        );
}

function form_success(response) {
    if(response.message){
        var swal_message = response.message;
    }else{
        var swal_message = "Data berhasil disimpan";
    }
    closeModal();
    if (response.url!= '') {
        swal(
            {
                title: "Berhasil.",
                text: swal_message,
                type: "success",
                showCancelButton: false,
                cancelButtonClass: "btn-default",
                confirmButtonClass: "btn c-theme-btn c-btn-uppercase btn-md c-btn-sbold btn-block c-btn-square",
                confirmButtonText: "Ok.",
                closeOnConfirm: false
            },
            function(){
                location.replace(response.url);
            }
        );
    } else {
        toastr.success(swal_message);
        $('.filter-cancel').trigger('click');
    }
}

function form_set_errors(data_error,formObj) {
    console.log(data_error);
    $.each(data_error, function(k, v) {
        var element = $("[name='"+k+"']" , formObj);
        // console.log(element);
        var error = $("<span/>")   // creates a div element
                            .addClass("help-block help-block-error")   // add a class
                            .html(v);

        element.closest('.form-group').addClass('has-error');
        // element.closest('.help-block').remove();

        if (element.parent('.input-group').length) {
            error.insertAfter(element.parent());      // radio/checkbox?
        } else if (element.hasClass('select2-hidden-accessible')) {
            error.insertAfter(element.next('span'));  // select2
        } else {
            error.insertAfter(element);               // default
        }
    });
}

$('.form_ajax').submit(function(e) {
    e.preventDefault();
    submitAjaxModal($(this));
});

function closeModal() {
    $('#modal_form').modal('hide');
    $('#modal_form_large').modal('hide');
}

function closeModalLarge() {
    $('#modal_form_large').modal('hide');
}
