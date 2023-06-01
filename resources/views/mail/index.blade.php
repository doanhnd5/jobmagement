<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
    @php
        $genderContext = ' ' .  $mailData['gender'];
        logger($mailData);
    @endphp
    {{-- <h1> {{'Chào ' $mailData['gender']  .  $mailData['candidates_name'] }}</h1>

    <p>Cảm ơn . {{  $genderContext }} đã quan ứng tuyển công việc {{ ' ' . $mailData['job_name'] }} </p>
    <p>Hệ thống đã ghi nhận thông tin của ứng tuyển của {{  $genderContext . ' ' }} với công việc {{ ' ' . $mailData['job_name'] }}
      Xin hãy vui lòng chời đợi, chúng tôi sẽ liên hệ với {{  $genderContext }} trong thời gian sớm nhất.
    </p>
    <p>
        Cảm ơn anh chị rất nhiều!
    </p>

    <p>
        Trân trọng,
    </p>
    <p>
        Trưởng phòng tuyển dụng
        <br>
        {{ $mailData['sender_name'] }}
    </p> --}}
</body>
</html>
