(function( $ ) {
    'use strict';

    $(function() {

        // To avoid scope issues, use 'self' instead of 'this'
        // to reference this class from internal events and functions.

        var self = {};

        self.form = null;
        self.throttleTimeout = null;
        self.accordions = {};
        self.actionConfirm = {};
        self.datePickers = {};
        self.colorPickers = {};
        self.radioButtons = {};
        self.tooltips = {};
        self.conditions = {};
        self.previews = {
            ids: [],
            stickyPreviews: []
        };
        self.events = {};

        self.init = function() {

            self.form = $(".xtfw-settings-form");

            self.accordions.init();
            self.actionConfirm.init();
            self.datePickers.init();
            self.colorPickers.init();
            self.radioButtons.init();
            self.tooltips.init();
            self.conditions.init();
            self.previews.init();
            self.events.init();

            xtfw_settings.api = self;

            $(document.body).trigger('xtfw_settings_init');
        };

        self.getAjaxAction = function(action) {

            return xtfw_settings.ajax_action.toString().replace( '%%action%%', action );
        };

        self.eventType = function(id) {

            return xtfw_settings.prefix+'_'+id+'_js_action';
        };

        self.isButtonLoading = function($button) {
            return $button.hasClass('processing');
        };

        self.startButtonLoading = function($button) {
            $button.addClass('processing').find('.xtfw-spinner').addClass('active');
        };

        self.endButtonLoading = function($button) {
            $button.removeClass('processing').find('.xtfw-spinner').removeClass('active');
        };

        self.removeNotices = function() {

            $('.xt-framework-notice').remove();
        };

        self.showNotices = function(notices, scroll) {

            scroll = scroll || false;

            if(notices !== '') {
                $('.xtfw-admin-tabs-header h1').after($(notices));

                if(scroll) {
                    self.scrollTo($(notices), {offset: 20});
                }
            }
        };

        self.scrollTo = function(element, params, callback) {

            callback = callback || null;

            var default_params = {
                offset: 0,
                duration: 500,
                delay: 0,
                highlight: false
            };

            params = params || {};
            params = $.extend(default_params, params);

            setTimeout(function() {

                $('html,body').animate({scrollTop: element.offset().top - params.offset}, params.duration, function() {

                    if(callback) {
                        callback();
                    }
                });

            }, params.delay)
        };

        self.throttle = function(timeout, callback) {

            if(self.throttleTimeout) {
                clearTimeout(self.throttleTimeout);
            }

            self.throttleTimeout = setTimeout(function() {

                callback();

            }, timeout);
        };

        self.getUrlParam = function(name) {
            name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
            var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
            var results = regex.exec(location.search);
            return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
        };

        self.getField = function(id) {

            return self.getFlattenFields().find(function(item) {
                return self.flattenFieldId(item.id) === self.flattenFieldId(id);
            });
        };

        self.getFieldElement = function(field) {

            var flatten_id = self.flattenFieldId(field.id);

            if($('#'+flatten_id).length) {
                return $('#'+flatten_id);
            }

            if($('[name="'+flatten_id+'"]').length) {
                return $('[name="'+flatten_id+'"]');
            }

            if($('[name="'+field.name+'"]').length) {
                return $('[name="'+field.name+'"]');
            }

            return $('[name="'+field.id+'"]');
        };

        self.getCustomFieldsInputs = function(field) {

            var flatten_id = self.flattenFieldId(field.id);

            return $('label[for="'+flatten_id+'"]').closest('tr').find('td').find(':input').not(':button');
        };

        self.getFieldValue = function(field) {

            field = (typeof(field) !== 'object') ? self.getField(field) : field;

            var $element = self.getFieldElement(field);

            if(!$element.length) {
                return '';
            }

            var is_group = field.type === 'group';

            if(is_group) {

                var values = [];
                field.fields.map(function(sfield) {
                    values.push(self.getFieldValue(sfield));
                });
                return values;
            }

            if(field.type === 'checkbox') {
                return $element.prop("checked") === true ? 'yes' : 'no';
            }

            if(field.type === 'radio' || field.type === 'radio-buttons') {
                return $element.filter(':checked').val();
            }

            if(field.type === 'textarea') {
                return $element.html();
            }

            return $element.val();
        };

        self.isCustomFieldType = function(field) {

            return ![
                'title',
                'sectionend',
                'group',
                'text',
                'password',
                'datetime',
                'datetime-local',
                'date',
                'month',
                'time',
                'week',
                'number',
                'range',
                'email',
                'url',
                'tel',
                'textarea',
                'select',
                'multiselect',
                'image',
                'color',
                'radio',
                'radio-buttons',
                'checkbox',
                'admin_action',
                'single_select_page',
                'single_select_country',
                'multi_select_countries',
                'relative_date_selector'
            ].includes(field.type);
        };

        self.setElementValue = function($element, value) {

            if(!$element.length) {
                return;
            }

            var type = $element.get(0).type;

            if(type === 'checkbox') {

                value = (value === true || value === '1' || value === 'yes');
                $element.prop('checked', value).trigger('change').trigger('input');

            }else if(type === 'radio') {

                $element.filter('[value='+value+']').prop('checked', true).trigger('change').trigger('input');

            }else {

                $element.val(value).trigger('change').trigger('input');
            }

        };

        self.setFieldValue = function(field, value) {

            field = (typeof(field) !== 'object') ? self.getField(field) : field;

            if(field.type === 'group') {
                return '';
            }

            if(!self.isCustomFieldType(field)) {

                var $element = self.getFieldElement(field);

                self.setElementValue($element, value);

            }else{

                var $elements = self.getCustomFieldsInputs(field);

                if(value.search(/:/) !== -1) {
                    value = value.split(':');
                }else{
                    value = [];
                    for(var i = 0; i < $elements.length ; i++) {
                        value.push('');
                    }
                }

                if(value.length === $elements.length) {

                    $elements.each(function(index) {

                        self.setElementValue($(this), value[index]);
                    });
                }
            }
        };

        self.getFieldDefaultValue = function(field) {

            field = (typeof(field) !== 'object') ? self.getField(field) : field;

            return field.default;
        };

        self.resetFieldValue = function(field) {

            field = (typeof(field) !== 'object') ? self.getField(field) : field;

            var default_value;

            if(field.type !== 'group') {
                default_value = self.getFieldDefaultValue(field);
                self.setFieldValue(field, default_value);
            }else{
                field.fields.forEach(function(sfield) {
                    self.resetFieldValue(sfield);
                });
            }
        };

        self.getFields = function() {

            return xtfw_settings.fields.filter(function(field) {
                return field.type !== 'sectionend';
            });
        };

        self.getFlattenFields = function() {

            return [].concat(
                self.getFields(),
                self.getFields().filter(function(field) {
                    return field.type && field.type === 'group' && field.fields.length;
                }).flatMap(function(field) {
                    return field.fields;
                })
            );
        };

        self.flattenFieldId = function(id) {
            return id.replace('[', '_').replace(']', '');
        };

        self.escapedFieldId = function(id) {
            return id.replace('[', '\\[').replace(']', '\\]');
        };

        self.saveSettings = function(silent, callback) {

            var $button = self.form.find('#xtfw-save-settings');

            silent = silent || false;
            callback = callback || null;

            if(self.isButtonLoading($button)) {
                return;
            }

            self.removeNotices();
            self.startButtonLoading($button);

            var formData = new FormData(self.form.get(0));

            formData.append('action', self.getAjaxAction('save_settings'));

            $.ajax({
                url: ajaxurl,
                enctype: 'multipart/form-data',
                type: 'post',
                data: formData,
                processData: false,  // Important!
                contentType: false,
                cache: false,
                timeout: 600000

            }).done(function(response) {

                if(response.success) {

                    $(document.body).trigger('xtfw_settings_saved');
                }

                if(!silent) {
                    self.showNotices(response.notices, true);
                }

                if(callback) {
                    callback(response);
                }

            }).always(function() {

                self.endButtonLoading($button);
            });
        };

        self.accordions.init = function() {

            if(self.form.length && self.form.hasClass('xtfw-settings-sectioned') && self.form.find('.xtfw-settings-title').length) {

                var active = xtfw_settings.sub_id ? parseInt(xtfw_settings.sub_id) : 0;

                self.form.accordion({
                    header: ".xtfw-settings-title",
                    collapsible: true,
                    heightStyle: "content",
                    active: active,
                    icons: { "header": "dashicons-arrow-right-alt2", "activeHeader": "dashicons-arrow-down-alt2" },
                    beforeActivate: function(event) {

                        var originalTarget = $(event.originalEvent.target);
                        if(originalTarget.hasClass('xtfw-reset-section-settings') || originalTarget.hasClass('inline-confirmation-block') || originalTarget.closest('.inline-confirmation-block').length) {
                            return false;
                        }
                    },
                    activate: function( event, ui ) {

                        if(ui.newHeader.length) {
                            $([document.documentElement, document.body]).animate({
                                scrollTop: ui.newHeader.offset().top - 60
                            }, 400);

                            $(document.body).trigger('xtfw_settings_section_changed');
                        }
                    }
                });

                self.form.find('.ui-accordion-header-icon.ui-icon').removeClass('ui-icon').addClass('dashicons');

                self.form.find('.xtfw-settings-title').on('click', function() {

                    var sub_id = $(this).data('sub_id');
                    var url = location.href.split('&sub_id=')[0] + '&sub_id='+sub_id;
                    window.history.replaceState({}, document.title, url);

                    self.form.find('a.button').each(function() {
                        url = $(this).attr('href').split('&sub_id=')[0] + '&sub_id='+sub_id;
                        $(this).attr('href', url)
                    });

                    url = self.form.attr('action').split('?sub_id=')[0] + '?sub_id='+sub_id;
                    self.form.attr('action', url);

                });

            }
        };

        self.actionConfirm.init = function() {

            // action confirm popup
            $('a[data-confirm]').each( function() {

                var $button = $(this);

                self.actionConfirm.confirm($button, function(evt, button) {

                    self.actionConfirm.process(button);
                });

            });
        };

        self.actionConfirm.confirm = function($button, callback) {

            $button.inlineConfirm({
                message: $button.data('confirm'),
                preventDefaultEvent: true,
                showOriginalAction: true,
                confirmCallback: function(evt, button) {

                    callback(evt, button);
                }
            });
        };

        self.actionConfirm.process = function($button) {

            if(self.isButtonLoading($button)) {
                return;
            }

            self.removeNotices();

            var action_id = $button.attr('id');
            var process_action = self.getAjaxAction('process_action');

            var callback = function() {
                self.endButtonLoading($button);
            };

            self.startButtonLoading($button);

            // Allow XT plugins to override the default action
            if ( true === $( document.body ).triggerHandler( action_id + '_js_action', [ $button, callback ] ) ) {
                return;
            }

            var data = {
                action: process_action,
                action_id: action_id
            };

            if($button.data('data')) {
                data = $.extend(data, $button.data('data'));
            }

            $.ajax({
                url: ajaxurl,
                type: 'post',
                data: data,
                cache: false,
                timeout: 600000

            }).done(function(response) {

                self.showNotices(response.notices, true);

            }).always(function() {

                self.endButtonLoading($button);
            });
        };

        self.datePickers.init = function() {

            $( '.xtfw-datepicker' ).datepicker({
                dateFormat: 'yy-mm-dd',
                numberOfMonths: 1,
                showButtonPanel: true,
                showOn: 'button',
                buttonImage: xtfw_settings.assets_url + '/images/calendar.png',
                buttonImageOnly: true
            });
        };

        self.colorPickers.init = function() {

            $('.xtfw-colorpicker').each(function() {

                var $picker = $(this);

                $picker.wpColorPicker({
                    change: function(event, ui) {

                        setTimeout(function() {
                            $(event.target).trigger('change', [ui.color]);
                        }, 20);
                    }
                });

                var $picker_holder = $picker.closest('.wp-picker-container').find('.wp-picker-holder');

                $picker_holder.on('mouseup', function() {
                    $picker.wpColorPicker('close');
                });
            });
        };
        
        self.radioButtons.init = function() {

            $(document.body).on('click', '.xtfw-settings-form .forminp-radio-buttons label', function() {
                $(this).closest('li').find('input').prop('checked', true).trigger('change');
            });

        };
        
        self.tooltips.init = function() {

            $( '.xtfw-help-tip' ).tipTip( {
                'attribute': 'data-tip',
                'fadeIn': 50,
                'fadeOut': 50,
                'delay': 200
            });
        };

        self.conditions.init = function () {

            self.conditions.apply();

            $(document.body).on('change', '.xtfw-settings-form select, .xtfw-settings-form input[type="checkbox"], .xtfw-settings-form input[type="radio"]', function(e) {

                setTimeout(function() {
                    self.conditions.apply();
                }, 200);
            });
        };

        self.conditions.apply = function() {

            var group, row, visible;

            // Combine fields with group fields to create 1 flat array of fields
            var fields = self.getFlattenFields();

            self.form.find('.forminp-group').removeAttr('data-visible');

            fields.forEach(function(field) {

                field = field.has_preview || field;

                var $element = self.getFieldElement(field);

                if(field.type === 'preview') {
                    row = $element.closest('.xtfw-settings-preview-sidebar').find('.xtfw-settings-preview, .xtfw-settings-preview-title');
                }else{
                    row = $element.closest('tr');
                }

                if(row.length) {

                    group = row.closest('.forminp-group');

                    if (self.conditions.isFieldHidden(field)) {

                        row.addClass('hidden');
                        field.isVisibile = false;

                    } else {

                        row.removeClass('hidden');
                        field.isVisibile = true;

                        visible = parseInt(group.attr('data-visible') ? group.attr('data-visible') : 0) + 1;
                        group.attr('data-visible', visible);
                    }
                }
            });
        };

        self.conditions.isFieldHidden = function(field) {

            var hidden = false;

            if(field.conditions) {

                var conditions = field.conditions;
                var total = conditions.length;
                var passed = 0;

                conditions.forEach(function (condition) {

                    var targetField = self.getField(condition.id);

                    if(targetField) {

                        var targetFieldValue = self.getFieldValue(targetField);
                        var conditionValue = condition.value;

                        var conditionOperator = condition.operator || '===';

                        // If value is an object and we have a condition on a specific item
                        if(condition.item) {

                            // find the item
                            var valueItem = targetFieldValue.find(function(item) {

                                return item[condition.item.key] === condition.item.value;
                            });

                            // Override target value with the item value based on the condition key
                            targetFieldValue = valueItem[condition.item.conditionKey];
                        }

                        if (
                            (conditionOperator === '===' && targetFieldValue === conditionValue) ||
                            (conditionOperator === '!==' && targetFieldValue !== conditionValue) ||
                            (conditionOperator === '<' && targetFieldValue < conditionValue) ||
                            (conditionOperator === '>' && targetFieldValue > conditionValue) ||
                            (conditionOperator === '<=' && targetFieldValue <= conditionValue) ||
                            (conditionOperator === '>=' && targetFieldValue >= conditionValue) ||
                            (conditionOperator === 'in' && conditionValue.includes(targetFieldValue)) ||
                            (conditionOperator === 'not in' && !conditionValue.includes(targetFieldValue))
                        ) {
                            passed++;
                        }
                    }
                });

                if(total !== passed) {
                    hidden = true;
                }
            }

            return hidden;

        };

        self.previews.init = function() {

            $('.xtfw-settings-preview').each(function() {
                self.previews.ids.push($(this).attr('id'));
            });

            if(self.previews.ids.length) {

                self.previews.generateStyles();
                self.previews.initStickyPreviews();

                $(document.body).on('change input', '.xtfw-has-output', function(e) {

                    var type = $(this).attr('type');

                    // throttle
                    var timeout = ['range'].includes(type) ? 10 : 0;

                    self.throttle(timeout, function() {
                        self.previews.generateStyles();
                    });
                });

                $(document.body).on('change', '[data-preview]', function(e) {

                    var preview = $(this).data('preview');

                    self.throttle(50, function() {
                        self.previews.refreshPreview(preview);
                    });
                });

                $(window).on('resize', function() {

                    self.throttle(10, function() {
                        self.previews.initStickyPreviews();
                    });
                });

                $(document.body).on('xtfw_settings_section_changed', function () {

                    self.throttle(10, function() {
                        self.previews.initStickyPreviews();
                    });
                });
            }
        };

        self.previews.generateStyles = function() {

            var stylesheet_id = 'xtfw_settings-inline-css';

            var fields = self.getFlattenFields().filter(function(field) {
                return field.output && !self.conditions.isFieldHidden(field);
            });

            var css_data = {},
                css = '',
                element,
                property,
                properties,
                value_pattern,
                value,
                values,
                is_group;

            fields.forEach(function(field) {

                is_group = field.type === 'group';

                field.output.forEach(function(item) {

                    element = item.element;
                    property = item.property;
                    value_pattern = item.value_pattern ? item.value_pattern : '';
                    value = self.getFieldValue(field);

                    if(is_group && typeof(value) === 'object') {

                        values = value;

                        if(value_pattern === '') {

                            value_pattern = '';

                            for (var i = 1 ; i < values.length ; i++) {
                                value_pattern += '$'+i;
                                if(i < (values.length - 1)) {
                                    value_pattern += ' ';
                                }
                                i++;
                            }
                        }

                        value = value_pattern;

                        values.forEach(function(val, key) {
                            value = value.replace('$'+(key+1), val);
                        });

                    }else if(value_pattern && typeof(value) !== 'object' && value_pattern !== '') {

                        value = value_pattern.replace('$', value);
                    }

                    if(!css_data.hasOwnProperty(element)) {
                        css_data[element] = {};
                    }

                    css_data[element][property] = value;

                });

            });

            Object.entries(css_data).forEach(function(data) {

                element = data[0];
                properties = data[1];

                css += element+'{';

                Object.entries(properties).forEach(function(item) {

                    property = item[0];
                    value = item[1];

                    if(value !== '') {
                        css += property+':'+value+';';
                    }
                });

                css += '}';
            });

            if ( $( '#'+stylesheet_id ).length ) {
                $( '#'+stylesheet_id ).remove();
            }

            $( 'head' ).append( '<style id="'+stylesheet_id+'">'+css+'</style>' );

            self.previews.initStickyPreviews();

        };

        self.previews.refreshPreview = function(preview_id) {

            var formData = new FormData(self.form.get(0));
            var $preview = $('#'+preview_id);
            var $spinner = $preview.find('.xtfw-spinner');

            formData.append('action', self.getAjaxAction('refresh_preview'));
            formData.append('preview', preview_id);

            $spinner.addClass('active');

            $.ajax({
                url: ajaxurl,
                enctype: 'multipart/form-data',
                type: 'post',
                data: formData,
                processData: false,  // Important!
                contentType: false,
                cache: false,
                timeout: 600000

            }).done(function(response) {

                if(response.success) {

                    $preview.html(response.preview);

                    $(document.body).trigger('xtfw_settings_preview_refreshed', [preview_id]);

                    self.previews.generateStyles();
                }

                $spinner.removeClass('active');
            });
        };

        self.previews.refreshAll = function() {

            self.previews.ids.forEach(function(preview_id) {
                self.previews.refreshPreview(preview_id);
            });
        }

        self.previews.destroyStickyPreviews = function() {

            self.previews.stickyPreviews.forEach(function(sidebar) {
                sidebar.destroy();
            });

            self.previews.stickyPreviews = [];
        };

        self.previews.initStickyPreviews = function() {

            self.previews.destroyStickyPreviews();

            if($(window).width() >= 600) {

                $('.xtfw-settings-preview-sidebar').each(function() {

                    self.previews.stickyPreviews.push(new StickySidebar($(this).get(0), {
                        containerSelector: '.xtfw-settings-preview-section',
                        topSpacing: 100,
                        bottomSpacing: 50
                    }));
                });
            }
        };

        self.events.init = function() {

            $(document.body).on('submit', '.xtfw-settings-form', function(evt) {

                evt.preventDefault();
                self.saveSettings();
            });

            $(document.body).on('click', '.xtfw-settings-reset', function(evt) {

                evt.preventDefault();

                var field_id = $(this).data('id');

                self.resetFieldValue(field_id);
            });

            self.actionConfirm.confirm($('.xtfw-reset-section-settings'), function(evt, button) {

                self.startButtonLoading(button);

                button.closest('.xtfw-settings-title ')
                .next('.xtfw-settings-section')
                .find('.xtfw-settings-reset').trigger('click');

                self.endButtonLoading(button);
            });

            self.actionConfirm.confirm($('#xtfw-reset-all-settings'), function(evt, button) {

                self.startButtonLoading(button);

                self.getFields().forEach(function(field) {

                    self.resetFieldValue(field);
                });

                self.saveSettings(false, function(){

                    self.previews.refreshAll();
                });

                self.endButtonLoading(button);
            });

        };

        self.init();

    });

})( jQuery );