jQuery(document).ready(function($) {
  /** */
  $body = $("body");
  $window = $(window);
  $wpAdminBar = $("#wpadminbar");

  InitStikyNavigationPosition();

  InitHomePageBanner();

  InitFloorPlansFilters();

  InitMenuToggler();

  InitPageScrollButtons();

  InitGalleryLoader();

  jQuery(document).bind('gform_post_render', function(){
    // code to trigger on AJAX form render
    InitContactPage();
    return false;
  });

  $(window).on('scroll', function () {
    InitStikyNavigationPosition();
  });

  $(window).on('resize', function() {
    InitHomePageBanner();
  });

  $(window).on('load', function() {
    InitHomePageBanner();
  });

  function InitStikyNavigationPosition() {
    if($window.scrollTop() > 70) {
      $('header.site-header').addClass('sticky');
      //$('.site-branding').css('display', 'block');
    }else {
      if(!isMobile) {
        //$('.site-branding').css('display', 'none');
      }else{
        //$('.site-branding').css('display', 'block !important');
      }

      $('header.site-header').removeClass('sticky');
      if(!$('#menu_btn').hasClass('active')){
        if(!isMobile) {
          //$('.site-branding').css('display', 'none');
        }
      }
    }
  }

  function InitHomePageBanner() {
    $('#parallax-header').css('height', '');

    if( $('#parallax-header').innerHeight() > $window.height() )
    {
      $('#parallax-header').height($('#parallax-header').innerHeight());
    }
    else
    {
      $('#parallax-header').height($window.height());
    }

    if( $('.home').length )
    {
      $('.first-point .general-section h3').css('cursor', 'pointer');
      $('.first-point .general-section h3').click(function(e) {
        window.location = $(this).parent().find('.btn').attr('href');
      });
    }
  }

  function InitFloorPlansFilters() {
    $('#razz-model-filter-wrapper .active-filter').addClass('selected');
  }

  function InitMenuToggler() {
    $('button.menu-toggle').on('click', function() {
      $('header.site-header').toggleClass('toggled');
      $('html, body').toggleClass('no-scroll');
    });
  }

  function InitPageScrollButtons() {
    $('#scroll-top').click( function() {
      $("html, body").animate({ scrollTop: 0 }, 1200);
      return false;
    });

    $('.scroll-down').click( function() {

      var scrollPositition = $('.first-point').position();
      var headerHeight = $('header.site-header .header-wrapper').height();
      $("html, body").animate({ scrollTop: scrollPositition.top - headerHeight }, 600);
      return false;
    });

    $('.scroll-down-to').click( function(event) {
      var scrollPositition = $('#home-contact').position();
      var headerHeight = $('header.site-header .header-wrapper').height();
      $("html, body").animate({ scrollTop: scrollPositition.top - headerHeight }, 600);
      return false;
    });
  }

  function InitContactPage() {

    var source = jQuery(".hide-select .gfield_select");
    var selected = source.find("option[selected]");  // get selected <option>
    var options = jQuery("option", source);  // get all <option> elements
    jQuery(".hide-select .ginput_container").append('<dl id="sample" class="dropdown"></dl>');
    jQuery("#sample").append('<dt><a href="#">' + selected.text() + '<span class="value">' + selected.val() + '</span></a><span class="fa fa-caret-down"></span></dt>');
    jQuery("#sample").append('<dd><ul></ul></dd>');



// iterate through all the <option> elements and create UL
    options.each(function(){
      $("#sample dd ul").append('<li><a href="#">' + $(this).text() + '<span class="value">' + $(this).val() + '</span></a></li>');
    });

    $(".dropdown img.flag").addClass("flagvisibility");

    $(".dropdown dt a").click(function() {
      $(".dropdown dd ul").toggle();
      return false;
    });

    $(".dropdown dd ul li a").click(function() {
      var text = $(this).html();
      $(".dropdown dt a").html(text);
      $(".dropdown dd ul").hide();
      var source = jQuery(".hide-select .gfield_select");
      source.val(jQuery(this).find("span.value").html());
      return false;
    });

    $(document).bind('click', function(e) {
      var $clicked = $(e.target);
      if (! $clicked.parents().hasClass("dropdown"))
        $(".dropdown dd ul").hide();
    });


    $("#flagSwitcher").click(function() {
      $(".dropdown img.flag").toggleClass("flagvisibility");
    });

    $('.hasDatepicker .ginput_container').append('<span class="fa fa-caret-down"></span>');
  }

  function InitGalleryLoader() {

    // $('.load-more-wrapper .btn').click(function(){
    //   var counter= 0;
    //   var max_display_posts = 8;
    //
    //   var masonryHasMore = false;
    //   $(".isotope-gallery .gallery-item:hidden").each(function(){
    //       if(counter < max_display_posts) {
    //         $(this).toggle(true);
    //         counter++;
    //       }
    //       else
    //         masonryHasMore = true;
    //   });
    //
    //   if ($(".isotope-gallery .gallery-item:hidden").size() == 0 || !masonryHasMore)
    //     $('.load-more-wrapper .btn').toggle(false);
    //   else
    //     $('.load-more-wrapper .btn').toggle(true);
    //
    //   $gridgallery = $('.isotope-gallery').isotope('layout');
    //
    //   return false;
    // });

  }

  /* Menu script */

  var isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test( (window.navigator.userAgent||window.navigator.vendor||window.opera) );
  if(isMobile){
    // $('.nav-wrapper').css('display', 'none');
    $('.site-branding').css('display', 'block !important');
  }

  $('#menu_btn, #menu_btn_text').click(function() {
    $('#menu_btn').toggleClass('active');
    $('#menu_btn_text').toggleClass('active');
    $('#overlay').toggleClass('open');

    if($(this).hasClass('active')){
      if(isMobile) {
        //$('.site-branding').css('display', 'none');
        // $('.nav-wrapper').css('display', 'block');
      }else{
        //$('.site-branding').css('display', 'block');
      }
    }else{
      if(isMobile) {
        //$('.site-branding').css('display', 'block');
        // $('.nav-wrapper').css('display', 'none');
      }else{
        //$('.site-branding').css('display', 'none');
      }
    }

  });

  var height_1 = $('.height1').height();
  var height_2 = $('.height3').height();
  if(!isMobile) {
    $('.height2').height(height_1);
    $('.height4').height(height_2);
  }

  $(window).resize(function(){
    if(isMobile){
      $('.height2').height(500);
      $('.height4').height(500);
    }
  });

  /* appending the arrow to the contact form button */
  if($('#gform_1').length && $('#gform_1').find('.gform_footer').length){
    $("<span class='arrow-left-submit'></span>").prependTo( $(".gform_footer") );

    $('.gform_button').hover(
        function () {
          if(!$('.arrow-left-submit').hasClass('extra-animation'))
            $('.arrow-left-submit').addClass('extra-animation');
        },function () {
          if($('.arrow-left-submit').hasClass('extra-animation'))
            $('.arrow-left-submit').removeClass('extra-animation');
        });
  }

  jQuery(document).bind('gform_post_render', function(){
    $("<span class='arrow-left-submit'></span>").prependTo( $(".gform_footer") );

    $('.gform_button').hover(
        function () {
          if(!$('.arrow-left-submit').hasClass('extra-animation'))
            $('.arrow-left-submit').addClass('extra-animation');
        },function () {
          if($('.arrow-left-submit').hasClass('extra-animation'))
            $('.arrow-left-submit').removeClass('extra-animation');
        });
  });

  /* Extra selects in contact form */
  var select_1 = $('#input_1_6');
  var interests = select_1.find('option');
  var extra_select_1 = "<ul class='interesting-in'>";
  $.each(interests, function(index, Item){
    extra_select_1 += "<li><a href='#' data-index='"+Item['innerText']+"'>"+Item['innerText']+"</a></li>";
  });
  extra_select_1 += "</ul>";

  select_1.parent().append(extra_select_1);

  setTimeout(a, 400);
  function a(){
    jQuery('.fbx-instance').on('foobox.beforeShow', function(e) {
      console.log();
      if(jQuery(".fbx-modal .fbx-inner .fbx-stage .fbx-item-current iframe").length){
        jQuery('.fbx-next').hide();
        jQuery('.fbx-prev').hide();
      }else{
        jQuery('.fbx-next').show();
        jQuery('.fbx-prev').show();
      }
    });
  }



});

