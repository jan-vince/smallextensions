function onDuplicatePage(el) {
    var $el = $(el);
    $el.request('onDuplicate', {
        complete: function() {
            $.oc.pagesPage.updateObjectList('page');
        }
    });
};

+function ($) { "use strict";
    $(document).on('ajaxSuccess', '#pages-master-tabs form', function (event, context, data) {
        var $form = $(event.currentTarget);
        if (data.objectPath !== undefined) {
            $('[data-control=duplicate-button]', $form).removeClass('oc-hide hide')
        }
    });
}(window.jQuery);