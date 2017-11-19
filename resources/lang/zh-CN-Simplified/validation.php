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

    'accepted'             => '属性必须被接受。',
    'active_url'           => '属性不是有效的URL。',
    'after'                => '属性必须是日期之后的日期。',
    'after_or_equal'       => '属性必须是日期之后或等于的日期。',
    'alpha'                => '属性只能包含字母。',
    'alpha_dash'           => '属性可能只包含字母，数字和破折号。',
    'alpha_num'            => '属性可能只包含字母和数字。',
    'array'                => '属性必须是一个数组。',
    'before'               => '属性必须是日期之前的日期。',
    'before_or_equal'      => '属性必须是日期之前或等于的日期',
    'between'              => [
        'numeric' => '属性必须介于 :最小值和 :最大值之间。',
        'file'    => '属性必须介于 :最小值和 :最大值千字节之间。',
        'string'  => '属性必须介于 :最小和 :最大字符之间。',
        'array'   => '属性必须介于 :最小和 :最大项目之间。',
    ],
    'boolean'              => '属性字段必须是真或假。',
    'confirmed'            => '属性确认不符。',
    'date'                 => '属性日期无效。',
    'date_format'          => '属性格式不匹配。',
    'different'            => '属性必须与其它不同。',
    'digits'               => '属性必须是数字。',
    'digits_between'       => '属性必须介于 :最小和 :最大数字之间。',
    'dimensions'           => '属性具有无效的图像尺寸。',
    'distinct'             => '属性字段具有重复的值。',
    'email'                => '属性必须是有效的电子邮件地址。',
    'exists'               => '属性无效。',
    'file'                 => '属性必须是一个文件。',
    'filled'               => '属性字段必须有一个值。',
    'image'                => '属性必须是图片。',
    'in'                   => '属性无效。',
    'in_array'             => '属性字段不存在于 :其它。',
    'integer'              => '属性必须是整数。',
    'ip'                   => '属性必须是有效的IP地址。',
    'ipv4'                 => '属性必须是有效的IPv4地址。',
    'ipv6'                 => '属性必须是有效的IPv6地址。',
    'json'                 => '属性必须是有效的JSON字符串。',
    'max'                  => [
        'numeric' => '属性也许不能超过 :最大值。',
        'file'    => '属性也许不能超过 :最大值千字节。',
        'string'  => '属性也许不能超过 :最大值字符。',
        'array'   => '属性也许不能超过 :最大值项目。',
    ],
    'mimes'                => '属性必须是一个文件类型 :值.',
    'mimetypes'            => '属性必须是一个文件类型 :值.',
    'min'                  => [
        'numeric' => '属性必须小于 :最小值。',
        'file'    => '属性必须小于 :最小值千字节。',
        'string'  => '属性必须小于 :最小值字符。',
        'array'   => '属性必须小于 :最小值项目。',
    ],
    'not_in'               => '属性无效',
    'numeric'              => '属性必须是数字。',
    'present'              => '属性必须是当前',
    'regex'                => '属性格式无效',
    'required'             => '属性字段必须的',
    'required_if'          => '属性字段必须的 :其它 :值.',
    'required_unless'      => '属性字段必须的否者 :其它 :值.',
    'required_with'        => '属性字段必须的 :当前值.',
    'required_with_all'    => '属性字段必须的 :当前值.',
    'required_without'     => '属性字段必须的 :非当前值.',
    'required_without_all' => '属性字段必须的 :非当前值.',
    'same'                 => '属性与 :其它值必须匹配.',
    'size'                 => [
        'numeric' => '属性必须是 :尺寸.',
        'file'    => '属性必须是 :尺寸 千字节.',
        'string'  => '属性必须是 :尺寸 字符.',
        'array'   => '属性必须包含 :尺寸 项目.',
    ],
    'string'               => '属性必须是字符串.',
    'timezone'             => '属性必须有效域.',
    'unique'               => '属性已经被使用.',
    'uploaded'             => '属性上传失效.',
    'url'                  => '属性格式无效.',

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
            'regex' => "以逗号分隔的标签（不包含空格）最多50个字符.",
        ],
        'meta_keywords' => [
            'regex' => "以逗号分隔的关键字（不包含空格）最多50个字符.",
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
