$(function() {
    "use strict";
    $(document).ajaxError(function(event,request){
        // In select2 when statusText is 'abort' it has to ignore.
        if (request.statusText=='abort') return false;
        if (request.status == 401) {
            errorAlertNotLogged(request.status);
        } else {
            errorAlert(request.status);
        }
    });
});

function errorAlertNotLogged() {
    $("#modal-alert").on('hidden.bs.modal', function(){
        window.location.replace(BASEURL+"/login");
    });    
    let modalDiv = $("#modal-alert");
    let modalContent = modalDiv.find('.modal-content');
    modalContent.find('.modal-title').html('ATENCION !!!');
    modalContent.find('.modal-body').html('<div style="height:40px;">Ha caducado la sesión</div>');
    $("#modal-alert").modal('show');
};

function errorAlert(errorMessage, callback) {
    let modalDiv = $("#modal-alert");
    let modalContent = modalDiv.find('.modal-content');
    modalContent.find('.modal-title').html('ATENCION !!!');
    modalContent.find('.modal-body').html('<div style="height:40px;">'+errorMessage+'</div>');
    $("#modal-alert").modal('show');
    
    if (callback != '') {
        $("#modal-alert").on('hidden.bs.modal', function (e) {
            eval(callback+";");
        })        
    }
};

"use strict";
var xModalDeferred;
(function ($) {
    var defaultOptions = {
            warning: {
                "background": 'bg-warning',
                "icon": 'icon-warning',
                "title": strLang.atentiontitle,
                "text": '',
                "htmlText": '',
                "firstFocus": '',
                "size": ''
            },
            error: {
                "background": 'bg-danger',
                "icon": 'icon-exclamation',
                "title": 'generic.error',
                "text": 'error.default.description',
                "htmlText": '',
                "firstFocus": '',
                "size": ''
            },
            info:{
                "background": 'bg-info',
                "icon": 'icon-info',
                "title": strLang.atentiontitle,
                "text": '',
                "htmlText": '',
                "firstFocus": '',
                "size": ''
            },
            help:{
                "background": 'bg-primary',
                "icon": 'icon-help',
                "title": 'generic.help',
                "text": '',
                "htmlText": '',
                "firstFocus": '',
                "size": ''
            }
        };
    $.extend({
        xModal: function (action, properties, callback, callbackOptions) {
            var type='alert';
            var mode='info';
            var aType=[];
            var result={"options":{},"buttonPressed":""};
            var propertiesType = {};

            aType=action.split('-');
            type=aType[0];
            if (type.length>1) mode=aType[1];

            if (typeof callback !== 'function') callback=function(){};
            if (typeof callbackOptions === 'object') result.options=callbackOptions;
            if (typeof properties !== 'object') properties = {};

            // Text by default depending on the type
            if (type === 'confirm' || type === 'confirmyn') {
                propertiesType.text = "generic.are_you_sure";
                $("#modal-confirm .modal-footer > button").hide();
                if (typeof properties.buttons!=='undefined') {
                    for (let i=0;i<properties.buttons.length;i++) {
                        $('[data-modal-button='+properties.buttons[i]+']').show();
                    }
                    $("[data-modal-button]").each(function(){
                        if ($(this).css("display")!=="none") {
                            propertiesType.firstFocus = $(this);
                            return false;
                        }
                    });

                } else {
                    $('[data-modal-button=no]').show();
                    $('[data-modal-button=yes]').show();
                    propertiesType.firstFocus = '[data-modal-button=yes]';
                }
                type = 'confirm';
            } else if (type === 'alert' || type === 'help') {
                propertiesType.firstFocus = '.modal-footer button';
            } else if (type === 'confirmac') {
                propertiesType.text = "generic.are_you_sure";
                $("#modal-confirm .modal-footer > button").hide();
                if (typeof properties.buttons!=='undefined') {
                    for (let i=0;i<properties.buttons.length;i++) {
                        $('[data-modal-button='+properties.buttons[i]+']').show();
                    }
                    $("[data-modal-button]").each(function(){
                        if ($(this).css("display")!=="none") {
                            propertiesType.firstFocus = $(this);
                            return false;
                        }
                    });

                } else {
                    $('[data-modal-button=cancel]').show();
                    $('[data-modal-button=accept]').show();
                    propertiesType.firstFocus = '[data-modal-button=accept]';
                }
                type = 'confirm';
            } else if (type === 'confirmbc') {
                propertiesType.text = "generic.are_you_sure";
                $("#modal-confirm .modal-footer > button").hide();
                if (typeof properties.buttons!=='undefined') {
                    for (let i=0;i<properties.buttons.length;i++) {
                        $('[data-modal-button='+properties.buttons[i]+']').show();
                    }
                    $("[data-modal-button]").each(function(){
                        if ($(this).css("display")!=="none") {
                            propertiesType.firstFocus = $(this);
                            return false;
                        }
                    });

                } else {
                    $('[data-modal-button=back]').show();
                    $('[data-modal-button=continue]').show();
                    propertiesType.firstFocus = '[data-modal-button=back]';
                }
                type = 'confirm';
            }
            properties = $.extend(true, {}, defaultOptions[mode], propertiesType, properties);

            $('#modal-'+type).data('xmodalProperties',properties);
            $('#modal-'+type).data('xmodalCallbackOptions',result);

            var modalObj=$('#modal-'+type).modal();
            xModalDeferred = $.Deferred();
            xModalDeferred.done(callback);

            return modalObj;
        }
    });
    
})(jQuery);

