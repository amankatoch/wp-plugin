jQuery(document).ready(function($){
	if (typeof(displetretsidx_agent_translations) !== 'undefined' && typeof(displetretsidx_office_translations) !== 'undefined') {
		function displetnnerenlistingtranslations_replace_agent_id(){
			$('.displet-listing-agent-name-value').each(function(){
				var agent_id = $.trim($(this).text());
				var has_comma = (agent_id.substr(agent_id.length -1, 1) == ',') ? true : false;
				if (has_comma) {
					agent_id = agent_id.substr(0, agent_id.length - 1);
				}
				if (displetretsidx_agent_translations[agent_id]) {
					var agent_name = (has_comma) ? displetretsidx_agent_translations[agent_id] + ',' : displetretsidx_agent_translations[agent_id];
					$(this).text(agent_name);
				}
			});
		}
		function displetnnerenlistingtranslations_replace_office_id(){
			$('.displet-listing-office-name-value').each(function(){
				var office_id = $.trim($(this).text());
				if (displetretsidx_office_translations[office_id]) {
					$(this).text(displetretsidx_office_translations[office_id]);
				}
			});
		}
		displetnnerenlistingtranslations_replace_agent_id();
		displetnnerenlistingtranslations_replace_office_id();
		$(document).bind('displetretsidx_fetched_listings', function(){
			displetnnerenlistingtranslations_replace_agent_id();
			displetnnerenlistingtranslations_replace_office_id();
		});
	}
});