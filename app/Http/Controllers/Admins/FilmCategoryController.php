<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\FilmCate;
use Illuminate\Http\Request;

class FilmCategoryController extends Controller
{
    public function index($page = 1, $query = null)
    {
        $sum = 0;
        $page = $page < 1 ? 1 : $page;
        if ($query == null || $query == '') {
            $sum = FilmCate::getSum();
            $page = $page > $sum ? $sum : $page;
            $data = FilmCate::getList($page);
        } else {
            $sum = FilmCate::getSum($query);
            $page = $page > $sum ? $sum : $page;
            $data = FilmCate::getListQuery($query, $page);
            $data->query = $query;
        }
        $data->sum = $sum;
        if ($page == $sum) {
            $data->page = $sum;
            $data->next = $sum;
            $data->prev = $page - 1;
        } else {
            $data->page = $page;
            $data->next = $page + 1;
            $data->prev = $page - 1;
        }
        return view('admin.filmcates.list')->with('data', $data);
    }

    public function getAddFilmCate(Request $request)
    {
        return view('admin.filmcates.add');
    }

    public function postAddFilmCate(Request $request)
    {
        // name
        $name = $request->name;
        if (!$name) {
            $name = "FilmCate " . time();
        }

        // // coverFile
        // $coverFile = $request->cover;
        // $cover = "";
        // if ($request->hasFile('cover')) {
        //     $cover = time() . '.' . $request->cover->extension();
        //     $request->cover->storeAs('img/FilmCates/', $cover);
        //     $cover .= '?n=' . time();
        // }

        $data = [
            'name' => $name,
            // 'avatar' => $cover,
            'created_at' => date('Y-m-d H:i:s'),
        ];

        $result = FilmCate::addNew($data);
        if ($result) {
            toastr()->success('Thêm mới thành công');
            return redirect()->route('adgetListFilmCate');
        } else {
            toastr()->error('Thêm mới thất bại');
            return redirect()->route('adgetListFilmCate');
        }
    }

    public function getEditFilmCate($id)
    {
        $data = FilmCate::getById($id);
        if ($data) {
            return view('admin.filmcates.edit')->with('data', $data);
        } else {
            return redirect()->route('adgetListFilmCate');
        }
    }

    public function postEditFilmCate($id, Request $request)
    {
        // name
        $name = $request->name;
        if (!$name) {
            $name = "FilmCate " . time();
        }

        // // coverFile
        // $coverFile = $request->cover;
        // $cover = "";
        // if ($request->hasFile('cover')) {
        //     $cover = time() . '.' . $request->cover->extension();
        //     $request->cover->storeAs('img/FilmCates/', $cover);
        //     $cover .= '?n=' . time();
        // }

        $data = [
            'name' => $name,
            'created_at' => date('Y-m-d H:i:s'),
        ];

        // if ($cover != "") {
        //     $data['avatar'] = $cover;
        // }

        $result = FilmCate::updateRecord($id, $data);

        if ($result) {
            toastr()->success('Chỉnh sửa thành công');
            return redirect()->route('adgetListFilmCate');
        } else {
            toastr()->error('Chỉnh sửa thất bại');
            return redirect()->back();
        }
    }

    public function getDelFilmCate($id)
    {
        $result = FilmCate::deleteRecord($id);
        if ($result) {
            toastr()->success('Xóa thành công');
            return redirect()->route('adgetListFilmCate')->with('success', 'Xóa thành công!');
        } else {
            toastr()->error('Xóa thất bại');
            return redirect()->route('adgetListFilmCate')->with('error', 'Xóa thất bại!');
        }
    }

}