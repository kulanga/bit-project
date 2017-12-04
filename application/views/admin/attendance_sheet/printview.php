<html>
    <head>
        
        <style type="text/css">
            body{
                text-align: center;
                margin: 0 auto;
                width: 800px;
                margin-top: 40px;
            }
            .students-list{
                margin-top: 20px;
                margin-bottom: 10px;
            }
            .students-list td, .students-list th {
                text-align:left;
                border:0;
                border-top: 1px;
                border-right: 1px;
                border-style: solid;
                border-color: #000;
                padding: 3px 5px;
            }
            .students-list td:first-child, .students-list th:first-child {
                border-left: 1px solid #000;
            }
            .students-list tr:last-child td{
                border-bottom: 1px solid #000;
            }
        </style>
    </head>
    <body>
        <div style="text-align:left;">
            <h2 style="text-decoration:underline;text-align:center;">Students Attendance Sheet</h2>
            <h3 style="text-align:center;"><?=$course->name?>, Semester <?=$semester->semester_number?> of Year <?=$semester->semester_year;?></h3>
            <h3 style="text-align:center;">
                Subject: 
                <?php if(is_object($subject)) {?>
                    <?=$subject->name .' (' . $subject->code . ')'?>
                <?php } ?>
            </h3>
            <span>Date:_____________</span>&nbsp;<span>Time:_____</span><br/>
        </div>

        <div>
            <table width="100%" align="center" class="students-list" cellpadding="0" cellspacing="0"> 
                <thead>
                    <tr>
                        <th width="25%">Reg.No</th>
                        <th width="50%">Name</th>
                        <th width="25%">Signature</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($students as $stu) { ?>
                        <tr>
                            <td><?=$stu->reg_no?></td>
                            <td><?=$stu->full_name;?></td>
                            <td>&nbsp;</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <div style="text-align:left;margin-top:20px;">
            <span>Number of attendance:</span><br/><br/>
            <span>Lecturer's Name:</span><br/><br/>
            <span>_________________</span><br/>
            <span>Lecturer's Signature</span><br/>
        </div>


        <script type="text/javascript">

            (function () {

                window.print();

                var afterPrint = function () {
                    window.location.href = '/admin/admin_attendance_sheet/search';
                };

                if (window.matchMedia) {
                    var mediaQueryList = window.matchMedia('print');

                    mediaQueryList.addListener(function (mql) {
                        if (mql.matches) {
                            beforePrint();
                        } else {
                            afterPrint();
                        }
                    });
                }
                window.onafterprint = afterPrint;
            }());
        </script>
    </body>
</html>