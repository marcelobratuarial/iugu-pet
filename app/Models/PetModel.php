<?php 

namespace App\Models;
use CodeIgniter\Model;

class PetModel extends Model
{
    protected $table = 'pets';
    protected $primaryKey = 'id';
    protected $protectFields = [];
    protected $allowedFields = [
      'pet_name',
      'pet_nasc',
      'pet_raca',
      'pet_peso',
      'cid', // CUSTOMER ID
      'aid', // ASSINATURA ID
    ];
}