<?php
//var_export($data);
if ($data) : ?>
    <div class="nfl-container">
        <?php foreach ($data as $key => $conference) :
            $conferenceTitle = ($key == "AFC") ? "AMERICAN FOOTBALL CONFERENCE" : "NATIONAL FOOTBALL CONFERENCE";
        ?>
            <div class="nfl-conference">
                <div class="nfl-conference-title"><?= $conferenceTitle ?></div>
                <div class="nfl-conference-teams">
                    <?php foreach ($conference as $title => $group) : ?>
                        <div class="nfl-division">
                            <div class="nfl-division-title"><?= $key ?> <?= strtoupper($title) ?></div>
                            <?php foreach ($group as $team) : ?>
                                <div class="nfl-team"><?= $team->name; ?> <?= $team->nickname; ?></div>
                            <?php endforeach; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>