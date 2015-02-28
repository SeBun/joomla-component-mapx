<?php

/**
 * @author     Guillermo Vargas <guille@vargas.co.cr>
 * @author     Branko Wilhelm <branko.wilhelm@gmail.com>
 * @link       http://www.z-index.net
 * @license    GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

defined('_JEXEC') or die;

class XmapControllerAjax extends JControllerLegacy
{
    public function editElement()
    {
        try {
            $result = $this->handleEditElement();
            $message = $result->message;
            unset($result->message);

            echo new JResponseJson($result, $message);
        } catch (Exception $e) {
            echo new JResponseJson($e);
        }
    }

    protected function handleEditElement()
    {
        if (!JSession::checkToken()) {
            throw new InvalidArgumentException(JText::_('JINVALID_TOKEN'));
        }

        $input = JFactory::getApplication()->input;
        $user = JFactory::getUser();
        $model = $this->getModel('sitemap');

        if (!$user->authorise('core.edit', 'com_xmap.sitemap.' . $input->getInt('id'))) {
            throw new InvalidArgumentException(JText::_('JERROR_ALERTNOAUTHOR'));
        }

        if (!$model->getItem()) {
            throw new InvalidArgumentException(JText::_('JGLOBAL_RESOURCE_NOT_FOUND'));
        }

        $action = $input->getCmd('action');
        $uid = $input->getCmd('uid');
        $itemid = $input->getInt('itemid');

        if (!$uid || !$itemid || !$action) {
            throw new InvalidArgumentException(JText::_('JERROR_AN_ERROR_HAS_OCCURRED'));
        }

        $result = new stdClass;
        $result->state = -1;

        switch ($action) {
            case 'toggleElement':
                $result->state = $model->toggleItem($uid, $itemid);

                if ($result->state) {
                    $result->message = JText::_('JPUBLISHED');
                } else {
                    $result->message = JText::_('JUNPUBLISHED');
                }

                break;

            // TODO implement in html view
            case 'changeProperty':
                $property = $input->getCmd('property');
                $value = $input->getCmd('value');

                if (!$property || !$value) {
                    throw new InvalidArgumentException(JText::_('JERROR_AN_ERROR_HAS_OCCURRED'));
                }

                $result->state = $model->chageItemPropery($uid, $itemid, 'xml', $property, $value);

                if ($result->state) {
                    $result->message = ''; // TODO
                } else {
                    $result->message = ''; // TODO
                }

                break;
        }

        return $result;
    }
}