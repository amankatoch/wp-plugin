/* Masked Input plugin for jQuery Copyright (c) 2007-2013 Josh Bush (digitalbush.com) Licensed under the MIT license (http://digitalbush.com/projects/masked-input-plugin/#license) Version: 1.3.1 */
(function(e){function t(){var e=document.createElement("input"),t="onpaste";return e.setAttribute(t,""),"function"==typeof e[t]?"paste":"input"}var n,a=t()+".mask",r=navigator.userAgent,i=/iphone/i.test(r),o=/android/i.test(r);e.mask={definitions:{9:"[0-9]",a:"[A-Za-z]","*":"[A-Za-z0-9]"},dataName:"rawMaskFn",placeholder:"_"},e.fn.extend({caret:function(e,t){var n;if(0!==this.length&&!this.is(":hidden"))return"number"==typeof e?(t="number"==typeof t?t:e,this.each(function(){this.setSelectionRange?this.setSelectionRange(e,t):this.createTextRange&&(n=this.createTextRange(),n.collapse(!0),n.moveEnd("character",t),n.moveStart("character",e),n.select())})):(this[0].setSelectionRange?(e=this[0].selectionStart,t=this[0].selectionEnd):document.selection&&document.selection.createRange&&(n=document.selection.createRange(),e=0-n.duplicate().moveStart("character",-1e5),t=e+n.text.length),{begin:e,end:t})},unmask:function(){return this.trigger("unmask")},mask:function(t,r){var c,l,s,u,f,h;return!t&&this.length>0?(c=e(this[0]),c.data(e.mask.dataName)()):(r=e.extend({placeholder:e.mask.placeholder,completed:null},r),l=e.mask.definitions,s=[],u=h=t.length,f=null,e.each(t.split(""),function(e,t){"?"==t?(h--,u=e):l[t]?(s.push(RegExp(l[t])),null===f&&(f=s.length-1)):s.push(null)}),this.trigger("unmask").each(function(){function c(e){for(;h>++e&&!s[e];);return e}function d(e){for(;--e>=0&&!s[e];);return e}function m(e,t){var n,a;if(!(0>e)){for(n=e,a=c(t);h>n;n++)if(s[n]){if(!(h>a&&s[n].test(R[a])))break;R[n]=R[a],R[a]=r.placeholder,a=c(a)}b(),x.caret(Math.max(f,e))}}function p(e){var t,n,a,i;for(t=e,n=r.placeholder;h>t;t++)if(s[t]){if(a=c(t),i=R[t],R[t]=n,!(h>a&&s[a].test(i)))break;n=i}}function g(e){var t,n,a,r=e.which;8===r||46===r||i&&127===r?(t=x.caret(),n=t.begin,a=t.end,0===a-n&&(n=46!==r?d(n):a=c(n-1),a=46===r?c(a):a),k(n,a),m(n,a-1),e.preventDefault()):27==r&&(x.val(S),x.caret(0,y()),e.preventDefault())}function v(t){var n,a,i,l=t.which,u=x.caret();t.ctrlKey||t.altKey||t.metaKey||32>l||l&&(0!==u.end-u.begin&&(k(u.begin,u.end),m(u.begin,u.end-1)),n=c(u.begin-1),h>n&&(a=String.fromCharCode(l),s[n].test(a)&&(p(n),R[n]=a,b(),i=c(n),o?setTimeout(e.proxy(e.fn.caret,x,i),0):x.caret(i),r.completed&&i>=h&&r.completed.call(x))),t.preventDefault())}function k(e,t){var n;for(n=e;t>n&&h>n;n++)s[n]&&(R[n]=r.placeholder)}function b(){x.val(R.join(""))}function y(e){var t,n,a=x.val(),i=-1;for(t=0,pos=0;h>t;t++)if(s[t]){for(R[t]=r.placeholder;pos++<a.length;)if(n=a.charAt(pos-1),s[t].test(n)){R[t]=n,i=t;break}if(pos>a.length)break}else R[t]===a.charAt(pos)&&t!==u&&(pos++,i=t);return e?b():u>i+1?(x.val(""),k(0,h)):(b(),x.val(x.val().substring(0,i+1))),u?t:f}var x=e(this),R=e.map(t.split(""),function(e){return"?"!=e?l[e]?r.placeholder:e:void 0}),S=x.val();x.data(e.mask.dataName,function(){return e.map(R,function(e,t){return s[t]&&e!=r.placeholder?e:null}).join("")}),x.attr("readonly")||x.one("unmask",function(){x.unbind(".mask").removeData(e.mask.dataName)}).bind("focus.mask",function(){clearTimeout(n);var e;S=x.val(),e=y(),n=setTimeout(function(){b(),e==t.length?x.caret(0,e):x.caret(e)},10)}).bind("blur.mask",function(){y(),x.val()!=S&&x.change()}).bind("keydown.mask",g).bind("keypress.mask",v).bind(a,function(){setTimeout(function(){var e=y(!0);x.caret(e),r.completed&&e==x.val().length&&r.completed.call(x)},0)}),y()}))}})})(jQuery);

