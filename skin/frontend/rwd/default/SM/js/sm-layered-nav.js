/**
 * Created by namma on 9/29/14.
 */
function setupSmLayeredNavigation() {

    // Layered-navigation with type of Link
    jQuery('.layered-nav-link').click(function() {
        var location = jQuery(this).data('location');
        sendRequest(location);
    });

    // Layered-navigation with type of Checkbox
    jQuery('.layered-nav-checkbox').change(function() {
        if (jQuery(this).is(':checked')) {
            var location = jQuery(this).val();
            sendRequest(location);
        }
    });

    // Layered-navigation with type of Select
    jQuery('.layered-nav-select').change(function() {
        var location = jQuery(this).val();

        if (location != null) {
            sendRequest(location);
        }
    });

    // Layered-navigation with type of Color Box
    jQuery('.layered-nav-color').click(function() {
        var location = jQuery(this).data('location');
        sendRequest(location);
    });

    jQuery('.block-layered-nav .btn-remove').click(function(evt) {
        evt.preventDefault();
        sendRequest(jQuery(this).attr('href'));
    });

    jQuery('.block-layered-nav .btn-clear-all').click(function(evt) {
        evt.preventDefault();
        sendRequest(jQuery(this).attr('href'));
    });

}

function sendRequest(location) {

    jQuery.ajax({
        url         : location,
        success     : function(resp) {
            console.log(resp);
            // Set new location without redirecting
            window.history.pushState('', '', location);

            // Replace current layered-navigation block with a new one
            var blockLayeredNav = jQuery(resp).find('.block-layered-nav').html();
            jQuery('.block-layered-nav').html(blockLayeredNav);

            // Replace current products block with a new one
            var categoryProducts = jQuery(resp).find('.category-products').html();
            jQuery('.category-products').html(categoryProducts);

            // Re-setup UI
            setupSmLayeredNavigation();
        },
        fail        : function() {
            alert('Failed. See console log for more details.');
        }
    });

}

jQuery(document).ready(setupSmLayeredNavigation);