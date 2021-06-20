<?php

namespace App\Enums;

abstract class eRespCode
{
    // Common
    const _403_NOT_AUTHORIZED = ['403_00' => 'Not Authorized'];
    const _400_BAD_REQUEST = ['400_00' => 'Bad Request'];
    const _500_INTERNAL_ERROR = ['500_00' => 'Internal Error'];
    const _520_UNKNOWN_ERROR = ['520_00' => 'Unknown Error'];
    const _200_OK = ['200_00' => 'OK'];
    const _404_NOT_FOUND = ['404_00' => 'Not Found'];


    // User

    // 200
    const U_LISTED_200_00 = ['U200_00' => 'Users succesfully listed !'];
    const U_UPDATED_200_01 = ['U200_01' => 'User succesfully updated !'];
    const U_DELETED_200_02 = ['U200_02' => 'User succesfully deleted !'];
    const U_GET_200_03 = ['U200_03' => 'User succesfully retreived !'];
    // 201
    const U_CREATED_201_00 = ['U201_00' => 'User succesfully created !'];

    // Task

    // 200
    const T_LISTED_200_00 = ['T200_00' => 'Tasks succesfully listed !'];
    const T_UPDATED_200_01 = ['T200_01' => 'Task succesfully updated !'];
    const T_DELETED_200_02 = ['T200_02' => 'Task succesfully deleted !'];
    const T_GET_200_03 = ['T200_03' => 'Task succesfully retreived !'];
    // 201
    const T_CREATED_201_00 = ['T201_00' => 'Task succesfully created !'];

    // Category

    // 200
    const CAT_LISTED_200_00 = ['CAT200_00' => 'Categories succesfully listed !'];
    const CAT_UPDATED_200_01 = ['CAT200_01' => 'Category succesfully updated !'];
    const CAT_DELETED_200_02 = ['CAT200_02' => 'Category succesfully deleted !'];
    const CAT_GET_200_03 = ['CAT200_03' => 'Category succesfully retreived !'];
    // 201
    const CAT_CREATED_201_00 = ['CAT201_00' => 'Category succesfully created !'];
}
