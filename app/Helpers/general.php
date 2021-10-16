<?php

function _getAllCategories()
{
    $categories = \App\Category::all();
    return $categories;
}
