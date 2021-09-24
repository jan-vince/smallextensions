/**
 * Wait for render
 */
$(window).on('render', function () {

        $('.field-repeater-items>li').each(function ($el) {

            var firstInputValue;
            firstInputValue = $(this).find('input[type=text]').first().attr('value');
            collapseTitle = $(this).data('collapse-title');
            newTitle = collapseTitle;

            if (firstInputValue) {
                // Remove HTML tags from input value
                var regex = /(<([^>]+)>)/ig;
                var body = firstInputValue.toString();
                var result = body.replace(regex, "");

                newTitle = newTitle + ' >> ' + result;
            }

            $(this).attr('data-collapse-title', newTitle);
            $(this).find('.repeater-item-collapsed-title').text(newTitle).attr('data-title', newTitle);
            $(this).find('.repeater-item-collapsed-title').first().addClass('repeater-item-collapsed-title-changed').removeClass('repeater-item-collapsed-title');

        });
});

