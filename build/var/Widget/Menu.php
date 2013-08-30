<?php
/**
 * Typecho Blog Platform
 *
 * @copyright  Copyright (c) 2008 Typecho team (http://www.typecho.org)
 * @license    GNU General Public License 2.0
 * @version    $Id$
 */

/**
 * Background menu display
 *
 * @package Widget
 */
class Widget_Menu extends Typecho_Widget
{
    /**
     * Parent menu list
     *
     * @access private
     * @var array
     */
    private $_parentMenu = array();

    /**
     * Submenu list
     *
     * @access private
     * @var array
     */
    private $_childMenu = array();

    /**
     * Current parent menu
     *
     * @access private
     * @var integer
     */
    private $_currentParent = 1;

    /**
     * The current submenu
     *
     * @access private
     * @var integer
     */
    private $_currentChild = 0;

    /**
     * The current page
     *
     * @access private
     * @var string
     */
    private $_currentUrl;

    /**
     * Global options
     *
     * @access protected
     * @var Widget_Options
     */
    protected $options;

    /**
     * User object
     *
     * @access protected
     * @var Widget_User
     */
    protected $user;

    /**
     * Current menu title
     * @var string
     */
    public $title;
    
    /**
     * Current projects links
     * @var string
     */
    public $addLink;

    /**
     * Constructor to initialize component
     *
     * @access public
     * @param mixed $request requestObject
     * @param mixed $response responseObject
     * @param mixed $params Parameter list
     * @return void
     */
    public function __construct($request, $response, $params = NULL)
    {
        parent::__construct($request, $response, $params);

        /** Initialize the common components */
        $this->options = $this->widget('Widget_Options');
        $this->user = $this->widget('Widget_User');
    }

