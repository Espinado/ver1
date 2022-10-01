<?php

namespace App\Repositories;

use App\Interfaces\BrandRepositoryInterface;
use App\Models\Admins\Brand;

class BrandRepository implements BrandRepositoryInterface
{

    public function getAllBrands()
    {
        return Brand::all();
    }
    public function getBrandById($brandId)
    {
    }
    public function deleteBrand($brandId)
    {
    }
    public function createBrand(array $brandDetails)
    {
    }
    public function updateBrand($brandId, array $newDetails)
    {
    }
}
