<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Vendor;
use App\MainCategory;
use App\Http\Requests\VendorRequest;

class VendorsController extends Controller
{
    public function index(){
        $vendors = Vendor::paginate(Pagination_Count);
        return view('admin.vendors.index',compact('vendors'));
    }

    public function create(){
        $categories = MainCategory::where('translation_of',0)->active()->get();
        return view('admin.vendors.create',compact('categories'));

    }

    public function store(VendorRequest $request){
        try {
            if (!$request->has('active'))
                $request->request->add(['active' => 0]);
            else
                $request->request->add(['active' => 1]);

            $filePath = "";
            if ($request->has('logo')) {
                $filePath = uploadImage('vendors', $request->logo);
            }

            $vendor = Vendor::create([
                'name' => $request->name,
                'mobile' => $request->mobile,
                'email' => $request->email,
                'active' => $request->active,
                'address' => $request->address,
                'logo' => $filePath,
                'category_id'  => $request->category_id
            ]);

            // Notification::send($vendor, new VendorCreated($vendor));

            return redirect()->route('admin.vendors')->with(['success' => 'تم الحفظ بنجاح']);

        } catch (\Exception $ex) {

            return redirect()->route('admin.vendors')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);

        }
    }

    public function edit(){
        return view('admin.vendors.edit');
    }

    public function update(){

    }

    public function changeStatus(){

    }
}
