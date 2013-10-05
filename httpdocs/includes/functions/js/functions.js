function addCommas(nStr)
{
	nStr += '';
	x = nStr.split('.');
	x1 = x[0];
	x2 = x.length > 1 ? '.' + x[1] : '';
	var rgx = /(\d+)(\d{3})/;
	while (rgx.test(x1)) {
		x1 = x1.replace(rgx, '$1' + ',' + '$2');
	}
	return x1 + x2;
}

function collapsePost(e) {
    e.click(function(event) { 
	
    	event.preventDefault();
	$(this).toggleClass('collapsed');
    	if($(this).hasClass('collapsed')) {
     		$(this).text('Expand'); }
    	else {$(this).text('Collapse');}
    var content = $(this).parent().parent().children('.content');
    e.toggleClass('postcollapsed'); post.toggle();
    });
  }


