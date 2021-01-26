var config = {
    apiKey: "AIzaSyAWSupOuuN5SvkAJ45IiG_fpXe6HXelMn4",
    authDomain: "fcm-awankslab-micomm.firebaseapp.com",
    databaseURL: "https://fcm-awankslab-micomm.firebaseio.com",
    projectId: "fcm-awankslab-micomm",
    storageBucket: "fcm-awankslab-micomm.appspot.com",
    messagingSenderId: "875506455212"
};
firebase.initializeApp(config);

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
    // var obj = response.obj;
    // var firebaseRef = firebase.database().ref();
    // var data = {
    //     comment: obj.comment,
    //     read: obj.read,
    //     created_at: obj.created_at,
    //     user_id: obj.user_id,
    //     user_first_name: obj.user_first_name,
    //     user_photo: obj.user_photo,
    //     user_level_id: obj.user_level_id
    // };
    // var x = firebaseRef.child('private_issue_comments/'+obj.private_issue_id);
    // x.push(data)
    //  .then(function (snap) {
    //      var key = snap.key;
    //      if (key != null) {
    //          window.location.replace(response.url);
    //      }
    //  });

    //  lama
    if(response.message){
        var swal_message = response.message;
    }else{
        var swal_message = "Data berhasil disimpan";
    }
    swal(
        {
            title: "Berhasil!",
            text: swal_message,
            type: "success",
            confirmButtonClass: "btn-success",
            confirmButtonText: "Success",
            closeOnConfirm: false
        },
        function(isConfirm) {
            if (isConfirm) {
                if (response.url) {
                    window.location.replace(response.url);
                }
            }
        }
    );
}

function form_set_errors(data_error,formObj) {
    // console.log(data_error);
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
