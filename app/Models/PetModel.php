<?php 

namespace App\Models;
use CodeIgniter\Model;

class PetModel extends Model
{
    protected $table = 'pets';
    protected $primaryKey = 'id';
    protected $protectFields = [];
    protected $allowedFields = [
      'name',
      'nascimento',
      'raca',
      'peso',
      'cid', // CUSTOMER ID
      'aid', // ASSINATURA ID
    ];
}