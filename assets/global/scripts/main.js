var main = {
    checkAuth: function(response) {
        if (response.relogin != null) {
            $('#modal_login').modal('show');
        }
    },

    alertMessage: function(message, type, options) {
        if (type == 'success') {
            swal({
                title: message,
                //   text: 'I will close in 2 seconds.',
                type: "success",
                timer: 1000,
                showConfirmButton: false
            }).then(
                function() {
                        if (options.url) {
                            if (options.url == 'reload') {
                                location.reload();
                            } else {
                                window.location.replace(options.url);
                            }
                        }
                    },
                // handling the promise rejection
                function(dismiss) {
                    if (dismiss === 'timer') {
                        if (options.url) {
                            if (options.url == 'reload') {
                                location.reload();
                            } else {
                                window.location.replace(options.url);
                            }
                        }
                    }
                }
            )
            // toastr.success(message);
            // if (options.url) {
            //     if (options.url == 'reload') {
            //         location.reload();
            //     } else {
            //         window.location.replace(options.url);
            //     }
            // }
        } else {
            if (type == 'error') {
                type = 'danger';
            }
            swal({
                title: message,
                //   text: 'I will close in 2 seconds.',
                type: "error",
                timer: 1500,
                showConfirmButton: false,
                showCloseButton: true
            })
            // toastr.error(message);
            // $.bootstrapGrowl(message, {
            //   ele: 'body', // which element to append to
            //   type: type, // (null, 'info', 'danger', 'success')
            //   offset: {from: 'top', amount: 20}, // 'top', or 'bottom'
            //   align: 'right', // ('left', 'right', or 'center')
            //   width: 250, // (integer, or 'auto')
            //   delay: 4000, // Time while the message will be displayed. It's not equivalent to the *demo* timeOut!
            //   allow_dismiss: true, // If true then will display a cross to close the popup.
            //   stackup_spacing: 10 // spacing between consecutively stacked growls.
            // });
        }
    },

    resetForm: function(formObj) {
        formObj.find('input[type=text], input[type=hidden], textarea, input[type=password]').val('');
    },

    submitAjax: function (formObj, options = {}) {

    	var btnObj = formObj.find('button[type=submit]');

    	if (formObj.attr('enctype') == "multipart/form-data") {
    		var formData = new FormData(formObj[0]);
    		options['cache'] = false;
    		options['contentType'] = false;
    		options['processData'] = false;

    		// if ($('#fileUploadProgressTemplate').length == 0) {
    		//     formObj.append('\
    		//     <div id="fileUploadProgressTemplate" style="display:none">\
    		//         <div class="progress progress-striped active">\
    		//             <div class="progress-bar progress-bar-info" style="width: 0%;"></div>\
    		//         </div>\
    		//     </div>\
    		//     ');
    		// }
    		// $("#fileUploadProgressTemplate").find(".progress-bar").width(0 + "%");
    		// $("#fileUploadProgressTemplate").show();
    		// options['xhr'] = function() {
    		//     var xhr = $.ajaxSettings.xhr();
    		//     if (xhr.upload) {
    		//         xhr.upload.addEventListener('progress', function(evt) {
    		//             var percent = (evt.loaded / evt.total) * 100;
    		//             $("#fileUploadProgressTemplate").find(".progress-bar").width(percent + "%");
    		//         }, false);
    		//     }
    		//     return xhr;
    		// };
    	} else {
    		var formData = formObj.serialize();
    	}
    	// console.log(formData);

    	$(".help-block-error", formObj).remove();
    	$(".form-group", formObj).removeClass('has-error');
    	// default settings
    	options = $.extend(true, {
    		url: formObj.attr('action'),
    		dataType: "json",
    		data: formData,
    		type: "post",
    		headers: {
    			"authorization": localStorage.getItem('tokenApp')
    		},

    		beforeSend: function (e) {
    			btnObj.button('loading');
    		},
    		success: function (response) {
    			// console.log(response);
    			if (response.success == true) {
    				// if (response.token) {
    				//     localStorage.setItem('tokenApp', response.token);
    				// }

    				if (response.reset == true) {
    					main.resetForm(formObj);
    				}
    				// if (typeof options._dataTable !== 'undefined') {
    				//     options._dataTable.getDataTable().ajax.reload();
    				// }
    				//execute function dengan pengembalian parameter
    				if (options.f_response) {
    					if (typeof options.f_response === "function") {
    						options.f_response(response);
    					}
    				}
    				// execute function tanpa respone
    				if (options.f_success) {
    					if (typeof options.f_success === "function") {
    						options.f_success();
    					}
    				}
    				if (response.datatable) {
    					$('#' + response.datatable).DataTable().ajax.reload();
    				}
    				if (typeof datatableAjax != "undefined" && datatableAjax) {
    					datatableAjax.getDataTable().ajax.reload();
    				}
                    // console.log(formObj);
                    if (options.f_modal) {
                        toastr.success(response.message);
                    }
                    else{
                        formObj.parents('.modal').modal('hide');
                        main.alertMessage(response.message, "success", response);
                    }
    			} else {
    				if (response.message) {
    					main.alertMessage(response.message, "error");
    				}
    				if (response.field_error) {
    					main.setErrorForm(response.field_error, formObj);
    				}
    			}
    		}
    	}, options);

    	$.ajax(
    			options
    		)
    		.fail(function () {
    			btnObj.button('reset');
    			main.alertMessage("Oops!','Maaf, telah terjadi kesalahan.", "error");

    		})
    		.always(function () {
    			btnObj.button('reset');
    		});
    },


    setErrorForm: function(field_error, formObj) {
        $.each(field_error, function(k, v) {
            var element = $("[name='" + k + "']", formObj);
            // console.log(element);
            var error = $("<span/>") // creates a div element
                .addClass("help-block help-block-error") // add a class
                .html(v);

            element.closest('.form-group').addClass('has-error');
            // element.closest('.help-block').remove();

            if (element.parent('.input-group').length) {
                error.insertAfter(element.parent()); // radio/checkbox?
            } else if (element.hasClass('select2-hidden-accessible')) {
                error.insertAfter(element.next('span')); // select2
            } else {
                error.insertAfter(element); // default
            }
        });
    },
    dropdownAjax: function(targetObj, send_data, url) {
        targetObj.html("<option value='' >Loading...</option>");
        targetObj.select2("val", "");
        $.ajax({
                url: url,
                type: 'POST',
                dataType: 'json',
                data: send_data,
                beforeSend: function(e) {
                    targetObj.prop("disabled", true);
                }
            })
            .done(function(response) {
                console.log("success");
                if (response) {
                    if (response.length > 0) {
                        targetObj.html("<option value='' >Pilih</option>");

                        for (i = 0; i < response.length; i++) {
                            var option = "<option value='" + response[i]['id'] + "' ";
                            option += " >" + response[i]['nama'] + "</option>";
                            targetObj.append(option);
                        }
                        targetObj.prop("disabled", false);
                    } else {
                        targetObj.html("<option value='0' >Tidak ada data</option>");
                        console.log("data not found");
                    }
                    targetObj.select2("val", "");
                }
            })
            .fail(function(response) {
                console.log('error');
                // main.alertMessage('Oops!', response.message, 'warning');
            })
            .always(function() {
                // console.log("complete");
            });

    },
    simpleDatatable: function(options) {
        var TableDatatablesAjax = function(options) {
            var grid = new Datatable();
            grid.init({
                src: options.src,
                dataTable: {
                    "ajax": {
                        "url": options.url, // ajax source
                    },
                    "order": [
                            [1, "asc"]
                        ] // set first column as a default sort by asc
                }
            });
        }
        jQuery(document).ready(function() {
            TableDatatablesAjax(options);
        });
    },

    loadPage: function(el, url) {
        el.html("");
        App.blockUI({
            target: el,
            // boxed: true,
            // overlayColor: 'none',
            animate: true
        });
        setTimeout(function() {
            el.load(url, function(result) {
                // App.unblockUI(el);
            });
        }, 500);
    },

};

