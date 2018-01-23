<?php

namespace Goodwong\LaravelCategory\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    /**
     * table name
     */
    protected $table = 'categories';

    /**
     * fillable fields
     */
    protected $fillable = [
        'slug', // 供程序调用的名字 （2018/1/22添加）
        'vocabulary', // string, 所属分类，如： shop_3_categories
        'parent_id', // 可以嵌套，从而形成树形结构
        'name', // required
        'position', // 排序
        'status', // 由业务需求定义 e.g. draft | active | hidden
        'settings', // json，业务自由定义
    ];
    
    /**
     * date
     */
    protected $dates = [
        'deleted_at',
    ];

    /**
     * cast attributes
     */
    protected $casts = [
        'settings' => 'object',
    ];
}
