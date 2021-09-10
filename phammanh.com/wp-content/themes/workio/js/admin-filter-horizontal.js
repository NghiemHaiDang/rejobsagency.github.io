jQuery(document).ready(function($) {
    "use strict";
    function filter_job_horizontal(){
        $('body .widget .filter-job-horizontal').each(function(){
            var self = $(this);

            var el = self.find('.workio-filter-job-fields'),
                el_adv = self.find('.workio-filter-job-adv-fields'),
                el_sort = self.find('.wp-job-board-filter-sort-field'),
                el_sort_adv = self.find('.wp-job-board-filter-sort-adv-field');

            el.sortable({
                update: function(event, ui) {
                    var data = el.sortable('toArray', {
                        attribute: 'data-field-id'
                    });
                    el_sort.attr('value', data).trigger('change');
                }
            });

            $('body').on('change', '.filter-job-horizontal .workio-filter-job-fields input[type=checkbox]', function() {
                if ($(this).is(':checked')) {
                    $(this).closest('li').addClass('invisible');
                } else {
                    $(this).closest('li').removeClass('invisible');
                }
            });

            // advance
            el_adv.sortable({
                update: function(event, ui) {
                    var data = el_adv.sortable('toArray', {
                        attribute: 'data-field-id'
                    });
                    el_sort_adv.attr('value', data).trigger('change');
                }
            });

            $('body').on('change', '.filter-job-horizontal .workio-filter-job-adv-fields input[type=checkbox]', function() {
                if ($(this).is(':checked')) {
                    $(this).closest('li').addClass('invisible');
                } else {
                    $(this).closest('li').removeClass('invisible');
                }
            });

            $('body').on('change', '.show_adv_fields', function() {
                var container = $(this).closest('.filter-job-horizontal');
                if ( $(this).is(':checked') ) {
                    container.find('.workio-filter-job-adv-fields-wrapper').show();
                } else {
                    container.find('.workio-filter-job-adv-fields-wrapper').hide();
                }
            });
            if ( self.find('.show_adv_fields').is(':checked') ) {
                self.find('.workio-filter-job-adv-fields-wrapper').show();
            } else {
                self.find('.workio-filter-job-adv-fields-wrapper').hide();
            }
        });
    }
    filter_job_horizontal();
    $(document).on( 'widget-synced widget-updated',  function() {
        filter_job_horizontal();
    });



    function filter_employer_horizontal(){
        $('body .widget .filter-employer-horizontal').each(function(){
            var self = $(this);

            var el = self.find('.workio-filter-employer-fields'),
                el_adv = self.find('.workio-filter-employer-adv-fields'),
                el_sort = self.find('.wp-job-board-filter-sort-field'),
                el_sort_adv = self.find('.wp-job-board-filter-sort-adv-field');

            el.sortable({
                update: function(event, ui) {
                    var data = el.sortable('toArray', {
                        attribute: 'data-field-id'
                    });
                    el_sort.attr('value', data).trigger('change');
                }
            });

            $('body').on('change', '.filter-employer-horizontal .workio-filter-employer-fields input[type=checkbox]', function() {
                if ($(this).is(':checked')) {
                    $(this).closest('li').addClass('invisible');
                } else {
                    $(this).closest('li').removeClass('invisible');
                }
            });

            // advance
            el_adv.sortable({
                update: function(event, ui) {
                    var data = el_adv.sortable('toArray', {
                        attribute: 'data-field-id'
                    });
                    el_sort_adv.attr('value', data).trigger('change');
                }
            });

            $('body').on('change', '.filter-employer-horizontal .workio-filter-employer-adv-fields input[type=checkbox]', function() {
                if ($(this).is(':checked')) {
                    $(this).closest('li').addClass('invisible');
                } else {
                    $(this).closest('li').removeClass('invisible');
                }
            });

            $('body').on('change', '.show_adv_fields', function() {
                var container = $(this).closest('.filter-employer-horizontal');
                if ( $(this).is(':checked') ) {
                    container.find('.workio-filter-employer-adv-fields-wrapper').show();
                } else {
                    container.find('.workio-filter-employer-adv-fields-wrapper').hide();
                }
            });
            if ( self.find('.show_adv_fields').is(':checked') ) {
                self.find('.workio-filter-employer-adv-fields-wrapper').show();
            } else {
                self.find('.workio-filter-employer-adv-fields-wrapper').hide();
            }
        });
    }
    filter_employer_horizontal();
    $(document).on( 'widget-synced widget-updated',  function() {
        filter_employer_horizontal();
    });
});