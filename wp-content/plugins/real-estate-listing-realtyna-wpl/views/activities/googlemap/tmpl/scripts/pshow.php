<?php
/** no direct access **/
defined('_WPLEXEC') or die('Restricted access');
?>
<script type="text/javascript">
var markers = <?php echo json_encode($this->markers); ?>;
var google_place = <?php echo $this->google_place; ?>;
var google_place_radius = <?php echo $this->google_place_radius; ?>

/** default values in case of no marker to showing **/
var default_lt = '<?php echo $this->default_lt; ?>';
var default_ln = '<?php echo $this->default_ln; ?>';
var default_zoom = <?php echo $this->default_zoom; ?>;
var wpl_map_initialized = false;
var wpl_pshow_bounds_extended = false;

wplj(document).ready(function()
{
    if(wplj('#wpl_map_canvas<?php echo $this->activity_id; ?>').is(':visible')) wpl_pshow_map_init();
});

function wpl_pshow_map_init()
{
	if(wpl_map_initialized) return;
	
	wpl_initialize<?php echo $this->activity_id; ?>();
    
	/** restore the zoom level after the map is done scaling **/
	var listener = google.maps.event.addListener(wpl_map, 'idle', function(event)
	{
		wpl_map.setZoom(default_zoom);
        if(wpl_pshow_bounds_extended) setTimeout(function(){wpl_map.fitBounds(bounds)}, 2000);
        
		google.maps.event.removeListener(listener);
	});
	
    <?php if($this->googlemap_type == '1'): ?>
  	var panoramaOptions = 
    {
		position: marker.position,
		pov: 
		{
            heading: 34,
            pitch: 10,
            zoom: 1
		}
	};
    
	var panorama = new google.maps.StreetViewPanorama(document.getElementById('wpl_map_canvas<?php echo $this->activity_id; ?>'), panoramaOptions);
	wpl_map.setStreetView(panorama);
 	<?php endif; ?>
    
    <?php
    foreach($this->demographic_objects as $demographic_object)
    {
        $boundaries = $this->demographic->toBoundaties($demographic_object->item_extra1);
        ?>
            var demographicCoords = [];
            <?php foreach($boundaries as $boundary): ?>
            var position = new google.maps.LatLng(<?php echo $boundary['lat']; ?>, <?php echo $boundary['lng']; ?>);
            demographicCoords.push(position);
            bounds.extend(position);
            wpl_pshow_bounds_extended = true;
            <?php endforeach; ?>
        <?php
        if(strtolower($demographic_object->item_cat) == 'polygon')
        {
        ?>
            var polygon = new google.maps.Polygon(
            {
                paths: demographicCoords,
                strokeColor: '#1e74c7',
                strokeOpacity: 0.6,
                strokeWeight: 1,
                fillColor: '#1e90ff',
                fillOpacity: 0.3
            });
    
            polygon.setMap(wpl_map);
        <?php
        }
        elseif(strtolower($demographic_object->item_cat) == 'polyline')
        {
        ?>
            var polyline = new google.maps.Polyline(
            {
                path: demographicCoords,
                strokeColor: '#1e74c7',
                strokeOpacity: 1.0,
                strokeWeight: 2
            });
            
            polyline.setMap(wpl_map);
        <?php
        }
    }
    ?>
    
	/** set true **/
	wpl_map_initialized = true;
}
</script>