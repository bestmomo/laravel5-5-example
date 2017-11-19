<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => '屬性必須被接受。',
    'active_url'           => '屬性不是有效的URL。',
    'after'                => '屬性必須是日期之後的日期。',
    'after_or_equal'       => '屬性必須是日期之後或等於的日期。',
    'alpha'                => '屬性只能包含字母。',
    'alpha_dash'           => '屬性可能只包含字母，數字和破折號。',
    'alpha_num'            => '屬性可能只包含字母和數字。',
    'array'                => '屬性必須是一個數組。',
    'before'               => '屬性必須是日期之前的日期。',
    'before_or_equal'      => '屬性必須是日期之前或等於的日期',
    'between'              => [
        'numeric' => '屬性必須介於 :最小值和 :最大值之間。',
        'file'    => '屬性必須介於 :最小值和 :最大值千字節之間。',
        'string'  => '屬性必須介於 :最小和 :最大字符之間。',
        'array'   => '屬性必須介於 :最小和 :最大项目之間。',
    ],
    'boolean'              => '屬性字段必須是真或假。',
    'confirmed'            => '屬性確認不符。',
    'date'                 => '屬性日期無效。',
    'date_format'          => '屬性格式不匹配。',
    'different'            => '屬性必須與其它不同。',
    'digits'               => '屬性必須是數字。',
    'digits_between'       => '屬性必須介於 :最小和 :最大數字之間。',
    'dimensions'           => '屬性具有無效的圖像尺寸。',
    'distinct'             => '屬性字段具有重複的值。',
    'email'                => '屬性必須是有效的電子郵件地址。',
    'exists'               => '屬性無效。',
    'file'                 => '屬性必須是一個文件。',
    'filled'               => '屬性字段必須有一個值。',
    'image'                => '屬性必須是圖片。',
    'in'                   => '屬性無效。',
    'in_array'             => '屬性字段不存在於 :其它。',
    'integer'              => '屬性必須是整數。',
    'ip'                   => '屬性必須是有效的IP地址。',
    'ipv4'                 => '屬性必須是有效的IPv4地址。',
    'ipv6'                 => '屬性必須是有效的IPv6地址。',
    'json'                 => '屬性必須是有效的JSON字符串。',    
    'max'                  => [
        'numeric' => '屬性也許不能超過 :最大值。',
        'file'    => '屬性也許不能超過 :最大值千字節',
        'string'  => '屬性也許不能超過 :最大值字符。',
        'array'   => '屬性也許不能超過 :最大值項目。',
    ],
    'mimes'                => '屬性必須是一個文件類型 :值',
    'mimetypes'            => '屬性必須是一個文件類型 :值',   
    'min'                  => [
        'numeric' => '屬性必須小於 :最小值。',
        'file'    => '屬性必須小於 :最小值千字節。',
        'string'  => '屬性必須小於 :最小值字符之間。',
        'array'   => '屬性必須小於 :最小值項目之間。',
    ],    
    'not_in'               => '屬性無效.',
    'numeric'              => '屬性必須是數字.',
    'present'              => '屬性必須是當前.',
    'regex'                => '屬性格式無效.',
    'required'             => '屬性字段必須的.',
    'required_if'          => '屬性字段必須的：其它：值.',
    'required_unless'      => '屬性字段必須的否者：其它：值.',
    'required_with'        => '屬性字段必須的：當前值.',
    'required_with_all'    => '屬性字段必須的：當前值.',
    'required_without'     => '屬性字段必須的：非當前值.',
    'required_without_all' => '屬性字段必須的：非當前值.',
    'same'                 => '屬性與：其它值必須匹配.',    
    'size'                 => [
        'numeric' => '屬性必須是：尺寸',
        'file'    => '屬性必須是：尺寸千字節.',
        'string'  => '屬性必須是：尺寸字符.',
        'array'   => '屬性必須包含：尺寸項目.',
    ],
    'string'               => 'The :attribute must be a string.',
    'timezone'             => 'The :attribute must be a valid zone.',
    'unique'               => '屬性已經被使用.',
    'uploaded'             => 'The :attribute failed to upload.',
    'url'                  => 'The :attribute format is invalid.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'tags' => [
            'regex' => "以逗號分隔的標籤（不包含空格）最多50個字符.",
        ],
        'meta_keywords' => [
            'regex' => "K以逗號分隔的關鍵字（不包含空格）最多50個字符.",
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
