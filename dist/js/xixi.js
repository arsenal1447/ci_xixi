$(function() {
	var oContainer = $('#picture');
	var iCells = 0;
	var iWidth = 220;
	var iSpace = 15;
	var iOuterWidth = iWidth + iSpace;
	var arrT   = [];
	var arrL   = [];
	var iPage  = 1;
	var iBtn   = true;
	var iColor = "";
	var pUrl   = GetImageURL + "/";
	var sUrl   = "";
	var maxH   = 0;

	function fRandomBy(under, over){
	    switch(arguments.length){
	        case 1: return parseInt(Math.random()*under+1);
	        case 2: return parseInt(Math.random()*(over-under+1) + under);
	        default: return 0;
	    }
	}
    
	function setCell() {
		var widthstr = $(".container").css("width");
		if (widthstr) {
			var width    = widthstr.substring(0, widthstr.length -2);
			iCells = Math.floor(width / iOuterWidth);
		} else {
			iCells = Math.floor($(window).innerWidth() / iOuterWidth);
		}
		if (iCells < 4) {
			iCells = 4;
		}
		oContainer.css('width', iCells * iOuterWidth - iSpace);
	}

	setCell();
	
	for (var i=0; i<iCells; i++) {
		arrT[i] = 0;
		arrL[i] = iOuterWidth * i;
	}

	function getData() {
		if (!iBtn) {
			return ;
		}
		iBtn = false;
		sUrl = pUrl + iPage;
		iPage++;
		$.getJSON(sUrl, function(jData) {
			if ($.isEmptyObject(jData)) {
				return;
			};
			$('#loader').show();
			$.each(jData, function(index, obj) {

				var viewUrl = Home + 'view/' + obj.viewid;

				var oDiv = $('<div>');
				var iHeight   = obj.height * (iWidth / obj.width);
				var _index = getMin();
				oDiv.css({
					left	:	arrL[_index],
					top		:	arrT[_index]
				});
				arrT[_index] += iHeight + 10;
				oDiv.css({
					width   : iWidth,
					height  : iHeight
				});
				oDiv.css("position","absolute");
				oContainer.append(oDiv);

				var viewAs = $('<a>');
				viewAs.attr('href', viewUrl);
				oDiv.append(viewAs);

				var oImg = $('<img />');
				oImg.css("width","100%");

				var objImg = new Image();
				objImg.onload = function() {
					oImg.attr('src', this.src);
				}
				objImg.src = obj.url;
				viewAs.append(oImg);


				var imageUrl = obj.url;

				var boxAs = $('<a>');

				boxAs.attr('type', "button");

				boxAs.addClass("btn btn-default btn-circle");

				boxAs.css("opacity",0);

				boxAs.css("margin-top",-iHeight);

				boxAs.css("margin-left",30);

				boxAs.attr('href', imageUrl);

				boxAs.attr('data-lightbox', "picture");

				boxAs.attr('data-title', obj.text);

				oDiv.append(boxAs);

				var boxIcon = $('<i>');

				boxIcon.addClass('icon-search');

				boxAs.append(boxIcon);



				var likeButton = $('<button>');

				likeButton.attr("id","likeButton"+obj.id);

				likeButton.addClass("btn btn-circle");

				if (obj.is_like) {
					likeButton.addClass("btn-info");
				} else{
					likeButton.addClass("btn-default");
				}

				likeButton.css("opacity",0);

				likeButton.css("margin-top",-iHeight);

				likeButton.css("margin-left",25);

				var likeStr = "Like('" + obj.id + "')";

				likeButton.attr("onClick",likeStr);

				oDiv.append(likeButton);

				var likeIcon = $('<i>');

				likeIcon.addClass('icon-thumbs-up');

				likeButton.append(likeIcon);



				var collectButton = $('<button>');

				collectButton.attr("id","collectButton"+obj.id);

				collectButton.addClass("btn btn-circle");

				if (obj.is_love) {
					collectButton.addClass("btn-info");
				} else{
					collectButton.addClass("btn-default");
				}

				collectButton.css("opacity",0);

				collectButton.css("margin-top",-iHeight);

				collectButton.css("margin-left",25);

				var collectStr = "Love('" + obj.id + "')";

				collectButton.attr("onClick",collectStr);

				oDiv.append(collectButton);

				var collectIcon = $('<i>');

				collectIcon.addClass('icon-heart-empty');

				collectButton.append(collectIcon);

				oDiv.bind('mouseenter', function() {
  					collectButton.css('opacity','0.9');
  					likeButton.css('opacity','0.9');
  					boxAs.css('opacity','0.9');
				});

				oDiv.bind('mouseleave', function() {
  					collectButton.css('opacity','0');
  					likeButton.css('opacity','0');
  					boxAs.css('opacity','0');
				});

				setTimeout(function() {
					$('#loader').hide();
				},1000)
				iBtn = true;
			})
		});
	}

	getData();

	function getMin() {
		var v = arrT[0];
		var _index = 0;
		
		for (var i=1; i<arrT.length; i++) {
			if (arrT[i] < v) {
				v = arrT[i];
				_index = i;
			}
		}
		return _index;
	}
	
	$(window).on('scroll', function() {
		if (maxH <= $(window).scrollTop()) {
			maxH = $(window).scrollTop();
		}

		var _index =getMin();
		var iH = $(window).scrollTop() + $(window).innerHeight();
		if (arrT[_index] + 50 < iH) {
			getData();
		}
	})
	
	$(window).on('resize', function() {
		var iLen = iCells;
		setCell();
		if (iLen == iCells) {
			return ;
		}
		arrT = [];
		arrL = [];
		for (var i=0; i<iCells; i++) {
			arrT[i] = 0;
			arrL[i] = iOuterWidth * i;
		}
		oContainer.find('div').each(function() {
			
			var _index = getMin();

			$(this).animate({
				left	:	arrL[_index],
				top		:	arrT[_index]
			}, 1000);
			arrT[_index] += $(this).height() + 12;
			
		});
	})
})