$(function() {

    // Show with properties changed
    $('#modal-alert, #modal-confirm, #modal-help').on('show.bs.modal', function () {
        let properties = $(this).data('xmodalProperties');
        if (properties) {        
            $(this).find('.modal-header').attr('class','modal-header'); // clear all classes
            $(this).find('.modal-header .modal-icon').attr('class','modal-icon'); // clear all classes

            $(this).find('.modal-header').addClass(properties.background);
            $(this).find('.modal-header .modal-icon').addClass(properties.icon);

            $(this).find('.modal-header .modal-title').text(properties.title);

            if (properties.htmlText === '') {
                $(this).find('.modal-body').html('<p>'+properties.text+'</p>');
            } else {
                $(this).find('.modal-body').html(properties.htmlText);
            }
            if (properties.firstFocus !== '') {
                if (typeof properties.firstFocus==="string") {
                    $(this).find(properties.firstFocus).addClass('modal-first');
                } else
                    // Es un jQuery object
                    properties.firstFocus.addClass('modal-first');
            }
            if(properties.size != '')
            {
                $(this).find('.modal-dialog').addClass('modal-'+properties.size);
            }
    //        $('.modal-dialog').draggable({
    //            handle: ".modal-header, .navbar-top"
    //        });
        }        
    });

    $('#modal-initial, #modal-alert, #modal-confirm, #modal-remote, #modal-help').on('shown.bs.modal', function () {
        $(this).find('.modal-first').first().focus();
    });

    // on hidden alert
    $('#modal-alert').on('hidden.bs.modal', function () {
       xModalDeferred.resolve( $(this).data('xmodalCallbackOptions') );
    });

    // on hidden help
    $('#modal-help').on('hidden.bs.modal', function () {
       xModalDeferred.resolve( $(this).data('xmodalCallbackOptions') );
    });

    // Which button was pressed on confirm
    $('#modal-confirm .modal-footer button').on('click', function () {
        $('#modal-confirm').data('xmodalCallbackOptions').buttonPressed=$(this).data('modalButton');
        $('#modal-confirm').modal('hide');
    });
    // on hidden confirm
    $('#modal-confirm').on('hidden.bs.modal', function () {
        xModalDeferred.resolve( $(this).data('xmodalCallbackOptions') );
    });
    
    $('#modal-remote, #modal-alert, #modal-confirm, #modal-help').on('hidden.bs.modal', function ()
    {   
        if($(this).find('.modal-dialog').hasClass('modal-sm'))
        {
            $(this).find('.modal-dialog').removeClass('modal-sm');
        }
        else if($(this).find('.modal-dialog').hasClass('modal-lg'))
        {
            $(this).find('.modal-dialog').removeClass('modal-lg');
        }
        else if($(this).find('.modal-dialog').hasClass('modal-xl'))
        {
            $(this).find('.modal-dialog').removeClass('modal-xl');
        }
        else if($(this).find('.modal-dialog').hasClass('modal-full'))
        {
            $(this).find('.modal-dialog').removeClass('modal-full');
        }
    });
    
    $(document).on("focus", "input[type=number]", function (e) {
        $(this).on('wheel.disableScroll', function (e) {
          e.preventDefault()
        })        
    });
    $(document).on('blur', 'input[type=number]', function (e) {
      $(this).off('wheel.disableScroll')
    })    
});


function testButton()
{
        $.xModal('confirm-info', {htmlText: 'TEST', buttons: ['accept','cancel']}, function(result) {
            console.log(result);
        });
    
}