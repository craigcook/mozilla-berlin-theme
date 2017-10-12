<?php
$data = fetchData("https://api.meetup.com/2/events?key=69476e3f5e26665263f4c4276201f19&group_urlname=Berlin-Mozilla-Meetup&sign=true");
$meetupStream = json_decode($data);
?>


<div class="events-wrapper">
    <div class="row">
        <div class="col-md-12">
           <h3 class="headline meetup-logo-wrapper"><img class="meetup-logo" width="110" height="31" src="<?php echo get_template_directory_uri() ?>/assets/img/meetup-logo-script.svg" /> <span>Events</span></h3>
            <div class="left">
                <?php
                $i=0;
                foreach ($meetupStream->results as $meetupItem) if ($i < 1) {
                    echo '<div class="row">';
                        echo '<div class="col-xs-6 col-md-8">';
                            echo '<a href="'.$meetupItem->event_url.'" target="_blank">';
                            echo $meetupItem->name;
                            echo "<span class='venue-name'>";
                            echo $meetupItem->venue->name;
                            echo "</span><span class='venue-adress'>";
                            echo $meetupItem->venue->address_1;
                            echo '</span></a>';
                        echo '</div>';
                        echo '<div class="col-xs-6 col-md-4">';
                            echo "<span class='date'>". date("M d;") . "</span> ";
                            echo date("H:i", $meetupItem->time / 1000);
                        echo '</div>';
                    echo '</div>';
                $i +=1;
                }
                ?>
            </div>
        </div>
        <div class="col-md-12">
            <div class="right">
                <?php
                foreach ($meetupStream->results as $meetupItem) if ($i < 6) {
                    if ($i == 1) {
                        $i +=1;
                    } else {
                        echo '<div class="row">';
                            echo '<div class="col-xs-6 col-md-8"><a href="'.$meetupItem->event_url.'" target="_blank">' . $meetupItem->name . '</a></div>';
                            // echo '<div class="col-md-4">' . date("Y-m-d H:i:s", $meetupItem->time / 1000) . '</div>';
                            echo '<div class="col-xs-6 col-md-4">' . date("M d; H:i", $meetupItem->time / 1000) . '</div>';
                        echo '</div>';
                        $i +=1;
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>