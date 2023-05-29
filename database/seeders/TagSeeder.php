<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        \DB::table('tags')->insert([
            [
                'type' => 'application',
                'name' => 'Tuyển gấp',
            ],
            [
                'type' => 'application',
                'name' => 'Tuyển số lượng lớn',
            ],
            [
                'type' => 'application',
                'name' => 'Có thể ứng tuyển cùng bạn bè',
            ],
            [
                'type' => 'application',
                'name' => 'Trả lương theo ngày',
            ],
            [
                'type' => 'application',
                'name' => 'Không cần hồ sơ xin việc',
            ],
            [
                'type' => 'application',
                'name' => 'Phỏng vấn 1 lần',
            ],
            [
                'type' => 'salary',
                'name' => 'Có tiền thưởng vào công ty',
            ],
            [
                'type' => 'salary',
                'name' => 'Có thưởng',
            ],
            [
                'type' => 'salary',
                'name' => 'Thu nhập cao',
            ],
            [
                'type' => 'salary',
                'name' => 'Trả lương theo tuần',
            ],
            [
                'type' => 'salary',
                'name' => 'Tra lương bẳng tiền mặt',
            ],
            [
                'type' => 'salary',
                'name' => 'Có thể ứng trước lương',
            ],
            [
                'type' => 'way_working',
                'name' => 'Làm việc ngắn hạn',
            ],
            [
                'type' => 'way_working',
                'name' => 'Làm việc dài hạn',
            ],
            [
                'type' => 'way_working',
                'name' => 'Không tăng ca',
            ],
            [
                'type' => 'way_working',
                'name' => 'Có thể làm việc trong thời gian ngắn',
            ],
            [
                'type' => 'personnel_searched',
                'name' => 'Mới tốt nghiệp',
            ],
            [
                'type' => 'personnel_searched',
                'name' => 'Chuyển việc',
            ],
            [
                'type' => 'personnel_searched',
                'name' => 'Giành cho du học sinh',
            ],
            [
                'type' => 'experience',
                'name' => 'Không quan trọng bằng cấp',
            ],
            [
                'type' => 'experience',
                'name' => 'Không yêu cầu kinh nghiệm',
            ],
            [
                'type' => 'experience',
                'name' => 'Ưu tiên có kinh nghiệm',
            ],
            [
                'type' => 'experience',
                'name' => 'Ưu tiên người có bằng cấp chỉ định',
            ],
            [
                'type' => 'experience',
                'name' => 'Biết sử dụng máy tính',
            ],
            [
                'type' => 'experience',
                'name' => 'Biết tiếng Anh',
            ],
            [
                'type' => 'experience',
                'name' => 'Biết tiếng Trung',
            ],
            [
                'type' => 'welfare',
                'name' => 'Có hỗ trợ ăn uống',
            ],
            [
                'type' => 'welfare',
                'name' => 'Có hỗ trợ đi lại',
            ],
            [
                'type' => 'welfare',
                'name' => 'Có kỹ túc xá công ty',
            ],
            [
                'type' => 'welfare',
                'name' => 'Hỗ trợ tiền nhà',
            ],
            [
                'type' => 'welfare',
                'name' => 'Hỗ trợ toàn bộ bảo hiểm',
            ],
            [
                'type' => 'welfare',
                'name' => 'Có đưa đón',
            ],
            [
                'type' => 'welfare',
                'name' => 'Có kiến tập trước khi vào làm',
            ],
            [
                'type' => 'welfare',
                'name' => 'Có hỗ trợ thi chứng chỉ',
            ],
            [
                'type' => 'welfare',
                'name' => 'Có giảm giá cho nhân viên',
            ],
            [
                'type' => 'welfare',
                'name' => 'Hỗ trợ nuôi con',
            ],
            [
                'type' => 'vacation',
                'name' => 'Có chế độ nghỉ dài',
            ],
            [
                'type' => 'vacation',
                'name' => 'Có chế độ nghỉ nuôi con',
            ],
            [
                'type' => 'vacation',
                'name' => 'Hỗ trợ nghỉ sinh',
            ],
            [
                'type' => 'corona',
                'name' => 'Làm tại nhà 100%',
            ],
            [
                'type' => 'corona',
                'name' => 'Có thể làm việc tại nhà',
            ],
            [
                'type' => 'corona',
                'name' => 'Thời gian làm việc không cố đinh',
            ],
            [
                'type' => 'corona',
                'name' => 'Làm việc thời gian rảnh',
            ],
            [
                'type' => 'corona',
                'name' => 'Có thể phỏng vấn online',

            ],
            [
                'type' => 'commit_work_content',
                'name' => 'Công việc không cần nghe điện thoại',
            ],
            [
                'type' => 'commit_work_content',
                'name' => 'Không yêu cầu biết dùng máy tính',
            ],
            [
                'type' => 'commit_work_content',
                'name' => 'Có kinh nghiệm làm lễ tân',
            ],
            [
                'type' => 'commit_work_environment',
                'name' => 'Nhiều người ngoại quốc',
            ]
        ]);
    }
}
