<?php if(!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<li>
<label class="typecho-label"><?php _e('Database Address'); ?></label>
<input type="text" class="text" name="dbHost" value="<?php _v('dbHost', 'localhost'); ?>"/>
<p class="description"><?php _e('You maybe use "localhost"'); ?></p>
</li>
<li>
<label class="typecho-label"><?php _e('Database Port'); ?></label>
<input type="text" class="text" name="dbPort" value="<?php _v('dbPort', '3306'); ?>"/>
<p class="description"><?php _e('If you don"t know the meaning of this option, leave it default value'); ?></p>
</li>
<li>
<label class="typecho-label"><?php _e('Database Username'); ?></label>
<input type="text" class="text" name="dbUser" value="<?php _v('dbUser', 'root'); ?>" />
<p class="description"><?php _e('You maybe use "root"'); ?></p>
</li>
<li>
<label class="typecho-label"><?php _e('Database Password'); ?></label>
<input type="password" class="text" name="dbPassword" value="<?php _v('dbPassword'); ?>" />
</li>
<li>
<label class="typecho-label"><?php _e('Database Name'); ?></label>
<input type="text" class="text" name="dbDatabase" value="<?php _v('dbDatabase', 'typecho'); ?>" />
<p class="description"><?php _e('Please enter the database name'); ?></p>
</li>
<input type="hidden" name="dbCharset" value="<?php _e('utf8'); ?>" />
