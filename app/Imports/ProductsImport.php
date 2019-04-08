<?php

namespace App\Imports;

use App\Quote;
use App\Category;
use App\ParentCategory;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Auth;
//, WithHeadingRow
class ProductsImport implements ToModel
{

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row1)
    {

            $row = explode(';',$row1[0]);

           if(sizeof($row) == 16  && $row[15] == "false" ){

                $product = Quote::query()->where('file_id', 'like', $row[6])->first();

               if (!$product) {

                    $full_category = $row[1];
                    $category_id = 0;
                    $parent_category_id = 0;
                    if (strpos($full_category, '/') !== false) {
                        $cats = explode( '/',$full_category);
                        $parent_category = ParentCategory::query()->where('name', $cats[0])->first();
                        if (!$parent_category) {
                            $parent_category = ParentCategory::create([
                                'name' => $cats[0],
                                'admin_id' => Auth::guard('admin')->user()->id,
                            ]);
                            $parent_category_id = $parent_category->id;
                        } else {
                            $parent_category_id = $parent_category->id;
                        }
                        $category = Category::query()->where('name', $cats[1])->where('parent_category_id', $parent_category_id)->first();
                        if (!$category) {
                            $category = Category::create([
                                'name' => $cats[1],
                                'parent_category_id' => $parent_category_id,
                                'admin_id' => Auth::guard('admin')->user()->id,
                            ]);
                            $category_id = $category->id;
                        } else {
                            $category_id = $category->id;
                        }
                    } else {
                        $category = Category::query()->where('name', $full_category)->where('parent_category_id', 1)->first();
                        if (!$category) {
                            $category = Category::create([
                                'name' => $full_category,
                                'parent_category_id' => 1,
                                'admin_id' => Auth::guard('admin')->user()->id,
                            ]);
                            $category_id = $category->id;
                        } else {
                            $category_id = $category->id;
                        }
                        $parent_category_id = 1;

                    }

                    $add = new Quote([
                        'available' => 0,
                        'category_id' => $category_id ?? 0,
                        'parent_category_id' => $parent_category_id ?? 0,
                        'commission_rate' => $row[2] ?? '',
                        'currency_id' => $row[3] ?? '',
                        'discount' => $row[4] ?? '',
                        'file_id' => $row[6] ?? '',
                        'end_date' => $row[5] ?? '',
                        'image' => $row[7] ?? '',
                        'modified_time' => $row[8] ?? '',
                        'name' => $row[9] ?? '',
                        'old_price' => $row[10] ?? '',
                        'price' => $row[11] ?? '',
                        'title' => $row[12] ?? '',
                        'type' => $row[13] ?? '',
                        'coupon_url' => $row[14] ?? '',
                        'admin_id' => Auth::guard('admin')->user()->id,
                    ]);

                    return $add;

                }
            }
        //}
    }
}
