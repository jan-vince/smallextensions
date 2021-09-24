/**
 * Wait for render
 */
$(window).on('render', function () {
    $('.field-repeater-items>li').each(function ($el) {
        collapseTitle = $(this).data('collapse-title');
        firstInputValue = $(this).find('input[type=text]').first().attr('value');
        
        newTitle = collapseTitle;

        if (firstInputValue.length) {
            newTitle = newTitle + ' >> ' + firstInputValue;
        }
        
        $(this).attr('data-collapse-title', newTitle);
        $(this).find('.repeater-item-collapsed-title').first().text(newTitle);
    });
});

