<?php


namespace SimpleMvc\model;


use SimpleORM\model\Model;

class Task extends Model
{
    protected static ?string $table = 'tasks';

    protected static array $fields = ['id', 'username', 'email', 'text', 'status', 'created_at', 'updated_at'];
}