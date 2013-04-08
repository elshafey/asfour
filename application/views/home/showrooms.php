<style type="text/css">
    .inside-banner{
        background-image: URL(<?php echo get_static_url($banner_path);?>)!important;
    }
</style>
<div class="inside-banner"></div>
<div class="inside-menu">
    <a href="<?php echo site_url(get_routed_url(URL_PREFIX_PAGE_CONTACTUS)) ?>" class="<?php echo isset($contact_us) ? $contact_us : ''; ?>">Contact Us</a>
    <span class="separator"></span>
    <a href="<?php echo site_url(get_routed_url(URL_PREFIX_SHOWROOMS)) ?>" class="<?php echo isset($active_showrooms) ? $active_showrooms : ''; ?>">Showrooms locations</a>
</div>
<div class="clear"></div>
<h1 class="left_title">
    <?php echo $page_title ?>
</h1>
<div class="news-section" style="width: 500px;float: left;">
    <?php foreach ($showrooms as $item) { ?>
        <div class="news-title"><?php echo $item['name']; ?></div>
        <ul>
            <li><strong>Address:</strong> <?php echo $item['address']; ?></li>
            <?php if (!empty($item['tel']) && !is_null($item['tel'])) { ?>
                <li><strong>Tel.:</strong> <?php echo $item['tel']; ?></li>
            <?php } ?>

            <?php if (!empty($item['fax']) && !is_null($item['fax'])) { ?>
                <li><strong>Fax:</strong> <?php echo $item['fax']; ?></li>
            <?php } ?>
        </ul>
        <div class="news-separator"></div>
    <?php } ?>
</div>

<script src="http://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script>
<div id="map" style="width: 400px; height: 300px;float: left;margin-left: 47px;border: 4px solid #E5E3DF;"></div>

<script type="text/javascript">
    var locations = [
<?php foreach ($showrooms as $item) { ?>
            ['<?php echo $item['name']; ?> <li><strong>Address:</strong> <?php echo $item['address']; ?></li><li><strong>Tel.:</strong> <?php echo $item['tel']; ?></li><li><strong>Fax:</strong> <?php echo $item['fax']; ?></li>', <?php echo $item['latitude']; ?>, <?php echo $item['longitude']; ?>, 4],
<?php } ?>
                           
    ];

    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 7,
        center: new google.maps.LatLng(30.04442, 31.235712),
        mapTypeId: google.maps.MapTypeId.ROADMAP
    })
    var infowindow = new google.maps.InfoWindow();
    var marker, i;
    for (i = 0; i < locations.length; i++) {  
        marker = new google.maps.Marker({
            position: new google.maps.LatLng(locations[i][1], locations[i][2]),
            map: map
        });
        google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function() {
                infowindow.setContent(locations[i][0]);
                infowindow.open(map, marker);
            }
        })(marker, i));
    }
</script>
