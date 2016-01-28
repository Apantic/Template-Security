<?php
/**
 * Copyright (c) Apantic (apantic.com) 2016 to present.
 * All rights reserved.
 * @license All use is subject to the Apantic License Agreement (https://www.apantic.com/community/products/license-agreement)
 * @author: Apantic Team <support@apantic.com>
 */
class Apantic_TemplateSecurity_DataWriter_AddOn extends XFCP_Apantic_TemplateSecurity_DataWriter_AddOn
{
    protected function _preSave()
    {
        if($this->get('addon_id') == 'aTemplateSecurity' && !$this->_getAdminModel()->isSuperAdmin(XenForo_Visitor::getUserId()))
        {
            $this->error(new XenForo_Phrase('ats_you_cannot_disable_this_addon'), 'template_security');
        }
    }

    /**
     * @return XenForo_Model_Admin
     */
    protected function _getAdminModel()
    {
        return $this->getModelFromCache('XenForo_Model_Admin');
    }
}