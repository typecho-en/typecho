<?php if(!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<li>
<label class="typecho-label"><?php _e('Database Address'); ?></label>
<input type="text" class="text" name="dbHost" value="<?php _v('dbHost', 'localhost'); ?>"/>
<p class="description"><?php _e('You may be using it "localhost"'); ?></p>
</li>
<li>
<label class="typecho-label"><?php _e('Database Ports'); ?></label>
<input type="text" class="text" name="dbPort" value="<?php _v('dbPort', '5432'); ?>"/>
<p class="description"><?php _e('If you do not know the meaning of this option, please keep the default Settings'); ?></p>
</li>
<li>
<label class="typecho-label"><?php _e('Database username'); ?></label>
<input type="text" class="text" name="dbUser" value="<?php _v('dbUser', 'postgres'); ?>" />
<p class="description"><?php _e('You may be using it "postgres"'); ?></p>
</li>
<li>
<label class="typecho-label"><?php _e('Database password'); ?></label>
<input type="password" class="text" name="dbPassword" value="<?php _v('dbPassword'); ?>" />
</li>
<li>
<label class="typecho-label"><?php _e('Database name'); ?></label>
<input type="text" class="text" name="dbDatabase" value="<?php _v('dbDatabase', 'typecho'); ?>" />
<p class="description"><?php _e('Please specify the name of the database'); ?></p>
</li>
<input type="hidden" name="dbCharset" value="<?php _e('utf8'); ?>" />
