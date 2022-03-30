<div id="nfl-wp-wrap">
    <div class="nfl-wp-page-content">
        <?php
        // var_export($settings);
        $nonce = wp_create_nonce('nfl-settings');
        $apiKey = isset($settings['apiKey']) ? $settings['apiKey'] : '';
        $isCache = isset($settings['isCache']) ? (($settings['isCache']) ? ' checked="checked"' : '') : '';
        $cacheTime = isset($settings['cacheTime']) ? $settings['cacheTime'] : null;
        $isDisabled = (empty($isCache)) ? 'disabled' : '';
        ?>

        <h1><?php _e('NFL WP Settings', 'nfl-wp'); ?> <small><?php _e('version:', 'nfl-wp'); ?><?php echo NFLWP_VERSION; ?></small></h1>
        <hr>
        <br><br>
        <h2><?php _e('Api Settings', 'nfl-wp'); ?></h2>
        <h4><?php _e('Configure remote endpoint & API key', 'nfl-wp'); ?></h4>
        <div class="content-card">
            <form id="apiForm">
                <input type="hidden" id="nflNonce" value="<?php echo $nonce; ?>">
                <div class="control-group">
                    <div class="label">
                        <label for="apiKey"><?php _e('Api key', 'nfl-wp'); ?> <span class="required">*</span></label>
                    </div>
                    <div class="control">
                        <input type="text" name="apiKey" id="apiKey" value="<?php echo $apiKey; ?>">
                    </div>
                </div>

                <div class="control-group">
                    <div class="label">
                        <label><?php _e('Enable cache', 'nfl-wp'); ?></label>
                    </div>
                    <div class="control cache-control">
                        <label class="toggle-control">
                            <input type="checkbox" name="isCache" id="isCache" <?php echo $isCache; ?>>
                            <span class="switch"></span>
                        </label>
                        <div id="cache-time-wrap" class="cache-time <?php echo $isDisabled; ?>">
                            <div class="label">
                                <label><?php _e('Cache results for', 'nfl-wp'); ?></label>
                            </div>
                            <input type="number" name="cacheTime" min="1" max="99" id="cacheTime" value="<?php echo $cacheTime; ?>">
                            <div><?php _e('minutes', 'nfl-wp'); ?></div>
                        </div>
                    </div>
                </div>
                <input type="submit" name="submit" id="submit" class="button button-primary" value="Save Changes">
            </form>
        </div>

        <h2><?php _e('Shortcode Generator', 'nfl-wp'); ?></h2>
        <h4><?php _e('Choose the shortcode you need', 'nfl-wp'); ?></h4>
        <div class="content-card">
            <div class="control-group">
                <div class="label">
                    <label for="designSelector"><?php _e('Select a design', 'nfl-wp'); ?> <span class="required">*</span></label>
                </div>
                <div class="control">
                    <select name="designSelector" id="designSelector">
                        <option value="1"><?php _e('Horizontal List [Conference]', 'nfl-wp'); ?></option>
                        <option value="2"><?php _e('Vertical List [Conference]', 'nfl-wp'); ?></option>
                        <option value="3"><?php _e('Horizontal List [Groups]', 'nfl-wp'); ?></option>
                        <option value="4"><?php _e('Table with Search and Sorting', 'nfl-wp'); ?></option>
                    </select>
                </div>
            </div>

            <div class="control-group">
                <div class="label">
                    <label for="shortcode"><?php _e('Shortcode', 'nfl-wp'); ?></label>
                </div>
                <div class="control shortcode">
                    <input type="text" name="shortcode" id="shortcode" value="[nfl layout=1]" readonly>
                    <div id="copyShortcode" class="button button-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-copy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <rect x="8" y="8" width="12" height="12" rx="2"></rect>
                            <path d="M16 8v-2a2 2 0 0 0 -2 -2h-8a2 2 0 0 0 -2 2v8a2 2 0 0 0 2 2h2"></path>
                        </svg>
                        <span><?php _e('Copy', 'nfl-wp'); ?></span>
                    </div>
                </div>
            </div>
        </div>

        <h2><?php _e('Preview', 'nfl-wp'); ?></h2>
        <h4><?php _e('See the preview of the selected shortcode', 'nfl-wp'); ?></h4>
        <div class="content-card">
            <div id="layout-1" class="layout-wrap" style="display: block;">
                <div class="layout-title"><?php _e('Horizontal List', 'nfl-wp'); ?></div>
                <div class="layout">
                    <img src="<?php echo NFLWP_ASSETS . 'img/layout_1.png'; ?>" alt="layout-1">
                </div>
            </div>

            <div id="layout-2" class="layout-wrap">
                <div class="layout-title"><?php _e('Vertical List', 'nfl-wp'); ?></div>
                <div class="layout">
                    <img src="<?php echo NFLWP_ASSETS . 'img/layout_2.png'; ?>" alt="layout-2">
                </div>
            </div>

            <div id="layout-3" class="layout-wrap">
                <div class="layout-title"><?php _e('Table with Filter and Sorting', 'nfl-wp'); ?></div>
                <div class="layout">
                    <img src="<?php echo NFLWP_ASSETS . 'img/layout_3.png'; ?>" alt="layout-3">
                </div>
            </div>

            <div id="layout-4" class="layout-wrap">
                <div class="layout-title"><?php _e('Table with Filter and Sorting', 'nfl-wp'); ?></div>
                <div class="layout">
                    <img src="<?php echo NFLWP_ASSETS . 'img/layout_4.png'; ?>" alt="layout-3">
                </div>
            </div>
        </div>
    </div>
</div>