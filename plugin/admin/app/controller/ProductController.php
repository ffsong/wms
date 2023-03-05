<?php

namespace plugin\admin\app\controller;

use support\Request;
use support\Response;
use plugin\admin\app\model\Product;
use plugin\admin\app\controller\Crud;
use support\exception\BusinessException;

/**
 * 耗材产品 
 */
class ProductController extends Crud
{
    
    /**
     * @var Product
     */
    protected $model = null;

    /**
     * 构造函数
     * @return void
     */
    public function __construct()
    {
        $this->model = new Product;
    }
    
    /**
     * 浏览
     * @return Response
     */
    public function index(): Response
    {
        return view('product/index');
    }

    /**
     * 插入
     * @param Request $request
     * @return Response
     * @throws BusinessException
     */
    public function insert(Request $request): Response
    {
        if ($request->method() === 'POST') {
            return parent::insert($request);
        }

        $lastId = Product::query()
            ->orderBy('id', 'desc')
            ->value('id');

        // 根据最后一个耗材产品生成默认 耗材编号
        $itemNo = $lastId ? str_pad(($lastId + 1), 8, 0, STR_PAD_LEFT) :
            str_pad(1, 8, 0, STR_PAD_LEFT);

        return view('product/insert', ['item_no' => $itemNo]);
    }

    /**
     * 更新
     * @param Request $request
     * @return Response
     * @throws BusinessException
    */
    public function update(Request $request): Response
    {
        if ($request->method() === 'POST') {
            return parent::update($request);
        }
        return view('product/update');
    }

    /**
     * 查询
     * @param Request $request
     * @return Response
     * @throws BusinessException
     */
    public function select(Request $request): Response
    {
        [$where, $format, $limit, $field, $order] = $this->selectInput($request);
        $query = $this->doSelect($where, $field, $order);
        return $this->doFormat($query, $format, $limit);
    }


    /**
     * 格式化下拉列表
     * @param $items
     * @return Response
     */
    protected function formatSelect($items): Response
    {
        $formatted_items = [];
        foreach ($items as $item) {
            $formatted_items[] = [
                'name' => $item->title ?? $item->name ?? $item->id,
                'item_no' => $item->item_no,
                'value' => $item->id
            ];
        }
        return  $this->json(0, 'ok', $formatted_items);
    }
}
