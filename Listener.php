<?php
/**
 * Copyright (c) Apantic (apantic.com) 2016 to present.
 * All rights reserved.
 * @license All use is subject to the Apantic License Agreement (https://www.apantic.com/community/products/license-agreement)
 * @author: Apantic Team <support@apantic.com>
 */
class Apantic_TemplateSecurity_Listener
{
    public static function extend_dw_template($class, &$extend)
    {
        $extend[] = 'Apantic_TemplateSecurity_DataWriter_Template';
    }

    public static function extend_dw_addon($class, &$extend)
    {
        $extend[] = 'Apantic_TemplateSecurity_DataWriter_AddOn';
    }
}