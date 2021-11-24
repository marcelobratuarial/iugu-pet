<?php 

namespace App\Models;
use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'customers';
    protected $primaryKey = 'id';
    protected $protectFields = ['password'];
    protected $allowedFields = [
      'name',
      'email',
      'password',
      'confirmation',
      'code_sent',
      'confirmed',
      'created_at'
    ];
}