    /**
     * Execute the function, initialize menu
     *
     * @access public
     * @return void
     */
    public function execute()
    {
        $this->_parentMenu = array(NULL, _t('Console'), _t('Create'), _t('Management'), _t('Setting'));

        $this->_childMenu =  array(
        array(
            array(_t('Login'), _t('Log on to the%s', $this->options->title), 'login.php', 'visitor'),
            array(_t('Registration'), _t('Registered with the%s', $this->options->title), 'register.php', 'visitor')
        ),
        array(
            array(_t('Overview'), _t('Site summary'), 'index.php', 'subscriber'),
            array(_t('Personal settings'), _t('Personal settings'), 'profile.php', 'subscriber'),
            array(_t('Plug-in'), _t('Plug-in management'), 'plugins.php', 'administrator'),
            array(array('Widget_Plugins_Config', 'getMenuTitle'), array('Widget_Plugins_Config', 'getMenuTitle'), 'options-plugin.php?config=', 'administrator', true),
            array(_t('Themes'), _t('Site theme'), 'themes.php', 'administrator'),
            array(array('Widget_Themes_Files', 'getMenuTitle'), array('Widget_Themes_Files', 'getMenuTitle'), 'theme-editor.php', 'administrator', true),
            array(array('Widget_Themes_Config', 'getMenuTitle'), array('Widget_Themes_Config', 'getMenuTitle'), 'options-theme.php', 'administrator', true),
            array(_t('Upgrade'), _t('Upgrade programs'), 'upgrade.php', 'administrator', true),
            array(_t('Welcome'), _t('Welcome to use'), 'welcome.php', 'subscriber', true)
        ),
        array(
            array(_t('Writing articles'), _t('Write a new post'), 'write-post.php', 'contributor'),
            array(array('Widget_Contents_Post_Edit', 'getMenuTitle'), array('Widget_Contents_Post_Edit', 'getMenuTitle'), 'write-post.php?cid=', 'contributor', true),
            array(_t('CreatePage'), _t('CreateNew page'), 'write-page.php', 'editor'),
            array(array('Widget_Contents_Page_Edit', 'getMenuTitle'), array('Widget_Contents_Page_Edit', 'getMenuTitle'), 'write-page.php?cid=', 'editor', true),
        //    array(_t('Uploading photos'), _t('Upload new photo'), '/admin/edit-photo.php', 'contributor')
        ),
        array(
            array(_t('Articles'), _t('Management articles'), 'manage-posts.php', 'contributor', false, Typecho_Common::url('write-post.php', $this->options->adminUrl)),
            array(array('Widget_Contents_Post_Admin', 'getMenuTitle'), array('Widget_Contents_Post_Admin', 'getMenuTitle'), 'manage-posts.php?uid=', 'contributor', true),
            array(_t('Pages'), _t('Management pages'), 'manage-pages.php', 'editor', false, Typecho_Common::url('write-page.php', $this->options->adminUrl)),
            array(_t('Comments'), _t('Manage comments'), 'manage-comments.php', 'contributor'),
            array(array('Widget_Comments_Admin', 'getMenuTitle'), array('Widget_Comments_Admin', 'getMenuTitle'), 'manage-comments.php?cid=', 'contributor', true),
        //    array(_t('File'), _t('Managing files'), '/admin/files.php', 'editor'),
            array(_t('Tag& Categories'), _t('Tag& Categories'), 'manage-metas.php', 'editor'),
            array(_t('Attachment'), _t('Manage Attachments'), 'manage-medias.php', 'editor'),
            array(array('Widget_Contents_Attachment_Edit', 'getMenuTitle'), array('Widget_Contents_Attachment_Edit', 'getMenuTitle'), 'media.php?cid=', 'contributor', true),
            array(_t('User'), _t('Manage user'), 'manage-users.php', 'administrator', false, Typecho_Common::url('user.php', $this->options->adminUrl)),
            array(_t('New users'), _t('New users'), 'user.php', 'administrator', true),
            array(array('Widget_Users_Edit', 'getMenuTitle'), array('Widget_Users_Edit', 'getMenuTitle'), 'user.php?uid=', 'administrator', true),
        //    array(_t('Links'), _t('Manage Links'), '/admin/manage-links.php', 'administrator'),
        //    array(_t('Link Categories'), _t('Manage Link Categories'), '/admin/manage-link-cat.php', 'administrator'),
        ),
        array(
            array(_t('Basic'), _t('Basic Settings'), 'options-general.php', 'administrator'),
            array(_t('Comment'), _t('Comments Set'), 'options-discussion.php', 'administrator'),
            array(_t('Article'), _t('Reading settings'), 'options-reading.php', 'administrator'),
        //    array(_t('Wrote'), _t('Set writing habits'), '/admin/option-writing.php', 'contributor'),
        //    array(_t('Permissions'), _t('Permission settings'), '/admin/access.php', 'administrator'),
        //    array(_t('Mail'), _t('Mail settings'), '/admin/mail.php', 'administrator'),
            array(_t('Permalink'), _t('Permalink settings'), 'options-permalink.php', 'administrator'),
        ));

        /** Get extended menu */
        $panelTable = unserialize($this->options->panelTable);
        $extendingParentMenu = empty($panelTable['parent']) ? array() : $panelTable['parent'];
        $extendingChildMenu = empty($panelTable['child']) ? array() : $panelTable['child'];

        foreach ($extendingParentMenu as $key => $val) {
            $this->_parentMenu[10 + $key] = $val;
        }

        foreach ($extendingChildMenu as $key => $val) {
            $this->_childMenu[$key] = isset($this->_childMenu[$key]) ? $this->_childMenu[$key] : array();
            if (isset($this->_parentMenu[$key])) {
                $this->_childMenu[$key] = array_merge($this->_childMenu[$key], $val);
            }
        }

        $this->_currentUrl = $this->request->makeUriByRequest();
        $childMenu = $this->_childMenu;
        $adminUrl = $this->options->adminUrl;

        foreach ($childMenu as $parentKey => $parentVal) {
            foreach ($parentVal as $childKey => $childVal) {
                $link = Typecho_Common::url($childVal[2], $adminUrl);

                $currentParts = parse_url($this->_currentUrl);
                $parts = parse_url($link);

                /** Precise alignment */
                if ($currentParts['path'] == $parts['path']) {
                    $validate = true;

                    if (!empty($parts['query'])) {
                        parse_str($parts['query'], $out);
                        if (empty($currentParts['query'])) {
                            $validate = false;
                        } else {
                            parse_str($currentParts['query'], $currentOut);

                            if (!empty($out)) {
                                if (!empty($currentOut)) {
                                    foreach ($out as $outKey => $outVal) {
                                        if (!isset($currentOut[$outKey])) {
                                            $validate = false;
                                            break;
                                        }
                                    }
                                } else {
                                    $validate = false;
                                }
                            }
                        }
                    }

                    if ($validate) {
                        $this->_currentParent =  $parentKey;
                        $this->_currentChild =  $childKey;
                    }
                }

                if ('visitor' != $childVal[3] && !$this->user->pass($childVal[3], true)) {
                    unset($this->_childMenu[$parentKey][$childKey]);
                }
            }

            if (0 == count($this->_childMenu[$parentKey])) {
                unset($this->_parentMenu[$parentKey]);
            }
        }

        $level = isset($this->_childMenu[$this->_currentParent][$this->_currentChild][3]) ?
        $this->_childMenu[$this->_currentParent][$this->_currentChild][3] : 'administrator';
        if ('visitor' != $level) {
            $this->user->pass($level);
        }
        
        if (isset($this->_childMenu[$this->_currentParent][$this->_currentChild][5])) {
            $this->addLink = $this->_childMenu[$this->_currentParent][$this->_currentChild][5];
        }

        if (is_array($this->_childMenu[$this->_currentParent][$this->_currentChild][1])) {
            list($widget, $method) = $this->_childMenu[$this->_currentParent][$this->_currentChild][1];
            $this->title = Typecho_Widget::widget($widget)->$method();
        } else {
            $this->title = $this->_childMenu[$this->_currentParent][$this->_currentChild][1];
        }

        array_shift($this->_parentMenu);
        array_shift($this->_childMenu);
        $this->_currentParent --;
    }

