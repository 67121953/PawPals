<!DOCTYPE html>
<html>
<head>
    <title>รายชื่อนักศึกษา</title>
</head>
<body>
    <h1>รายชื่อนักศึกษาและคะแนนสอบ</h1>
    <table border="1" cellpadding="8">
    <tr>
        <th>รหัสนักศึกษา</th>
        <th>ชื่อ-สกุล</th>
        <th>คะแนน</th>
        <th>ผลการเรียน</th> {{-- เพิ่มคอลัมน์ใหม่ --}}
    </tr>
    @foreach ($students as $student)
    <tr>
        <td>{{ $student['id'] }}</td>
        <td>{{ $student['name'] }}</td>
        <td>{{ $student['score'] }}</td>
        <td>
            {{-- เงื่อนไขเช็คผลการเรียน --}}
            @if ($student['score'] >= 80)
                ดีเยี่ยม
            @elseif ($student['score'] >= 50)
                ผ่าน
            @else
                ไม่ผ่าน
            @endif
        </td>
    </tr>
    @endforeach
</table>
</body>
</html>
