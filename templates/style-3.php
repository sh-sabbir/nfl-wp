<?php
//var_export($data);
if ($data) : ?>
    <div class="nfl-container nfl-style-3">
        <div class="nfl-conference">
            <div class="nfl-conference-teams">
                <?php foreach ($data as $key => $conference) :
                    foreach ($conference as $title => $group) : ?>
                        <div class="nfl-division">
                            <div class="nfl-division-title"><?= $key ?> <?= strtoupper($title) ?></div>
                            <?php foreach ($group as $team) : ?>
                                <div class="nfl-team"><?= $team->name; ?> <?= $team->nickname; ?></div>
                            <?php endforeach; ?>
                        </div>
                <?php endforeach;
                endforeach; ?>
            </div>
        </div>
    </div>
<?php endif; ?>