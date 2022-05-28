<php>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Complaint report</title>
    </head>
    <style>
        {{--@font-face {--}}
        {{--    font-family: "KhmerOSbattambang";--}}
        {{--    src: url({{storage_path('Fonts/KhmerOSbattambang.ttf')}}) format('truetype');--}}
        {{--}--}}
        /*body{*/
        /*    font-family: "Khmer OS";*/
        /*}*/
        body{
            font-family: "Khmer OS";
        }
        .title{
            font-size: 16px;
            text-align: center;
        }
        table, th, td{
            border: 1px solid black;
            border-collapse: collapse;
            text-align: center;
            padding: 15px 10px;
            line-height: 22px;
            font-size: 9px;
        }
        .content{

        }
        .table{
            margin-top: 15px;
        }
    </style>
    <body>
        <h1 class="title">របាយការណ៍ស្តីពី ការតវ៉ា និងការដោះស្រាយសម្រាប់និស្សិត នៅតាមគ្រឹះស្ថានឧត្តមសិក្សា សម្រាប់ឆ្នាំសិក្សា ២០២១-២០២២</h1>
        <table class="table">
            <tr>
                <td colspan="1" rowspan="2">លរ</td>
                <td colspan="5">ព័ត៌មាននិស្សិត</td>
                <td colspan="2" rowspan="2">កាលបរិច្ឆេទ នៃការតវ៉ា</td>
                <td colspan="3" rowspan="2">ប្រភេទនៃការតវ៉ា</td>
                <td colspan="3" rowspan="2">ខ្លឹមសារ នៃការតវ៉ា</td>
                <td colspan="2" rowspan="2">នីតិវិធីនៃការដោះស្រាយ</td>
                <td colspan="2" rowspan="2">លទ្ធផលនៃការដោះស្រាយ</td>
                <td colspan="2" rowspan="2">កាលបរិច្ឆេទនៃការដោះស្រាយ</td>
                <td colspan="1" rowspan="2">ផ្សេងៗ</td>
            </tr>
            <tr>
                <td colspan="2">ឈ្មោះនិស្សិត/អនាមិក</td>
                <td colspan="1">ភេទ</td>
                <td colspan="1">ជំនាញ</td>
                <td colspan="1">ឆ្នាំ</td>
            </tr>
            @foreach ($complaints as $complaint)
                @if($complaint->progress == 'resolved')
                    <tr>
                        <td>{{$complaint->id}}</td>
                        <td colspan="2">{{ !$complaint->complainer ? "អនាមិក" : $complaint->complainer->student_name}}</td>
                        <td colspan="1">{{ !$complaint->complainer ? "មិនបង្ហាញ" : $complaint->complainer->gender}}</td>
                        <td colspan="1">{{ $complaint->department->name}}</td>
                        <td colspan="1">{{ !$complaint->complainer ? "មិនបង្ហាញ" : $complaint->complainer->student_year}}</td>
                        <td colspan="2">{{ $complaint->created_at }}</td>
                        <td colspan="3">{{ $complaint->complain_sub_category->complain_category->name }}</td>
                        <td colspan="3">{{ $complaint->statement }}</td>
                        <td colspan="2">{{ $complaint->settlement_procedures }}</td>
                        <td colspan="2">{{ $complaint->result_of_settlement }}</td>
                        <td colspan="2">{{ $complaint->updated_at }}</td>
                        <td colspan="1">{{ $complaint->others }}</td>
                    </tr>
                @endif
            @endforeach
        </table>
    </body>
</php>