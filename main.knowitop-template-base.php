<?php

namespace Knowitop;

/**
 * Interface iObjectTemplate
 * @package Knowitop
 */
interface iObjectTemplate
{
    /**
     * @return string
     */
    public function GetTargetClass();

    /**
     * @param array $aParams
     * @return \DBObject
     */
    public function CreateTargetObject($aParams = array());
}

interface TemplateInterface {
//    public static function CreateFromTemplate(\ObjectTemplate $oTemplate);

    public function FillFromTemplate(\ObjectTemplate $oTemplate);
}

class CreateFromTemplateExtension implements \iPopupMenuExtension
{
    /**
     * Get the list of items to be added to a menu.
     *
     * This method is called by the framework for each menu.
     * The items will be inserted in the menu in the order of the returned array.
     * @param int $iMenuId The identifier of the type of menu, as listed by the constants MENU_xxx
     * @param mixed $param Depends on $iMenuId, see the constants defined above
     * @return object[] An array of ApplicationPopupMenuItem or an empty array if no action is to be added to the menu
     */
    public static function EnumItems($iMenuId, $param)
    {
        $aResult = array();

        switch ($iMenuId)
        {
            case \iPopupMenuExtension::MENU_OBJDETAILS_ACTIONS:

                if ($param instanceof \ObjectTemplate) {
                    $oTemplate = $param;
                    $sClass = $oTemplate->GetTargetClass();
                    // TODO: проверка прав пользоваеля на создание объектов $oTemplate->GetTargetClass;

//                    $oAppContext = new \ApplicationContext();
//                    $sParams = $oAppContext->GetForLink();

                    $sDefault = "&default[sKey]=sValue";
                    $sURL = \utils::GetAbsoluteUrlAppRoot()."pages/UI.php?operation=new&class=$sClass&$sDefault";

                    $aResult[] = new \SeparatorPopupMenuItem();
                    $aResult[] = new \URLPopupMenuItem('create_from_template', 'Create from template...', $sURL, '');
                }

                break;

            case \iPopupMenuExtension::MENU_OBJLIST_ACTIONS:
                break;

            case \iPopupMenuExtension::MENU_OBJLIST_TOOLKIT:
                break;

        }
        return $aResult;
    }
}

