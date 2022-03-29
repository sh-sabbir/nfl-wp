<?php if ($data) : ?>
    <div class="nfl-style-4">
        <table id="basic" data-nfl-style-4>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Division</th>
                    <th>Conference</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $team) : ?>
                    <tr>
                        <td><?= $team->name; ?> <?= $team->nickname; ?></td>
                        <td><?= $team->division; ?></td>
                        <td><?= $team->conference; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>