<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
    <h1> Chào {{  $genderContext  . ' ' . $candidatesName }}</h1>

    <p>Cảm ơn {{  $genderContext }} đã quan ứng tuyển công việc {{ ' ' . $jobName }} </p>
    <p>Hệ thống đã ghi nhận thông tin của ứng tuyển của {{  $genderContext . ' ' }} với công việc {{ ' ' . $jobName . '.' }}
      Xin hãy vui lòng chời đợi, chúng tôi sẽ liên hệ với {{  $genderContext }} trong thời gian sớm nhất.
    </p>
    <p>
        Cảm ơn {{ $genderContext }} rất nhiều!
    </p>

    <p>
        Trân trọng,
    </p>
    <p>
        Trưởng phòng tuyển dụng
        <br>
        {{ $senderName }}
    </p>
</body>
</html>
