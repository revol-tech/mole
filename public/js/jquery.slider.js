/**
 * slider plugin
 * 
 * options: 
 * 
 *	slide = 250;	//sliding time
 *	pause = 3000;	//pausing time
 *	type = 'ver'	//hor vs. ver
 *
 * 
 * <div>
 * 	<ul>
 * 		<li>
 * 			<span class="en">
 * 				lkjasdflkasjflkasjdflkdsflkasfnlk
 * 				<a href="#">more</a>
 * 			</span>
 * 			<span class="np">
 * 				lkjasdflkasjflkasjdflkdsflkasfnlk
 * 				<a href="#">more</a>
 * 			</span>
 * 		</li>
 * 	</ul>
 * </div>
 */
;(function($){
	$.fn.slider = function(options){
		
		return this.each(function(){
			
			function getObjID(){
				var tmpID;
				if($obj.attr('id')==undefined){
					do{
						tmpID=rand();
					}while($('#'+tmpID).length);
					$obj.attr('id',tmpID);
				};
				return $obj.attr('id');
			};

			function addCss(){
				var cssTxt = ''+
							'<style type="text/css">'+
							'#'+objID+'{'+
							'	height:'+$ul.height()+'px;'+
							'	overflow:hidden;'+
							'	position:relative;';
				if(options.type=='hor')
					cssTxt +='	width:'+($ul.width())+'px;';
					cssTxt +='}'+
							
							
							'#'+objID+' > ul{'+
							'	list-style:none outside;'+
							'	position:relative;';
				if(options.type=='hor')
					cssTxt +='	width:'+($ul.width()*(2.5))+'px;';

					cssTxt +='	margin:0;'+
							'}'+
							
							'#'+objID+' > ul > li{';
				if(options.type=='hor')
					cssTxt +='	float:left;'+
							'	width:'+($ul.width())+'px;'+
							'	padding:5px;';
				else if(options.type=="ver")
					cssTxt +='	padding:0 5px 10px 20px;'+
							'	height:150px;';
							
					cssTxt +='}'+
							
							'</style>';
console.log($obj)	
console.log(cssTxt)				
				$obj.before(cssTxt);
			};

			function rand(l){
				if(l==undefined) l = 5;
				var text = "";
				var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
				for( var i=0; i < l; i++ )
					text+=possible.charAt(Math.floor(Math.random()*possible.length));
				return text;
			};

			function scroll(){
				$ul = $obj.children('ul');
				$li = $ul.children('li');

				if(options.type=='ver'){
					$ul.animate({
						top: '-='+step,
					},options.slide,function(){
						$li	.first().appendTo($ul);
						$ul.css({top:0})
					})
				}else if(options.type='hor'){
					$ul.animate({
						left: '-='+step,
					},options.slide,function(){
						$li	.first().appendTo($ul);
						$ul.css({left:0})
					})
				}
			}


			var defaults ={
							slide	:250,
							pause   :3000,
							type 	:'ver' // hor
						},
				$obj = $(this),				
				objID = getObjID(),
				
				$ul = $obj.children('ul'),
				$li = $ul.children('li'),
				repeat,
				step;
				
				options = $.extend(defaults,options);

			if(options.type=='ver')
				step = $li.height();
			else
				step = $li.width();
				
			addCss();
			
			$obj.hover(
				function(){
					clearInterval(repeat);
				},function(){
					repeat = setInterval(scroll,options.pause);
				}
			);
			repeat = setInterval(scroll,options.pause);
			
		})
	}
})(jQuery);
