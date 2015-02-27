<?php

/**
 * @author     Branko Wilhelm <branko.wilhelm@gmail.com>
 * @link       http://www.z-index.net
 * @license    GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

defined('_JEXEC') or die;

class XmapModelSitemap extends JModelAdmin
{
    protected $text_prefix = 'COM_XMAP_SITEMAPS';

    public function getTable($type = 'Sitemap', $prefix = 'XmapTable', $config = array())
    {
        return JTable::getInstance($type, $prefix, $config);
    }

    public function getItem($pk = null)
    {
        $item = parent::getItem($pk);

        $item->selections = new Joomla\Registry\Registry($item->selections);
        $item->selections = $item->selections->toArray();

        return $item;
    }

    public function getForm($data = array(), $loadData = true)
    {
        $form = $this->loadForm('com_xmap.sitemap', 'sitemap', array('control' => 'jform', 'load_data' => $loadData));
        if (empty($form)) {
            return false;
        }

        return $form;
    }


    protected function loadFormData()
    {
        $data = JFactory::getApplication()->getUserState('com_xmap.edit.sitemap.data', array());

        if (empty($data)) {
            $data = $this->getItem();
        }

        return $data;
    }

    public function getMenues()
    {
        $db = JFactory::getDbo();

        $query = $db->getQuery(true)
            ->select('m.*')
            ->from('#__menu_types AS m')
            ->order('m.title');

        $db->setQuery($query);

        return $db->loadObjectList('menutype');
    }
}