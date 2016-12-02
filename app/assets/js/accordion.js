jQuery(document).ready(function() {
  function close_accordion_section() {
    jQuery('.accordion .accordion-section-title').removeClass('active');
    jQuery('.accordion .accordion-section-content').slideUp(300).removeClass('open');
  }
  function close_accordion_section2(coba) {
    $(coba).removeClass('active');
    $(coba).find('accordion-section-content').slideUp(300).removeClass('open');
    console.log(coba);
  }
  jQuery('.accordion-section-title').click(function(e) {
    // Grab current anchor value
    var currentAttrValue = jQuery(this).attr('href');

    if(jQuery(e.target).is('.active')) {
      // close_accordion_section();

      $(this).removeClass('active')
      $(this).parent().find('.accordion-section-content').slideUp(300).removeClass('open');
     
     
    }else {
      // close_accordion_section();

      // Add active class to section title
      jQuery(this).addClass('active');
      // Open up the hidden content panel
      jQuery('.accordion ' + currentAttrValue).slideDown(300).addClass('open'); 
    }

    e.preventDefault();
  });
});