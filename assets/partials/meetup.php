<?php
$data = fetchData("https://api.meetup.com/2/events?key=69476e3f5e26665263f4c4276201f19&group_urlname=Berlin-Mozilla-Meetup&sign=true");
$meetupStream = json_decode($data);
?>


<div class="events-wrapper">
    <div class="row">
        <div class="col-md-12">
            <div class="left">
                <?php
                $i=0;
                foreach ($meetupStream->results as $meetupItem) if ($i < 1) {
                    echo '<div class="row">';
                        echo '<div class="col-md-8">';
                            echo '<a href="'.$meetupItem->event_url.'" target="_blank">';
                            echo $meetupItem->name;
                            echo "<br/>";
                            echo $meetupItem->venue->name;
                            echo "<br/>";
                            echo $meetupItem->venue->address_1;
                            echo '</a>';
                        echo '</div>';
                        echo '<div class="col-md-4">';
                            echo "<span>". date("d.M.", $meetupItem->time / 1000) . "</span> ";
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
                            echo '<div class="col-md-8"><a href="'.$meetupItem->event_url.'" target="_blank">' . $meetupItem->name . '</a></div>';
                            // echo '<div class="col-md-4">' . date("Y-m-d H:i:s", $meetupItem->time / 1000) . '</div>';
                            echo '<div class="col-md-4">' . date("M d; H:i", $meetupItem->time / 1000) . '</div>';
                        echo '</div>';
                        $i +=1;
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>