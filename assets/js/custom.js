"use strict";

(function () {
  tinymce.PluginManager.add('highlightblock', function (editor, url) {
    var parts = url.split('assets');
    var themeURL = parts[0]; // Add Button to Visual Editor Toolbar

    editor.addButton('custom_class', {
      title: 'Highlight Text',
      cmd: 'custom_class',
      image: themeURL + 'images/highlight.png'
    }); // Add Command when Button Clicked

    editor.addCommand('custom_class', function () {
      var selected_text = editor.selection.getContent();

      if (selected_text.length === 0) {
        alert('Please select some text.');
        return;
      }

      var open_column = '<div class="highlightBox">';
      var close_column = '</div>';
      var return_text = '';
      return_text = open_column + selected_text + close_column;
      editor.execCommand('mceReplaceContent', false, return_text);
      return;
    });
  });
  tinymce.PluginManager.add('ctabutton', function (editor, url) {
    //console.log(url);
    var parts = url.split('assets');
    var themeURL = parts[0]; // Add Button to Visual Editor Toolbar

    editor.addButton('edbutton1', {
      title: 'Custom Button',
      cmd: 'edbutton1',
      image: themeURL + 'images/custom-button.png'
    }); // Add Command when Button Clicked

    editor.addCommand('edbutton1', function () {
      var selected_text = editor.selection.getContent();

      if (selected_text.length === 0) {
        alert('Please select some text.');
        return;
      }

      var open_column = '<span class="custom-button-element"><a data-mce-href="#" href="#"  data-mce-selected="inline-boundary" class="button-element button">';
      var close_column = '</a></span>';
      var return_text = '';
      return_text = open_column + selected_text + close_column;
      editor.execCommand('mceReplaceContent', false, return_text);
      return;
    });
  });
})();
"use strict";

/**
 *	Custom jQuery Scripts
 *	Developed by: Lisa DeBona
 *  Date Modified: 02.21.2025
 */
