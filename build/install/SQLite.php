<?php if(!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $defaultDir = dirname($_SERVER['SCRIPT_FILENAME']) . '/usr/' . uniqid() . '.db'; ?>
<li>
<label class="typecho-label"><?php _e('The database file path'); ?></label>
<input type="text" class="text" name="dbFile" value="<?php _v('dbFile', $defaultDir); ?>"/>
<p class="description"><?php _e('"%s" is the address of we generated automatically for you', $defaultDir); ?></p>
</li>
