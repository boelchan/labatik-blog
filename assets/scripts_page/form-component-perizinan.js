var NotifikasiToast = function (data) {
    if(!data)
      return;
    var type,msg,title;
    if(!data.type){type = 'success';}else{type = data.type;}
    if(!data.msg){msg = '';}else{msg = data.msg;}
    if(!data.title){title = '';}else{title = data.title;}

    toastr.options = {
      closeButton: true,
      debug: false,
      positionClass: "toast-top-right",
      onclick: null,
      showDuration: "1000",
      hideDuration: "1000",
      timeOut: "5000",
      extendedTimeOut: "1000",
      showEasing: "swing",
      hideEasing: "linear",
      showMethod: "fadeIn",
      hideMethod: "fadeOut"
    }

    var $toast = toastr[type](msg, title);
  }
      
var PerijinanFormTools = function () {

    var extendValidatorPlugin = function () {
        jQuery.extend(jQuery.validator.messages, {
            required: "Field ini wajib diisi.",
            remote: "Please fix this field.",
            email: "Alamat email ini tidak valid.",
            url: "Please enter a valid URL.",
            date: "Please enter a valid date.",
            dateISO: "Please enter a valid date (ISO).",
            number: "Please enter a valid number.",
            digits: "Harus diisi angka.",
            creditcard: "Please enter a valid credit card number.",
            equalTo: "Please enter the same value again.",
            accept: "Please enter a value with a valid extension.",
            maxlength: jQuery.validator.format("Please enter no more than {0} characters."),
            minlength: jQuery.validator.format("Please enter at least {0} characters."),
            rangelength: jQuery.validator.format("Please enter a value between {0} and {1} characters long."),
            range: jQuery.validator.format("Please enter a value between {0} and {1}."),
            max: jQuery.validator.format("Please enter a value less than or equal to {0}."),
            min: jQuery.validator.format("Please enter a value greater than or equal to {0}.")
        });
    }
    
    var handleInputMasks = function () {
        if (jQuery().inputmask) 
        {
            // $.extend($.inputmask.defaults, {
            //     'autoUnmask': true
            // });
            $(".mask-date").inputmask("d/m/y", {
                autoUnmask: true
            }); // direct mask
            $(".mask-kode-pos").inputmask({
                "mask": "9",
                "repeat": 10, //limit
                "greedy": false
            }); // ~ mask "9" or mask "99" or ... mask "9999999999"
    
            $(".mask-quantity").inputmask({
                "alias": "numeric", 
                "radixPoint": ",", 
                "groupSeparator": ".",
                "autoGroup": true,  
                "placeholder": "0"
            });
    
            $(".mask-number3").inputmask({
                "mask": "9",
                "repeat": 3, //limit
                "greedy": false
            });
    
            $(".mask-number4").inputmask({
                "mask": "9",
                "repeat": 4, //limit
                "greedy": false
            });
    
            $(".mask-number").inputmask({
                "mask": "9",
                "repeat": 20, //limit
                "greedy": false
            });
    
        }
    }
            

    var handleBootstrapSwitch = function() {

        $('.switch-radio1').on('switch-change', function () {
            $('.switch-radio1').bootstrapSwitch('toggleRadioState');
        });

        // or
        $('.switch-radio1').on('switch-change', function () {
            $('.switch-radio1').bootstrapSwitch('toggleRadioStateAllowUncheck');
        });

        // or
        $('.switch-radio1').on('switch-change', function () {
            $('.switch-radio1').bootstrapSwitch('toggleRadioStateAllowUncheck', false);
        });

    }


    var handleDatePickers = function () {

        if (jQuery().datepicker) {
            $('.date-picker').datepicker({
                rtl: App.isRTL(),
                orientation: "left",
                format: 'dd/mm/yyyy',
                autoclose: true
            // })
            // .inputmask("dd/mm/yyyy", {
            //      placeholder: "_"
            });
            //$('body').removeClass("modal-open"); // fix bug when inline picker is used in modal
        }

        /* Workaround to restrict daterange past date select: http://stackoverflow.com/questions/11933173/how-to-restrict-the-selectable-date-ranges-in-bootstrap-datepicker */
    }

    return {
        init: function () {
            extendValidatorPlugin();
            handleInputMasks();
            handleDatePickers();
            handleBootstrapSwitch();
        }
    };
}();

jQuery(document).ready(function() {
    PerijinanFormTools.init();
});