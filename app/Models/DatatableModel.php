<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DatatableModel extends Model
{
    use HasFactory;
    protected $table;
    protected $primaryKey;
    protected $builder;

    public function __construct($table, $primaryKey = 'id')
    {
        $this->table = $table;
        $this->primaryKey = $primaryKey;
        $this->builder = DB::table($this->table);
    }

    public function getData()
    {
        return $this->builder->get();
    }

    public function select($sql)
    {
        return $this->builder->select($sql);
    }

    public function setWhere($column, $value, $operator = null)
    {
        $this->builder->where($column, $operator, $value);
    }

    public function setWhereIn($column, $value)
    {
        $this->builder->whereIn($column, $value);
    }

    public function setJoin($table, $first, $operator = null, $second = null, $type = 'inner', $where = false)
    {
        $this->builder->join($table, $first, $operator, $second, $type, $where);
    }

    public function setGroupBy($column)
    {
        $this->builder->groupBy($column);
    }

    public function setOrder($column, $direction = 'asc')
    {
        $this->builder->orderBy($column, $direction);
    }

    public function setOffset($length, $start)
    {
        if ($start === 0) {
            $this->builder->limit($length);
        } else {
            $this->builder->limit($length, $start);
        }
    }

    public function setPaginate($value)
    {
        $this->builder->paginate($value);
    }

    public function countTotal()
    {
        return $this->builder->count();
    }
}
