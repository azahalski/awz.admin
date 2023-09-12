<?php

namespace Awz\Admin;

use Bitrix\Main\Error;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ORM;
use Bitrix\Main\Result;
use Bitrix\Main\Text\StringHelper;
use Bitrix\Main\Type\DateTime;

Loc::loadMessages(__FILE__);

class ContactTable extends ORM\Data\DataManager
{
    public static $fields;

    public static function getFilePath()
    {
        return __FILE__;
    }

    public static function getTableName()
    {
        return '';
    }

    public static function isMultipleSupport(string $type){
        $supportsType = [
            'enum','enumeration','crm_status','crm_category',
            'crm_multifield',
            'crm','crm_company', 'crm_lead','crm_contact','crm_deal',
            'url', 'string','double','float','integer',
            'date', 'datetime',
            'money','user','group','employee'
        ];
        if(in_array($type, $supportsType)){
            return true;
        }
        return false;
    }

    public static function getMap()
    {
        $fields = array();

        //echo'<pre>';print_r(self::$fields);echo'</pre>';
        foreach(self::$fields as $key=>$field){

            $fieldOrm = null;
            if($field['isMultiple'] && !self::isMultipleSupport($field['type'])){
                continue;
            }

            if($field['type'] == 'integer'){
                $fieldOrm = (new ORM\Fields\IntegerField($key, array(
                        'title' => $field['title']
                    )
                ));
                if(mb_strtolower($key)=='id'){
                    $fieldOrm->configurePrimary()->configureAutocomplete();
                }
            }
            if($field['type'] == 'string'){
                $fieldOrm = (new ORM\Fields\StringField($key, array(
                        'title' => $field['title']
                    )
                ));
            }
            if($field['type'] == 'double'){
                $fieldOrm = (new ORM\Fields\FloatField($key, array(
                        'title' => $field['title']
                    )
                ));
            }
            if($field['type'] == 'float'){
                $fieldOrm = (new ORM\Fields\FloatField($key, array(
                        'title' => $field['title']
                    )
                ));
            }
            if($field['type'] == 'url'){
                $fieldOrm = (new ORM\Fields\StringField($key, array(
                        'title' => $field['title']
                    )
                ));
            }
            if($field['type'] == 'email'){
                $fieldOrm = (new ORM\Fields\StringField($key, array(
                        'title' => $field['title']
                    )
                ));
            }
            if($field['type'] == 'boolean'){
                $fieldOrm = (new ORM\Fields\BooleanField($key, array(
                        'title' => $field['title']
                    )
                ));
            }
            if($field['type'] == 'crm'){
                $fieldOrm = (new ORM\Fields\StringField($key, array(
                        'title' => $field['title'],
                        'settings'=>$field['settings']
                    )
                ));
            }
            if($field['type'] == 'crm_entity'){
                $fieldOrm = (new ORM\Fields\StringField($key, array(
                        'title' => $field['title'],
                        'settings'=>$field['settings']
                    )
                ));
            }
            if($field['type'] == 'crm_deal'){
                $fieldOrm = (new ORM\Fields\StringField($key, array(
                        'title' => $field['title']
                    )
                ));
            }
            if($field['type'] == 'crm_contact'){
                $fieldOrm = (new ORM\Fields\StringField($key, array(
                        'title' => $field['title']
                    )
                ));
            }
            if($field['type'] == 'crm_lead'){
                $fieldOrm = (new ORM\Fields\StringField($key, array(
                        'title' => $field['title']
                    )
                ));
            }
            if($field['type'] == 'crm_company'){
                $fieldOrm = (new ORM\Fields\StringField($key, array(
                        'title' => $field['title']
                    )
                ));
            }
            if($field['type'] == 'crm_status' && !empty($field['values'])){
                $fieldOrm = (new ORM\Fields\EnumField($key, array(
                        'title' => $field['title']
                    )
                ))->configureValues($field['values']);
            }
            if($field['type'] == 'crm_category' && !empty($field['values'])){
                $fieldOrm = (new ORM\Fields\EnumField($key, array(
                        'title' => $field['title']
                    )
                ))->configureValues($field['values']);
            }
            if($field['type'] == 'crm_currency'){
                if(!empty($field['values'])){
                    $fieldOrm = (new ORM\Fields\EnumField($key, array(
                            'title' => $field['title']
                        )
                    ))->configureValues($field['values']);
                }else{
                    $fieldOrm = (new ORM\Fields\StringField($key, array(
                            'title' => $field['title']
                        )
                    ));
                }
            }
            if($field['type'] == 'crm_multifield'){
                $fieldOrm = (new ORM\Fields\StringField($key, array(
                        'title' => $field['title']
                    )
                ));
            }
            if($field['type'] == 'enum' && !empty($field['values'])){
                $fieldOrm = (new ORM\Fields\EnumField($key, array(
                        'title' => $field['title']
                    )
                ))->configureValues($field['values']);
            }
            if($field['type'] == 'enumeration' && !empty($field['values'])){
                $fieldOrm = (new ORM\Fields\EnumField($key, array(
                        'title' => $field['title']
                    )
                ))->configureValues($field['values']);
            }
            if($field['type'] == 'user'){
                $fieldOrm = (new ORM\Fields\IntegerField($key, array(
                        'title' => $field['title']
                    )
                ));
            }
            if($field['type'] == 'group'){
                $fieldOrm = (new ORM\Fields\IntegerField($key, array(
                        'title' => $field['title']
                    )
                ));
            }
            if($field['type'] == 'employee'){
                $fieldOrm = (new ORM\Fields\IntegerField($key, array(
                        'title' => $field['title']
                    )
                ));
            }
            if($field['type'] == 'datetime'){
                $fieldOrm = (new ORM\Fields\DateTimeField($key, array(
                        'title' => $field['title']
                    )
                ));
            }
            if($field['type'] == 'date'){
                $fieldOrm = (new ORM\Fields\DateField($key, array(
                        'title' => $field['title']
                    )
                ));
            }
            if($field['type'] == 'money'){
                $fieldOrm = (new ORM\Fields\StringField($key, array(
                        'title' => $field['title']
                    )
                ));
            }


            if($fieldOrm && $field['isRequired']){
                $fieldOrm->configureRequired();
            }
            if($fieldOrm){
                if($field['sort']){
                    $fieldOrm->setParameter('sortable', $field['sort']);
                }else{
                    $fieldOrm->setParameter('sortable', false);
                }
                $fieldOrm->setParameter('isReadOnly', $field['isReadOnly']);
                if(!isset($field['noFilter'])) $field['noFilter'] = '';
                $fieldOrm->setParameter('isFiltered', !$field['noFilter']);
                $fields[$key] = $fieldOrm;
            }
        }

        return $fields;
    }
}