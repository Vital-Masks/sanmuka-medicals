<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Event;
use App\Category;
use App\SubCategory;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:administrator');
    }

    // public function __construct(){
    //     $this->middleware('auth');
    // }
    // public function showEventdet($id)
    // {
    //     $event = Event::where('id', $id)->firstorFail();
    //     return view('eventDetail')->with('event', $event);
    // }

    public function showProducts()
    {
        // $event = Event::orderBy('created_at', 'desc')->get();
        // return view('cate')->with('event', $event); 
        return view('shop');
    }

    public function showSingleProduct()
    {
        // $event = Event::orderBy('created_at', 'desc')->get();
        // return view('cate')->with('event', $event); 
        return view('singleproduct');
    }

    ////Add Category
    public function addCategory(Request $request)
    {


        if ($request->isMethod('post')) {
            $request->validate([
                'CategoryName' => 'required|max:30',
            ]);

            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            $category = new Category;
            $category->name = $data['CategoryName'];
            $category->slug = strtolower($data['CategoryName']);
            $category->save();

            return redirect()->back()->with('flash_message_success', 'Category added Successfully!');
        } else {


            $categories = Category::orderByDesc('id')->get();

            //Categories Table
            $categoriestable = "<td></td>";
            foreach ($categories as $cat) {
                $categoriestable .= "<tr></tr>";
                $categoriestable .= "<td>$cat->name</td>";
                $categoriestable .= "<td style='text-align: right;'>
                                        <a href='/admin/edit-category/$cat->id'
                                            class='btn btn-sm bg-warning'>
                                            <i class='fas fa-edit'></i>
                                        </a>
                                        <a href='/admin/delete-category/$cat->id'
                                            class='btn btn-sm bg-warning' id='dltCat'>
                                            <i class='fas fa-trash'></i>
                                        </a>
                                    </td>";

                $subcategory = Subcategory::where(['category_id' => $cat->id])->get();
                foreach ($subcategory as $subcat) {
                    $categoriestable .= "<tr ></tr>";
                    $categoriestable .= "<td style='background-color:#d9d9d9'><i class='fas fa-circle' style='font-size: 10px; margin-right: 5px'></i>$subcat->name</td>";
                    $categoriestable .= "<td style='text-align: right; background-color:#d9d9d9'>
                 
                    <a href='/admin/delete-subcategory/$subcat->id'
                        class='btn btn-sm bg-warning' id='dltCat'>
                        <i class='fas fa-trash'></i>
                    </a>
                </td>";
                }
            }

            return view('admin.addCategory', ['categories' => $categories])->with(compact('categoriestable'));
        }
    }

    ////Edit Category
    public function editCategory(Request $request, $id = null)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'CategoryName' => 'required|max:30',
            ]);

            $data = $request->all();
            Category::where(['id' => $id])->update([
                'name' => $data['CategoryName'], 'slug' => strtolower($data['CategoryName'])
            ]);
            return redirect()->route('AddCategory')->with('flash_message_success', 'Category updated Successfully!');
        } else {
            $categoryDetails = Category::where(['id' => $id])->first();
            $categories = Category::orderByDesc('id')->paginate(10);


            //Categories Table
            $categoriestable = "<td></td>";
            foreach ($categories as $cat) {
                $categoriestable .= "<tr></tr>";
                $categoriestable .= "<td>$cat->name</td>";
                $categoriestable .= "<td style='text-align: right;'>
                                     <a href='/admin/edit-category/$cat->id'
                                         class='btn btn-sm bg-warning'>
                                         <i class='fas fa-edit'></i>
                                     </a>
                                     <a href='/admin/delete-category/$cat->id'
                                         class='btn btn-sm bg-warning' id='dltCat'>
                                         <i class='fas fa-trash'></i>
                                     </a>
                                 </td>";

                $subcategory = Subcategory::where(['category_id' => $cat->id])->get();
                foreach ($subcategory as $subcat) {
                    $categoriestable .= "<tr ></tr>";

                    $categoriestable .=
                        "<td style='background-color:#d9d9d9'>
                    <i class='fas fa-circle' style='font-size: 10px; margin-right: 5px'></i>$subcat->name
                </td>";

                    $categoriestable .=
                        "<td style='text-align: right; background-color:#d9d9d9'>
                    <a href='/admin/delete-subcategory/$subcat->id'
                        class='btn btn-sm bg-warning' id='dltCat'>
                        <i class='fas fa-trash'></i>
                    </a>
                </td>";
                }
            }

            return view('admin.addCategory', ['categories' => $categories])->with(compact('categoryDetails'))->with(compact('categoriestable'));
        }
    }

    ////Delete Category
    public function deleteCategory($id = null)
    {
        if (!empty($id)) {
            Category::where(['id' => $id])->delete();
            return redirect()->back()->with('flash_message_success', 'Category deleted Successfully!');
        }
    }

    ////Delete sub Category
    public function deleteSubCategory($id = null)
    {
        if (!empty($id)) {
            SubCategory::where(['id' => $id])->delete();
            return redirect()->back()->with('flash_message_success', 'SubCategory deleted Successfully!');
        }
    }

    /////Sub Category function
    ////Add Sub Category
    public function addSubCategory(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            $subcategory = new SubCategory;
            $subcategory->category_id = $data['MainCategoryName'];
            $subcategory->name = $data['SubCategoryName'];
            $subcategory->slug = strtolower($data['SubCategoryName']);
            $subcategory->save();

            return redirect()->back()->with('flash_message_success', 'Sub Category added Successfully!');
        } else {
        }
    }


    //get sub category with category category_id
    public function getSubCategory($id)
    {
        $subcategory = SubCategory::where(['category_id' => $id])->get();
        return response($subcategory);
    }
}
