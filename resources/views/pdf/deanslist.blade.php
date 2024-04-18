<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Deans List</title>

    <style>
        #bg{
            position: absolute;
            height: 100%;
            width: 100%;
            background: url(images/bg.jpg);
            opacity: 15%;
        }
        .bg{
            border-radius: 50%;
        }
        table{
            border-collapse: collapse;
            width: 100%;
            
        }
        th,td{
            border: 1.5px solid #fcf5f5;
            padding: 5px;
            text-align: center;
            font-family: sans-serif;
        }
        th{
            font-size: 18px;
        }
        td{
            font-size: 16px;
            color: #302f2f;
        }
        .header,
        .footer {
            width: 100%;
            position: fixed;
        }
        .header {
            top: 0px;
        }
        .block{
            display: inline;
            color: #326d45;
            font-weight: bold;
        }
        .institute{
            margin-top: 1.6rem;
            margin-bottom: 0.5rem;
            font-weight: bold;
            font-size: 20px;
            color: #0d3f1d;
        }
        .program{
            color: #22753e;
            font-size: 17px;
        }
        .footer {
            bottom: 0px;
        }
        .footer-bg{
            background: #22753e;
            position: relative;
            height: 2.5rem;
            width: 100%;
           
        }
        .luxmundi{
            position: absolute;
            top: 50%;
            left: 50%;
            
            transform: translate(-50%, -50%);
        }
        .luxmundi_left{
            text-align: center;
            color: white;
            width: 30%;
            margin-left: 50px;
            padding-top: 5px;
            font-size: 13px;
            font-weight: bold;
        }
        .luxmundi img{
            border-radius: 50%;
        }
        .luxmundi_right{
            position: absolute;
            top: 0;
            right: 0;
            font-size: 14px;
            margin-top: 10px;
            color: white;
        }
        .abbr{
            font-weight: bold;
            font-size: 18px;
            margin-left: 4px;
        }
        .header-content{
            text-align: center;
        }
        .content{
            margin-top: 13rem;
        }
    </style>
</head>
<body>
    <div id="bg"></div>
    <div class="header">
        <div class="header-content">
            <div class="block">
                <img src="images/logo.jpg" class="bg" width="70" height="70">
                <div class="republic">OFFICE OF THE</div>
                <div class="republic">COLLEGE REGISTRAR</div>
            </div>
            <div class="institute">{{strtoupper($office)}}</div>
            <div class="program">{{$program}}</div>
        </div>
    </div>
    
    <div class="content">
        
        <table>
            <thead>
               <tr>
                    <th colspan="3">NAME</th>
                    <th>PROGRAM</th>
                    <th>GWA</th>
               </tr>
            </thead>
            <tbody>
                @foreach ($deans_list as $list)
                    <tr>
                        <td>{{$list->last_name}}</td>
                        <td>{{$list->first_name}}</td>
                        <td>{{$list->middle_name}}</td>
                        <td>{{$list->program_abbreviation}}</td>
                        <td>{{$list->equivalent}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="footer">
        <div class="footer-bg">
            <div class="luxmundi_left">
                <div>LUX MUNDI</div>
                <div>Light of the world</div>
            </div>
            <div class="luxmundi">
                <img src="images/luxmundi.jpg" alt="" height="50" width="50">
            </div>
            <div class="luxmundi_right">
                <span class="abbr">I</span>-INTEGRITY
                <span class="abbr">C</span>-COMPASSION
                <span class="abbr">E</span>-EXCELLENCE
            </div>
        </div>
    </div>
</body>
</html>