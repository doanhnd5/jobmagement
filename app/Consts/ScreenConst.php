<?php

namespace App\Consts;

class ScreenConst
{

    public const  PROCESS_STATUS_SUCCESS      = 'success';
    public const  PROCESS_STATUS_ERROR        = 'error';
    public const  PROCESS_STATUS_SYSTEM_ERROR = 'syserr';

    public const MAX_PER_PAGE               = 30;
    public const MAX_PER_PAGE_JOB_HOME_PAGE = 12;
    public const MAX_PER_PAGE_HOME_LIST = 6;

    // Khu vực
    public const JOB_AREA_KYUSHU  = 'kyushu';
    public const JOB_AREA_CHUGOKU = 'chugoku';
    public const JOB_AREA_KANSAI  = 'kansai';
    public const JOB_AREA_CHUBU   = 'chubu';
    public const JOB_AREA_KANTO   = 'kanto';
    public const JOB_AREA_TOHOKU  = 'tohoku';
    public const JOB_AREA_HOKKAIDO = 'hokkaido';
    public const JOB_AREA_NAME  = [
        self::JOB_AREA_KYUSHU  => 'Vùng Kyushu',
        self::JOB_AREA_CHUGOKU => 'Vùng Chugoku',
        self::JOB_AREA_KANSAI  => 'Vùng Kansai (Kinki)',
        self::JOB_AREA_CHUBU   => 'Vùng Chubu',
        self::JOB_AREA_KANTO   => 'Vùng Kanto',
        self::JOB_AREA_TOHOKU   => 'Vùng Tohoku',
        self::JOB_AREA_HOKKAIDO => 'Vùng Hokkaido'
    ];

    // Nghành nghề
    public const JOB_TYPE_BAITO       = 'batito';
    public const JOB_TYPE_EMPLOYEE    = 'employee';
    public const JOB_TYPE_TOKUTEIGINO = 'tokuteigino';
    public const JOB_TYPE_NAME = [
        self::JOB_TYPE_BAITO       => 'Baito',
        self::JOB_TYPE_EMPLOYEE    => 'Nhân viên chính thức',
        self::JOB_TYPE_TOKUTEIGINO => 'Tokutei Gino',
    ];

    // Trình độ tiếng Nhật
    public const JAPANESE_LEVEL_N1 = 'n1';
    public const JAPANESE_LEVEL_N2 = 'n2';
    public const JAPANESE_LEVEL_N3 = 'n3';
    public const JAPANESE_LEVEL_N4 = 'n4';
    public const JAPANESE_LEVEL_N5 = 'n5';
    public const JAPANESE_LEVEL_NAME = [
        self::JAPANESE_LEVEL_N1 => 'N1 - Tương đương N1',
        self::JAPANESE_LEVEL_N2 => 'N2 - Tương đương N2',
        self::JAPANESE_LEVEL_N3 => 'N3 - Tương đương N3',
        self::JAPANESE_LEVEL_N4 => 'N4 - Tương đương N4',
        self::JAPANESE_LEVEL_N5 => 'N5 - Tương đương N5',
    ];

    // Tình trạng việc làm
    public const WORK_STATUS_EMPLOYEE          = 'employee';
    public const WORK_STATUS_EMPLOYEE_CONTRACT = 'employee_contract';
    public const WORK_STATUS_EMPLOYEE_HAKEN    = 'employee_haken';
    public const WORK_STATUS_EMPLOYEE_PARTIME  = 'employee_partime';
    public const WORK_STATUS_EMPLOYEE_TOKUTEI  = 'employee_tokutei';
    public const WORK_STATUS_EMPLOYEE_NAME = [
        self::WORK_STATUS_EMPLOYEE          => 'Nhân viên chính thức',
        self::WORK_STATUS_EMPLOYEE_CONTRACT => 'Nhân viên hợp đồng',
        self::WORK_STATUS_EMPLOYEE_HAKEN    => 'Nhân viên phái cử',
        self::WORK_STATUS_EMPLOYEE_PARTIME  => 'Làm thêm bán thời gian',
        self::WORK_STATUS_EMPLOYEE_TOKUTEI  => 'Thực tập sinh, đặc định',
    ];

    // Thời gian làm việc
    public const WORK_TIME_ONE_YEAR_DOWN  = 'less_1_year';
    public const WORK_TIME_ONE_THREE_YEAR = 'from_1_to_3';
    public const WORK_TIME_FIVE_YEAR      = 'greater_3';
    public const WORK_TIME_NAME = [
        self::WORK_TIME_ONE_YEAR_DOWN  => 'Dưới 1 năm',
        self::WORK_TIME_ONE_THREE_YEAR => 'Từ 1 đến 3 năm',
        self::WORK_TIME_FIVE_YEAR      => 'Trên 3 năm'
    ];

    // Phân loại trường
    public const COLLEAGE_TYPE_UNIVERSITY   = 'university';
    public const COLLEAGE_TYPE_JUNIOR       = 'junior';
    public const COLLEAGE_TYPE_INTERMEDIATE = 'intermediate';
    public const COLLEAGE_TYPE_HIGH_SCHOOL  = 'high_school';
    public const COLLEAGE_TYPE_MIDDLE_SCHOOL = 'middle_school';
    public const COLLEAGE_TYPE_NAME = [
        self::COLLEAGE_TYPE_UNIVERSITY    => 'Đại học',
        self::COLLEAGE_TYPE_JUNIOR        => 'Cao đẳng',
        self::COLLEAGE_TYPE_INTERMEDIATE  => 'Trung cấp - Nghề',
        self::COLLEAGE_TYPE_HIGH_SCHOOL   => 'Cấp 3',
        self::COLLEAGE_TYPE_MIDDLE_SCHOOL => 'Cấp 2'
    ];

    // Phân loại tốt nghiệp
    public const GRADUATE_TYPE_EXCELENT = 'excelent';
    public const GRADUATE_TYPE_GOOD     = 'good';
    public const GRADUATE_TYPE_MIDDLE   = 'middle';
    public const GRADUATE_TYPE_MEDIUM   = 'medium';
    public const GRADUATE_TYPE_NAME = [
        self::GRADUATE_TYPE_EXCELENT => 'Xuất sắc',
        self::GRADUATE_TYPE_GOOD     => 'Giỏi',
        self::GRADUATE_TYPE_MIDDLE   => 'Khá',
        self::GRADUATE_TYPE_MEDIUM   => 'Trung bình',
    ];

    // Đã liên hệ / Chưa liên hệ
    public const IS_CONTACTED     = '1';
    public const IS_NOT_CONTACTED = '0';
    public const CONTACT_STATUS   = [
        "" => 'Tất cả',
        self::IS_NOT_CONTACTED => 'Chưa liên hệ',
        self::IS_CONTACTED     => 'Đã liên hệ',
    ];

    // Giới tính
    public const GENDER_MALE   = '0';
    public const GENDER_FEMALE = '1';
    public const GENDER_OTHER  = '2';
    public const GENDER_NAME   = [
        self::GENDER_MALE   => 'Nam',
        self::GENDER_FEMALE => 'Nữ',
        self::GENDER_OTHER  => 'Khác',
    ];
}