var myjs = function() {
            
    // Handle Select2 Dropdowns
    var handleSelect2 = function() {
        if ($().select2) {
            $.fn.select2.defaults.set("theme", "bootstrap");
            $('.select2').select2({
                placeholder: "Pilih",
                width: 'auto',
                allowClear: false
            });

            function formatRepo(repo) {
                if (repo.loading) return repo.text;

                var markup = "<div class='select2-result-repository clearfix'>";
                if (repo.img !== undefined) {
                    markup += "<div class='select2-result-repository__avatar'><img src='" + repo.img + "' /></div>";
                }
                if (repo.title !== undefined) {
                    markup += "<div class='select2-result-repository__title'>" + repo.title + "</div>";
                }
                if (repo.desc !== undefined) {
                    markup += "<div class='select2-result-repository__description'>" + repo.desc + "</div>";
                }
                if (repo.rating !== undefined) {
                    markup += "<div class='select2-result-repository__stargazers'>" + repo.rating + " <span class='glyphicon glyphicon-star'></span></div></div>";
                }

                return markup;
            }

            function formatRepoSelection(repo) {
                return repo.title || repo.text;
            }

            $(".select2-ajax").each(function() {
                var dropdown = $(this);
                var url = $(this).attr('data-url');
                if ($(this).attr('data-allowClear') == 'false') {
                    var allowClear = false;
                } else {
                    var allowClear = true;
                }
                //  console.log(url);
                dropdown.select2({
                    placeholder: "Pilih",
                    allowClear: allowClear,
                    width: "off",
                    ajax: {
                        url: url,
                        dataType: 'json',
                        delay: 250,
                        data: function(params) {
                            return {
                                q: params.term, // search term
                                page: params.page
                            };
                        },
                        processResults: function(data, params) {
                            // parse the results into the format expected by Select2.
                            // since we are using custom formatting functions we do not need to
                            // alter the remote JSON data
                            params.page = params.page || 1;
                            return {
                                results: data.items,
                                pagination: {
                                    more: (params.page * 30) < data.total_count
                                }
                            };
                        },
                        cache: true
                    },
                    escapeMarkup: function(markup) {
                        return markup;
                    }, // let our custom formatter work
                    minimumInputLength: 0,
                    templateResult: formatRepo,
                    templateSelection: formatRepoSelection
                });
            });
        }
    };



    // Handle date picker
    var handleDatePickers = function() {

        if (jQuery().datepicker) {
            $('.date-picker').datepicker({
                rtl: App.isRTL(),
                orientation: "left",
                format: 'dd-mm-yyyy',
                autoclose: true
            });
            $('.date-decade').datepicker({
                rtl: App.isRTL(),
                orientation: "left",
                format: 'yyyy-mm-dd',
                startView: 'decade',
                autoclose: true
            });
            $('.date-year').datepicker({
                rtl: App.isRTL(),
                orientation: "left",
                format: 'yyyy',
                minViewMode: 'years',
                autoclose: true
            });
            //$('body').removeClass("modal-open"); // fix bug when inline picker is used in modal
        }

    }

    var initUpload = function() {
        $(".upload_img_single").click(function(e) {
            console.log("a");
            var imgId = '#' + $(this).attr("id");
            var photo_before = $(this).attr("src");
            var folder = $(this).attr("folder");
            var hiddenInputId = '#' + $(this).parent().find('input:hidden').attr("id");
            var modal_upload_options = {
                "targetImgId": imgId,
                "photo": photo_before,
                "hiddenInputId": hiddenInputId,
                "folder": folder,
            };

            if (document.getElementById('div_upload') === null) {
                var iDiv = document.createElement('div');
                iDiv.id = 'div_upload';
                $(this).parent().append(iDiv);
            }

            $('#div_upload').load(site_url + '/upload/single', modal_upload_options,
                function() {
                    /* Stuff to do after the page is loaded */
                });
        });
    };

    // Handle load modal
    var handleModal = function() {
        $('body').on('click', '.openmodal', function(event) {
            event.preventDefault();
            // console.log($(this).closest('.portlet').find('.table'));
            // if($(this).closest('.portlet').find('.table').length){
            //     var table_modal = $(this).closest('.portlet').find('.table');
            //     if (table_modal.find('.table_modal').length == 0) {
            //         table_modal.append('<div class="table_modal"></div>')
            //     }
            //     var obj = table_modal.find('.table_modal');
            //     obj.load( $(this).data('url'), { "modal": true }, function() {
            //     //   alert( "Load was performed." );
            //     });
            // }else{
            $('#temp_modal').load($(this).data('url'), {
                "modal": true
            }, function() {
                //   alert( "Load was performed." );
            });
            // }
        });
        // .click(function(e) {
        //     e.preventDefault();
        // });
    };
    // Handle summernote
    var handleSummernote = function() {
        if (jQuery().summernote) {
            $('.summernote').summernote({
                height: 300,
                toolbar: [
                    ['font', ['bold', 'underline']],
                    ['fontsize', ['fontsize']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'video', 'picture']],
                    ['view', ['fullscreen']]
                ],
                callbacks: {
                    onImageUpload: function(image) {
                        uploadImage(image[0]);
                    },
                    onMediaDelete : function(target) {
                        deleteImage(target[0].src);
                    }
                }
            });
            function uploadImage(image) {
                var data = new FormData();
                data.append("image", image);
                data.append(csrfName, csrfHash);
                
                $.ajax({
                    url: site_url+'form/upload_img_summernote',
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: data,
                    type: "POST",
                    success: function(url) {
                        $('.summernote').summernote("insertImage", url);
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
            }
        
            function deleteImage(src) {
                $.ajax({
                    data: {src : src, csrfName:csrfHash},
                    type: "POST",
                    url: site_url+'form/delete_img_summernote',
                    cache: false,
                    success: function(response) {
                        console.log(response);
                    }
                });
            }
            
        }
    };
    var handleTimePickers = function () {

        if (jQuery().timepicker) {
            $('.timepicker-default').timepicker({
                autoclose: true,
                showSeconds: true,
                minuteStep: 1
            });

            $('.timepicker-no-seconds').timepicker({
                autoclose: true,
                minuteStep: 5,
                defaultTime: false
            });

            $('.timepicker-24').timepicker({
                autoclose: true,
                minuteStep: 5,
                showSeconds: false,
                showMeridian: false
            });

            // handle input group button click
            $('.timepicker').parent('.input-group').on('click', '.input-group-btn', function(e){
                e.preventDefault();
                $(this).parent('.input-group').find('.timepicker').timepicker('showWidget');
            });

            // Workaround to fix timepicker position on window scroll
            $( document ).scroll(function(){
                $('#form_modal4 .timepicker-default, #form_modal4 .timepicker-no-seconds, #form_modal4 .timepicker-24').timepicker('place'); //#modal is the id of the modal
            });
        }
    }
    // Handle inputmask

    var handleInputmask = function () {

        if (jQuery().inputmask) {
            $(".mask-number").inputmask({
            	"mask": "9",
            	"repeat": 10,
            	"greedy": false
            });
            $(".mask-number3").inputmask({
            	"mask": "9",
            	"repeat": 3,
            	"greedy": false
            });
            $(".mask-nik").inputmask({
            	"mask": "9",
            	"repeat": 16,
            	"greedy": false
            });
            $(".mask-kode-pos").inputmask({
            	"mask": "9",
            	"repeat": 5,
            	"greedy": false
            });
            $(".mask-tahun").inputmask({
            	"mask": "9",
            	"repeat": 4,
            	"greedy": false
            });
        }
    };

    return {

        //main function to initiate the theme
        init: function() {
            handleSelect2();
            handleDatePickers();
            handleTimePickers();
            handleModal();
            handleSummernote();
            handleInputmask();
            initUpload();
        }
    };
}();

jQuery(document).ready(function() {
    myjs.init(); // init metronic core componets

    // form sumbit    
    $('#input-form').submit(function(e) {
        e.preventDefault();
        main.submitAjax($(this));
    });


});
//================================