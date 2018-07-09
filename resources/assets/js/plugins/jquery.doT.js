// jQuery plugin
jQuery.tmpl= $.tmpl  = function(tmplId, data) {
    var tmpl = doT.template($(tmplId).html());
    var html= "";
  		html += tmpl(data);
  	return html;

};
