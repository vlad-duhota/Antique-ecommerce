(function ($) {

    $(document).on("click", ".xt-framework-notice .notice-dismiss", function () {

        $(this).closest('.xt-framework-notice').each(function() {

            var cname = $(this).data("id"),
                cvalue = "yes";

            document.cookie = cname + "=" + cvalue + ";path=/";

            $(this).fadeOut();
        });
    });

})(jQuery);