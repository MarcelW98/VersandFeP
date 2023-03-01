<?php

    function isAssoc(array $arr) {
        if (array() === $arr) return false;
        return array_keys($arr) !== range(0, count($arr) - 1);
    }

    function str_to_bool($value): bool {
        return (intval($value) == 1) ? true : false;
    }

    function getUpdateStrForFields(Array $editable_fields): string {
        $update_str = "";
        $editable_fields_length = count($editable_fields);
        foreach($editable_fields as $index=>$editable_field) {
            $update_str = $update_str . "{$editable_field} = :{$editable_field}";
            if ($index != $editable_fields_length - 1) {
                $update_str = $update_str . ", ";
            }
        }
        return $update_str;
    }

    function getAssocFromDataForAttributes(Array $data, Array $attributes): Array {
        $assoc_result = array();
    
        foreach ($attributes as &$attribute) {
          $assoc_result[$attribute] = empty($data[$attribute]) ? null : $data[$attribute];
        }
    
        return $assoc_result;
    }
?>