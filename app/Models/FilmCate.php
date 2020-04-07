<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FilmCate extends Model
{
    protected $table = "film_categories";

    public static function addNew($data)
    {
        try {
            return FilmCate::insert($data);
        } catch (Throwable $e) {
            return null;
        }
    }

    public static function updateRecord($id, $data)
    {
        try {
            return FilmCate::where('id', $id)->update($data);
        } catch (Throwable $e) {
            return null;
        }
    }

    public static function getList($page = 1)
    {
        $page--;
        try {
            return FilmCate::orderBy('created_at', 'desc')->skip($page * 10)->take(10)->get();
        } catch (Throwable $e) {
            return null;
        }
    }

    public static function getListQuery($query, $page = 0)
    {
        $page--;
        try {
            return FilmCate::where('name', 'like', '%' . $query . '%')->orderBy('created_at', 'desc')->skip($page * 10)->take(10)->get();
        } catch (Throwable $e) {
            return null;
        }
    }

    public static function getSum($query = null)
    {
        try {
            if ($query) {
                return ceil(FilmCate::where('name', 'like', '%' . $query . '%')->count() / 10);
            } else {
                return ceil(FilmCate::count() / 10);
            }

        } catch (Throwable $e) {
            return null;
        }
    }

    public static function deleteRecord($id)
    {
        try {
            $model = FilmCate::find($id);
            return $model->delete();
        } catch (Throwable $e) {
            return null;
        }
    }

    public static function getById($id)
    {
        try {
            return FilmCate::where('id', $id)->first();
        } catch (Throwable $e) {
            return null;
        }
    }

    public static function getNameById($id)
    {
        try {
            $model = FilmCate::find($id);
            return $model ? $model->name : '';
        } catch (Throwable $e) {
            return null;
        }
    }
}