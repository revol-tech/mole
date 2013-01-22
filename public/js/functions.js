
$(function () {
	//to get the url.
	var url = '';
	$('script').each(function(){
		if( $(this).attr('src')!= undefined){
			if($(this).attr('src').split('?')[1]!=undefined )
				url = $(this).attr('src').split('?')[1];
		}
	})

	//change language to nepali
	$('.nepal').click(function(e){
		e.preventDefault();
		$('.np').show();
		$('.en').hide();
		$(this).addClass('active');
		$('#main_title').text('श्रम तथा रोजगार मन्त्रालय');//change title to nepali
		$('.english').removeClass('active');
		$.get(url+"np");
	})

	//change language to english
	$('.english').click(function(e){
		e.preventDefault();
		$('.en').show();
		$('.np').hide();
		$(this).addClass('active');
		$('#main_title').text('Ministry of Labour and Employment');//change title to english
		$('.nepal').removeClass('active');
		$.get(url+"en");
	})

	//print only the selected div
	$( ".print" ).click(function(e) {
		e.preventDefault();
		$(this).closest('div').parent().closest('div').jqprint({
				debug: false,
				importCSS: true,
				printContainer: true,
				operaSupport: true
		});

	});

	//convert english numbers into nepali numbers
	function convert(num){
		var bstr = '';
		var list=['&#2406;','&#2407;','&#2408;','&#2409;','&#2410;','&#2411;','&#2412;','&#2413;','&#2414;','&#2415;'];
		for(i=0; i<num.length; i++){if(parseInt(num[i])) bstr += list[num[i]]; else bstr += num[i];}return bstr;
	}
	var tmp = convert($('#tel_en').text())
	$('#tel_np').html(tmp);

	var tmp = convert($('#fax_en').text())	
	$('#fax_np').html(tmp);


	$("ul.sf-menu").supersubs({minWidth:12, maxWidth:30, extraWidth:0}).superfish({hoverClass:'sfHover', pathClass:'sf-active', pathLevels:0, delay:500, animation:{height:'show'}, speed:'def', autoArrows:false, dropShadows:true});


//////////////////////////////////////////////////////////////////////////
// ACCORDION - Tutorial by Soh Tanaka - http://www.sohtanaka.com/web-design/easy-toggle-jquery-tutorial/
//////////////////////////////////////////////////////////////////////////

$('.acc_container').hide(); //Hide/close all containers

// if you want to show the first div uncomment the line below  <-- read this
//Add "active" class to first trigger, then show/open the immediate next container
//$('.acc_trigger:first').addClass('active').next().show();

$('.acc_trigger').click(function(e){
	if( $(this).next().is(':hidden') ) { //If immediate next container is closed...
		$('.acc_trigger').removeClass('active').next().slideUp(); //Remove all "active" state and slide up the immediate next container
		$(this).toggleClass('active').next().slideDown(); //Add "active" state to clicked trigger and slide down the immediate next container
	} else {
		$('.acc_trigger').removeClass('active').next().slideUp(); //Remove all "active" state and slide up the immediate next container
	}
	e.preventDefault(); //Prevent the browser jump to the link anchor
});


//////////////////////////////////////////////////////////////////////////
// SIMPLE TABS - Tutorial by Soh Tanaka - http://www.sohtanaka.com/web-design/simple-tabs-w-css-jquery/
//////////////////////////////////////////////////////////////////////////

	$("#simple-tabs .tab_content").hide(); //Hide all content
	$("#simple-tabs ul.tabs li:first").addClass("active").show(); //Activate first tab
	$("#simple-tabs .tab_content:first").show(); //Show first tab content

	//On Click Event
	$("#simple-tabs ul.tabs li").click(function(e) {
		$("#simple-tabs ul.tabs li").removeClass("active"); //Remove any "active" class
		$(this).addClass("active"); //Add "active" class to selected tab
		$("#simple-tabs .tab_content").hide(); //Hide all tab content
		var activeTab = $(this).find("a").attr("href"); //Find the rel attribute value to identify the active tab + content
		$(activeTab).fadeIn(); //Fade in the active content
		e.preventDefault();
	});

//////////////////////////////////////////////////////////////////////////
// TOGGLES - Tutorial by Soh Tanaka - http://www.sohtanaka.com/web-design/easy-toggle-jquery-tutorial/
//////////////////////////////////////////////////////////////////////////

	//Hide (Collapse) the toggle containers on load
	$(".toggle_container").hide();

	//Switch the "Open" and "Close" state per click then slide up/down (depending on open/close state)
	$(".tgg-trigger").click(function(){
		$(this).toggleClass("active").next().slideToggle("slow");
		return false; //Prevent the browser jump to the link anchor
	});

})// end of window load 

