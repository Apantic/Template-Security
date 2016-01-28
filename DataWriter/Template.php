<?php
/**
 * Copyright (c) Apantic (apantic.com) 2016 to present.
 * All rights reserved.
 * @license All use is subject to the Apantic License Agreement (https://www.apantic.com/community/products/license-agreement)
 * @author: Apantic Team <support@apantic.com>
 */
class Apantic_TemplateSecurity_DataWriter_Template extends XFCP_Apantic_TemplateSecurity_DataWriter_Template
{
    protected function _preSave()
    {
        parent::_preSave();

        $config = XenForo_Application::getConfig()->toArray();

        if($this->isChanged('template') && isset(strtolower($config['template_security'][$this->get('title')])))
        {
            $cfgData = explode(',', strtolower($config['template_security'][$this->get('title')]));

            if(!in_array(XenForo_Visitor::getUserId(), $cfgData))
            {
                $this->error(new XenForo_Phrase('ats_you_cannot_edit_this_template'), 'template_security');
            }
        }
    }
}