jQuery(document).ready(function ($) {
  //AOS.init();
  var mobileBreakPoint = 1024;
  $('.masonry').masonry({
    itemSelector: '.grid-item'
  }); // if( $('.main-navigation ul.sub-menu').length ) {
  //   $('.main-navigation ul.sub-menu').each(function(){
  //     var submenu = $(this);
  //     $('<button class="submenu-toggle" aria-label="Sub-Menu"><i class="fa-solid fa-chevron-down"></i></button>').insertBefore(submenu);
  //     submenu.wrap('<div class="submenu-wrapper" />');
  //   });
  // }

  $(document).on('click', '.mobileNavContent .submenu-toggle', function (e) {
    e.preventDefault();
    var current = $(this);
    $(this).toggleClass('active');
    $(this).next().slideToggle();
    $('.mobileNavContent .submenu-toggle').not(current).each(function () {
      if ($(this).hasClass('active')) {
        $(this).removeClass('active');
        $(this).next().slideUp();
      }
    });
  });
  $(window).on('load resize', function () {
    mobileNavigation();
  });

  function mobileNavigation() {
    if ($(window).width() <= mobileBreakPoint) {
      if ($('.MobileNavigation .main-navigation').length == 0) {
        $('.site-header .main-navigation').appendTo('.mobileNavContent');
        $('.site-header .secondaryNav').appendTo('.mobileNavContent');
      }

      if ($('.foot-contact-map .social-media-links').length == 0) {
        $('.foot-contact-info .social-media-links').appendTo('.foot-contact-map');
      }
    } else {
      if ($('.site-header .primary-navigation .main-navigation').length == 0) {
        $('.mobileNavContent .main-navigation').appendTo('.site-header .primary-navigation');
        $('.mobileNavContent .secondaryNav').appendTo('.site-header .header-top .header-right');
      }

      if ($('.foot-contact-info .social-media-links').length == 0) {
        $('.foot-contact-map .social-media-links').appendTo('.foot-contact-info');
      }
    }
  }

  if ($('.site-header .secondaryNav .searchBtn').length) {
    $('.site-header .secondaryNav .searchBtn').clone().insertBefore('.mobile-toggle');
  }

  $('.collapsible-title').on('click', function () {
    var mainParent = $(this).parents('.collapsible');
    var current = $(this);
    $(this).parent().toggleClass('open');
    $(this).parent().find('.collapsible-content').slideToggle();
    $(this).attr('aria-expanded', function (i, attr) {
      return attr === 'true' ? 'false' : 'true';
    }); //Close previously open

    mainParent.find('.collapsible-title').not(current).each(function () {
      $(this).attr('aria-expanded', 'false');
      $(this).parent().find('.collapsible-content').slideUp();
    });
  });

  if ($('.slideshow').length) {
    $('.slideshow').each(function () {
      if (typeof $(this).attr('id') != 'undefined' && $(this).attr('id') != null) {
        var slideId = '#' + $(this).attr('id');
        do_slideshow(slideId);
      }
    });
  } // $(document).on('click', '.searchBtn', function(e){
  //   e.preventDefault();
  //   var expanded = $(this).attr('aria-expanded') === 'true';
  //   $(this).attr('aria-expanded', !expanded);
  //   $('.header-search-form').slideToggle();
  //   $('.header-search-form input[name="s"]').val("");
  //   setTimeout(function(){
  //     $('.header-search-form input[name="s"]').focus();
  //   },50);
  // });
  // $(document).on('click', '.mobile-toggle', function(e){
  //   e.preventDefault();
  //   var expanded = $(this).attr('aria-expanded') === 'true';
  //   $(this).attr('aria-expanded', !expanded);
  //   $('.MobileNavigation').toggleClass('open');
  //   $('body').toggleClass('mobile-navigation-active');
  // });
  // $(document).on('click', '.mobileNavClose, .MobileNavigationOverlay', function(e){
  //   e.preventDefault();
  //   $('.mobile-toggle').attr('aria-expanded','false');
  //   $('.MobileNavigation').addClass('closed');
  //   $('body').removeClass('mobile-navigation-active');
  //   setTimeout(function(){
  //     $('.MobileNavigation').removeClass('open closed');
  //   },500);
  // });


  $(document).on('click', '.mobile-menu-bar', function (e) {
    e.preventDefault();
    var expanded = $(this).attr('aria-expanded') === 'true';
    $(this).attr('aria-expanded', !expanded);
    $('#mobile-navigation').toggleClass('open');
    $('body').toggleClass('mobile-navigation-active');
  });
  $(document).on('click', '.mobile-menu-close', function (e) {
    e.preventDefault();
    $('.mobile-menu-bar').attr('aria-expanded', 'false');
    $('#mobile-navigation').addClass('closed');
    $('body').removeClass('mobile-navigation-active');
    setTimeout(function () {
      $('#mobile-navigation').removeClass('open closed');
    }, 600);
  });

  if ($('.repeatable--two_column_text .details').length) {
    $('.repeatable--two_column_text').each(function () {
      if ($(this).find('.details').length) {
        $(this).find('.details').each(function () {
          $(this).find('*').eq(0).addClass('first-element');
        });
      }
    });
  }
  /* Slideshow */


  function do_slideshow(selector) {
    var swiper = new Swiper(selector, {
      effect: 'fade',

      /* "slide", "fade", "cube", "coverflow" or "flip" */
      loop: true,
      noSwiping: true,
      simulateTouch: true,
      speed: 800,
      autoplay: {
        delay: 6000
      },
      pagination: {
        el: '.swiper-pagination',
        clickable: true
      },
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev"
      },
      on: {
        init: function init() {//console.log("swiper initialized");
        }
      }
    });
  }

  $('[data-fancybox]').fancybox({
    touch: true,
    hash: false,
    youtube: {
      controls: 0,
      showinfo: 0,
      rel: 0
    },
    vimeo: {
      color: 'ffffff'
    }
  });
  $('.zoom-image').fancybox({
    buttons: ['fullScreen', 'close'],
    hash: false
  });

  if ($('.repeatable--cards_pattern_background .infoCard').length) {
    $('.repeatable--cards_pattern_background .infoCard').each(function () {
      if ($(this).find('a.button-element').length) {
        $(this).find('a.button-element').each(function () {
          var link = $(this).attr('href');

          if (link.includes('youtu') || link.includes('youtube') || link.includes('vimeo')) {
            $(this).attr('data-fancybox', true);
          }
        });
      }
    });
  }

  if ($('.repeatable').length) {
    $('.repeatable').each(function () {
      if ($(this).prev().hasClass('repeatable')) {
        if ($(this).prev().attr('data-group') != undefined) {
          var groupName = $(this).prev().attr('data-group');
          $(this).addClass('prev-' + groupName);
        }
      }

      if ($(this).next().hasClass('repeatable')) {
        if ($(this).next().attr('data-group') != undefined) {
          var groupName = $(this).next().attr('data-group');
          $(this).addClass('next-' + groupName);
        }
      }
    });
  }
});