/* Chosen v1.0.0 | (c) 2011-2013 by Harvest | MIT License, https://github.com/harvesthq/chosen/blob/master/LICENSE.md */
!function(){var a,AbstractChosen,Chosen,SelectParser,b,c={}.hasOwnProperty,d=function(a,b){function d(){this.constructor=a}for(var e in b)c.call(b,e)&&(a[e]=b[e]);return d.prototype=b.prototype,a.prototype=new d,a.__super__=b.prototype,a};SelectParser=function(){function SelectParser(){this.options_index=0,this.parsed=[]}return SelectParser.prototype.add_node=function(a){return"OPTGROUP"===a.nodeName.toUpperCase()?this.add_group(a):this.add_option(a)},SelectParser.prototype.add_group=function(a){var b,c,d,e,f,g;for(b=this.parsed.length,this.parsed.push({array_index:b,group:!0,label:this.escapeExpression(a.label),children:0,disabled:a.disabled}),f=a.childNodes,g=[],d=0,e=f.length;e>d;d++)c=f[d],g.push(this.add_option(c,b,a.disabled));return g},SelectParser.prototype.add_option=function(a,b,c){return"OPTION"===a.nodeName.toUpperCase()?(""!==a.text?(null!=b&&(this.parsed[b].children+=1),this.parsed.push({array_index:this.parsed.length,options_index:this.options_index,value:a.value,text:a.text,html:a.innerHTML,selected:a.selected,disabled:c===!0?c:a.disabled,group_array_index:b,classes:a.className,style:a.style.cssText})):this.parsed.push({array_index:this.parsed.length,options_index:this.options_index,empty:!0}),this.options_index+=1):void 0},SelectParser.prototype.escapeExpression=function(a){var b,c;return null==a||a===!1?"":/[\&\<\>\"\'\`]/.test(a)?(b={"<":"&lt;",">":"&gt;",'"':"&quot;","'":"&#x27;","`":"&#x60;"},c=/&(?!\w+;)|[\<\>\"\'\`]/g,a.replace(c,function(a){return b[a]||"&amp;"})):a},SelectParser}(),SelectParser.select_to_array=function(a){var b,c,d,e,f;for(c=new SelectParser,f=a.childNodes,d=0,e=f.length;e>d;d++)b=f[d],c.add_node(b);return c.parsed},AbstractChosen=function(){function AbstractChosen(a,b){this.form_field=a,this.options=null!=b?b:{},AbstractChosen.browser_is_supported()&&(this.is_multiple=this.form_field.multiple,this.set_default_text(),this.set_default_values(),this.setup(),this.set_up_html(),this.register_observers())}return AbstractChosen.prototype.set_default_values=function(){var a=this;return this.click_test_action=function(b){return a.test_active_click(b)},this.activate_action=function(b){return a.activate_field(b)},this.active_field=!1,this.mouse_on_container=!1,this.results_showing=!1,this.result_highlighted=null,this.result_single_selected=null,this.allow_single_deselect=null!=this.options.allow_single_deselect&&null!=this.form_field.options[0]&&""===this.form_field.options[0].text?this.options.allow_single_deselect:!1,this.disable_search_threshold=this.options.disable_search_threshold||0,this.disable_search=this.options.disable_search||!1,this.enable_split_word_search=null!=this.options.enable_split_word_search?this.options.enable_split_word_search:!0,this.group_search=null!=this.options.group_search?this.options.group_search:!0,this.search_contains=this.options.search_contains||!1,this.single_backstroke_delete=null!=this.options.single_backstroke_delete?this.options.single_backstroke_delete:!0,this.max_selected_options=this.options.max_selected_options||1/0,this.inherit_select_classes=this.options.inherit_select_classes||!1,this.display_selected_options=null!=this.options.display_selected_options?this.options.display_selected_options:!0,this.display_disabled_options=null!=this.options.display_disabled_options?this.options.display_disabled_options:!0},AbstractChosen.prototype.set_default_text=function(){return this.default_text=this.form_field.getAttribute("data-placeholder")?this.form_field.getAttribute("data-placeholder"):this.is_multiple?this.options.placeholder_text_multiple||this.options.placeholder_text||AbstractChosen.default_multiple_text:this.options.placeholder_text_single||this.options.placeholder_text||AbstractChosen.default_single_text,this.results_none_found=this.form_field.getAttribute("data-no_results_text")||this.options.no_results_text||AbstractChosen.default_no_result_text},AbstractChosen.prototype.mouse_enter=function(){return this.mouse_on_container=!0},AbstractChosen.prototype.mouse_leave=function(){return this.mouse_on_container=!1},AbstractChosen.prototype.input_focus=function(){var a=this;if(this.is_multiple){if(!this.active_field)return setTimeout(function(){return a.container_mousedown()},50)}else if(!this.active_field)return this.activate_field()},AbstractChosen.prototype.input_blur=function(){var a=this;return this.mouse_on_container?void 0:(this.active_field=!1,setTimeout(function(){return a.blur_test()},100))},AbstractChosen.prototype.results_option_build=function(a){var b,c,d,e,f;for(b="",f=this.results_data,d=0,e=f.length;e>d;d++)c=f[d],b+=c.group?this.result_add_group(c):this.result_add_option(c),(null!=a?a.first:void 0)&&(c.selected&&this.is_multiple?this.choice_build(c):c.selected&&!this.is_multiple&&this.single_set_selected_text(c.text));return b},AbstractChosen.prototype.result_add_option=function(a){var b,c;return a.search_match?this.include_option_in_results(a)?(b=[],a.disabled||a.selected&&this.is_multiple||b.push("active-result"),!a.disabled||a.selected&&this.is_multiple||b.push("disabled-result"),a.selected&&b.push("result-selected"),null!=a.group_array_index&&b.push("group-option"),""!==a.classes&&b.push(a.classes),c=""!==a.style.cssText?' style="'+a.style+'"':"",'<li class="'+b.join(" ")+'"'+c+' data-option-array-index="'+a.array_index+'">'+a.search_text+"</li>"):"":""},AbstractChosen.prototype.result_add_group=function(a){return a.search_match||a.group_match?a.active_options>0?'<li class="group-result">'+a.search_text+"</li>":"":""},AbstractChosen.prototype.results_update_field=function(){return this.set_default_text(),this.is_multiple||this.results_reset_cleanup(),this.result_clear_highlight(),this.result_single_selected=null,this.results_build(),this.results_showing?this.winnow_results():void 0},AbstractChosen.prototype.results_toggle=function(){return this.results_showing?this.results_hide():this.results_show()},AbstractChosen.prototype.results_search=function(){return this.results_showing?this.winnow_results():this.results_show()},AbstractChosen.prototype.winnow_results=function(){var a,b,c,d,e,f,g,h,i,j,k,l,m;for(this.no_results_clear(),e=0,g=this.get_search_text(),a=g.replace(/[-[\]{}()*+?.,\\^$|#\s]/g,"\\$&"),d=this.search_contains?"":"^",c=new RegExp(d+a,"i"),j=new RegExp(a,"i"),m=this.results_data,k=0,l=m.length;l>k;k++)b=m[k],b.search_match=!1,f=null,this.include_option_in_results(b)&&(b.group&&(b.group_match=!1,b.active_options=0),null!=b.group_array_index&&this.results_data[b.group_array_index]&&(f=this.results_data[b.group_array_index],0===f.active_options&&f.search_match&&(e+=1),f.active_options+=1),(!b.group||this.group_search)&&(b.search_text=b.group?b.label:b.html,b.search_match=this.search_string_match(b.search_text,c),b.search_match&&!b.group&&(e+=1),b.search_match?(g.length&&(h=b.search_text.search(j),i=b.search_text.substr(0,h+g.length)+"</em>"+b.search_text.substr(h+g.length),b.search_text=i.substr(0,h)+"<em>"+i.substr(h)),null!=f&&(f.group_match=!0)):null!=b.group_array_index&&this.results_data[b.group_array_index].search_match&&(b.search_match=!0)));return this.result_clear_highlight(),1>e&&g.length?(this.update_results_content(""),this.no_results(g)):(this.update_results_content(this.results_option_build()),this.winnow_results_set_highlight())},AbstractChosen.prototype.search_string_match=function(a,b){var c,d,e,f;if(b.test(a))return!0;if(this.enable_split_word_search&&(a.indexOf(" ")>=0||0===a.indexOf("["))&&(d=a.replace(/\[|\]/g,"").split(" "),d.length))for(e=0,f=d.length;f>e;e++)if(c=d[e],b.test(c))return!0},AbstractChosen.prototype.choices_count=function(){var a,b,c,d;if(null!=this.selected_option_count)return this.selected_option_count;for(this.selected_option_count=0,d=this.form_field.options,b=0,c=d.length;c>b;b++)a=d[b],a.selected&&(this.selected_option_count+=1);return this.selected_option_count},AbstractChosen.prototype.choices_click=function(a){return a.preventDefault(),this.results_showing||this.is_disabled?void 0:this.results_show()},AbstractChosen.prototype.keyup_checker=function(a){var b,c;switch(b=null!=(c=a.which)?c:a.keyCode,this.search_field_scale(),b){case 8:if(this.is_multiple&&this.backstroke_length<1&&this.choices_count()>0)return this.keydown_backstroke();if(!this.pending_backstroke)return this.result_clear_highlight(),this.results_search();break;case 13:if(a.preventDefault(),this.results_showing)return this.result_select(a);break;case 27:return this.results_showing&&this.results_hide(),!0;case 9:case 38:case 40:case 16:case 91:case 17:break;default:return this.results_search()}},AbstractChosen.prototype.container_width=function(){return null!=this.options.width?this.options.width:""+this.form_field.offsetWidth+"px"},AbstractChosen.prototype.include_option_in_results=function(a){return this.is_multiple&&!this.display_selected_options&&a.selected?!1:!this.display_disabled_options&&a.disabled?!1:a.empty?!1:!0},AbstractChosen.browser_is_supported=function(){return"Microsoft Internet Explorer"===window.navigator.appName?document.documentMode>=8:/iP(od|hone)/i.test(window.navigator.userAgent)?!1:/Android/i.test(window.navigator.userAgent)&&/Mobile/i.test(window.navigator.userAgent)?!1:!0},AbstractChosen.default_multiple_text="Select Some Options",AbstractChosen.default_single_text="Select an Option",AbstractChosen.default_no_result_text="No results match",AbstractChosen}(),a=jQuery,a.fn.extend({chosen:function(b){return AbstractChosen.browser_is_supported()?this.each(function(){var c,d;c=a(this),d=c.data("chosen"),"destroy"===b&&d?d.destroy():d||c.data("chosen",new Chosen(this,b))}):this}}),Chosen=function(c){function Chosen(){return b=Chosen.__super__.constructor.apply(this,arguments)}return d(Chosen,c),Chosen.prototype.setup=function(){return this.form_field_jq=a(this.form_field),this.current_selectedIndex=this.form_field.selectedIndex,this.is_rtl=this.form_field_jq.hasClass("chosen-rtl")},Chosen.prototype.set_up_html=function(){var b,c;return b=["chosen-container"],b.push("chosen-container-"+(this.is_multiple?"multi":"single")),this.inherit_select_classes&&this.form_field.className&&b.push(this.form_field.className),this.is_rtl&&b.push("chosen-rtl"),c={"class":b.join(" "),style:"width: "+this.container_width()+";",title:this.form_field.title},this.form_field.id.length&&(c.id=this.form_field.id.replace(/[^\w]/g,"_")+"_chosen"),this.container=a("<div />",c),this.is_multiple?this.container.html('<ul class="chosen-choices"><li class="search-field"><input type="text" value="'+this.default_text+'" class="default" autocomplete="off" style="width:25px;" /></li></ul><div class="chosen-drop"><ul class="chosen-results"></ul></div>'):this.container.html('<a class="chosen-single chosen-default" tabindex="-1"><span>'+this.default_text+'</span><div><b></b></div></a><div class="chosen-drop"><div class="chosen-search"><input type="text" autocomplete="off" /></div><ul class="chosen-results"></ul></div>'),this.form_field_jq.hide().after(this.container),this.dropdown=this.container.find("div.chosen-drop").first(),this.search_field=this.container.find("input").first(),this.search_results=this.container.find("ul.chosen-results").first(),this.search_field_scale(),this.search_no_results=this.container.find("li.no-results").first(),this.is_multiple?(this.search_choices=this.container.find("ul.chosen-choices").first(),this.search_container=this.container.find("li.search-field").first()):(this.search_container=this.container.find("div.chosen-search").first(),this.selected_item=this.container.find(".chosen-single").first()),this.results_build(),this.set_tab_index(),this.set_label_behavior(),this.form_field_jq.trigger("chosen:ready",{chosen:this})},Chosen.prototype.register_observers=function(){var a=this;return this.container.bind("mousedown.chosen",function(b){a.container_mousedown(b)}),this.container.bind("mouseup.chosen",function(b){a.container_mouseup(b)}),this.container.bind("mouseenter.chosen",function(b){a.mouse_enter(b)}),this.container.bind("mouseleave.chosen",function(b){a.mouse_leave(b)}),this.search_results.bind("mouseup.chosen",function(b){a.search_results_mouseup(b)}),this.search_results.bind("mouseover.chosen",function(b){a.search_results_mouseover(b)}),this.search_results.bind("mouseout.chosen",function(b){a.search_results_mouseout(b)}),this.search_results.bind("mousewheel.chosen DOMMouseScroll.chosen",function(b){a.search_results_mousewheel(b)}),this.form_field_jq.bind("chosen:updated.chosen",function(b){a.results_update_field(b)}),this.form_field_jq.bind("chosen:activate.chosen",function(b){a.activate_field(b)}),this.form_field_jq.bind("chosen:open.chosen",function(b){a.container_mousedown(b)}),this.search_field.bind("blur.chosen",function(b){a.input_blur(b)}),this.search_field.bind("keyup.chosen",function(b){a.keyup_checker(b)}),this.search_field.bind("keydown.chosen",function(b){a.keydown_checker(b)}),this.search_field.bind("focus.chosen",function(b){a.input_focus(b)}),this.is_multiple?this.search_choices.bind("click.chosen",function(b){a.choices_click(b)}):this.container.bind("click.chosen",function(a){a.preventDefault()})},Chosen.prototype.destroy=function(){return a(document).unbind("click.chosen",this.click_test_action),this.search_field[0].tabIndex&&(this.form_field_jq[0].tabIndex=this.search_field[0].tabIndex),this.container.remove(),this.form_field_jq.removeData("chosen"),this.form_field_jq.show()},Chosen.prototype.search_field_disabled=function(){return this.is_disabled=this.form_field_jq[0].disabled,this.is_disabled?(this.container.addClass("chosen-disabled"),this.search_field[0].disabled=!0,this.is_multiple||this.selected_item.unbind("focus.chosen",this.activate_action),this.close_field()):(this.container.removeClass("chosen-disabled"),this.search_field[0].disabled=!1,this.is_multiple?void 0:this.selected_item.bind("focus.chosen",this.activate_action))},Chosen.prototype.container_mousedown=function(b){return this.is_disabled||(b&&"mousedown"===b.type&&!this.results_showing&&b.preventDefault(),null!=b&&a(b.target).hasClass("search-choice-close"))?void 0:(this.active_field?this.is_multiple||!b||a(b.target)[0]!==this.selected_item[0]&&!a(b.target).parents("a.chosen-single").length||(b.preventDefault(),this.results_toggle()):(this.is_multiple&&this.search_field.val(""),a(document).bind("click.chosen",this.click_test_action),this.results_show()),this.activate_field())},Chosen.prototype.container_mouseup=function(a){return"ABBR"!==a.target.nodeName||this.is_disabled?void 0:this.results_reset(a)},Chosen.prototype.search_results_mousewheel=function(a){var b,c,d;return b=-(null!=(c=a.originalEvent)?c.wheelDelta:void 0)||(null!=(d=a.originialEvent)?d.detail:void 0),null!=b?(a.preventDefault(),"DOMMouseScroll"===a.type&&(b=40*b),this.search_results.scrollTop(b+this.search_results.scrollTop())):void 0},Chosen.prototype.blur_test=function(){return!this.active_field&&this.container.hasClass("chosen-container-active")?this.close_field():void 0},Chosen.prototype.close_field=function(){return a(document).unbind("click.chosen",this.click_test_action),this.active_field=!1,this.results_hide(),this.container.removeClass("chosen-container-active"),this.clear_backstroke(),this.show_search_field_default(),this.search_field_scale()},Chosen.prototype.activate_field=function(){return this.container.addClass("chosen-container-active"),this.active_field=!0,this.search_field.val(this.search_field.val()),this.search_field.focus()},Chosen.prototype.test_active_click=function(b){return this.container.is(a(b.target).closest(".chosen-container"))?this.active_field=!0:this.close_field()},Chosen.prototype.results_build=function(){return this.parsing=!0,this.selected_option_count=null,this.results_data=SelectParser.select_to_array(this.form_field),this.is_multiple?this.search_choices.find("li.search-choice").remove():this.is_multiple||(this.single_set_selected_text(),this.disable_search||this.form_field.options.length<=this.disable_search_threshold?(this.search_field[0].readOnly=!0,this.container.addClass("chosen-container-single-nosearch")):(this.search_field[0].readOnly=!1,this.container.removeClass("chosen-container-single-nosearch"))),this.update_results_content(this.results_option_build({first:!0})),this.search_field_disabled(),this.show_search_field_default(),this.search_field_scale(),this.parsing=!1},Chosen.prototype.result_do_highlight=function(a){var b,c,d,e,f;if(a.length){if(this.result_clear_highlight(),this.result_highlight=a,this.result_highlight.addClass("highlighted"),d=parseInt(this.search_results.css("maxHeight"),10),f=this.search_results.scrollTop(),e=d+f,c=this.result_highlight.position().top+this.search_results.scrollTop(),b=c+this.result_highlight.outerHeight(),b>=e)return this.search_results.scrollTop(b-d>0?b-d:0);if(f>c)return this.search_results.scrollTop(c)}},Chosen.prototype.result_clear_highlight=function(){return this.result_highlight&&this.result_highlight.removeClass("highlighted"),this.result_highlight=null},Chosen.prototype.results_show=function(){return this.is_multiple&&this.max_selected_options<=this.choices_count()?(this.form_field_jq.trigger("chosen:maxselected",{chosen:this}),!1):(this.container.addClass("chosen-with-drop"),this.form_field_jq.trigger("chosen:showing_dropdown",{chosen:this}),this.results_showing=!0,this.search_field.focus(),this.search_field.val(this.search_field.val()),this.winnow_results())},Chosen.prototype.update_results_content=function(a){return this.search_results.html(a)},Chosen.prototype.results_hide=function(){return this.results_showing&&(this.result_clear_highlight(),this.container.removeClass("chosen-with-drop"),this.form_field_jq.trigger("chosen:hiding_dropdown",{chosen:this})),this.results_showing=!1},Chosen.prototype.set_tab_index=function(){var a;return this.form_field.tabIndex?(a=this.form_field.tabIndex,this.form_field.tabIndex=-1,this.search_field[0].tabIndex=a):void 0},Chosen.prototype.set_label_behavior=function(){var b=this;return this.form_field_label=this.form_field_jq.parents("label"),!this.form_field_label.length&&this.form_field.id.length&&(this.form_field_label=a("label[for='"+this.form_field.id+"']")),this.form_field_label.length>0?this.form_field_label.bind("click.chosen",function(a){return b.is_multiple?b.container_mousedown(a):b.activate_field()}):void 0},Chosen.prototype.show_search_field_default=function(){return this.is_multiple&&this.choices_count()<1&&!this.active_field?(this.search_field.val(this.default_text),this.search_field.addClass("default")):(this.search_field.val(""),this.search_field.removeClass("default"))},Chosen.prototype.search_results_mouseup=function(b){var c;return c=a(b.target).hasClass("active-result")?a(b.target):a(b.target).parents(".active-result").first(),c.length?(this.result_highlight=c,this.result_select(b),this.search_field.focus()):void 0},Chosen.prototype.search_results_mouseover=function(b){var c;return c=a(b.target).hasClass("active-result")?a(b.target):a(b.target).parents(".active-result").first(),c?this.result_do_highlight(c):void 0},Chosen.prototype.search_results_mouseout=function(b){return a(b.target).hasClass("active-result")?this.result_clear_highlight():void 0},Chosen.prototype.choice_build=function(b){var c,d,e=this;return c=a("<li />",{"class":"search-choice"}).html("<span>"+b.html+"</span>"),b.disabled?c.addClass("search-choice-disabled"):(d=a("<a />",{"class":"search-choice-close","data-option-array-index":b.array_index}),d.bind("click.chosen",function(a){return e.choice_destroy_link_click(a)}),c.append(d)),this.search_container.before(c)},Chosen.prototype.choice_destroy_link_click=function(b){return b.preventDefault(),b.stopPropagation(),this.is_disabled?void 0:this.choice_destroy(a(b.target))},Chosen.prototype.choice_destroy=function(a){return this.result_deselect(a[0].getAttribute("data-option-array-index"))?(this.show_search_field_default(),this.is_multiple&&this.choices_count()>0&&this.search_field.val().length<1&&this.results_hide(),a.parents("li").first().remove(),this.search_field_scale()):void 0},Chosen.prototype.results_reset=function(){return this.form_field.options[0].selected=!0,this.selected_option_count=null,this.single_set_selected_text(),this.show_search_field_default(),this.results_reset_cleanup(),this.form_field_jq.trigger("change"),this.active_field?this.results_hide():void 0},Chosen.prototype.results_reset_cleanup=function(){return this.current_selectedIndex=this.form_field.selectedIndex,this.selected_item.find("abbr").remove()},Chosen.prototype.result_select=function(a){var b,c,d;return this.result_highlight?(b=this.result_highlight,this.result_clear_highlight(),this.is_multiple&&this.max_selected_options<=this.choices_count()?(this.form_field_jq.trigger("chosen:maxselected",{chosen:this}),!1):(this.is_multiple?b.removeClass("active-result"):(this.result_single_selected&&(this.result_single_selected.removeClass("result-selected"),d=this.result_single_selected[0].getAttribute("data-option-array-index"),this.results_data[d].selected=!1),this.result_single_selected=b),b.addClass("result-selected"),c=this.results_data[b[0].getAttribute("data-option-array-index")],c.selected=!0,this.form_field.options[c.options_index].selected=!0,this.selected_option_count=null,this.is_multiple?this.choice_build(c):this.single_set_selected_text(c.text),(a.metaKey||a.ctrlKey)&&this.is_multiple||this.results_hide(),this.search_field.val(""),(this.is_multiple||this.form_field.selectedIndex!==this.current_selectedIndex)&&this.form_field_jq.trigger("change",{selected:this.form_field.options[c.options_index].value}),this.current_selectedIndex=this.form_field.selectedIndex,this.search_field_scale())):void 0},Chosen.prototype.single_set_selected_text=function(a){return null==a&&(a=this.default_text),a===this.default_text?this.selected_item.addClass("chosen-default"):(this.single_deselect_control_build(),this.selected_item.removeClass("chosen-default")),this.selected_item.find("span").text(a)},Chosen.prototype.result_deselect=function(a){var b;return b=this.results_data[a],this.form_field.options[b.options_index].disabled?!1:(b.selected=!1,this.form_field.options[b.options_index].selected=!1,this.selected_option_count=null,this.result_clear_highlight(),this.results_showing&&this.winnow_results(),this.form_field_jq.trigger("change",{deselected:this.form_field.options[b.options_index].value}),this.search_field_scale(),!0)},Chosen.prototype.single_deselect_control_build=function(){return this.allow_single_deselect?(this.selected_item.find("abbr").length||this.selected_item.find("span").first().after('<abbr class="search-choice-close"></abbr>'),this.selected_item.addClass("chosen-single-with-deselect")):void 0},Chosen.prototype.get_search_text=function(){return this.search_field.val()===this.default_text?"":a("<div/>").text(a.trim(this.search_field.val())).html()},Chosen.prototype.winnow_results_set_highlight=function(){var a,b;return b=this.is_multiple?[]:this.search_results.find(".result-selected.active-result"),a=b.length?b.first():this.search_results.find(".active-result").first(),null!=a?this.result_do_highlight(a):void 0},Chosen.prototype.no_results=function(b){var c;return c=a('<li class="no-results">'+this.results_none_found+' "<span></span>"</li>'),c.find("span").first().html(b),this.search_results.append(c)},Chosen.prototype.no_results_clear=function(){return this.search_results.find(".no-results").remove()},Chosen.prototype.keydown_arrow=function(){var a;return this.results_showing&&this.result_highlight?(a=this.result_highlight.nextAll("li.active-result").first())?this.result_do_highlight(a):void 0:this.results_show()},Chosen.prototype.keyup_arrow=function(){var a;return this.results_showing||this.is_multiple?this.result_highlight?(a=this.result_highlight.prevAll("li.active-result"),a.length?this.result_do_highlight(a.first()):(this.choices_count()>0&&this.results_hide(),this.result_clear_highlight())):void 0:this.results_show()},Chosen.prototype.keydown_backstroke=function(){var a;return this.pending_backstroke?(this.choice_destroy(this.pending_backstroke.find("a").first()),this.clear_backstroke()):(a=this.search_container.siblings("li.search-choice").last(),a.length&&!a.hasClass("search-choice-disabled")?(this.pending_backstroke=a,this.single_backstroke_delete?this.keydown_backstroke():this.pending_backstroke.addClass("search-choice-focus")):void 0)},Chosen.prototype.clear_backstroke=function(){return this.pending_backstroke&&this.pending_backstroke.removeClass("search-choice-focus"),this.pending_backstroke=null},Chosen.prototype.keydown_checker=function(a){var b,c;switch(b=null!=(c=a.which)?c:a.keyCode,this.search_field_scale(),8!==b&&this.pending_backstroke&&this.clear_backstroke(),b){case 8:this.backstroke_length=this.search_field.val().length;break;case 9:this.results_showing&&!this.is_multiple&&this.result_select(a),this.mouse_on_container=!1;break;case 13:a.preventDefault();break;case 38:a.preventDefault(),this.keyup_arrow();break;case 40:a.preventDefault(),this.keydown_arrow()}},Chosen.prototype.search_field_scale=function(){var b,c,d,e,f,g,h,i,j;if(this.is_multiple){for(d=0,h=0,f="position:absolute; left: -1000px; top: -1000px; display:none;",g=["font-size","font-style","font-weight","font-family","line-height","text-transform","letter-spacing"],i=0,j=g.length;j>i;i++)e=g[i],f+=e+":"+this.search_field.css(e)+";";return b=a("<div />",{style:f}),b.text(this.search_field.val()),a("body").append(b),h=b.width()+25,b.remove(),c=this.container.outerWidth(),h>c-10&&(h=c-10),this.search_field.css({width:h+"px"})}},Chosen}(AbstractChosen)}.call(this);

/* bxSlider v4.1.2 - Fully loaded, responsive content slider http://bxslider.com Copyright 2014, Steven Wanderski - http://stevenwanderski.com - http://bxcreative.com Written while drinking Belgian ales and listening to jazz Released under the MIT license - http://opensource.org/licenses/MIT */
!function(t){var e={},s={mode:"horizontal",slideSelector:"",infiniteLoop:!0,hideControlOnEnd:!1,speed:500,easing:null,slideMargin:0,startSlide:0,randomStart:!1,captions:!1,ticker:!1,tickerHover:!1,adaptiveHeight:!1,adaptiveHeightSpeed:500,video:!1,useCSS:!0,preloadImages:"visible",responsive:!0,slideZIndex:50,touchEnabled:!0,swipeThreshold:50,oneToOneTouch:!0,preventDefaultSwipeX:!0,preventDefaultSwipeY:!1,pager:!0,pagerType:"full",pagerShortSeparator:" / ",pagerSelector:null,buildPager:null,pagerCustom:null,controls:!0,nextText:"Next",prevText:"Prev",nextSelector:null,prevSelector:null,autoControls:!1,startText:"Start",stopText:"Stop",autoControlsCombine:!1,autoControlsSelector:null,auto:!1,pause:4e3,autoStart:!0,autoDirection:"next",autoHover:!1,autoDelay:0,minSlides:1,maxSlides:1,moveSlides:0,slideWidth:0,onSliderLoad:function(){},onSlideBefore:function(){},onSlideAfter:function(){},onSlideNext:function(){},onSlidePrev:function(){},onSliderResize:function(){}};t.fn.displetretsidxBxSlider=function(n){if(0==this.length)return this;if(this.length>1)return this.each(function(){t(this).displetretsidxBxSlider(n)}),this;var o={},r=this;e.el=this;var a=t(window).width(),l=t(window).height(),d=function(){o.settings=t.extend({},s,n),o.settings.slideWidth=parseInt(o.settings.slideWidth),o.children=r.children(o.settings.slideSelector),o.children.length<o.settings.minSlides&&(o.settings.minSlides=o.children.length),o.children.length<o.settings.maxSlides&&(o.settings.maxSlides=o.children.length),o.settings.randomStart&&(o.settings.startSlide=Math.floor(Math.random()*o.children.length)),o.active={index:o.settings.startSlide},o.carousel=o.settings.minSlides>1||o.settings.maxSlides>1,o.carousel&&(o.settings.preloadImages="all"),o.minThreshold=o.settings.minSlides*o.settings.slideWidth+(o.settings.minSlides-1)*o.settings.slideMargin,o.maxThreshold=o.settings.maxSlides*o.settings.slideWidth+(o.settings.maxSlides-1)*o.settings.slideMargin,o.working=!1,o.controls={},o.interval=null,o.animProp="vertical"==o.settings.mode?"top":"left",o.usingCSS=o.settings.useCSS&&"fade"!=o.settings.mode&&function(){var t=document.createElement("div"),e=["WebkitPerspective","MozPerspective","OPerspective","msPerspective"];for(var i in e)if(void 0!==t.style[e[i]])return o.cssPrefix=e[i].replace("Perspective","").toLowerCase(),o.animProp="-"+o.cssPrefix+"-transform",!0;return!1}(),"vertical"==o.settings.mode&&(o.settings.maxSlides=o.settings.minSlides),r.data("origStyle",r.attr("style")),r.children(o.settings.slideSelector).each(function(){t(this).data("origStyle",t(this).attr("style"))}),c()},c=function(){r.wrap('<div class="bx-wrapper"><div class="bx-viewport"></div></div>'),o.viewport=r.parent(),o.loader=t('<div class="bx-loading" />'),o.viewport.prepend(o.loader),r.css({width:"horizontal"==o.settings.mode?100*o.children.length+215+"%":"auto",position:"relative"}),o.usingCSS&&o.settings.easing?r.css("-"+o.cssPrefix+"-transition-timing-function",o.settings.easing):o.settings.easing||(o.settings.easing="swing"),f(),o.viewport.css({width:"100%",overflow:"hidden",position:"relative"}),o.viewport.parent().css({maxWidth:p()}),o.settings.pager||o.viewport.parent().css({margin:"0 auto 0px"}),o.children.css({"float":"horizontal"==o.settings.mode?"left":"none",listStyle:"none",position:"relative"}),o.children.css("width",u()),"horizontal"==o.settings.mode&&o.settings.slideMargin>0&&o.children.css("marginRight",o.settings.slideMargin),"vertical"==o.settings.mode&&o.settings.slideMargin>0&&o.children.css("marginBottom",o.settings.slideMargin),"fade"==o.settings.mode&&(o.children.css({position:"absolute",zIndex:0,display:"none"}),o.children.eq(o.settings.startSlide).css({zIndex:o.settings.slideZIndex,display:"block"})),o.controls.el=t('<div class="bx-controls" />'),o.settings.captions&&P(),o.active.last=o.settings.startSlide==x()-1,o.settings.video&&r.fitVids();var e=o.children.eq(o.settings.startSlide);"all"==o.settings.preloadImages&&(e=o.children),o.settings.ticker?o.settings.pager=!1:(o.settings.pager&&T(),o.settings.controls&&C(),o.settings.auto&&o.settings.autoControls&&E(),(o.settings.controls||o.settings.autoControls||o.settings.pager)&&o.viewport.after(o.controls.el)),g(e,h)},g=function(e,i){var s=e.find("img, iframe").length;if(0==s)return i(),void 0;var n=0;e.find("img, iframe").each(function(){t(this).one("load",function(){++n==s&&i()}).each(function(){this.complete&&t(this).load()})})},h=function(){if(o.settings.infiniteLoop&&"fade"!=o.settings.mode&&!o.settings.ticker){var e="vertical"==o.settings.mode?o.settings.minSlides:o.settings.maxSlides,i=o.children.slice(0,e).clone().addClass("bx-clone"),s=o.children.slice(-e).clone().addClass("bx-clone");r.append(i).prepend(s)}o.loader.remove(),S(),"vertical"==o.settings.mode&&(o.settings.adaptiveHeight=!0),o.viewport.height(v()),r.redrawSlider(),o.settings.onSliderLoad(o.active.index),o.initialized=!0,o.settings.responsive&&t(window).bind("resize",Z),o.settings.auto&&o.settings.autoStart&&H(),o.settings.ticker&&L(),o.settings.pager&&q(o.settings.startSlide),o.settings.controls&&W(),o.settings.touchEnabled&&!o.settings.ticker&&O()},v=function(){var e=0,s=t();if("vertical"==o.settings.mode||o.settings.adaptiveHeight)if(o.carousel){var n=1==o.settings.moveSlides?o.active.index:o.active.index*m();for(s=o.children.eq(n),i=1;i<=o.settings.maxSlides-1;i++)s=n+i>=o.children.length?s.add(o.children.eq(i-1)):s.add(o.children.eq(n+i))}else s=o.children.eq(o.active.index);else s=o.children;return"vertical"==o.settings.mode?(s.each(function(){e+=t(this).outerHeight()}),o.settings.slideMargin>0&&(e+=o.settings.slideMargin*(o.settings.minSlides-1))):e=Math.max.apply(Math,s.map(function(){return t(this).outerHeight(!1)}).get()),e},p=function(){var t="100%";return o.settings.slideWidth>0&&(t="horizontal"==o.settings.mode?o.settings.maxSlides*o.settings.slideWidth+(o.settings.maxSlides-1)*o.settings.slideMargin:o.settings.slideWidth),t},u=function(){var t=o.settings.slideWidth,e=o.viewport.width();return 0==o.settings.slideWidth||o.settings.slideWidth>e&&!o.carousel||"vertical"==o.settings.mode?t=e:o.settings.maxSlides>1&&"horizontal"==o.settings.mode&&(e>o.maxThreshold||e<o.minThreshold&&(t=(e-o.settings.slideMargin*(o.settings.minSlides-1))/o.settings.minSlides)),t},f=function(){var t=1;if("horizontal"==o.settings.mode&&o.settings.slideWidth>0)if(o.viewport.width()<o.minThreshold)t=o.settings.minSlides;else if(o.viewport.width()>o.maxThreshold)t=o.settings.maxSlides;else{var e=o.children.first().width();t=Math.floor(o.viewport.width()/e)}else"vertical"==o.settings.mode&&(t=o.settings.minSlides);return t},x=function(){var t=0;if(o.settings.moveSlides>0)if(o.settings.infiniteLoop)t=o.children.length/m();else for(var e=0,i=0;e<o.children.length;)++t,e=i+f(),i+=o.settings.moveSlides<=f()?o.settings.moveSlides:f();else t=Math.ceil(o.children.length/f());return t},m=function(){return o.settings.moveSlides>0&&o.settings.moveSlides<=f()?o.settings.moveSlides:f()},S=function(){if(o.children.length>o.settings.maxSlides&&o.active.last&&!o.settings.infiniteLoop){if("horizontal"==o.settings.mode){var t=o.children.last(),e=t.position();b(-(e.left-(o.viewport.width()-t.width())),"reset",0)}else if("vertical"==o.settings.mode){var i=o.children.length-o.settings.minSlides,e=o.children.eq(i).position();b(-e.top,"reset",0)}}else{var e=o.children.eq(o.active.index*m()).position();o.active.index==x()-1&&(o.active.last=!0),void 0!=e&&("horizontal"==o.settings.mode?b(-e.left,"reset",0):"vertical"==o.settings.mode&&b(-e.top,"reset",0))}},b=function(t,e,i,s){if(o.usingCSS){var n="vertical"==o.settings.mode?"translate3d(0, "+t+"px, 0)":"translate3d("+t+"px, 0, 0)";r.css("-"+o.cssPrefix+"-transition-duration",i/1e3+"s"),"slide"==e?(r.css(o.animProp,n),r.bind("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd",function(){r.unbind("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd"),D()})):"reset"==e?r.css(o.animProp,n):"ticker"==e&&(r.css("-"+o.cssPrefix+"-transition-timing-function","linear"),r.css(o.animProp,n),r.bind("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd",function(){r.unbind("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd"),b(s.resetValue,"reset",0),N()}))}else{var a={};a[o.animProp]=t,"slide"==e?r.animate(a,i,o.settings.easing,function(){D()}):"reset"==e?r.css(o.animProp,t):"ticker"==e&&r.animate(a,speed,"linear",function(){b(s.resetValue,"reset",0),N()})}},w=function(){for(var e="",i=x(),s=0;i>s;s++){var n="";o.settings.buildPager&&t.isFunction(o.settings.buildPager)?(n=o.settings.buildPager(s),o.pagerEl.addClass("bx-custom-pager")):(n=s+1,o.pagerEl.addClass("bx-default-pager")),e+='<div class="bx-pager-item"><a href="" data-slide-index="'+s+'" class="bx-pager-link">'+n+"</a></div>"}o.pagerEl.html(e)},T=function(){o.settings.pagerCustom?o.pagerEl=t(o.settings.pagerCustom):(o.pagerEl=t('<div class="bx-pager" />'),o.settings.pagerSelector?t(o.settings.pagerSelector).html(o.pagerEl):o.controls.el.addClass("bx-has-pager").append(o.pagerEl),w()),o.pagerEl.on("click","a",I)},C=function(){o.controls.next=t('<a class="bx-next" href="">'+o.settings.nextText+"</a>"),o.controls.prev=t('<a class="bx-prev" href="">'+o.settings.prevText+"</a>"),o.controls.next.bind("click",y),o.controls.prev.bind("click",z),o.settings.nextSelector&&t(o.settings.nextSelector).append(o.controls.next),o.settings.prevSelector&&t(o.settings.prevSelector).append(o.controls.prev),o.settings.nextSelector||o.settings.prevSelector||(o.controls.directionEl=t('<div class="bx-controls-direction" />'),o.controls.directionEl.append(o.controls.prev).append(o.controls.next),o.controls.el.addClass("bx-has-controls-direction").append(o.controls.directionEl))},E=function(){o.controls.start=t('<div class="bx-controls-auto-item"><a class="bx-start" href="">'+o.settings.startText+"</a></div>"),o.controls.stop=t('<div class="bx-controls-auto-item"><a class="bx-stop" href="">'+o.settings.stopText+"</a></div>"),o.controls.autoEl=t('<div class="bx-controls-auto" />'),o.controls.autoEl.on("click",".bx-start",k),o.controls.autoEl.on("click",".bx-stop",M),o.settings.autoControlsCombine?o.controls.autoEl.append(o.controls.start):o.controls.autoEl.append(o.controls.start).append(o.controls.stop),o.settings.autoControlsSelector?t(o.settings.autoControlsSelector).html(o.controls.autoEl):o.controls.el.addClass("bx-has-controls-auto").append(o.controls.autoEl),A(o.settings.autoStart?"stop":"start")},P=function(){o.children.each(function(){var e=t(this).find("img:first").attr("title");void 0!=e&&(""+e).length&&t(this).append('<div class="bx-caption"><span>'+e+"</span></div>")})},y=function(t){o.settings.auto&&r.stopAuto(),r.goToNextSlide(),t.preventDefault()},z=function(t){o.settings.auto&&r.stopAuto(),r.goToPrevSlide(),t.preventDefault()},k=function(t){r.startAuto(),t.preventDefault()},M=function(t){r.stopAuto(),t.preventDefault()},I=function(e){o.settings.auto&&r.stopAuto();var i=t(e.currentTarget),s=parseInt(i.attr("data-slide-index"));s!=o.active.index&&r.goToSlide(s),e.preventDefault()},q=function(e){var i=o.children.length;return"short"==o.settings.pagerType?(o.settings.maxSlides>1&&(i=Math.ceil(o.children.length/o.settings.maxSlides)),o.pagerEl.html(e+1+o.settings.pagerShortSeparator+i),void 0):(o.pagerEl.find("a").removeClass("active"),o.pagerEl.each(function(i,s){t(s).find("a").eq(e).addClass("active")}),void 0)},D=function(){if(o.settings.infiniteLoop){var t="";0==o.active.index?t=o.children.eq(0).position():o.active.index==x()-1&&o.carousel?t=o.children.eq((x()-1)*m()).position():o.active.index==o.children.length-1&&(t=o.children.eq(o.children.length-1).position()),t&&("horizontal"==o.settings.mode?b(-t.left,"reset",0):"vertical"==o.settings.mode&&b(-t.top,"reset",0))}o.working=!1,o.settings.onSlideAfter(o.children.eq(o.active.index),o.oldIndex,o.active.index)},A=function(t){o.settings.autoControlsCombine?o.controls.autoEl.html(o.controls[t]):(o.controls.autoEl.find("a").removeClass("active"),o.controls.autoEl.find("a:not(.bx-"+t+")").addClass("active"))},W=function(){1==x()?(o.controls.prev.addClass("disabled"),o.controls.next.addClass("disabled")):!o.settings.infiniteLoop&&o.settings.hideControlOnEnd&&(0==o.active.index?(o.controls.prev.addClass("disabled"),o.controls.next.removeClass("disabled")):o.active.index==x()-1?(o.controls.next.addClass("disabled"),o.controls.prev.removeClass("disabled")):(o.controls.prev.removeClass("disabled"),o.controls.next.removeClass("disabled")))},H=function(){o.settings.autoDelay>0?setTimeout(r.startAuto,o.settings.autoDelay):r.startAuto(),o.settings.autoHover&&r.hover(function(){o.interval&&(r.stopAuto(!0),o.autoPaused=!0)},function(){o.autoPaused&&(r.startAuto(!0),o.autoPaused=null)})},L=function(){var e=0;if("next"==o.settings.autoDirection)r.append(o.children.clone().addClass("bx-clone"));else{r.prepend(o.children.clone().addClass("bx-clone"));var i=o.children.first().position();e="horizontal"==o.settings.mode?-i.left:-i.top}b(e,"reset",0),o.settings.pager=!1,o.settings.controls=!1,o.settings.autoControls=!1,o.settings.tickerHover&&!o.usingCSS&&o.viewport.hover(function(){r.stop()},function(){var e=0;o.children.each(function(){e+="horizontal"==o.settings.mode?t(this).outerWidth(!0):t(this).outerHeight(!0)});var i=o.settings.speed/e,s="horizontal"==o.settings.mode?"left":"top",n=i*(e-Math.abs(parseInt(r.css(s))));N(n)}),N()},N=function(t){speed=t?t:o.settings.speed;var e={left:0,top:0},i={left:0,top:0};"next"==o.settings.autoDirection?e=r.find(".bx-clone").first().position():i=o.children.first().position();var s="horizontal"==o.settings.mode?-e.left:-e.top,n="horizontal"==o.settings.mode?-i.left:-i.top,a={resetValue:n};b(s,"ticker",speed,a)},O=function(){o.touch={start:{x:0,y:0},end:{x:0,y:0}},o.viewport.bind("touchstart",X)},X=function(t){if(o.working)t.preventDefault();else{o.touch.originalPos=r.position();var e=t.originalEvent;o.touch.start.x=e.changedTouches[0].pageX,o.touch.start.y=e.changedTouches[0].pageY,o.viewport.bind("touchmove",Y),o.viewport.bind("touchend",V)}},Y=function(t){var e=t.originalEvent,i=Math.abs(e.changedTouches[0].pageX-o.touch.start.x),s=Math.abs(e.changedTouches[0].pageY-o.touch.start.y);if(3*i>s&&o.settings.preventDefaultSwipeX?t.preventDefault():3*s>i&&o.settings.preventDefaultSwipeY&&t.preventDefault(),"fade"!=o.settings.mode&&o.settings.oneToOneTouch){var n=0;if("horizontal"==o.settings.mode){var r=e.changedTouches[0].pageX-o.touch.start.x;n=o.touch.originalPos.left+r}else{var r=e.changedTouches[0].pageY-o.touch.start.y;n=o.touch.originalPos.top+r}b(n,"reset",0)}},V=function(t){o.viewport.unbind("touchmove",Y);var e=t.originalEvent,i=0;if(o.touch.end.x=e.changedTouches[0].pageX,o.touch.end.y=e.changedTouches[0].pageY,"fade"==o.settings.mode){var s=Math.abs(o.touch.start.x-o.touch.end.x);s>=o.settings.swipeThreshold&&(o.touch.start.x>o.touch.end.x?r.goToNextSlide():r.goToPrevSlide(),r.stopAuto())}else{var s=0;"horizontal"==o.settings.mode?(s=o.touch.end.x-o.touch.start.x,i=o.touch.originalPos.left):(s=o.touch.end.y-o.touch.start.y,i=o.touch.originalPos.top),!o.settings.infiniteLoop&&(0==o.active.index&&s>0||o.active.last&&0>s)?b(i,"reset",200):Math.abs(s)>=o.settings.swipeThreshold?(0>s?r.goToNextSlide():r.goToPrevSlide(),r.stopAuto()):b(i,"reset",200)}o.viewport.unbind("touchend",V)},Z=function(){var e=t(window).width(),i=t(window).height();(a!=e||l!=i)&&(a=e,l=i,r.redrawSlider(),o.settings.onSliderResize.call(r,o.active.index))};return r.goToSlide=function(e,i){if(!o.working&&o.active.index!=e)if(o.working=!0,o.oldIndex=o.active.index,o.active.index=0>e?x()-1:e>=x()?0:e,o.settings.onSlideBefore(o.children.eq(o.active.index),o.oldIndex,o.active.index),"next"==i?o.settings.onSlideNext(o.children.eq(o.active.index),o.oldIndex,o.active.index):"prev"==i&&o.settings.onSlidePrev(o.children.eq(o.active.index),o.oldIndex,o.active.index),o.active.last=o.active.index>=x()-1,o.settings.pager&&q(o.active.index),o.settings.controls&&W(),"fade"==o.settings.mode)o.settings.adaptiveHeight&&o.viewport.height()!=v()&&o.viewport.animate({height:v()},o.settings.adaptiveHeightSpeed),o.children.filter(":visible").fadeOut(o.settings.speed).css({zIndex:0}),o.children.eq(o.active.index).css("zIndex",o.settings.slideZIndex+1).fadeIn(o.settings.speed,function(){t(this).css("zIndex",o.settings.slideZIndex),D()});else{o.settings.adaptiveHeight&&o.viewport.height()!=v()&&o.viewport.animate({height:v()},o.settings.adaptiveHeightSpeed);var s=0,n={left:0,top:0};if(!o.settings.infiniteLoop&&o.carousel&&o.active.last)if("horizontal"==o.settings.mode){var a=o.children.eq(o.children.length-1);n=a.position(),s=o.viewport.width()-a.outerWidth()}else{var l=o.children.length-o.settings.minSlides;n=o.children.eq(l).position()}else if(o.carousel&&o.active.last&&"prev"==i){var d=1==o.settings.moveSlides?o.settings.maxSlides-m():(x()-1)*m()-(o.children.length-o.settings.maxSlides),a=r.children(".bx-clone").eq(d);n=a.position()}else if("next"==i&&0==o.active.index)n=r.find("> .bx-clone").eq(o.settings.maxSlides).position(),o.active.last=!1;else if(e>=0){var c=e*m();n=o.children.eq(c).position()}if("undefined"!=typeof n){var g="horizontal"==o.settings.mode?-(n.left-s):-n.top;b(g,"slide",o.settings.speed)}}},r.goToNextSlide=function(){if(o.settings.infiniteLoop||!o.active.last){var t=parseInt(o.active.index)+1;r.goToSlide(t,"next")}},r.goToPrevSlide=function(){if(o.settings.infiniteLoop||0!=o.active.index){var t=parseInt(o.active.index)-1;r.goToSlide(t,"prev")}},r.startAuto=function(t){o.interval||(o.interval=setInterval(function(){"next"==o.settings.autoDirection?r.goToNextSlide():r.goToPrevSlide()},o.settings.pause),o.settings.autoControls&&1!=t&&A("stop"))},r.stopAuto=function(t){o.interval&&(clearInterval(o.interval),o.interval=null,o.settings.autoControls&&1!=t&&A("start"))},r.getCurrentSlide=function(){return o.active.index},r.getCurrentSlideElement=function(){return o.children.eq(o.active.index)},r.getSlideCount=function(){return o.children.length},r.redrawSlider=function(){o.children.add(r.find(".bx-clone")).outerWidth(u()),o.viewport.css("height",v()),o.settings.ticker||S(),o.active.last&&(o.active.index=x()-1),o.active.index>=x()&&(o.active.last=!0),o.settings.pager&&!o.settings.pagerCustom&&(w(),q(o.active.index))},r.destroySlider=function(){o.initialized&&(o.initialized=!1,t(".bx-clone",this).remove(),o.children.each(function(){void 0!=t(this).data("origStyle")?t(this).attr("style",t(this).data("origStyle")):t(this).removeAttr("style")}),void 0!=t(this).data("origStyle")?this.attr("style",t(this).data("origStyle")):t(this).removeAttr("style"),t(this).unwrap().unwrap(),o.controls.el&&o.controls.el.remove(),o.controls.next&&o.controls.next.remove(),o.controls.prev&&o.controls.prev.remove(),o.pagerEl&&o.settings.controls&&o.pagerEl.remove(),t(".bx-caption",this).remove(),o.controls.autoEl&&o.controls.autoEl.remove(),clearInterval(o.interval),o.settings.responsive&&t(window).unbind("resize",Z))},r.reloadSlider=function(t){void 0!=t&&(n=t),r.destroySlider(),d()},d(),this}}(jQuery);

/*********************
Displet RETS/IDX
*********************/

(function(displetretsidx, $, undefined) {
	function init(){
		set_selectors();
		set_conditional_vars();
		add_popstate_binding();
		add_placeholders_for_ie();
		maybe_send_analytics_event();
		if ((displetretsidx.wp.is_search_results_page || displetretsidx.wp.is_mobile_search_results_page) && $('#displet-search-form').length) {
			add_search_form_binding();
			maybe_show_mobile_search_form();
		}
		if (displetretsidx.pages.is_property_details_page) {
			init_property_details_page();
		}
		if ($('#displet-dynamic').length || $('#displet-table').length) {
			maybe_show_unavailable_message();
		}
		if ($('#displet-quick-search').length){
			add_quick_search_binding();
			clear_quick_search_values();
		}
		if ($('#displet-sidescroller-widget').length){
			add_sidescroller_binding();
		}
		if ($('#displet-stats-advanced').length) {
			add_advanced_stats_binding();
		}
		if ($('#displet-login-register-popup').length) {
			add_login_register_binding();
			add_facebook_init();
		}
		if ($('#displet-request-showing-popup, #displet-property-details-popups .displet-request-showing-popup-wrapper').length) {
			add_request_showing_binding();
		}
		if (displetretsidx.pages.is_mobile_page) {
			mobile_init();
		}
		save_search_registration_form_init();
		save_search_registration_popup_init();
	}

	function init_with_cookies(){
		$(document).ready(function(){
			maybe_instantiate_listings();
			maybe_show_login_register_popup();
		});
	}

	/*********************
	General Functions
	*********************/

	function add_advanced_stats_binding(){
		$('#displet-stats-advanced .displet-tab').click(function(){
			if (!$(this).hasClass('displet-active')) {
				var status = $(this).attr('for');
				$('#displet-stats-advanced .displet-tab.displet-active').removeClass('displet-active');
				$(this).addClass('displet-active');
				$('#displet-stats-advanced .displet-stats').hide();
				$('.displet-stats[for="' + status + '"]', $(this).parents('#displet-stats-advanced')).show();
			}
		});
	}

	function add_placeholders_for_ie(){
		if (Modernizr && Modernizr.input && !Modernizr.input.placeholder){
			$("#displet-search-form input, #displet-quick-search input").each(function(){if($(this).val()=="" && $(this).attr("placeholder")!=""){$(this).val($(this).attr("placeholder"));$(this).focus(function(){if($(this).val()==$(this).attr("placeholder")) $(this).val("");});$(this).blur(function(){if($(this).val()=="") $(this).val($(this).attr("placeholder"));});}});
		}
	}

	function add_popstate_binding(){
		window.onpopstate = function(event) {
			if (event && event.state && event.state.displetretsidx_listings) {
				displetretsidx.event_state = event.state;
				for (var i = 0; i < displetretsidx.listings.length; i++) {
					displetretsidx.listings[i].pop_state();
				};
			}
		};
	}

	function get_cookies(){
		var data = {
			action: 'displet_get_cookies_request',
			_ajax_nonce: displetretsidx.nonces.get_cookies
		};
		$.ajax({
			type: "POST",
			url: displetretsidx.urls.ajax,
			data: data,
			dataType: 'json',
			success: function(response) {
				displetretsidx.cookies = response;
				init_with_cookies();
				$(document).trigger('displetretsidx_have_cookies');
			},
		});
	}

	function get_listing_address(listing) {
		var address;
		if (displetretsidx.is_displet_api) {
			if (displetretsidx.options.address_format != '') {
				address = displetretsidx.options.address_format;
				if (listing.street_number == undefined) {
					listing.street_number = '';
				}
				if (listing.street_pre_direction == undefined) {
					listing.street_pre_direction = '';
				}
				if (listing.street_name == undefined) {
					listing.street_name = '';
				}
				if (listing.street_post_dir == undefined) {
					listing.street_post_dir = '';
				}
				if (listing.unit == undefined || listing.unit == '') {
					address = address.replace('#', '');
					listing.unit = '';
				}
				address = address.replace('%%street_number%%', listing.street_number);
				address = address.replace('%%street_pre_direction%%', listing.street_pre_direction);
				address = address.replace('%%street_name%%', listing.street_name);
				address = address.replace('%%street_post_direction%%', listing.street_post_dir);
				address = address.replace('%%unit%%', listing.unit);
			}
			else{
				address = '';
				if (listing.street_number != undefined) {
					address += ' ' + listing.street_number;
				}
				if (listing.street_pre_direction != undefined) {
					address += ' ' + listing.street_pre_direction;
				}
				if (listing.street_name != undefined) {
					address += ' ' + listing.street_name;
				}
				if (listing.street_post_dir!= undefined) {
					address += ' ' + listing.street_post_dir;
				}
				if (listing.unit != undefined && listing.unit != '') {
					address += ' #' + listing.unit;
				}
			}
			address = address.replace(/^\s\s*/, '').replace(/\s\s*$/, '');
			address = address.replace('   ', ' ');
			address = address.replace('  ', ' ');
		}
		return address;
	}

	function get_listing_permalink(listing) {
		if (listing.id) {
			var permalink_state = listing.state ? listing.state : 'CAN';
			var permalink_city = listing.city ? listing.city : 'City';
			var permalink_zip = listing.zip ? listing.zip : '00000';
			if (displetretsidx.wp.is_mobile_search_results_page || displetretsidx.wp.is_mobile_property_details_page) {
				var url = trailing_slash_it(displetretsidx.urls.mobile_property_details_page);
			}
			else{
				var url = trailing_slash_it(displetretsidx.urls.property_details_page);
			}
			url += permalink_state.replace(/[ ]+/g, '-').replace(/[^\w-]+/g, '') + '/' + permalink_city.replace(/[ ]+/g, '-').replace(/[^\w-]+/g, '') + '/' + permalink_zip.replace(/[ ]+/g, '-').replace(/[^\w-]+/g, '') + '/' + listing.id;
			if (listing.address) {
				url += '/' + listing.address.replace(/[ ]+/g, '-').replace(/[^\w-]+/g, '');
			}
			if (displetretsidx.options.add_price_to_url && listing.list_price) {
				url += '/' + listing.list_price.toString().replace(/[\D]+/g, '');
			}
			return url;
		}
	}

	function get_unique_array(array) {
		return $.grep(array, function(el, index) {
    	    return index == $.inArray(el, array);
    	});
	}

	function go_to_previous_onsite_url(){
		if (document.referrer && displetretsidx.urls.home && document.referrer.indexOf(displetretsidx.urls.home) !== -1) {
			window.history.back();
		}
		else if (displetretsidx.pages.is_mobile_page) {
			window.location.href = displetretsidx.urls.mobile_search_results_page;
		}
		else {
			window.location.href = displetretsidx.urls.search_results_page;
		}
	}

	function maybe_instantiate_listings() {
		if (displetretsidx.queries.length > 0) {
			var i = 0;
			$('.displetretsidx_listings').each(function(){
				var listings = new displetretsidx_listings({
					data_from: displetretsidx.queries[i].data_from,
					id: i,
					listings: displetretsidx.queries[i].listings,
					query_args: displetretsidx.queries[i].args,
					scope: $('#' + $(this).attr('id')),
				});
				displetretsidx.listings.push(listings);
				i++;
			}).trigger('displetretsidx_have_listings');
		}
	}

	function maybe_set_geocoder() {
		if (typeof(displetretsidx.geocoder) === 'undefined' || !displetretsidx.geocoder) {
			displetretsidx.geocoder = new google.maps.Geocoder();
		}
	}

	function maybe_show_unavailable_message(){
		if (window.location.hash && window.location.hash.indexOf('status=unavailable')) {
			var hash_array = window.location.hash.replace('#', '').split('/');
			var hash = {};
			for (var i = hash_array.length - 1; i >= 0; i--) {
				var current_hash = hash_array[i].split('=');
				hash[current_hash[0]] = current_hash[1];
			};
			if (hash.status && hash.status == 'unavailable') {
				var message = 'The property requested (ID: ' + hash.listing + ')';
				if (hash.address) {
					message += ' at ' + hash.address.replace(/-/g, ' ');
				}
				message += ' is unavailable. Please contact us for more information.';
				if (!$('#displet-search-form').length) {
					message += ' Nearby properties:';
				}
				$('#displet-dynamic .displet-unavailable').html(message);
				history.pushState('', document.title, window.location.pathname + window.location.search);
			}
		}
	}

	function number_format(value){
		if (value){
			while (/(\d+)(\d{3})/.test(value.toString())){
				value = value.toString().replace(/(\d+)(\d{3})/, '$1'+','+'$2');
			}
		}
		return value;
	}

	function reload_page_maybe_without_hash() {
		if ( displetretsidx.pages.is_search_results_page ) {
			window.location.reload();
		}
		else {
			window.location.href = window.location.href.split('#')[0];
		}
	}

	function scroll_to_top_of_element(element){
		if (element.length) {
			$('html,body').animate({scrollTop:element.first().offset().top - 40}, 400);
		}
	}

	function scroll_to_top_of_hash(self){
		if (self.hash) {
			$('html,body').animate({scrollTop:$(self.hash).offset().top - 40}, 400);
		}
	}

	displetretsidx.set_cookie = function(cookie_name, cookie_value){
		var data = {
			action: 'displet_set_cookie_request',
			_ajax_nonce: displetretsidx.nonces.set_cookie,
			name: cookie_name,
			value: cookie_value
		};
		$.post(displetretsidx.urls.ajax, data);
	}

	function set_selectors() {
		displetretsidx.elements = {
			html_and_body: $('html, body'),
		};
		displetretsidx.templates = {
			save_search_registration_form: $('[id="displet-save-search-registration-form"]'),
			save_search_registration_popup: $('#displet-save-search-registration-popup'),
		};
	}

	function set_conditional_vars() {
		displetretsidx.has_save_search_registration_form = displetretsidx.templates.save_search_registration_form ? true : false;
		displetretsidx.has_save_search_registration_popup = displetretsidx.templates.save_search_registration_popup ? true : false;
	}

	function trailing_slash_it(string){
		if (string.substr(-1) != '/'){
			return string + '/';
		}
		return string;
	}

	function trim_trailing_slash(string){
		if(string.substr(-1) == '/') {
			return string.substr(0, string.length - 1);
		}
		return string;
	}

	/*********************
	Mobile Functions
	*********************/

	function mobile_init() {
		set_mobile_selectors();
		add_mobile_binding();
		add_nearby_listings_binding();
		detect_mobile_location();
	}

	function add_mobile_binding(){
		$('#displet-mobile-header .displet-favorites').click(function(e){
			if (!displetretsidx.user.is_logged_in) {
				e.preventDefault();
				displetretsidx.show_login_register_popup('To view or save favorites, you\'ll need to sign in or create an account.');
				return false;
			}
		});
	}

	function add_nearby_listings_binding() {
		displetretsidx.elements.mobile.nearby_listings.click(function(ev){
			ev.preventDefault();
			if (!displetretsidx.elements.mobile.nearby_listings_loading.is(':visible')) {
				var radius = .0037; // .25 miles
				var coords = [];
				for (var angle_in_degrees = 0; angle_in_degrees < 360; angle_in_degrees += 30) {
					var coord = {
						latitude: (radius * Math.cos(angle_in_degrees * Math.PI / 180)) + displetretsidx.mobile_location.latitude,
						longitude: (radius * Math.sin(angle_in_degrees * Math.PI / 180)) + displetretsidx.mobile_location.longitude,
					}
					coords.push(coord);
				};
				var url = trailing_slash_it($(this).attr('href')) + '#poly=' + coords[0].longitude + '%20' + coords[0].latitude;
				for (var i = coords.length - 1; i >= 0; i--) {
					url += '%2C' + coords[i].longitude + '%20' + coords[i].latitude;
				};
				window.location.href = url;
			}
			return false;
		});
	}

	function detect_mobile_location() {
		if (navigator.geolocation) {
			navigator.geolocation.getCurrentPosition(save_mobile_location);
		}
	}

	function save_mobile_location(position) {
		displetretsidx.mobile_location = {
			latitude: position.coords.latitude,
			longitude: position.coords.longitude,
		}
		displetretsidx.elements.mobile.nearby_listings_loading.hide();
	}

	function set_mobile_selectors() {
		displetretsidx.elements.mobile = {
			nearby_listings: $('#displet-quick-search .displet-nearby-listings-submit, #displet-search-form .displet-nearby-listings-submit'),
			nearby_listings_loading: $('#displet-quick-search .displet-nearby-listings-loading, #displet-search-form .displet-nearby-listings-loading'),
		};
	}

	/*********************
	Quick Search Functions
	*********************/

	function add_quick_search_binding(){
		$('#displet-quick-search .displet-submit-quick-search, #displet-quick-search .displet-action a').click(function(e) {
			e.preventDefault();
			submit_quick_search($(this).attr('href'));
			return false;
		});
		$('#displet-quick-search').keypress(function(e) {
			if (e.which == 13) {
				e.preventDefault();
				var submit_element = $(this).find('.displet-submit-quick-search');
				if (submit_element.length) {
					var url = submit_element.attr('href');
				}
				else{
					var url = $(this).find('.displet-action').children('a').attr('href');
				}
				submit_quick_search(url);
				return false;
			}
		});
		$('#displet-quick-search .displet-submit-quick-search, #displet-quick-search .displet-action a').keypress(function(e) {
			if (e.which == 32) {
				e.preventDefault();
				submit_quick_search($(this).attr('href'));
				return false;
			}
		});
	}

	function clear_quick_search_values(){
		$('#displet-quick-search input[type="text"]').val('');
		$('#displet-quick-search select').val('none');
		$('#displet-quick-search input[type="radio"]').prop('checked', false);
	}

	function submit_quick_search(url_base){
		if (url_base) {
			if (url_base.indexOf('#') !== -1) {
				var url = trailing_slash_it(url_base);
			}
			else {
				var url = trim_trailing_slash(url_base) + '/#';
			}
			jQuery.each(jQuery('#displet-quick-search .displet-search-field'), function () {
				if (this.value && this.value != 'none' && this.value != $(this).attr('placeholder')) {
					var value = displetretsidx.get_value_from_search_form_element(this);
					if (value) {
						url += this.name + '=' + encodeURIComponent(value) + '/';
					}
				}
			});
			if (trim_trailing_slash(displetretsidx.urls.current_page) == trim_trailing_slash(url_base)) {
				location.replace(url);
				window.location.reload();
			}
			else{
				window.location.href = url;
			}
		}
	}

	/*********************
	Save Search Registration Form
	*********************/

	function save_search_registration_form_init() {
		if (displetretsidx.has_save_search_registration_form) {
			set_save_search_registration_form_selectors();
			add_save_search_registration_form_submit_binding();
		}
	}

	function add_save_search_registration_form_submit_binding() {
		displetretsidx.elements.save_search_registration_form.submit.click(function(){
			submit_save_search_registration_form($(this).parents('#displet-save-search-registration-form'));
		});
	}

	function set_save_search_registration_form_selectors() {
		displetretsidx.elements.save_search_registration_form = {
			submit: displetretsidx.templates.save_search_registration_form.find('.displet-submit'),
		};
	}

	function submit_save_search_registration_form($this_form){
		var $loading = $this_form.find('.displet-loading');
		$loading.show();
		var data = {
			action: 'displet_save_search_registration_request',
			_ajax_nonce: displetretsidx.nonces.save_search_registration,
			city: $this_form.find('.displet-save-search-registration-city').val(),
			last_hash: displetretsidx.cookies.last_viewed_hash,
			max_list_price: $this_form.find('.displet-save-search-registration-max-list-price').val(),
			min_bathrooms: $this_form.find('.displet-save-search-registration-min-bathrooms').val(),
			min_bedrooms: $this_form.find('.displet-save-search-registration-min-bedrooms').val(),
			min_list_price: $this_form.find('.displet-save-search-registration-min-list-price').val(),
			property_type: $this_form.find('.displet-save-search-registration-property-type').val(),
			upstream_url: displetretsidx.cookies.referring_site,
			url: displetretsidx.urls.current_page,
			user_name: $this_form.find('.displet-save-search-registration-user-name').val(),
			user_email: $this_form.find('.displet-save-search-registration-user-email').val(),
			user_phone: $this_form.find('.displet-save-search-registration-user-phone').val(),
			zip: $this_form.find('.displet-save-search-registration-zip').val(),
		};
		$.post(displetretsidx.urls.ajax, data, function(response) {
			if (response === 'Saved Search' || response === 'Created User & Saved Search') {
				var message = 'Your search has been saved successfully.';
				alert(message);
				if (displetretsidx.elements.save_search_registration_popup) {
					hide_save_search_registration_popup();
				}
				if (response === 'Created User & Saved Search') {
					window.sessionStorage.send_analytics_event = true;
					window.sessionStorage.analytics_event = 'Saved Search Registration';
					window.sessionStorage.analytics_data = data.user_email;
					window.location.reload();
				}
				else {
					if (typeof(_gaq) !== 'undefined') {
						_gaq.push(['_trackEvent', 'Displet RETS/IDX', 'Saved Search Registration', data.user_email]);
					}
					else if (typeof(ga) !== 'undefined') {
						ga('send', 'event', 'Displet RETS/IDX', 'Saved Search Registration', data.user_email);
					}
				}
			}
			else{
				$this_form.find('.displet-save-search-registration-error').html('<div class="displet-error">' + response + '</div>');
			}
			$loading.hide();
		});
	}

	/*********************
	Save Search Registration Popup
	*********************/

	function save_search_registration_popup_init() {
		if (displetretsidx.has_save_search_registration_popup) {
			set_save_search_registration_popup_selectors();
			add_save_search_registration_popup_close_binding();
			add_save_search_registration_popup_toggle_binding();
		}
	}

	function add_save_search_registration_popup_close_binding() {
		displetretsidx.elements.save_search_registration_popup.close.click(function(ev){
			ev.preventDefault();
			hide_save_search_registration_popup();
			return false;
		});
	}

	function add_save_search_registration_popup_toggle_binding() {
		displetretsidx.elements.save_search_registration_popup.toggle.click(function(ev){
			ev.preventDefault();
			if (displetretsidx.elements.save_search_registration_popup.wrapper.is(':visible')) {
				hide_save_search_registration_popup();
			}
			else {
				show_save_search_registration_popup();
			}
			return false;
		});
	}

	function hide_save_search_registration_popup(){
		displetretsidx.elements.save_search_registration_popup.wrapper.hide();
		displetretsidx.elements.html_and_body.removeClass('displet-save-search-registration-popup');
	}

	function set_save_search_registration_popup_selectors() {
		displetretsidx.elements.save_search_registration_popup = {
			close: displetretsidx.templates.save_search_registration_popup.find('.displet-close, .displet-shadow'),
			toggle: $('a[title="Sign Up For Property Updates"], a[title="Sign Up To Save Searches"], a[title="Sign Up For Saved Search Updates"]'),
			wrapper: displetretsidx.templates.save_search_registration_popup.find('.displet-save-search-registration-popup-wrapper'),
		};
	}

	function show_save_search_registration_popup(){
		displetretsidx.elements.save_search_registration_popup.wrapper.show();
		displetretsidx.elements.html_and_body.addClass('displet-save-search-registration-popup');
	}

	/*********************
	Search Form Functions
	*********************/

	function add_search_form_binding(){
		$('#displet-search-form .displet-toggle-advanced-search-form, #displet-search-form .displet-submit .displet-more').click(function(){
			toggle_advanced_search_form(this);
		});
		$('#displet-search-form .displet-toggle-advanced-search-form, #displet-search-form .displet-submit .displet-more').keypress(function(e){
			if (e.which == 32) {
				toggle_advanced_search_form(this);
				return false;
			}
		});
		$('#displet-search-form .displet-save-search, #displet-search-form .displet-submit .displet-save').click(function(){
			show_save_search_popup();
		});
		$('#displet-save-search-popup .displet-save-search-popup .displet-close, #displet-save-search-popup .displet-save-search-popup-wrapper .displet-popup-back').click(function(){
			hide_save_search_popup();
		});
		$('#displet-save-search-popup .displet-action .displet-submit').click(function(){
			submit_save_search();
		});
		$('#displet-save-search-popup .displet-form, #displet-save-search-popup .displet-save-search-form').keypress(function(e) {
			if (e.which == 13) {
				submit_save_search();
			}
		});
		if (!displetretsidx.is_displet_api){
			$('#displet-search-form input[name="is_foreclosure"][value="Y"]').click(function(){
				set_empty_value_for_property_type();
			});
			$('#displet-search-form select[name="property_type"]').bind('change', function(){
				set_empty_value_for_foreclosure(this);
			});
		}
		if (displetretsidx.wp.is_mobile_search_results_page) {
			$('#displet-search-form .displet-revise-form, #displet-search-form .displet-revise').click(function(){
				toggle_mobile_search_form();
			});
			$('#displet-search-form select[multiple]').each(function(){
				set_mobile_multiselect_default(this);
			});
		}
		add_search_form_property_type_price_binding();
	}

	function add_search_form_property_type_price_binding() {
		if ($('#displet-search-form input[name="lease_max"]').length || $('#displet-search-form input[name="sale_min"]').length) {
			var price_selects = $('#displet-search-form select[name="min_list_price"], #displet-search-form select[name="max_list_price"]');
			if (price_selects.length) {
				price_selects.each(function(){
					this.initial_options = $(this).find('option');
				});
				$('#displet-search-form select[name="property_type"]').bind('change', function(){
					var property_types = $(this).val();
					var all_leases = false;
					var all_sales = false;
					if (property_types && property_types.length) {
						all_leases = true;
						all_sales = true;
						for (var i = property_types.length - 1; i >= 0; i--) {
							var property_type = property_types[i].toLowerCase();
							if (property_type.indexOf('lease') === -1) {
								all_leases = false;
							}
							else {
								all_sales = false;
							}
							if (property_type.indexOf('commercial') !== -1) {
								all_sales = false;
							}
						};
					}
					if (all_leases) {
						price_selects.each(function(){
							var lease_max = $(this).siblings('input[name="lease_max"]');
							if (lease_max.length) {
								var lease_max_value = parseInt(lease_max.val());
								$(this).html(this.initial_options.filter(function(){
									return this.value === 'none' || this.value <= lease_max_value;
								}));
							}
						});
					}
					else if (all_sales) {
						price_selects.each(function(){
							var sale_min = $(this).siblings('input[name="sale_min"]');
							if (sale_min.length) {
								var sale_min_value = parseInt(sale_min.val());
								$(this).html(this.initial_options.filter(function(){
									return this.value === 'none' || this.value >= sale_min_value;
								}));
							}
						});
					}
					else {
						price_selects.each(function(){
							$(this).html(this.initial_options);
						});
					}
					price_selects.trigger('chosen:updated');
				});
			}
		}
	}

	function hide_save_search_popup(){
		$('#displet-save-search-popup .displet-save-search-popup-wrapper').hide();
		$('html, body').removeClass('displet-save-search-popup');
		$('#displet-save-search-popup .displet-search-name').val('');
		$('#displet-save-search-popup .displet-save-search-error').html('');
	}

	displetretsidx.get_value_from_search_form_element = function(self){
		if (self.value && self.value != $(self).attr('placeholder')) {
			if ($(self).is('select[multiple]')) {
				var values = $(self).val();
				var value = '';
				var placeholder = $(self).attr('data-placeholder');
				$(values).each(function(i, val){
					if (val !== 'none' && val != placeholder) {
						value += val + ',';
					}
				});
				return value.substring(0, value.length - 1);
			}
			else if ($(self).is('input[type="radio"]') && self.value != 'none') {
				if ($(self).is(':checked')) {
					return value = self.value;
				}
			}
			else if (self.value != 'none'){
				return self.value;
			}
		}
		return false;
	}

	function maybe_show_mobile_search_form(){
		if (displetretsidx.wp.is_mobile_search_results_page && !document.location.hash) {
			$('#displet-search-form .displet-search-form').show();
		}
	}

	function set_mobile_multiselect_default(self){
		$(self).children('option[value="none"]').attr('selected', true);
	}

	function set_empty_value_for_foreclosure(self){
		if ($('#displet-search-form input[name="is_foreclosure"][value="Y"]').is(':checked') && $(self).val() != 'none') {
			$('#displet-search-form input[name="is_foreclosure"][value="none"]').attr('checked', 'checked');
		}
	}

	function set_empty_value_for_property_type(){
		$('#displet-search-form select[name="property_type"]').val('none');
	}

	function show_save_search_popup(){
		$('#displet-save-search-popup .displet-save-search-popup-wrapper').show();
		$('html, body').addClass('displet-save-search-popup');
		if (displetretsidx.user.is_logged_in && displetretsidx.user.can_view_leads) {
			$('#displet-save-search-popup .displet-loading').show();
			$('#displet-save-search-popup .displet-clients').show();
			var data = {
				action: 'displet_get_clients_request',
				_ajax_nonce: displetretsidx.nonces.get_clients
			};
			$.post(displetretsidx.urls.ajax, data, function(response){
				if (response && response != 'No matching users.' && response != 'There was an error processing your request. Please try again.') {
					var clients = JSON.parse(response);
					for (var i = 0; i < clients.length; i++) {
						var markup = '<option value="' + clients[i].id + '">' + clients[i].name + '</option>';
						$('#displet-save-search-popup .displet-client-name').append(markup);
					};
				}
				//$('#displet-save-search-popup .displet-client-name').chosen();
				$('#displet-save-search-popup .displet-loading').hide();
			});
		}
	}

	function submit_save_search(){
		$('#displet-save-search-popup .displet-loading').show();
		var saved_search_name = $('#displet-save-search-popup .displet-search-name').val();
		var data = {
			action: 'displet_save_search_request',
			_ajax_nonce: displetretsidx.nonces.save_search,
			hash: window.location.hash,
			search_name: saved_search_name
		};
		if (displetretsidx.user.can_view_leads) {
			data.client_id = $('#displet-save-search-popup .displet-client-name').val();
		}
		$.post(displetretsidx.urls.ajax, data, function(response) {
			if (response == 'Not Logged In') {
				var message = 'Please login or create an account to save searches.';
				displetretsidx.show_login_register_popup(message);
			}
			else if (response == 'Saved Search') {
				var message = 'Your search has been saved successfully.';
				alert(message);
				hide_save_search_popup();
				if (typeof(_gaq) !== 'undefined') {
					_gaq.push(['_trackEvent', 'Displet RETS/IDX', 'Saved Search', displetretsidx.user.email]);
				}
				else if (typeof(ga) !== 'undefined') {
					ga('send', 'event', 'Displet RETS/IDX', 'Saved Search', displetretsidx.user.email);
				}
			}
			else{
				$('#displet-save-search-popup .displet-save-search-popup .displet-save-search-error').html('<div class="displet-error">' + response + '</div>');
			}
			$('#displet-save-search-popup .displet-save-search-popup .displet-loading').hide();
		});
	}

	function toggle_advanced_search_form(self){
		if ($('#displet-search-form .displet-advanced-form').is(':visible')){
			$('#displet-search-form .displet-advanced-form').stop(true, true).slideUp(300);
			$(self).removeClass('displet-showing');
		}
		else{
			$('#displet-search-form .displet-advanced-form').stop(true, true).slideDown(300);
			$(self).addClass('displet-showing');
		}
	}

	function toggle_mobile_search_form(){
		if ($('#displet-search-form .displet-search-form').is(':visible')){
			$('#displet-search-form .displet-search-form').stop(true, true).slideUp(300);
		}
		else{
			$('#displet-search-form .displet-search-form').stop(true, true).slideDown(300);
		}
	}

	/*********************
	Sidescroller Functions
	*********************/

	function add_sidescroller_binding(){
		var sidescroller = $('#displet-sidescroller-widget.displet-slideshow');
		if (sidescroller.length) {
			sidescroller.each(function(){
				var visible = $(this).attr('for');
				var max_slides = visible.length ? parseInt(visible) : 1;
				var container_width = $(this).innerWidth();
				var slide_width = (container_width - (20 * (max_slides - 1))) / max_slides;
				var slide_margin = max_slides > 1 ? 20 : 0;
				$(this).find('ul').displetretsidxBxSlider({
					prevSelector: $(this).find('.displet-navigation-previous'),
					nextSelector: $(this).find('.displet-navigation-next'),
					pager: false,
					auto: true,
					autoHover: true,
					pause: 5000,
					speed: 300,
					maxSlides: max_slides,
					slideWidth: slide_width,
					slideMargin: slide_margin,
				});
			});
		}
		else if ($('#displet-sidescroller-widget .displet-listings-carousel').length) {
			try {
				$('#displet-sidescroller-widget .displet-listings-carousel').each(function(){
					$(this).displetRetsIdxCarouselLite({
						btnNext: $('.displet-navigation-next', this),
						btnPrev: $('.displet-navigation-previous', this),
						visible: 1,
						auto: 5000
					});
				});
			}
			catch(e){}
		}
	}

	/*********************
	Property Details Functions
	*********************/

	function init_property_details_page() {
		set_property_details_selectors();
		set_property_details_vars();
		add_property_details_binding();
		add_property_details_pagination();
		add_property_details_map();
		photo_slideshow();
		similar_listings_slideshow();
	}

	function add_property_details_binding(){
		$('#displet-property-details .displet-map-tabs a').click(function(){
			toggle_maps(this);
		});
		$('#displet-property-details .displet-request-showing').click(function(){
			show_request_showing_popup();
		});
		$('#displet-property-details .displet-save-property').click(function(){
			show_save_property_popup();
		});
		$('#displet-property-details-popups .displet-save-property-popup .displet-close, #displet-property-details-popups .displet-save-property-popup-wrapper .displet-popup-back').click(function(){
			hide_save_property_popup();
		});
		$('#displet-property-details-popups .displet-save-property-popup .displet-submit').click(function() {
			submit_save_property({
				message: $('#displet-property-details-popups .displet-save-property-popup .displet-property-comments').val(),
				rating: $('#displet-property-details-popups .displet-save-property-popup .displet-rating.displet-selected').attr('rating'),
				type: $('#displet-property-details-popups .displet-save-property-popup input[name="displet-save-property-type"]:checked').val(),
			});
		});
		$('#displet-property-details .displet-email-friend').click(function(){
			show_email_friend_popup();
		});
		$('#displet-property-details-popups .displet-email-friend-popup .displet-close, #displet-property-details-popups .displet-email-friend-popup-wrapper .displet-popup-back').click(function(){
			hide_email_friend_popup();
		});
		$('#displet-property-details-popups .displet-email-friend-popup .displet-submit').click(function() {
			submit_email_friend();
		});
		$('#displet-property-details-popups .displet-save-property-popup .displet-rating').click(function(){
			rate_property(this);
		});
		$('#displet-property-details .displet-rating').click(function(){
			rate_property_submit(this);
		});
		$('#displet-property-details-popups .displet-save-property-popup input[name="displet-save-property-type"]').click(function(){
			update_property_rating(this);
		});
		$('#displet-property-details .displet-photos-thumbs-value .displet-image').click(function(ev){
			ev.preventDefault();
			if (displetretsidx.wp.is_mobile_property_details_page){
				small_to_large_photo_mobile(this);
				hide_thumbnails();
			}
			else{ // Legacy template usage
				small_to_large_photo(this);
			}
			scroll_to_top_of_hash(this);
		});
		$('#displet-property-details .displet-thumbnails a').click(function(ev){
			ev.preventDefault();
			scroll_to_top_of_element($('#displet-property-details .displet-photo-slideshow'));
		});
		if (displetretsidx.wp.is_mobile_property_details_page) {
			$('#displet-property-details .displet-more-photos, #displet-property-details .displet-photos-large-value .displet-more').click(function(){
				show_thumbnails();
			});
			$('#displet-property-details .displet-section-title').click(function(){
				toggle_details_section(this);
			});
		}
	}

	function add_property_details_map() {
		if ( displetretsidx.property.latitude && displetretsidx.property.longitude && (displetretsidx.has_road_map || displetretsidx.has_street_view_map || displetretsidx.has_birds_eye_map) ) {
			var listing_location = new google.maps.LatLng(displetretsidx.property.latitude, displetretsidx.property.longitude);
			var markerOptions = {
				position: listing_location
			}
			if (displetretsidx.has_road_map) {
				var listing_marker = new google.maps.Marker(markerOptions);
				var scroll_wheel = displetretsidx.elements.road_map.attr('displet-scroll');
				var mapOptions = {
					zoom: 16,
					center: listing_location,
					mapTypeId: google.maps.MapTypeId.ROADMAP,
					scrollwheel: scroll_wheel === 'false' ? false : true,
				}
				console.log(mapOptions);
				var map = new google.maps.Map(document.getElementById("displet-map-canvas"), mapOptions);
				listing_marker.setMap(map);
				displetretsidx.maps.road = map;
			}
			if (displetretsidx.has_street_view_map) {
				var listing_marker2 = new google.maps.Marker(markerOptions);
				var scroll_wheel = displetretsidx.elements.street_view_map.attr('displet-scroll');
				var panoramaOptions = {
					visible: false,
					scrollwheel: scroll_wheel === 'false' ? false : true,
				};
				var panorama = new google.maps.StreetViewPanorama(document.getElementById("displet-street-view-canvas"), panoramaOptions);
				var streetViewMaxDistance = 100;
				var streetViewService = new google.maps.StreetViewService();
				streetViewService.getPanoramaByLocation(listing_location, streetViewMaxDistance, function (streetViewPanoramaData, status) {
					if (status === google.maps.StreetViewStatus.OK){
						var old_listing_location = listing_location;
						listing_location = streetViewPanoramaData.location.latLng;
						var heading = google.maps.geometry.spherical.computeHeading(listing_location,old_listing_location);
						panorama.setPosition(listing_location);
						panorama.setPov({
							heading: heading,
							zoom: 1,
							pitch: 0
						});
						panorama.setVisible(true);
						listing_marker2.setMap(panorama);
					}
					else{
						if ($('#displet-property-details #displet-street-view-canvas').is(':empty')) {
							displetretsidx.map = map;
							$('#displet-property-details .displet-map-tabs .displet-street-view-select').hide().trigger('displetretsidx_hid_street_view');
						}
					}
				});
				displetretsidx.maps.street_view = panorama;
			}
			if (displetretsidx.has_birds_eye_map) {
				var birds_eye_marker = new google.maps.Marker(markerOptions);
				var scroll_wheel = displetretsidx.elements.birds_eye_map.attr('displet-scroll');
				var birds_eye_map = new google.maps.Map(document.getElementById("displet-birds-eye-canvas"), {
					zoom: 20,
					center: listing_location,
					mapTypeId: google.maps.MapTypeId.SATELLITE,
					scrollwheel: scroll_wheel === 'false' ? false : true,
				});
				birds_eye_marker.setMap(birds_eye_map);
				birds_eye_map.setTilt(45);
				displetretsidx.maps.birds_eye = birds_eye_map;
			}
		}
	}

	function add_property_details_pagination() {
		if (window.sessionStorage && window.sessionStorage.displetretsidx_search_results_permalinks && window.sessionStorage.displetretsidx_search_results_page) {
			var permalinks = JSON.parse(window.sessionStorage.displetretsidx_search_results_permalinks);
			var current_page = parseInt(window.sessionStorage.displetretsidx_search_results_page);
			if (permalinks && permalinks[window.sessionStorage.displetretsidx_search_results_page]) {
				var current_page_key = false;
				var previous_page_key = false;
				var previous_page_url = false;
				var next_page_key = false;
				var next_page_url = false;
				var page_needed = false;
				for (var i = 0; i < permalinks[current_page].length; i++) {
					if (trailing_slash_it(permalinks[current_page][i]) === trailing_slash_it(window.location.href)) {
						current_page_key = i;
					}
				};
				if (current_page_key === false) {
					$.each(permalinks, function(p, permalink) {
						for (var i = 0; i < permalink.length; i++) {
							if (trailing_slash_it(permalink[i]) === trailing_slash_it(window.location.href)) {
								current_page = parseInt(p);
								current_page_key = i;
							}
						};
					});
					if (current_page !== false) {
						window.sessionStorage.displetretsidx_search_results_page = current_page;
					}
				}
				if (current_page_key !== false) {
					if (current_page_key === 0) {
						var previous_page = current_page - 1;
						if (permalinks[previous_page]) {
							var previous_page_key = permalinks[previous_page].length - 1;
							var previous_page_url = permalinks[previous_page][previous_page_key];
						}
						else {
							var page_needed = previous_page;
							var index_needed = 'last';
						}
					}
					else {
						var previous_page_key = current_page_key - 1;
						var previous_page_url = permalinks[current_page][previous_page_key];
					}
					if (current_page_key === permalinks[current_page].length - 1) {
						var next_page = current_page + 1;
						if (permalinks[next_page]) {
							var next_page_url = permalinks[next_page][0];
						}
						else {
							var page_needed = next_page;
							var index_needed = 'first';
						}
					}
					else {
						var next_page_key = current_page_key + 1;
						var next_page_url = permalinks[current_page][next_page_key];
					}
					if (previous_page_url) {
						update_previous_listing_pagination(previous_page_url);
					}
					if (next_page_url) {
						update_next_listing_pagination(next_page_url);
					}
					if (page_needed && window.sessionStorage.displetretsidx_search_results_query_args) {
						var args = JSON.parse(window.sessionStorage.displetretsidx_search_results_query_args);
						args.page = page_needed;
						args.return_fields = 'city,id,state,street_name,street_number,street_post_dir,street_pre_direction,unit,zip';
						var url = 'http://api.displet.com/residentials/search?' + $.param(args) + '&callback=?';
						$.getJSON(url, null, function(response){
							if (response.results) {
								var the_permalinks = [];
								for (var i = 0; i < response.results.length; i++) {
									response.results[i].address = get_listing_address(response.results[i]);
									var permalink = get_listing_permalink(response.results[i]);
									if (permalink) {
										the_permalinks.push(permalink);
									}
								};
								if (the_permalinks) {
									if (index_needed === 'last') {
										var previous_page_key = the_permalinks.length - 1;
										update_previous_listing_pagination(the_permalinks[previous_page_key]);
										var previous_page = current_page - 1;
										permalinks[previous_page] = the_permalinks;
									}
									else {
										update_next_listing_pagination(the_permalinks[0]);
										var next_page = current_page + 1;
										permalinks[next_page] = the_permalinks;
									}
									window.sessionStorage.displetretsidx_search_results_permalinks = JSON.stringify(permalinks);
								}
							}
						});
					}
				}
			}
		}
	}

	function hide_email_friend_popup(){
		$('#displet-property-details-popups .displet-email-friend-popup-wrapper').hide();
		$('html, body').removeClass('displet-email-friend-popup');
	}

	function hide_save_property_popup(){
		$('#displet-property-details-popups .displet-save-property-popup-wrapper').hide();
		$('html, body').removeClass('displet-save-property-popup');
	}

	function hide_thumbnails(){
		$('#displet-property-details .displet-photos-thumbs-value').hide();
		$('#displet-property-details .displet-photos-large-value').show();
	}

	function rate_property(self){
		var rating = parseInt($(self).attr('rating'));
		select_rating(rating);
		$('#displet-property-details-popups .displet-save-property-popup input[name="displet-save-property-type"]').addClass('displet-user-rated');
	}

	function rate_property_submit(self){
		var rating = parseInt($(self).attr('rating'));
		select_rating(rating);
		$('#displet-property-details .displet-rate-property-auto-submit').addClass('displet-user-rated');
		submit_save_property_auto();
	}

	function photo_slideshow(){
		$('#displet-property-details .displet-photo-slideshow').displetretsidxBxSlider({
			pagerCustom: '#displet-property-details .displet-thumbnails',
			prevSelector: '#displet-property-details .displet-previous-photo',
			nextSelector: '#displet-property-details .displet-next-photo',
			nextText: 'Next Photo',
			prevText: 'Previous Photo',
			infiniteLoop: false,
			adaptiveHeight: true,
			speed: 300,
		});
	}

	function select_rating(rating){
		$('#displet-property-details-popups .displet-save-property-popup .displet-rating.displet-on, #displet-property-details .displet-rating.displet-on').removeClass('displet-on');
		$('#displet-property-details-popups .displet-save-property-popup .displet-rating.displet-selected, #displet-property-details .displet-rating.displet-selected').removeClass('displet-selected');
		for (var i = 1; i <= rating; i++) {
			$('#displet-property-details-popups .displet-save-property-popup .displet-rating[rating="' + i +'"], #displet-property-details .displet-rating[rating="' + i +'"]').addClass('displet-on');
			if (i == rating) {
				$('#displet-property-details-popups .displet-save-property-popup .displet-rating[rating="' + i +'"], #displet-property-details .displet-rating[rating="' + i +'"]').addClass('displet-selected');
			}
		};
	}

	function set_property_details_selectors() {
		displetretsidx.elements.birds_eye_map = $('#displet-birds-eye-canvas');
		displetretsidx.elements.road_map = $('#displet-map-canvas');
		displetretsidx.elements.street_view_map = $('#displet-street-view-canvas');
		displetretsidx.maps = {};
	}

	function set_property_details_vars() {
		displetretsidx.has_birds_eye_map = displetretsidx.elements.birds_eye_map.length;
		displetretsidx.has_road_map = displetretsidx.elements.road_map.length;
		displetretsidx.has_street_view_map = displetretsidx.elements.street_view_map.length;
	}

	function show_thumbnails(){
		$('#displet-property-details .displet-photos-large-value').hide();
		$('#displet-property-details .displet-photos-thumbs-value').show();
	}

	function similar_listings_slideshow(){
		$('#displet-property-details .displet-similar-listings-slideshow').displetretsidxBxSlider({
			pager: false,
			prevSelector: '#displet-property-details .displet-similar-listings-previous',
			nextSelector: '#displet-property-details .displet-similar-listings-next',
			nextText: 'Next',
			prevText: 'Previous',
			maxSlides: 10,
			slideWidth: 200,
			slideMargin: 21,
		});
	}

	function small_to_large_photo(self){
		$('#displet-property-details .displet-photos-large-value .displet-image img').attr('src', $(self).children('img').attr('src'));
		$('#displet-property-details .displet-photos-large-value .displet-image').css('background-image', $(self).css('background-image'));
	}

	function small_to_large_photo_mobile(self){
		$('#displet-property-details .displet-photos-large-value img').attr('src', $(self).children('img').attr('src'));
	}

	function show_email_friend_popup(){
		$('#displet-property-details-popups .displet-email-friend-popup-wrapper').show();
		$('html, body').addClass('displet-email-friend-popup');
	}

	function show_save_property_popup(){
		if (displetretsidx.user.is_logged_in) {
			$('#displet-property-details-popups .displet-save-property-popup-wrapper').show();
			$('html, body').addClass('displet-save-property-popup');
		}
		else{
			var message = 'To save this property, you\'ll need to sign in or create an account.';
			displetretsidx.show_login_register_popup(message);
		}
	}

	function submit_email_friend(){
		$('#displet-property-details-popups .displet-email-friend-popup .displet-loading').show();
		var data = {
			action: 'displet_email_friend_request',
			_ajax_nonce: displetretsidx.nonces.email_friend,
			address: displetretsidx.property.address,
			city: displetretsidx.property.city,
			email: $('#displet-property-details-popups .displet-email-friend-popup .displet-friend-email').val(),
			message: $('#displet-property-details-popups .displet-email-friend-popup .displet-user-message').val(),
			name: $('#displet-property-details-popups .displet-email-friend-popup .displet-friend-name').val(),
			state: displetretsidx.property.state,
			url: displetretsidx.property.permalink ? displetretsidx.property.permalink : window.location.href,
			zip: displetretsidx.property.zip,
		};
		$.post(displetretsidx.urls.ajax, data, function(response) {
			alert(response);
			if (response == 'Your message has been sent.') {
				hide_email_friend_popup();
				if (typeof(_gaq) !== 'undefined') {
					_gaq.push(['_trackEvent', 'Displet RETS/IDX', 'Emailed Property To Friend', displetretsidx.user.email]);
				}
				else if (typeof(ga) !== 'undefined') {
					ga('send', 'event', 'Displet RETS/IDX', 'Emailed Property To Friend', displetretsidx.user.email);
				}
			}
			$('#displet-property-details-popups .displet-email-friend-popup .displet-loading').hide();
		});
	}

	function submit_save_property(args){
		$('#displet-property-details-popups .displet-save-property-popup .displet-loading, #displet-property-details .displet-rate-property-auto-submit .displet-loading').show();
		var data = {
			action: 'displet_save_property_request',
			_ajax_nonce: displetretsidx.nonces.save_property,
			address: displetretsidx.property.address,
			image_url: displetretsidx.property.image_url,
			message: args.message,
			price: displetretsidx.property.price,
			rating: args.rating,
			square_feet: displetretsidx.property.square_feet,
			sysid: displetretsidx.property.id,
			type: args.type,
			url: displetretsidx.property.permalink ? displetretsidx.property.permalink : window.location.href,
			zip: displetretsidx.property.zip,
		};
		$.post(displetretsidx.urls.ajax, data, function(response) {
			if (response == 'This property has been saved.') {
				alert(response);
				hide_save_property_popup();
				if (typeof(_gaq) !== 'undefined') {
					_gaq.push(['_trackEvent', 'Displet RETS/IDX', 'Saved Property', displetretsidx.user.email]);
				}
				else if (typeof(ga) !== 'undefined') {
					ga('send', 'event', 'Displet RETS/IDX', 'Saved Property', displetretsidx.user.email);
				}
			}
			else {
				var message = response;
				hide_save_property_popup();
				displetretsidx.show_login_register_popup(message);
			}
			$('#displet-property-details-popups .displet-save-property-popup .displet-loading, #displet-property-details .displet-rate-property-auto-submit .displet-loading').hide();
		});
	}

	function submit_save_property_auto() {
		var property_rating = $('#displet-property-details .displet-rating.displet-selected').attr('rating');
		submit_save_property({
			message: '',
			rating: property_rating,
			type: property_rating === '5' ? 'favorite' : 'possibility',
		});
	}

	function toggle_details_section(self){
		if ($(self).parent('.displet-section').children('.displet-details').is(':visible')) {
			$(self).removeClass('displet-active');
			$(self).parent('.displet-section').children('.displet-details').stop(true, true).slideUp(200);
		}
		else {
			$(self).addClass('displet-active');
			$(self).parent('.displet-section').children('.displet-details').stop(true, true).slideDown(300);
		}
	}

	function toggle_maps(self){
		if (!$(self).hasClass('displet-active')) {
			if ($(self).hasClass('displet-map-select')) {
				$('#displet-property-details #displet-map-canvas').addClass('displet-showing');
				$('#displet-property-details #displet-street-view-canvas').removeClass('displet-showing');
				$('#displet-property-details .displet-map-tabs .displet-active').removeClass('displet-active');
				$(self).addClass('displet-active');
			}
			else{
				$('#displet-property-details #displet-street-view-canvas').addClass('displet-showing');
				$('#displet-property-details #displet-map-canvas').removeClass('displet-showing');
				$('#displet-property-details .displet-map-tabs .displet-active').removeClass('displet-active');
				$(self).addClass('displet-active');
			}
		}
	}

	function update_next_listing_pagination(url) {
		$('#displet-property-details .displet-next-result').attr('href', url).show();
	}

	function update_previous_listing_pagination(url) {
		$('#displet-property-details .displet-previous-result').attr('href', url).show();
	}

	function update_property_rating(self){
		if ($(self).val() == 'favorite'){
			$('#displet-property-details-popups .displet-save-property-popup .displet-rate-property').slideDown(300);
			if (!$(self).hasClass('displet-user-rated')) {
				select_rating(3);
			}
		}
		else if ($(self).val() == 'possibility'){
			$('#displet-property-details-popups .displet-save-property-popup .displet-rate-property').slideDown(300);
			if (!$(self).hasClass('displet-user-rated')) {
				select_rating(2);
			}
		}
		else if ($(self).val() == 'notes'){
			$('#displet-property-details-popups .displet-save-property-popup .displet-rate-property').slideUp(300);
		}
	}

	/*********************
	Login Register Functions
	*********************/

	function add_facebook_init(){
		if (displetretsidx.options.facebook_app_id && displetretsidx.options.facebook_channel) {
			window.fbAsyncInit = function() {
				FB.init({
					appId: displetretsidx.options.facebook_app_id,
					channelUrl: displetretsidx.options.facebook_channel,
					status: true,
					cookie: true,
					xfbml: true,
				});
			};
			(function(d){
				 var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
				 if (d.getElementById(id)) {return;}
				 js = d.createElement('script'); js.id = id; js.async = true;
				 js.src = "//connect.facebook.net/en_US/all.js";
				 ref.parentNode.insertBefore(js, ref);
			}(document));
		}
	}

	function add_login_register_binding(){
		$('a[title="Login To View Listings"], a[title="Sign Up To View Listings"], a[title="Login To View Unlimited Listings"], a[title="Sign Up To View Unlimited Listings"], a[title="Login To Save Listings"], a[title="Sign Up To Save Listings"], a[title="Login To Save Searches"], a[title="Sign Up To Save Searches"]').click(function(e){
			e.preventDefault();
			displetretsidx.show_login_register_popup(' ');
			return false;
		});
		$('#displet-login-register-popup .displet-login-expand-contract').click(function(){
			toggle_login_form(this);
		});
		$('#displet-login-register-popup .displet-google-login').click(function(){
			submit_google_login();
		});
		$('#displet-login-register-popup .displet-facebook-login').click(function(){
			displetretsidx.submit_facebook_login();
		});
		$('#displet-login-register-popup .displet-user-phone').mask('(999) 999-9999',{placeholder:' '});
		$('#displet-login-register-popup .displet-registration-form .displet-submit').click(function() {
			submit_registration_form(displetretsidx.urls.current_page, displetretsidx.cookies.referring_site);
		});
		$('#displet-login-register-popup .displet-registration-form').keypress(function(e) {
			if (e.which == 13) {
				submit_registration_form(displetretsidx.urls.current_page, displetretsidx.cookies.referring_site);
			}
		});
		$('#displet-login-register-popup .displet-login-form .displet-submit').click(function() {
			submit_login_form();
		});
		$('#displet-login-register-popup .displet-login-form .displet-submit').keypress(function(e) {
			if (e.which = 32) {
				e.preventDefault();
				submit_login_form();
				return false;
			}
		});
		$('#displet-login-register-popup .displet-login-form').keypress(function(e) {
			if (e.which == 13) {
				submit_login_form();
			}
		});
	}

	function add_login_register_back_binding(){
		$('#displet-login-register-popup .displet-close').click(function(){
			go_to_previous_onsite_url();
		});
		$('#displet-login-register-popup .displet-popup-back').click(function(){
			go_to_previous_onsite_url();
		});
	}

	function add_login_register_close_binding(){
		$('#displet-login-register-popup .displet-close').click(function(){
			hide_login_register_popup();
		});
		$('#displet-login-register-popup .displet-popup-back').click(function(){
			hide_login_register_popup();
		});
	}

	function hide_login_register_popup(){
		$('#displet-login-register-popup, #displet-login-register-popup .displet-user-registration-popup-wrapper').hide(); // #displet-login-register-popup .displet-user-registration-popup-wrapper for legacy template usage
		$('html, body').removeClass('displet-user-registration-popup');
	}

	function scroll_to_property_details(){
		var el = $('#displet-property-details');
		if (el.length) {
			$('html,body').scrollTop(el.offset().top - 10);
		}
	}

	function login_or_register_facebook_user(access_token){
		$('#displet-login-register-popup .displet-registration-form .displet-loading').show();
		FB.api('/me', function(response) {
			var data = {
			    action: 'displet_user_check_request',
			    _ajax_nonce: displetretsidx.nonces.check_user,
			    email: response.email,
			    token: access_token,
			};
			$.post(displetretsidx.urls.ajax, data, function(user_check_response) {
				if (user_check_response == 'User Exists and Logged In') {
					window.location.reload();
				}
				else{
					var data = {
					    action: 'displet_user_registration_request',
					    _ajax_nonce: displetretsidx.nonces.register_user,
					    email: response.email,
					    last_hash: displetretsidx.cookies.last_viewed_hash,
					    name: response.name,
					    phone: 'Facebook',
					    secret: response,
					    upstream_url: displetretsidx.urls.referrer,
					    url: displetretsidx.urls.current_page,

					};
					$.post(displetretsidx.urls.ajax, data, function(user_registration_response) {
						if (user_registration_response == 'Successful Registration') {
							window.location.reload();
						}
						else{
							$('#displet-login-register-popup .displet-registration-error').html('<div class="displet-error">' + user_registration_response + '</div>').show();
							$('#displet-login-register-popup .displet-registration-form .displet-loading').hide();
						}
					});
				}
			});
   		});
	}

	function maybe_send_analytics_event() {
		if (typeof(Storage) !== 'undefined' && window.sessionStorage && window.sessionStorage.send_analytics_event && window.sessionStorage.analytics_event && window.sessionStorage.analytics_data) {
			if (typeof(_gaq) !== 'undefined') {
				_gaq.push(['_trackEvent', 'Displet RETS/IDX', window.sessionStorage.analytics_event, window.sessionStorage.analytics_data]);
			}
			else if (typeof(ga) !== 'undefined') {
				ga('send', 'event', 'Displet RETS/IDX', window.sessionStorage.analytics_event, window.sessionStorage.analytics_data);
			}
			window.sessionStorage.send_analytics_event = false;
			window.sessionStorage.analytics_event = '';
			window.sessionStorage.analytics_data = '';
		}
	}

	function maybe_show_login_register_popup(){
		if (displetretsidx.options.require_registration_to_view_properties && (displetretsidx.wp.is_property_details_page || displetretsidx.wp.is_mobile_property_details_page) && $('#displet-property-details').length) {
			var viewed_properties = parseInt(displetretsidx.cookies.last_viewed_count);
			viewed_properties = (viewed_properties > 0) ? ++viewed_properties : 1;
			if (viewed_properties >= displetretsidx.options.public_views && !displetretsidx.user.is_logged_in) {
				if (displetretsidx.options.exclude_referred_visitors == '1') {
					if ((displetretsidx.cookies.referring_site == undefined || displetretsidx.cookies.referring_site == null || displetretsidx.cookies.referring_site == '' || displetretsidx.cookies.referring_site.indexOf(displetretsidx.urls.home) !== -1) && displetretsidx.urls.referrer.indexOf(displetretsidx.urls.home) !== -1) {
						displetretsidx.show_login_register_popup();
					}
				}
				else{
					displetretsidx.show_login_register_popup();
				}
			}
			displetretsidx.set_cookie('displetretsidx_last_viewed_count', viewed_properties);
		}
	}

	function poll_for_logged_in_user(){
		var data = {
			action: 'displet_check_login_request',
			_ajax_nonce: displetretsidx.nonces.check_login
		};
		$.post(displetretsidx.urls.ajax, data, function(response) {
			if (response != 'User Not Logged In') {
				reload_page_maybe_without_hash();
			}
			else{
				setTimeout(function(){
					poll_for_logged_in_user();
				}, 2500);
			}
		});
	}

	displetretsidx.show_login_register_popup = function(message){
		if (message || displetretsidx.options.registration_type == 'soft' || displetretsidx.options.registration_type == 'back') {
			if (message) {
				$('#displet-login-register-popup .displet-message').text(message);
				$('#displet-login-register-popup .displet-message').show();
			}
			if (message || displetretsidx.options.registration_type == 'soft') {
				add_login_register_close_binding();
			}
			else if (displetretsidx.options.registration_type == 'back') {
				add_login_register_back_binding();
			}
			$('#displet-login-register-popup .displet-close').show();
		}
		if (!message) {
			scroll_to_property_details();
		}
		$('#displet-login-register-popup, #displet-login-register-popup .displet-user-registration-popup-wrapper').show(); // #displet-login-register-popup .displet-user-registration-popup-wrapper for legacy template usage
		$('html').addClass('displet-user-registration-popup');
	}

	displetretsidx.submit_facebook_login = function(){
		FB.login(function(response) {
    		if (response.authResponse) {
    		    login_or_register_facebook_user(response.authResponse.accessToken);
    		}
		}, {
			scope: 'email'
		});
	}

	function submit_google_login(){
		$('#displet-login-register-popup .displet-registration-form .displet-loading').show();
		displetretsidx.set_cookie('displet_registration_url', displetretsidx.urls.current_page);
		displetretsidx.set_cookie('displet_upstream_url', displetretsidx.cookies.referring_site);
		poll_for_logged_in_user();
	}

	function submit_login_form(){
		$('#displet-login-register-popup .displet-login-form .displet-loading').show();
		var login_email = $('#displet-login-register-popup .displet-login-email').val();
		var data = {
			action: 'displetretsidx_user_signon',
			_ajax_nonce: displetretsidx.nonces.login_user,
			email: login_email,
			password: $('#displet-login-register-popup .displet-login-password').val(),
		};
		$.post(displetretsidx.urls.ajax, data, function(response) {
			if (response == 'Successful Login') {
				if (typeof(_gaq) !== 'undefined' && typeof(ga) !== 'undefined') {
					if (typeof(Storage) !== 'undefined') {
						window.sessionStorage.send_analytics_event = true;
						window.sessionStorage.analytics_event = 'Existing User Login';
						window.sessionStorage.analytics_data = login_email;
						reload_page_maybe_without_hash();
					}
					else {
						if (typeof(_gaq) !== 'undefined') {
							_gaq.push(['_trackEvent', 'Displet RETS/IDX', 'Existing User Login', login_email]);
						}
						else {
							ga('send', 'event', 'Displet RETS/IDX', 'Existing User Login', login_email);
						}
						setTimeout(function(){
							reload_page_maybe_without_hash();
						}, 1000);
					}
				}
				else {
					reload_page_maybe_without_hash();
				}
			}
			else{
				$('#displet-login-register-popup .displet-login-error').html('<div class="displet-error">' + response + '</div>').show();
				$('#displet-login-register-popup .displet-login-form .displet-loading').hide();
			}
		});
	}

	function submit_registration_form(current_url, current_referrer){
		$('#displet-login-register-popup .displet-registration-form .displet-loading').show();
		var user_email = $('#displet-login-register-popup .displet-user-email').val();
		var data = {
			action: 'displet_user_registration_request',
			_ajax_nonce: displetretsidx.nonces.register_user,
			email: user_email,
			last_hash: displetretsidx.cookies.last_viewed_hash,
			listing_agent_email: displetretsidx.property.listing_agent_email,
			name: $('#displet-login-register-popup .displet-user-name').val(),
			phone: $('#displet-login-register-popup .displet-user-phone').val(),
			realtor: $('#displet-login-register-popup .displet-user-realtor:checked').val(),
			upstream_url: current_referrer,
			url: current_url,
			user_address: displetretsidx.cookies.user_address, // AustinHomeSeller.com custom functionality
			user_address_time: displetretsidx.cookies.user_address_time, // AustinHomeSeller.com custom functionality
		};
		$.post(displetretsidx.urls.ajax, data, function(response) {
			if (response == 'Successful Registration') {
				if (typeof(_gaq) !== 'undefined') {
					_gaq.push(['_trackEvent', 'Displet RETS/IDX', 'New User Registration', user_email]);
				}
				else if (typeof(ga) !== 'undefined') {
					ga('send', 'event', 'Displet RETS/IDX', 'New User Registration', user_email);
				}
				reload_page_maybe_without_hash();
			}
			else{
				$('#displet-login-register-popup .displet-registration-error').html('<div class="displet-error">' + response + '</div>').show();
				$('#displet-login-register-popup .displet-registration-form .displet-loading').hide();
			}
		});
	}

	function toggle_login_form(self){
		if (!$(self).hasClass('displet-expanded')) {
			$('#displet-login-register-popup .displet-login-form').slideDown(300);
			$(self).addClass('displet-expanded');
		}
		else{
			$('#displet-login-register-popup .displet-login-form').slideUp(300);
			$(self).removeClass('displet-expanded');
		}
	}

	/*********************
	Request Showing Functions
	*********************/

	function add_request_showing_binding(){
		$('a[title="Request A Showing"], a[title="Schedule A Showing"], a[title="Request Property Information"]').click(function(e){
			e.preventDefault();
			show_request_showing_popup();
			return false;
		});
		$('#displet-request-showing-popup .displet-close, #displet-request-showing-popup .displet-popup-back, #displet-property-details-popups .displet-request-showing-popup .displet-close, #displet-property-details-popups .displet-request-showing-popup-wrapper .displet-popup-back').click(function(){
			hide_request_showing_popup();
		});
		$('#displet-request-showing-popup .displet-submit, #displet-property-details-popups .displet-request-showing-popup .displet-submit').click(function() {
			submit_request_showing_popup();
		});
	}

	function hide_request_showing_popup(){
		$('#displet-request-showing-popup .displet-request-showing-popup-wrapper, #displet-property-details-popups .displet-request-showing-popup-wrapper').hide();
		$('html, body').removeClass('displet-request-showing-popup');
	}

	function show_request_showing_popup(){
		var prepopulated_date = $('#displet-property-details .displet-prepopulated-showing-request-date');
		var first_appointment = $('#displet-request-showing-popup .displet-user-appointment1, #showing_request_appointment1_at');
		first_appointment.datepicker({dateFormat: 'mm-dd-yy'});
		if (prepopulated_date.length) {
			var date_val = prepopulated_date.datepicker('getDate');
			if (date_val) {
				first_appointment.datepicker('setDate', date_val);
			}
			else{
				first_appointment.val(prepopulated_date.val());
			}
		}
		$('#displet-request-showing-popup .displet-user-appointment2, #showing_request_appointment2_at').datepicker({dateFormat: 'mm-dd-yy'});
		$('#displet-request-showing-popup .displet-user-phone, #displet-property-details-popups .displet-request-showing-popup .displet-user-phone').mask('(999) 999-9999',{placeholder:' '});
		$('html, body').addClass('displet-request-showing-popup');
		$('#displet-request-showing-popup .displet-request-showing-popup-wrapper, #displet-property-details-popups .displet-request-showing-popup-wrapper').show();
	}

	function submit_request_showing_popup(){
		$('#displet-request-showing-popup .displet-loading, #displet-property-details-popups .displet-request-showing-popup .displet-loading').show();
		var data = {
			action: 'displet_property_showing_request',
			_ajax_nonce: displetretsidx.nonces.property_showing,
			address: displetretsidx.property.zip ? displetretsidx.property.address : $('#displet-request-showing-popup .displet-address-value').val(),
			appointment1: $('#displet-request-showing-popup .displet-user-appointment1, #displet-property-details-popups .displet-request-showing-popup .displet-user-appointment1').val(),
			appointment2: $('#displet-request-showing-popup .displet-user-appointment2, #displet-property-details-popups .displet-request-showing-popup .displet-user-appointment2').val(),
			city: displetretsidx.property.zip ? displetretsidx.property.city : '',
			email: $('#displet-request-showing-popup .displet-user-email, #displet-property-details-popups .displet-request-showing-popup .displet-user-email').val(),
			last_hash: displetretsidx.cookies.last_viewed_hash,
			listing_agent_email: displetretsidx.property.listing_agent_email,
			message: $('#displet-request-showing-popup .displet-user-message, #displet-property-details-popups .displet-request-showing-popup .displet-user-message').val(),
			mls_number: displetretsidx.property.mls_number ? displetretsidx.property.mls_number : $('#displet-request-showing-popup .displet-mls-value').val(),
			name: $('#displet-request-showing-popup .displet-user-name, #displet-property-details-popups .displet-request-showing-popup .displet-user-name').val(),
			phone: $('#displet-request-showing-popup .displet-user-phone, #displet-property-details-popups .displet-request-showing-popup .displet-user-phone').val(),
			state: displetretsidx.property.zip ? displetretsidx.property.state : '',
			upstream_url: displetretsidx.cookies.referring_site,
			url: displetretsidx.property.permalink ? displetretsidx.property.permalink : window.location.href,
			zip: displetretsidx.property.zip ? displetretsidx.property.zip : '',
		};
		$.post(displetretsidx.urls.ajax, data, function(response) {
			if (response === 'Sent Showing Request and Created User' || response === 'Sent Showing Request') {
				alert('Your request has been sent.');
				if (response === 'Sent Showing Request and Created User') {
					window.sessionStorage.send_analytics_event = true;
					window.sessionStorage.analytics_event = 'Showing Request';
					window.sessionStorage.analytics_data = data.user_email;
					window.location.reload();
				}
				else if (response == 'Sent Showing Request.') {
					hide_request_showing_popup();
					if (typeof(_gaq) !== 'undefined') {
						_gaq.push(['_trackEvent', 'Displet RETS/IDX', 'Showing Request', displetretsidx.user.email]);
					}
					else if (typeof(ga) !== 'undefined') {
						ga('send', 'event', 'Displet RETS/IDX', 'Showing Request', displetretsidx.user.email);
					}
				}
			}
			else {
				alert(response);
			}
			$('#displet-request-showing-popup .displet-loading, #displet-property-details-popups .displet-request-showing-popup .displet-loading').hide();
		});
	}

	/*********************
	Listings Instance
	*********************/

	this.displetretsidx_listings = function(args){
		var self = this;
		this.id = args.id;
		this.original_query_args;
		this.query_args = args.query_args;

		function init() {
			hide_hidden_listings();
			set_original_query_args();
			set_conditional_vars();
			set_selectors();
			set_defaults();
			maybe_set_map();
			create();
		}

		function create() {
			if (displetretsidx.pages.is_search_results_page) {
				displetretsidx.search = new displetretsidx_search();
			}
			if (displetretsidx.event_state && displetretsidx.event_state.id === self.id) {
				self.pop_state();
			}
			else if (displetretsidx.pages.is_search_results_page && window.location.hash && window.location.hash.indexOf('status=unavailable') === -1) {
				self.run_search_from_hash(true);
			}
			else if (self.sort_was_changed) {
				get_listings();
			}
			else {
				set_initial_permalinks();
				store_query_for_property_details_page_pagination();
				store_page_for_property_details_pagination();
				maybe_setup_new_map();
				maybe_set_map_data();
				maybe_update_map();
			}
			if (self.total_count > 0) {
				add_sort_binding();
				add_resize_binding();
				add_pagination_binding();
				add_numbered_pagination_binding();
				if (self.has_property_type_navigation){
					add_property_type_binding();
				}
				if (self.has_price_navigation) {
					add_price_navigation_binding();
				}
				if (self.is_dynamic_view) {
					self.rpp = self.last_count;
					add_view_binding();
					size_listings();
					adjust_rpp();
					clear_float();
					setTimeout(function(){
						hovertrans();
					}, 1000);
				}
				else if (self.is_table_view) {
					add_hover_image_binding();
					add_status_view_binding();
				}
				if (displetretsidx.wp.is_search_results_page || displetretsidx.wp.is_mobile_search_results_page){
					if (!window.location.hash || window.location.hash.indexOf('view=') === -1) {
						self.set_view();
					}
				}
				else if (self.is_dynamic_view){
					self.set_view();
				}
				if (!displetretsidx.is_ie) {
					history.replaceState(get_state(), '');
				}
				end_new_search();
			}
			else {
				self.elements.first_count.html('0');
				self.elements.last_count.html('0');
				self.elements.total_count.html('0');
			}
		}

		function add_hover_image_binding() {
			var is_showing = false;
			var hover_menu_on_timeout;
			self.elements.all_listings.hover(
				function(){
					clearTimeout(hover_menu_on_timeout);
					clearTimeout(this.hover_menu_off_timeout);
					var y_position = $(this).offset().top - self.elements.listings_parent.offset().top;
					$(this).find('.displet-hover-container').css('top', y_position);
					if (is_showing) {
						var this_self = this;
						hover_menu_on_timeout = setTimeout(function(){
							self.elements.hover_container.not(this_self).hide();
							$(this_self).find('.displet-hover-container').show();
							is_showing = true;
						}, 500);
					}
					else{
						$(this).find('.displet-hover-container').show();
						is_showing = true;
					}
				},
				function(){
					var this_self = this;
					this.hover_menu_off_timeout = setTimeout(function(){
						$(this_self).find('.displet-hover-container').hide();
						is_showing = false;
					}, 500);
				}
			);
		}

		function add_map_polygon(polygon) {
			remove_map_polygon();
			start_new_search();
			self.polygon = polygon;
			self.polygon_lat_longs = self.polygon.getPath().getArray();
			set_poly_query_args();
			add_map_polygon_close_button();
			google.maps.event.addListener(self.polygon.getPath(), 'set_at', reposition_map_polygon);
  			google.maps.event.addListener(self.polygon.getPath(), 'insert_at', reposition_map_polygon);
  			self.drawing_manager.setOptions({
  				drawingMode: null,
  			});
		}

		function add_map_polygon_binding() {
			google.maps.event.addListener(self.drawing_manager, 'overlaycomplete', function(event) {
				add_map_polygon(event.overlay);
				get_listings();
				push_state();
				end_new_search();
			});
		}

		function add_map_polygon_close_button() {
			if (self.polygon_lat_longs && $.isArray(self.polygon_lat_longs)) {
				self.polygon_close_button = new google.maps.Marker({
					position: self.polygon_lat_longs[0],
					map: self.map,
					icon: {
						anchor: new google.maps.Point(10, 26),
						url: displetretsidx.images.close,
					},
					zIndex: 2222,
  				});
  				google.maps.event.addListener(self.polygon_close_button, 'click', remove_map_polygon);
  				google.maps.event.addListener(self.polygon_close_button, 'mouseover', function(){
  					self.polygon_close_button.setIcon({
						anchor: new google.maps.Point(10, 26),
						url: displetretsidx.images.close_hover,
					});
  				});
  				google.maps.event.addListener(self.polygon_close_button, 'mouseout', function(){
  					self.polygon_close_button.setIcon({
						anchor: new google.maps.Point(10, 26),
						url: displetretsidx.images.close,
					});
  				});
			}
		}

		function add_numbered_pagination_binding() {
			$('.displet-numbered-page', args.scope).click(function(ev){
				ev.preventDefault();
				var page = $(this).attr('for');
				if (page) {
					go_to_page(parseInt(page));
				}
				return false;
			});
			$('.displet-numbered-pagination-select', args.scope).bind('change', function(){
				var page = $(this).children('option:selected').attr('for');
				if (page) {
					go_to_page(parseInt(page));
				}
			});
		}

		function add_pagination_binding() {
			$(self.elements.next_link).click(function (ev) {
				ev.preventDefault();
				next_page();
				return false;
			});
			$(self.elements.previous_link).click(function (ev) {
				ev.preventDefault();
				prev_page();
				return false;
			});
		}

		function add_price_navigation_binding() {
			self.elements.price_links.click(function(){
				if (!$(this).hasClass('active')) {
					$('#displet-price-navigation .displet-price-navigation.active', args.scope).removeClass('active');
					update_prices($(this).attr('displetminprice'), $(this).attr('displetmaxprice'));
					$(this).addClass('active');
				}
			});
		}

		function add_property_type_binding() {
			self.elements.property_type_links.click(function(){
				if (!$(this).hasClass('active')) {
					update_property_type($(this).attr('displetpropertytype'));
				}
			});
		}

		function add_resize_binding() {
			var resize_timer;
			$(window).resize(function(){
				clearTimeout(resize_timer);
				resize_timer = setTimeout(function(){
					if (self.is_dynamic_view) {
						size_listings();
						adjust_rpp();
						clear_float();
						hovertrans();
					}
				}, 100);
			});
		}

		function add_search_tag_binding() {
			$('.displet-remove-search-tag', self.scope).click(function(){
				var regex = new RegExp( this.name + '=([^\/])*(\/)?', 'g' );
				displetretsidx.search.update_search_hash(window.location.hash.replace(regex, ''));
				self.run_search_from_hash();
			});
		}

		function add_sort_binding() {
			self.elements.sort_select.bind('change', function (ev) {
				if (this.value) {
					var previous_sort = get_sort_as_string();
					if (args.data_from === 'property_showcase' || displetretsidx.is_displet_api) {
						if (this.value === 'price-descending' || this.value === 'price-ascending' || this.value === 'date-descending' || this.value === 'date-ascending') {
							if (this.value.indexOf('date') !== -1) {
								self.query_args.sort_by = 'list_date';
							}
							else {
								self.query_args.sort_by = 'list_price';
							}
							if (this.value.indexOf('ascending') !== -1) {
								self.query_args.direction = 'asc';
							}
							else {
								self.query_args.direction = 'desc';
							}
						}
						else if (displetretsidx.is_displet_api) {
							update_property_type(this.value);
						}
					}
					else {
						if (this.value === 'price-ascending') {
							self.query_args.sort = 'price';
						}
						else if (this.value === 'date-ascending') {
							self.query_args.sort = 'ctime';
						}
						else if (this.value === 'date-descending') {
							self.query_args.sort = 'ctime_reverse';
						}
						else {
							self.query_args.sort = 'price_reverse';
						}
					}
					var new_sort = get_sort_as_string();
					if (new_sort !== previous_sort) {
						start_new_search();
						get_listings();
						push_state();
						end_new_search();
					}
					if (typeof(new_sort) !== 'undefined') {
						displetretsidx.set_cookie('displetretsidx_last_viewed_sort', new_sort);
					}
				}
			});
		}

		function add_status_view_binding() {
			self.elements.status_tabs.click(function(){
				if (!$(this).hasClass('displet-active')) {
					var status = $(this).attr('for');
					self.elements.status_tabs.removeClass('displet-active');
					$(this).addClass('displet-active');
					self.elements.status_tables.hide();
					$('.displet-table-view[for="' + status + '"]', self.elements.table_parent).show();
				}
			});
		}

		function add_view_binding() {
			self.elements.list_view_link.click(function() {
				if (!$(this).hasClass('current')) {
					self.show_vertical();
				}
			});
			self.elements.map_view_link.click(function() {
				if (!$(this).hasClass('current')) {
					self.show_map();
				}
			});
			if (!displetretsidx.wp.is_mobile_search_results_page && !displetretsidx.wp.is_mobile_property_details_page) {
				self.elements.tile_view_link.click(function() {
					if (!$(this).hasClass('current')) {
						self.show_tile();
					}
				});
			}
		}

		function adjust_rpp() {
			if (self.listings_per_row != 0 && !displetretsidx.wp.is_mobile_search_results_page && !displetretsidx.wp.is_mobile_property_details_page) {
				while (self.rpp % self.listings_per_row != 0) {
					self.rpp++;
				}
			}
		}

		function build_query_from_hash(parameter, value) {
			if (value) {
				value = decodeURIComponent(value);
			}
			if (displetretsidx.is_displet_api) {
				if (parameter === 'city') {
					if (!displetretsidx.options.city_include_filter || $.inArray(value, displetretsidx.options.city_include_filter) !== -1) {
						self.query_args[parameter] = value;
					}
				}
				else if (parameter === 'max_list_price') {
					if (!displetretsidx.options.max_price_filter || value <= displetretsidx.options.max_price_filter) {
						self.query_args[parameter] = value;
					}
				}
				else if (parameter === 'min_list_price') {
					if (!displetretsidx.options.min_price_filter || value >= displetretsidx.options.min_price_filter) {
						self.query_args[parameter] = value;
					}
				}
				else if (parameter === 'property_type') {
					if (!displetretsidx.options.property_type_include_filter || $.inArray(value, displetretsidx.options.property_type_include_filter) !== -1) {
						self.query_args[parameter] = value;
					}
				}
				else if (parameter === 'zip') {
					if (!displetretsidx.options.zip_code_include_filter || $.inArray(value, displetretsidx.options.zip_code_include_filter) !== -1) {
						self.query_args[parameter] = value;
					}
				}
				else {
					self.query_args[parameter] = value;
				}
			}
			else{
				var translated_array = translate_query_parameter(new Array(parameter));
				if (translated_array[0] == 'attributes') {
					if (parameter === 'min_list_price') {
						self.price_min = value * 1000;
					}
					else if (parameter === 'max_list_price') {
						self.price_max = value * 1000;
					}
					else if (parameter === 'min_square_feet') {
						self.square_feet_min = value;
					}
					else if (parameter === 'max_square_feet') {
						self.square_feet_max = value;
					}
					else if (parameter === 'min_bedrooms' || parameter === 'min_bathrooms'){
						self.current_query_attributes += translated_array[1] + '_' + value + '+,';
					}
					else if (parameter === 'max_bedrooms' || parameter === 'max_bathrooms'){
						self.current_query_attributes += translated_array[1] + '_' + value + '-,';
					}
					else if (parameter === 'pool_on_property' && (value.toLowerCase() === 'y' || value.toLowerCase() === 'yes')) {
						self.current_query_attributes += 'amenities_' + translated_array[1] + ',';
					}
					else if (parameter === 'is_gated_community' && (value.toLowerCase() === 'y' || value.toLowerCase() === 'yes')) {
						self.current_query_attributes += 'amenities_' + translated_array[1] + ',';
					}
					else{
						self.current_query_attributes += translated_array[1] + '_' + value + ',';
					}
				}
				else if (translated_array[0] === 'q') {
					self.current_query_qs += value + ',';
				}
				else {
					if (translated_array[0] === 'location') {
						self.query_args.radius = '0';
					}
					else if (translated_array[0] === 'category') {
						var current_category = displetretsidx.options.category;
						if (current_category == '') {
							current_category = 'housing/sale';
						}
						value = value.toLowerCase();
						if (value == 'house') {
							current_category += '/home';
						}
						else if (value == 'condo') {
							current_category += '/condo';
						}
						else if (value == 'commercial') {
							current_category += '/commercial';
						}
						else if (value == 'mobile') {
							current_category += '/mobile';
						}
						else if (value == 'vacation') {
							current_category += '/vacation';
						}
						else if (value == 'other') {
							current_category += '/other';
						}
						else if (value == 'open_house') {
							current_category += '/open_house';
						}
						else if (value == 'storage') {
							current_category += '/storage';
						}
						else if (value == 'land') {
							current_category = 'housing/sale/land';
						}
						else if (value == 'multi') {
							current_category = 'housing/sale/multi_family';
						}
						else if (value == 'ranch') {
							current_category = 'housing/sale/farm';
						}
						else if (value == 'lease') {
							current_category = 'housing/rent';
						}
						else if (value == 'apartment') {
							current_category = 'housing/rent/apartment';
						}
						else if (value == 'garage') {
							current_category = 'housing/rent/garage';
						}
						else if (value == 'roommates') {
							current_category = 'housing/rent/roommates';
						}
						else if (value == 'short_term') {
							current_category = 'housing/rent/short_term';
						}
						else if (translated_array[1] == 'foreclosure') {
							current_category = 'housing/sale/foreclosure';
						}
						value = current_category;
					}
					self.query_args[translated_array[0]] = value;
				}
			}
		}

		function clear_float() {
			if (!displetretsidx.wp.is_mobile_search_results_page && !displetretsidx.wp.is_mobile_property_details_page) {
				var i = 1;
				var rowlength = self.listings_per_row;
				$(self.elements.tile_listings).each(function(){
					$(this).removeClass('displet-clear');
					if (i % rowlength == 1) {
						$(this).addClass('displet-clear');
					}
					i++;
				});
			}
		}

		function end_new_search() {
			set_search_tags();
			store_query_for_property_details_page_pagination();
		}

		function get_count_from_element(element) {
			return Number($(element[0]).text().replace(/[,]/g, ''));
		}

		function get_last_page() {
			var listing_total = get_count_from_element(self.elements.total_count);
			return Math.ceil(listing_total / self.listings_per_page);
		}

		function get_listings() {
			loading();
			if (args.data_from === 'property_showcase') {
				var data = {
					action: 'displet_get_property_showcase_listings_request',
					_ajax_nonce: displetretsidx.nonces.get_property_showcase_listings,
					residential_args: self.query_args,
				};
				$.ajax({
					type: "POST",
					url: displetretsidx.urls.ajax,
					data: data,
					dataType: 'json',
					success: function(response) {
						self.query_data = response;
						update_html();
					},
				});
			}
			else {
				$.getJSON(get_query_url(), null, function(data){
					self.query_data = data;
					update_html();
				}).error(function(data){
					self.query_data = data;
					report_error();
					unloading();
				});
			}
		}

		function get_numbered_pagination_link(url, page) {
			var el_class = page == self.page ? ' displet-current-page' : '';
			return '<a href="' + url + 'page/' + page + '" class="displet-numbered-page' + el_class + '" for="' + page + '">' + number_format( page ) + '</a>' + "\n";
		}

		function get_numbered_pagination_option(url, page, text) {
			var selected = page == self.page ? 'selected="selected"' : '';
			return '<option value="' + url + 'page/' + page + '" ' + selected + '" for="' + page + '">' + text + number_format( page ) + '</option>' + "\n";
		}

		function get_pageless_current_url() {
			var current_url = window.location.href;
			var matches = current_url.match(/\/page[\/]/i);
			if (matches && matches.index) {
				current_url = current_url.substring(0, matches.index);
			}
			else{
				var hash_matches = current_url.match(/[#]/i);
				if (hash_matches && hash_matches.index) {
					current_url = current_url.substring(0, hash_matches.index);
				}
			}
			return trailing_slash_it(current_url);
		}

		function get_query_url() {
			if (displetretsidx.is_displet_api) {
				var url = 'http://api.displet.com/residentials/search?' + $.param(self.query_args) + '&callback=?';
			}
			else {
				var url = 'http://api.oodle.com/api/v2/listings?' + $.param(self.query_args);
			}
			console.log(url);
			return url;
		}

		function get_sort_as_string() {
			if (displetretsidx.is_displet_api || args.data_from === 'property_showcase') {
				return self.query_args.sort_by + '_' + self.query_args.direction;
			}
			else {
				return self.query_args.sort;
			}
		}

		function get_state() {
			return state = {
				displetretsidx_listings: self.query_args,
				id: args.id,
			}
		}

		function geocode_address(listing, address){
			if (address) {
				if (typeof(self.geocode_timeout_time) === 'undefined' || self.geocode_timeout_time < new Date().getTime() - 1000) {
					maybe_set_geocoder();
    				displetretsidx.geocoder.geocode({'address': address}, function(results, status) {
						if (status == google.maps.GeocoderStatus.OK) {
							plot_listing(listing, results[0].geometry.location);
						}
						else {
							if (status === 'OVER_QUERY_LIMIT') {
								self.geocode_timeout_time = new Date().getTime();
								var timeout = setTimeout(function(){
									geocode_address(listing, address);
								}, 1000);
								self.geocode_timeouts.push(timeout);
							}
						}
    				});
				}
				else {
					var timeout = setTimeout(function(){
						geocode_address(listing, address);
					}, 1000);
					self.geocode_timeouts.push(timeout);
				}
			}
		}

		function go_to_page(page) {
			if (page != self.page && page_exists(page)) {
				if (displetretsidx.is_displet_api && args.data_from !== 'property_showcase' && displetretsidx.options.results_limit) {
					var requested_max = page * self.listings_per_page;
					if (requested_max > displetretsidx.options.results_limit) {
						self.partial = displetretsidx.options.results_limit + self.listings_per_page - requested_max;
						if (self.partial < 1) {
							alert('We\'re sorry, the maximum number of results has been reached. Please narrow your search criteria.');
							return false;
						}
					}
					else {
						self.partial = false;
					}
				}
				set_page_to(page);
				get_listings();
				push_state();
			}
		}

		function hide_hidden_listings() {
			$('.displet-none', args.scope).hide().removeClass('displet-none');
		}

		function hovertrans() {
			if ((self.elements.hovertrans.length || self.elements.hovertrans_text.length) && !displetretsidx.wp.is_mobile_search_results_page && !displetretsidx.wp.is_mobile_property_details_page) {
				$.each(self.elements.all_listings, function(){
					var hovertrans = $(this).children('.displet-hovertrans');
					$(hovertrans).height($(this).innerHeight());
					var width = $(this).innerWidth();
					if ($(this).hasClass('displet-vertical-listing')) {
						width--;
					}
					$(hovertrans).width(width);
					$(this).hover(
						function () {
							$(this).children('.displet-hovertrans').stop(true, true).fadeIn(200);
							$(this).children('.displet-text-overlay-hovertrans').stop(true, true).fadeIn(200);
							$(this).children('.displet-text-overlay').stop(true, true).fadeOut(200);
						},
						function () {
							$(this).children('.displet-hovertrans').stop(true, true).fadeOut(200);
							$(this).children('.displet-text-overlay-hovertrans').stop(true, true).fadeOut(200);
							$(this).children('.displet-text-overlay').stop(true, true).fadeIn(200);
						}
					);
				});
			}
		}

		function is_sort_different() {
			if (displetretsidx.cookies.last_viewed_sort && displetretsidx.cookies.last_viewed_sort !== get_sort_as_string()) {
				return true;
			}
			return false;
		}

		function is_sort_from_cookie_a_match_for_data() {
			if (displetretsidx.cookies.last_viewed_sort) {
				if (args.data_from === 'property_showcase' || displetretsidx.is_displet_api) {
					if (displetretsidx.cookies.last_viewed_sort === 'list_date_asc' || displetretsidx.cookies.last_viewed_sort === 'list_date_desc' || displetretsidx.cookies.last_viewed_sort === 'list_price_desc' || displetretsidx.cookies.last_viewed_sort === 'list_price_asc') {
						return true;
					}
				}
				else {
					if (displetretsidx.cookies.last_viewed_sort === 'price' || displetretsidx.cookies.last_viewed_sort === 'price_reverse' || displetretsidx.cookies.last_viewed_sort === 'ctime' || displetretsidx.cookies.last_viewed_sort === 'ctime_reverse') {
						return true;
					}
				}
			}
			return false;
		}

		function loading() {
			self.elements.listings_loading.show();
		}

		function maybe_draw_polygon() {
			if (self.query_args.poly) {
				var poly_coordinates = self.query_args.poly.split(',');
				if (poly_coordinates.length) {
					var poly_paths = [];
					for (var i = 0; i < poly_coordinates.length; i++) {
						var lat_long = poly_coordinates[i].split(' ');
						var g_lat_long = new google.maps.LatLng(parseFloat(lat_long[1]), parseFloat(lat_long[0]));
						poly_paths.push(g_lat_long);
					};
					self.polygon_options.paths = poly_paths;
  					var polygon = new google.maps.Polygon(self.polygon_options);
  					polygon.setMap(self.map);
  					add_map_polygon(polygon);
				}
			}
			else {
				remove_map_polygon();
			}
		}

		function maybe_geocode_listing(listing) {
			if (self.is_dynamic_view && self.map && (typeof(listing.latitude) === 'undefined' || typeof(listing.longitude) === 'undefined' || !listing.latitude || !listing.longitude)) {
				if (typeof(listing.address) !== 'undefined' && listing.address) {
					var address = listing.address;
					if (typeof(listing.city) !== 'undefined' && listing.city) {
						address += ', ' + listing.city;
					}
					if (typeof(listing.state) !== 'undefined' && listing.state) {
						address += ', ' + listing.state;
					}
					if (typeof(listing.zip) !== 'undefined' && listing.zip) {
						address += ', ' + listing.zip;
					}
					geocode_address(listing, address);
				}
			}
		}

		function maybe_set_drawing_manager() {
			if (displetretsidx.options.use_polygon_search && displetretsidx.pages.is_search_results_page && displetretsidx.is_displet_api) {
				self.polygon_options = {
					fillColor: '#f00',
					fillOpacity: .3,
					strokeColor: '#f00',
					strokeOpacity: .8,
					strokeWeight: 1,
					editable: true,
				};
				self.drawing_manager = new google.maps.drawing.DrawingManager({
					drawingControlOptions: {
						drawingModes: [
							google.maps.drawing.OverlayType.POLYGON,
						],
					},
					polygonOptions: self.polygon_options,
				});
				if (self.drawing_manager) {
					self.drawing_manager.setMap(self.map);
					add_map_polygon_binding();
				}
				/*
				google.maps.event.addListener(self.map, 'mousemove', function(event) {
					if (self.drawing_manager.getDrawingMode() === 'POLYGON') {
			        	var overlay = new google.maps.OverlayView();
			        	overlay.draw = function() {};
			        	overlay.setMap(self.map);
			        	var point = self.map.getCenter();
			        	var projection = overlay.getProjection();
			        	var pixelpoint = projection.fromLatLngToDivPixel(point);
			        	var thelatlng = event.latLng;
			        	var proj = overlay.getProjection();
			        	var thepix = proj.fromLatLngToDivPixel(thelatlng);
			        	var mapBounds = self.map.getBounds();
			        	var mB_NE = mapBounds.getNorthEast();
			        	var mB_SW = mapBounds.getSouthWest();
						var nE = proj.fromLatLngToDivPixel(mB_NE);
			        	var sW = proj.fromLatLngToDivPixel(mB_SW);
						var north = nE.y;
			        	var east = nE.x;
			        	var south = sW.y;
			        	var west = sW.x;
			        	var appx_north, appx_east, appx_south, appx_west = false;
			        	if (Math.round(thepix.y) <= Math.round(north+20)) {appx_north = true;}
			        	if (Math.round(thepix.x) >= Math.round(east-20)) {appx_east = true;}
			        	if (Math.round(thepix.y) >= Math.round(south-20)) {appx_south = true;}
			        	if (Math.round(thepix.x) <= Math.round(west+20)) {appx_west = true;}
			        	if (appx_north) {
			        	    pixelpoint.y -= 5;
			        	    point = projection.fromDivPixelToLatLng(pixelpoint);
			        	    self.map.setCenter(point);
			        	}
			        	if (appx_east) {
			        	    pixelpoint.x += 5;
			        	    point = projection.fromDivPixelToLatLng(pixelpoint);
			        	    self.map.setCenter(point);
			        	}
			        	if (appx_south) {
			        	    pixelpoint.y += 5;
			        	    point = projection.fromDivPixelToLatLng(pixelpoint);
			        	    self.map.setCenter(point);
			        	}
			        	if (appx_west) {
			        	    pixelpoint.x -= 5;
			        	    point = projection.fromDivPixelToLatLng(pixelpoint);
			        	    self.map.setCenter(point);
			        	}
					}
				});
				*/
			}
		}

		function maybe_set_map() {
			if (self.is_dynamic_view) {
				if ($('#displetretsidx_canvas', args.scope).length) {
					var google_canvas = $('#displetretsidx_canvas', args.scope)[0];
				}
				else if ($('#map_canvas', args.scope).length) { // Legacy template usage
					var google_canvas = $('#map_canvas', args.scope)[0];
				}
				else {
					var google_canvas = false;
				}
				if (google_canvas) {
					self.map = new google.maps.Map(google_canvas, {
						zoom: 12,
						mapTypeId: google.maps.MapTypeId.ROADMAP
					});
					maybe_set_drawing_manager();
				}
			}
		}

		function maybe_set_map_data() {
			if (self.is_dynamic_view && args.listings.length && self.map) {
				for (var i = 0; i < args.listings.length; i++) {
					if (typeof(args.listings[i].latitude) !== 'undefined' && typeof(args.listings[i].longitude) !== 'undefined' && args.listings[i].latitude && args.listings[i].longitude) {
						self.lat_total += parseFloat(args.listings[i].latitude);
						self.long_total += parseFloat(args.listings[i].longitude);
						self.map_listings_array.push(args.listings[i]);
					}
					else {
						maybe_geocode_listing(args.listings[i]);
					}
				};
			}
		}

		function maybe_setup_new_map() {
			if (self.is_dynamic_view && self.map) {
				remove_geocode_timeouts();
				remove_map_markers();
				set_map_defaults();
				set_bounds();
				set_infowindow();
			}
		}

		function maybe_update_map() {
			if (self.is_dynamic_view && self.map && self.map_listings_array.length && self.elements.map) {
				var lat_average = self.lat_total / self.map_listings_array.length;
				var long_average = self.long_total / self.map_listings_array.length;
				var min_lat = lat_average - displetretsidx.options.map_variance;
				var max_lat = lat_average + displetretsidx.options.map_variance;
				var min_long = long_average - displetretsidx.options.map_variance;
				var max_long = long_average + displetretsidx.options.map_variance;
				for (var i = 0; i < self.map_listings_array.length; i++){
					if (self.map_listings_array[i].latitude > min_lat && self.map_listings_array[i].latitude < max_lat && self.map_listings_array[i].longitude > min_long && self.map_listings_array[i].longitude < max_long) {
						var location = new google.maps.LatLng(self.map_listings_array[i].latitude, self.map_listings_array[i].longitude);
						plot_listing(self.map_listings_array[i], location);
					}
				}
			}
		}

		function maybe_update_numbered_pagination_urls() {
			if (self.has_numbered_pagination || self.has_numbered_pagination_select) {
				var pages = [];
				var url = trailing_slash_it(get_pageless_current_url());
				var last_page = get_last_page();
				if (last_page > 7) {
					if (self.page < 3) {
						var start = 1;
					}
					else if (self.page + 4 > last_page) {
						var start = last_page - 5;
					}
					else {
						var start = self.page - 2;
					}
					var limit = start + 4;
				}
				else {
					var start = 1;
					var limit = last_page;
				}
				if (start !== 1) {
					pages.push(1);
				}
				for (var i = start; i <= limit; i++) {
					pages.push(i);
				}
				if (limit !== last_page) {
					pages.push(last_page);
				}
				if (pages.length) {
					if (self.has_numbered_pagination) {
						var pagination_markup = '';
					}
					if (self.has_numbered_pagination_select) {
						var pagination_options = '';
						var first_option = self.elements.numbered_pagination_select.find('option').first();
						var first_option_for = first_option.attr('for');
						var first_option_text = first_option.text();
						var prepend_text = first_option_text.substr(-1) === first_option_for ? first_option_text.substr(0, first_option_text.length - 1) : '';
					}
					var last_page = 0;
					for (var i = 0; i < pages.length; i++) {
						if (pages[i] - last_page > 1) {
							if (self.has_numbered_pagination) {
								pagination_markup += '<span>...</span>';
							}
							if (self.has_numbered_pagination_select) {
								pagination_options += '<option disabled>...</option>';
							}
						}
						if (self.has_numbered_pagination) {
							pagination_markup += get_numbered_pagination_link(url, pages[i]);
						}
						if (self.has_numbered_pagination_select) {
							pagination_options += get_numbered_pagination_option(url, pages[i], prepend_text);
						}
						last_page = pages[i];
					};
					if (self.has_numbered_pagination) {
						self.elements.numbered_pagination_container.html(pagination_markup);
						self.elements.numbered_pagination_container.html(pagination_markup);
					}
					if (self.has_numbered_pagination_select) {
						self.elements.numbered_pagination_select.html(pagination_options);
					}
					add_numbered_pagination_binding();
				}
			}
		}

		function next_page() {
			go_to_page(self.page + 1);
		}

		function normalize_listing(listing){
			if (args.data_from === 'property_showcase') {
			}
			else if (displetretsidx.is_displet_api) {
				listing.address = get_listing_address(listing);
				if (listing.half_baths != undefined && listing.half_baths != '') {
					var half_baths = '/' + listing.half_baths;
				}
				else{
					var half_baths = '';
				}
				if (listing.full_baths != undefined && listing.full_baths != ''){
					listing.bathrooms = listing.full_baths + half_baths;
				}
			}
			else{
				listing.image_urls = {};
				if (listing.images != undefined && listing.images[0] != undefined && listing.images[0].src != undefined) {
					listing.image_urls.primary_big = listing.images[0].src;
				}
				listing.list_price = listing.attributes.price;
				listing.address = listing.location.address;
				listing.city = listing.location.name;
				listing.state = listing.location.state;
				listing.zip = listing.location.zip;
				listing.num_bedrooms = listing.attributes.bedrooms;
				listing.bathrooms = listing.attributes.bathrooms;
				listing.square_feet = listing.attributes.square_feet;
				listing.property_type = listing.category.name.replace('Houses', 'House').replace('Condos, Townhouses & Apts for Sale', 'Condo / Townhouse / Apt');
				listing.mls_number = listing.attributes.mls_id;
				listing.internet_remarks = listing.body;
				listing.latitude = listing.location.latitude;
				listing.longitude = listing.location.longitude;
			}
			if (!displetretsidx.is_displet_api && listing.internet_remarks) {
				var phone = /([0-9]{3})[-. ]?([0-9]{4})/g;
				var email = /([\S]+)@([\S]+)/g;
				var website = /([\S]+)\.com([\S]+)/g;
				var new_body = listing.internet_remarks.replace(phone, 'XXX-XXXX').replace(email, 'XXXX@XXXX').replace(website, 'http://.com');
				// Limit length of remarks
				var truncated_body_array = new_body.split(/\s+/, 48);
				var complete_body_array = new_body.split(/\s+/);
				if (complete_body_array.length > truncated_body_array.length) {
					listing.internet_remarks = truncated_body_array.join(' ') + ' ...';
				}
				else{
					listing.internet_remarks = new_body;
				}
			}
			maybe_geocode_listing(listing);
			return listing;
		}

		function normalize_meta() {
			if (args.data_from === 'property_showcase') {
				self.query_data.results = self.query_data.listings;
			}
			else if (displetretsidx.is_displet_api) {
				self.query_data.meta.first = parseInt(self.query_data.meta.limit) * parseInt(self.query_data.meta.page) - parseInt(self.query_data.meta.limit) + 1;
				if (self.partial) {
					self.query_data.meta.last = self.query_data.meta.first + self.partial - 1;
				}
				else{
					self.query_data.meta.last = parseInt(self.query_data.meta.first) + parseInt(self.query_data.meta.limit) - 1;
				}
				if (self.query_data.meta.count < self.query_data.meta.last) {
					self.query_data.meta.last = self.query_data.meta.count;
				}
				self.query_data.meta.pages = Math.ceil(self.query_data.meta.count/self.query_data.meta.limit);
			}
			else{
				self.query_data.meta.count = self.query_data.meta.total;
				self.query_data.results = self.query_data.listings;
			}
		}

		function page_exists(page) {
			page = parseInt(page);
			var last_page = get_last_page();
			if (page >= 1 && page <= last_page) {
				return true;
			}
			return false;
		}

		function plot_listing(listing, location) {
			var marker = new google.maps.Marker({
				address: listing.address,
				agent: listing.listing_agent_name,
				baths: listing.bathrooms,
				beds: listing.num_bedrooms,
				map: self.map,
				mls_number: listing.mls_number,
				office: listing.listing_office_name,
				photo: listing.image_urls.primary_big,
				position: location,
				price: listing.list_price,
				subdivision: listing.subdivision,
				sqft: listing.square_feet,
				url: listing.permalink,
			});
			self.markers.push(marker);
			google.maps.event.addListener(marker, 'click', function() {
				show_infowindow(this);
			});
			self.bounds.extend(location);
			self.map.fitBounds(self.bounds);
		}

		function push_state(replace_state) {
			if (history.pushState) {
				if (!replace_state) {
					replace_state = false;
				}
				var current_page_url = get_pageless_current_url();
				if (self.page === 1) {
					var current_url = current_page_url + window.location.hash;
				}
				else{
					var current_url = current_page_url + 'page/' + self.page + '/' + window.location.hash;
				}
				if (replace_state && !displetretsidx.is_ie) {
					history.replaceState(get_state(), '', current_url);
				}
				else{
					history.pushState(get_state(), '', current_url);
				}
			}
		}

		this.pop_state = function() {
			if (displetretsidx.event_state.id === self.id) {
				if (JSON.stringify(self.query_args) !== JSON.stringify(displetretsidx.event_state.displetretsidx_listings) || self.sort_was_changed) {
					self.query_args = displetretsidx.event_state.displetretsidx_listings;
					set_search_tags();
					get_listings();
					maybe_draw_polygon();
				}
			}
		}

		function prev_page() {
			go_to_page(self.page - 1);
		}

		function remove_geocode_timeouts() {
			if (typeof(self.geocode_timeouts) !== 'undefined' && self.geocode_timeouts.length) {
				for (var i = 0; i < self.geocode_timeouts.length; i++) {
					clearTimeout(self.geocode_timeouts[i]);
				};
			}
		}

		function remove_map_markers() {
			if (typeof(self.markers) !== 'undefined' && self.markers.length) {
				for (var i = 0; i < self.markers.length; i++) {
					self.markers[i].setMap(null);
				};
			}
		}

		function remove_map_polygon_close_button() {
			if (self.polygon_close_button) {
				self.polygon_close_button.setMap(null);
			}
		}

		function remove_map_polygon() {
			if (self.query_args.poly) {
				delete self.query_args.poly;
			}
			if (self.polygon) {
				self.polygon.setMap(null);
			}
			remove_map_polygon_close_button();
		}

		function report_error() {
			var alert_string = 'We\'re sorry, there was an error processing your request';
			if (this.query_data.responseText && this.query_data.responseText.indexOf('Rate limit') !== -1) {
				alert_string += ': the free version has reached its maximum daily request limit. Please try again at a later time.';
			}
			else{
				alert_string += '.';
			}
			alert(alert_string);
		}


  		function reposition_map_polygon(index) {
  			remove_map_polygon_close_button();
			start_new_search();
  			self.polygon_lat_longs = this.getArray();
			set_poly_query_args();
  			add_map_polygon_close_button();
  			get_listings();
  			push_state(true);
			end_new_search();
		}

		function reset_listing_permalinks() {
			if (should_store_property_details_pagination_data()) {
				window.sessionStorage.displetretsidx_search_results_permalinks = '';
			}
		}

		this.run_search_from_hash = function(is_initial_load){
			if (displetretsidx.is_displet_api) {
				var current_sort_by = this.query_args.sort_by;
				var current_direction = this.query_args.direction;
			}
			else {
				var current_sort = this.query_args.sort;
			}
			var poly = this.query_args.poly ? this.query_args.poly : false;
			this.query_args = JSON.parse(JSON.stringify(this.original_query_args));
			if (poly) {
				this.query_args.poly = poly;
				this.query_args.limit = 50;
				this.listings_per_page = 50;
			}
			else {
				set_listings_per_page();
			}
			if (displetretsidx.is_displet_api) {
				this.query_args.sort_by = current_sort_by;
				this.query_args.direction = current_direction;
			}
			else {
				this.query_args.sort = current_sort;
			}
			var url_hash = window.location.hash;
			if (url_hash) {
				var hash_array = url_hash.replace('#', '').split('/');
				if (!displetretsidx.is_displet_api && args.data_from !== 'property_showcase') {
					this.current_query_attributes = this.current_query_qs = this.price_min = this.price_max = this.square_feet_min = this.square_feet_max = '';
				}
				for (var i = hash_array.length - 1; i >= 0; i--) {
					var current_hash = hash_array[i].split('=');
					var current_parameter = current_hash[0];
					var current_value = current_hash[1];
					if (current_parameter && current_value && current_parameter !== 'view') {
						build_query_from_hash(current_parameter, current_value);
					}
				};
				if (!displetretsidx.is_displet_api && args.data_from !== 'property_showcase') {
					if (this.price_min != '' && this.price_max != '') {
						this.current_query_attributes += 'price_' + this.price_min + '_' + this.price_max + ',';
					}
					else if (this.price_min != '') {
						this.current_query_attributes += 'price_' + this.price_min + '+' + ',';
					}
					else if (this.price_max != '') {
						this.current_query_attributes += 'price_' + this.price_max + '-' + ',';
					}
					if (this.square_feet_min != '' && this.square_feet_max != '') {
						this.current_query_attributes += 'square_feet_' + this.square_feet_min + '_' + this.square_feet_max + ',';
					}
					else if (this.square_feet_min != '') {
						this.current_query_attributes += 'square_feet_' + this.square_feet_min + '+' + ',';
					}
					else if (this.square_feet_max != '') {
						this.current_query_attributes += 'square_feet_' + this.square_feet_max + '-' + ',';
					}
					if (this.current_query_attributes != '') {
						this.query_args.attributes = this.current_query_attributes.slice(0,-1);
					}
					if (this.current_query_qs != '') {
						this.query_args.q = this.current_query_qs.slice(0,-1);
					}
				}
			}
			if (!is_initial_load) {
				start_new_search();
			}
			get_listings();
			push_state(true);
			end_new_search();
			if (url_hash){
				if (!displetretsidx.user.is_logged_in) {
					displetretsidx.set_cookie('displetretsidx_last_viewed_hash', url_hash);
				}
				else{
					var data = {
						action: 'displet_update_searches',
						_ajax_nonce: displetretsidx.nonces.update_searches,
						last_hash: url_hash
					};
					$.post(displetretsidx.urls.ajax, data);
				}
			}
		}

		function set_bounds() {
			self.bounds = new google.maps.LatLngBounds();
		}

		function set_conditional_vars() {
			self.has_stats = $('#displet-stats', args.scope).length;
			self.has_numbered_pagination = $('.displet-numbered-pagination', args.scope).length;
			self.has_numbered_pagination_select = $('.displet-numbered-pagination-select', args.scope).length;
			self.has_property_type_navigation = $('#displet-property-type-navigation', args.scope).length;
			self.has_price_navigation = $('#displet-price-navigation', args.scope).length;
			self.is_dynamic_view = $('#displet-dynamic', args.scope).length;
			self.is_map_orientation = !$('.displet-map', args.scope).hasClass('hiding');
			self.is_search_results_page = displetretsidx.wp.is_search_results_page && $('#displet-search-form').length ? true : false;
			self.is_table_view = $('#displet-table-listings', args.scope).length;
		}

		function set_defaults() {
			set_initial_counts();
			set_initial_page();
		}

		function set_infowindow() {
			self.info_window = new google.maps.InfoWindow;
			google.maps.event.addListener(self.map, 'click', function() {
				self.info_window.close();
			});
		}

		function set_initial_counts() {
			self.partial = false;
			self.last_count = get_count_from_element(self.elements.last_count);
			self.total_count = get_count_from_element(self.elements.total_count);
			set_listings_per_page();
		}

		function set_initial_page() {
			self.page = parseInt(displetretsidx.wp.page);
			if (args.data_from === 'property_showcase' || displetretsidx.is_displet_api) {
				self.query_args.page = self.query_args.page ? self.query_args.page : 1;
			}
			else {
				self.query_args.start = self.query_args.start ? self.query_args.start : 1;
			}
		}

		function set_initial_permalinks() {
			if (should_store_property_details_pagination_data()) {
				var permalinks = window.sessionStorage.displetretsidx_search_results_permalinks ? JSON.parse(window.sessionStorage.displetretsidx_search_results_permalinks) : {};
				var the_permalinks = [];
				self.elements.all_listings.each(function(){
					var url = $(this).attr('href');
					if (url) {
						the_permalinks.push(url);
					}
				});
				permalinks[self.page] = get_unique_array(the_permalinks);
				window.sessionStorage.displetretsidx_search_results_permalinks = JSON.stringify(permalinks);
			}
		}

		function set_listings_per_page() {
			self.listings_per_page = args.data_from === 'property_showcase' || displetretsidx.is_displet_api ? self.query_args.limit : self.query_args.num;
		}

		function set_map_defaults() {
			self.geocode_timeouts = [];
			self.lat_total = 0;
			self.long_total = 0;
			self.markers = [];
			self.map_listings_array = [];
		}

		function set_original_query_args() {
			if (is_sort_different() && is_sort_from_cookie_a_match_for_data()) {
				set_sort_from_cookie();
				self.sort_was_changed = true;
			}
			else {
				self.sort_was_changed = false;
			}
			self.original_query_args = JSON.parse(JSON.stringify(args.query_args));
		}

		function set_page_to(page){
			self.page = page;
			if (args.data_from === 'property_showcase' || displetretsidx.is_displet_api) {
				self.query_args.page = page;
			}
			else {
				self.query_args.start = (page - 1) * self.query_args.num + 1;
			}
			store_page_for_property_details_pagination();
		}

		function set_poly_query_args() {
			if (self.polygon_lat_longs && self.polygon_lat_longs.length) {
				self.query_args.poly = [];
				for (var i = 0; i < self.polygon_lat_longs.length; i++) {
					self.query_args.poly.push(self.polygon_lat_longs[i].lng() + ' ' + self.polygon_lat_longs[i].lat());
				};
				self.query_args.poly.push(self.polygon_lat_longs[0].lng() + ' ' + self.polygon_lat_longs[0].lat());
				self.query_args.poly = self.query_args.poly.join(',');
				self.query_args.limit = 50;
				self.listings_per_page = 50;
			}
		}

		function set_search_tags() {
			if (args.data_from === 'api' && self.elements.search_tags_container.length) {
				var search_tags_html = '';
				var hash_array = window.location.href.replace('#', '').split('/');
				for (var i = 0; i < hash_array.length; i++) {
					var field_value_array = hash_array[i].split('=');
					if (field_value_array.length === 2 && displetretsidx.search_field_labels[field_value_array[0]]) {
						var value = field_value_array[0] === 'min_list_price' || field_value_array[0] === 'max_list_price' ? '$' + number_format(parseInt(field_value_array[1]) * 1000) : field_value_array[1];
						search_tags_html += '<span class="displet-search-tag">' + displetretsidx.search_field_labels[field_value_array[0]] + ': ' + decodeURIComponent(value) + '<a name="' + field_value_array[0] + '" href="javascript:;" class="displet-remove-search-tag">X</a></span>';
					}
				};
				self.elements.search_tags_container.html(search_tags_html);
				add_search_tag_binding();
			}
		}

		function set_selectors() {
			self.elements = {};
			self.elements.all_listings = $('.displet-listing', args.scope);
			self.elements.hovertrans = $('.displet-hovertrans', args.scope);
			self.elements.hovertrans_text = $('.displet-text-overlay-hovertrans', args.scope);
			self.elements.first_count = $('.displet-first-listings-value', args.scope);
			self.elements.last_count = $('.displet-last-listings-value', args.scope);
			self.elements.listings_loading = $('.displet-listings-loading', args.scope);
			self.elements.listings_parent = self.elements.all_listings.parent();
			self.elements.max_results = $('.displet-max-results', args.scope);
			self.elements.next_link = $('.displet-next-listings-link', args.scope);
			self.elements.no_results = $('.displet-no-results', args.scope);
			self.elements.numbered_pagination_container = $('.displet-numbered-pagination', args.scope);
			self.elements.numbered_pagination_select = $('.displet-numbered-pagination-select', args.scope);
			self.elements.pagination_links = $('.displet-previous-listings-link, .displet-next-listings-link', args.scope);
			self.elements.previous_link = $('.displet-previous-listings-link', args.scope);
			self.elements.search_tags_container = $('.displet-search-tags', args.scope);
			self.elements.sort_select = $('.displet-listings-sortby', args.scope);
			self.elements.total_count = $('.displet-total-listings-value', args.scope);
			self.elements.total_pages = $('.displet-total-pages-value', args.scope);
			if (self.is_dynamic_view) {
				self.elements.tile_listings = $('.displet-tile-listing', args.scope);
				self.elements.vertical_listings = $('.displet-vertical-listing', args.scope);
				self.elements.map = $('.displet-map, #displet-map', args.scope);
				self.elements.list_view_link = $('#displet-dynamic .displet-list-view', args.scope);
				self.elements.map_view_link = $('#displet-dynamic .displet-map-view', args.scope);
				self.elements.tile_view_link = $('#displet-dynamic .displet-tile-view', args.scope);
				self.elements.current_view_link;
			}
			else if (self.is_table_view) {
				self.elements.table_parent = $(args.scope).parent('#displet-table');
				self.elements.hover_container = $('#displet-table .displet-hover-container', args.scope);
				self.elements.status_tabs = self.elements.table_parent.find('.displet-tab');
				self.elements.status_tables = self.elements.table_parent.find('.displet-table-view');
				self.elements.status_tab_count = self.elements.table_parent.find('.displet-tab[for="' + $(args.scope).attr('for') + '"]').find('.displet-total-listings-value, .displet-total-listings');
			}
			if (self.has_property_type_navigation) {
				self.elements.property_type_links = $('#displet-property-type-navigation .displet-property-type-navigation', args.scope);
			}
			if (self.has_price_navigation) {
				self.elements.price_links = $('#displet-price-navigation .displet-price-navigation', args.scope);
			}
			if (self.has_stats) {
				self.elements.stats = {};
				self.elements.stats.price_min = $('#displet-stats .displet-lowest-price', args.scope);
				self.elements.stats.price_max = $('#displet-stats .displet-highest-price', args.scope);
				self.elements.stats.price_mean = $('#displet-stats .displet-average-price', args.scope);
				self.elements.stats.square_feet_min = $('#displet-stats .displet-lowest-square-footage', args.scope);
				self.elements.stats.square_feet_max = $('#displet-stats .displet-highest-square-footage', args.scope);
				self.elements.stats.square_feet_mean = $('#displet-stats .displet-average-square-footage', args.scope);
				self.elements.stats.listings_count = $('#displet-stats .displet-total-listings-value', args.scope);
				self.elements.stats.bedrooms_mean = $('#displet-stats .displet-average-bedrooms', args.scope);
				self.elements.stats.bathrooms_mean = $('#displet-stats .displet-average-bathrooms', args.scope);
				self.elements.stats.price_per_square_foot_mean = $('#displet-stats .displet-average-price-per-square-foot', args.scope);
			}
		}

		function set_sort_from_cookie() {
			if (displetretsidx.is_displet_api || args.data_from === 'property_showcase') {
				if (displetretsidx.cookies.last_viewed_sort.indexOf('list_date') !== -1) {
					self.query_args.sort_by = 'list_date';
				}
				else {
					self.query_args.sort_by = 'list_price';
				}
				if (displetretsidx.cookies.last_viewed_sort.indexOf('asc') !== -1) {
					self.query_args.direction = 'asc';
				}
				else {
					self.query_args.direction = 'desc';
				}
			}
			else {
				self.query_args.sort = displetretsidx.cookies.last_viewed_sort;
			}
		}

		this.set_view = function(){
			if (this.is_dynamic_view && (displetretsidx.cookies.last_viewed_orientation == 'gallery' || displetretsidx.cookies.last_viewed_orientation == 'list' || displetretsidx.cookies.last_viewed_orientation == 'map')) {
				var orientation = displetretsidx.cookies.last_viewed_orientation;
				if (orientation != displetretsidx.options.orientation) {
					if (orientation == 'gallery' && !displetretsidx.wp.is_mobile_search_results_page && !displetretsidx.wp.is_mobile_property_details_page) {
						this.show_tile();
					}
					else if (orientation == 'map') {
						this.show_map();
					}
					else {
						this.show_vertical();
					}
				}
			}
		}

		function show_infowindow(marker) {
			var latLng = marker.getPosition();
			var map_content = '<div class="marker-inner">';
			if (marker.url != undefined && marker.url != ''){
				map_content += '<a class="displet-group" href="' + marker.url + '">';
			}
			if (marker.photo != undefined && marker.photo != '') {
				map_content += '<img class="displet-image" src="' + marker.photo + '" />'
				map_content += '<div class="displet-content displet-with-image">';
			}
			else{
				map_content += '<div class="displet-content">';
			}
			if (marker.address != undefined && marker.address != '') {
				map_content += '<div class="displet-address displet-font-color">' + marker.address + '</div>';
			}
			if (marker.subdivision != undefined && marker.subdivision != '') {
				map_content += '<div class="displet-subdivision displet-font-color-light">' + marker.subdivision + '</div>';
			}
			if (marker.price != undefined && marker.price != '') {
				map_content += '<div class="displet-font-color-light"><span class="displet-font-color-light">List price:</span> $' + number_format(marker.price) + '</div>';
			}
			if (marker.sqft != undefined && marker.sqft != '') {
				map_content += '<div class="displet-font-color-light"><span class="displet-font-color-light">Size: </span>' + marker.sqft + ' Sq. Ft.</div>';
			}
			map_content += '<div class="displet-font-color-light">';
			if (marker.beds != undefined && marker.beds != '') {
				map_content += '<span class="displet-font-color-light">Beds: </span>' + marker.beds;
			}
			if (marker.baths != undefined && marker.baths != '') {
				map_content += ' | <span class="displet-font-color-light">Baths: </span>' + marker.baths;
			}
			if (marker.mls_number != undefined && marker.mls_number != '') {
				var mls_style = displetretsidx.options.emphasize_mls_number ? 'displet-emphasize displet-font-color' : 'displet-font-color-light';
				map_content += '<div class="displet-mls"><span class="displet-font-color-light">MLS&reg; #: </span><span class="' + mls_style + '">' + marker.mls_number + '</span></div>';
			}
			map_content += '</div></div>';
			if (displetretsidx.options.include_disclaimer_image && displetretsidx.options.disclaimer_image != '') {
				map_content += '<img class="displet-mls-logo" src="' + displetretsidx.options.disclaimer_image + '">';
			}
			if ((marker.agent != undefined && marker.agent != '') || (marker.office != undefined && marker.office != '')) {
				map_content += '<div class="displet-courtesy">Courtesy of';
			}
			if (marker.agent != undefined && marker.agent != '') {
				if (marker.office != undefined && marker.office != '' && marker.agent.slice(-1) !== ',') marker.agent += ',';
				var agent_style = displetretsidx.options.emphasize_listing_office_and_agent ? 'displet-emphasize displet-font-color' : 'displet-font-color-light';
				map_content += '<span class="displet-agent-name ' + agent_style + '"> ' + marker.agent + '</span>';
			}
			if (marker.office != undefined && marker.office != '') {
				var office_style = displetretsidx.options.emphasize_listing_office_and_agent ? 'displet-emphasize displet-font-color' : 'displet-font-color-light';
				map_content += '<span class="displet-office-name ' + office_style + '"> ' + marker.office + '</span>';
			}
			if ((marker.agent != undefined && marker.agent != '') || (marker.office != undefined && marker.office != '')) {
				map_content += '</div>';
			}
			if (marker.url != undefined && marker.url != ''){
				map_content += '</a>';
			}
			map_content += '</a></div>';
			self.info_window.setContent(map_content);
			self.info_window.open(self.map, marker);
		};

		this.show_map = function () {
			$('#displet-dynamic .displet-orientation .current', args.scope).removeClass('current'); // Legacy template usage
			$('#displet-dynamic .displet-orientation .displet-map-view', args.scope).addClass('current'); // Legacy template usage
			$('#displet-dynamic .displet-current-view', args.scope).removeClass('displet-current-view');
			this.elements.map_view_link.addClass('displet-current-view');
			this.elements.listings_parent.addClass('hiding');
			this.elements.all_listings.removeClass('displet-current');
			this.elements.map.hide();
			if (get_count_from_element(this.elements.total_count) > 0 || (self.query_args.poly && self.query_args.poly.length)) {
				this.elements.map.removeClass('hiding');
				this.elements.map.fadeIn(300);
			}
			self.is_map_orientation = true;
			displetretsidx.set_cookie('displetretsidx_last_viewed_orientation', 'map');
		}

		this.show_tile = function () {
			if (!displetretsidx.wp.is_mobile_search_results_page && !displetretsidx.wp.is_mobile_property_details_page) {
				$('#displet-dynamic .displet-orientation .current', args.scope).removeClass('current'); // Legacy template usage
				$('#displet-dynamic .displet-orientation .displet-tile-view', args.scope).addClass('current'); // Legacy template usage
				$('#displet-dynamic .displet-current-view', args.scope).removeClass('displet-current-view');
				this.elements.tile_view_link.addClass('displet-current-view');
				this.elements.map.addClass('hiding');
				this.elements.listings_parent.hide();
				this.elements.vertical_listings.hide();
				this.elements.all_listings.removeClass('displet-current');
				$('a.displet-tile-listing.displet-showing', args.scope).show();
				this.elements.tile_listings.addClass('displet-current');
				this.elements.listings_parent.removeClass('hiding');
				if (get_count_from_element(this.elements.total_count) > 0) this.elements.listings_parent.fadeIn(300);
				hovertrans();
				displetretsidx.set_cookie('displetretsidx_last_viewed_orientation', 'gallery');
			}
			else{
				this.show_vertical();
			}
			self.is_map_orientation = false;
		}

		this.show_vertical = function () {
			$('#displet-dynamic .displet-orientation .current', args.scope).removeClass('current'); // Legacy template usage
			$('#displet-dynamic .displet-orientation .displet-list-view', args.scope).addClass('current'); // Legacy template usage
			$('#displet-dynamic .displet-current-view', args.scope).removeClass('displet-current-view');
			this.elements.list_view_link.addClass('displet-current-view');
			this.elements.map.addClass('hiding');
			this.elements.listings_parent.hide();
			this.elements.tile_listings.hide();
			this.elements.all_listings.removeClass('displet-current');
			$('a.displet-vertical-listing.displet-showing', args.scope).show();
			this.elements.vertical_listings.addClass('displet-current');
			this.elements.listings_parent.removeClass('hiding');
			if (get_count_from_element(this.elements.total_count) > 0) this.elements.listings_parent.fadeIn(300);
			hovertrans();
			self.is_map_orientation = false;
			displetretsidx.set_cookie('displetretsidx_last_viewed_orientation', 'list');
		}

		function should_store_property_details_pagination_data() {
			if (displetretsidx.is_displet_api && args.data_from !== 'property_showcase' && typeof(Storage) !== 'undefined') {
				return true;
			}
			return false;
		}

		function start_new_search() {
			set_page_to(1);
			reset_listing_permalinks();
		}

		function size_listings() {
			if (!displetretsidx.wp.is_mobile_search_results_page && !displetretsidx.wp.is_mobile_property_details_page) {
				var listings_per_row = 0;
				var target_width = 0;
				var margin_total = 0;
				var margin = 0;
				var listing_width = $(self.elements.tile_listings[0]).outerWidth();
				var listings_parent_width = self.elements.listings_parent.width() - 1; // IE10 parent can be 621.96 px, which jQuery will call 622px, causing margins to not fit
				if (listing_width != 0) {
					self.listings_per_row = Math.floor(listings_parent_width / listing_width);
					target_width = Math.floor(listings_parent_width / self.listings_per_row);
					margin_total = target_width - listing_width;
					margin = Math.floor(margin_total / 2);
					self.elements.tile_listings.css({
						'margin-left': margin,
						'margin-right': margin
					});
				}
			}
		}

		function store_page_for_property_details_pagination() {
			if (should_store_property_details_pagination_data()) {
				window.sessionStorage.displetretsidx_search_results_page = self.page;
			}
		}

		function store_permalinks_for_property_details_pagination() {
			if (should_store_property_details_pagination_data()) {
				var permalinks = window.sessionStorage.displetretsidx_search_results_permalinks ? JSON.parse(window.sessionStorage.displetretsidx_search_results_permalinks) : {};
				permalinks[self.page] = self.listing_permalinks;
				window.sessionStorage.displetretsidx_search_results_permalinks = JSON.stringify(permalinks);
			}
		}

		function store_query_for_property_details_page_pagination() {
			if (should_store_property_details_pagination_data()) {
				window.sessionStorage.displetretsidx_search_results_query_args = JSON.stringify(self.query_args);
			}
		}

		function translate_query_parameter(parameter) {
			if (parameter == 'min_list_price' || parameter == 'max_list_price') {
				parameter = ['attributes', 'price'];
			}
			else if (parameter == 'min_bedrooms' || parameter == 'max_bedrooms') {
				parameter = ['attributes', 'bedrooms'];
			}
			else if (parameter == 'min_bathrooms' || parameter == 'max_bathrooms') {
				parameter = ['attributes', 'bathrooms'];
			}
			else if (parameter == 'min_square_feet' || parameter == 'max_square_feet') {
				parameter = ['attributes', 'square_feet'];
			}
			else if (parameter == 'pool_on_property') {
				parameter = ['attributes', 'pool'];
			}
			else if (parameter == 'is_gated_community') {
				parameter = ['attributes', 'gated'];
			}
			else if (parameter == 'area' || parameter == 'zip' || parameter == 'area_mls_defined' || parameter == 'city') {
				parameter = ['location'];
			}
			else if (parameter == 'property_type') {
				parameter = ['category'];
			}
			else if (parameter == 'is_foreclosure') {
				parameter = ['category', 'foreclosure'];
			}
			else if (parameter == 'keyword' || parameter == 'quick_terms') {
				parameter = ['q'];
			}
			return parameter;
		}

		function unloading() {
			self.elements.listings_loading.hide();
		}

		function update_controls() {
			if (self.query_data.meta.count == undefined || self.query_data.meta.count <= 0 || (self.query_data.meta.count <= self.query_data.meta.last && self.query_data.meta.first == 1)) {
				self.elements.pagination_links.hide();
			}
			else{
				self.elements.pagination_links.show();
			}
			if (self.query_data.meta.count > 0){
				self.elements.no_results.hide();
				self.elements.total_count.html(number_format(self.query_data.meta.count));
				self.elements.first_count.html(number_format(self.query_data.meta.first));
				self.elements.last_count.html(number_format(self.query_data.meta.last));
			}
			else{
				self.elements.total_count.html('0');
				self.elements.first_count.html('0');
				self.elements.last_count.html('0');
			}
			maybe_update_pagination_urls();
			maybe_update_numbered_pagination_urls();
			update_total_pages_count();
		}

		function update_html() {
			maybe_setup_new_map();
			normalize_meta();
			update_controls();
			update_messages();
			update_stats();
			update_listings();
			maybe_update_map();
			unloading();
		}

		function update_listings() {
			self.map_listings_array = [];
			self.lat_total = 0;
			self.long_total = 0;
			self.listing_permalinks = [];
			if (self.query_data.meta.count > 0){
				$('.displet-listing.displet-current', args.scope).hide();
				$('.displet-listing.displet-hiding', args.scope).removeClass('displet-hiding');
				$('.displet-listing.displet-showing', args.scope).removeClass('displet-showing');
				self.elements.listings_parent.show();
				if (self.is_dynamic_view) {
					if (self.is_map_orientation && self.elements.map.hasClass('hiding')) {
						self.elements.map.removeClass('hiding');
					}
				}
				var i = 1;
				$.each(self.query_data.results, function() {
					if (self.partial && i > self.partial) {
						return false;
					}
					var this_result = normalize_listing(this);
					var this_element = $('.displet-listing-' + i, args.scope);
					this_element.addClass('displet-showing');
					$('.displet-listing-' + i + '.displet-current', args.scope).show();
					this_result.permalink = get_listing_permalink(this_result);
					if (this_result.permalink) {
						this_element.attr('href', this_result.permalink);
						self.listing_permalinks.push(this_result.permalink);
					}
					else{
						this_element.attr('href', '#');
					}
					if (this_result.image_urls && this_result.image_urls.primary_big) {
						this_element.find('div.displet-image-value').css('background-image', 'url(' + this_result.image_urls.primary_big + ')');
						this_element.find('img.displet-image-value').attr('src', this_result.image_urls.primary_big);
						this_element.find('.displet-image').show();
					}
					else{
						 this_element.find('.displet-image').hide();
					}
					if (this_result.status) {
						if (this_result.status.toLowerCase().indexOf('pen') !== -1 || this_result.status.toLowerCase().indexOf('und') !== -1) {
							this_element.find('.displet-under-contract').show();
							this_element.find('.displet-contingency').hide();
						}
						else if (this_result.status.toLowerCase().indexOf('conti') !== -1) {
							this_element.find('.displet-contingency').show();
							this_element.find('.displet-under-contract').hide();
						}
						else{
							this_element.find('.displet-contingency').hide();
							this_element.find('.displet-under-contract').hide();
						}
					}
					else{
						this_element.find('.displet-contingency').hide();
						this_element.find('.displet-under-contract').hide();
					}
					if (displetretsidx.options.use_price_reduction) {
						if (this_result.original_list_price && this_result.list_price && this_result.original_list_price > this_result.list_price && (!this_result.status || (this_result.status.toLowerCase().indexOf('pen') === -1 && this_result.status.toLowerCase().indexOf('und') === -1 && this_result.status.toLowerCase().indexOf('conti') === -1))) {
							this_element.find('.displet-price-reduction').html('<div>Reduced $' + Math.floor((this_result.original_list_price - this_result.list_price) / 1000) + 'k</div>').show();
						}
						else {
							this_element.find('.displet-price-reduction').hide();
						}
					}
					if (this_result.listing_agent_name || this_result.listing_office_name) {
						this_element.find('.displet-courtesy').show();
					}
					else {
						this_element.find('.displet-courtesy').hide();
					}
					if (self.is_dynamic_view && this_result.listing_agent_name && this_result.listing_office_name) this_result.listing_agent_name += ',';
					var populate_or_hide_fields = {
						'price': this_result.list_price,
						'address': this_result.address,
						'subdivision': this_result.subdivision,
						'city': this_result.city,
						'state': this_result.state,
						'zip': this_result.zip,
						'property-type': this_result.property_type,
						'beds': this_result.num_bedrooms,
						'baths': this_result.bathrooms,
						'square-feet': this_result.square_feet,
						'mls': this_result.mls_number,
						'listing-agent-name': this_result.listing_agent_name,
						'listing-office-name': this_result.listing_office_name,
						'address-internet': this_result.address_internet, // Email for RAPB
						'description': this_result.internet_remarks,
						'year-built': this_result.year_built,
					};
					$.each(populate_or_hide_fields, function(key, value){
						if (value != undefined) {
							if (!isNaN(value) && key != 'zip' && key != 'mls' && key != 'year-built' && key != 'listing-office-name' && key != 'listing-agent-name') {
								value = number_format(value);
							}
							this_element.find('.displet-' + key + '-value').html(value);
							this_element.find('.displet-' + key).show();
						}
						else{
							this_element.find('.displet-' + key).hide();
							this_element.find('.displet-' + key + '-value').html('');
						}
					});
					if (self.is_dynamic_view && this_result.latitude && this_result.longitude) {
						self.map_listings_array.push(this_result);
						self.lat_total += parseFloat(this_result.latitude);
						self.long_total += parseFloat(this_result.longitude);
					}
					i++;
				});
				if (self.is_dynamic_view) {
					hovertrans();
				}
			}
			else if (!self.query_args.poly || !self.query_args.poly.length){
				self.elements.listings_parent.hide();
				if (self.is_dynamic_view) {
					if (self.is_map_orientation && !self.elements.map.hasClass('hiding')) {
						self.elements.map.addClass('hiding');
					}
				}
				self.elements.no_results.show();
			}
			store_permalinks_for_property_details_pagination();
			self.elements.listings_loading.hide().trigger('displetretsidx_fetched_listings');
		}

		function update_messages() {
			if (args.data_from !== 'property_showcase' && displetretsidx.options.results_limit !== false && self.query_data.meta.count > displetretsidx.options.results_limit) {
				self.elements.max_results.show();
			}
			else{
				self.elements.max_results.hide();
			}
		}

		function update_total_pages_count() {
			if (self.elements.total_pages.length) {
				self.elements.total_pages.html(number_format(self.query_data.meta.pages));
			}
		}

		function maybe_update_pagination_urls() {
			if (self.query_data.meta.count > 0) {
				var current_page_url = get_pageless_current_url();
				if (self.page === 1) {
					self.elements.previous_link.hide();
				}
				else {
					self.elements.previous_link.show();
					self.elements.previous_link.attr('href', current_page_url + 'page/' + (self.page - 1) + '/' + window.location.hash);
				}
				if (self.query_data.meta.last == self.query_data.meta.count) {
					self.elements.next_link.hide();
				}
				else{
					self.elements.next_link.attr('href', current_page_url + 'page/' + (self.page + 1) + '/' + window.location.hash);
					self.elements.next_link.show();
				}
			}
		}

		function update_prices(min, max) {
			if (displetretsidx.is_displet_api) {
				var min_price = Math.round(min / 1000);
				var max_price = Math.round(max / 1000);
				if (!self.original_query_args.min_list_price || (self.original_query_args.min_list_price < min_price)) {
					self.query_args.min_list_price = min_price;
				}
				else {
					self.query_args.min_list_price = self.original_query_args.min_list_price;
				}
				if (!self.original_query_args.max_list_price || (self.original_query_args.max_list_price > max_price)) {
					self.query_args.max_list_price = max_price;
				}
				else {
					self.query_args.max_list_price = self.original_query_args.max_list_price;
				}
				start_new_search();
				get_listings();
				push_state();
				end_new_search();
			}
		}

		function update_property_type(property_type) {
			if (displetretsidx.is_displet_api) {
				if (property_type === 'all') {
					if (typeof(self.original_query_args.property_type) !== 'undefined') {
						self.query_args.property_type = self.original_query_args.property_type;
					}
					else {
						delete self.query_args.property_type;
					}
				}
				else {
					self.query_args.property_type = property_type;
				}
				if (self.has_property_type_navigation) {
					$('#displet-property-type-navigation .displet-property-type-navigation.active', args.scope).removeClass('active');
					$('#displet-property-type-navigation .displet-property-type-navigation', args.scope).filter(function(){
						if ($(this).attr('displetpropertytype') === property_type) {
							return true;
						}
						return false;
					}).addClass('active');
				}
				start_new_search();
				get_listings();
				push_state();
				end_new_search();
			}
		}

		function update_stats() {
			if (displetretsidx.is_displet_api) {
				if (self.has_stats) {
					if (self.elements.stats.price_min.length){
						var list_price_min = (self.query_data.meta.list_price_min != undefined) ? number_format(parseInt(self.query_data.meta.list_price_min)) : '';
						self.elements.stats.price_min.text(list_price_min);
					}
					if (self.elements.stats.price_max.length){
						var list_price_max = (self.query_data.meta.list_price_max != undefined) ? number_format(parseInt(self.query_data.meta.list_price_max)) : '';
						self.elements.stats.price_max.text(list_price_max);
					}
					if (self.elements.stats.price_mean.length){
						var list_price_mean = (self.query_data.meta.list_price_mean != undefined) ? number_format(parseInt(self.query_data.meta.list_price_mean)) : '';
						self.elements.stats.price_mean.text(list_price_mean);
					}
					if (self.elements.stats.square_feet_min.length){
						var square_feet_min = (self.query_data.meta.square_feet_min != undefined) ? number_format(parseInt(self.query_data.meta.square_feet_min)) : '';
						self.elements.stats.square_feet_min.text(square_feet_min);
					}
					if (self.elements.stats.square_feet_max.length){
						var square_feet_max = (self.query_data.meta.square_feet_max != undefined) ? number_format(parseInt(self.query_data.meta.square_feet_max)) : '';
						self.elements.stats.square_feet_max.text(square_feet_max);
					}
					if (self.elements.stats.square_feet_mean.length){
						var square_feet_mean = (self.query_data.meta.square_feet_mean != undefined) ? number_format(parseInt(self.query_data.meta.square_feet_mean)) : '';
						self.elements.stats.square_feet_mean.text(square_feet_mean);
					}
					if (self.elements.stats.listings_count.length){
						var listings_count = (self.query_data.meta.count != undefined) ? number_format(parseInt(self.query_data.meta.count)) : '';
						self.elements.stats.listings_count.text(listings_count);
					}
					if (self.elements.stats.bedrooms_mean.length){
						var bedrooms_mean = (self.query_data.meta.num_bedrooms_mean != undefined) ? number_format(Number(self.query_data.meta.num_bedrooms_mean).toFixed(1)) : '';
						self.elements.stats.bedrooms_mean.text(bedrooms_mean);
					}
					if (self.elements.stats.bathrooms_mean.length){
						var bathrooms_mean = (self.query_data.meta.full_baths_mean != undefined) ? number_format(Number(self.query_data.meta.full_baths_mean).toFixed(1)) : '';
						self.elements.stats.bathrooms_mean.text(bathrooms_mean);
					}
					if (self.elements.stats.price_per_square_foot_mean.length){
						if (self.query_data.meta.list_price_mean != undefined && self.query_data.meta.square_feet_mean != undefined) {
							var price_per_sq_ft = Number(self.query_data.meta.list_price_mean) / Number(self.query_data.meta.square_feet_mean);
							var price_per_square_foot_mean = number_format(price_per_sq_ft.toFixed(2));
						}
						else{
							var price_per_square_foot_mean = '';
						}
						self.elements.stats.price_per_square_foot_mean.text(price_per_square_foot_mean);
					}
				}
				if (self.is_table_view) {
					if (self.elements.status_tab_count.length){
						var listings_count = (self.query_data.meta.count != undefined) ? number_format(parseInt(self.query_data.meta.count)) : '';
						self.elements.status_tab_count.text(listings_count);
					}
				}
			}
		}

		if (args.scope.length) {
			init();
		}
	}

	/*********************
	Search Instance
	*********************/

	this.displetretsidx_search = function(){
		var self = this;

		function init(){
			self.elements = {};
			self.elements.search_form = $('#displet-search-form');
			self.elements.search_form_selects = $('#displet-search-form select');
			self.elements.search_form_fields = $('#displet-search-form input[type="text"].displet-search-field, #displet-search-form select.displet-search-field, #displet-search-form input[type="radio"].displet-search-field');
			self.elements.submit_search_link = $('#displet-search-form .displet-submit-search, #displet-search-form .displet-revise');
			self.create();
		}

		this.create = function(){
			if (window.location.hash && window.location.hash.indexOf('status=unavailable') === -1) {
				if (!displetretsidx.cookies.last_search_count) {
					displetretsidx.cookies.last_search_count = 1;
					maybe_show_login_register_popup_from_searches();
				}
			}
			maybe_update_search_form_from_hash();
			this.add_search_form_binding();
		}

		function maybe_update_search_form_from_hash() {
			if (window.location.hash) {
				self.update_search_form_from_hash();
			}
		}

		this.update_search_form_from_hash = function(){
			if (!displetretsidx.pages.is_mobile_page) {
				this.elements.submit_search_link.text('Revise Search');
			}
			var hash_array = window.location.hash.replace('#', '').split('/');
			var set_view = false;
			for (var i = hash_array.length - 1; i >= 0; i--) {
				var current_hash = hash_array[i].split('=');
				if ($('#displet-search-form input[name="' + current_hash[0] + '"][value="' + current_hash[1] + '"]').length) {
					$('#displet-search-form input[name="' + current_hash[0] + '"][value="' + current_hash[1] + '"]').attr('checked', true);
				}
				else if ($('#displet-search-form input[name="' + current_hash[0] + '"]').length){
					$('#displet-search-form input[name="' + current_hash[0] + '"]').val(decodeURIComponent(current_hash[1]));
				}
				else if ($('#displet-search-form select[name="' + current_hash[0] + '"]').length) {
					var value = decodeURIComponent(current_hash[1]);
					var value_array = value.split(',');
					$(value_array).each(function(i, val){
						$('#displet-search-form select[name="' + current_hash[0] + '"] option[value="' + decodeURIComponent(val) + '"]').attr('selected', true);
					});
				}
				else if (current_hash[0] === 'view') {
					if (current_hash[1] === 'map') {
						for (var j = 0; j < displetretsidx.listings.length; j++) {
							displetretsidx.listings[j].show_map();
						};
						set_view = true;
					}
					else if (current_hash[1] === 'list') {
						for (var j = 0; j < displetretsidx.listings.length; j++) {
							displetretsidx.listings[j].show_vertical();
						};
						set_view = true;
					}
					else if (current_hash[1] === 'gallery') {
						for (var j = 0; j < displetretsidx.listings.length; j++) {
							displetretsidx.listings[j].show_tile();
						};
						set_view = true;
					}
				}
			};
			if (!set_view){
				for (var i = 0; i < displetretsidx.listings.length; i++) {
					displetretsidx.listings[i].set_view();
				};
			}
		}

		this.add_search_form_binding = function(){
			this.elements.submit_search_link.click(function(e){
				e.preventDefault();
				submit_search();
				return false;
			});
			this.elements.search_form.keypress(function(e){
				if (e.which == 13) {
					e.preventDefault();
					submit_search();
					return false;
				}
			});
			this.elements.submit_search_link.keypress(function(e){
				if (e.which == 32) {
					e.preventDefault();
					submit_search();
					return false;
				}
			});
			if (!displetretsidx.wp.is_mobile_search_results_page) {
				this.elements.search_form_selects.chosen({disable_search: true});
			}
		}

		this.add_search_form_to_hash = function(){
			var hash = '';
			this.elements.search_form_fields.each(function() {
				var value = displetretsidx.get_value_from_search_form_element(this);
				if (value) {
					hash += this.name + '=' + encodeURIComponent(value) + '/';
				}
			});
			self.update_search_hash(hash);
		}

		function maybe_show_login_register_popup_from_searches(){
			if (displetretsidx.options.require_registration_to_search && displetretsidx.cookies.last_search_count && displetretsidx.cookies.last_search_count >= displetretsidx.options.public_searches && !displetretsidx.user.is_logged_in) {
				if (displetretsidx.options.exclude_referred_visitors == '1') {
					if ((displetretsidx.cookies.referring_site == undefined || displetretsidx.cookies.referring_site == null || displetretsidx.cookies.referring_site == '' || displetretsidx.cookies.referring_site.indexOf(displetretsidx.urls.home) !== -1) && displetretsidx.urls.referrer.indexOf(displetretsidx.urls.home) !== -1) {
						displetretsidx.show_login_register_popup();
					}
				}
				else{
					displetretsidx.show_login_register_popup();
				}
			}
		}

		function maybe_update_search_count(){
			if (displetretsidx.options.require_registration_to_search && displetretsidx.wp.is_search_results_page && $('#displet-search-form').length){
				var viewed_searches = parseInt(displetretsidx.cookies.last_search_count);
				displetretsidx.cookies.last_search_count = viewed_searches > 0 ? ++viewed_searches : 1;
				maybe_show_login_register_popup_from_searches();
				displetretsidx.set_cookie('displetretsidx_last_search_count', displetretsidx.cookies.last_search_count);
			}
		}

		function submit_search(){
			self.add_search_form_to_hash();
			for (var i = 0; i < displetretsidx.listings.length; i++) {
				displetretsidx.listings[i].run_search_from_hash();
			};
			maybe_update_search_count();
		}

		this.update_search_hash = function(hash) {
			if (window.location.href.indexOf('/page/') !== -1) {
				displetretsidx.wp.page = 1;
				if (displetretsidx.wp.is_mobile_search_results_page) {
					var search_results_url = displetretsidx.urls.mobile_search_results_page;
				}
				else{
					var search_results_url = displetretsidx.urls.search_results_page;
				}
				history.pushState('', '', search_results_url + '#' + hash.replace('#', ''));
			}
			else{
				window.location.hash = hash;
			}
			for (var i = 0; i < displetretsidx.listings.length; i++) {
				displetretsidx.listings[i].page = 1;
			};
		}

		$(document).bind('displetretsidx_have_listings', function(){
			init();
		});
	}

	/*********************
	Init Call
	*********************/

	get_cookies();
	$(document).ready(function(){
		init();
	});
}(window.displetretsidx = window.displetretsidx || {}, jQuery));

/* Legacy template usage */
function displetFacebookLogin() {
	displetretsidx.submit_facebook_login();
}

/*********************
Displet Carousel Functions
*********************/

(function($) {
    $.fn.displetRetsIdxCarouselLite = function(o) {
        o = $.extend({
            btnPrev: null,
            btnNext: null,
            btnGo: null,
            mouseWheel: false,
            auto: null,
            speed: 200,
            easing: null,
            vertical: false,
            circular: true,
            visible: 3,
            start: 0,
            scroll: 1,
            beforeStart: null,
            afterEnd: null
        },
        o || {});
        return this.each(function() {
            var running = false,
            animCss = o.vertical ? "top": "left",
            sizeCss = o.vertical ? "height": "width";
            var div = $(this),
            a = $("a", div),
            ul = $("ul", div),
            tLi = $("li", ul),
            tl = tLi.size(),
            v = o.visible;
            if (o.circular) {
                ul.prepend(tLi.slice(tl - v - 1 + 1).clone()).append(tLi.slice(0, v).clone());
                o.start += v;
            }
            var li = $("li", ul),
            itemLength = li.size(),
            curr = o.start;
            div.css("visibility", "visible");
            li.css({
                overflow: "hidden",
                float: o.vertical ? "none": "left"
            });
            ul.css({
                margin: "0",
                padding: "0",
                position: "relative",
                "list-style-type": "none",
                "z-index": "1"
            });
            div.css({
                overflow: "hidden",
                position: "relative",
                "z-index": "2",
                left: "0px"
            });
            var liSize;
            var ulSize;
            var divSize;
            size(0);
            var self = this;
            if (o.btnPrev) $(o.btnPrev).click(function() {
                clearInterval(self.autoScroll);
                return go(curr - o.scroll);
            });
            if (o.btnNext) $(o.btnNext).click(function() {
                clearInterval(self.autoScroll);
                return go(curr + o.scroll);
            });
            if (o.btnGo) $.each(o.btnGo,
            function(i, val) {
                $(val).click(function() {
                    return go(o.circular ? o.visible + i: i);
                });
            });
            if (o.mouseWheel && div.mousewheel) div.mousewheel(function(e, d) {
                return d > 0 ? go(curr - o.scroll) : go(curr + o.scroll);
            });
            if (o.auto) {
                self.autoScroll = setInterval(function() {
                    go(curr + o.scroll);
                },
                o.auto + o.speed);
                div.hover(
                    function() {
                        clearInterval(self.autoScroll);
                    },
                    function() {
                        self.autoScroll = setInterval(function() {
                            go(curr + o.scroll);
                        }, o.auto + o.speed);
                });
            }
            var resize_timer;
            $(window).resize(function(){
                clearTimeout(resize_timer);
                resize_timer = setTimeout(function(){
                    resize();
                }, 50);
            });
            function resize(count){
                var theCount = count ? count : 0;
                li.css({
                    width: '',
                    height: ''
                });
                ul.css(sizeCss, '');
                div.css(sizeCss, '');
                size(theCount);
            }
            function size(count){
                if (li.height() > 0) {
                    liSize = o.vertical ? height(li) : width(li);
                    ulSize = liSize * itemLength;
                    divSize = liSize * v;
					var topHeight = li.height();
					li.each(function(){
						var thisHeight = $(this).height();
						if (thisHeight > topHeight) {
							topHeight = thisHeight;
						}
					});
                    li.css({
                        width: li.width(),
                        height: topHeight
                    });
                    ul.css(sizeCss, ulSize + "px").css(animCss, -(curr * liSize));
                    div.css(sizeCss, divSize + "px");
                }
                else {
                    var theCount = count ? count : 1;
                    if (theCount > 0) {
                        theCount++;
                    }
                    if (theCount < 102) {
                        setTimeout(function(){
                            resize(theCount);
                        }, 50);
                    }
                    else if (theCount < 202) {
                        setTimeout(function(){
                            resize(theCount);
                        }, 100);
                    }
                    else if (theCount < 302) {
                        setTimeout(function(){
                            resize(theCount);
                        }, 500);
                    }
                }
            };
            function vis() {
                return li.slice(curr).slice(0, v);
            };
            function go(to) {
                if (!running) {
                    if (o.beforeStart) o.beforeStart.call(this, vis());
                    if (o.circular) {
                        if (to <= o.start - v - 1) {
                            ul.css(animCss, -((itemLength - (v * 2)) * liSize) + "px");
                            curr = to == o.start - v - 1 ? itemLength - (v * 2) - 1: itemLength - (v * 2) - o.scroll;
                        } else if (to >= itemLength - v + 1) {
                            ul.css(animCss, -((v) * liSize) + "px");
                            curr = to == itemLength - v + 1 ? v + 1: v + o.scroll;
                        } else curr = to;
                    } else {
                        if (to < 0 || to > itemLength - v) return;
                        else curr = to;
                    }
                    running = true;
                    ul.animate(animCss == "left" ? {
                        left: -(curr * liSize)
                    }: {
                        top: -(curr * liSize)
                    },
                    o.speed, o.easing,
                    function() {
                        if (o.afterEnd) o.afterEnd.call(this, vis());
                        running = false;
                    });
                    if (!o.circular) {
                        $(o.btnPrev + "," + o.btnNext).removeClass("disabled");
                        $((curr - o.scroll < 0 && o.btnPrev) || (curr + o.scroll > itemLength - v && o.btnNext) || []).addClass("disabled");
                    }
                }
                return false;
            };
        });
    };
    function css(el, prop) {
        return parseInt($.css(el[0], prop)) || 0;
    };
    function width(el) {
        return el[0].offsetWidth + css(el, 'marginLeft') + css(el, 'marginRight');
    };
    function height(el) {
        return el[0].offsetHeight + css(el, 'marginTop') + css(el, 'marginBottom');
    };
})(jQuery);