    /**
     * Get the current menu
     *
     * @access public
     * @return array
     */
    public function getCurrentMenu()
    {
        return $this->_currentParent < 0 ? NULL : $this->_childMenu[$this->_currentParent][$this->_currentChild];
    }

    /**
     * Output parent menu
     *
     * @access public
     * @return string
     */
    public function output($class = 'focus', $childClass = 'focus')
    {
        $adminUrl = $this->options->adminUrl;

        foreach ($this->_parentMenu as $key => $title) {
            $current = reset($this->_childMenu[$key]);
            $link = Typecho_Common::url($current[2], $adminUrl);

            echo "<dt" . ($key == $this->_currentParent ? ' class="' . $class . '"' : NULL) . "><a href=\"{$link}\" title=\"{$title}\">{$title}</a></dt>\n";

            echo "<dd><ul>\n";
            foreach ($this->_childMenu[$key] as $inkey => $menu) {
                if (!isset($menu[4]) || !$menu[4] || ($key == $this->_currentParent && $inkey == $this->_currentChild)) {
                    $link = Typecho_Common::url($menu[2], $adminUrl);

                    if (is_array($menu[0])) {
                        list($widget, $method) = $menu[0];
                        $title = $this->widget($widget)->$method();
                    } else {
                        $title = $menu[0];
                    }

                    echo "<li" . ($key == $this->_currentParent && $inkey == $this->_currentChild ? ' class="' . $childClass . '"' : NULL) .
                    "><a href=\"" . ($key == $this->_currentParent && $inkey == $this->_currentChild ? $this->_currentUrl : $link) .
                    "\" title=\"{$title}\">{$title}</a></li>\n";
                }
            }
            echo "</ul></dd>\n";
        }
    }
}
 