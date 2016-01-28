<?php
/**
 * Copyright (c) Apantic (apantic.com) 2016 to present.
 * All rights reserved.
 * @license All use is subject to the Apantic License Agreement (https://www.apantic.com/community/products/license-agreement)
 * @author: Apantic Team <support@apantic.com>
 */
class Apantic_TemplateSecurity_DataWriter_TemplateModification extends XFCP_Apantic_TemplateSecurity_DataWriter_TemplateModification
{
    protected function _preSave()
    {
        parent::_preSave();

        $config = XenForo_Application::getConfig()->toArray();

        if(isset($config['template_security'][$this->get('template')]))
        {
            $cfgData = explode(',', $config['template_security'][$this->get('template')]);
            $visitor = XenForo_Visitor::getInstance();

            if(!in_array($visitor['user_id'], $cfgData))
            {
                $this->error(new XenForo_Phrase('ats_you_cannot_edit_this_template'), 'template_security');

                $superAdmins = $this->getSuperAdmins();

                foreach($superAdmins AS $superAdmin)
                {
                    XenForo_Model_Alert::alert(
                        $superAdmin['user_id'],
                        $visitor['user_id'],
                        $visitor['username'],
                        'user',
                        $visitor['user_id'],
                        'forbidden_template'
                    );
                }
            }
        }
    }

    protected function getSuperAdmins()
    {
        $superAdmins = array();

        $admins = $this->_getAdminModel()->getAllAdmins();

        foreach($admins AS $userId => $data)
        {
            if($this->_getAdminModel()->isSuperAdmin($userId))
            {
                $superAdmins[$userId] = $data;
            }
        }

        return $superAdmins;
    }

    /**
     * @return XenForo_Model_Admin
     */
    protected function _getAdminModel()
    {
        return $this->getModelFromCache('XenForo_Model_Admin');
    }
}