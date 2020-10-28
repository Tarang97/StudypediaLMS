(function ($) {
    "use strict";
    var $wn =  $(window);
$wn.load(function () {
            /***************
             *  Preloader  *
             ***************/
            var $element = $("#loading");
            $element.fadeOut(1000);

            /****************************
             * Responsive Equal Height  *
             ****************************/
            /*var $element = $('.equal-hight');
            if ($element.length > 0) {
                var $viewportWidth = $wn.width();
                if ($viewportWidth > 767) {
                    $element.matchHeight();
                }
                $wn.on('resize', function () {
                        if ($viewportWidth > 767) {
                            $element.matchHeight();
                        }
                    });
            }*/
});
});
