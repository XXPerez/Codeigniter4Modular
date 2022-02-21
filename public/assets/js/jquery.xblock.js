"use strict";
function FKMblock(element, action, options) {
    this.element = element;
    this.options = $.extend(true, {}, this.options, options);
    try {
        if (action == 'block')
            this.block(this.options);
        if (action == 'blockparent')
            this.blockparent(this.options);
        if (action == 'unblock')
            this.unblock(this.options);
        if (action == 'unblockparent')
            this.unblockparent(this.options);
    } catch (e) {
        
    }

}
FKMblock.prototype = {
    options: {
            //message: '<img src="'+PMEDIABASEWEB+'/apsets/img/ajax-loader.gif">',
            message: '<i class="icon-spinner4 spinner"></i>',
            overlayCSS: {
                backgroundColor: '#fff',
                opacity: 0.8,
                cursor: 'wait'
            },
            css: {
            	width: 16,
                border: 0,
                padding: 0,
                'background-color': 'transparent',
                'border-color': '#28343a'
            },
            ignoreIfBlocked: true
    },
    block: function (options) {
        if (this.element.hasClass('card')) options.overlayCSS['box-shadow']='0 0 0 1px #ddd';
        this.element.toggleClass('kmblocked');
        this.element.block(options);
    },
    unblock: function () {
        this.element.toggleClass('kmblocked');
        this.element.unblock();
    },
    blockparent: function (options) {
        this.element.parent().toggleClass('kmblocked');
        this.element.parent().block(options);
    },
    unblockparent: function () {
        this.element.parent().toggleClass('kmblocked');
        this.element.parent().unblock();
    }
};

jQuery.fn.kmblock = function (action, options) {
    new FKMblock(this, action, options);
    return this;
};

