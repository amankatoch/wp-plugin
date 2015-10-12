<script type="text/javascript">


//////////////// Put Custom text before the Product variations, replace Size Chart link with Test Size Chart


//////////////// Increase Color Swatch size

jQuery(".chooseSwatch a").each(function(){ 
	jQuery(this).children('img').each(function(){ 
	
	var origSrc = jQuery(this).attr('src');
	var newSrc = origSrc.replace('SL30','SL45');
	jQuery(this).attr('src',newSrc); 

	});

});


//////////////// Check custom number attributes to see what Size Chart should be used
jQuery(document).ready(function(){
var sizeChartNumber = "1";

jQuery('.product-ext-attr-widget  ul.attr-item li').each(function() {
    
   if (jQuery(this).find('em.attr-title').text().search('generic_number_2') >= 0) {
	  
	  return sizeChartNumber = jQuery(this).find('span.attr-value').text().trim();
  
  }
  
});


//////////////// Size Guide

jQuery("#SizeChartBlock").load("/info/Size_Chart #contentSizeChartPopup");
jQuery('.variationDropdown a.formHelp').attr('href', '#SizeChartBlock').fancybox();

setTimeout(function(){ 
jQuery("#SizeChartBlock").load("/info/Size_Chart #contentSizeChartPopup");
jQuery('.variationDropdown a.formHelp').attr('href', '#SizeChartBlock').fancybox();
 }, 9000);



});

jQuery('.variationDropdown a.formHelp').click(function(e){
  e.preventDefault();
jQuery('.tabs .tab-links a').click(function(e)  {
        var currentAttrValue = jQuery(this).attr('href');
 
   
        jQuery("#contentSizeChartPopup .tab-content .tab").removeClass('active')
        jQuery(currentAttrValue).addClass('active');

 


       jQuery("#contentSizeChartPopup .tab-links li").removeClass('active');
        jQuery(this).parent('li').addClass('active')
        
 
        e.preventDefault();
    });
});


 //////////////// Convert Quantity dropdown into text input second option
  
  jQuery('li#quantityBox').replaceWith('<li id="quantityBox" class="formField quantity showQuantity"><label for="buyboxQuantity">Quantity:</label><input id="buyboxQuantity" name="item.0.qty" value="1"/></li>');
	jQuery('li#quantityBox input').attr("onFocus","this.value='';");
	jQuery('li#quantityBox input').attr("onBlur","this.value=!this.value?'1':this.value;");
	jQuery('li#quantityBox input').keypress(validateNumber);

function validateNumber(event) {
    var key = window.event ? event.keyCode : event.which;

    if (event.keyCode == 8 || event.keyCode == 46
     || event.keyCode == 37 || event.keyCode == 39) {
        return true;
    }
    else if ( key < 48 || key > 57 ) {
        return false;
    }
    else return true;
};

/// Generate custom desgin text fields if custom text 3,4,5 present

if ((jQuery('dd.itemNo').text().trim()) != "454545457") {
generateCustomDesignText();	
}


</script>