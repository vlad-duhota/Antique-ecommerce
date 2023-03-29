/**
 * Customizer Communicator
 */
( function ( api, $ ) {
    "use strict";

    var windowObject = function() {

        return api.previewer.targetWindow();
    };

    var windowObjectReady = function() {

        return windowObject() && windowObject().hasOwnProperty('jQuery');
    };

    api.bind("ready", function() {

        function getSectionResponsiveFields(section) {

            return XTFW_CUSTOMIZER_CTRL.responsive_fields.filter(function (item) {
                return item.section === section;
            });
        }

        function injectDeviceSwitcher(fields) {

            fields.forEach(function (item) {

                var container = api.control(item.config_id+'['+item.id+']').container;
                if(container.find('.xirki-devices-wrapper').length === 0) {
                    container.prepend(XTFW_CUSTOMIZER_CTRL.device_switcher);

                    item.hidden_screens.forEach(function(hidden) {

                        container.find('.xirki-devices-wrapper').find('.preview-'+hidden).hide();
                    });
                }
            });
        }

        // Inject device switcher into responsive fields
        api.section.each( function ( section ) {

            section.expanded.bind( function( isExpanding ) {

                if(isExpanding){

                    var fields = getSectionResponsiveFields(section.id);
                    injectDeviceSwitcher(fields);
                }
            });
        });

        // Init device switcher event
        $(document).on('click', '.xirki-devices button', function() {

            var device = $(this).data('device');

            api.previewedDevice.set(device);
        });


        // Disable transitions while using Xirki slider, or radio buttons
        $(document.body).on('mouseenter', '.customize-control-xirki-slider, .customize-control-xirki-radio, .customize-control-xirki-radio-buttonset', function() {
            if(windowObjectReady()) {
                windowObject().jQuery('html').addClass('xtfw-no-transitions');
            }
        });
        $(document.body).on('mouseleave', '.customize-control-xirki-slider, .customize-control-xirki-radio, customize-control-xirki-radio-buttonset', function() {
            if(windowObjectReady()) {
                windowObject().jQuery('html').removeClass('xtfw-no-transitions');
            }
        });
        $(document.body).on('mouseenter xtfw_customizer_xt_woofc_changed', '#customize-preview', function() {
            if(windowObjectReady()) {
                windowObject().jQuery('html').removeClass('xtfw-no-transitions');
            }
        });

        // Init JS API functions test click event
        $(document).on('click', '.xt-jsapi', function(event) {

            event.preventDefault();

            var $this = $(this);
            var $parent = $this.parent();
            var func = $this.data('function');

            if(windowObjectReady() && windowObject().hasOwnProperty(func)) {

                var result = windowObject()[func]();
                result = JSON.stringify(result);

                if(result !== '' && result !== undefined) {

                    result = result === '"true"' ? 'true' : result;
                    result = result === '"false"' ? 'false' : result;

                    if($parent.find('.xt-jsapi-result').length) {
                        $parent.find('.xt-jsapi-result').remove();
                    }

                    $this.after('<pre class="xt-jsapi-result">Result: '+result+'</pre>');
                }
            }

        });

        // Fix issue with radio buttonset controls scrolling to top on click. Prevent default, set value and re-trigger change
        $(document.body).on('click', '.customize-control-xirki-radio-buttonset .switch-label', function(e) {
            e.preventDefault();
            $(this).prev('input').prop( 'checked', true ).trigger('change');
        });


        // Trigger event on setting change
        api.bind('change', function (setting) {

            if(windowObjectReady() && setting.id) {

                var setting_match = setting.id.match(/\[(.+?)\]/);
                if(setting_match && setting_match[1]) {

                    var setting_id = setting_match[1];
                    var config_id = setting.id.split('[')[0];

                    var setting_value = setting.get();

                    setTimeout(function() {
                        windowObject().jQuery(windowObject().document.body).trigger('xtfw_customizer_' + config_id + '_changed', [setting_id, setting_value]);
                        windowObject().jQuery(windowObject().document.body).trigger('xtfw_customizer_changed', [config_id, setting_id, setting_value]);
                    }, 100);

                }
            }
        });

        // Trigger event on save
        api.bind('saved', function () {

            if(windowObjectReady()) {
                windowObject().jQuery(windowObject().document.body).trigger('xtfw_customizer_saved');
            }
        });

    });

} )( wp.customize, jQuery );