/***
Wrapper/Helper Class for datagrid based on jQuery Datatable Plugin
***/
var Datatable = function() {

    var tableOptions; // main options
    var dataTable; // datatable object
    var table; // actual table jquery object
    var tableContainer; // actual table container object
    var tableWrapper; // actual table wrapper jquery object
    var tableInitialized = false;
    var ajaxParams = {}; // set filter mode
    var defaultParams = {}; // set default filter mode
    var the;

    var countSelectedRecords = function() {
        var selected = $('tbody > tr > td:nth-child(1) input[type="checkbox"]:checked', table).size();
        var text = tableOptions.dataTable.language.metronicGroupActions;
        if (selected > 0) {
            $('.table-group-actions > span', tableWrapper).text(text.replace("_TOTAL_", selected));
        } else {
            $('.table-group-actions > span', tableWrapper).text("");
        }
    };

    var fixedHeaderOffset = 0;
    if (App.getViewPort().width < App.getResponsiveBreakpoint('md')) {
        if ($('.page-header').hasClass('page-header-fixed-mobile')) {
            fixedHeaderOffset = $('.page-header').outerHeight(true);
        }
    } else if ($('body').hasClass('page-header-menu-fixed')) { // admin 3 fixed header menu mode
        fixedHeaderOffset = $('.page-header-menu').outerHeight(true);
    } else if ($('body').hasClass('page-header-top-fixed')) { // admin 3 fixed header top mode
        fixedHeaderOffset = $('.page-header-top').outerHeight(true);
    } else if ($('.page-header').hasClass('navbar-fixed-top')) {
        fixedHeaderOffset = $('.page-header').outerHeight(true);
    } else if ($('body').hasClass('page-header-fixed')) {
        fixedHeaderOffset = 64; // admin 5 fixed height
    }
    // var fixedHeaderOffset = 0;
    // if (App.getViewPort().width < App.getResponsiveBreakpoint('md')) {
    //     if ($('.page-header').hasClass('page-header-fixed-mobile')) {
    //         fixedHeaderOffset = $('.page-header').outerHeight(true);
    //     }
    // } else if ($('.page-header').hasClass('navbar-fixed-top')) {
    //     fixedHeaderOffset = $('.page-header').outerHeight(true);
    // } else if ($('body').hasClass('page-header-fixed')) {
    //     fixedHeaderOffset = 64; // admin 5 fixed height
    // }

    return {

        //main function to initiate the module
        init: function(options) {

            if (!$().dataTable) {
                return;
            }

            the = this;

            // default settings
            options = $.extend(true, {
                src: "", // actual table
                filterApplyAction: "filter",
                filterCancelAction: "filter_cancel",
                resetGroupActionInputOnSuccess: true,
                // loadingMessage: 'Loading...',

                dataTable: {
                    fixedHeader: {
                        header: false,
                        footer: false,
                        headerOffset: fixedHeaderOffset
                    },
                    "dom": "<'row'<'col-md-6 col-sm-12'<'table-group-actions'>>><'table-responsive't><'row'<'col-md-6 col-sm-12'li><'pull-right'p>>", // datatable layout
                    "pageLength": 10, // default records per page
                    "language": { // language settings
                        // metronic spesific
                        "metronicGroupActions": "_TOTAL_ data dipilih ",
                        "metronicAjaxRequestGeneralError": "Terjadi gangguan jaringan. Periksa koneksi internet Anda.",

                        // data tables spesific
                        "lengthMenu": "_MENU_ ",
                        // "lengthMenu": "<span class='seperator'>|</span>View _MENU_ records",
                        "info": "&nbsp;Tampil _START_ - _END_ dari _TOTAL_ data",
                        // "info": "<span class='seperator'>|</span>Found total _TOTAL_ records",
                        "infoEmpty": "&nbsp;Tidak ada data yang ditampilkan",
                        "emptyTable": "Tidak ada data",
                        "zeroRecords": "No matching records found",
                        "paginate": {
                            "previous": "Prev",
                            "next": "Next",
                            "last": "Last",
                            "first": "First",
                            "page": "Page",
                            "pageOf": "of"
                        }
                    },

                    "buttons": [
                                    { extend: 'print', className: 'btn default' },
                                    { extend: 'copy', className: 'btn default' },
                                    { extend: 'pdf', className: 'btn default' },
                                    { extend: 'excel', className: 'btn default' },
                                    { extend: 'csv', className: 'btn default' },
                                    {
                                        text: 'Reload',
                                        className: 'btn default',
                                        action: function ( e, dt, node, config ) {
                                            dt.ajax.reload();
                                            alert('Datatable reloaded!');
                                        }
                                    }
                    ],

                    "orderCellsTop": false,
                    "columnDefs": [{ // define columns sorting options(by default all columns are sortable extept the first checkbox column)
                        // 'orderable': false,
                        // 'targets': [0]
                            'orderable': false, 'targets': [0,($('#tableHeader').find('th').length)-1]
                        }
                    ],

                    // "pagingType": "bootstrap_full_number", // pagination type(bootstrap, bootstrap_full_number or bootstrap_extended)
                    "autoWidth": true, // disable fixed width and enable fluid table
                    "processing": false, // enable/disable display message box on record load
                    "serverSide": true, // enable/disable server side ajax loading

                    "ajax": { // define ajax settings
                        "url": "", // ajax URL
                        "type": "POST", // request type
                        "timeout": 20000,
                        "data": function(data) { // add request parameters before submit
                            $.each(ajaxParams, function(key, value) {
                                data[key] = value;
                            });
                            $.each(defaultParams, function(key, value) {
                                data[key] = value;
                            });
                            App.blockUI({
                                message: tableOptions.loadingMessage,
                                target: tableContainer,
                                overlayColor: 'none',
                                cenrerY: true,
                                boxed: true
                            });
                        },
                        "dataSrc": function(res) { // Manipulate the data returned from the server
                            if (res.customActionMessage) {
                                App.alert({
                                    type: (res.customActionStatus == 'OK' ? 'success' : 'danger'),
                                    icon: (res.customActionStatus == 'OK' ? 'check' : 'warning'),
                                    message: res.customActionMessage,
                                    container: tableWrapper,
                                    place: 'prepend'
                                });
                            }

                            if (res.customActionStatus) {
                                if (tableOptions.resetGroupActionInputOnSuccess) {
                                    $('.table-group-action-input', tableWrapper).val("");
                                }
                            }

                            if ($('.group-checkable', table).size() === 1) {
                                $('.group-checkable', table).attr("checked", false);
                            }

                            if (tableOptions.onSuccess) {
                                tableOptions.onSuccess.call(undefined, the, res);
                            }

                            App.unblockUI(tableContainer);

                            return res.data;
                        },
                        "error": function() { // handle general connection errors
                            if (tableOptions.onError) {
                                tableOptions.onError.call(undefined, the);
                            }

                            App.alert({
                                type: 'danger',
                                icon: 'warning',
                                message: tableOptions.dataTable.language.metronicAjaxRequestGeneralError,
                                container: tableWrapper,
                                place: 'prepend'
                            });

                            App.unblockUI(tableContainer);
                        }
                    },

                    "drawCallback": function(oSettings) { // run some code on table redraw
                        if (tableInitialized === false) { // check if table has been initialized
                            tableInitialized = true; // set table initialized
                            table.show(); // display table
                        }
                        countSelectedRecords(); // reset selected records indicator

                        // callback for ajax data load
                        if (tableOptions.onDataLoad) {
                            tableOptions.onDataLoad.call(undefined, the);
                        }
                    }
                }
            }, options);

            tableOptions = options;

            // create table's jquery object
            table = $(options.src);
            the.table = table;
            tableContainer = table.parents(".table-container");

            // apply the special class that used to restyle the default datatable
            var tmp = $.fn.dataTableExt.oStdClasses;

            $.fn.dataTableExt.oStdClasses.sWrapper = $.fn.dataTableExt.oStdClasses.sWrapper + " dataTables_extended_wrapper";
            $.fn.dataTableExt.oStdClasses.sFilterInput = "form-control input-xs input-sm input-inline";
            $.fn.dataTableExt.oStdClasses.sLengthSelect = "form-control input-xs input-sm input-inline";

            // initialize a datatable
            dataTable = table.DataTable(options.dataTable);

            // revert back to default
            $.fn.dataTableExt.oStdClasses.sWrapper = tmp.sWrapper;
            $.fn.dataTableExt.oStdClasses.sFilterInput = tmp.sFilterInput;
            $.fn.dataTableExt.oStdClasses.sLengthSelect = tmp.sLengthSelect;

            // get table wrapper
            tableWrapper = table.parents('.dataTables_wrapper');

            // build table group actions panel
            if ($('.table-actions-wrapper', tableContainer).size() === 1) {
                $('.table-group-actions', tableWrapper).html($('.table-actions-wrapper', tableContainer).html()); // place the panel inside the wrapper
                $('.table-actions-wrapper', tableContainer).remove(); // remove the template container
            }
            // handle group checkboxes check/uncheck
            $('.group-checkable').change(function() {
                var set = table.find('tbody > tr > td:nth-child(1) input[type="checkbox"]');
                var checked = $(this).prop("checked");
                
                $(set).each(function() {
                    var cek = $(this).attr('disabled');
                    if (!cek)
                    {
                        // $(this).prop("checked", checked);
                        if (checked) {
                            $(this).prop("checked", true);
                            $(this).parents('tr').addClass("active");
                        } else {
                            $(this).prop("checked", false);
                            $(this).parents('tr').removeClass("active");
                        }
                    }                    
                });
                countSelectedRecords();
            });

            // handle row's checkbox click
            table.on('change', 'tbody > tr > td:nth-child(1) input[type="checkbox"]', function () {
                countSelectedRecords();
                $(this).parents('tr').toggleClass("active");

            });




            // handle filter submit button click
            table.on('change', '.form-filter', function(e) {
                e.preventDefault();
                the.submitFilter();
            });

            $('.filter-submit').click(function(e){
                e.preventDefault();
                the.submitFilter();
            });

            // handle filter cancel button click
            table.on('click', '.filter-cancel', function(e) {
                e.preventDefault();
                the.resetFilter();
            });
            $('.filter-cancel').click(function(e){
                e.preventDefault();
                the.resetFilter();
            });

            // handle filter cancel button click
            table.on('click', '.delete', function(e) {
                e.preventDefault();
                var url_del = $(this).data('url');
                var title = $(this).data('title');

                swal({
                //   title: "Delete <i class=\"red\">"+title+"</i> ?",
                //   text: $(this).data('title'),
                  html : "Hapus <b>"+title+"</b> ?",
                  type: "question",
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  cancelButtonText: 'Batal',
                  confirmButtonText: 'Ya'
                }).then(function(){
                    console.log(url_del);
                    $.post(url_del, {param1: 'value1'}, function(data, textStatus, xhr) {
                        if (data.success == true) {
                            App.alert({
                                type: 'success',
                                icon: 'check',
                                message: '<b>Sukses! </b> Data berhasil dihapus.',
                                container: tableWrapper,
                                place: 'prepend'
                            });
                            dataTable.ajax.reload();
                        }else{
                            swal("Opps!", data.message, "warning");
                        }
                    });
                });
            });
            //handle load modal
            // handle filter cancel button click
            // table.on('click', '.openmodal', function(e) {
            //     e.preventDefault();
            //     $('#temp_modal').load( $(this).attr("data-url"), { "modal": true }, function() {
            //     //   alert( "Load was performed." );
            //     });
            // });

            // handle checked action
            the.getTableWrapper().on('click', '.table-group-action-submit', function (e) {
                e.preventDefault();
                var action = $(".table-group-action-input", the.getTableWrapper());
                if (action.val() != "" && the.getSelectedRowsCount() > 0) 
                {
                    bootbox.confirm({
                        title: $(".table-group-action-input option:selected").text()+" Data",
                        message: "Apakah Anda sudah yakin ?",
                        buttons: {
                            cancel: {
                                label: '<i class="fa fa-times"></i> Batal'
                            },
                            confirm: {
                                label: '<i class="fa fa-check"></i> OK'
                            }
                        },
                        callback: function (result) {
                            if ( result )
                            {
                                the.setAjaxParam("customActionType", "group_action");
                                the.setAjaxParam("customActionName", action.val());
                                the.setAjaxParam("id", the.getSelectedRows());
                                the.getDataTable().ajax.reload();
                                the.clearAjaxParams();
                            }
                        }
                    })
                } else if (action.val() == "") {
                    App.alert({
                        type: 'warning',
                        icon: 'warning',
                        message: '<b>Maaf!</b> Aksi belum dipilih',
                        container: the.getTableWrapper(),
                        place: 'prepend'
                    });
                } else if (the.getSelectedRowsCount() === 0) {
                    App.alert({
                        type: 'warning',
                        icon: 'warning',
                        message: '<b>Maaf!</b> Data belum dipilih',
                        container: the.getTableWrapper(),
                        place: 'prepend'
                    });
                }
            });


            // handle datatable custom tools
            $('#datatable_ajax_tools > li > a.tool-action').on('click', function() {
                var action = $(this).attr('data-action');
                the.getDataTable().button(action).trigger();
            });
        },

        submitFilter: function() {
            the.setAjaxParam("action", tableOptions.filterApplyAction);

            // get all typeable inputs
            $('textarea.form-filter, select.form-filter, input.form-filter:not([type="radio"],[type="checkbox"])').each(function() {
                the.setAjaxParam($(this).attr("name"), $(this).val());
            });

            // get all checkboxes
            $('input.form-filter[type="checkbox"]:checked').each(function() {
                the.addAjaxParam($(this).attr("name"), $(this).val());
            });

            // get all radio buttons
            $('input.form-filter[type="radio"]:checked').each(function() {
                the.setAjaxParam($(this).attr("name"), $(this).val());
            });

            dataTable.ajax.reload();
        },

        resetFilter: function() {
            $('textarea.form-filter, select.form-filter, input.form-filter').each(function() {
                $(this).val("");
            });
            $('select.select2-ajax, select.select2').each(function() {
                $(this).trigger("change");
            });
            $('input.form-filter[type="checkbox"]').each(function() {
                $(this).attr("checked", false);
            });
            the.clearAjaxParams();
            the.addAjaxParam("action", tableOptions.filterCancelAction);
            dataTable.ajax.reload();
        },

        getSelectedRowsCount: function() {
            return $('tbody > tr > td:nth-child(1) input[type="checkbox"]:checked', table).size();
        },

        getSelectedRows: function() {
            var rows = [];
            $('tbody > tr > td:nth-child(1) input[type="checkbox"]:checked', table).each(function() {
                rows.push($(this).val());
            });

            return rows;
        },

        setAjaxParam: function(name, value) {
            ajaxParams[name] = value;
        },

        addAjaxParam: function(name, value) {
            if (!ajaxParams[name]) {
                ajaxParams[name] = [];
            }

            skip = false;
            for (var i = 0; i < (ajaxParams[name]).length; i++) { // check for duplicates
                if (ajaxParams[name][i] === value) {
                    skip = true;
                }
            }

            if (skip === false) {
                ajaxParams[name].push(value);
            }
        },

        clearAjaxParams: function(name, value) {
            ajaxParams = {};
        },

        setDefaultParam: function(name, value) {
            defaultParams[name] = value;
        },

        addDefaultParam: function(name, value) {
            if (!defaultParams[name]) {
                defaultParams[name] = [];
            }

            skip = false;
            for (var i = 0; i < (defaultParams[name]).length; i++) { // check for duplicates
                if (defaultParams[name][i] === value) {
                    skip = true;
                }
            }

            if (skip === false) {
                defaultParams[name].push(value);
            }
        },

        clearDefaultParams: function(name, value) {
            defaultParams = {};
        },

        getDataTable: function() {
            return dataTable;
        },

        getTableWrapper: function() {
            return tableWrapper;
        },

        gettableContainer: function() {
            return tableContainer;
        },

        getTable: function() {
            return table;
        }

    };

};
