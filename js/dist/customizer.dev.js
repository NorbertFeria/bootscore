"use strict";

/* global wp, jQuery */

/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */
(function ($) {
  wp.customize('google_font_setting', function (value) {
    value.bind(function (newval) {
      $('body').css('font-family', newval + ', sans-serif');
      $('link#bootscore-google-fonts').attr('href', 'https://fonts.googleapis.com/css2?family=' + encodeURIComponent(newval) + ':wght@' + wp.customize('font_weight_setting').get() + '&display=swap');
    });
  });
  wp.customize('font_weight_setting', function (value) {
    value.bind(function (newval) {
      $('body').css('font-weight', newval);
    });
  });
  wp.customize('font_size_setting', function (value) {
    value.bind(function (newval) {
      $('body').css('font-size', newval);
    });
  });
})(jQuery);